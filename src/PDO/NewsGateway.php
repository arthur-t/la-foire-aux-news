<?php


class NewsGateway
{
    private $con;
    function __construct(Connection $con)
    {
        $this->con=$con;
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

    public function delete($id){
        try{
            $query = "DELETE FROM News WHERE id=:id";
            $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la suppression d\'une news - Code d\'erreur '.$e->getCode());
        }
    }

    public function deleteAll(){
        try{
            $query = "DELETE FROM News";
            $this->con->executeQuery($query);

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la suppression de la totalité des news - Code d\'erreur '.$e->getCode());
        }
    }

    public function setNbNews($nbNews){
        try{
            $query = "UPDATE nbnews SET currentNumber=:nbNews";
            $this->con->executeQuery($query, array(':nbNews' => array($nbNews, PDO::PARAM_INT)));

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la mise à jour du nombre de news par page - Code d\'erreur '.$e->getCode());
        }



    }

    public function getNbNews(){
        try{
            $query = "SELECT currentNumber FROM nbnews";
            $this->con->executeQuery($query);
            return intval($this->con->getResults()[0][0]);

        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la récupération du nombre de news par page - Code d\'erreur '.$e->getCode());
        }



    }

    public function requestByTitle($titre) : array{
        try {
            $titre = "%" . $titre . "%";
            $query = "SELECT id,titre,description,datePub,lien FROM News WHERE titre LIKE :titre ORDER BY datePub DESC";
            $this->con->executeQuery($query, array(':titre' => array($titre, PDO::PARAM_STR)));
            $newsResults=$this->con->getResults();
            return $this->request($newsResults);
        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la requête d\'une news avec le titre'.$titre.' - Code d\'erreur '.$e->getCode());
        }
    }
    public function requestNews(){
        try{
            $query = "SELECT id,titre,description,datePub,lien FROM News ";
            $this->con->executeQuery($query);
            $newsResults=$this->con->getResults();
            return $this->request($newsResults);
        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la récupération des news - Code d\'erreur '.$e->getCode());
        }
    }

    public function requestAllByPage($premiere_news,$nb_news_page){
        try{

            $query = "SELECT id,titre,description,datePub,lien FROM News ORDER BY datePub DESC LIMIT :premiere_news , :nb_news_page";
            $this->con->executeQuery($query, array(':premiere_news' => array($premiere_news, PDO::PARAM_INT),
                ':nb_news_page' => array($nb_news_page, PDO::PARAM_INT)));
            $newsResults=$this->con->getResults();
            return $this->request($newsResults);
        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la récupération de news pour une page - Code d\'erreur '.$e->getCode());
        }
    }


    public function countNews(){
        try{

            $query ="SELECT COUNT(*) FROM News";
            $this->con->executeQuery($query);

            return intval((($this->con->getResults())[0])[0]);
        }
        catch (PDOException $e){
            throw new Exception('Erreur en base de données lors de la récupération du nombre de news - Code d\'erreur '.$e->getCode());
        }
    }

    private function request($news):array{

        $return=[];


        foreach ($news as $row){
            $new= new News($row['id'],$row['titre'],$row['description'],$row['datePub'],$row['lien']);
            $query = "SELECT id_news,name_categ FROM newscateg WHERE :id=id_news";
            $this->con->executeQuery($query,array(':id' => array($row['id'], PDO::PARAM_STR)));
            $categResults=$this->con->getResults();
            foreach ($categResults as $categ){
                $new->addCategory($categ['name_categ']);
            }
            $return[]= $new;
        }

        return $return;
    }



}

