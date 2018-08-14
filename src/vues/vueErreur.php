<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/projet-php-tixier-tronche/css/authentification.css">


    <div class="container-fluid">

        <div class="row-fluid " >
            <h1 class="text-center">Une ou plusieurs erreurs sont survenues !</h1>
        <?php
        if (isset ($msgErreur)){
            foreach ($msgErreur as $erreur){
                echo "<br/>";
                echo "<div class=\"alert alert-danger\">".$erreur."</div>";
            }
        }
        ?>
            <br/>
            <br/>
            <div class="row justify-content-center">
                <a class="btn btn-primary btn-lg col col-3  " href="/projet-php-tixier-tronche/index.php">Retour au site</a>
            </div>
        </div>

    </div>


</head>
</html>