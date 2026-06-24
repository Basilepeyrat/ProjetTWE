<?php
// Page de présentation

require_once 'config.php';

// nombre total d'avis
$total_avis   = $pdo->query("SELECT COUNT(*) FROM avis_match")->fetchColumn();
$total_matchs = $pdo->query("SELECT COUNT(*) FROM `match`")->fetchColumn();
$total_users  = $pdo->query("SELECT COUNT(*) FROM utilisateur")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À propos — Mur des Supporters</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .hero {
      background: var(--color-primary);
      color: white;
      text-align: center;
      padding: 40px 20px 60px;
    }
    .hero h1 {
      color: white;
      font-size: 32px;
      margin-bottom: 8px;
    }
    .hero p {
      color: rgba(255,255,255,0.75);
      font-size: 15px;
      max-width: 340px;
      margin: 0 auto;
    }
    .hero-img {
      width: 100%;
      max-height: 180px;
      object-fit: cover;
      border-radius: var(--radius-md);
      margin-top: 24px;
    }

    
    .stats-row {
      display: flex;
      gap: 12px;
      margin: -28px 16px 0;
      position: relative;
      z-index: 1;
    }
    .stat-box {
      flex: 1;
      background: white;
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-card);
      padding: 14px 8px;
      text-align: center;
    }
    .stat-box__value {
      font-family: var(--font-display);
      font-size: 24px;
      font-weight: 700;
      color: var(--color-primary);
    }
    .stat-box__label {
      font-size: 11px;
      color: var(--color-text-muted);
      margin-top: 2px;
    }

    /* Fonctionnalités */
    .feature {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 16px 0;
      border-bottom: 1px solid var(--color-border);
    }
    .feature:last-child { border-bottom: none; }
    .feature__icon {
      font-size: 28px;
      flex-shrink: 0;
    }
    .feature__title {
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 4px;
      color: var(--color-primary);
    }
    .feature__desc {
      font-size: 13px;
      color: var(--color-text-muted);
      margin: 0;
    }

    .back-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--color-primary-light);
      font-size: 14px;
      font-weight: 500;
      margin: 16px;
    }
  </style>
</head>
<body>

<div class="page">

  
  <a href="<?= estConnecte() ? 'profil.php' : 'index.php' ?>" class="back-btn">
    ← Retour
  </a>

  <!-- Hero -->
  <div class="hero">
    <h1>Mur des Supporters</h1>
    <p>
      La plateforme dédiée aux fans de football pour suivre,
      noter et commenter les matchs de la Coupe du Monde 2026.
      Partagez votre passion et connectez-vous avec d'autres fans !
    </p>
  </div>

 
  <div class="stats-row">
    <div class="stat-box">
      <div class="stat-box__value"><?= number_format($total_matchs) ?></div>
      <div class="stat-box__label">Matchs</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__value"><?= number_format($total_avis) ?></div>
      <div class="stat-box__label">Avis</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__value"><?= number_format($total_users) ?></div>
      <div class="stat-box__label">Supporters</div>
    </div>
  </div>

  <div class="container" style="margin-top: 24px;">

    <h2>Comment ça marche ?</h2>

    <div class="feature">
      <div class="feature__icon">⚽</div>
      <div>
        <div class="feature__title">Suivez les matchs</div>
        <p class="feature__desc">Accédez à tous les matchs de la CDM 2026 et indiquez ceux que vous avez regardés.</p>
      </div>
    </div>

    <div class="feature">
      <div class="feature__icon">⭐</div>
      <div>
        <div class="feature__title">Notez et commentez</div>
        <p class="feature__desc">Donnez votre note aux équipes, élisez votre MVP, notez l'ambiance — et lisez l'avis des autres fans.</p>
      </div>
    </div>

    <div class="feature">
      <div class="feature__icon">👥</div>
      <div>
        <div class="feature__title">Créez des Leagues</div>
        <p class="feature__desc">Invitez vos amis dans un groupe privé, comparez vos données et chattez ensemble pendant les matchs.</p>
      </div>
    </div>

    <div class="feature">
      <div class="feature__icon">📊</div>
      <div>
        <div class="feature__title">Explorez les stats</div>
        <p class="feature__desc">Meilleur buteur, meilleure défense, joueur préféré des supporters… toutes les statistiques de la compétition en un coup d'œil.</p>
      </div>
    </div>

    
    <?php if (!estConnecte()): ?>
      <div style="margin-top: 24px;">
        <a href="inscription.php" class="btn btn--success">Rejoindre le Mur des Supporters</a>
        <a href="connexion.php" class="btn btn--outline" style="margin-top:8px;">Déjà inscrit ? Se connecter</a>
      </div>
    <?php endif; ?>

  </div>
</div>


<nav class="bottom-nav">
  <a href="<?= estConnecte() ? 'home.php' : 'index.php' ?>" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><path d="M3 11l9-8 9 8M5 10v10h5v-6h4v6h5V10"/></svg>
    <span>Home</span>
  </a>
  <a href="<?= estConnecte() ? 'leagues.php' : 'connexion.php' ?>" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><path d="M8 4h8v4a4 4 0 01-8 0V4z"/><path d="M8 4H4a4 4 0 004 4M16 4h4a4 4 0 01-4 4"/><path d="M10 14h4v3h-4z"/><path d="M7 20h10"/></svg>
    <span>League</span>
  </a>
  <a href="stats.php" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20V14M22 20H2"/></svg>
    <span>Stats</span>
  </a>
  <a href="<?= estConnecte() ? 'profil.php' : 'connexion.php' ?>" class="bottom-nav__item">
    <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
    <span>Profil</span>
  </a>
</nav>

</body>
</html>
