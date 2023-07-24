<?php
require_once 'functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	waitReset();
}
?>
<div class="main">

	<div class="signup">
		<form method="POST" action="">
			<label for="chk" aria-hidden="true">Oubli</label>
			<input type="hidden" name="action" value="forgot">
			<input type="Email" name="mail" placeholder="mail" required="">
			<button>Renvoyer</button>
			<a href="connexion.php">La mémoire m'est revenue</a>
		</form>
	</div>
</div>