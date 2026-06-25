<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . "/../libs/maLibUtils.php";
require_once __DIR__ . "/../libs/maLibSQL.pdo.php";
require_once __DIR__ . "/../libs/modele.php";
require_once __DIR__ . "/../libs/maLibSecurisation.php";

if (!valider("connecte", "SESSION")) { echo '{"ok":false}'; exit; }

$type    = valider("type");
$id      = (int) valider("id");
$contenu = valider("contenu");
$idUser  = valider("idUser", "SESSION");

if ($id && $contenu) {
	switch ($type) {

		case "chat":
			enregistrerMessageLeague($id, $idUser, $contenu);
			break;

		case "commentaire":
			enregistrerCommentaire($id, $idUser, $contenu);
			break;
	}
}

echo '{"ok":true}';
?>