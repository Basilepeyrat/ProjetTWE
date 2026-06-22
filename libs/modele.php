<?php

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles pour notre TP d'identification. Deux parties sont à compléter, en suivant les indications données dans le support de TP
*/


/********* EXERCICE 2 : prise en main de la base de données *********/


// inclure ici la librairie faciliant les requêtes SQL (en veillant à interdire les inclusions multiples)
include_once("libs/maLibSQL.pdo.php");

function listerUtilisateurs($classe = "both")
{
	$SQL = "SELECT id,pseudo,blacklist,couleur,admin FROM users";
	
	if ($classe == "bl") 
		$SQL = $SQL . " WHERE blacklist=1";

	if ($classe == "nbl") 
		$SQL .= " WHERE blacklist=0";
		
	// die($SQL);
	
	$rs = SQLSelect($SQL); // resource mySQL : un objet
	$tab = parcoursRS($rs);
	
	
	return $tab; 

	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,couleur

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
	// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés

	$SQL = "select * from users";
	return parcoursRs(SQLSelect($SQL));

}

function interdireUtilisateur($idUser)
{
	// NEVER TRUST USER INPUT
	// exemple : ?action=Interdire&idUser=3;DROP TABLE users;
	// INJECTION SQL 
	// approche PRO : requêtes préparées 
	// equivalent d'un printf("format contenant des %s", argument)
	
	// dans ce projet pédagogique : 2 contre-mesures
	// 1) encadrer les entrées par des apostrophes
	// Insuffisant si on injecte
	// exemple : ?action=Interdire&idUser=3';DROP TABLE users;'; 
	// 2) banaliser les caractères spéciaux des entrées utilisateur 
	// "échapper" : on ajoute \ avant le caractère
	// cf. valider le fait déjà en utilisant addslashes !!
	
	// cette fonction affecte le booléen "blacklist" à vrai 
	$SQL ="UPDATE users SET blacklist=1 WHERE id='$idUser'";
	SQLUpdate($SQL); 
}

function autoriserUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	$SQL ="UPDATE users SET blacklist=0 WHERE id='$idUser'";
	SQLUpdate($SQL); 
}

function updateAdmin($idUser, $val)
{ 
	$SQL ="UPDATE users SET admin=$val WHERE id='$idUser'";
	SQLUpdate($SQL); 
}

function supprimerUtilisateur($idUser)
{ 
	$SQL ="DELETE FROM users WHERE id='$idUser'";
	SQLDelete($SQL); 
}

function ajouterUtilisateur($pseudo,$passe)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	// Adapté au schéma ProjetTWE : table UTILISATEUR, colonne mot_de_passe.
	// pdp est NOT NULL → on insère une chaîne vide par défaut.
	$SQL ="INSERT INTO UTILISATEUR(pseudo, mot_de_passe, pdp) VALUES ('$pseudo','$passe','') ";
	return SQLInsert($SQL); // renvoie l'id de l'utilisateur créé
}

/********* EXERCICE 4 *********/

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	// Adapté au schéma ProjetTWE : table UTILISATEUR, colonne mot_de_passe.
	$SQL = "SELECT id FROM UTILISATEUR WHERE pseudo='$login' AND mot_de_passe='$passe'";

	// On utilise SQLGetChamp
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
	
	return SQLGetChamp($SQL); 
	// $tab = parcoursRs(SQLSelect($SQL)); 
	// if (count($tab)) return $tab[0]["id"]; 
}

function isAdmin($idUser)
{
	// Le schéma ProjetTWE n'a pas (encore) de notion d'administrateur dans UTILISATEUR.
	// On renvoie 0 pour ne pas planter sur une colonne inexistante.
	// Si tu ajoutes une colonne `admin` à UTILISATEUR plus tard, remplace par :
	//   $SQL = "SELECT admin FROM UTILISATEUR WHERE id='$idUser'"; return SQLGetChamp($SQL);
	return 0;
}

/********* EXERCICE 5 *********/

function listerConversations($mode="tout")
{
	// Liste toutes les conversations ($mode="tout")
	// OU uniquement celles actives  ($mode="actives"), ou inactives  ($mode="inactives")
	$SQL = "SELECT id, theme, active FROM conversations";
	if ($mode == "actives")   $SQL .= " WHERE active=1";
	if ($mode == "inactives") $SQL .= " WHERE active=0";
	return parcoursRs(SQLSelect($SQL));
}

function archiverConversation($idConversation)
{
	// rend une conversation inactive
	$SQL = "UPDATE conversations SET active=0 WHERE id='$idConversation'";
	SQLUpdate($SQL);
}

function reactiverConversation($idConversation)
{
	// rend une conversation active
	$SQL = "UPDATE conversations SET active=1 WHERE id='$idConversation'";
	SQLUpdate($SQL);
}

function creerConversation($theme)
{
	// crée une nouvelle conversation et renvoie son identifiant
	$SQL = "INSERT INTO conversations(theme, active) VALUES ('$theme', 1)";
	return SQLInsert($SQL);
}

function supprimerConversation($idConv)
{
	// supprime une conversation et ses messages
	// On supprime d'abord les messages associés (intégrité référentielle),
	// puis la conversation elle-même
	SQLDelete("DELETE FROM messages WHERE idConversation='$idConv'");
	SQLDelete("DELETE FROM conversations WHERE id='$idConv'");
}


/********* EXERCICE 6 *********/

function enregistrerMessage($idConversation, $idAuteur, $contenu)
{
	// Enregistre un message dans la base en encodant les caractères spéciaux HTML : <, > et & 
	// pour interdire les messages HTML

	
}
function listerMessages($idConv)
{
	// Liste les messages de cette conversation
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés


}

function listerMessagesFromIndex($idConv,$index)
{
	// Liste les messages de cette conversation, 
	// dont l'id est superieur à l'identifiant passé
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés

}

function getConversation($idConv)
{	
	// Récupère les données de la conversation (theme, active)
	$SQL = "SELECT theme, active FROM conversations WHERE id='$idConv'";
	$listConversations = parcoursRs(SQLSelect($SQL));

	// Attention : parcoursRS nous renvoie un tableau contenant potentiellement PLUSIEURS CONVERSATIONS
	// Il faut renvoyer uniquement la première case de ce tableau, c'est à dire la case 0 
	// OU false si la conversation n'existe pas
	 
	if (count($listConversations) == 0) return false;
	else return $listConversations[0];
}


function listerLeaguesUtilisateur($idUser)
{
	$SQL = "SELECT L.id, L.nom, L.createur_id, COUNT(Mtous.user_id) AS nb_membres
			FROM LEAGUE L
			JOIN MEMBRE_LEAGUE Mmoi  ON Mmoi.league_id = L.id AND Mmoi.user_id = '$idUser'
			LEFT JOIN MEMBRE_LEAGUE Mtous ON Mtous.league_id = L.id
			GROUP BY L.id, L.nom, L.createur_id
			ORDER BY L.nom";
	return parcoursRs(SQLSelect($SQL));
}

function creerLeague($nom, $idCreateur)
{
	$idLeague = SQLInsert("INSERT INTO LEAGUE(nom, createur_id) VALUES ('$nom', '$idCreateur')");
	SQLInsert("INSERT INTO MEMBRE_LEAGUE(user_id, league_id) VALUES ('$idCreateur', '$idLeague')");
	return $idLeague;
}
?>
