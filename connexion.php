<?php
// session_start();
// Connection à la base de données et renvoie l'objet PDO
function connect() {
    // hôte
    $hostname = 'localhost';

    // nom de la base de données
    $dbname = 'bateaux_pirates';

    // identifiant et mot de passe de connexion à la BDD
    $username = 'root';
    $password = '';
    
    // Création du DSN (data source name) en combinant le type de BDD, l'hôte et le nom de la BDD
    $dsn = "mysql:host=$hostname;dbname=$dbname";

    // Tentative de connexion avec levée d'une exception en cas de problème
    try{
      return new PDO($dsn, $username, $password);
    } catch (Exception $e){
      echo $e->getMessage();
    }
}

// Récupération d'une liste de tous les annonces existant en BDD
function getAnnonce() {
    try {
        // Récupération de l'objet PDO
        $db = connect();

        // Requête pour récupérer tous les annonces
        $annonceQuery=$db->query('SELECT * FROM annonces');

        // Renvoie tous les lignes
        return $annonceQuery->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // En cas d'erreur afficher le message
        echo $e->getMessage();
    }
}
// Récupération d'une liste de tous les membres existant en BDD
function getMembre () {
  try {
      // Récupération de l'objet PDO
      $db = connect();

      // Requête pour récupérer tous les membres
      $membreQuery=$db->query('SELECT * FROM membres');

      // Renvoie tous les lignes
      return $membreQuery->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
      // En cas d'erreur afficher le message
      echo $e->getMessage();
  }
}
// Récupération d'une liste de tous les membres existant en BDD
function getAnnonces() {
  try {
      // Récupération de l'objet PDO
      $db = connect();

      // Requête pour récupérer tous les annonces
      
      $annonceQuery=$db->query('SELECT * FROM annonces');
      
      

      // Renvoie tous les lignes
      return $annonceQuery->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
      // En cas d'erreur afficher le message
      echo $e->getMessage();
  }
}
// Récupération d'une liste de tous les categories existant en BDD
function getCategorie() {
  try {
      // Récupération de l'objet PDO
      $db = connect();

      // Requête pour récupérer tous les categories
      $categorieQuery=$db->query('SELECT * FROM categories');

  

      // Renvoie tous les lignes
      return $categorieQuery->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
      // En cas d'erreur afficher le message
      echo $e->getMessage();
  }
}


function LoginUser()
{
    $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $membre = getMembreByMail($email);

    if ($membre) {
        if (password_verify($_POST['hash_'], $membre['hash_'])) {
            if ($membre['is_actif']) {
                $_SESSION['user_name'] = true;
                $_SESSION['is_actif'] = $membre['is_actif'];
                $_SESSION['id_membre'] = $membre['id_membre'];
                $_SESSION['prenom'] = $membre['prenom'];
                $_SESSION['nom'] = $membre['nom'];
                $_SESSION['message'] = "Connexion réussie :)";
                return array("success", "Connexion réussie :)");
            } else {
                return array("error", "Veuillez activer votre compte");
            }
        } else {
            return array("error", "Mauvais identifiants");
        }
    } else {
        return array("error", "Mauvais identifiants");
    }
}


function waitReset()
{
    $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    if (getMembre($email)) {
        $token = bin2hex(random_bytes(16));
        $perim = date("Y-m-d");
        try {
            $db = connect();
            

            $query = $db->prepare('UPDATE membres SET token = ?, perim = ? WHERE email = ?');
            $query->rowCount( $token, $email);
            $query->execute();


            if ($db->affected_rows > 0) {
                $content = "<p><a href='localhost/bateaux_pirates/reinitialisation.mdp.php?p=reset&token=$token'>Merci de cliquer sur ce lien pour réinitialiser votre mot de passe</a></p>";
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html; charset=iso-8859-1',
                    'X-Mailer' => 'PHP/' . phpversion()
                );
                mail($email, "Réinitialisation de mot de passe", $content, $headers);
                return array("success", "Vous allez recevoir un email pour réinitialiser votre mot de passe" . $content);
            } else {
                return array("error", "Problème lors du processus de réinitialisation");
            }
        } catch (Exception $e) {
            return array("error", $e->getMessage());
        } finally {
            // Fermer la connexion à la base de données
           $createMemberStmt = null;
    $updateMemberStmt = null;
    $db = null;
 
        }
    } else {
        return array("error", "Aucun compte ne correspond à cet email.");
    }
}

function getMembreByToken($token)
{
    try {
        $db = connect();
        $query = $db->prepare('SELECT * FROM membres WHERE token = ?');
        $query->rowCount("s", $token);
        $query->execute();
        } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}

function resetPwd()
{
    $token = htmlspecialchars($_GET['token']);
    $membre = getMembreByToken($token);
    if ($membre) {
        if ($_POST['newhash_'] === $_POST['confirm_password']) {
            // Vérification supplémentaire du format du nouveau mot de passe
            if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['newhash_'])) {
                $pwd = password_hash($_POST['newhash_'], PASSWORD_DEFAULT);
                try {
                    $db = connect();
                    $query = $db->prepare('UPDATE membres SET token = NULL, hash_ = ?, is_actif = 1 WHERE token = ?');
                    $query->rowCount("ss", $pwd, $token);
                    $query->execute();
                    if ($db->affected_rows > 0) {
                        $content = "<p>Votre mot de passe a été réinitialisé</p>";
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );
                        mail($membre['mail'], "Réinitialisation de mot de passe", $content, $headers);
                        return array("success", "Votre mot de passe a bien été réinitialisé");
                    } else {
                        return array("error", "Problème lors de la réinitialisation");
                    }
                } catch (Exception $e) {
                    return array("error", $e->getMessage());
                }
            } else {
                return array("error", "Le mot de passe doit comporter au moins 8 caractères, dont au moins 1 chiffre, 1 lettre minuscule, 1 lettre majuscule et 1 caractère spécial.");
            }
        } else {
            return array("error", "Les 2 saisies de mot de passe doivent être identiques.");
        }
    } else {
        return array("error", "Les données ont été corrompues ! Veuillez <a href='?p=forgot'>recommencer</a>");
    }
}
