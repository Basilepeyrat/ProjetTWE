<?php
//accueil quand la personne se connecte

// Redirige vers login si personne pas connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: index.php?view=login");
    exit;
}

$id_user = $_SESSION['id_utilisateur'];


$filtre_equipe = isset($_GET['equipe']) ? $_GET['equipe'] : '';
$filtre_poule  = isset($_GET['poule'])  ? $_GET['poule']  : '';


if ($filtre_equipe || $filtre_poule) {
    $matchs = listerMatchsFiltres($filtre_equipe, $filtre_poule);
} else {
    $matchs = listerMatchsAvecNotes();
}

// Récupère les poules pour afficher ds menu déroulant
$poules = listerPoules();
?>

<div class="container">

  <!-- Message de bienvenue -->
  <p class="welcome-msg">
    Bonjour, <strong><?= htmlspecialchars($_SESSION['pseudo']) ?></strong> 
  </p>

  <!-- Barre de recherche et filtres -->
  <form method="GET" action="index.php" class="search-bar">
    <input type="hidden" name="view" value="home">
    <input
      type="text"
      name="equipe"
      placeholder="Rechercher une équipe, une poule, ..."
      value="<?= htmlspecialchars($filtre_equipe) ?>"
    >
    <select name="poule">
      <option value="">Toutes les poules</option>
      <?php foreach ($poules as $p): ?>
        <option value="<?= htmlspecialchars($p['poule']) ?>"
          <?= $filtre_poule === $p['poule'] ? 'selected' : '' ?>>
          Poule <?= htmlspecialchars($p['poule']) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit">🔍</button>
  </form>

  <!-- Liste des matchs -->
  <?php if (empty($matchs)): ?>
    <div class="no-results">
      <p>Aucun match trouvé.</p>
    </div>

  <?php else: ?>
    <?php
    $date_affichee = '';
    foreach ($matchs as $match):
      // Séparateur de date
      $date_match = date('d/m/Y', strtotime($match['date_match']));
      if ($date_match !== $date_affichee):
        $date_affichee = $date_match;
    ?>
      <p class="text-muted" style="font-size:13px; margin: 12px 0 4px;">
        <?= $date_match ?>
      </p>
    <?php endif; ?>

    
    <a href="index.php?view=notation_match&id=<?= $match['id'] ?>" class="match-link">
      <div class="card match-card">

        <div class="match-card__score">
          <!-- Équipe domicile -->
          <div>
            <div class="match-card__team">
              <?= htmlspecialchars($match['equipe_dom']) ?>
            </div>
            <div class="match-card__value">
              <?= $match['score_dom'] !== null ? $match['score_dom'] : '-' ?>
            </div>
          </div>

          <!-- Note moyenne du match -->
          <div style="text-align:center;">
            <?php if ($match['note_moyenne']): ?>
              <span class="badge badge--rating"><?= $match['note_moyenne'] ?></span>
            <?php else: ?>
              <span class="badge" style="background:#eee; color:#999;">?</span>
            <?php endif; ?>

            <!-- Badge si déjà donné son avis -->
            <?php if (utilisateurANoteMatch($id_user, $match['id'])): ?>
              <br>
              <span class="badge badge--done" style="margin-top:4px; font-size:11px;">✓ Noté</span>
            <?php endif; ?>
          </div>

          <!-- Équipe extérieure -->
          <div>
            <div class="match-card__team">
              <?= htmlspecialchars($match['equipe_ext']) ?>
            </div>
            <div class="match-card__value">
              <?= $match['score_ext'] !== null ? $match['score_ext'] : '-' ?>
            </div>
          </div>
        </div>

        <!-- Notes des deux équipes + de l'heure -->
        <div class="match-card__ratings">
          <span class="badge badge--rating"><?= $match['note_dom'] ?? '–' ?></span>
          <span style="font-size:11px; color:var(--color-text-muted);">
            <?= date('H:i', strtotime($match['date_match'])) ?>
          </span>
          <span class="badge badge--rating"><?= $match['note_ext'] ?? '–' ?></span>
        </div>

      </div>
    </a>

    <?php endforeach; ?>
  <?php endif; ?>

</div>

<style>
  .welcome-msg {
    font-size: 14px;
    color: var(--color-text-muted);
    margin-bottom: 16px;
  }
  .welcome-msg strong { color: var(--color-primary); }

  .search-bar {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
  }
  .search-bar input {
    flex: 1;
    padding: 10px 14px;
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: 14px;
  }
  .search-bar select {
    padding: 10px;
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-sm);
    font-size: 14px;
  }
  .search-bar button {
    padding: 10px 16px;
    background: var(--color-primary-light);
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    cursor: pointer;
  }

  a.match-link { text-decoration: none; color: inherit; display: block; }
  a.match-link .card {
    transition: transform 0.12s ease, box-shadow 0.12s ease;
    cursor: pointer;
  }
  a.match-link:hover .card {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(18,44,86,0.14);
  }

  .badge--done {
    background: rgba(46, 139, 87, 0.15);
    color: var(--color-success);
  }

  .no-results {
    text-align: center;
    padding: 40px 20px;
    color: var(--color-text-muted);
  }
</style>
