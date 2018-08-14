<?php


class AdminGateway
{
    private $con;
    function __construct(Connection $con){
        $this->con=$con;
    }

    public function get_admin($login){
        try{
            $query = "SELECT login, password FROM Admin WHERE :login=login";

                $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR)));

                $results = $this->con->getResults();

            if(empty($results)){

                throw new Exception("Erreur d'identification <br/>Veuillez vérifier vos identifiants");
            }
            return new Admin($results[0]['login'], 'admin', $results[0]['password']);

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de l\'admin - Code d\'erreur '.$e->getCode());
        }



    }

    public function check_admin($login,$pwd):bool {
        try{

            $query= "select count(1) from Admin where login = :login and password=:pwd";
            $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR),
                                                    ':pwd' => array($pwd, PDO::PARAM_STR)));
            var_dump($this->con->getResults());
            return $this->con->getResults();
        }
        catch (PDOException $e) {
            throw new Exception('Erreur en base de données lors de la vérification du mot de passe - Code d\'erreur ' . $e->getCode());
        }
    }
}