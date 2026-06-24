<?php
// Ce fichier permet de tester les fonctions développées dans le fichier bdd.php (première partie)

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php")
{
	header("Location:../index.php?view=users");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibSecurisation.php");

// Page d'administration : réservée aux administrateurs
securiserAdmin("login");

?>

<h1>Administration du site</h1>

<h2>Liste des utilisateurs de la base </h2>

<?php

echo "liste des utilisateurs autorises de la base :"; 
$users = listerUtilisateurs("nbl");
tprint($users);	// préférer un appel à mkTable($users);

// TODO : finaliser listerUtilisateurs() en prenant en compte son paramètre
// Afficher juste les pseudo des utilisateurs 
// avec une boucle for 

for($i=0;$i<count($users);$i++) {
	// $users[$i] est un tableau associatif
	echo $users[$i]["pseudo"] . " ";
}

// avec une boucle foreach 
//foreach($tab as $case)
//foreach($tabAsso as $valeur)
//foreach($tabAsso as $cle=>$valeur)
foreach($users as $dataUser)
	echo $dataUser["pseudo"] . " ";


echo "<hr />";
echo "liste des utilisateurs non autorises de la base :"; 
$users = listerUtilisateurs("bl");
tprint($users);	// préférer un appel à mkTable($users);

?>
<hr />
<h2>Changement de statut des utilisateurs</h2>

<form action="controleur.php">

<select name="idUser">
<?php
$users = listerUtilisateurs();

// préférer un appel à mkSelect("idUser",$users, ...)
foreach ($users as $dataUser)
{
	// préselectionner une option : 
	// attribut selected 
	$sel = ""; 
	// if (dernier utilisateur manipulé == utilisateur qui doit être affiché)
	if ($dataUser["id"] == valider("idLastUser"))
	$sel = "selected"; 
	
	echo "<option $sel value=\"$dataUser[id]\">\n";
	echo  $dataUser["pseudo"];
	echo  ($dataUser["blacklist"]) ? " (bl)": " (nbl)";
	
	echo "\n</option>\n"; 
}
?>
</select>

<button type="submit" name="action" value="interdire">Blacklister</button>

<input type="submit" name="action" value="Interdire" />
<input type="submit" name="action" value="Autoriser" />

<input type="submit" name="action" value="Promouvoir" />
<input type="submit" name="action" value="Retrograder" />
<input type="submit" name="action" value="Supprimer" />
</form>

<!-- 
TODO : ajouter une fonctionnalité au choix : 
- nouvel utilisateur 
- changer la couleur d'un utilisateur 
- promouvoir ou rétrograder un utilisateur  
- supprimer un utilisateur 
--> 

<form action="controleur.php">
Pseudo:<input type="text" name="pseudo" />
Passe:<input type="password" name="passe" />
<input type="submit" name="action" value="Créer utilisateur" />
</form>





