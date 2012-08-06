<?php

class Menu{

    public function getOnglets(){
        Connexion::getInstance();
        $requete = mysql_query('SELECT name, id_lien, titre FROM menu RIGHT JOIN page ON menu.id_lien = page.id ORDER BY ordre;');
        $retour = array();
        $i = 0;

        while($resultat = mysql_fetch_object($requete))
        {
           $retour[$i]['name'] = $resultat->name;
           $retour[$i]['lien'] = $resultat->id_lien;
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

    public function getOngletByName($name){
        Connexion::getInstance();
        $requete = mysql_query('SELECT name FROM menu WHERE name='.$name);
        $retour = array();

        while($resultat = mysql_fetch_object($requete))
            $retour[] = $resultat->name;

        return $retour;
    }
}