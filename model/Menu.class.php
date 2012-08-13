<?php

class Menu{

    protected $name;
    protected $idLien;
    protected $created_at;
    protected $id;

    public function getOnglets(){
        Connexion::getInstance();
        $requete = mysql_query('SELECT name, id_lien, titre, ordre FROM menu LEFT JOIN page ON menu.id_lien = page.id;');
        $retour = array();
        $i = 0;

        while($resultat = mysql_fetch_object($requete))
        {
           $retour[$i]['name'] = $resultat->name;
           $retour[$i]['lien'] = $resultat->id_lien;
           $retour[$i]['ordre'] = $resultat->ordre;
           $retour[$i]['titre'] = $resultat->titre;
           $i++;
        }

        return $retour;
    }

    public function getOngletById($id){
        Connexion::getInstance();
        $requete = mysql_query('SELECT name FROM menu WHERE id='.$id);
        $retour = array();

        while($resultat = mysql_fetch_object($requete))
            $retour[] = $resultat->name;

        return $retour;
    }

    public static function getOngletByName($name){
        Connexion::getInstance();
        $requete = mysql_query('SELECT name FROM menu WHERE name="'.$name.'"');

        $retour = array();

        while($resultat = mysql_fetch_object($requete))
            $retour[] = $resultat->name;

        return $retour;
    }

    /*
    * On sauvegarde en base de données et on change l'ordre des autres pages si cette dernière est intercalée.
    */
    public function save()
    {
        Connexion::getInstance();

        if($this->getId() == null)
        {
            $requete = 'INSERT INTO menu (name, id_lien) VALUES ("'.$this->getName().'", "'.$this->getIdLien().'")';
            mysql_query($requete) or die(mysql_error());
        }
        else
        {
            $requete = 'UPDATE menu SET name="'.$this->getName().'", id_lien="'.$this->getIdLien().'" WHERE id='.$this->getId();
            mysql_query($requete) or die(mysql_error());
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getIdLien()
    {
        return $this->id_lien;
    }

    public function setIdLien($id_lien)
    {
        $this->id_lien = $id_lien;
    }

    public function delete()
    {
       Connexion::getInstance();
       if($this->getId() != null)
       {
         mysql_query("DELETE FROM menu WHERE id = ".$this->getId());
       }
    }

    public static function getOngletObjectByName($name){
        Connexion::getInstance();
        $requete = mysql_query('SELECT * FROM menu WHERE name="'.$name.'"');

        while($resultat = mysql_fetch_object($requete)){
          $menu = new Menu();
          $menu->setName($resultat->name);
          $menu->setIdLien($resultat->id_lien);
          $menu->setId($resultat->id);

          return $menu;
        }
    }
}