<?php
//préfixe
$rep=__DIR__.'/../';
// liste des modules à inclure (pas obligatoire)
$dConfig['includes']= array('controlers/Validation.php');

//Vues
$vues['vueConnexion']='vues/vueConnexion.php';
$vues['vueErreur']='vues/vueErreur.php';
$vues['vueAuthentifie']='vues/vueAuthentifie.php';
$vues['vueNews']='vues/vueNews.php';
$vues['vueAuthentification']='vues/vueAuthentification.php';
$vues['vueFlux']='vues/vueFlux.php';
//PDO

$dsn = "mysql:host=localhost;dbname=dbartronche";

$login="root";

$password="";
