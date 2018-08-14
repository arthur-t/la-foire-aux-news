<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/projet-php-tixier-tronche/css/authentification.css">
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/projet-php-tixier-tronche/index.php">La foire aux news</a>



        <a class="btn btn-primary" href="/projet-php-tixier-tronche/index.php">Retour</a>

    </nav>


    <br/>

    <div class="container-fluid ">
        <div class="row-fluid" >

        <h1>Identification</h1>
        <form method="POST" action="http://localhost/projet-php-tixier-tronche/index.php" id="connexionForm">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" name="pwd" >
                    </div>
                </div>
            </div>

            <input type="hidden" name="action" value="connexion">

            <button type="submit" form="connexionForm" class="btn btn-outline-primary btn-lg col justify-content-sm-center"  >Valider</button>


        </form>
        <?php
        if (isset ($msgErreur)){
            foreach ($msgErreur as $erreur){
                echo "<br/>";
                echo "<div class=\"alert alert-danger\">".$erreur."</div>";
            }
        }
        ?>
        </div>
    </div>


</head>
</html>