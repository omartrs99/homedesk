<?php
/**
 * Landing produit, section « avant-apres » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement, univers IDE).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVANT / APRÈS -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">git diff setup</span>
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
			<div class="is-before"><h4>− Avant</h4><ul><li>Assis toute la journée</li><li>Tête penchée vers le laptop</li><li>Setup figé</li></ul></div>
			<div class="is-after"><h4>+ Après</h4><ul><li>Tu alternes quand tu veux</li><li>Écran à hauteur des yeux</li><li>Setup flexible</li></ul></div>
		</div>
	</div>
</section>
