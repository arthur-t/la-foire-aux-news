<?php

/**
 * Created by PhpStorm.
 * User: artronche
 * Date: 01/12/17
 * Time: 13:36
 */
class ControllerAdmin
{
    function __construct()
    {

        switch($_REQUEST['action']) {

            case "deconnexion" :
                $this->Deconnexion();
                break;
            case "supprimerNews" :
                $this->SuppressionNews();
                break;
            case "ajoutNews" :
                $this->AjoutNews();
                break;
            case "changerNbNews" :
                $this->ChangerNbNews();
                break;
            case "gererFlux" :
                $this->GererFlux();
                break;
            case "ajouterFlux" :
                $this->AjouterFlux();
                break;
            case "supprimerFlux" :
                $this->SupprimerFlux();
                break;

        }

    }

    function Deconnexion(){
        global $rep;
        global $vues;
        try {
            $adminMdl = new AdminModele();
            $adminMdl->deconnexion();
            require($rep . $vues['vueAuthentification']);
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }

    function AjoutNews(){
        global $rep;
        global $vues;
        try{
            $categ[]=$_REQUEST['categorie'];
            NewsModele::add_news($_REQUEST['titre'],$_REQUEST['description'],$_REQUEST['lien'],$categ);

            $ctrlUser= new ControllerUser();
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }

    function SuppressionNews(){
        global $rep;
        global $vues;
        try{
            NewsModele::suppr_news($_REQUEST['id']);
            $ctrlUser= new ControllerUser();
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }

    function ChangerNbNews(){
        global $rep;
        global $vues;
        try{
            NewsModele::change_nb_news(intval($_REQUEST['nbNews']));
            $ctrlUser= new ControllerUser();
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }

    function GererFlux(){
        global $rep;
        global $vues;
        try{
            $admin = (new AdminModele())->isAdmin();
            $tab=FluxModele::get_all();
            require($rep.$vues['vueFlux']);
        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }

    function AjouterFlux(){
        global $rep;
        global $vues;
        try{
            FluxModele::add_flux($_REQUEST['name'],$_REQUEST['link']);
            $tab=FluxModele::get_all();
            $admin = (new AdminModele())->isAdmin();
            require($rep.$vues['vueFlux']);

        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }

    function SupprimerFlux(){
        global $rep;
        global $vues;
        try{
            FluxModele::delete_flux($_REQUEST['link']);
            $tab=FluxModele::get_all();
            $admin=(new AdminModele())->isAdmin();
            require($rep.$vues['vueFlux']);

        }
        catch (Exception $e){
            $msgErreur[]=$e->getMessage();
            require($rep.$vues['vueErreur']);
        }
    }




}