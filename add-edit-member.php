<?php 
require_once 'connexion.php';

if (!empty($_POST)) {
    $id_membre = $_POST['id_membre'] ?? '';
    $Telephone = $_POST['telephone'] ?? '';
    $url_photo_profil = $_POST['url_photo_profil'] ?? '';
    $nom= $_POST['nom'] ?? '';
    $Date_validation= $_POST['prenom'] ?? '';
    $date_description= $_POST['date_description'] ?? '';
    $email= $_POST['email'] ?? '';
    $token= $_POST['token'] ?? '';
    $user_name= $_POST['user_name'] ?? '';
    $ville= $_POST['ville'] ?? '';
    $code_postal= $_POST['code_postal'] ?? '';
    $hash= $_POST['hash'] ?? '';
    $date_validation_token= $_POST['date_validation_token'] ?? '';
    $adresse_postale= $_POST['adresse_postale'] ?? '';
    $solde_cagnotte= $_POST['solde_cagnotte'] ?? '';
    $id_membre = filter_input(INPUT_POST,'id_membre', FILTER_SANITIZE_NUMBER_INT);
    // Connection à la BDD avec la fonction connect() dans functions.php
    $db = connect();

    // Un membre n'a un ID que si ses infos sont déjà enregistrées en BDD, donc on vérifie s'il  le membre a un ID.
    if (empty($_POST['id'])) {
         // S'il n'y a pas d'ID, le membre n'existe pas dans la BDD donc on l'ajoute.
         try {
            // Préparation de la requête d'insertion.
            $createMemberStmt = $db->prepare('INSERT INTO membres ( id_membre, Telephone, url_photo_profil, Nom, email, prenom, token, user_name, hash, adresse_postale, ville, code_postal, solde_cagnotte, date_validation_token, date_description) VALUES( :membre, : nom, :prenom, :Telephone, :url_photo_profil, :token, :user_name , :hash, :adresse_postale, :ville, :code_postal, :solde_cagnotte, :email,  :date_validation_token, :date_description)');
            // Exécution de la requête
            $createMemberStmt->execute(['membre,'=>$membre, 'telephone'=>$telephone, 'url_photo_profil'=>$url_photo_profil, 'nom'=>$nom,'prenom'=>$prenom, 'user_name'=>$user_name, 'hash'=>$hash,'adresse_postale'=>$adresse_postale, 'code_postal'=>$code_postal, 'ville'=>$ville,'id_membre,'=>$id_membre, 'email'=>$email, 'date_description'=>$date_description,'date_validation_token'=>$date_validation_token, 'solde_cagnotte'=>$solde_cagnotte,]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($createMemberStmt->rowCount()) {
                // Une ligne a été insérée => message de succès
                $type = 'success';
                $message = 'Membre ajouté';
            } else {
                // Aucune ligne n'a été insérée => message d'erreur
                $type = 'error';
                $message = 'Membre non ajouté';
            }
        } catch (Exception $e) {
            // Le membre n'a pas été ajouté, récupération du message de l'exception
            $type = 'error';
            $message = 'Membre non ajouté: ' . $e->getMessage();
        }
    } else {
        // Le membre existe, on met à jour ses informations

        // Récupération de l'ID du membre
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Mise à jour des informations du membre
        try {
            // Préparation de la requête de mis à jour
            $updateMemberStmt = $db->prepare('UPDATE membres SET id_=:id_membre,telephone, =:telephone, solde_cagnotte=:solde_cagnotte, url_photo_profil=:url_photo_profil, Date_validation_token=:Date_validation_token , date_description =:date_description, code_postal=:code_postal, adresse_postale=:adreese_postale, ville=:ville , hash=:hash, id_nembre=:id_membre, nom=:nom, prenom=:prenom, email=:email,  WHERE id=:id');
            // Exécution de la requête
           $updateMemberStmt->execute(['id_membre'=>$id_membre, 'telephone'=>$telephone, 'url_photo_profil'=>$url_photo_profil, 'nom'=>$nom, 'prenom'=>$prenom, 'email'=>$email, 'token'=>$token,'user_name'=>$user_name, 'hash'=>$hash,'adresse_postale,'=>$adresse_postale, 'ville'=>$ville, 'code_postal'=>$code_postal, 'solde_cagnotte'=>$solde_cagnotte, 'date_validation_token'=>$date_description_token, 'date_description'=>$date_description]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($updateMemberStmt->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Membre mis à jour';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Membre non mis à jour';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Membre non mis à jour: ' . $e->getMessage();
        }
    }

    // Fermeture des connexions à la BDD
    $createMemberStmt = null;
    $updateMemberStmt = null;
    $db = null;
 
   

    // Redirection vers la page principale des membres en passant le message et son type en variables GET
    header('location:' . 'membres.php?type=' . $type . '&message=' . $message);
}

