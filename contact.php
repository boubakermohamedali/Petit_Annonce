<?php include 'header.php'; ?>

    <div class='row'>
        <div class='jumbotron bg-light m-2 p-2'>
            <h1 class='display-4'>Bienvenue au petit annonce!</h1>
            <p class='lead'>Ici vous pouvez gérer les abonnement pour le très exclusif petit annonce !</p>
            <hr class='my-4'>
            <p>Cliquer sur un des boutons ci-dessous pour obtenir une liste des membres ou des types categorie</p>
            <p class='lead'>
            <a href='index.php' class='btn btn-secondary m-2 active' role='button'>Accueil</a>
            <a href='annonces.php' class='btn btn-secondary m-2 active' role='button'>Annonces</a>
            <a href='categorie.php' class='btn btn-secondary m-2 active' role='button'>Categories</a>
            <a href='members.php' class='btn btn-secondary m-2 active' role='button'>Membres</a>
            <a href='login.php' class='btn btn-secondary m-2 active' role='button'>Contacts</a>
            </p>
        </div>
    </div>

   
<?php require_once 'footer.php' ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <title>Contact| petit annonce</title>
    <link href="style.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <link id="codyframe" rel="stylesheet" href="style.css">
    <script defer src="contact.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<h1>Contact</h1>
<p>Une suggestion? Une demande? Un problème? N'hésitez pas à nous écrire!</p>
<br>
<form method="POST">
   
    <p><label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required></p>
    <br>
    <p><label for="email">Email</label>
        <input type="email" name="email" id="email" required></p>
    <br>
    <p><label for="message">Veuillez saisir votre message:</label>
        <input type="textarea" name="message" id="message" required></p>
    <input type="submit" value="Envoyer">

