<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">La foire aux news</a>
        <?php

        if($admin!=null) {
            echo "<li class=\"navbar-brand\" >Bienvenue ".$admin->getLogin()."</li>";
            echo "<div class='row'>";
            echo "<a class=\"btn btn-primary \" href=\"?action=gererFlux\">Gérer flux</a>";
            echo "&nbsp;&nbsp;";
            echo "<a class=\"btn btn-primary \" href=\"?action=deconnexion\">Se déconnecter</a>";
            echo "&nbsp;&nbsp;";
            echo "<div>";
        }
        else{
            echo "<a class=\"btn btn-primary\" href=\"vues/vueAuthentification.php\">S'authentifier</a>";
        }
        ?>
    </nav>

    <br/><br/><br/><br/>



    <div class="container">
        <h1>News</h1>

        <br/>
        <form method="POST" action="http://localhost/projet-php-tixier-tronche/index.php" id="rechercheForm">
            <div class="form-group row justify-content-md-end">
                <?php
                    if($admin!=null) {
                    echo "
                        <div class=\"btn-group\">
                        <button type=\"button\" class=\"btn btn-secondary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        Nombre de news par page
                        </button>
                        
                        <div class=\"dropdown-menu dropdown-menu-right\">";
                        if($nb_news_page!=2)
                            echo "<a class=\"dropdown-item\" type=\"button\" href=\"?action=changerNbNews&nbNews=2\">2</a>";
                        if($nb_news_page!=5)
                            echo "<a class=\"dropdown-item\" type=\"button\" href=\"?action=changerNbNews&nbNews=5\">5</a>";
                        if($nb_news_page!=10)
                            echo "<a class=\"dropdown-item\" type=\"button\" href=\"?action=changerNbNews&nbNews=10\">10</a>";
                        if($nb_news_page!=15)
                            echo "<a class=\"dropdown-item\" type=\"button\" href=\"?action=changerNbNews&nbNews=15\">15</a>";
                         if($nb_news_page!=20)
                            echo "<a class=\"dropdown-item\" type=\"button\" href=\"?action=changerNbNews&nbNews=20\">20</a>";

                        echo"</div>
                        
                     </div>
                     
                    ";
                }
                ?>


                <div class="col-sm-4">
                    <input name="titreRecherche" type="text" class="form-control"  >
                </div>

                <button type="submit" form="rechercheForm" class="btn btn-outline-primary btn-sm col-sm-1"  >Recherche</button>



                <input type="hidden" name="action" value="rechercheNews">


            </div>


        </form>


        <br/>

        <?php

        if(empty($tab)){
            echo "<h1 class='alert alert-danger'>Aucun résultat pour votre recherche</h1>";
        }
        else {
            echo "<ul class=\"pagination\">";
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">';
                echo 'Prec </a></li>';

            }

            if($page!=1){
                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                if($page>3)
                    echo '<li class="page-item"><a class="page-link" >...</a></li>';
            }




                if($page>2) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page-1) . '">' . ($page-1) . "</a></li>";


                }

                echo '<li class="page-item"><strong><a class="page-link" href="?page=' . ($page) . '">' . $page . "</a></strong></li>";
                if($page<$nb_pages-1){
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page+1) . '">' . ($page+1) . "</a></li>";
                }
                if($page!=$nb_pages&&$nb_pages>1){
                    if($page<$nb_pages-2)
                        echo '<li class="page-item"><a class="page-link" >...</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($nb_pages) . '">' . $nb_pages . "</a></li>";
                }





            if ($page < $nb_pages) {

                echo '  <li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">';
                echo 'Suiv </a></li>';
            }

            echo '&nbsp;&nbsp;<ul class="pagination"><li class="page-item"><p class="page-link">page '.$page.'</p></li></ul>';
            echo "</ul>";




                foreach ($tab as $news) {


                    echo "<div class=\"rounded border p-3\"><a href=\"".$news->getLink()."\"><h2>";
                    echo $news->getTitle();
                    echo "</h2></a>";
                    echo "<br/><h3>".date('d/m/Y \à H:i',strtotime($news->getPubDate()))."</h3>";
                    echo '</br><p>'.$news->getDescription().'</p>';
                    $categories=$news->getCategory();
                    if (!empty($categories)) {

                        foreach ($categories as $categ) {
                             echo "<span class=\"badge badge-pill badge-secondary\">". $categ . "</span>";
                             echo "&nbsp;";
                        }

                    }
                    if($admin!=null){
                        echo "<br/><br/>";
                        echo "<a type=\"button\" class=\"btn btn-outline-danger btn-lg btn-block\" href=\"?action=supprimerNews&id=".$news->getId()."\">Supprimer</a>";
                    }
                    echo "</div>";
                    echo "<br/>";

                }

            echo "<ul class=\"pagination\">";
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">';
                echo 'Prec </a></li>';

            }

            if($page!=1){
                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                if($page>3)
                    echo '<li class="page-item"><a class="page-link" >...</a></li>';
            }




            if($page>2) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page-1) . '">' . ($page-1) . "</a></li>";


            }

            echo '<li class="page-item"><strong><a class="page-link" href="?page=' . ($page) . '">' . $page . "</a></strong></li>";
            if($page<$nb_pages-1){
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page+1) . '">' . ($page+1) . "</a></li>";
            }
            if($page!=$nb_pages&&$nb_pages>1){
                if($page<$nb_pages-2)
                    echo '<li class="page-item"><a class="page-link" >...</a></li>';
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($nb_pages) . '">' . $nb_pages . "</a></li>";
            }





            if ($page < $nb_pages) {

                echo '  <li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">';
                echo 'Suiv </a></li>';
            }

            echo '&nbsp;&nbsp;<ul class="pagination"><li class="page-item"><p class="page-link">page '.$page.'</p></li></ul>';
            echo "</ul>";
            }

        ?>

    </div>
    <?php
    if($admin!=null) {
        echo "<div class='container'>
<div class=\"jumbotron  justify-content-md-center\">
         <div class='row'>
         
         <div class='col-md justify_content-md-center'>
        <div class='h1 row justify-content-md-center'>Nouvelle News</div>
        <br/>
        <form method=\"POST\" action=\"http://localhost/projet-php-tixier-tronche/index.php\" id=\"ajoutNewsForm\">


            <div class=\"form-group row justify-content-md-center\">
                <label for=\"titre\" class=\"col-sm-1 col-form-label\">Titre</label>
                <div class=\"col-sm-8\">
                    <input name=\"titre\" type=\"text\" class=\"form-control\"  >
                </div>
            </div>
            <div class=\"form-group row justify-content-md-center\">
                <label for=\"description\" class=\"col-sm-1 col-form-label\">Description</label>
                <div class=\"col-sm-8\">
                    <input name=\"description\" type=\"text\" class=\"form-control\"  >
                </div>
            </div>
            <div class=\"form-group row justify-content-md-center\">
                <label for=\"lien\" class=\"col-sm-1 col-form-label\">Lien</label>
                <div class=\"col-sm-8\">
                    <input name=\"lien\" type=\"text\" class=\"form-control\"  >
                </div>
            </div>
            <div class=\"form-group row justify-content-md-center\">           
                <label for=\"categorie\" class=\"col-sm-1 col-form-label\">Categorie</label>
                <div class=\"col-sm-8\">
                    <input name=\"categorie\" type=\"text\" class=\"form-control\"  >
                </div>
            </div>


            <input type=\"hidden\" name=\"action\" value=\"ajoutNews\">





        </form>
        <br/>
        <button type=\"submit\" form=\"ajoutNewsForm\" class=\"btn btn-info btn-lg btn-block\"  >Valider</button>
        
    </div>
    
    </div>
    </div>
    </div>";
    }

    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</head>
</html>