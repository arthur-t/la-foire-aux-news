<?php
/**
 * Created by PhpStorm.
 * User: Arthur
 * Date: 05/12/2017
 * Time: 16:29
 */

class FrontController
{


    function __construct()
    {
        global $rep;
        global $vues;

        $listeAction_Admin = array('deconnexion', 'supprimerNews', 'ajoutNews','changerNbNews','gererFlux','ajouterFlux','supprimerFlux');
        $mdlAdmin = new AdminModele();

        try {
            $a = $mdlAdmin->isAdmin();
            if(isset($_REQUEST['action'])&& !empty($_REQUEST['action']))
                $action = $_REQUEST['action'];
            else
                $action = 'nullAction';
            if (in_array($action, $listeAction_Admin)) {
                if ($a == null)
                    require($rep . $vues['vueAuthentification']);
                else
                    $controller = new ControllerAdmin();
            } else {

                $controller = new ControllerUser();
            }

        } catch (Exception $e) {
            require($rep . 'erreur.php');
        }
    }



}