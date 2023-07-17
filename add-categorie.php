<?php 
require_once 'connexion.php';

if (!empty($_POST)) {
    $id_categorie = $_POST['id_categorie'] ?? '';
    $nom_categorie= $_POST['nom_categorie'] ?? '';
    $description_categorie= $_POST['description_categorie'] ?? '';
    $id_categorie = filter_input(INPUT_POST,'id_categorie', FILTER_SANITIZE_NUMBER_INT);
    // Connection à la BDD avec la fonction connect() dans connexions.php
    $db = connect();

    // Un membre n'a un ID que si ses infos sont déjà enregistrées en BDD, donc on vérifie s'il  le membre a un ID.
    if (empty($_POST['id'])) {
         // S'il n'y a pas d'ID, le membre n'existe pas dans la BDD donc on l'ajoute.
         try {
            // Préparation de la requête d'insertion.
            $createCategorieStmt = $db->prepare('INSERT INTO categories ( id_categorie, nom_categorie,description_categorie) VALUES( :categorie, : nom_categorie, :description_categorie)');
            // Exécution de la requête
            $createCategorieStmt->execute(['categorie,'=>$categorie, 'nom_categorie'=>$nom_categorie,'description_categorie'=>$description_categorie,]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($createCategorieStmt->rowCount()) {
                // Une ligne a été insérée => message de succès
                $type = 'success';
                $message = 'Categorie ajouté';
            } else {
                // Aucune ligne n'a été insérée => message d'erreur
                $type = 'error';
                $message = 'Categorie non ajouté';
            }
        } catch (Exception $e) {
            // Le membre n'a pas été ajouté, récupération du message de l'exception
            $type = 'error';
            $message = 'Categorie non ajouté: ' . $e->getMessage();
        }
    } else {
        // Le membre existe, on met à jour ses informations

        // Récupération de l'ID du membre
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Mise à jour des informations du membre
        try {
            // Préparation de la requête de mis à jour
            $updateCategorieStmt = $db->prepare('UPDATE categorie SET id_=:id_categorie,non_categorie, =:nom_categorie, description_categorie=:description_categorie,  WHERE id=:id');
            // Exécution de la requête
           $updateCategorieStmt->execute(['id_gategorie'=>$id_categorie, 'nom_categorie'=>$nom_categorie, 'categorie_description']);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($updateCategorieStmt->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Categorie mis à jour';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Categorie non mis à jour';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Categorie non mis à jour: ' . $e->getMessage();
        }
    }

    // Fermeture des connexions à la BDD
    $createCategorieStmt = null;
    $updateCategorieStmt = null;
    $db = null;

    // Redirection vers la page principale des membres en passant le message et son type en variables GET
    header('location:' . 'categories.php?type=' . $type . '&message=' . $message);
}

?>