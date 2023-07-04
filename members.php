<?php
session_start();
require_once 'connexion.php';

// Création d'un bloc try/catch pour gérer les exceptions de la BDD
try {
    // Connection à la BDD
    $db = connect();

    // Création de $membersQuery. On utilise inner join pour récupérer les titres d'abo
    $membersQuery = $db->query('SELECT * FROM membres');
    // Récupération de tous les membres et assignation à $members
    $members = $membersQuery->fetchAll(PDO::FETCH_ASSOC);;

} catch (Exception $e) {
    // Affiche le message en cas d'exception
    echo $e->getMessage();
}
// var_dump($members);
// Fermeture de la connexion à la BDD
$db=null;
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
<br/><br/><br/>

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
<br>
<div class='row'>
    <h1 class='col-md-12 text-center border border-dark text-white bg-primary'>Membres</h1>
</div>
<br/>
<div class='row'>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Prénom</th>
                <th scope='col'>Nom</th>
                <th scope='col'>Adresse_postale</th>
                <th scope='col'>Telephone</th>
                <th scope='col'>Ville</th>
                <th scope='col'>Code_postal</th>
                <th scope='col'>email</th>
                <th scope='col'>user_name</th>
                <th scope='col'>Hash</th>
                <th scope='col'>Token</th>
                <th scope='col'>Solde_cagnotte</th>
                <th scope='col'>Date_description</th>
                <th scope='col'>Date_validation_token</th>
                <th scope='col'>Url_Photo_profil</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member) : ?>
                <tr>
                <tr>
                    <td><?= $member['id_membre'] ?></td>
                    <td><?= htmlentities($member['prenom']) ?></td>
                    <td><?= htmlentities($member['nom']) ?></td>
                    <td><?= htmlentities($member['adresse_postale']) ?></td>
                    <td><?= htmlentities($member['code_postal']) ?></td>
                    <td><?= htmlentities($member['ville']) ?></td>
                    <td><?= htmlentities($member['telephone']) ?></td>
                    <td><?= htmlentities($member['email']) ?></td>
                    <td><?= htmlentities($member['user_name']) ?></td>
                    <td><?= htmlentities($member['date_description']) ?></td>
                    <td><?= htmlentities($member['date_validation_token']) ?></td>
                    <td><?= htmlentities($member['url_photo_profil']) ?></td>
                    <td><?= htmlentities($member['solde_cagnotte']) ?></td>  
                    <td><?= htmlentities($member['hash']) ?></td>
                    <td><?= htmlentities($member['token']) ?></td>
                    <br><br><br>
                        <div class='row'>
                            <div class='col'>
                                <a class='btn btn-primary' href='member-form.php?id=<?= $member['id_membre'] ?>' role='button'>Modifier</a>
                                <br><br>
                                <a class='btn btn-danger' href='delete-member.php?id=<?= $member['id_membre'] ?>' role='button'>Supprimer</a><br>
                            </div>
                        </div>
                        <br><br>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br><br><br>

<div class='row'>
    <div class='col'>
        <a class='btn btn-success' href='member-form.php' role='button'>Ajouter membre</a>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">
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