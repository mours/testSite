<script type="text/javascript">
    $(function() {
        //single book
        $('#mybook').booklet({
            width:  800,
            height: 675,
            closed: true,
            autoCenter: true,
            covers: true
        });
    });
</script>

<div id="mybook">
   <div>Page de couverture</div>
   <?php
   $pages = Book::getAllPages();
   $index = 1;
   foreach($pages as $page): ?>
      <div>
         <?php include('templates/edit.tpl.php'); ?>
         <?php if($page->getTitre()) : ?>
            <h3><?php echo $page->getTitre(); ?></h3>
         <?php endif; ?>
         <?php echo /*wpguy_initial_cap(*/$page->getContent();//); ?>
      </div>
   <?php endforeach; ?>
   <div>
     <h3>Contact</h3>
       <?php include('access.php'); ?>
   </div>
   <div>
       <h3>THE END</h3>
   </div>
</div>