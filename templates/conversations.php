<?php
// Ce fichier permet de tester les fonctions développées dans le fichier malibforms.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "conversations.php")
{
	header("Location:../index.php?view=conversations");
	die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...
include_once("libs/maLibSecurisation.php");

// Page privée : accessible uniquement aux utilisateurs connectés
securiser("login");

$idLastConv = valider("idLastConv");

?>

<h1>Conversations du site</h1>

<h2>Liste des conversations actives (mkLiens vers le chat)</h2>

<?php
// Ex5.4 : utilisation de mkLiens à la place de mkTable
// chaque thème devient un lien cliquable vers la vue chat
$conversations = listerConversations("actives");
mkLiens($conversations, "theme", "id", "index.php?view=chat", "idConv");
?>

<h2>Liste des conversations inactives</h2>

<?php
// Ex5.2 : mkTable en n'affichant que id et theme dans cet ordre
$conversations = listerConversations("inactives");
mkTable($conversations, array("id", "theme"));
?>

<hr />
<h2>Gestion des conversations</h2>

<?php
// Ex5.5 : formulaire de changement d'état (archiver / réactiver / supprimer)
// utilise mkForm + mkSelect + mkInput
$conversations = listerConversations(); // toutes

mkForm("controleur.php", "get");
// Ex5.6 : auto-sélection de la dernière conversation éditée via idLastConv
mkSelect("idConv", $conversations, "id", "theme", $idLastConv);
echo "<br />";
mkInput("submit", "action", "Archiver");
mkInput("submit", "action", "Reactiver");
// Ex5.7 : suppression
mkInput("submit", "action", "Supprimer conversation");
endForm();
?>

<h2>Ajouter une nouvelle conversation</h2>

<?php
// Ex5.8 : formulaire de création
mkForm("controleur.php", "get");
echo "Thème : ";
mkInput("text", "theme");
echo "<br />";
mkInput("submit", "action", "Creer conversation");
endForm();
?>
