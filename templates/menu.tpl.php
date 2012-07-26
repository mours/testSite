<script type="text/javascript">
  $(document).ready(function(){
     /* $('.edit').live('click', function(){
          $('#menu li').each(function(index){
          {
            val = $(this).text();
            href = $(this).parent().attr('href');
            $(this).parent().parent().html('Nom de l\'onglet : <input type="text" id="nom_'+index+'" value="'+val+'"/><br />Lien : <input type="text" id="url_'+index+'" value="'+href+'" />');
          }})
      })*/
  })
</script>

<div id='menu' style='border: 1px solid #ccc;'>
    <span class='edit'>Editer</span>
    <?php
        $menu = new Menu();
        $onglets = $menu->getOnglets();
    ?>
    <ul>
        <?php foreach($onglets as $onglet) : ?>
            <a href='<?php echo $onglet['lien']; ?>'><li><?php echo $onglet['name']; ?></li></a>
        <?php endforeach; ?>
    </ul>
</div>