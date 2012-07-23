<?php

require_once('../fonction.php');

/* On valide le user en tant qu'admin */

if(isset($_POST['login']) && isset($_POST['password']))
{
    //Vérification dans la bdd
    $login = secure($_POST['login']);
    $password = secure($_POST['password']);
    $user = new User();
    $_SESSION['user'] = $user;

    if($user->isAdmin($login, $password))
        $_SESSION['code'] = '1';

    header('Location: ../index.php');
}

?>