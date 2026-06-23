<?php
if (basename($_SERVER["PHP_SELF"]) == "demandes.php") {
	header("Location:../index.php?view=leagues");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibSecurisation.php");

securiser("login");

$idUser   = valider("idUser", "SESSION");
$idLeague = valider("idLeague");
$league   = getLeague($idLeague);

if (!$league) {
	echo '<p class="vide">League introuvable.</p>';
	return;
}
// Sécurité : seul le créateur accède à cette page
if ($league['createur_id'] != $idUser) {
	echo '<p class="vide">Accès réservé au créateur de la league.</p>';
	return;
}

$demandes = listerDemandesEnAttente($idLeague);
?>

<div class="page-entete">
	<a class="retour" href="index.php?view=league&amp;idLeague=<?php echo $league['id']; ?>" aria-label="Retour">←</a>
	<h1 class="lg-titre"><?php echo htmlspecialchars($league['nom']); ?> · demandes</h1>
</div>

<ul class="league-list">
	<?php foreach ($demandes as $d) : ?>
		<li class="league-row">
			<span class="lg-nom-lien"><?php echo htmlspecialchars($d['pseudo']); ?></span>
			<a class="btn-ok" href="controleur.php?action=Accepter+demande&amp;idInvitation=<?php echo $d['id']; ?>&amp;idLeague=<?php echo $idLeague; ?>">Accepter</a>
			<a class="btn-non" href="controleur.php?action=Refuser+demande&amp;idInvitation=<?php echo $d['id']; ?>&amp;idLeague=<?php echo $idLeague; ?>">Refuser</a>
		</li>
	<?php endforeach; ?>

	<?php if (count($demandes) == 0) : ?>
		<li class="vide">Aucune demande en attente.</li>
	<?php endif; ?>
</ul>