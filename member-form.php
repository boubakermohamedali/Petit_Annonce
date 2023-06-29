<?php

// Import des connexions
require_once 'connexion.php';

// Pour éviter de dupliquer le code, ce formulaire sera utiliser pour créer ou modifier un membre. Si l'url est appelée avec id= alors nous l'utiliserons pour éditer le membre avec l'id spécifié. 
if (isset($_GET['id'])) {
    // récupérer $id dans les paramètres d'URL
    $id_membre = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Charger les informations du membre depuis la BDD pour remplir le formulaire
    try {
        // Se connecter à la BDD avec la connexion connect() définie dans connexion.php
        $db = connect();

        // Préparer $memberQuery pour récupérer les informations du membre
        $memberQuery = $db->prepare('SELECT*FROM membres WHERE id_membre = id_membre');
        // Exécuter la requête
        $memberQuery->execute(['id_membre' => $id_membre]);
        // Récupérer les données et les assigner à $member
        $member = $memberQuery->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Afficher le message s'il y a une exception
        echo $e->getMessage();
    }
    // Fermer la connection à la BDD
    $memberQuery=null;
    $db=null;
}
//var_dump($member);
// Récupérer les members 
//$members = getMembers();

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
    <h1 class='col-md-12 text-center border border-dark bg-primary text-white'>Member Form</h1>
</div>
<br>
<div class='row'>
    <form method='post' action='add-edit-member.php'>
        <!--  Ajouter the ID to the form if it exists but make the field hidden -->
        <input type='hidden' name='id' value='<?= $member['id_membre'] ?? '' ?>'>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='firstName'>Prénom</label>
            <br>
            <input type='text' name='prenom' class='form-control' id='firstName' placeholder='Enter prénom' required autofocus value='<?= isset($member['prenom']) ? htmlentities($member['prenom']) : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='lastName'>Nom</label>
            <br/>
            <input type='text' name='nom' class='form-control' id='lastName' placeholder='Enter nom' required value='<?= isset($member['nom']) ? htmlentities($member['nom'])  : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br/>
            <label for='adresse_postale'>Adresse_Postale</label>
            <br/>
            <input type='text' name='adresse_postale' class='form-control' id='adresse_postale' placeholder='Enter adresse_postale' required value='<?= isset($member['adresse_postale']) ? htmlentities($member['adresse_postale']) : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='code_postal'>code_postal</label>
            <br>
            <input type='text' name='code_postal' class='form-control' id='code_postal' placeholder='Enter code_postal' required value='<?= isset($member['code_postal']) ? htmlentities($member['code_postal']) : '' ?>'>
        </div> 
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='telephone'>telephone</label>
            <br/>
            <input type='text' name='telephone' class='form-control' id='telephone' placeholder='Enter code_postal' required value='<?= isset($member['telephone']) ? htmlentities($member['telephone']) : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='url_photo_profil'>url_photo_profil</label>
            <br/>
            <input type='text' name='url_photo_profil' class='form-control' id='url_photo_profil' placeholder='Enter url_photo_profil' required value='<?= isset($member['url_photo_profil']) ? htmlentities($member['url_photo_profil']) : '' ?>'>
        </div>
        <br/> 
        <div class='form-group my-3'>
            <label for='email'>email</label>
            <br>
            <input type='text' name='email' class='form-control' id='email' placeholder='Enter email' required value='<?= isset($member['email']) ? htmlentities($member['email']) : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='user_name'>user_name</label>
            <br/>
            <input type='text' name='user_name' class='form-control' id='user_name' placeholder='Enter user_name' required value='<?= isset($member['user_name']) ? htmlentities($member['email']) : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='token'>token</label>
            <br>
            <input type='text' name='token' class='form-control' id='token' placeholder='Enter token' required value='<?= isset($member['token']) ? htmlentities($member['token']) : '' ?>'>
        </div>
        <br> 
        <div class='form-group my-3'>
            <br>
            <label for='hash'>hash</label>
            <br>
            <input type='text' name='hash' class='form-control' id='hash' placeholder='Enter hash' required value='<?= isset($member['hash']) ? htmlentities($member['hash']) : '' ?>'>
        </div> 
        <br>
        <div class='form-group my-3'>
            <br/>
            <label for='date_validation_token'>date_validation_token</label>
            <br>
            <input type='text' name='date_validation_token' class='form-control' id='date_validation_token' placeholder='Enter date_validation_token' required value='<?= isset($member['date_validation_token']) ? htmlentities($member['date_validation_token']) : '' ?>'>
        </div>
        <br/>
        <div class='form-group my-3'>
            <br>
            <label for='solde_cagnotte'>solde_cagnotte</label>
            <br/>
            <input type='text' name='solde_cagnotte' class='form-control' id='solde_cagnotte' placeholder='Enter solde_cagnotte' required value='<?= isset($member['solde_cagnotte']) ? htmlentities($member['solde_cagnotte']) : '' ?>'>
        </div>
        <br>
        <div class='form-group my-3'>
            <br>
            <label for='ville'>ville</label>
            <br/>
            <input type='text' name='ville' class='form-control' id='ville' placeholder='Enter ville' required value='<?= isset($member['ville']) ? htmlentities($member['ville']) : '' ?>'>
        </div>
        <br> 
        <div class='form-group my-3'>
            <br>
            <label for='date_description'>date_description</label>
            <br/>
            <input type='text' name='date_description' class='form-control' id='solde_cagnotte' placeholder='Enter solde_cagnotte' required value='<?= isset($member['solde_cagnotte']) ? htmlentities($member['date_description']) : '' ?>'>
        </div> 
        <br/>
       <button type='submit' class='btn btn-primary my-3' name='submit'>Submit</button>
       <br/>
    </form>
</div>
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