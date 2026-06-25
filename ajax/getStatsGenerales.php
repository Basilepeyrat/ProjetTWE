<?php

include_once("../libs/modele.php");

$equipeFans = getEquipePlusFans();
$joueurFans = getJoueurPlusFans();
$equipeNote = getEquipeMieuxNotee();
$matchVu = getMatchPlusVu();
$mvp = getMVPGlobal();
$equipeButs = getEquipePlusButs();
$buteur = getMeilleurButeur();
$passeur = getMeilleurPasseur();

echo json_encode(array(

    "equipeFans" => $equipeFans['nom'],
    "nbFans" => $equipeFans['nb'],

    "joueurFans" => $joueurFans['prenom']." ".$joueurFans['nom'],
    "nbFansJoueur" => $joueurFans['nb'],

    "equipeNote" => $equipeNote['nom'],
    "note" => round($equipeNote['moyenne'],2),

    "match" => $matchVu['equipe_dom']." - ".$matchVu['equipe_ext'],
    "vues" => $matchVu['nb'],

    "mvp" => $mvp['prenom']." ".$mvp['nom'],
    "nbMvp" => $mvp['nb'],

    "equipeButs" => $equipeButs['nom'],
    "buts" => $equipeButs['total'],

    "buteur" => $buteur['prenom']." ".$buteur['nom'],
    "nbButs" => $buteur['nb_buts'],

    "passeur" => $passeur['prenom']." ".$passeur['nom'],
    "nbPasses" => $passeur['nb_passes']

));