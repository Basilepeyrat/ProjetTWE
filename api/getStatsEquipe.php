<?php
include_once("../libs/modele.php");
header('Content-Type: application/json');

$equipe_id = intval($_GET['equipe_id']);

$stats = getStatsMatchs($equipe_id);
$note = getNoteMoyenne($equipe_id);
$mvp = getMVP($equipe_id);

echo json_encode([
    "joues" => $stats['joues'],
    "gagnes" => $stats['gagnes'],
    "nuls" => $stats['nuls'],
    "perdus" => $stats['perdus'],
    "moyenne" => round($note['moyenne'], 2),
    "mvp" => $mvp ? $mvp['prenom']." ".$mvp['nom'] : "Aucun"
]);

?>