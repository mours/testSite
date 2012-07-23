<?php require_once('header.php');?>

<div id='connect'>
    <form method="post" action='core/connectPost.php'>
        Login : <br/><input type='text' name='login'/><br/><br/>
        Mot de passe : <br/><input type='password' name='password' /><br/>
        <input type="submit" value="S'authentifier" />
    </form>
</div>

<?php require_once('footer.php');?>