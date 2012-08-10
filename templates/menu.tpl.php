<script type="text/javascript">
    $(document).ready(function(){
      nbLi = $('#menu > ul > *').length;

      if(nbLi >= 5)
        $(".addLi").hide();
      else if(nbLi == 1)
        $('.deleteLi').hide();
    })
</script>

<img src="css/images/banner.png">

<div id='menu' style='border: 1px solid #ccc;'>
    <span class='editMenu'>Editer</span>
    <span class='addLi'>Ajouter onglet</span>
    <span class='deleteLi'>Supprimer onglet</span>
    <?php
        $menu = new Menu();
        $onglets = $menu->getOnglets();
    ?>
    <ul>
        <?php foreach($onglets as $onglet) : ?>
            <a href='<?php echo $onglet['lien']; ?>'>
                <li class='menuLi'><?php echo $onglet['name']; ?>
                    <input type='hidden' value='<?php echo $onglet['name'].'_'.$onglet['lien'].'_'.$onglet['titre']; ?>' />
                </li>
            </a>
        <?php endforeach; ?>
    </ul>
</div>