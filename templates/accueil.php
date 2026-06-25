<div id="corps">

<h1>Accueil</h1>
<p>Bienvenue dans notre site de messagerie instantanée !</p>

<?php
include_once("libs/modele.php");
$equipes = listerEquipes();
$poules  = listerPoules();
?>

<div class="controles-accueil">

<h2>Recherche par équipe</h2>

<form method="get" action="index.php">

    <input type="hidden" name="view" value="accueil">

    <select name="equipe_id" onchange="this.form.submit()">
        <option value="">Toutes les équipes</option>

        <?php foreach($equipes as $e) { ?>

            <option value="<?= $e['id'] ?>"
                <?= (isset($_GET['equipe_id']) && $_GET['equipe_id'] == $e['id']) ? 'selected' : '' ?>>
                <?= $e['nom'] ?>
            </option>

        <?php } ?>

    </select>

</form>

<?php if (isset($_GET['equipe_id']) && $_GET['equipe_id'] != "") { ?>
    <a class="btn-retour-calendrier" href="index.php?view=accueil">
        Retour au calendrier
    </a>
<?php } ?>

<?php
// Filtre tous / mes matchs vus — affiché seulement hors recherche par équipe
if (!isset($_GET['equipe_id']) || $_GET['equipe_id'] == "") { ?>
    <h2>Filtre</h2>
    <form method="get" action="index.php" style="display:inline">
        <input type="hidden" name="view" value="accueil" />
        <select name="filtre" onchange="this.form.submit()">
            <option value="">Tous les matchs</option>
            <option value="vus" <?= (isset($_GET['filtre']) && $_GET['filtre'] == "vus") ? "selected" : "" ?>>Mes matchs vus</option>
        </select>
        <select name="poule" onchange="this.form.submit()">
            <option value="">Toutes les poules</option>
            <?php foreach ($poules as $p): ?>
                <option value="<?= $p['poule'] ?>" <?= (isset($_GET['poule']) && $_GET['poule'] == $p['poule']) ? "selected" : "" ?>>
                    Poule <?= $p['poule'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
<?php } ?>

</div><!-- /controles-accueil -->

<h2>Matchs</h2>

<?php

function afficherCarteMatch($match) {
    echo "<div class='match-card'>";
    echo "<a href='index.php?view=notation&id=".$match['id']."'>";
    echo "<span class='team-name'>" . $match['equipe_dom'] . "</span>";
    echo " <strong class='score'>" . ($match['score_dom'] !== null ? $match['score_dom'] : '-') . " - " . ($match['score_ext'] !== null ? $match['score_ext'] : '-') . "</strong> ";
    echo "<span class='team-name'>" . $match['equipe_ext'] . "</span>";
    echo "<div class='match-time'>" . date('d/m H:i', strtotime($match['date_match'])) . "</div>";
    echo "</a>";
    echo "</div>";
}

// Soit les matchs d'une équipe sélectionnée, soit tous les matchs (ou seulement ceux vus)
if (isset($_GET['equipe_id']) && $_GET['equipe_id'] != "")
{
    $tousLesMatchs = listerMatchsEquipe((int)$_GET['equipe_id']); ?>

    <h2>Tous les matchs de l'équipe</h2>

    <div class="liste">
    <?php
    foreach($tousLesMatchs as $match)
    {
        afficherCarteMatch($match);
    }
    ?>
    </div>

<?php }
else
{
    // Filtres combinables : poule et/ou "mes matchs vus" (sinon tous les matchs)
    $idUser = valider("idUser", "SESSION");
    $vus    = (valider("filtre") == "vus");
    $poule  = valider("poule");

    $tousLesMatchs = listerMatchsFiltres($poule, $vus, $idUser);

    // pour insérer un titre de date à chaque changement de jour
    $aujourdhui   = date('Y-m-d');
    $dateCourante = null;
    ?>

    <div class="liste">
    <?php foreach ($tousLesMatchs as $match):
        $jour = date('Y-m-d', strtotime($match['date_match']));
        if ($jour !== $dateCourante):
            $dateCourante  = $jour;
            $estAujourdhui = ($jour === $aujourdhui);
    ?>
        <h2 <?= $estAujourdhui ? 'id="aujourdhui"' : '' ?>>
            <?= $estAujourdhui ? "Aujourd'hui" : date('d/m/Y', strtotime($jour)) ?>
        </h2>
    <?php endif; ?>

        <?php afficherCarteMatch($match); ?>

    <?php endforeach; ?>

    <?php if (count($tousLesMatchs) == 0): ?>
        <p class="no-match">Aucun match.</p>
    <?php endif; ?>
    </div>

<?php } ?>

</div>

<script>
// au chargement, on se positionne directement sur les matchs d'aujourd'hui (s'il y en a)
var auj = document.getElementById('aujourdhui');
if (auj) auj.scrollIntoView();
</script>
