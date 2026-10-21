<?php
/**
 * Landing produit, audience « Étudiants », section « benefices ».
 * Source : product-page/lp-etudiants.html (6. BÉNÉFICES : petit budget, grosse différence).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- BÉNÉFICES -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Pourquoi c'est malin</span>
			<h2 class="h2">Petit budget, grosse différence</h2>
		</div>
		<div class="benef">
			<div class="grid grid--2">
				<article class="card reveal"><div class="card__icon">👀</div><h3>L'écran à la bonne hauteur</h3><p>Fini la tête penchée vers le laptop pendant tes sessions de révision.</p><span class="card__spec">Plusieurs niveaux de hauteur</span></article>
				<article class="card reveal"><div class="card__icon">⚡</div><h3>Debout quand ça décroche</h3><p>Coup de fatigue à 16h ? Lève-toi et continue, sans rien déplacer.</p><span class="card__spec">Assis ↔ debout en 5 sec</span></article>
				<article class="card reveal"><div class="card__icon">🏠</div><h3>Pensé pour les petites chambres</h3><p>Il tient sur ton bureau actuel et ne mange pas ta place.</p><span class="card__spec">36 × 22 cm au sol · 55 cm de haut</span></article>
				<article class="card reveal"><div class="card__icon">🔧</div><h3>Zéro galère de montage</h3><p>Pas de vis, pas d'outil, pas besoin d'appeler ton oncle bricoleur.</p><span class="card__spec">Montage sans outil</span></article>
				<article class="card reveal"><div class="card__icon">💪</div><h3>Solide pour toutes tes années de fac</h3><p>Du PFE au master, il tient le coup. Et il est beau sur ton bureau.</p><span class="card__spec">MDF stratifié blanc 18 mm · découpe CNC</span></article>
				<article class="card reveal"><div class="card__icon">🎒</div><h3>Option bibliothèque</h3><p>Tu bosses aussi à la fac ? La version avec sac se démonte et se transporte.</p><span class="card__spec">Sac offert · valeur 85 DT</span></article>
			</div>
			<aside class="reveal">
				<img src="<?php echo esc_url( $hd_img . 'post-varier.webp' ); ?>" alt="Étudiant qui travaille sur son laptop posé sur HomeDesk avec la mascotte Fenny" width="800" height="993" loading="lazy">
				<p class="hand" style="font-size:26px">Varie tes positions, garde ton énergie ✏️</p>
			</aside>
		</div>
		<div class="cta-wrap center">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>>Je m'équipe pour les exams →</a>
			<p class="cta-note">Tu ne paies <strong>qu'à la réception</strong> · 3 jours pour essayer sinon tu es remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
		</div>
	</div>
</section>
