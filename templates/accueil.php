<div id="corps">

<h1>Accueil</h1>

Bienvenue dans notre site de messagerie instantanée !

<h2>Matchs</h2>

<?php
include_once("libs/modele.php");

// Récupération des matchs
$matchs = listerMatchs();

// Affichage
foreach ($matchs as $match) {
    echo "<div class='match'>";
    
    echo "<a href='index.php?view=notation&id=".$match['id']."'>";
    
    echo $match['equipe_dom'] . " ";
    echo "<strong>" . $match['score_dom'] . " - " . $match['score_ext'] . "</strong> ";
    echo $match['equipe_ext'];
    
    echo "</a>";
    
    if (!empty($match['mvp_nom'])) {
        echo "<br><em>MVP : " . $match['mvp_nom'] . "</em>";
    } else {
        echo "<br><em>MVP : à venir</em>";
    }

    echo "</div><br>";
}
?>

</div>