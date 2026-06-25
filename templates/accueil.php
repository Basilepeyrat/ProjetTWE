<div id="corps">

<h1>Accueil</h1>
<p>Bienvenue dans notre site de messagerie instantanée !</p>

<?php
include_once("libs/modele.php");
$equipes = listerEquipes();
?>

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

// on récupère d'abord les matchs sur les trois jours qui nous interessent ou alors les matchs de l'equipe selectionnee
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

<?php }else
{
    $tousLesMatchs = listerMatchsTroisJours();



$matchsHier = [];
$matchsAujourdhui = [];
$matchsDemain = [];

// pour trier les match suivant leur jour
$hier = date('Y-m-d', strtotime('-1 day'));
$aujourdhui = date('Y-m-d');
$demain = date('Y-m-d', strtotime('+1 day'));


foreach ($tousLesMatchs as $match) {
    $dateDuMatch = date('Y-m-d', strtotime($match['date_match']));
    
    if ($dateDuMatch === $hier) {
        $matchsHier[] = $match;
    } elseif ($dateDuMatch === $aujourdhui) {
        $matchsAujourdhui[] = $match;
    } elseif ($dateDuMatch === $demain) {
        $matchsDemain[] = $match;
    }
}

?>

<div class="dashboard-matchs">

    <div class="colonne-matchs">
        <h2>Hier</h2>
        <div class="liste">
            <?php 
            if (empty($matchsHier)) {
                echo "<p class='no-match'>Aucun match</p>";
            } else {
                foreach ($matchsHier as $match) { 
                    afficherCarteMatch($match); 
                } 
            }
            ?>
        </div>
    </div>

    <div class="colonne-matchs colonne-active">
        <h2>Aujourd'hui</h2>
        <div class="liste">
            <?php 
            if (empty($matchsAujourdhui)) {
                echo "<p class='no-match'>Aucun match prévu</p>";
            } else {
                foreach ($matchsAujourdhui as $match) { 
                    afficherCarteMatch($match); 
                } 
            }
            ?>
        </div>
    </div>

    <div class="colonne-matchs">
        <h2>Demain</h2>
        <div class="liste">
            <?php 
            if (empty($matchsDemain)) {
                echo "<p class='no-match'>Aucun match prévu</p>";
            } else {
                foreach ($matchsDemain as $match) { 
                    afficherCarteMatch($match); 
                } 
            }
            ?>
        </div>
    </div>

</div>

</div>

<?php } ?>


 