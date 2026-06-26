<?php
//basile: ce fichier permet de récuperer les nouveaux chats dans la league ou dans les commentaires d'un match 
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . "/../libs/maLibUtils.php";
require_once __DIR__ . "/../libs/maLibSQL.pdo.php";
require_once __DIR__ . "/../libs/modele.php";
require_once __DIR__ . "/../libs/maLibSecurisation.php";

if (!valider("connecte", "SESSION")) { echo "[]"; exit; }

$type   = valider("type");
$id     = (int) valider("id");
$depuis = (int) valider("depuis");
$idUser = valider("idUser", "SESSION");

switch ($type) {

	case "chat":
		$data = listerMessagesLeagueDepuis($id, $depuis);
		marquerLeagueLue($idUser, $id);
		break;

	case "commentaire":
		$data = listerCommentairesDepuis($id, $depuis);
		break;

	default:
		$data = [];
}

echo json_encode($data);
?>