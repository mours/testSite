<script type="text/javascript">
    $(document).ready(function(){
        $('.edit').live('click', function(){
            $('#menu li').each(function(index){
                {
                    val = $(this).text();
                    href = $(this).parent().attr('href');
                    $(this).parent().parent().html('Nom de l\'onglet : <input type="text" id="nom_'+index+'" value="'+val+'"/><br />Lien : <input type="text" id="url_'+index+'" value="'+href+'" />');
                }});

            $('.edit').html('Sauvegarder');
            $('.edit').addClass('save');
            $('.save').removeClass('edit');

            titre = $('.pageSection h2').html();
            $('.pageSection h2').html('<input type="text" id="titrePage" value="test" />');

            content = $('.pageSection p').html();
            $('.pageSection p').html('<textarea name="content" id="content">'+content+'</textarea>');
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
                      $('.save').addClass('edit');
                      $('.edit').removeClass('save');

                      console.log(data);
                      $('.pageSection h2').html('oto');
                      $('.pageSection p ').html(content);
                  }
              }
            });
        })
    })
</script>
<span class='edit'>
  Editer
</span>