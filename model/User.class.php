<?php

class User {

    public function isAdmin($login, $password){

        $connexion = Connexion::getInstance();
        $requete = mysql_query('SELECT * FROM administrateur WHERE login="'.sha1(md5($login)).'" AND password ="'.sha1(md5($password)).'"');

        while($resultat = mysql_fetch_object($requete))
        {
            return true;
        }

        return false;
    }
}

?>