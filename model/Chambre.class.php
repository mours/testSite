<?php

class Chambre {

  private $id;
  private $nom;
  private $prix;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
  }

  public function getPrix()
  {
    return $this->prix;
  }

  public function setPrix($prix)
  {
    $this->prix = $prix;
  }

    public function save()
    {
        Connexion::getInstance();

        if($this->getId() == null)
        {
            $requete = 'INSERT INTO chambre (titre, prix) VALUES ("'.$this->getNom().'", "'.$this->getPrix().'", "'.$this->getAnnee().'")';
            mysql_query($requete) or die(mysql_error());
        }
        else
        {
            $requete = 'UPDATE chambre SET titre="'.$this->getNom().'", prix="'.$this->getPrix().'" WHERE id='.$this->getId();
            mysql_query($requete) or die(mysql_error());
        }
    }
}
?>