<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/modele.php";
include_once "libs/maLibSecurisation.php";

// Doit être connecté
if (!valider("connecte", "SESSION")) { echo "[]"; exit; }

$idLeague = (int) valider("idLeague");
$depuis   = (int) valider("depuis");

$messages = listerMessagesLeagueDepuis($idLeague, $depuis);

// L'utilisateur est dans le chat → on marque tout comme lu
marquerLeagueLue(valider("idUser", "SESSION"), $idLeague);

echo json_encode($messages);
?>