<!-- Basile: page qui permet d'avoir un chat de league ou les memebres peuvent discuter ensemble des différents matchs
-->
<?php
if (basename($_SERVER["PHP_SELF"]) == "chat.php") {
	header("Location:../index.php?view=leagues");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibSecurisation.php");

securiser("login"); // page privée
$idUser   = valider("idUser", "SESSION");
$idLeague = valider("idLeague");
$league   = getLeague($idLeague);
securiserMembre($idUser, $idLeague);

if (!$league) {
	echo '<p class="vide">League introuvable.</p>';
	return; // stoppe le template ici, on revient à index.php
}
?>

<div class="page-entete">
	<a class="btn-plus" href="index.php?view=league&amp;idLeague=<?php echo $league['id']; ?>" aria-label="Retour">←</a>
	<h1 class="lg-titre"><?php echo htmlspecialchars($league['nom']); ?> · chat</h1>
</div>

<div id="chat" class="chat-box">
	<?php $messages = listerMessagesLeague($idLeague); ?>

	<?php if (count($messages) == 0) : ?>
		<p class="vide">Aucun message. Lance la conversation !</p>
	<?php endif; ?>

	<?php foreach ($messages as $msg) : ?>
		<?php $estMoi = ($msg['user_id'] == $idUser); ?>
		<div class="msg <?php echo $estMoi ? 'msg-moi' : 'msg-autre'; ?>">
			<?php if (!$estMoi) : ?>
				<span class="msg-auteur"><?php echo htmlspecialchars($msg['pseudo']); ?></span>
			<?php endif; ?>
			<span class="msg-contenu"><?php echo htmlspecialchars($msg['contenu']); ?></span>
		</div>
	<?php endforeach; ?>
</div>
<?php $dernierId = count($messages) ? $messages[count($messages) - 1]['id'] : 0; ?>

<form class="chat-form" method="post" action="controleur.php">
	<input type="hidden" name="idLeague" value="<?php echo $league['id']; ?>" />
	<input type="text" name="contenu" placeholder="Écrire un message…" autocomplete="off" required="required" />
	<button type="submit" name="action" value="Envoyer message" aria-label="Envoyer">➤</button>
</form>


<script>
initMessagerie({
	type: 'chat',
	id: <?php echo (int) $idLeague; ?>,
	monId: <?php echo (int) $idUser; ?>,
	dernierId: <?php echo (int) $dernierId; ?>,
	boxId: 'chat',
	formSelector: '.chat-form'
});
</script>