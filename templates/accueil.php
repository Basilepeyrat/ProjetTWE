<div id="corps">

<h1>Accueil</h1>
<p>Bienvenue dans notre site de messagerie instantanée !</p>

<h2>Matchs</h2>

<?php
include_once("libs/modele.php");

// 1. Récupération de tous les matchs des 3 jours (via la nouvelle fonction)
$tousLesMatchs = listerMatchsTroisJours();

// 2. Préparation des paniers pour trier les matchs
$matchsHier = [];
$matchsAujourdhui = [];
$matchsDemain = [];

// Dates de repère (au format Y-m-d pour la comparaison)
$hier = date('Y-m-d', strtotime('-1 day'));
$aujourdhui = date('Y-m-d');
$demain = date('Y-m-d', strtotime('+1 day'));

// Tri automatique des matchs dans le bon panier
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

// Fonction utilitaire pour générer le code HTML d'une carte de match
function afficherCarteMatch($match) {
    echo "<div class='match-card'>";
    echo "<a href='index.php?view=notation&id=".$match['id']."'>";
    echo "<span class='team-name'>" . $match['equipe_dom'] . "</span>";
    echo " <strong class='score'>" . ($match['score_dom'] !== null ? $match['score_dom'] : '-') . " - " . ($match['score_ext'] !== null ? $match['score_ext'] : '-') . "</strong> ";
    echo "<span class='team-name'>" . $match['equipe_ext'] . "</span>";
    echo "<div class='match-time'>" . date('H:i', strtotime($match['date_match'])) . "</div>";
    echo "</a>";
    echo "</div>";
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
