<?php

require_once('../model/Page.class.php');
require_once('../model/Connexion.class.php');

// On récupère le nouveau titre et le nouveau contenu de la page
$titre = $_POST['titre'];
$content = $_POST['content'];
$id = $_POST['id'];
$id = strstr($id, '_', true);

// On sauvegarde en base de données
$mypage = Page::getPageById($id);
$mypage->setId($id);
$mypage->setContent(secure($content));
$mypage->setTitre(secure(trim($titre)));
$mypage->save();

$retour['error'] = false;
$retour['titre'] = trim($titre);

return json_encode($retour);
?>