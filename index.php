<?php //include('header.php'); ?>
<?php include('fonction.php');?>

<?php //var_dump($_SESSION)?>
<div id='header'>
    <?php require_once('templates/menu.tpl.php'); ?>
	<h1 style='float: left; margin: 50px;'>Test et blog</h1>
</div>

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
<section>
    <div>
        <h2>Usage</h2>
        <p>Canvas consists of a drawable region defined in HTML code with height and width attributes. JavaScript code may access the area through a full set of drawing functions similar to other common 2D APIs, thus allowing for dynamically generated graphics. Some anticipated uses of canvas include building graphs, animations, games, and image composition.</p>
    </div>
</section>
<?php include('footer.php'); ?>