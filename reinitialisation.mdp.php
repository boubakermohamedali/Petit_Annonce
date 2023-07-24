<?php require_once 'header.php';
require_once 'connexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    resetPwd();
}


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $hash_ = $_POST['hash_'];
    echo "Votre mot de passe a été réinitialisé avec succès.";
}
?>
<div class="main">

    <div class="signup">

        <form method="POST" action="">
            <label for="mail">Adresse e-mail :</label>
            <input type="mail" name="mail" required><br><br>
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" name="hash_" required><br><br>
            <input type="submit" name="submit" value="Réinitialiser le mot de passe">
        </form>
    </div>
</div>
</body>

</html>
<?php require_once 'footer.php'; ?>