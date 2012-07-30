$(document).ready(function()
{
    $('.editText').live('click', function(){
        page = $(this).parent().parent().attr('id');
        $('.editText').html('Sauvegarder');
        $('.editText').addClass('save');
        $('.save').removeClass('editText');

        titre = $('#'+page+' div:first-child > h2').html();
        $('#'+page+' div:first-child > h2').html('<input type="text" id="titrePage" value="test" />');
        $('#titrePage').css('z-index','10000');

        content = $('#'+page+' div:first-child > p').html();
        $('#'+page+' div:first-child > p').html('<textarea name="content" id="content">'+content+'</textarea>');
        tinyMCE.init({
            mode : "textareas",
            height: 600,
            width: 350
            });
        })

        // On envoie les données de la nouvelle page en ajax
        $('.save').live('click', function(){
            titre = $('#titrePage').val();
            content = tinyMCE.get('content').getContent();
            id = $(this).parent().parent().attr('id');
            $.ajax({
            url: "core/changeContent.php",
            type: 'POST',
            data: {id: id, titre : titre, content: content},
            success: function(data){
                if(!data.error) {
                    $('.save').html('Editer');
                    $('.save').addClass('editText');
                    $('.editText').removeClass('save');

                    $('#'+page+' div:first-child h2').html('oto');
                    $('#'+page+' div:first-child p').html(content);
                }
            }
        });
    })

    $('.addPage').live('click', function(){

        // Affiche un div pour un titre et un contenu avec textarea, la sauvegarde en bdd puis l'insere en js
        $('option').last().attr('selected', 'selected');
        $("#contentPageAdd").show();

        $('#addPage span').html('Sauvegarder');
        $('#addPage').addClass('savePage');
        $('#addPage').removeClass('addPage');
    })

    $('.savePage').live('click',function(){
        // On sauvegarde en ajax la page puis on l'affiche en js
        newTitre = $('#newTitre').val();
        contentnewPage = $('#contentNewPage').val();
        idPrecedent = $("#idPrecedent").val();
        if(contentnewPage != "" && idPrecedent != "")
        {
            $.ajax({
                url: "core/addPage.php",
                type: 'POST',
                data: {idPrecedent: idPrecedent, newTitre: newTitre, content : contentnewPage},
                success: function(data){
                    location.reload();
                }
            });
        }
        else
            alert('Pour insérer une page, merci de mettre un titre et un contenu');
    })

     $('.editMenu').live('click', function()
     {
         // On récupère le tableau des pages du livre
         $('.pageSection > div').each(function() {
             console.log($(this).html());
             idPage = $('.pageSection').attr('id');
             reelId = idPage.split('_');
             namePage = $('.pageSection div:first-child > h2').html();
             console.log('namepage : '+namePage);
            // tabPages[reelId[0]] = namePage;
         })

         $('#menu li').each(function(index){
         {
             val = $(this).text();
             href = $(this).parent().attr('href');
             tabPages = new Array();

             $(this).parent().parent().html('Nom de l\'onglet : <input type="text" id="nom_'+index+'" class="liOptionMenu" value="'+val+'"/><br /><br />Dirige vers la page : <select>' +
                 '</select><input type="text" id="url_'+index+'" value="'+href+'" />');
         }})
     })
});
