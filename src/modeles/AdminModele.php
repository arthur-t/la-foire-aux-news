<?php


class AdminModele
{
    function __construct()
    {

    }

    public function connection($log,$pwd){
        global $dsn;
        global $login;
        global $password;

        Validation::Valid_identification($log,$pwd);

        $gw = new AdminGateway(new Connection($dsn,$login,$password));
        $admin=$gw->get_admin($log);


        if($admin!=null && password_verify($pwd,$admin->getHashPwd())) {
            $_SESSION['role'] = 'admin';
            $_SESSION['login'] = $log;
        }
        else{
            throw new Exception('Mot de passe incorrect');
        }


    }

    public function deconnexion(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function isAdmin(){
        if (isset($_SESSION['login'])&& isset($_SESSION['role'])){
            Validation::Valid_login($_SESSION['login']);
            Validation::Valid_hash($_SESSION['role']);

            return new Admin($_SESSION['login'],$_SESSION['role']);

        }
        else return null;
    }
}