<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

$msgHTML = ""; 
if ($msg = valider("msg")) {
	$msg = stripslashes($msg);
	$msgHTML = "<h1 style=\"color:red;\">$msg</h1>";
	// $msgHTML = '<h1 style="color:red;">$msg</h1>';
	// n'afficherait pas la valeur de $msg 
}
?>

<div id="corps">

<h1>Connexion</h1>

<?=$msgHTML?>

<div id="formLogin">
<form action="controleur.php" method="GET">
Login : <input type="text" name="login" /><br />
Passe : <input type="password" name="passe" /><br />
<input type="submit" name="action" value="Connexion" />
</form>
<a href="index.php?view=inscription">Pas de compte ? Créer un compte</a>

</div>


</div>
