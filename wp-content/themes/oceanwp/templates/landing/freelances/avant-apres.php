<?php
/**
 * Landing produit, audience « Freelances », section « avant-apres ».
 * Source : product-page/lp-freelances.html (7. AVANT / APRÈS).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVANT / APRÈS -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">La différence</span>
			<h2 class="h2">Avant / après HomeDesk</h2>
			<p class="lead">Glisse pour comparer.</p>
		</div>
		<div class="ba reveal">
			<img src="<?php echo esc_url( $hd_img . 'avant-mobile.webp' ); ?>" alt="Avant : travail assis, posture courbée devant le laptop" width="800" height="800" loading="lazy">
			<img class="ba__after" src="<?php echo esc_url( $hd_img . 'apres-mobile.webp' ); ?>" alt="Après : travail debout avec HomeDesk, écran à hauteur des yeux" width="800" height="800" loading="lazy">
			<span class="ba__tag ba__tag--before">AVANT</span><span class="ba__tag ba__tag--after">APRÈS</span>
			<div class="ba__line"></div>
			<input type="range" min="0" max="100" value="50" aria-label="Comparer avant et après">
		</div>
		<div class="ba-legend">
			<div class="is-before"><h4>Avant</h4><ul><li>Laptop à plat sur la table</li><li>Tête penchée toute la journée</li><li>Un poste différent, jamais adapté</li></ul></div>
			<div class="is-after"><h4>Après</h4><ul><li>Écran à hauteur des yeux</li><li>Tu alternes assis et debout</li><li>Le même setup, partout</li></ul></div>
		</div>
	</div>
</section>
