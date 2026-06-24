<?php


// Page d'accueil CONNECTÉ



require_once 'config.php';

// renvoyé à l'accueil si pas connecté
if (!estConnecte()) {
    rediriger('index.php');
}

// --- Récupération des matchs (même logique que index.php) ---
$filtre_equipe = $_GET['equipe'] ?? '';
$filtre_poule  = $_GET['poule'] ?? '';

$sql = "
    SELECT
        m.id_match,
        m.date_match,
        m.score_dom,
        m.score_ext,
        m.poule,
        m.stade,
        e1.nom AS equipe_dom,
        e2.nom AS equipe_ext,
        ROUND(AVG(a.note_match), 1)      AS note_moyenne,
        ROUND(AVG(a.note_equipe_dom), 1) AS note_dom,
        ROUND(AVG(a.note_equipe_ext), 1) AS note_ext,
        -- Vérifie si l'utilisateur connecté a déjà noté ce match
        MAX(CASE WHEN a.id_utilisateur = :user_id THEN 1 ELSE 0 END) AS deja_note
    FROM `match` m
    JOIN equipe e1 ON m.id_equipe_dom = e1.id_equipe
    JOIN equipe e2 ON m.id_equipe_ext = e2.id_equipe
    LEFT JOIN avis_match a ON a.id_match = m.id_match
    WHERE 1=1
";

$params = [':user_id' => $_SESSION['id_utilisateur']];

if ($filtre_equipe) {
    $sql .= " AND (e1.nom LIKE :equipe OR e2.nom LIKE :equipe)";
    $params[':equipe'] = '%' . $filtre_equipe . '%';
}
if ($filtre_poule) {
    $sql .= " AND m.poule = :poule";
    $params[':poule'] = $filtre_poule;
}

$sql .= " GROUP BY m.id_match ORDER BY m.date_match DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$matchs = $stmt->fetchAll();

// Poules pour le filtre
$poules = $pdo->query("SELECT DISTINCT poule FROM `match` ORDER BY poule")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil — Mur des Supporters</title>
  <link rel="stylesheet" href="style.css">
  <style>
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

    /* Carte des matchs */
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
      font-size: 11px;
    }

    .no-results {
      text-align: center;
      padding: 40px 20px;
      color: var(--color-text-muted);
    }

    .welcome-msg {
      font-size: 14px;
      color: var(--color-text-muted);
      margin-bottom: 16px;
    }
    .welcome-msg strong { color: var(--color-primary); }
  </style>
</head>
<body>

<div class="page">

  <div class="top-bar">
    <h1>Mur des Supporters</h1>
    <p>Coupe du Monde 2026</p>
  </div>

  <div class="container">

  
    <p class="welcome-msg">
      Bonjour, <strong><?= securiser($_SESSION['pseudo']) ?></strong> 👋
    </p>

   
    <form method="GET" action="home.php" class="search-bar">
      <input
        type="text"
        name="equipe"
        placeholder="Rechercher une équipe, une poule..."
        value="<?= securiser($filtre_equipe) ?>"
      >
      <select name="poule">
        <option value="">Toutes</option>
        <?php foreach ($poules as $p): ?>
          <option value="<?= securiser($p['poule']) ?>"
            <?= $filtre_poule === $p['poule'] ? 'selected' : '' ?>>
            Poule <?= securiser($p['poule']) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit">🔍</button>
    </form>

   
    <?php if (empty($matchs)): ?>
      <div class="no-results">
        <p>Aucun match trouvé.</p>
      </div>
    <?php else: ?>
      <?php
      $date_affichee = '';
      foreach ($matchs as $match):
        $date_match = date('d/m/Y', strtotime($match['date_match']));
        if ($date_match !== $date_affichee):
          $date_affichee = $date_match;
      ?>
        <p class="text-muted" style="font-size:13px; margin: 12px 0 4px;"><?= $date_match ?></p>
      <?php endif; ?>

      <!-- Carte cliquable → redirige vers la page notation du match -->
      <a href="notation_match.php?id=<?= $match['id_match'] ?>" class="match-link">
        <div class="card match-card">
          <div class="match-card__score">
            <div>
              <div class="match-card__team"><?= securiser($match['equipe_dom']) ?></div>
              <div class="match-card__value">
                <?= $match['score_dom'] !== null ? $match['score_dom'] : '-' ?>
              </div>
            </div>
            <div style="text-align:center;">
              <?php if ($match['note_moyenne']): ?>
                <span class="badge badge--rating"><?= $match['note_moyenne'] ?></span>
              <?php else: ?>
                <span class="badge" style="background:#eee; color:#999;">?</span>
              <?php endif; ?>
              <?php if ($match['deja_note']): ?>
                <br><span class="badge badge--done" style="margin-top:4px;">✓ Noté</span>
              <?php endif; ?>
            </div>
            <div>
              <div class="match-card__team"><?= securiser($match['equipe_ext']) ?></div>
              <div class="match-card__value">
                <?= $match['score_ext'] !== null ? $match['score_ext'] : '-' ?>
              </div>
            </div>
          </div>
          <div class="match-card__ratings">
            <span class="badge badge--rating"><?= $match['note_dom'] ?? '–' ?></span>
            <span style="font-size:11px; color:var(--color-text-muted);">
              <?= date('H:i', strtotime($match['date_match'])) ?>
              <?= $match['stade'] ? '• ' . securiser($match['stade']) : '' ?>
            </span>
            <span class="badge badge--rating"><?= $match['note_ext'] ?? '–' ?></span>
          </div>
        </div>
      </a>

      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</div>


<nav class="bottom-nav">
  <a href="home.php" class="bottom-nav__item is-active">
    <svg viewBox="0 0 24 24"><path d="M3 11l9-8 9 8M5 10v10h5v-6h4v6h5V10"/></svg>
    <span>Home</span>
  </a>
  <a href="leagues.php" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><path d="M8 4h8v4a4 4 0 01-8 0V4z"/><path d="M8 4H4a4 4 0 004 4M16 4h4a4 4 0 01-4 4"/><path d="M10 14h4v3h-4z"/><path d="M7 20h10"/></svg>
    <span>League</span>
  </a>
  <a href="stats.php" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20V14M22 20H2"/></svg>
    <span>Stats</span>
  </a>
  <a href="profil.php" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
    <span>Profil</span>
  </a>
</nav>

</body>
</html>
