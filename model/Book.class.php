<?php

class Book {

   /*
    * On récupère toutes les pages de la bdd pour les mettre dans book.php pour construire la page
    */
    public static function getAllPages(){
    Connexion::getInstance();
    $requete = mysql_query('SELECT * FROM page');
    $retour = array();
    $i = 0;

    while($resultat = mysql_fetch_object($requete))
    {
        $maPage = new Page();
        $maPage->setTitre($resultat->titre);
        $maPage->setContent($resultat->content);
        $maPage->setCreatedAt($resultat->created_at);
        $maPage->setId($resultat->id);
        $retour[$i] = $maPage;
        $i++;
    }

        return $retour;
    }
}

?>