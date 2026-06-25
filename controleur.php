<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$qs = "";

	if ($action = valider("action"))
	{
		ob_start ();

		echo "Action = '$action' <br />";

		// ATTENTION : le codage des caractères peut poser PB 
		// si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		// Dans tous les cas, il faut etre logue...
		// Sauf si on veut se connecter (action == Connexion)
		if ($action != "Connexion" && $action != "valider_inscription")
			securiser("login");

		// Les actions de gestion des utilisateurs sont réservées aux administrateurs
		$actionsAdmin = array(
			"Interdire", "interdire",
			"Autoriser",
			"Promouvoir", "Retrograder",
			"Supprimer",
			"Créer utilisateur", "Creer utilisateur",
		);
		if (in_array($action, $actionsAdmin))
			securiserAdmin("login");

		// Un paramètre action a été soumis, on fait le boulot...
	
		switch($action)
		{
		
			// Interdire
			case "Interdire" : 
			case "interdire" : 
				// besoin de l'idUser à traiter 
				// il est transmis par GET dans idUser=...
				if ($idUser = valider("idUser")) {
					// responsabilité 1 : réaliser l'opération 
					interdireUtilisateur($idUser); 
				}
				
				// responsabilité 2 : choisir la prochaine vue 
				// ici : vue users 
				// on transmet cette demande lors de la redirection
				$qs = "?view=users&idLastUser=$idUser";
				 
			break;
			
			case 'Envoyer commentaire' :
						$idMatch = valider("id");
						$contenu = valider("contenu");
						if ($idMatch && $contenu) {
							enregistrerCommentaire($idMatch, valider("idUser", "SESSION"), $contenu);
						}
						$qs = "?view=notation&id=$idMatch";
			break;


			// Autoriser
			case "Autoriser" : 
				if ($idUser = valider("idUser")) {
					autoriserUtilisateur($idUser); 
				}
				$qs = "?view=users&idLastUser=$idUser";
			
			break; 
			
			// Promouvoir  // Retrograder // Supprimer
			case "Promouvoir" : 
				if ($idUser = valider("idUser")) {
					updateAdmin($idUser, 1);
				}
				$qs = "?view=users&idLastUser=$idUser";
			break; 

			case "Retrograder" : 
				if ($idUser = valider("idUser")) {
					updateAdmin($idUser, 0); 
				}
				$qs = "?view=users&idLastUser=$idUser";
			break; 
			
			case "Supprimer" : 
				if ($idUser = valider("idUser")) {
					supprimerUtilisateur($idUser); 
				}
				$qs = "?view=users";
			break; 
			
			// pseudo=admin&passe=mysql&action=Cr%C3%A9er+utilisateur
			case 'Créer utilisateur' : 
				$idNewUser = ""; 
				if ($pseudo = valider("pseudo")) 
				if ($passe = valider("passe")) {
					$idNewUser = ajouterUtilisateur($pseudo,$passe);
				}
				
				$qs = "?view=users&idLastUser=$idNewUser";
			
			break; 

			case 'Envoyer message' :
					$idLeague = valider("idLeague");
					$contenu  = valider("contenu");
					if ($idLeague && $contenu) {
						enregistrerMessageLeague($idLeague, valider("idUser", "SESSION"), $contenu);
					}
					$qs = "?view=chat&idLeague=$idLeague";
				break;

			case 'Creer league' :
					if ($nom = valider("nom")) {
						creerLeague($nom, valider("idUser", "SESSION"));
					}
					$qs = "?view=leagues";
				break;
			
			case 'Demander a rejoindre' :
					if ($idLeague = valider("idLeague")) {
						demanderAdhesion(valider("idUser", "SESSION"), $idLeague);
					}
					$qs = "?view=leagues";
				break;
							case 'Accepter demande' :
					$idLeague = valider("idLeague");
					if ($idInvitation = valider("idInvitation")) {
						accepterDemande($idInvitation);
					}
					$qs = "?view=demandes&idLeague=$idLeague";
				break;

				case 'Refuser demande' :
					$idLeague = valider("idLeague");
					if ($idInvitation = valider("idInvitation")) {
						refuserDemande($idInvitation);
					}
					$qs = "?view=demandes&idLeague=$idLeague";
				break;
			
			case 'valider_inscription':
					$pseudo = $_POST['pseudo'];
					$passe = $_POST['passe'];
					$equipe_id = $_POST['equipe_id'];
					$joueur_prefere = $_POST['joueur_prefere'];
					
					if (!empty($pseudo) && !empty($passe)) {
						inscrireUtilisateur($pseudo, $passe, $equipe_id, $joueur_prefere);
						header("Location: index.php?view=login&msg=" . urlencode("Compte créé, tu peux te connecter !"));
						exit;
					}
				break;
				// Connexion //////////////////////////////////////////////////
			case 'Connexion' :

				// TODO : afficher un message sur la page de connexion
				// en cas d'erreur d'identifiants		
				$qs = "?view=login&msg=identifiants incorrects";
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (verifUser($login,$passe)) 
						$qs = "?view=accueil"; 
				}


				 
			break;
			
			case 'Logout' :
			case 'logout' :
			case 'deconnexion' :
				session_destroy();
				$qs = "?view=login&msg=" . urlencode("Au revoir & à bientôt !");

				// TODO : dire "au revoir & à bientôt" à l'utilisateur
			break;

			// ===== Exercice 5 : actions sur les conversations =====

			case 'Archiver' :
				if ($idConv = valider("idConv")) {
					archiverConversation($idConv);
				}
				$qs = "?view=conversations&idLastConv=$idConv";
			break;

			case 'Reactiver' :
				if ($idConv = valider("idConv")) {
					reactiverConversation($idConv);
				}
				$qs = "?view=conversations&idLastConv=$idConv";
			break;

			case 'Supprimer conversation' :
				if ($idConv = valider("idConv")) {
					supprimerConversation($idConv);
				}
				$qs = "?view=conversations";
			break;

			case 'Creer conversation' :
			case 'Créer conversation' :
				$idNewConv = "";
				if ($theme = valider("theme")) {
					$idNewConv = creerConversation($theme);
				}
				$qs = "?view=conversations&idLastConv=$idNewConv";
			break;

			case 'Modifier equipe' :
				if ($idUser = valider("idUser", "SESSION"))
				if ($idEquipe = valider("idEquipe")) {
					updateEquipePref($idUser, $idEquipe);
					updateDrapeauEquipePref($idUser, $idEquipe);
					$imageDrapeau = SQLGetChamp("SELECT image_drapeau FROM EQUIPE WHERE id='$idEquipe'");
					$_SESSION["pdp"] = $imageDrapeau;
				}
				$qs = "?view=profil";
			break;


	        case 'Accepter invitation' :
	            if ($idUser = valider("idUser", "SESSION"))
	            if ($idInvitation = valider("idInvitation")) {
	                accepterInvitation($idInvitation, $idUser);
	            }
	            $qs = "?view=profil";
	        break;
	
	        case 'Refuser invitation' :
	            if ($idUser = valider("idUser", "SESSION"))
	            if ($idInvitation = valider("idInvitation")) {
	                refuserInvitation($idInvitation, $idUser);
	            }
	            $qs = "?view=profil";
	        break;


			case 'Modifier pseudo' :
	            if ($idUser = valider("idUser", "SESSION"))
	            if ($pseudo = valider("pseudo")) {
	                updatePseudo($idUser, $pseudo);
	                $_SESSION["pseudo"] = $pseudo;
	            }
	            $qs = "?view=profil";
	        break;

	        case 'Modifier joueur' :
	            if ($idUser = valider("idUser", "SESSION"))
	            if ($idJoueur = valider("idJoueur")) {
	                updateJoueurPref($idUser, $idJoueur);
	            }
	            $qs = "?view=profil";
	        break;
				
			case 'Maj score' :
				$idMatch  = valider("idMatch");
				$scoreDom = $_POST["score_dom"] ?? null;
				$scoreExt = $_POST["score_ext"] ?? null;
				if ($idMatch !== false && $scoreDom !== null && $scoreExt !== null) {
					majScore($idMatch, $scoreDom, $scoreExt);
				}
				$qs = "?view=scores&msg=Score mis à jour";
			break;

			case 'Maj hdm' :
				if ($idMatch  = valider("idMatch"))
				if ($idJoueur = valider("idJoueur")) {
					majHDM($idMatch, $idJoueur);
				}
				$qs = "?view=scores&msg=Homme du match mis à jour";
			break;

			case 'Ajouter but' :
				if ($idJoueur = valider("idJoueur")) {
					ajouterBut($idJoueur);
				}
				$qs = "?view=scores";
			break;

			case 'Ajouter passe' :
				if ($idJoueur = valider("idJoueur")) {
					ajouterPasse($idJoueur);
				}
				$qs = "?view=scores";
			break;
		}

	}

	//partie ajax nécessaire pour l'administration des scores

	$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

	if ($isAjax) {
		header('Content-Type: application/json; charset=utf-8');
		ob_end_clean();
		preg_match('/msg=([^&]*)/', $qs, $matches);
		$msg = isset($matches[1]) ? urldecode($matches[1]) : 'OK';
		$ok  = (strpos($msg, 'Impossible') === false && strpos($msg, 'Non') === false);
		echo json_encode(["ok" => $ok, "msg" => $msg]);
		exit;
	}

	//fin de cette partie 

	
	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments

	header("Location:" . $urlBase . $qs);
	//qs doit contenir le symbole '?'

	// On écrit seulement après cette entête
	ob_end_flush();
	
?>

