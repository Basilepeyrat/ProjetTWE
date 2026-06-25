<?php
$equipes = listerEquipes();
?>

<select id="equipeSelect">
    <option value="">Choisir une équipe</option>
    <?php foreach ($equipes as $e) { ?>
        <option value="<?= $e['id'] ?>">
            <?= $e['nom'] ?>
        </option>
    <?php } ?>
</select>

<div id="stats"></div>

<?php
if (isset($_GET['equipe_id'])) {
    $equipe_id = intval($_GET['equipe_id']);
}
?>


<?php
if (isset($equipe_id)) {

    $stats = getStatsMatchs($equipe_id);
    $note = getNoteMoyenne($equipe_id);
    $mvp = getMVP($equipe_id);
?>

<h2>Statistiques</h2>

<p>Matchs joués : <?= $stats['joues'] ?></p>
<p>Gagnés : <?= $stats['gagnes'] ?></p>
<p>Nuls : <?= $stats['nuls'] ?></p>
<p>Perdus : <?= $stats['perdus'] ?></p>

<p>Note moyenne : <?= round($note['moyenne'], 2) ?></p>

<p>
MVP le plus choisi :
<?php
if ($mvp) {
    echo $mvp['prenom'] . " " . $mvp['nom'];
} else {
    echo "Aucun";
}
?>
</p>

<?php } ?>


<script src="js/jquery-4.0.0.min.js"></script>

<script>
$(document).ready(function() {

$("#equipeSelect").change(function() {

    let id = $(this).val();

    if (id == "") return;

    $.ajax({
        url: "ajax/getStatsEquipe.php",
        data: { equipe_id: id },
        dataType: "json",
        success: function(data) {

            let html = `
                <h2>Statistiques</h2>
                <p>Matchs joués : ${data.joues}</p>
                <p>Gagnés : ${data.gagnes}</p>
                <p>Nuls : ${data.nuls}</p>
                <p>Perdus : ${data.perdus}</p>
                <p>Note moyenne : ${data.moyenne}</p>
                <p>MVP : ${data.mvp}</p>
            `;

            $("#stats").html(html);
        }
    });

});
});
</script>