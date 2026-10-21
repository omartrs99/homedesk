<?php
/**
 * Landing produit, audience « Designers » : section « avant-apres ».
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVANT / APRÈS -->
<section class="section section--alt">
	<div class="container">
		<div class="num reveal"><b>04</b>Avant / après</div>
		<div class="section-head reveal">
			<h2 class="h2">La même table. <em>Une autre posture.</em></h2>
			<p class="lead">Faites glisser pour comparer.</p>
		</div>
		<div class="ba reveal">
			<img src="<?php echo esc_url( $hd_img . 'avant-mobile.webp' ); ?>" alt="Avant : travail assis, posture courbée devant le laptop" width="800" height="800" loading="lazy">
			<img class="ba__after" src="<?php echo esc_url( $hd_img . 'apres-mobile.webp' ); ?>" alt="Après : travail debout avec HomeDesk, écran à hauteur des yeux" width="800" height="800" loading="lazy">
			<span class="ba__tag ba__tag--before">AVANT</span><span class="ba__tag ba__tag--after">APRÈS</span>
			<div class="ba__line"></div>
			<input type="range" min="0" max="100" value="50" aria-label="Comparer avant et après">
		</div>
		<div class="ba-legend">
			<div class="is-before"><h4>Avant</h4><ul><li>Assis toute la session</li><li>Écran trop bas</li><li>Corps figé dans le flow</li></ul></div>
			<div class="is-after"><h4>Après</h4><ul><li>Vous alternez librement</li><li>Écran face au regard</li><li>Un espace qui bouge avec vous</li></ul></div>
		</div>
	</div>
</section>
