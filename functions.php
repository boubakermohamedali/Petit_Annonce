<?php session_start();

function connect()
{
    // hôte
    $hostname = 'localhost';

    // nom de la base de données
    $dbname = 'projet_annonces';

    // identifiant et mot de passe de connexion à la BDD
    $username = 'root';
    $password = '';

    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Erreur : ' . $conn->connect_error); // Terminer l'exécution en cas d'erreur de connexion
    }
    return $conn;
}

// Récupération d'un membre en fonction de l'adresse e-mail
function getMembreByMail($mail)
{
    try {
        $db = connect();
        $query = $db->prepare('SELECT * FROM membres WHERE mail = ?');
        $query->bind_param("s", $mail);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            // Renvoie toutes les informations de l'utilisateur
            return $result->fetch_assoc();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}

function getMembres()
{
    $db = connect();
    $query = $db->query("SELECT * FROM membres");
    if (!$query) {
        throw new Exception($db->error);
    } else {
        return $query->fetch_all(MYSQLI_ASSOC);
    }
}

function getCategories()
{
    $db = connect();
    $query = $db->query("SELECT * FROM categories");
    if (!$query) {
        throw new Exception($db->error);
    } else {
        return $query->fetch_all(MYSQLI_ASSOC);
    }
}

function getAnnonces()
{
    $db = connect();
    $query = $db->query("SELECT * FROM annonces");
    if (!$query) {
        throw new Exception($db->error);
    } else {
        return $query->fetch_all(MYSQLI_ASSOC);
    }
}

function LoginUser()
{
    $mail = filter_var(filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $membre = getMembreByMail($mail);

    if ($membre) {
        if (password_verify($_POST['hash_'], $membre['hash_'])) {
            if ($membre['is_actif']) {
                $_SESSION['is_admin'] = true;
                $_SESSION['is_actif'] = $membre['is_actif'];
                $_SESSION['id'] = $membre['id'];
                $_SESSION['prenom'] = $membre['prenom'];
                $_SESSION['surnom'] = $membre['surnom'];
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
    $email = filter_var(filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    if (getMembreByMail($email)) {
        $token = bin2hex(random_bytes(16));
        $perim = date("Y-m-d");
        try {
            $db = connect();

            $query = $db->prepare('UPDATE membres SET token = ?,  WHERE mail = ?');
            $query->bind_param('sss', $token, $perim, $email);
            $query->execute();

            if ($db->affected_rows > 0) {
                $content = "<p><a href='localhost/projet-annonces/reinitialisation.mdp.php?p=reset&token=$token'>Merci de cliquer sur ce lien pour réinitialiser votre mot de passe</a></p>";
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html; charset=iso-8859-1',
                    'X-Mailer' => 'PHP/' . phpversion()
                );
                email($email, "Réinitialisation de mot de passe", $content, $headers);
                return array("success", "Vous allez recevoir un mail pour réinitialiser votre mot de passe" . $content);
            } else {
                return array("error", "Problème lors du processus de réinitialisation");
            }
        } catch (Exception $e) {
            return array("error", $e->getMessage());
        } finally {
            // Fermer la connexion à la base de données
            $db->close();
        }
    } else {
        return array("error", "Aucun compte ne correspond à cet e-mail.");
    }
}

function getMembreByToken($token)
{
    try {
        $db = connect();
        $query = $db->prepare('SELECT * FROM membres WHERE token = ?');
        $query->bind_param("s", $token);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            // Renvoie toutes les informations de l'utilisateur
            return $result->fetch_assoc();
        }
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
                    $query->bind_param("ss", $pwd, $token);
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