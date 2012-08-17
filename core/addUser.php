<?php

require_once('../fonction.php');
require_once('../model/User.class.php');

// On récupère les bonnes données
$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);
$adresse = trim($_POST['adresse']);
$email = trim($_POST['email']);
$tel = trim($_POST['telephone']);

$pattern_lettres = '/^[a-zA-Z]+$/';
$pattern_email = '/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$/';
$pattern_tel = '/^0\d{9}$/';

if(preg_match($pattern_lettres,$nom) && preg_match($pattern_lettres,$prenom) && preg_match($pattern_email,$email) && preg_match($pattern_tel,$tel))
{
   $user = new User();
   $user->setNom(secure($nom));
   $user->setPrenom(secure($prenom));
   $user->setAdresse(secure($adresse));
   $user->setEmail(secure($email));
   $user->setTelephone(secure($tel));
   $user->setPseudo($user->generatePseudo());
   $user->setMdp(sha1(md5($user->generateMdp())));

   $user->generateCle();
   $user->envoiMail();
   $user->save();
}
else
    echo "erreur";
?>