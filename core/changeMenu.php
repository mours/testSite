<?php

require_once('../model/Menu.class.php');
require_once('../model/Page.class.php');
require_once('../model/Connexion.class.php');
require_once('../fonction.php');

if(isset($_POST['dataTab'])) {
    $data = $_POST['dataTab'];
    $dataTab = explode(';',$data);

    foreach($dataTab as $index => $li)
    {
      $item = explode('_', $li);
      $titre = $item[0];
      $lien = $item[1];

      // on enlève les espaces
      $titre = trim($titre);

      // on sauvegarde en base le titre et l'url
      $menu = new Menu();
      $menu->setId($index+1);
      $menu->setIdLien($lien);
      $menu->setName($titre);
      $menu->save();
    }
}
elseif(isset($_POST['liste']))
{
    $data = array();

    // on récupère dans la base de données toutes les pages
    if($_POST['liste'])
    {
      $mesPages = Page::getAllPages();

      foreach($mesPages as $page)
        $data[] = array('id' => $page->getId(), 'titre' => $page->getTitre());
      $data['nb'] = count($mesPages);

      echo json_encode($data);
    }
}
elseif(isset($_POST['add']) && $_POST['add'])
{
  $idLien = $_POST['idLien'];
  $titre = $_POST['titre'];

  $li = new Menu();
  $li->setName(secure($titre));
  $li->setIdLien($idLien);
  $li->save();
}
elseif(isset($_POST['remove']) && $_POST['remove'])
{
  $val = $_POST['val'];
  $tab = explode('_',$val);
  $titreLi = $tab[0];
  $href = $tab[1];

  $onglet = Menu::getOngletObjectByName($titreLi);
  $onglet->delete();
}
?>