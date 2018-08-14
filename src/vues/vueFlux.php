<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <nav class="navbar navbar-dark bg-dark fixed-top ">
        <a class="navbar-brand" href="/projet-php-tixier-tronche/index.php">La foire aux news</a>
        <?php
        if($admin!=null) {
            echo "<li class=\"navbar-brand \" >Bienvenue " . $admin->getLogin() . "</li>";
        }
        ?>


        <a class="btn btn-primary" href="/projet-php-tixier-tronche/index.php">Retour</a>

    </nav>
    <?php
    if($admin!=null) {

        echo "
    

    


    <br/><br/><br/><br/>


    <div class=\"container \">
      
        <div class=\"row-fluid\" >

            <h1>Ajouter un flux RSS</h1>
            <form method=\"POST\" action=\"http://localhost/projet-php-tixier-tronche/index.php\" id=\"fluxForm\">
                <div class=\"row\">
                    <div class=\"col\">
                        <div class=\"form-group\">
                            <label for=\"name\">Nom du site</label>
                            <input type=\"text\" class=\"form-control\" name=\"name\" >
                        </div>
                    </div>
                    <div class=\"col\">
                        <div class=\"form-group\">
                            <label for=\"link\">Lien du flux</label>
                            <input type=\"url\" class=\"form-control\" name=\"link\" >
                        </div>
                    </div>
                </div>

                <input type=\"hidden\" name=\"action\" value=\"ajouterFlux\">

                <button type=\"submit\" form=\"fluxForm\" class=\"btn btn-outline-primary btn-lg col justify-content-sm-center\"  >Valider</button>


            </form>
            
        </div>
    </div>";
        echo "<br/><br/>";
        echo "<div class='container'>";
        echo "<h2>Liste des flux</h2>";
        if(!empty($tab)){
            foreach ($tab as $flux) {


                echo "<div class=\"rounded border p-3 row\"><a class='col col-4' href=\"".$flux->getLink()."\"><h4>";
                echo $flux->getName();
                echo "</h4></a>";
                echo "<h6 class='col col-6'><a href='".$flux->getLink()."'>".$flux->getLink()."</a></h6>";
                echo "<a type=\"button\" class=\"btn btn-outline-danger btn-md col col-2\" href=\"?action=supprimerFlux&link=".$flux->getLink()."\">Supprimer</a>";

                echo "</div>";

                echo "<br/>";

            }
            echo "</div>";

        }
        else{
            echo "<br/><br/><br/><h3 class='text-center alert alert-secondary'>Vous n'avez pas de flux</h3>";
        }
    }
    else{
        echo "<h1>Vous n'êtes pas censé vous trouver ici !</h1>";
    }
    ?>



</head>
</html>