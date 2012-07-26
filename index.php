<?php include('header.php'); ?>
<?php include('fonction.php');?>

<?php include('templates/menu.tpl.php') ?>

<?php
/*

<div id="pbody">
	<div id="content">
        <?php if(isset($_SESSION['code']) && $_SESSION['code'] == '1') echo 'ok';?>
		<div class="left">
			<div id='enluminure'>Test !</div>
		</div>
		<div class="right">
			<div class='post' id="post1">
				<div class="ptitle">
					<h2>
						<a href="monPoste.html" rel="bookmark" title="Permanent Link to mon post">
							Voir mon premier post
						</a>
					</h2>
				</div>
				<div class="entry">
					<?php echo wpguy_initial_cap('Mon beau post et son contenu g�nialissime !') ?>
				</div>
				<p class="postmetadata">Ecrit par moi pendant les vacances</p>
			</div>
		</div>
		<div style='clear: both;'></div>
		<div class="navigation">
			<div class="alignleft">Avant</div>
			<div class="alignright">Apres</div>		
		</div>
	</div>
</div>
<div id='footer'></div>*/


?>
<?php include('book.php'); ?>
<br>
<?php include('footer.php'); ?>