<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <titre><h1>petit annonce</h1></titre>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor' crossorigin='anonymous'>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Document</title>
</head>
<a href='index.php' class='btn btn-secondary m-2 active' role='button'>Accueil</a>
<a href='categorie.php' class='btn btn-secondary m-2 active' role='button'>Categorie</a>
<a href='members.php' class='btn btn-secondary m-2 active' role='button'>Membres</a>
<a href='annonces.php' class='btn btn-secondary m-2 active' role='button'>Annonces</a>
<a href='utilisateurs.php' class='btn btn-secondary m-2 active' role='button'>Utilisateurs</a>
<a href='login.php' class='btn btn-secondary m-2 active' role='button'>Contacts</a>
<?php 
  session_start();
  $bdd = new PDO('mysql:host=localhost;dbname=bateau_pirate;charset=utf8;', 'root','');

   if(isset($_POST['envoi'])){
       if(!empty($_POST['identifiant'])                              //check si les entrées sont diff de vide  
          AND !empty($_POST['first_name'])                          //$_post -> variables passées au script actuel
          AND !empty($_POST['last_name'])
          AND !empty($_POST['email'])  
          AND !empty($_POST['city'])  
          AND !empty($_POST['mdp'])){
          
            
        
          $identifiant = htmlspecialchars($_POST['identifiant']);   //ma variable = a l'entre bloque en htmlspecialchars pour securité pour eviter un script ou autre
          $last_name = htmlspecialchars($_POST['last_name']);
          $first_name = htmlspecialchars($_POST['first_name']);
          $email = htmlspecialchars($_POST['email']);
          $city = htmlspecialchars($_POST['city']);
          $mdp = sha1($_POST['mdp']);                               // toujours la secu crypter le mdp

              
          //Check si les entrées sont existantes
          
         
            $recupidentifiant= $bdd->prepare('SELECT id_membre  FROM membres WHERE  id_membre =?');
            $recupidentifiant->execute(array($identifiant));                                       // execute 

               
            $userexist = $recupidentifiant->rowCount();                     //renvoie le nombre de lignes qui correspondent à un crit spécifié.
            if($userexist == 0){
            
              $recupemail= $bdd->prepare('SELECT email FROM membres WHERE email =?');
              $recupemail->execute(array($email));                                        

               
              $userexist = $recupemail->rowCount();                                           
              if($userexist == 0){
                  
                $recupmdp= $bdd->prepare('SELECT mdp FROM membres WHERE mdp =?');
                $recupmdp->execute(array($mdp));                                        
  
                 
                $userexist = $recupmdp->rowCount();                                           
                if($userexist == 0){
                  
          
          

                  $insertUser = $bdd->prepare('INSERT INTO 
                  membres (identifiant, last_name, first_name, email,city, mdp ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
                  $insertUser->execute(array($identifiant, $last_name, $first_name, $email, $city,  $mdp ));
                  
                  
                  
                  //J'effectue une requete preparer pour venir recupérer l'utilisateur dans la table utilisateur rentrer par l'utilisateur
                  $recupUser = $bdd->prepare('SELECT * FROM membres WHERE identifiant = ? AND last_name = ? AND first_name= ? AND email = ? AND city = ? AND mdp = ?');
                  $recupUser->execute(array($identifiant, $last_name, $first_name, $email, $city,  $mdp));
                  //Si l'utilisateur existe dans cette table est supérieur à 0
                  // déclare les sessions
                  
                  //affecte toutes mes valeur de la session actuelle 
                    if($recupUser-> rowCount()>0){
                        $_SESSION['identifiant'] = $identifiant;
                        $_SESSION['last_name'] = $last_name;
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['email'] = $email;
                        $_SESSION['city'] = $city;
                        $_SESSION['mdp'] = $mdp;
                        $_SESSION['membre_id'] = $recupUser->fetch()['membre_id'];
                        header("Location: connexion.php");

                        }
                }else {
                  echo"<p class='erreur'>Mot de passe deja utilisé</p>";
                }    
              }else {
                echo"<p class='erreur'>Email deja utilisé</p>";
              }
              
            }else {
              echo"<p class='erreur'>Identifiant deja utilisé</p>";
            }
        }else {
          echo"<p class='erreur'>Veuillez compléter tous les champs</p>";
          } 
        
    }
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link id="codyframe" rel="stylesheet" href="assets/css/style.css">
  <link href="assets/css/creation.css" rel="stylesheet">
  <!-- Uncomment the script below if you need to support browsers where CSS Variables have not been implemented (e.g., IE11) -->
  <!-- <script>
    if(!('CSS' in window) || !CSS.supports('color', 'var(--color-var)')) {var cfStyle = document.getElementById('codyframe');if(cfStyle) {var href = cfStyle.getAttribute('href');href = href.replace('style.css', 'style-fallback.css');cfStyle.setAttribute('href', href);}}
  </script> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    
  <title>Acceuil | Petit annonce</title>


  

</head>
<body>

  

  
    <form action="" method="post" class="sign-up-form width-50% items-center" >
      <div class="text-component text-center margin-bottom-sm">
        <h1>Nous Rejoindre</h1>
        <p>Inscrit toi en tant que Vendeur ou Particulier <br> Tu as deja un compte? <a href="connexion.html">Connexion</a></p>
      </div>

    

      <div class="margin-bottom-sm">
        <label class="form-label margin-bottom-xxxs" for="">Identifiant</label>
        <input class="form-control width-100%" type="text" name="identifiant" id="id" placeholder="">
      </div>

      <div class="margin-bottom-sm">
        <label class="form-label margin-bottom-xxxs" for="">Mot de passe</label>
        <input class="form-control width-100%" type="text" name="mdp" id="mdp" placeholder="" >
      </div>

      <div class="margin-bottom-sm">
        <label class="form-label margin-bottom-xxxs" for="email">Email</label>
        <input class="form-control width-100%" type="email" name="email" id="email" placeholder="email@myemail.com">
      </div>


      <div class="margin-bottom-sm  margin-top-xl">
        <div class="grid gap-xs">
          <div class="col-6@md">
            <label class="form-label margin-bottom-xxxs" for="first_name">Prenom</label>
            <input class="form-control width-100%" type="text" name="first_name" id="first_name">
          </div>

          <div class="col-6@md">
            <label class="form-label margin-bottom-xxxs" for="last_name">Nom</label>
            <input class="form-control width-100%" type="text" name="last_name" id="last_name">
          </div>
        </div>
      </div>

      <div class="margin-bottom-sm">
        <div class="grid gap-xs">
          
            <label class="form-label margin-bottom-xxxs" for="city">Ville</label>
            <input class="form-control width-100%" type="text" name="city" id="city">
          
        </div>
      </div>
      
      <div class="margin-bottom-sm">
        <label class="form-label margin-bottom-xxxs" for="">Adresse_postal</label>
        <input class="form-control width-100%" type="text" name="adresse_postal" id="adresse_postal" placeholder="">
      </div> 


      <div class="margin-bottom-sm">
        <div class="grid gap-xs">
          <div class="col-6@md">
            <label class="form-label margin-bottom-xxxs" for="">Choix de votre catégorie (si tu es Vendeur):</label>
              <select class="select__input form-control width-100%" name="cat_id" id="">
                  <option value="1">pantalon</option>
                  <option value="2">manteau</option>
                  <option value="3">robe</option>
                  <option value="4">chemise</option>
                  <option value="5">pull</option>
                  <option value="6">costume</option>
                  <option value="7">haut</option>
                  <option value="8">cravate</option>
                  <option value="9">gilet</option>
                  <option value="10">short</option>
                  <option value="11" selected>Aucun (non vetement)</option>
              </select>
          </div>

          <div class="col-6@md">
              <label class="form-label margin-bottom-xxxs" for="role_id">Choix de votre Statut: </label>
              <select class="select__input form-control width-100%" name="role_id">
                
                  
                  <option value="1"selected>Vendeur</option>
                  <option value="2">Particulier</option>
                  
                
              </select>
          </div>
          
        </div>
      </div>
      
      
      <div class="margin-bottom-sm text-right">     
        <input type="submit" name="envoi" class="btn btn--primary">
      </div> 

    </form>




    <script src="assets/js/scripts.js"></script>
  </body>
</html>