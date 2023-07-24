<?php include 'header.php'; ?>
<br/>
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
            <br><br>
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="base.css" />
        <link rel="stylesheet" href="book.css" />
        <link rel="stylesheet" href="login.css" />
        <link rel="stylesheet" href="index.css" />
        <link href="style.css" rel="stylesheet">
        <link id="codyframe" rel="stylesheet" href="style.css">
        <title>petit_annonce! - Contact</title>
        <script>document.getElementsByTagName("html")[0].className += " js";</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Connexion | petit annonce</title>
<br><br/>
<br/>
<div class="container">
	<div class="m-4">
		<div class="from-group">
			<from action="pdf.php" methode="POST">
				<imput type="Test" name="cafe" aria-placeholder="votre cafe" class="form-control"/><br/>
				<button type="submit" class="btn btn-primary">Envoyer</button>
			</from>
		</div>
	</div>
</div>
<br><br/>
<?php

require_once 'connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test = LoginUser();
    if ($test[0] === "success") {
        header("Location: index.php");
    }
    print_r($test);
}
?>
<?php require_once 'header.php' ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif;
        $sessionStatus = session_status();

        if ($sessionStatus === PHP_SESSION_DISABLED) {
            echo "Les sessions sont désactivées sur le serveur.";
        } elseif ($sessionStatus === PHP_SESSION_NONE) {
            echo "Aucune session n'est active.";
        } elseif ($sessionStatus === PHP_SESSION_ACTIVE) {
            echo "Une session est active.";
        } ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Mail membre</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="hash_">Mot de passe</label>
                <input type="text" class="form-control" id="hash_" name="hash_" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
            <a href="mdp-oubli.php">Mot de passe oublié ?</a>

    
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
<br/><br/><br/>
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