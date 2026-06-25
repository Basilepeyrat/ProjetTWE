<?php
include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibSecurisation.php");

securiser("login");                          // 1) connecté ?

$idUser = valider("idUser", "SESSION");      // 2) variables
$id     = valider("id");

$matchData = getMatchById($id);   

      // 3) le match existe ?
if (!$matchData) {
	echo '<p class="vide">Match introuvable.</p>';
	return;
}
$match   = $matchData[0];
$idMatch = (int) $id;
$joueurs = listerJoueursMatch($idMatch);


$nomMatch = $match['equipe_dom'] . " vs " . $match['equipe_ext'];


error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_POST['note'])) {

    $match_id = $idMatch;
    $user_id  = $idUser;

    $note = intval($_POST['note']);
    $vu_ou   = !empty($_POST['vu_ou']) ? $_POST['vu_ou'] : null;
    $vuOuVal = $vu_ou ? "'$vu_ou'" : "NULL";

    $mvp_id = !empty($_POST['mvp_id']) ? intval($_POST['mvp_id']) : null;
    $mvpVal = $mvp_id ? $mvp_id : "NULL";
    
    // Vérifier si l'avis existe déjà
    $sqlCheck = "SELECT * FROM AVIS_MATCH 
             WHERE user_id = $user_id AND match_id = $match_id";
    

    $res = parcoursRS(SQLSelect($sqlCheck));

    if (count($res) > 0) {

    //on maj les données
    $sql = "UPDATE AVIS_MATCH SET 
            note_match = $note,
            mvp_id = $mvpVal,
            vu_ou = $vuOuVal
            WHERE user_id = $user_id AND match_id = $match_id";

    } else {

    //insertion
    $sql = "INSERT INTO AVIS_MATCH 
        (user_id, match_id, note_match, mvp_id, vu_ou)
        VALUES 
        ($user_id, $match_id, $note, $mvpVal, $vuOuVal)";
}
SQLInsert($sql);

    if (!empty($_POST['commentaire'])) {
    $contenu = addslashes($_POST['commentaire']);
    $sql2 = "INSERT INTO COMMENTAIRE (user_id, match_id, contenu)
             VALUES ($user_id, $match_id, '$contenu')";
    SQLInsert($sql2);
}

    echo "<p style='color:green;'>Avis enregistré !</p>";
}

?>



<div id="corps">

<h1>Notation du match</h1>

<!-- Nom du match -->
<h2>
<?= $nomMatch ?>
</h2>

<!-- Formulaire -->
<form method="post" action="" >

    <!-- Note -->
    <label>Note du match :</label>
    <select name="note">
        <?php
        for ($i = 0; $i <= 10; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>

    <br><br>

    <!-- Vu -->
    <label>Où avez-vous vu le match ?</label>
    <select name="vu_ou">
        <option value="">Pas vu</option>
        <option value="maison">À la maison</option>
        <option value="bar">Au bar</option>
        <option value="stade">Au stade</option>
    </select>

    <br><br>

    <br><br>

    <label>MVP du match :</label>
    <select name="mvp_id">
        <?php foreach ($joueurs as $j) { ?>
            <option value="<?= $j['id'] ?>">
                <?= $j['prenom'] . " " . $j['nom'] ?>
            </option>
        <?php } ?>
    </select>


    <input type="submit" value="Valider">

</form>
</div>


<h2>Commentaires</h2>

<div id="commentaires" class="chat-box">
	<?php $commentaires = listerCommentairesDepuis($idMatch, 0); ?>

	<?php if (count($commentaires) == 0) : ?>
		<p class="vide">Aucun commentaire pour ce match.</p>
	<?php endif; ?>

	<?php foreach ($commentaires as $c) : ?>
		<?php $estMoi = ($c['user_id'] == $idUser); ?>
		<div class="msg <?php echo $estMoi ? 'msg-moi' : 'msg-autre'; ?>">
			<?php if (!$estMoi) : ?>
				<span class="msg-auteur"><?php echo htmlspecialchars($c['pseudo']); ?></span>
			<?php endif; ?>
			<span class="msg-contenu"><?php echo htmlspecialchars($c['contenu']); ?></span>
		</div>
	<?php endforeach; ?>
</div>


<form class="chat-form" method="post" action="controleur.php">
	<input type="hidden" name="id" value="<?php echo $idMatch; ?>" />
	<input type="text" name="contenu" placeholder="Écrire un commentaire…" autocomplete="off" required="required" />
	<button type="submit" name="action" value="Envoyer commentaire" aria-label="Envoyer">➤</button>
</form>


<script>
initMessagerie({
	type: 'commentaire',
	id: <?php echo (int) $idMatch; ?>,
	monId: <?php echo (int) $idUser; ?>,
	dernierId: <?php echo (int) (count($commentaires) ? end($commentaires)['id'] : 0); ?>,
	boxId: 'commentaires',
	formSelector: '.comment-form'
});
</script>
