<?php include('header.php'); ?>
<?php include('fonction.php');?>

<?php include('templates/menu.tpl.php') ?>

<?php
var_dump($_SESSION);
if(isset($_SESSION['message'])) echo $_SESSION['message']; ?>


<?php include('templates/add.tpl.php'); ?>
<?php include('book.php'); ?>
<br />


<?php include('footer.php'); ?>