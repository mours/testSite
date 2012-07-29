<?php

require_once('../fonction.php');
require_once('../model/Page.class.php');
require_once('../model/Connexion.class.php');

$newTitre = $_POST['newTitre'];
$content = $_POST['content'];
$idPrecedent = $_POST['idPrecedent'];

// On sauvegarde en base de données
$page = new Page();
$page->setTitre(secure($newTitre));
$page->setContent(secure($newTitre));
$page->setIdPrecedent($idPrecedent);
$page->save();

// Ajouter un message pour l'utilisateur 'la page a bien été ajoutée'

$retour['error'] = false;
$_SESSION['message'] = 'Votre page a bien été ajoutée au livre.';

return json_encode($retour);

?>