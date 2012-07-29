<script type="text/javascript">
    $(document).ready(function(){
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
    });
</script>

<div id='addPage' class='addPage'>
    <img src="css/images/add.png" alt='Ajouter'/>
    <span>Ajouter une page</span>
</div>

<form id="contentPageAdd" style='display: none; color: white; border: 1px solid red;' method="POST">
    Titre <input type='text' id='newTitre' /><br />
    Contenu de la page<br /><textarea name="contentNewPage" id="contentNewPage"></textarea>
    <?php $pages = Book::getAllPages(); ?>
    Mettre après la page <select id='idPrecedent'>
        <?php foreach($pages as $page) : ?>
            <option value='<?php echo $page->getId(); ?>'><?php echo $page->getTitre(); ?></option>
        <?php endforeach; ?>
    </select>
</form>