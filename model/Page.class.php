<?php

class Page {

    protected $titre;
    protected $content;
    protected $created_at;
    protected $id;

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getContent()
    {
        return $this->content;
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
        $retour = array();
        $i = 0;

        while($resultat = mysql_fetch_object($requete))
        {
            $retour[$i]['titre'] = $resultat->titre;
            $retour[$i]['content'] = $resultat->content;
            $i++;
        }
    }

    public static function updatePage($id, $content, $titre)
    {
        Connexion::getInstance();
        $requete = mysql_query('SELECT * FROM page WHERE id='.$id);
        $retour = array();
        $i = 0;

        while($resultat = mysql_fetch_object($requete))
        {
            $retour[$i]['titre'] = $resultat->titre;
            $retour[$i]['content'] = $resultat->content;
            $i++;
        }
    }

}