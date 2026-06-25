<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=profil");
    die("");
}

if (!isset($_SESSION["connecte"]) || !$_SESSION["connecte"]) {
    header("Location:index.php?view=login&msg=".urlencode("Vous devez vous connecter"));
    die("");
}

$idUser = valider("idUser", "SESSION");
$profil = getProfil($idUser);
$stats  = getStatsProfil($idUser);
$invitations = getInvitationsProfil($idUser);
$joueurs = listerJoueurs();
$equipes = listerEquipes();

$msg = valider("msg");
?>

<div id="corps">

    <h1>Mon Profil</h1>

    <?php if ($msg): ?>
        <p style="color:green;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <!-- pdp de l'utilisateur-->
    <section style="margin-bottom:30px;">
        <h2>Photo de profil</h2>
        <?php if ($profil['pdp']): ?>
            <img src="ressources/images_drapeaux/<?= htmlspecialchars($profil['pdp']) ?>"
                 alt="Photo de profil" style="width:80px; height:80px; object-fit:contain;" />
        <?php else: ?>
            <p>Aucune photo définie.</p>
        <?php endif; ?>
    </section>

    <!--  pseudo  -->
    <section id = "pseudo">
        <h2>Mon pseudo : <?= htmlspecialchars($profil['pseudo']) ?></h2>
        <form action="controleur.php" method="post">
            <input type="hidden" name="action" value="Modifier pseudo" />
            <label>Nouveau pseudo :
                <input type="text" name="pseudo" value="<?= htmlspecialchars($profil['pseudo']) ?>" required />
            </label>
            <button type="submit">Modifier</button>
        </form>
    </section>

    <!-- équipe préférée -->
    <section id = "equipePref">
        <h2>Mon équipe préférée</h2>
        <?php if ($profil['equipe_nom']): ?>
            <p>
                <img src="ressources/images_drapeaux/<?= htmlspecialchars($profil['image_drapeau']) ?>"
                     alt="<?= htmlspecialchars($profil['equipe_nom']) ?>"
                     style="width:40px; height:30px; object-fit:contain; margin-right:8px;" />
                <?= htmlspecialchars($profil['equipe_nom']) ?>
            </p>
        <?php else: ?>
            <p>Aucune équipe définie.</p>
        <?php endif; ?>
        <form action="controleur.php" method="post">
			<input type="hidden" name="action" value="Modifier equipe" />
			<label>Changer d'équipe :</label><br/>
			<input type="text" id="filtreEquipe" placeholder="Tapez pour filtrer..."
				oninput="filtrer('filtreEquipe','selectEquipe')"
				style="margin-bottom:4px; padding:4px; width:300px;" />
			<br/>
			<select name="idEquipe" id="selectEquipe" size="6" >
				<?php foreach ($equipes as $e): ?>
					<option value="<?= $e['id'] ?>"
						<?= ($e['id'] == ($profil['equipe_pref_id'] ?? '')) ? 'selected' : '' ?>>
						<?= htmlspecialchars($e['nom']) ?>
					</option>
				<?php endforeach; ?>
			</select>
			<br/><button type="submit" >Modifier</button>
		</form>
    </section>

    <!-- joueur préféré -->
    <section id="joueurPref">
        <h2>Mon joueur préféré</h2>
        <?php if ($profil['joueur_nom']): ?>
            <p>
                <img src="ressources/images_joueurs/<?= htmlspecialchars($profil['image_joueur']) ?>"
                     alt="<?= htmlspecialchars($profil['joueur_prenom'] . ' ' . $profil['joueur_nom']) ?>"
                     style="width:50px; height:50px; object-fit:cover; border-radius:50%; margin-right:8px;" />
                <?= htmlspecialchars($profil['joueur_prenom'] . ' ' . $profil['joueur_nom']) ?>
            </p>
        <?php else: ?>
            <p>Aucun joueur défini.</p>
        <?php endif; ?>
        <form action="controleur.php" method="post">
			<input type="hidden" name="action" value="Modifier joueur" />
			<label>Changer de joueur :</label><br/>
			<input type="text" id="filtreJoueur" placeholder="Tapez pour filtrer..."
				oninput="filtrer('filtreJoueur','selectJoueur')"
				style="margin-bottom:4px; padding:4px; width:300px;" />
			<br/>
			<select name="idJoueur" id="selectJoueur" size="6" >
				<?php foreach ($joueurs as $j): ?>
					<option value="<?= $j['id'] ?>"
						<?= ($j['id'] == ($profil['joueur_pref_id'] ?? '')) ? 'selected' : '' ?>>
						<?= htmlspecialchars($j['prenom'] . ' ' . $j['nom'] . ' (' . $j['equipe'] . ')') ?>
					</option>
				<?php endforeach; ?>
			</select>
			<br/><button type="submit" >Modifier</button>
		</form>
	</section>

    <!-- invitation aux leagues -->
    <section id = "invitLeagues">
        <h2>Invitations à des leagues : 
            <span>
                <?= count($invitations) ?>
            </span>
        </h2>
        <?php if (count($invitations) == 0): ?>
            <p>Aucune invitation en attente.</p>
        <?php else: ?>
            <ul>
            <?php foreach ($invitations as $inv): ?>
                <li>
                    League <strong><?= htmlspecialchars($inv['league_nom']) ?></strong>
                    — reçue le <?= htmlspecialchars($inv['date_invitation']) ?>
                    <form action="controleur.php" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="Accepter invitation" />
                        <input type="hidden" name="idInvitation" value="<?= $inv['id'] ?>" />
                        <button type="submit">Accepter</button>
                    </form>
                    <form action="controleur.php" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="Refuser invitation" />
                        <input type="hidden" name="idInvitation" value="<?= $inv['id'] ?>" />
                        <button type="submit">Refuser</button>
                    </form>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <!-- stats de l'utilisateur -->
    <section id = "statsUser">
        <h2>Mes statistiques</h2>
        <table id = "stats">
            <tr>
                <th>Matchs vus</th>
                <td><?= $stats['nbVus'] ?></td>
            </tr>
            <tr>
                <th>Joueur le plus nommé MVP</th>
                <td><?= htmlspecialchars($stats['mvp']) ?></td>
            </tr>
            <tr>
                <th>Équipe la plus vue</th>
                <td><?= htmlspecialchars($stats['equipePlusVue']) ?></td>
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
    </section>

    <!-- bouton déconnexion -->
    <section>
        <form action="controleur.php" method="post">
            <input type="hidden" name="action" value="Logout" />
            <button type="submit" >
                Se déconnecter
            </button>
        </form>
    </section>


<script>
function filtrer(inputId, selectId) { ... }
</script>

</div>
