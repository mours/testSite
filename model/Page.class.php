<?php

class Page {

    protected $titre;
    protected $content;
    protected $created_at;
    protected $id;
    protected $ordre;
    protected $idPrecedent;

    public function getTitre()
    {
        return $this->titre;
    }

    public function setIdPrecedent($idPrecedent)
    {
        Connexion::getInstance();
        $requete = mysql_query('SELECT ordre FROM page WHERE id='.$idPrecedent);

        while($resultat = mysql_fetch_object($requete))
        {
          $this->setOrdre($resultat->ordre+1);
        }

        $this->idPrecedent = $idPrecedent;
    }

    public function getIdPrecedent()
    {
        return $this->idPrecedent;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    }

    public function getOrdre()
    {
        return $this->ordre;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public static function getPageById($id)
    {
        Connexion::getInstance();
        $requete = mysql_query('SELECT * FROM page WHERE id='.$id);

        while($resultat = mysql_fetch_object($requete))
        {
            $myPage = new Page();
            $myPage->setTitre($resultat->titre);
            $myPage->setContent($resultat->content);
        }

        return $myPage;
    }

   /*
    * On sauvegarde en base de données et on change l'ordre des autres pages si cette dernière est intercalée.
    */
    public function save()
    {
        Connexion::getInstance();
        $lastOrdre = self::getLastPage();

        if($this->ordre != ($lastOrdre + 1))
          self::changeOrdre($this->getOrdre());

        if($this->getId() == null)
        {
           $requete = 'INSERT INTO page (titre, content, ordre) VALUES ("'.$this->getTitre().'", "'.$this->getContent().'", "'.$this->getOrdre().'")';
           mysql_query($requete) or die(mysql_error());
        }
        else
        {
            $requete = 'UPDATE page SET titre="'.$this->getTitre().'", content="'.$this->getContent().'", "'.$this->getOrdre().'" WHERE id='.$this->getId();
            mysql_query($requete) or die(mysql_error());
        }
    }

    public static function getLastPage()
    {
      Connexion::getInstance();
      $requete = mysql_query('SELECT ordre FROM page ORDER BY ordre desc LIMIT 1');

      while($resultat = mysql_fetch_object($requete))
      {
        return $resultat->ordre;
      }

      return null;
    }

    public static function getAllPages()
    {
       Connexion::getInstance();
       $requete = mysql_query('SELECT * FROM page ORDER BY ordre asc');

       $tab = array();
       while($resultat = mysql_fetch_object($requete))
       {
          $page = new Page();
          $page->setTitre($resultat->titre);
          $page->setContent($resultat->content);
          $page->setId($resultat->id);
          $page->setCreatedAt($resultat->created_at);
          $tab[] = $page;
       }

       return $tab;
    }

    public static function changeOrdre($nouvelOrdre)
    {
       // On trie les pages par ordre croissant
       $requete = 'UPDATE page SET ordre = ordre+1 WHERE ordre >= '.$nouvelOrdre;
       mysql_query($requete) or die(mysql_error());
    }
}