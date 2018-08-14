<?php
/**
 * Created by PhpStorm.
 * User: Arthur
 * Date: 19/12/2017
 * Time: 23:48
 */

class FluxModele
{
    function __construct(){

    }

    public static function get_all(){
        global $dsn;
        global $login;
        global $password;
        $gw = new FluxGateway(new Connection($dsn,$login,$password));
        $tab=$gw->requestAll();
        return $tab;
    }

    public static function add_flux($name,$link){
        global $dsn;
        global $login;
        global $password;
        Validation::Valid_site($name);
        Validation::Valid_lien($link);
        $gw = new FluxGateway(new Connection($dsn,$login,$password));

        $gw->insert($name,$link);
    }

    public static function delete_flux($link){
        global $dsn;
        global $login;
        global $password;
        Validation::Valid_lien($link);
        $gw = new FluxGateway(new Connection($dsn,$login,$password));
        $gw->delete($link);

    }


}