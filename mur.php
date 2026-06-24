<?php
// page de présentation - mur du site
// ============================================================

// Compteurs dynamiques depuis la BDD
$total_avis   = $pdo->query("SELECT COUNT(*) FROM AVIS_MATCH")->fetchColumn();
$total_matchs = $pdo->query("SELECT COUNT(*) FROM MATCHS")->fetchColumn();
$total_users  = $pdo->query("SELECT COUNT(*) FROM UTILISATEUR")->fetchColumn();
?>

<style>
  .hero {
    background: var(--color-primary);
    color: white;
    text-align: center;
    padding: 40px 20px 60px;
    margin: -16px -16px 0; /* déborde sur les bords du container */
  }
  .hero h1 { color: white; font-size: 30px; margin-bottom: 8px; }
  .hero p  { color: rgba(255,255,255,0.75); font-size: 14px; max-width: 340px; margin: 0 auto; }

  .stats-row {
    display: flex;
    gap: 12px;
    margin: -28px 0 24px;
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

  .feature {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 0;
    border-bottom: 1px solid var(--color-border);
  }
  .feature:last-of-type { border-bottom: none; }
  .feature__icon  { font-size: 28px; flex-shrink: 0; }
  .feature__title { font-weight: 600; font-size: 15px; margin-bottom: 4px; color: var(--color-primary); }
  .feature__desc  { font-size: 13px; color: var(--color-text-muted); margin: 0; }
</style>

<!-- Hero -->
<div class="hero">
  <h1>Mur des Supporters</h1>
  <p>
    La plateforme dédiée aux fans de football pour suivre,
    noter et commenter les matchs de la Coupe du Monde 2026.
    Partagez votre passion et connectez-vous avec d'autres fans !
  </p>
</div>

<div class="container">

  <!-- Compteurs dynamiques -->
  <div class="stats-row">
    <div class="stat-box">
      <div class="stat-box__value"><?= $total_matchs ?></div>
      <div class="stat-box__label">Matchs</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__value"><?= $total_avis ?></div>
      <div class="stat-box__label">Avis</div>
    </div>
    <div class="stat-box">
      <div class="stat-box__value"><?= $total_users ?></div>
      <div class="stat-box__label">Supporters</div>
    </div>
  </div>


  <!-- Bouton d'appel à l'action si utilisateur pas connecté -->
  <?php if (!isset($_SESSION['id_utilisateur'])): ?>
    <div style="margin-top: 24px;">
      <a href="index.php?view=inscription" class="btn btn--success">
        Rejoindre le Mur des Supporters
      </a>
      <a href="index.php?view=login" class="btn btn--outline" style="margin-top:8px;">
        Déjà inscrit ? Se connecter
      </a>
    </div>
  <?php endif; ?>

</div>
