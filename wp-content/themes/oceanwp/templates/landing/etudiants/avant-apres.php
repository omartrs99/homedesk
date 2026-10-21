<?php
/**
 * Landing produit, audience « Étudiants », section « avant-apres ».
 * Source : product-page/lp-etudiants.html (7. AVANT / APRÈS).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVANT / APRÈS -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Le avant / après</span>
			<h2 class="h2">Ta révision, version upgrade</h2>
			<p class="lead">Glisse pour comparer 👇</p>
		</div>
		<div class="ba reveal">
			<img src="<?php echo esc_url( $hd_img . 'avant-mobile.webp' ); ?>" alt="Avant : travail assis, posture courbée devant le laptop" width="800" height="800" loading="lazy">
			<img class="ba__after" src="<?php echo esc_url( $hd_img . 'apres-mobile.webp' ); ?>" alt="Après : travail debout avec HomeDesk, écran à hauteur des yeux" width="800" height="800" loading="lazy">
			<span class="ba__tag ba__tag--before">AVANT</span><span class="ba__tag ba__tag--after">APRÈS</span>
			<div class="ba__line"></div>
			<input type="range" min="0" max="100" value="50" aria-label="Comparer avant et après">
		</div>
		<div class="ba-legend">
			<div class="is-before"><h4>Avant</h4><ul><li>Plié sur le lit ou le canapé</li><li>Tête penchée vers l'écran</li><li>Énergie à plat dès midi</li></ul></div>
			<div class="is-after"><h4>Après</h4><ul><li>Un vrai coin de révision</li><li>Écran à hauteur des yeux</li><li>Tu bouges quand tu veux</li></ul></div>
		</div>
	</div>
</section>
