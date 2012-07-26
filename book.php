<img id="myPage1" src="css/images/leftPage1.png" width="25px" height="674px" style="display:none;"/>
<img id="myPage2" src="css/images/leftPage2.jpg" width="404px" height="671px" style="display:none;"/>
<div id="book">
    <canvas id="pageflip-canvas"></canvas>
    <div id="pages">
        <?php
        $pages = Book::getAllPages();
        foreach($pages as $page): ?>
        <section>
            <div>
                <?php if($page->getTitre()) : ?>
                    <h2><?php echo $page->getTitre(); ?></h2>
                <?php endif; ?>
                <p><?php echo wpguy_initial_cap('Canvas consists of a drawable region defined in HTML code with height and width attributes. JavaScript code may access the area through a full set of drawing functions similar to other common 2D APIs, thus allowing for dynamically generated graphics. Some anticipated uses of canvas include building graphs, animations, games, and image composition.'); ?></p>
            </div>
        </section>
        <?php endforeach; ?>
        <script type="text/javascript" src="js/pageflip.js"></script>
