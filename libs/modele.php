<?php

// inclure ici la librairie faciliant les requêtes SQL (en veillant à interdire les inclusions multiples)
include_once("libs/maLibSQL.pdo.php");

//eleonore-debut
function listerMatchs()
{
    $sql = "SELECT 
                m.id,
                e1.nom AS equipe_dom,
                e2.nom AS equipe_ext,
                m.score_dom,
                m.score_ext,
                j.nom AS mvp_nom
            FROM MATCHS m
            JOIN EQUIPE e1 ON m.equipe_dom_id = e1.id
            JOIN EQUIPE e2 ON m.equipe_ext_id = e2.id
            LEFT JOIN JOUEUR j ON m.mvpfifa_id = j.id";

    return parcoursRS(SQLSelect($sql));
}


function getMatchById($id)
{
    $sql = "SELECT 
                m.id,
                e1.nom AS equipe_dom,
                e2.nom AS equipe_ext,
                m.score_dom,
                m.score_ext
            FROM MATCHS m
            JOIN EQUIPE e1 ON m.equipe_dom_id = e1.id
            JOIN EQUIPE e2 ON m.equipe_ext_id = e2.id
            WHERE m.id = $id";

    return parcoursRS(SQLSelect($sql, true)); 
}


function listerJoueursMatch($idMatch)
{
    $sql = "SELECT j.id, j.nom, j.prenom
            FROM JOUEUR j
            JOIN MATCHS m 
                ON j.equipe_id = m.equipe_dom_id 
                OR j.equipe_id = m.equipe_ext_id
            WHERE m.id = $idMatch";

    return parcoursRS(SQLSelect($sql));
}

function getStatsMatchs($equipe_id)
{
    $sql = "SELECT 
        COUNT(*) AS joues,
        SUM(CASE 
            WHEN (equipe_dom_id = $equipe_id AND score_dom > score_ext)
              OR (equipe_ext_id = $equipe_id AND score_ext > score_dom)
            THEN 1 ELSE 0 END) AS gagnes,

        SUM(CASE 
            WHEN score_dom = score_ext
            THEN 1 ELSE 0 END) AS nuls,

        SUM(CASE 
            WHEN (equipe_dom_id = $equipe_id AND score_dom < score_ext)
              OR (equipe_ext_id = $equipe_id AND score_ext < score_dom)
            THEN 1 ELSE 0 END) AS perdus

    FROM MATCHS
    WHERE equipe_dom_id = $equipe_id OR equipe_ext_id = $equipe_id";

    return parcoursRS(SQLSelect($sql))[0];
}

function getNoteMoyenne($equipe_id)
{
    $sql = "SELECT AVG(note_match) AS moyenne
            FROM AVIS_MATCH a
            JOIN MATCHS m ON a.match_id = m.id
            WHERE m.equipe_dom_id = $equipe_id 
               OR m.equipe_ext_id = $equipe_id";

    return parcoursRS(SQLSelect($sql))[0];
}

function getMVP($equipe_id)
{
    $sql = "SELECT j.nom, j.prenom, COUNT(*) as nb
            FROM AVIS_MATCH a
            JOIN JOUEUR j ON a.mvp_id = j.id
            JOIN MATCHS m ON a.match_id = m.id
            WHERE m.equipe_dom_id = $equipe_id 
               OR m.equipe_ext_id = $equipe_id
            GROUP BY a.mvp_id
            ORDER BY nb DESC
            LIMIT 1";

    $res = parcoursRS(SQLSelect($sql));
    return count($res) ? $res[0] : null;
}


//eleonore-fin

