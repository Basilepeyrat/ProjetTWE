<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/modele.php";
include_once "libs/maLibSecurisation.php";

if (!valider("connecte", "SESSION")) { echo '{"ok":false}'; exit; }

$idLeague = (int) valider("idLeague");
$contenu  = valider("contenu");

if ($idLeague && $contenu) {
	enregistrerMessageLeague($idLeague, valider("idUser", "SESSION"), $contenu);
}
echo '{"ok":true}';
?>