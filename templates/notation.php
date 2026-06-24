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