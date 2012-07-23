<?php

class Connexion {

   private static $connexion = null;
   private $bdd = 'testSite';
   private $user = 'medi';
   private $mdp = 'medi';
   private $url = 'localhost';

   private function __construct(){
       self::$connexion = mysql_connect($this->url, $this->user, $this->mdp) OR die('Erreur de connexion');
       mysql_select_db($this->bdd) OR die('Sélection de la base impossible');
   }

   public static function getInstance(){
       if(self::$connexion == null)
       {
           new Connexion();
       }

       return self::$connexion;
   }
}

?>