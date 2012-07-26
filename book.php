<img id="myPage1" src="css/images/leftPage1.png" width="25px" height="674px" style="display:none;"/>
<img id="myPage2" src="css/images/leftPage2.jpg" width="404px" height="671px" style="display:none;"/>
<div id="book">
    <canvas id="pageflip-canvas"></canvas>
    <div id="pages">
        <?php
        $pages = Book::getAllPages();
        foreach($pages as $page): ?>
        <section class='pageSection' id="page_<?php echo $page->getId(); ?>">
            <div>
                <?php include('templates/edit.tpl.php'); ?>
                <?php if($page->getTitre()) : ?>
                <h2>
                  <?php echo $page->getTitre(); ?>
                </h2>
                <?php endif; ?>
                <p>
                    <?php echo /*wpguy_initial_cap(*/$page->getContent(); ?>
                </p>
            </div>
        </section>
        <?php endforeach; ?>
        <section>
            <div>
                <h2>Contact</h2>
                <?php include('access.php'); ?>
            </div>
        </section>
        <script type="text/javascript" src="js/pageflip.js"></script>
