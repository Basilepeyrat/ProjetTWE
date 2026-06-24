<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("libs/modele.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $match = getMatchById($id)[0];
} else {
    echo "Aucun match sélectionné";
    exit;
}


$nomMatch = $match['equipe_dom'] . " vs " . $match['equipe_ext'];


error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("libs/modele.php");

if (isset($_POST['note'])) {

    $match_id = intval($_GET['id']);
    $user_id = valider("idUser", "SESSION");

    $note = intval($_POST['note']);
    $vu = isset($_POST['vu']) ? 1 : 0;
    $stade = isset($_POST['stade']) ? 1 : 0;

    $mvp_id = 1; // temporaire

    // Vérifier si l'avis existe déjà
    $sqlCheck = "SELECT * FROM AVIS_MATCH 
             WHERE user_id = $user_id AND match_id = $match_id";

    $res = parcoursRS(SQLSelect($sqlCheck));

    if (count($res) > 0) {

    //on maj les données
    $sql = "UPDATE AVIS_MATCH SET 
            vu = $vu,
            note_match = $note,
            mvp_id = $mvp_id,
            present_stade = $stade
            WHERE user_id = $user_id AND match_id = $match_id";

    } else {

    //insertion
    $sql = "INSERT INTO AVIS_MATCH 
            (user_id, match_id, vu, note_match, mvp_id, present_stade)
            VALUES 
            ($user_id, $match_id, $vu, $note, $mvp_id, $stade)";
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
<form method="post" action="">

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
    <label>
        <input type="checkbox" name="vu"> J'ai vu le match
    </label>

    <br>

    <!-- Stade -->
    <label>
        <input type="checkbox" name="stade"> J'étais au stade
    </label>

    <br><br>

    <!-- Commentaire -->
    <label>Commentaire :</label><br>
    <textarea name="commentaire" rows="4" cols="40"></textarea>

    <br><br>

    <input type="submit" value="Valider">

</form>
<h2>Commentaires</h2>

<div id="commentaires">
	<?php
	$idMatch = (int) $id;
	$commentaires = listerCommentaires($idMatch, 10, 0);
	$total = compterCommentaires($idMatch);
	?>

	<?php foreach ($commentaires as $c) : ?>
		<div class="msg msg-autre">
			<span class="msg-auteur"><?php echo htmlspecialchars($c['pseudo']); ?></span>
			<span class="msg-contenu"><?php echo htmlspecialchars($c['contenu']); ?></span>
		</div>
	<?php endforeach; ?>

	<?php if (count($commentaires) == 0) : ?>
		<p class="vide">Aucun commentaire pour ce match.</p>
	<?php endif; ?>
</div>

<?php if ($total > 10) : ?>
	<button id="voir-plus" data-offset="10" data-match="<?php echo $idMatch; ?>">Voir plus de commentaires</button>
<?php endif; ?>
</div>