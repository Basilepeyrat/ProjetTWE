<?php
/*
 * barre.php — Barre de navigation du bas (phone-first)
 * Onglets : Home / League / Stats / Profil
 * Composant inclus par footer.php (donc pas de garde d'accès direct ici).
 * Auteur : Basile
 *
 * Les icônes sont des SVG intégrés (pas de dépendance externe, stylables en CSS).
 * L'onglet actif est mis en surbrillance selon le paramètre "view" courant.
 */

// Vue courante pour déterminer l'onglet actif
$vueCourante = valider("view");
if (!$vueCourante) $vueCourante = "accueil";

// Petit utilitaire : renvoie "actif" si la vue passée correspond à la vue courante
function ongletActif($vue, $vueCourante) {
	return ($vue == $vueCourante) ? "actif" : "";
}
?>

<nav id="barreBas">

	<a href="index.php?view=accueil" class="<?php echo ongletActif('accueil', $vueCourante); ?>">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="M3 9.5 12 3l9 6.5" />
			<path d="M5 9v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9" />
			<path d="M9 21v-6h6v6" />
		</svg>
		<span>Home</span>
	</a>

	<a href="index.php?view=leagues" class="<?php echo ongletActif('leagues', $vueCourante); ?>">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<path d="M6 4h12v3a6 6 0 0 1-12 0V4Z" />
			<path d="M6 5H3v2a3 3 0 0 0 3 3" />
			<path d="M18 5h3v2a3 3 0 0 1-3 3" />
			<path d="M12 13v5" />
			<path d="M8 21h8l-1-3H9l-1 3Z" />
		</svg>
		<span>League</span>
	</a>

	<a href="index.php?view=stats" class="<?php echo ongletActif('stats', $vueCourante); ?>">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<line x1="3" y1="20" x2="21" y2="20" />
			<line x1="6" y1="20" x2="6" y2="12" />
			<line x1="12" y1="20" x2="12" y2="4" />
			<line x1="18" y1="20" x2="18" y2="9" />
		</svg>
		<span>Stats</span>
	</a>

	<a href="index.php?view=profil" class="<?php echo ongletActif('profil', $vueCourante); ?>">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
			<circle cx="12" cy="8" r="4" />
			<path d="M4 20a8 8 0 0 1 16 0" />
		</svg>
		<span>Profil</span>
	</a>

</nav>
