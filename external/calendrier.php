<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/colorbox.css" />
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/kalendae.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../external/captcha/captcha.css" type="text/css" media="screen" />

    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.1.custom.min.js"></script>
    <script type="text/javascript" src="../js/jquery.colorbox.js"></script>
    <script src="../js/kalendae.min.js" type="text/javascript"></script>
    <script src="../external/captcha/jquery.captcha.js" type="text/javascript"></script>
    <script src="../js/reservation.js" type="text/javascript"></script>
</head>
<body style='background-color: #FCFADB;'>
<style type="text/css">
    h2 {
      border-style: double;
    }
</style>

    <div>
        <h2>Vérifier les disponibilités</h2>
        <table border="1" cellspacing="6" id='tableReservation'>
            <tr>
                <td>Date de départ</td>
                <td>Date d'arrivée</td>
            </tr>
            <tr>
                <td><input type="text" id="depart"></td>
                <td><input type="text" id="arrivee" /></td>
            </tr>
        </table>
        <h2>Se connecter et réserver</h2>
        <div class='loginDiv'>
            <div class='left login' style="width: 45%;">
                <span>J'ai déjà un compte client </span>
                <input type="text" value="Pseudo" name="login" id='login' />
                <input type="text" value="Mot de passe" name="mdp" id='mdp' />
            </div>
            <div class="right nouveau">
                <span>Nouveau client ? Inscrivez-vous en quelques clics</span>
                <form id='nouveauClient' method="POST" action='../core/addUser.php'>
                  <input type='text' value="Nom" name="nom" id="nom" />
                  <input type='text' value="Prénom" name="prenom" id="prenom" />
                  <input type='text' value="Adresse" name="adresse" id="adresse" />
                  <input type='text' value="Email" name="email" id="email" />
                  <span class='help'>Votre facture vous sera envoyée par email.</span>
                  <input type='text' value="Téléphone" name="telephone" id="telephone" />
                  <span class='help'>Ecrire du type 0000000000.</span>
                  <div class="ajax-fc-container"></div>
                  <input id="submit" type="submit" name="submit" value="Do something!" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>