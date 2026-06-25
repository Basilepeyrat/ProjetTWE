<?php

include_once("../libs/modele.php");

header('Content-Type: application/json');

if (isset($_GET['equipe_id']) && $_GET['equipe_id'] != "") {

    $id = intval($_GET['equipe_id']);

    $stats = getStatsMatchs($id);
    $note = getNoteMoyenne($id);
    $mvp = getMVP($id);

    echo json_encode(array(
        "type" => "equipe",
        "joues" => $stats['joues'],
        "gagnes" => $stats['gagnes'],
        "nuls" => $stats['nuls'],
        "perdus" => $stats['perdus'],
        "moyenne" => round($note['moyenne'],2),
        "mvp" => $mvp ? $mvp['prenom']." ".$mvp['nom'] : "Aucun"
    ));

}
else {

    $equipeFans = getEquipePlusFans();
    $joueurFans = getJoueurPlusFans();
    $equipeNote = getEquipeMieuxNotee();
    $matchVu = getMatchPlusVu();
    $mvp = getMVPGlobal();
    $equipeButs = getEquipePlusButs();
    $buteur = getMeilleurButeur();
    $passeur = getMeilleurPasseur();

    echo json_encode(array(

        "type" => "general",

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
}