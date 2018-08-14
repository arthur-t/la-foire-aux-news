<?php
/**
 * Created by PhpStorm.
 * User: Arthur
 * Date: 21/12/2017
 * Time: 15:07
 */

class ParserGateway
{
    private $con;
    function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function requestAll(){
        try{
            $query = "SELECT link,name FROM flux";
            $this->con->executeQuery($query);
            $fluxResults=$this->con->getResults();
            return $this->request($fluxResults);

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la récupération des flux RSS - Code d\'erreur '.$e->getCode());
        }
    }

    private function request($flux):array{

        $return=[];


        foreach ($flux as $row){

            $return[]= new Flux($row['name'],$row['link']);
        }

        return $return;
    }

    public function insert($id,$titre,$description,$datePub,$lien,$categorie){
        try {
            $query = "INSERT INTO News VALUES(:id,:titre,:description,:datePub,:lien)";
            $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR),
                ':titre' => array($titre, PDO::PARAM_STR),
                ':description' => array($description, PDO::PARAM_STR),
                ':datePub' => array($datePub, PDO::PARAM_STR),
                ':lien' => array($lien, PDO::PARAM_STR)));
            foreach ($categorie as $categ) {
                $query = "INSERT INTO NewsCateg VALUES(:id,:categ)";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR),
                    ':categ' => array($categ, PDO::PARAM_STR)));

            }
        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de l\'insertion d\'une news - Code d\'erreur '.$e->getCode());
        }
    }
}