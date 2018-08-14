<?php
/**
 * Created by PhpStorm.
 * User: Arthur
 * Date: 19/12/2017
 * Time: 23:49
 */

class FluxGateway
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

    public function delete($link){
        try{
            $query = "DELETE FROM flux WHERE link=:link";
            $this->con->executeQuery($query, array(':link' => array($link, PDO::PARAM_STR)));

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la suppression d\'un flux RSS - Code d\'erreur '.$e->getCode());
        }
    }

    public function insert($name,$link){
        try{
            $query = "INSERT INTO flux VALUES(:link,:name)";
            $this->con->executeQuery($query, array(':link' => array($link, PDO::PARAM_STR),
                ':name' =>array($name,PDO::PARAM_STR)));

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la récupération d\'un flux RSS - Code d\'erreur '.$e->getCode());
        }
    }

    private function request($flux):array{

        $return=[];


        foreach ($flux as $row){

            $return[]= new Flux($row['name'],$row['link']);
        }

        return $return;
    }
}