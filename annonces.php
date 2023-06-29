<?php

// Import de functions.php
require_once("connexion.php");
try {
    // Récupération des abos avec la fonction getAbos() définie dans connexion.php
 $annonces=getAnnonces();
} catch (Exception $e) {
    // Afficher le message en cas d'envoi d'exception
    echo $e->getMessage();
}

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
        <a href='index.php' class='btn btn-secondary m-2 active' role='button'>Accueil</a>
        <a href='annonces.php' class='btn btn-secondary m-2 active' role='button'>Annonces</a>
        <a href='categorie.php' class='btn btn-secondary m-2 active' role='button'>Categories</a>
        <a href='members.php' class='btn btn-secondary m-2 active' role='button'>Membres</a>
        <a href='login.php' class='btn btn-secondary m-2 active' role='button'>Contacts</a>
    </div>
</div>


<br/>

<?php if (!empty($_GET['type']) && ($_GET['type'] === 'success')) : ?>
    <div class='row'>
        <div class='alert alert-success'>
            Succès! <?= $_GET['message'] ?>
        </div>
    </div>
<?php elseif (!empty($_GET['type']) && ($_GET['type'] === 'error')) : ?>
    <div class='row'>
        <div class='alert alert-danger'>
            Erreur! <?= $_GET['message'] ?>
        </div>
    </div>
<?php endif; ?>
<br/>
<br/>
<div class='row'>
    <h1 class='col-md-12 text-center border border-dark bg-primary text-white'>Annonces</h1>
</div>
<br/>
<div class='row'>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Titre</th>
                <th scope='col'>date_vente</th>
                <th scope='col'>Prix_vente</th>
                <th scope='col'>cont_annonce</th>
                <th scope='col'>Date_validation</th>
                <th scope='col'>description_annonces</th>
                <th scope='col'>date_creation</th>
                <th scope='col'>duree_publication</th>
                <th scope='col'>date_fin_publication</th>
                <th scope='col'>id_membre </th>
                <th scope='col'>id_etat</th>
                <th scope='col'>d_membre_1</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($annonces as $abo) : ?>
                <tr>
                    <td><?= $abo['id_annonce'] ?></td>
                    <td><?= htmlentities($abo['Titre']) ?></td>
                    <td><?= $abo['Prix_vente'] ?></td>
                    <td><?= $abo['Date_vente'] ?></td>
                    <td><?= $abo['cont_annonce'] ?></td>
                    <td><?= $abo['Date_validation'] ?></td>
                    <td><?= $abo['description_annonces'] ?></td>
                    <td><?= $abo['date_creation'] ?></td>
                    <td><?= $abo['description_annonces'] ?></td>
                    <td><?= $abo['duree_publication'] ?></td>
                    <td><?= $abo['date_fin_publication'] ?></td>
                    <td><?= $abo['id_membre'] ?></td>
                    <td><?= $abo['id_etat'] ?></td>
                    <td><?= $abo['id_membre_1'] ?></td>
                    <td><?= $abo['date_creation'] ?></td>
                    <td>
                        <a class='btn btn-primary' href='annonce-form.php?id=<?= $abo['id_annonce'] ?>' role='button'>Modifier</a>
                        <a class='btn btn-danger' href='delete-annonce.php?id=<?= $abo['id_annonce'] ?>' role='button'>Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br/>
<div class='row'>
    <div class='col'>
        <br>
        <a class='btn btn-success' href='annonce-form.php' role='button'>Ajouter annonces</a>
    </div>
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
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css" />
    <link id="codyframe" rel="stylesheet" href="style.css">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Annonces| petit annonce</title>
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
    <button class="btn">Dons</button>
    <button class="btn"> <a href="PDF/COFFEE_SHOP.pdf" download="Annonces">Télécharger le produit en PDF</a></button>
  </div>
</footer>
<!-- /**** Footer fin ****/ -->
        <script src="scripts.js"></script>
    </body>
</html>
<?php require_once 'footer.php' ?>