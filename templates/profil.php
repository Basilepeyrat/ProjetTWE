<?php
// Vue "profil" — placeholder (à développer : Hugo)
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=profil");
	die("");
}
?>

<div id="corps">

<h1>Mon Profil</h1>

Photo de profil, équipe et joueur préférés, déconnexion...

</div>
