<?php

include_once("libs/modele.php");

//on recup ttes les équipes pour le choix de l'équipe que l'utilisateur supporte

$equipes = $pdo->query("SELECT id, nom FROM EQUIPE ORDER BY nom")->fetchAll();
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
                <?php endphp; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="joueur">Joueur préféré :</label>
            <input type="text" id="joueur" name="joueur_prefere" placeholder="Ex: Mbappé, Messi...">
        </div>

        <button type="submit" class="btn-valider">Créer mon compte</button>
    </form>
</div>
