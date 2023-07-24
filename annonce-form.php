<?php

// Import des fonctions
require_once 'connexion.php';

// Pour éviter de dupliquer le code, ce formulaire sera utiliser pour créer ou modifier un abo. Si l'url est appelée avec id= alors nous l'utiliserons pour éditer l'abo avec l'id spécifié. 
if (isset($_GET['id_annonce'])) {
    // récupérer $id dans les paramètres d'URL
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Charger les informations de l'abo depuis la BDD pour remplir le formulaire
    try {
        // Se connecter à la BDD avec la fonction connect() définie dans functions.php
        $db = connect();

        // Préparer $annonceQuery pour récupérer les informations de l'abo
        $annonceQuery = $db->prepare('SELECT * FROM annonces WHERE id_annonce= id_annonce');
        // Exécuter la requête
        $annonceQuery->execute(['id_annonce' => $id_annonce]);
        // Récupérer les données et les assigner à $abo
        $annoces = $annonceQuery->fetch(PDO::FETCH_ASSOC);
        $result = $query->get_result();
    } catch (Exception $e) {
        // Afficher le message s'il y a une exception
        echo $e->getMessage();
    }

    // Fermer la connection à la BDD
    $annonceQuery=null;
    $db=null;
}

// Récupérer les annonces
$annonces = getAnnonces();

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
        <a href='login.php' class='btn btn-secondary m-2 active' role='button'>Contacts</a>
        </p>
    </div>
</div>
<br>
<br>
<div class='row'>
    <h1 class='col-md-12 text-center border border-dark bg-primary text-white'>Annonce-Form</h1>
</div>
<br/>
<div class='row'>
    <form method='post' action='ajoute_annonce.php'>
        <!--  Ajouter un champs cacher avec l'ID (s'il existe) pour qu'il soit envoyé avec le formulaire -->
        <input type='hidden' name='id' value='<?= $abo['id_annonce'] ?? '' ?>'>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='Titre'>Titre</label>
            <br/>
            <input type='text' name='Titre' class='form-control' id='Titre' placeholder='Enter Titre' required autofocus value='<?= isset($abo['Titre']) ? htmlentities($abo['Titre']) : '' ?>'>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='Prix_vente'>Prix_vente</label>
            <br/>
            <input type='text' name='Prix_vente' class='form-control' id='Prix_vente' placeholder='Enter Prix_vente' required value='<?= isset($abo['Prix_vente']) ? htmlentities($abo['Prix_vente'])  : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='date_vente'>date_vente</label>
            <br/>
            <input type='text' name='date_vente' class='form-control' id='date_vente' placeholder='Enter date_vente' required value='<?= isset($abo['date_vente']) ? htmlentities($abo['date_vente']) : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='Date_validation'>Date_validation</label>
            <br/>
            <input type='text' name='Date_validation' class='form-control' id='Date_validattion' placeholder='Enter Date_validation' required value='<?= isset($abo['Date_validation']) ? htmlentities($abo['Date_validation']) : '' ?>'>
            <br/>
        </div>
        <div class='form-group my-3'>
        <br/>
            <label for='date_fin_validation'>date_fin_validation</label>
            <br/>
            <input type='text' name='date_fin_validation' class='form-control' id='date_fin_validattion' placeholder='Enter date_fin_validation' required value='<?= isset($abo['date_fin_validation']) ? htmlentities($abo['date_fin_validation']) : '' ?>'>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='cont_annonce'>cont_annonce</label>
            <br/>
            <input type='text' name='cont_annonce' class='form-control' id='cont_annonce' placeholder='Enter cont_annonce' required value='<?= isset($abo['cont_annonce']) ? htmlentities($abo['cont_annonce']) : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='description_annonces'>description_annonces</label>
            <br/>
            <input type='text' name='description_annonces' class='form-control' id='description_annonces' placeholder='Enter description_annonces' required value='<?= isset($abo['description_annonces']) ? htmlentities($abo['description_annonces']) : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='duree_publication'>duree_publication</label>
            <br/>
            <input type='text' name='duree_publication' class='form-control' id='duree_publication' placeholder='Enter date_creation' required value='<?= isset($abo['duree_publication']) ? htmlentities($abo['duree_publication']) : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='id_etat'>id_etat</label>
            <br/>
            <input type='text' name='id_etat' class='form-control' id='id_etat' placeholder='Enter id_etat' required value='<?= isset($abo['id_etat']) ? htmlentities($abo['id_etat']) : '' ?>'>
            <br/>      
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='id_membre_1'>id_membre</label>
            <br/>
            <input type='text' name='id_membre' class='form-control' id='id_membre' placeholder='Enter id_membre' required value='<?= isset($abo['id_membre']) ? htmlentities($abo['id_membre']) : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='id_membre_1'>id_membre_1</label>
            <br/>
            <input type='text' name='id_membre_1' class='form-control' id='id_membre_1' placeholder='Enter id_membre_1' required value='<?= isset($abo['id_membre_1']) ? htmlentities($abo['id_membre_1']) : '' ?>'>
            <br/>
        </div>
        <br/>
        <div class='form-group my-3'>
        <br/>
            <label for='date_creation'>description_annonces</label>
            <br/>
            <input type='text' name='date_creation' class='form-control' id='date_creation' placeholder='Enter date_creation' required value='<?= isset($abo['date_creation']) ? htmlentities($abo['date_creation']) : '' ?>'>
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
      <img src="images/logo.png" alt="">
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