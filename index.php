<?php include('header.php'); ?>
<?php include('fonction.php');?>

<?php include('templates/menu.tpl.php') ?>

<?php
if(isset($_SESSION['message'])){
  echo "<div class='flashUser'>".$_SESSION['message']."</div>";
  unset($_SESSION['message']);
}
?>


<?php include('templates/add.tpl.php'); ?>
<?php include('book.php'); ?>
<br />
<?php include('footer.php'); ?>