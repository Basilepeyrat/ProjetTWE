
<?php
//basile: cette page permet d'afficher les statistiques d'une league avec le bouton de retour vers les leagues et un bouton de paramètre pour le créateur de la league
if (basename($_SERVER["PHP_SELF"]) == "league.php") {
	header("Location:../index.php?view=leagues");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibSecurisation.php");


//Basile: sécurité de la page, seul un utilisateur peut acceder à cette page privée
securiser("login"); // page privée
$idUser   = valider("idUser", "SESSION");
$idLeague = valider("idLeague");
$league   = getLeague($idLeague);
securiserMembre($idUser, $idLeague);

if (!$league) {
	echo '<p class="vide">League introuvable.</p>';
	return; // on revient à index.php si la league n'existe pas
}

marquerLeagueLue($idUser, $idLeague);

?>
<!-- Basile: On ajoute un header sur la page avec une gestion des utilisateurs de la league.
     Pour l'instant on ne peut qu'accepter ou refuser la demande d'un utilisateur.
	On rajoute un bouton pour revenir en arrière pour acceder aux différentes leagues
-->
<div class="page-entete">
	<?php if ($league['createur_id'] == $idUser) : ?>
		<a class="reglages" href="index.php?view=demandes&amp;idLeague=<?php echo $league['id']; ?>" aria-label="Gérer les demandes"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg></a>
		<?php endif; ?>
	<a class="retour" href="index.php?view=leagues" aria-label="Retour"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left-icon lucide-move-left"><path d="M6 8L2 12L6 16"/><path d="M2 12H22"/></svg></a>
	<h1 class="lg-titre"><?php echo htmlspecialchars($league['nom']); ?> - Id:<?php echo $league['id']; ?></h1>
</div>


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




<!-- Basile: on permet aussi l'acces au chat de league-->
<a class="chat-acces" href="index.php?view=chat&amp;idLeague=<?php echo $league['id']; ?>">
	💬 Ouvrir le chat
</a>