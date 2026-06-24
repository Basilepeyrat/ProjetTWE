<?php
$equipes = listerEquipes();
?>

<form method="get">
    <input type="hidden" name="view" value="stats">

    <select name="equipe_id" onchange="this.form.submit()">
        <option value="">Choisir une équipe</option>
        <?php foreach ($equipes as $e) { ?>
            <option value="<?= $e['id'] ?>"
                <?= (isset($_GET['equipe_id']) && $_GET['equipe_id'] == $e['id']) ? "selected" : "" ?>>
                <?= $e['nom'] ?>
            </option>
        <?php } ?>
    </select>
</form>

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