<?php

class NewsModele
{



    function __construct(){

    }


    public static function get_all($premiere_news=1,$nb_news_page=5){
        global $dsn;
        global $login;
        global $password;
        $gw = new NewsGateway(new Connection($dsn,$login,$password));

        $tab=$gw->requestAllByPage($premiere_news,$nb_news_page);

        return $tab;
    }

    public static function get_titre($titre){
        global $dsn;
        global $login;
        global $password;

        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $tab=$gw->requestByTitle($titre);
        return $tab;



        /*if(Validation::Valid_name($titre)){
            $tab = $this->gw->requestByTitle($recherche);

        }

        */
    }

    public static function get_nb_news(){
        global $dsn;
        global $login;
        global $password;
        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $nb_news=$gw->countNews();
        return $nb_news;
    }



    public static function add_news($titre,$description,$lien,$categorie,$datePub=null){
        global $dsn;
        global $login;
        global $password;
        Validation::Valid_news($titre,$description,$lien);
        foreach ($categorie as $categ){
            Validation::Valid_categorie($categ);

        }
        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $id=uniqid();
        if($datePub==null)
            $datePub=date('Y-m-d H:i');


        else{
            $datePub=date('Y-m-d H:i',strtotime($datePub));


        }
        $gw->insert($id,$titre,$description,$datePub,$lien,$categorie);
    }

    public static function add_all_news($tabNews){
        global $dsn;
        global $login;
        global $password;
        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        foreach ($tabNews as $news){
            Validation::Valid_news($news->getTitle(),$news->getDescription(),$news->getLink());
            $id=uniqid();
            $pubDate=$news->getPubDate();
            if($pubDate==null)
                $pubDate=date('Y-m-d H:i');


            else{
                $pubDate=date('Y-m-d H:i',strtotime($pubDate));


            }

            $gw->insert($id,$news->getTitle(),$news->getDescription(),$pubDate,$news->getLink(),$news->getCategory());

        }
    }



    public static function suppr_news($id){
        global $dsn;
        global $login;
        global $password;

        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $gw->delete($id);
    }

    public static function suppr_all_news(){
        global $dsn;
        global $login;
        global $password;

        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $gw->deleteAll();
    }

    public static function change_nb_news($nbNews){
        global $dsn;
        global $login;
        global $password;
        Validation::Valid_nb_pages($nbNews);
        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $gw->setNbNews($nbNews);
    }

    public static function get_nb_news_page(){
        global $dsn;
        global $login;
        global $password;
        $gw = new NewsGateway(new Connection($dsn,$login,$password));
        $nb_news_page=$gw->getNbNews();
        return $nb_news_page;
    }



}