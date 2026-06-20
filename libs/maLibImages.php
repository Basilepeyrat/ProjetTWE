<?php

function listerImages($repertoire){
	$img = array(); 
	$rep = opendir($repertoire); // ouverture du repertoire 
	while ( $fichier = readdir($rep))
	{
		// On élimine le résultat '.' (répertoire courant) 
		// et '..' (répertoire parent)

		if (($fichier!=".") && ($fichier!=".."))
		{
			// Pour éliminer les autres fichiers du menu déroulant, 
			// on dispose de la fonction 'is_dir'
			// if (is_dir("./" . $fichier))
			$img[] = $fichier;
		}
	}
	closedir($rep);
    return $img;
}
function afficherImages($repertoire)
{
	$img = listerImages($repertoire);

	foreach ($img as $chemin)
	{
		// Nom du fichier sans son extension
		$legende = pathinfo($chemin, PATHINFO_FILENAME);
		echo "<img src=\"ressources/images/$chemin\" />"; 
		echo "\t<figcaption>$legende</figcaption>\n";
	}
}

?>

