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
            $('.pageSection h2').html('<input type="text" id="titrePage" value="'+titre+'" />');

            content = $('.pageSection p').html();
            $('.pageSection p').html('<textarea id="content">'+content+'</textarea>');
            tinyMCE.init({
                mode : "textareas",
                height: 600,
                width: 350
            });
        })

        // On envoie les données de la nouvelle page en ajax
        $('.save').live('click', function(){
          titre = $('#titrePage').html();
          content = $("#content").html();
            $.ajax({
              url: "core/changeContent.php",
              type: 'POST',
              data: {titre : titre, content: content},
              success: function(data){

              }
            });
        })
    })
</script>

<span class='edit'>
  Editer
</span>