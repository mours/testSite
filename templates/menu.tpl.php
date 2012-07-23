<div id='menu'>
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