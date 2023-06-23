<?php 
require_once 'connexion.php';

if (!empty($_POST)) {
    // Récupération des champs du formulaire
    $id_annonce = $_POST['id_annonce'] ?? '';
    $date_vente = $_POST['date_vente'] ?? '';
    $cont_annonce= $_POST['cont_annonce'] ?? '';
    $Titre= $_POST['Titre'] ?? '';
    $Date_validation= $_POST['Date_validation'] ?? '';
    $description_annonces= $_POST['description_annonces'] ?? '';
    $date_creation= $_POST['date_creation'] ?? '';
    $duree_publication= $_POST['duree_publication'] ?? '';
    $date_fin_publication= $_POST['date_fin_publication'] ?? '';
    $id_membre= $_POST['id_membre'] ?? '';
    $id_etat= $_POST['id_etat'] ?? '';
    $id_membre_1= $_POST['id_membre_1'] ?? '';
    $annonce_id = filter_input(INPUT_POST, 'annonce_id', FILTER_SANITIZE_NUMBER_INT);
    // Création de l'objet BDD
    $db = connect();

    // Si un annonce a un ID, il est déjà enregistré en BDD, donc on le met à jour, sinon on le crée.
    if (empty($_POST['id'])) {
        // L'abonnement n'est pas dans la BDD, on le crée
        try {
            // Préparation de la requête d'insertion
            $createCategoriesStmt = $db->prepare('INSERT INTO annonces( date_vente, cont_annonce, Titre, Date_validation ,description_annonces, date_creation, duree_publication, date_fin_publication, id_membre, id_etat, id_membre_1) VALUES(:date_vente, :cont_annonce, :Titre, :Date_validation , :description_annonces, :date_creation, :duree_publication, :date_fin_publication, :id_membre, :id_etat, :id_membre_1)');
            // Exécution de la requête
            $createCategoriesStmt->execute([ 'date_vente'=>$date_vente, 'cont_annonce'=>$cont_annonce, 'Titre'=>$Titre,'Date_validation'=>$Date_validation, 'description_annonces'=>$description_annonces, 'date_creation'=>$date_creation,'duree_publication'=>$duree_publication,  'date_fin_publication'=>$date_fin_publication,'id_membre,'=>$id_membre, 'id_etat'=>$id_etat, 'id_membre_1'=>$id_membre_1,]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($createCategoriesStmt->rowCount()) {
                // Une ligne a été insérée => message de succès
                $type = 'success';
                $message = 'Annonce ajouté';
            } else {
                // Aucune ligne n'a été insérée => message d'erreur
                $type = 'error';
                $message = 'Annonce non ajouté';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Exception message: ' . $e->getMessage();
        }
    } else {
         // L'abonnement existe en BDD, on le met à jour
        // Récupération de l'ID de l'abo
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        try {
            // Préparation de la requête de mis à jour
            $updateAboStmt = $db->prepare('UPDATE annonces SET date_vente =:date_vente, cont_annonce=:cont_annonce, Titre=:Titre, Date_validation=:Date_validation , description_annonces =:description_annonces, date_creation=:date_creation, duree_publication=:duree_publication , date_fin_publication=:date_fin_publication, id_nembre=:id_membre, id_etat=:id_etat, id_membre_1=:id_membre_1  WHERE id=:id');
            // Exécution de la requête
           $updateAboStmt->execute([ 'date_vente'=>$date_vente, 'cont_annonce'=>$cont_annonce, 'Titre'=>$Titre,'Date_validation'=>$Date_validation, 'description_annonces'=>$description_annonces, 'date_creation'=>$date_creation,'duree_publication'=>$duree_publication,  'date_fin_publication'=>$date_fin_publication,'id_membre,'=>$id_membre, 'id_etat'=>$id_etat, 'id_membre_1'=>$id_membre_1,]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($updateAboStmt->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Abo mis à jour';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Abo non mis à jour';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Abo non mis à jour: ' . $e->getMessage();
        }
    }
    // Fermeture des connexions à la BDD
    $createAnnonceStmt = null;
    $updateAnnonceStmt = null;
    $db = null;

    // Redirection vers la page principale des abos en passant le message et son type en variables GET
    header('location:' . 'annonces.php?type=' . $type . '&message=' . $message);
}

?>