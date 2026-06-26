<?php
$equipes = listerEquipes();
?>

<select id="equipeSelect">
    <option value="">Choisir une équipe</option>
    <?php foreach ($equipes as $e) { ?>
        <option value="<?= $e['id'] ?>">
            <?= $e['nom'] ?>
        </option>
    <?php } ?>
</select>

<div id="stats"></div>



<script src="js/jquery-4.0.0.min.js"></script>

<script>

$(document).ready(function(){

    chargerStats();

    $("#equipeSelect").change(function(){

        chargerStats($(this).val());

    });

});


function chargerStats(idEquipe = ""){

    $.ajax({

        url: "ajax/getStats.php",

        data: { equipe_id: idEquipe },

        dataType: "json",

        success:function(data){

            let html="";

            if(data.type=="general"){

                html = `
                <h2>Statistiques générales</h2>

                <p><b>Équipe avec le plus de fans :</b> ${data.equipeFans} (${data.nbFans} fans)</p>

                <p><b>Joueur avec le plus de fans :</b> ${data.joueurFans} (${data.nbFansJoueur} fans)</p>

                <p><b>Équipe la mieux notée :</b> ${data.equipeNote} (${data.note}/10)</p>

                <p><b>Match le plus vu :</b> ${data.match} (${data.vues} vues)</p>

                <p><b>MVP le plus élu :</b> ${data.mvp} (${data.nbMvp} fois)</p>

                <p><b>Équipe ayant marqué le plus de buts :</b> ${data.equipeButs} (${data.buts} buts)</p>

                <p><b>Meilleur buteur :</b> ${data.buteur} (${data.nbButs} buts)</p>

                <p><b>Meilleur passeur :</b> ${data.passeur} (${data.nbPasses} passes)</p>
                `;

            }

            else{

                html = `
                <h2>Statistiques</h2>

                <p>Matchs joués : ${data.joues}</p>

                <p>Gagnés : ${data.gagnes}</p>

                <p>Nuls : ${data.nuls}</p>

                <p>Perdus : ${data.perdus}</p>

                <p>Note moyenne : ${data.moyenne}</p>

                <p>MVP le plus choisi : ${data.mvp}</p>
                
                <p><b>Nombre de fans :</b> ${data.fans}</p>

                <p><b>Meilleur buteur :</b> ${data.buteur} (${data.nbButs} buts)</p>

                <p><b>Meilleur passeur :</b> ${data.passeur} (${data.nbPasses} passes)</p>

                `;

            }

            $("#stats").html(html);

        }

    });

}

</script>