function getMatchs(int $userId, string $filtreEquipe = '', string $filtrePoule = ''): array {
    global $pdo;

    $sql = "
        SELECT
            m.id AS id_match,
            m.date_match,
            m.score_dom,
            m.score_ext,
            e1.poule,
            e1.nom AS equipe_dom,
            e2.nom AS equipe_ext,
            ROUND(AVG(a.note_match), 1) AS note_moyenne,
            -- Vérifie si l'utilisateur connecté a déjà noté ce match
            MAX(CASE WHEN a.user_id = :user_id THEN 1 ELSE 0 END) AS deja_note
        FROM MATCHS m
        JOIN EQUIPE e1 ON m.equipe_dom_id = e1.id
        JOIN EQUIPE e2 ON m.equipe_ext_id = e2.id
        LEFT JOIN AVIS_MATCH a ON a.match_id = m.id
        WHERE 1=1
    ";

    $params = [':user_id' => $userId];

    if ($filtreEquipe) {
        $sql .= " AND (e1.nom LIKE :equipe OR e2.nom LIKE :equipe)";
        $params[':equipe'] = '%' . $filtreEquipe . '%';
    }
    if ($filtrePoule) {
        $sql .= " AND e1.poule = :poule";
        $params[':poule'] = $filtrePoule;
    }

    $sql .= " GROUP BY m.id ORDER BY m.date_match DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

//DEBUT EXERCICE 2
function listerUtilisateurs($classe = "both")
{
	$SQL = "SELECT id,pseudo,blacklist,couleur,admin FROM utilisateurs";
	
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

//FIN EXERCICE 2

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

//FIN EXERCICE 4
//Basile - début
function listerLeaguesUtilisateur($idUser)
{
	$SQL = "SELECT L.id, L.nom, L.createur_id,
				(SELECT COUNT(*) FROM MESSAGE_CHAT MC
				 WHERE MC.league_id = L.id
				   AND MC.id > Mmoi.dernier_msg_lu
				   AND MC.user_id <> '$idUser') AS nb_non_lus
			FROM LEAGUE L
			JOIN MEMBRE_LEAGUE Mmoi ON Mmoi.league_id = L.id AND Mmoi.user_id = '$idUser'
			ORDER BY L.nom";
	return parcoursRs(SQLSelect($SQL));
}


function apercuLeague($idLeague)
{
	$SQL = "SELECT L.id, L.nom, U.pseudo AS createur,
				(SELECT COUNT(*) FROM MEMBRE_LEAGUE M WHERE M.league_id = L.id) AS nb_membres
			FROM LEAGUE L
			JOIN UTILISATEUR U ON U.id = L.createur_id
			WHERE L.id = '$idLeague'";
	$tab = parcoursRs(SQLSelect($SQL));
	return count($tab) ? $tab[0] : false;
}


function creerLeague($nom, $idCreateur)
{
	$idLeague = SQLInsert("INSERT INTO LEAGUE(nom, createur_id) VALUES ('$nom', '$idCreateur')");
	SQLInsert("INSERT INTO MEMBRE_LEAGUE(user_id, league_id) VALUES ('$idCreateur', '$idLeague')");
	return $idLeague;
}

function demanderAdhesion($idUser, $idLeague)
{
	// Déjà membre ? on ne fait rien
	$dejaMembre = SQLGetChamp("SELECT COUNT(*) FROM MEMBRE_LEAGUE
	                           WHERE user_id='$idUser' AND league_id='$idLeague'");
	if ($dejaMembre > 0) return "deja_membre";

	// Demande déjà en attente ? on n'en recrée pas une deuxième
	$dejaDemande = SQLGetChamp("SELECT COUNT(*) FROM INVITATION
	                            WHERE user_invite_id='$idUser' AND league_id='$idLeague'
	                              AND statut='en_attente'");
	if ($dejaDemande > 0) return "deja_demande";

	// Sinon : on crée la demande (statut 'en_attente' par défaut dans le schéma)
	SQLInsert("INSERT INTO INVITATION(league_id, user_invite_id) VALUES ('$idLeague', '$idUser')");
	return "ok";
}


function enregistrerMessageLeague($idLeague, $idUser, $contenu)
{
	SQLInsert("INSERT INTO MESSAGE_CHAT(league_id, user_id, contenu)
	           VALUES ('$idLeague', '$idUser', '$contenu')");
}
// 10 commentaires d'un match, du plus récent au plus ancien, avec décalage (pagination)
function listerCommentaires($idMatch, $limite = 10, $debut = 0)
{
	$limite = (int) $limite; $debut = (int) $debut;
	$SQL = "SELECT C.id, C.contenu, C.date_pub, C.user_id, U.pseudo
			FROM COMMENTAIRE C
			JOIN UTILISATEUR U ON U.id = C.user_id
			WHERE C.match_id = '$idMatch'
			ORDER BY C.id DESC
			LIMIT $limite OFFSET $debut";
	return parcoursRs(SQLSelect($SQL));
}

// nombre total (pour savoir s'il reste des commentaires à charger)
function compterCommentaires($idMatch)
{
	return SQLGetChamp("SELECT COUNT(*) FROM COMMENTAIRE WHERE match_id = '$idMatch'");
}

// ajouter un commentaire
function enregistrerCommentaire($idMatch, $idUser, $contenu)
{
	SQLInsert("INSERT INTO COMMENTAIRE(match_id, user_id, contenu)
	           VALUES ('$idMatch', '$idUser', '$contenu')");
}


function getLeague($idLeague)
{
	$SQL = "SELECT L.id, L.nom, L.createur_id, U.pseudo AS createur
			FROM LEAGUE L
			JOIN UTILISATEUR U ON U.id = L.createur_id
			WHERE L.id = '$idLeague'";
	$tab = parcoursRs(SQLSelect($SQL));
	return count($tab) ? $tab[0] : false;
}

function listerMessagesLeague($idLeague)
{
	$SQL = "SELECT MC.id, MC.contenu, MC.date_envoi, MC.user_id, U.pseudo
			FROM MESSAGE_CHAT MC
			JOIN UTILISATEUR U ON U.id = MC.user_id
			WHERE MC.league_id = '$idLeague'
			ORDER BY MC.date_envoi ASC, MC.id ASC";
	return parcoursRs(SQLSelect($SQL));
}
function marquerLeagueLue($idUser, $idLeague)
{
	$SQL = "UPDATE MEMBRE_LEAGUE
			SET dernier_msg_lu = (SELECT IFNULL(MAX(id), 0) FROM MESSAGE_CHAT WHERE league_id = '$idLeague')
			WHERE user_id = '$idUser' AND league_id = '$idLeague'";
	SQLUpdate($SQL);
}
// Les demandes d'adhésion en attente d'une league (avec le pseudo du demandeur)
function listerDemandesEnAttente($idLeague)
{
	$SQL = "SELECT I.id, I.user_invite_id, U.pseudo, I.date_invitation
			FROM INVITATION I
			JOIN UTILISATEUR U ON U.id = I.user_invite_id
			WHERE I.league_id = '$idLeague' AND I.statut = 'en_attente'
			ORDER BY I.date_invitation ASC";
	return parcoursRs(SQLSelect($SQL));
}

// Accepter une demande : ajoute le membre + passe la demande à 'accepte'
function accepterDemande($idInvitation)
{
	$tab = parcoursRs(SQLSelect("SELECT league_id, user_invite_id FROM INVITATION WHERE id='$idInvitation'"));
	if (!count($tab)) return;
	$d = $tab[0];
	// INSERT IGNORE : si déjà membre, on ne plante pas (clé primaire user_id+league_id)
	SQLInsert("INSERT IGNORE INTO MEMBRE_LEAGUE(user_id, league_id)
	           VALUES ('".$d['user_invite_id']."', '".$d['league_id']."')");
	SQLUpdate("UPDATE INVITATION SET statut='accepte' WHERE id='$idInvitation'");
}

// Refuser une demande : on passe juste son statut à 'refuse'
function refuserDemande($idInvitation)
{
	SQLUpdate("UPDATE INVITATION SET statut='refuse' WHERE id='$idInvitation'");
}
function listerMessagesLeagueDepuis($idLeague, $depuisId)
{
	$SQL = "SELECT MC.id, MC.contenu, MC.date_envoi, MC.user_id, U.pseudo
			FROM MESSAGE_CHAT MC
			JOIN UTILISATEUR U ON U.id = MC.user_id
			WHERE MC.league_id = '$idLeague' AND MC.id > '$depuisId'
			ORDER BY MC.id ASC";
	return parcoursRs(SQLSelect($SQL));
}



function getProfil($idUser)
{
    $SQL = "SELECT U.id, U.pseudo, U.pdp, U.equipe_pref_id, U.joueur_pref_id,
				   E.nom AS equipe_nom, E.image_drapeau,
				   J.prenom AS joueur_prenom, J.nom AS joueur_nom, J.image_joueur
            FROM UTILISATEUR U
            LEFT JOIN EQUIPE E ON E.id = U.equipe_pref_id
            LEFT JOIN JOUEUR J ON J.id = U.joueur_pref_id
            WHERE U.id = '$idUser'";
    $rs = parcoursRs(SQLSelect($SQL));
    return (count($rs) > 0) ? $rs[0] : false;
}

function getStatsProfil($idUser)
{
    // Nombre de matchs vus
    $nbVus = SQLGetChamp("SELECT COUNT(*) FROM AVIS_MATCH WHERE user_id='$idUser' AND vu=1");
    if (!$nbVus) $nbVus = 0;

    // Joueur le plus nommé MVP
    $SQL = "SELECT J.prenom, J.nom, COUNT(*) AS nb
            FROM AVIS_MATCH A
            JOIN JOUEUR J ON J.id = A.mvp_id
            WHERE A.user_id='$idUser' AND A.mvp_id IS NOT NULL
            GROUP BY A.mvp_id ORDER BY nb DESC LIMIT 1";
    $rs = parcoursRs(SQLSelect($SQL));
    $mvp = (count($rs) > 0) ? $rs[0]['prenom'] . ' ' . $rs[0]['nom'] : 'Aucun';

    // Équipe la plus vue (matchs où l'équipe dom ou ext a été vue)
    $SQL = "SELECT E.nom, COUNT(*) AS nb
            FROM AVIS_MATCH A
            JOIN MATCHS M ON M.id = A.match_id
            JOIN EQUIPE E ON E.id = M.equipe_dom_id OR E.id = M.equipe_ext_id
            WHERE A.user_id='$idUser' AND A.vu=1
            GROUP BY E.id ORDER BY nb DESC LIMIT 1";
    $rs = parcoursRs(SQLSelect($SQL));
    $equipePlusVue = (count($rs) > 0) ? $rs[0]['nom'] : 'Aucune';

    // Note moyenne donnée aux matchs
    $noteMoy = SQLGetChamp("SELECT ROUND(AVG(note_match),1) FROM AVIS_MATCH WHERE user_id='$idUser' AND note_match IS NOT NULL");
    if (!$noteMoy) $noteMoy = 'N/A';

    // Présences au stade
    $nbStade = SQLGetChamp("SELECT COUNT(*) FROM AVIS_MATCH WHERE user_id='$idUser' AND present_stade=1");
    if (!$nbStade) $nbStade = 0;

    return compact('nbVus', 'mvp', 'equipePlusVue', 'noteMoy', 'nbStade');
}

function getInvitationsProfil($idUser)
{
    $SQL = "SELECT I.id, L.nom AS league_nom, I.statut, I.date_invitation
            FROM INVITATION I
            JOIN LEAGUE L ON L.id = I.league_id
            WHERE I.user_invite_id = '$idUser' AND I.statut = 'en_attente'
            ORDER BY I.date_invitation DESC";
    return parcoursRs(SQLSelect($SQL));
}

function updatePseudo($idUser, $pseudo)
{
    $SQL = "UPDATE UTILISATEUR SET pseudo='$pseudo' WHERE id='$idUser'";
    return SQLUpdate($SQL);
}

function updateJoueurPref($idUser, $idJoueur)
{
    $SQL = "UPDATE UTILISATEUR SET joueur_pref_id='$idJoueur' WHERE id='$idUser'";
    return SQLUpdate($SQL);
}

function updateEquipePref($idUser, $idEquipe)
{
    $SQL = "UPDATE UTILISATEUR SET equipe_pref_id='$idEquipe' WHERE id='$idUser'";
    return SQLUpdate($SQL);
}

function listerJoueurs()
{
    $SQL = "SELECT J.id, J.prenom, J.nom, E.nom AS equipe
            FROM JOUEUR J LEFT JOIN EQUIPE E ON E.id = J.equipe_id
            ORDER BY J.nom, J.prenom";
    return parcoursRs(SQLSelect($SQL));
}

function listerEquipes()
{
    $SQL = "SELECT id, nom FROM EQUIPE ORDER BY nom";
    return parcoursRs(SQLSelect($SQL));
}

function accepterInvitation($idInvitation, $idUser)
{
    $league_id = SQLGetChamp("SELECT league_id FROM INVITATION WHERE id='$idInvitation' AND user_invite_id='$idUser'");
    if ($league_id) {
        SQLUpdate("UPDATE INVITATION SET statut='acceptee' WHERE id='$idInvitation'");
        SQLInsert("INSERT IGNORE INTO MEMBRE_LEAGUE(user_id, league_id) VALUES ('$idUser', '$league_id')");
    }
}

function refuserInvitation($idInvitation, $idUser)
{
    SQLUpdate("UPDATE INVITATION SET statut='refusee' WHERE id='$idInvitation' AND user_invite_id='$idUser'");
}

function updateDrapeauEquipePref($idUser, $idEquipe)
{
    $imageDrapeau = SQLGetChamp("SELECT image_drapeau FROM EQUIPE WHERE id='$idEquipe'");
    $SQL = "UPDATE UTILISATEUR SET pdp='$imageDrapeau' WHERE id='$idUser'";
    return SQLUpdate($SQL);
}

?>
