$(document).ready(function()
{
    $(".inline").colorbox({inline:true, transition:"none", width:"560", height:"700" });
    var tabPages = new Array();
    tinyMCE.init({
        mode : "textareas",
        height: 500,
        width: 350,
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste",

        // Theme options
        theme_advanced_buttons1 : "reservation, bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|anchor,image,cleanup,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "fontsizeselect,tablecontrols,hr,|,emotions,iespell,media,advhr,|,ltr,rtl,",
        theme_advanced_buttons4 : "moveforward,movebackward,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        setup: function(ed){
            //Ajouter un bouton
            ed.addButton('reservation', {
                title: 'Réservation',
                image: 'css/images/add.png',
                onclick: function(){
                    alert(tinyMCE.get('contentNewPage'));
                    tinyMCE.get('contentNewPage').setContent('<span>test</span>');
                    // Fonction executée au clic
                    /*var sel = ed.getContent();
                    setTimeout(function(){
                        pop.document.open();
                        pop.document.write(sel);
                        pop.document.close();
                    }, 500);*/

                }
            });
        },

        // Skin options
        skin : "o2k7",
        skin_variant : "silver"

    });

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

    /*$('.addPage').live('click', function(){
        // Affiche un div pour un titre et un contenu avec textarea, la sauvegarde en bdd puis l'insere en js
       /* $('option').last().attr('selected', 'selected');
        $("#contentPageAdd").show();
        $('.annulerAddPage').show();
        $('#addPage span').html('Sauvegarder');
        $('#addPage').addClass('savePage');
        $('#addPage').removeClass('addPage');
        $(".group1").colorbox({rel:'group1'});
    })*/

    $('.cboxTitle').live('click',function(){
        // On sauvegarde en ajax la page puis on l'affiche en js
        newTitre = $('#newTitre').val();
        contentnewPage = tinyMCE.get('contentNewPage').getContent()
        idPrecedent = $("#idPrecedent").val();
        console.log('titre : '+newTitre+' et newPage : '+contentnewPage);
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

    /**
     * Edition du menu, on propose de choisir le titre qui apparaitra et la page vers laquelle il fera référence.
     */
     $('.editMenu').live('click', function()
     {
         $(this).html('Sauvegarder');
         $(this).addClass('saveMenu');
         $(this).removeClass('editMenu');

         var tabLiSelected = new Array();
         $('#menu li').not(':hidden').each(function(index)
         {
             var lienHref = $(this).parent().attr('href');
             val = $.trim($(this).text());
             var cnt = $(this).parent().contents();
             $(this).parent().replaceWith((cnt));

             $(this).html('Nom de l\'onglet : <input type="text" id="nom_'+index+'" class="liOptionMenu" value="'+val+'"/><br /><br />Dirige vers la page : <select id="liste_'+index+'" class="listePage"></select>');
             $(this).css('border','1px solid #ccc');
             $(this).css('display','block');

             tabLiSelected.push(index+'_'+lienHref);
         });

         // On remplit les select avec toutes les pages de la base de données
         nbLi = $('#menu > ul > li > select').length;

         $.ajax({
             url: "core/changeMenu.php",
             type: 'POST',
             data: { liste : true },
             dataType : 'json',
             success: function(data){
                 for(i=0; i<data.nb; i++)
                 {
                    for(j=0; j<nbLi; j++){
                      selected = false;
                      indexLi = j+'_'+data[i].id;
                      if(jQuery.inArray(indexLi, tabLiSelected) != -1){
                        selected = true;
                      }

                      idListe = 'liste_'+j;
                      $("#"+idListe).append('<option id="'+j+'_'+data[i].id+'" value="'+data[i].id+'">'+data[i].titre+'</option>');

                      if(selected)
                        $("#"+indexLi).attr('selected', true);
                    }
                 }
             }
         })
     })

    /**
     * On sauvegarde le nouveau menu
     */
    $(".saveMenu").live('click', function(){

      var tabDonnees = "";
      nbChild = $('#menu > ul > *').length;
      i = 0;

      //Pour chaque chapitre, on récupere le titre et le lien et on sauvegarde le tout
      $('#menu li').each(function(index){
        titre = $(this).children('input').val();
        idLien = $(this).find("select option:selected").val();
        donneesLi = titre+'_'+idLien;

        if((i+1) != nbChild)
          tabDonnees += donneesLi+'; ';
        else
          tabDonnees += donneesLi;
        i += 1;
      });

      $.ajax({
        url: "core/changeMenu.php",
        type: 'POST',
        data: { dataTab : tabDonnees},
        success: function(data){
          $(location).attr('href','index.php');
        }
      });
    });

    // On ajoute un nouvelle onglet
    $(".addLi").live('click', function(){
      $('#menu').append('<li><input type="text" id="newLi" /><select id="listeNewLi"></select></li>');

      $(this).html('Sauvegarder');
      $(this).addClass('saveLi');
      $(this).removeClass('editMenu');

      $.ajax({
         url: "core/changeMenu.php",
         type: 'POST',
         data: { liste : true },
         dataType : 'json',
         success: function(data){
         var i;
         for(i=0; i<data.nb; i++)
            $("#listeNewLi").append('<option id="'+i+'" value="'+data[i].id+'">'+data[i].titre+'</option>');
         }
      })
    });

    // On sauvegarde en base le nouvel onglet
    $(".saveLi").live('click', function(){
      titre = $('#newLi').val();
      idLien = $('#listeNewLi').find(':selected').val();

      $.ajax({
        url: "core/changeMenu.php",
        type: 'POST',
        data: { add: true, idLien: idLien, titre: titre },
        dataType : 'json',
        success: function(data){
          $(location).attr('href','index.php');
        }
      })
    })

    // On supprime un li du menu
    $(".deleteLi").live('click', function(){
      $(this).html('Annuler');
      $(this).addClass('annuler');
      $(this).removeClass('deleteLi');

      $('#menu li').each(function(index){
          $(this).addClass('addMenuButton');
          $(this).append('<img src="css/images/delete.png" class="imgLi" />');

          val = $.trim($(this).text());
          var cnt = $(this).parent().contents();
          $(this).parent().replaceWith((cnt));
      });
    });

    // On demande confirmation pour on supprime
    $(".imgLi").live('click', function(){
        val = $(this).prev().val();

        if (confirm('Etes-vous sûr(e) de vouloir supprimer cet onglet ?')) {
          $.ajax({
            url: "core/changeMenu.php",
            type: 'POST',
            data: { remove: true, val: val },
            dataType : 'json',
            success: function(data){
              $(location).attr('href','index.php');
            }
          });
        }
    })

    $(".annuler").live('click', function(){
      $(location).attr('href','index.php');
    });
    $(".annulerAddPage").live('click', function(){
        $(location).attr('href','index.php');
    });
});
