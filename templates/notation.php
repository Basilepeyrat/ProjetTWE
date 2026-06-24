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
    $user_id = 2;

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
        $date = date("Y-m-d H:i:s");

        $sqlCheck = "SELECT * FROM COMMENTAIRE 
                 WHERE user_id = $user_id AND match_id = $match_id";

        $res = parcoursRS(SQLSelect($sqlCheck));

        if (count($res) > 0) {

        //on maj les données
        $sql = "UPDATE COMMENTAIRE SET 
            contenu = $contenu,
            date = $date
            WHERE user_id = $user_id AND match_id = $match_id";

        }else{


        $sql2 = "INSERT INTO COMMENTAIRE
                (user_id, match_id, contenu, date_pub)
                VALUES
                ($user_id, $match_id, '$contenu', '$date')";
        }

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

</div>