<?php
  session_start();
?>
<?php include 'header.php'; ?>

<div class='row'>
    <div class='jumbotron bg-light m-2 p-2'>
        <h1 class='display-4'>Bienvenue au petit annonce!</h1>
        <header>
          <a href="index.php"><img src="images/pinterest.png" alt="petit_annonce!"></a>
        </header>
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

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="base.css" />
    <link rel="stylesheet" href="book.css" />
    <link rel="stylesheet" href="login.css" />
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css" />
    <link id="codyframe" rel="stylesheet" href="style.css">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="contact.js"></script>
    <title>petit_annonce! - Contact</title>
    <title>Connexion | petit annonce</title>
  </head>
  <body>
  <br/>
        <div id="container" class="container">
            <!-- zone de connexion -->
            
            <form action="contact.php" method="POST">
                <div class='row'>
                  <h1 class='col-md-12 text-center border border-dark text-white bg-primary'>Connexion</h1>
                </div>
                <label><b>Nom d'utilisateur</b></label><br>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="user_name" required>
                <br>
                <label><b>Mot de passe</b></label>
                <br>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                <br>
                <br>
                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>
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