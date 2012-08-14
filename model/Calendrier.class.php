<?php

class Calendrier {

    private $id;
    private $jour;
    private $mois;
    private $annee;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
       $this->id = $id;
    }

    public function getJour()
    {
        return $this->jour;
    }

    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    public function getMois()
    {
        return $this->mois;
    }

    public function setMois($mois)
    {
        $this->mois = $mois;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    public function save()
    {
        Connexion::getInstance();

        if($this->getId() == null)
        {
            $requete = 'INSERT INTO calendrier (mois, jour, annee) VALUES ("'.$this->getJour().'", "'.$this->getMois().'", "'.$this->getAnnee().'")';
            mysql_query($requete) or die(mysql_error());
        }
        else
        {
            $requete = 'UPDATE calendrier SET jour="'.$this->getJour().'", mois="'.$this->getMois().'", annee="'.$this->getAnnee().'" WHERE id='.$this->getId();
            mysql_query($requete) or die(mysql_error());
        }
    }
}

?>
