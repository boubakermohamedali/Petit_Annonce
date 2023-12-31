<!DOCTYPE HTML>
<html>
<?php require_once "views/common/header.php"; ?>
<body class="is-preload">

<?php require_once "views/common/navbar.php"; ?>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <h1 class="major">Liste de tous les utilisateurs</h1>
            <!-- Table -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Id_utilisateurs</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // $users est défini dans le controlleur, on peut l'utiliser dans la vue
                        foreach ($utilisateurs as $utilisateur)
                        { ?>
                            <tr>
                                <td><?= $utilisateur->getId_utilisateurs() ?></td>
                                <td><?= remove_accents($utilisateur->getUsername()) ?></td>
                                <td><?= $utilisateur->getPassword() ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

        </div>
    </section>

</div>

<?php require_once "views/common/footer.php"; ?>
</body>
</html>