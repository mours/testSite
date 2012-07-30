

(function() {

    // Dimensions of the whole book
    var myBook = document.getElementById( "book" );

    var BOOK_WIDTH = 862;
    var BOOK_HEIGHT = 680;

    // Dimensions of one page in the book
    var PAGE_WIDTH = 432;
    var PAGE_HEIGHT = 680;

    // Dimensions of left page in the book
    var LEFT_PAGE_WIDTH_1  = 25;
    var LEFT_PAGE_HEIGHT_1 = 674;

    var LEFT_PAGE_WIDTH_2  = 404;
    var LEFT_PAGE_HEIGHT_2 = 671;

    // flip margin
    var FLIP_MARGIN = 60;

    // Vertical spacing between the top edge of the book and the papers
    var PAGE_Y = ( BOOK_HEIGHT - PAGE_HEIGHT ) / 2;

    // The canvas size equals to the book dimensions + this padding
    var CANVAS_PADDING = 0;

    var page = 0;

    var canvas = document.getElementById( "pageflip-canvas" );
    var context = canvas.getContext( "2d" );

    var mouse = { x: 0, y: 0 };

    var flips = [];

    var book = document.getElementById( "book" );

    // top position of book.
    for (var lx=0, ly= 0, el=book;
         el != null;
         lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
    var BOOK_POSITION_TOP = ly;

    // List of all the page elements in the DOM
    var pages = book.getElementsByTagName( "section" );

    // Organize the depth of our pages and create the flip definitions
    for( var i = 0, len = pages.length; i < len; i++ ) {
        pages[i].style.zIndex = len - i;

        flips.push( {
            // Current progress of the flip (left -1 to right +1)
            progress: 1,
            // The target value towards which progress is always moving
            target: 1,
            // The page DOM element related to this flip
            page: pages[i],
            // True while the page is being dragged
            dragging: false
        } );
    }

    // Resize the canvas to match the book size
    canvas.width = 0; //BOOK_WIDTH + ( CANVAS_PADDING * 2 );
    canvas.height = BOOK_HEIGHT + ( CANVAS_PADDING * 2 );

    // Offset the canvas so that it's padding is evenly spread around the book
    canvas.style.top = -CANVAS_PADDING + "px";
    canvas.style.left = -CANVAS_PADDING + "px";

    // Render the page flip 60 times a second
    setInterval( render, 1000 / 60 );

    book.addEventListener( "mousemove", mouseMoveHandler, true );
    book.addEventListener( "mousedown", mouseDownHandler, true );
    book.addEventListener( "mouseup", mouseUpHandler, true );
    document.addEventListener( "mouseup", mouseUpHandler, true );

    function mouseMoveHandler( event ) {
        // Offset mouse position so that the top of the spine is 0,0
        mouse.x = event.clientX - book.offsetLeft - ( BOOK_WIDTH / 2 );
        //mouse.y = event.clientY - book.offsetTop;
        //mouse.y = event.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }

    function mouseDownHandler( event ) {
        if (Math.abs(mouse.x) < PAGE_WIDTH && Math.abs(mouse.x) > PAGE_WIDTH - FLIP_MARGIN ){
            if (mouse.x < 0 && page - 1 >= 0) {
                flips[page - 1].dragging = true;
            }
            else if (mouse.x > 0 && page + 1 < flips.length) {
                flips[page].dragging = true;
            }
        }

        // Prevents the text selection cursor from appearing when dragging
        // event.preventDefault();
    }

    function mouseUpHandler( event ) {

        var allNoFlip = true;
        for( var i = 0; i < flips.length; i++ ) {
            // If this flip was being dragged we animate to its destination
            if( flips[i].dragging ) {
                allNoFlip = false;
                // Figure out which page we should go to next depending on the flip direction
                if( mouse.x < 0 ) {
                    flips[i].target = -1;
                    page = Math.min( page + 1, flips.length );
                }
                else {
                    flips[i].target = 1;
                    page = Math.max( page - 1, 0 );
                }
            }

            flips[i].dragging = false;
        }
        if ( allNoFlip )
            canvas.width = 0;
    }

    function render() {

        for (var i = 0; i < flips.length; i++) {
            var flip = flips[i];

            if( flip.dragging ) {
                flip.target = Math.max( Math.min( mouse.x / PAGE_WIDTH, 1 ), -1 );
            }

            flip.progress += ( flip.target - flip.progress ) * 0.2;

            // If the flip is being dragged or is somewhere in the middle of the book, render it
            if( flip.dragging || Math.abs( flip.progress ) < 0.997 ) {
                drawFlip( flip );
            }

        }

    }

    function drawFlip( flip ) {
        // Strength of the fold is strongest in the middle of the book
        var strength = Math.max( 1 - Math.abs( flip.progress ), 0.001 );

        // Width of the folded paper
        var foldWidth = ( PAGE_WIDTH * 0.5 ) * ( 1 - flip.progress );

        // X position of the folded paper
        var foldX = PAGE_WIDTH * flip.progress + foldWidth;

        // How far the page should outdent vertically due to perspective
        var verticalOutdent = 20 * strength;

        // The maximum width of the left and right side shadows
        var paperShadowWidth = ( PAGE_WIDTH * 0.5 ) * Math.max( Math.min( 1 - flip.progress, 0.5 ), 0 );
        var rightShadowWidth = ( PAGE_WIDTH * 0.5 ) * Math.max( Math.min( strength, 0.5 ), 0 );
        var leftShadowWidth = ( PAGE_WIDTH * 0.5 ) * Math.max( Math.min( strength, 0.5 ), 0 );

        // set canvas size & clear it.
        canvas.width = BOOK_WIDTH + ( CANVAS_PADDING * 2 );
        context.clearRect( 0, 0, canvas.width, canvas.height );

        // Change page element width to match the x position of the fold
        flip.page.style.width = Math.max(foldX, 0) + "px";

        context.save();
        context.translate( CANVAS_PADDING + ( BOOK_WIDTH / 2 ), PAGE_Y + CANVAS_PADDING );


        // Draw a sharp shadow on the left side of the page
        context.strokeStyle = 'rgba(0,0,0,'+(0.05 * strength)+')';
        context.lineWidth = 30 * strength;
        context.beginPath();
        context.moveTo(foldX - foldWidth, -verticalOutdent * 0.5);
        context.lineTo(foldX - foldWidth, PAGE_HEIGHT + (verticalOutdent * 0.5));
        context.stroke();

        // Right side drop shadow
        var rightShadowGradient = context.createLinearGradient(foldX, 0, foldX + rightShadowWidth, 0);
        rightShadowGradient.addColorStop(0, 'rgba(0,0,0,'+(strength*0.2)+')');
        rightShadowGradient.addColorStop(0.8, 'rgba(0,0,0,0.0)');

        context.fillStyle = rightShadowGradient;
        context.beginPath();
        context.moveTo(foldX, 0);
        context.lineTo(foldX + rightShadowWidth, 0);
        context.lineTo(foldX + rightShadowWidth, PAGE_HEIGHT);
        context.lineTo(foldX, PAGE_HEIGHT);
        context.fill();


        // Left side drop shadow
        var leftShadowGradient = context.createLinearGradient(foldX - foldWidth - leftShadowWidth, 0, foldX - foldWidth, 0);
        leftShadowGradient.addColorStop(0, 'rgba(0,0,0,0.0)');
        leftShadowGradient.addColorStop(1, 'rgba(0,0,0,'+(strength*0.15)+')');

        context.fillStyle = leftShadowGradient;
        context.beginPath();
        context.moveTo(foldX - foldWidth - leftShadowWidth, 0);
        context.lineTo(foldX - foldWidth, 0);
        context.lineTo(foldX - foldWidth, PAGE_HEIGHT);
        context.lineTo(foldX - foldWidth - leftShadowWidth, PAGE_HEIGHT);
        context.fill();

        // page image.
        var dx = 5;
        var img1=document.getElementById( "myPage1" );
        if ( foldWidth > dx )
        {
            context.drawImage( img1, 0, 0, Math.min( foldWidth, LEFT_PAGE_WIDTH_1 ), LEFT_PAGE_HEIGHT_1, PAGE_WIDTH - 2 * foldWidth, 1, Math.min( LEFT_PAGE_WIDTH_1, foldWidth) , LEFT_PAGE_HEIGHT_1 );
        }

        var img2=document.getElementById( "myPage2" );
        if ( foldWidth > LEFT_PAGE_WIDTH_1 )
        {
            context.drawImage( img2, 0, 0, Math.min( foldWidth - LEFT_PAGE_WIDTH_1, LEFT_PAGE_WIDTH_2 ), LEFT_PAGE_HEIGHT_2, PAGE_WIDTH - 2 * foldWidth + LEFT_PAGE_WIDTH_1, 4, foldWidth - LEFT_PAGE_WIDTH_1, LEFT_PAGE_HEIGHT_2 );
        }

        // Gradient applied to the folded paper (highlights & shadows)
        var foldGradient = context.createLinearGradient(foldX - paperShadowWidth, 0, foldX, 0);
        var opak = Math.max( ( flip.progress + 1.0 ) / 2.0, 0.01 );
        foldGradient.addColorStop(0.5, 'rgba(0,0,0,' + 0.0 * opak + ')');
        foldGradient.addColorStop(0.7, 'rgba(0,0,0,' + 0.06 * opak + ')');
        foldGradient.addColorStop(0.8, 'rgba(0,0,0,' + 0.12 * opak + ')');
        foldGradient.addColorStop(1.0, 'rgba(0,0,0,' + 0.30 * opak + ')');

        context.fillStyle = foldGradient;
        context.strokeStyle = 'rgba(0,0,0,0.06)';
        context.lineWidth = 0.5;

        // Draw the folded piece of paper
        context.beginPath();
        context.moveTo(foldX, 0);
        context.lineTo(foldX, PAGE_HEIGHT);
        context.quadraticCurveTo(foldX, PAGE_HEIGHT + (verticalOutdent * 2), foldX - foldWidth, PAGE_HEIGHT + verticalOutdent);
        context.lineTo(foldX - foldWidth, -verticalOutdent);
        context.quadraticCurveTo(foldX, -verticalOutdent * 2, foldX, 0);

        context.fill();
        context.stroke();


        context.restore();
    }

})();


