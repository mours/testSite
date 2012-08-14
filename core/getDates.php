<?php
  require_once('../model/Reservation.class.php');
require_once('../model/Connexion.class.php');

  if(isset($_POST['idPage']))
  {
    $idPage = $_POST['idPage'];
    $tabCal = Reservation::getIndisponibilitesByChambre($idPage);

    $data = array();
    foreach($tabCal as $cal)
    {
      $data[] = $cal->getJour.'/'.$cal->getMois.'/'.$cal->getAnnee();
    }
    echo json_encode($data);
  }

?>