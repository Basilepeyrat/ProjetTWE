<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "modele.php";	// Car on utilise la fonction connecterUtilisateur()

/**
 * @file login.php
 * Fichier contenant des fonctions de vérification de logins
 */

/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir été appelé...
 * Infos à enregistrer : pseudo, idUser, heureConnexion, isAdmin
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * L'heure de connexion doit être stockée au format date("H:i:s") 
 * @pre login et passe ne doivent pas être vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la création de variables de session
 */
function verifUser($login,$password)
{
	// Doit vérifier l'identité de l'utilisateur <=> BDD 
	
	if ($idUser = verifUserBdd($login,$password)) {
		// die("idUser : " . $idUser);
		// EN + : doit créer des variables de session 
		$_SESSION["pseudo"] = $login;
		$_SESSION["idUser"] = $idUser; 
		$_SESSION["connecte"] = true; 
		$_SESSION["heureConnexion"] = date("H:i:s"); 
		$_SESSION["isAdmin"]  =  isAdmin($idUser); 
		return true; 
	}
	
	return false; 
}




/**
 * Fonction à placer au début de chaque page privée
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur
	et arrête l'interprétation si l'utilisateur n'est pas connecté
 * Elle ne fait rien si l'utilisateur est connecté, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlBad,$urlGood=false)
{
	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";

	if (!valider("connecte","SESSION"))
	{
		// Utilisateur non connecté : on vide le buffer de sortie pour éviter d'envoyer du HTML déjà bufferisé,
		// puis redirection vers urlBad avec message d'erreur
		while (ob_get_level() > 0) ob_end_clean();
		header("Location:" . $urlBase . "?view=" . $urlBad . "&msg=" . urlencode("Vous devez vous connecter pour accéder à cette page"));
		die("");
	}

	// Utilisateur connecté : redirection vers urlGood si fourni, sinon on continue
	if ($urlGood)
	{
		while (ob_get_level() > 0) ob_end_clean();
		header("Location:" . $urlBase . "?view=" . $urlGood);
		die("");
	}
}

/**
 * Page réservée aux administrateurs : exige une session connectée ET le flag isAdmin
 * En cas d'échec, redirige vers $urlBad (typiquement "login" ou "accueil") avec un message
 */
function securiserAdmin($urlBad)
{
	// D'abord, vérifier que l'utilisateur est connecté
	securiser($urlBad);

	// Ensuite, vérifier qu'il est administrateur
	if (!valider("isAdmin","SESSION"))
	{
		$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
		while (ob_get_level() > 0) ob_end_clean();
		header("Location:" . $urlBase . "?view=accueil&msg=" . urlencode("Accès réservé aux administrateurs"));
		die("");
	}
}

?>
