<?php

// Import des connexion
require_once 'connexion.php';

// Pour éviter de dupliquer le code, ce formulaire sera utiliser pour créer ou modifier un abo. Si l'url est appelée avec id= alors nous l'utiliserons pour éditer l'abo avec l'id spécifié. 
if (isset($_GET['id_categorie'])) {
    // récupérer $id dans les paramètres d'URL
    $id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_SANITIZE_NUMBER_INT);

    // Charger les informations de l'abo depuis la BDD pour remplir le formulaire
    try {
        // Se connecter à la BDD avec la fonction connect() définie dans functions.php
        $db = connect();

        // Préparer $aboQuery pour récupérer les informations de l'abo
        $aboQuery = $db->prepare('SELECT * FROM categories WHERE id_categorie= id_categorie');
        // Exécuter la requête
        $aboQuery->execute(['id_categorie' => $id_categorie]);
        // Récupérer les données et les assigner à $abo
        $abo = $aboQuery->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Afficher le message s'il y a une exception
        echo $e->getMessage();
    }

    // Fermer la connection à la BDD
    $aboQuery=null;
    $db=null;
}

// Récupérer les categories 
$categorie = getCategorie();

?>

<?php require_once 'header.php' ?>
<div class='row'>
    <div class='jumbotron bg-light m-2 p-2'>
        <h1 class='display-4'>Bienvenue au petit annonce!</h1>
        <header>
          <a href="index.php"><img src="images/pinterest.png" alt="petit_annonce!"></a>
        </header>
        <br>
        <p class='lead'>Ici vous pouvez gérer les abonnement pour le très exclusif petit annonce !</p>
        <hr class='my-4'>
        <p>Cliquer sur un des boutons ci-dessous pour obtenir une liste des membres ou des types categorie</p>
        <br><br/>
        <p class='lead'>
        <a href='index.php' class='btn btn-secondary m-2 active' role='button'>Accueil</a>
        <a href='annonces.php' class='btn btn-secondary m-2 active' role='button'>Annonces</a>
        <a href='categorie.php' class='btn btn-secondary m-2 active' role='button'>Categories</a>
        <a href='members.php' class='btn btn-secondary m-2 active' role='button'>Membres</a>
        <a href='utilisateurs.php' class='btn btn-secondary m-2 active' role='button'>Utilisateurs</a>
        <a href='login.php' class='btn btn-secondary m-2 active' role='button'>Contacts</a>
        </p>
    </div>
</div>
<br>
<br>
<br/>
<div class='row'>
    <h1 class='col-md-12 text-center border border-dark bg-primary text-white'>Categories</h1>
</div>
<br/>
<div class='row'>
    <form method='post' action='add-categorie.php'>
        <!--  Ajouter un champs cacher avec l'ID (s'il existe) pour qu'il soit envoyé avec le formulaire -->
        <input type='hidden' name='id_categorie' value='<?= $abo['id_categorie'] ?? '' ?>'>
        <br/>
        <div class='form-group my-3'>
            <br/>
            <label for='firstName'>nom_categorie</label>
            <br/>
            <input type='text' name='nom_categorie' class='form-control' id='nom_categorie' placeholder='Enter nom_categorie' required autofocus value='<?= isset($abo['nom_categorie']) ? htmlentities($abo['nom_categorie']) : '' ?>'>
            <br>
        </div>
        <br>
        <div class='form-group my-3'>
            <br/>
            <label for='description_categorie'>description_categorie</label>
            <br/>
            <input type='number' name='description_categorie' class='form-control' id='description_categorie' placeholder='Enter description_categorie' required value='<?= isset($abo['description_categorie']) ? htmlentities($abo['description_categorie'])  : '' ?>'>
            <br/>
        </div>
        <br/>
        <button type='submit' class='btn btn-primary my-3' name='submit'>Envoyer</button>
        <br/>
    </form>
</div>
<br/>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="base.css" />
    <link rel="stylesheet" href="book.css" />
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="index.css" />
    <link href="style.css" rel="stylesheet">
    <link id="codyframe" rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <title>Connexion | petit annonce</title>
</head>
<br><br><br>
        <!-- /**** Footer ****/ -->
<footer>
  <div class="partenaires">
    <h5>Site partenaires</h5>
    <a href="https://www.amazon.fr">Amazon</a>
    <a href="https://www.fnac.com/">Fnac</a>
    <a href="https://www.ebay.fr/">Ebay</a>
    <a href="https://www.waterstones.com">Waterstones</a>
  </div>
  <div class="center">
    <div class="coordonner">
      <img src="./image/logo.png" alt="">
      <a href="">22 Avenue lamartine</a>
      <a href="">06000 Nice</a>
      <a href="">04 92 63 53 43</a>
    </div>
    <div class="reseau">
      <a href="https://www.facebook.com/"><img src="images/facebook.png" alt=""></a>
        <a href="https://www.twitter.com"><img src="images/twitter.png" alt=""></a>
        <a href="https://www.instagram.com/"><img src="images/insta.png" alt=""></a>
    </div>
  </div>
  <div class="dons">
    <h5>Faites un don</h5>
    <button class="btn"> <a href="PDF/COFFEE_SHOP.pdf" download="Annonces">Télécharger le produit en PDF</a></button>
  </div>
</footer>
<!-- /**** Footer fin ****/ -->
        <script src="scripts.js"></script>
    </body>
</html>
<?php require_once 'footer.php' ?>