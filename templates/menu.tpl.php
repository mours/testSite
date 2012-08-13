<script type="text/javascript">
    $(document).ready(function(){
      nbLi = $('#menu > ul > *').length;

      if(nbLi >= 5)
        $(".addLi").hide();
      else if(nbLi == 1)
        $('.deleteLi').hide();
    })

    function goToPage(index)
    {
      $('#mybook').booklet('gotopage',index);
    }
</script>

<img src="css/images/banner_v2.png">

<div id='menu' style='border: 1px solid #ccc;'>
    <span class='editMenu'><img src='css/images/edit.png' />Editer</span>
    <span class='addLi'><img src='css/images/add_v2.png' />Ajouter onglet</span>
    <span class='deleteLi'><img src='css/images/delete_v2.png' />Supprimer onglet</span>
    <?php
        $menu = new Menu();
        $onglets = $menu->getOnglets();
    ?>
    <ul>
        <?php foreach($onglets as $onglet) : ?>
            <a id="selector-page-2" href="#/page/3" href='#<?php //echo $onglet['lien']; ?>' pageId='<?php echo $onglet["lien"]; ?>'>
               <li onclick="goToPage(<?php echo $onglet['ordre']+1; ?>);" class='menuLi'><?php echo $onglet['name']; ?>
                  <input type='hidden' value='<?php echo $onglet['name'].'_'.$onglet['lien'].'_'.$onglet['titre']; ?>' />
               </li>
            </a>
        <?php endforeach; ?>
    </ul>
</div>