<?php

class WelcomeController
{
    public function __construct()
    {
    }

    /** fonction appelée par la route /simple */
    public function simple()
    {
        // Le controlleur peut directement "fournir" le code de la page à afficher
        ?>
        <html>
            <head>
                <style>
                    body, button {
                        font-family: "Helvetica Neue", sans-serif;
                        font-size: 36px;
                        font-weight: 200;
                        text-align: center;
                    }
                    button {
                        font-size: 18px;
                    }
                </style>
            </head>
            <body>
                <p>Petit annonce 👋</p>
                <p>Ce site representer la meilleur produit cosmatique en ligne 💻</p>
                <p>commandez-vous nos produit❤️</p>
                <p>A fond sur les meilleurs marques 👟</p>
            </body>
        </html>
        <?php
    }


    /** fonction appelée par la route /index */
    public function index()
    {
        // il est aussi possible de charger un fichier PHP qu'on appellera une "vue"
        require_once "views/index.php";
    }

    /** fonction appelée par la route /elements */
    public function annonce()
    {
        require_once "views/annonce.php";
    }

    /** fonction appelée par la route /generic */
    public function utilisateur()
    {
        require_once "views/utilisateur.php";
    }

    /** fonction appelée par la route /generic (vues fragmentées) */
    public function categorie()
    {
        require_once "views/categorie.php";
    }

    /** fonction appelée par la route /testjson */
    public function testjson()
    {
        // si on souhaite gérer des appels AJAX, on peut directement renvoyer du JSON, sans avoir besoin d'une vue
        $result = array("name" => "toto", "age" => 31, "country" => "France") ;
        echo json_encode($result);
    }

}
