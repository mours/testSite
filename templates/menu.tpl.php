<!-- temporary banner -->
<img src="css/images/banner.png">

<div id='menu' style='border: 1px solid #ccc;'>
    <span class='editMenu'>Editer</span>
    <?php
        $menu = new Menu();
        $onglets = $menu->getOnglets();
    ?>
    <ul>
        <?php foreach($onglets as $onglet) : ?>
            <a href='<?php echo $onglet['lien']; ?>'><li class='menuLi'><?php echo $onglet['name']; ?></li></a>
        <?php endforeach; ?>
    </ul>
</div>