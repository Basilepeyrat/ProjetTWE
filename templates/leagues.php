<?php

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
	
	<!-- rechercher une nouvelle league -->
	<form class="league-search" method="get" action="index.php">
		<input type="hidden" name="view" value="leagues" />
		<input type="text" name="rechercheLeague" placeholder="Rechercher une league" />
		<button type="submit" class="btn-plus" aria-label="Rechercher">🔍</button>
	</form>


	<?php
	$idRecherche = valider("rechercheLeague");
	if ($idRecherche) :
		$apercu = apercuLeague($idRecherche);
	?>
		<?php if (!$apercu) : ?>
			<p class="vide">Aucune league avec l'ID <?php echo htmlspecialchars($idRecherche); ?>.</p>
		<?php else : ?>
			<ul class="league-list">
				<li class="league-row">
					<div class="lg-nom-lien">
						<?php echo htmlspecialchars($apercu['nom']); ?>
						<span class="lg-sous">par <?php echo htmlspecialchars($apercu['createur']); ?></span>
					</div>
					<a class="lg-rejoindre" href="controleur.php?action=Demander+a+rejoindre&amp;idLeague=<?php echo $apercu['id']; ?>">
						Rejoindre
					</a>
				</li>
			</ul>
		<?php endif; ?>
	<?php endif; ?>	
	<!-- Liste des leagues de l'utilisateur -->
	<ul class="league-list">
		<?php foreach ($leagues as $lg) : ?>
			<li class="league-row">
				<a class="lg-nom-lien" href="index.php?view=league&amp;idLeague=<?php echo $lg['id']; ?>">
					<?php echo htmlspecialchars($lg['nom']); ?>
				</a>
				<a class="lg-chat" href="index.php?view=chat&amp;idLeague=<?php echo $lg['id']; ?>" aria-label="Ouvrir le chat">					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 9.5 9.5 0 0 1-4-.9L3 21l1.9-5.5a8.38 8.38 0 0 1-.9-4A8.5 8.5 0 0 1 12.5 3 8.38 8.38 0 0 1 21 11.5Z" />
					</svg>
					<?php if ($lg['nb_non_lus'] > 0) : ?>
						<span class="lg-badge"><?php echo $lg['nb_non_lus']; ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>

		<?php if (count($leagues) == 0) : ?>
			<li class="vide">Aucune league pour l'instant — crée ou rejoint une league !</li>
		<?php endif; ?>
	</ul>
</div>

