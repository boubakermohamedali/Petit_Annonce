<?php
session_start();
/***** REQUIRES/INCLUDES *****/
// Chargement du framework Medoo
include_once ("./librairies/medoo/Medoo.php");
// Chargement du framework de routage PHP Router
require_once __DIR__.'/librairies/phprouter/router.php';



/***** SETTINGS/CONSTANTES *****/
define("ROOT_DIR", "mvc") ; // répertoire racine TODO à définir selon le nom de votre projet (dossier qui suit "localhost")
// On définit les différents modes d'accès aux données
define("PDO", 0) ; // connexion par PDO
define("MEDOO", 1) ; // Connexion par Medoo
// Choix du mode de connexion
define("DB_MANAGER", MEDOO); // TODO choisissez entre PDO ou MEDOO
// Création de deux constantes URL et FULL_URL qui pourront servir dans les controlleurs et/ou vues
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define("FULL_URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]/{$_SERVER['REQUEST_URI']}"));


/******** HELPERS *********/
// inclusion des helpers contenant des fonctions utilisables dans toutes les vues
require_once "helpers/string_helper.php";

/******** CONTROLLERS *********/
// inclusion des controllers (TODO ajoutez les vôtres)
require_once "controllers/WelcomeController.php";
require_once "controllers/UsersController.php";


/****** ROUTING *********/
// Réalisation du système de routage
// le fichier .htccess effectue une redirection automatique depuis l'url /nom_de_la_route vers index.php
// On utilise ensuite le micro-framework PHP Router pour gérer les routes


// Pour les routes GET on utilise la fonction get()
// Pour invoquer un contrôleur on crée un callback
get('/allusers', function(){
    $controller = new UsersController();
    $controller->display_all_users();
});


get('/elements', function(){
    $controller = new WelcomeController();
    $controller->elements();
});

get('/generic', function(){
    $controller = new WelcomeController();
    $controller->generic();
});

get('/generic2', function(){
    $controller = new WelcomeController();
    $controller->generic2();
});

get('/testjson', function(){
    $controller = new WelcomeController();
    $controller->testjson();
});

get('/elements', function(){
    $controller = new WelcomeController();
    $controller->elements();
});

get('/index', function(){
    $controller = new WelcomeController();
    $controller->index();
});

get('/home', function(){
    $controller = new WelcomeController();
    $controller->index();
});

get('/', function(){
    $controller = new WelcomeController();
    $controller->index();
});

