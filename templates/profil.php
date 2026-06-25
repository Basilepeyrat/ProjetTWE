<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=profil");
    die("");
}

if (!isset($_SESSION["connecte"]) || !$_SESSION["connecte"]) {
    header("Location:index.php?view=login&msg=".urlencode("Vous devez vous connecter"));
    die("");
}

$idUser      = valider("idUser", "SESSION");
$profil      = getProfil($idUser);
$stats       = getStatsProfil($idUser);
$joueurs     = listerJoueurs();
$equipes     = listerEquipes();
$msg         = valider("msg");
?>

<div class="top-bar">
    <h1>Mon Profil</h1>
</div>

<div class="container">

    <?php if ($msg): ?>
        <p class="badge badge--success"><?= ($msg) ?></p>
    <?php endif; ?>

        <!-- Zone de changement de pseudo -->

    <div class="card">
        
        <?php if ($profil['pdp']): ?>
            <img src="ressources/images_drapeaux/<?= ($profil['pdp']) ?>"
                 alt="Photo de profil"
                 class="entete-pp" />
        <?php endif; ?>
     
        <h2><?= ($profil['pseudo']) ?></h2>
     
        <form action="controleur.php" method="post">
     
           <input type="hidden" name="action" value="Modifier pseudo" />
     
            <div class="form-group">
                <label>Nouveau pseudo</label>
                <input type="text" name="pseudo" value="<?= ($profil['pseudo']) ?>" required />
            </div>
     
            <button type="submit" class="btn btn--primary">Modifier</button>
     
        </form>
    
    </div>



         <!-- Zone de choix de l'équipe préférée -->
    <div class="card">

        <h2>Équipe préférée</h2>
        
        <?php if ($profil['equipe_nom']): ?>
            <p>
                <img src="ressources/images_drapeaux/<?= ($profil['image_drapeau']) ?>"
                     alt="<?=  ($profil['equipe_nom']) ?>"
                     class="entete-pp" />
                <?=  ($profil['equipe_nom']) ?>
            </p>
        <?php else: ?>
            <p class="text-muted">Aucune équipe définie.</p>
        <?php endif; ?>
        <form action="controleur.php" method="post">
            <input type="hidden" name="action" value="Modifier equipe" />
            <div class="form-group">
                <label>Changer d'équipe</label>
                <input type="text" id="filtreEquipe" placeholder="Tapez pour filtrer..."
                       oninput="filtrer('filtreEquipe','selectEquipe')" />
                <select name="idEquipe" id="selectEquipe" size="6">
                    <?php foreach ($equipes as $e): ?>
                        <option value="<?= $e['id'] ?>"
                            <?= ($e['id'] == ($profil['equipe_pref_id'] ?? '')) ? 'selected' : '' ?>>
                            <?=  ($e['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn--primary">Modifier</button>
        </form>
    </div>




                    <!-- Zone de choix du joueur préféré -->
    
    <div class="card">

        <h2>Joueur préféré</h2>
        
        <?php if ($profil['joueur_nom']): ?>
            <p>
        
            <img src="ressources/images_joueurs/<?= ($profil['joueur_pref_id']) ?>.png"
                     alt="<?=  ($profil['joueur_nom']) ?>"
                     class="entete-pp" />

                <?=  ($profil['joueur_prenom'] . ' ' . $profil['joueur_nom']) ?>
            
            </p>

        <?php else: ?>
            <p class="text-muted">Aucun joueur défini.</p>
        <?php endif; ?>

        <form action="controleur.php" method="post">
            <input type="hidden" name="action" value="Modifier joueur" />
            <div class="form-group">
                <label>Changer de joueur</label>
                <input type="text" id="filtreJoueur" placeholder="Tapez pour filtrer..."
                       oninput="filtrer('filtreJoueur','selectJoueur')" />
                <select name="idJoueur" id="selectJoueur" size="6">
                    <?php foreach ($joueurs as $j): ?>
                        <option value="<?= $j['id'] ?>"
                            <?= ($j['id'] == ($profil['joueur_pref_id'] ?? '')) ? 'selected' : '' ?>>
                            <?=  ($j['prenom'] . ' ' . $j['nom'] . ' (' . $j['equipe'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn--primary">Modifier</button>
        </form>
    </div>

    
    <div class="card">
        
        <h2>Mes statistiques</h2>
        
        <table>
        
            <tr>
                <th>Matchs vus</th>
                <td><?= $stats['nbVus'] ?></td>
            </tr>
            
            <tr>
                <th>Joueur le plus nommé MVP</th>
                <td><?=  ($stats['mvp']) ?></td>
            </tr>
            
            <tr>
                <th>Équipe la plus vue</th>
                <td><?=  ($stats['equipePlusVue']) ?></td>
            </tr>
            
            <tr>
                <th>Note moyenne donnée</th>
                <td><?= $stats['noteMoy'] ?> / 10</td>
            </tr>
            
            <tr>
                <th>Présences au stade</th>
                <td><?= $stats['nbStade'] ?></td>
            </tr>

        </table>

    </div>

    <form action="controleur.php" method="post" class="mt-md">
        <input type="hidden" name="action" value="Logout" />
        <button type="submit" class="btn btn--danger">Se déconnecter</button>
    </form>

</div>
