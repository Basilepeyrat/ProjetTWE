<?php
// Page d'une league (dashboard + chat) — auteur : Basile
if (basename($_SERVER["PHP_SELF"]) == "league.php") {
	header("Location:../index.php?view=leagues");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibSecurisation.php");

securiser("login"); // page privée
securiserMembre($idUser, $idLeague);
$idUser   = valider("idUser", "SESSION");
$idLeague = valider("idLeague");
$league   = getLeague($idLeague);

if (!$league) {
	echo '<p class="vide">League introuvable.</p>';
	return; // stoppe le template ici, on revient à index.php
}

marquerLeagueLue($idUser, $idLeague);

?>
<div class="page-entete">
	<?php if ($league['createur_id'] == $idUser) : ?>
		<a class="reglages" href="index.php?view=demandes&amp;idLeague=<?php echo $league['id']; ?>" aria-label="Gérer les demandes">⚙</a>
	<?php endif; ?>
	<a class="retour" href="index.php?view=leagues" aria-label="Retour">←</a>
	<h1 class="lg-titre"><?php echo htmlspecialchars($league['nom']); ?> - Id:<?php echo $league['id']; ?></h1>
</div>

<a class="chat-acces" href="index.php?view=chat&amp;idLeague=<?php echo $league['id']; ?>">
	💬 Ouvrir le chat
</a>

<?php
$equipePref = getEquipePrefereeLeague($idLeague);
$mvp = getMVPLigue($idLeague);
$topViewer = getTopViewerLeague($idLeague);
?>

<h2>Statistiques de la league</h2>

<p>
Equipe favorite de la league :
<?php echo $equipePref ? $equipePref['nom'] : "Aucune"; ?>
</p>

<p>
MVP le plus choisi :
<?php echo $mvp ? $mvp['prenom']." ".$mvp['nom'] : "Aucun"; ?>
</p>

<p>
Utilisateur ayant vu le plus de matchs :
<?php echo $topViewer ? $topViewer['pseudo']." (".$topViewer['nb']." matchs)" : "Aucun"; ?>
</p>