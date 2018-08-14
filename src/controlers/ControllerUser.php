<?php

/**
 * Created by PhpStorm.
 * User: artronche
 * Date: 24/11/17
 * Time: 14:18
 */
class ControllerUser
{



    function __construct()
    {
        if(!(isset($_REQUEST['action'])&& !empty($_REQUEST['action'])));
            $_REQUEST['action']="nullAction";
        switch($_REQUEST['action']) {
            case NULL :
                $this->Reinit();
                break;
            case "nullAction" :
                $this->Reinit();
                break;
            case "connexion" :
                $this->Connexion();
                break;
            case "rechercheNews" :
                $this->AfficherPageTitre();
                break;
            default :
                $this->Reinit();
                break;
        }
    }
    
        

    function Reinit(){
        global $rep;
        global $vues;

        $this->AfficherPage();
    }

    function Connexion(){
        global $rep;
        global $vues;
        try{
            $adminMdl=new AdminModele();
            $adminMdl->connection($_REQUEST['login'],$_REQUEST['pwd']); // Login : artronche  MDP : motdepasse
            $this->AfficherPage();
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueAuthentification']);
        }
    }

    function AfficherPage(){
        global $rep;
        global $vues;

        try{
            $nb_news=NewsModele::get_nb_news();
            $nb_news_page=NewsModele::get_nb_news_page();

            $page=(isset($_GET['page']))?abs(intval($_GET["page"])):1;

            //met la page 1 par défaut.
            $page=($page==0)?1:$page;

            //récupère le numéro de la première news de la page
            $premiereNews=($page-1)*$nb_news_page;
            $nb_pages=intval(ceil($nb_news/$nb_news_page));

            $tab=NewsModele::get_all($premiereNews,$nb_news_page);
            $admin = (new AdminModele())->isAdmin();
            require ($rep.$vues['vueNews']);
        }
        catch (Exception $e){
                $msgErreur[]=$e->getMessage();
                require($rep.$vues['vueErreur']);
        }
    }






    function AfficherPageTitre(){
        global $rep;
        global $vues;
        try {
            //met la page 1 par défaut.
            $page=1;

            //récupère le numéro de la première news de la page

            $nb_pages=1;

            $recherche = $_REQUEST['titreRecherche'];
            if(isset($recherche)&&trim($recherche)!='') {

                $tab = NewsModele::get_titre($recherche);
                $admin = (new AdminModele())->isAdmin();
                require($rep . $vues['vueNews']);
            }
            else{
                $this->AfficherPage();
            }
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }

    }


    function RechercheNews(){
        global $rep;
        global $vues;
        try{

            $recherche=$_REQUEST['titreRecherche'];
            $tab=NewsModele::get_titre($recherche);
            $this->AfficherPage($tab);
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }


}