      <?php
if (basename($_SERVER["PHP_SELF"]) == "inscription.php") {
	header("Location:../index.php?view=inscription");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");

$equipes = listerEquipes();
$joueurs = listerJoueurs();
?>



<div id="corps">
    <h1>Inscription</h1>
    <p>Créez votre compte de supporter pour rejoindre la communauté !</p>

    <form action="controleur.php?action=valider_inscription" method="POST" class="form-inscription">
        
        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required placeholder="Votre pseudo...">
        </div>

        <div class="form-group">
            <label for="passe">Mot de passe :</label>
            <input type="password" id="passe" name="passe" required placeholder="Votre mot de passe...">
        </div>

        <div class="form-group">
            <label for="equipe">Équipe préférée (à suivre) :</label>
            <select id="equipe" name="equipe_id" required>
                <option value="">-- Choisissez une équipe --</option>
                <?php foreach ($equipes as $equipe): ?>
                    <option value="<?php echo $equipe['id']; ?>">
                        <?php echo $equipe['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
    <label for="filtreJoueur">Joueur préféré :</label><br/>
    <input type="text" id="filtreJoueur" placeholder="Tapez pour filtrer..."
           oninput="filtrer('filtreJoueur','selectJoueur')"
           style="margin-bottom:4px; padding:4px; width:300px;" />
    <br/>
        <select name="joueur_prefere" id="selectJoueur" size="6">
            <option value="">-- Aucun --</option>
            <?php foreach ($joueurs as $j): ?>
                <option value="<?php echo $j['id']; ?>">
                    <?php echo htmlspecialchars($j['prenom'] . ' ' . $j['nom'] . ' (' . $j['equipe'] . ')'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

        <button type="submit" class="btn-valider">Créer mon compte</button>
    </form>
</div>

<script>
function filtrer(inputId, selectId) { ... }
</script>