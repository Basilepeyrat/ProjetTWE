<?php
// Page liste des leagues de l'utilisateur — auteur : Basile
if (basename($_SERVER["PHP_SELF"]) == "leagues.php") {
	header("Location:../index.php?view=leagues");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibSecurisation.php");

securiser("login"); // page privée

$idUser  = valider("idUser", "SESSION");
$leagues = listerLeaguesUtilisateur($idUser);
?>

<div id="leagues">

	<!-- Créer une nouvelle league -->
	<form class="league-new" method="get" action="controleur.php">
		<input type="text" name="nom" placeholder="nouvelle league" required="required" />
		<button type="submit" name="action" value="Creer league" class="btn-plus">+</button>
	</form>

	<!-- Liste des leagues de l'utilisateur -->
	<ul class="league-list">
		<?php foreach ($leagues as $lg) : ?>
			<li>
				<a href="index.php?view=league&amp;idLeague=<?php echo $lg['id']; ?>">
					<span class="lg-nom"><?php echo htmlspecialchars($lg['nom']); ?></span>
					<span class="lg-badge"><?php echo $lg['nb_membres']; ?> 👤</span>
				</a>
			</li>
		<?php endforeach; ?>

		<?php if (count($leagues) == 0) : ?>
			<li class="vide">Aucune league pour l'instant — crée la première !</li>
		<?php endif; ?>
	</ul>

</div>

