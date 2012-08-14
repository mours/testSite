<?php

class Reservation {

   private $id;
   private $id_chambre;
   private $id_etat;
   private $id_calendrier;
   private $id_client;
   private $created_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getChambre()
    {
        return $this->id_chambre;
    }

    public function setChambre($idChambre)
    {
        $this->id_chambre = $idChambre;
    }

    public function getEtat()
    {
        return $this->id_etat;
    }

    public function setEtat($idEtat)
    {
        $this->id_etat = $idEtat;
    }

    public function getCalendrier()
    {
        return $this->id_calendrier;
    }

    public function setCalendrier($idCal)
    {
        $this->id_calendrier = $idCal;
    }

    public function getClient()
    {
        return $this->id_client;
    }

    public function setClient($id_client)
    {
        $this->id_client = $id_client;
    }

    public function save()
    {
        Connexion::getInstance();

        if($this->getId() == null)
        {
            $requete = 'INSERT INTO reservation (id_chambre, id_etat, id_calendrier, id_client) VALUES ("'.$this->getChambre().'", "'.$this->getEtat().'", "'.$this->getCalendrier().'", "'.$this->getClient().'")';
            mysql_query($requete) or die(mysql_error());
        }
        else
        {
            $requete = 'UPDATE reservation SET id_chambre="'.$this->getChambre().'", id_etat="'.$this->getEtat().'", id_calendrier="'.$this->getCalendrier().'", id_client="'.$this->getClient().'" WHERE id='.$this->getId();
            mysql_query($requete) or die(mysql_error());
        }
    }

    public static function getIndisponibilitesByChambre($id_chambre)
    {
      Connexion::getInstance();

      $requete = "SELECT jour,mois,annee FROM reservation INNER JOIN calendrier ON reservation.id_calendrier = calendrier.id  WHERE id_chambre='".$id_chambre."' AND reservation.id_etat = 1 ";
      mysql_query($requete) or die(mysql_error());

      $reponse = array();
      while($resultat = mysql_fetch_object($requete))
      {
        $cal = new Calendrier();
        $cal->setJour($resultat->jour);
        $cal->setMois($resultat->mois);
        $cal->setAnnee($resultat->annee);
        $reponse[] = $cal;
      }

      return $reponse;
    }
}

?>