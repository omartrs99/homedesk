<?php
/**
 * Landing produit, section « avant-apres » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/avant-apres.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVANT / APRÈS -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">La différence</span>
			<h2 class="h2">Avant / après HomeDesk</h2>
			<p class="lead">Faites glisser pour comparer.</p>
		</div>
		<div class="ba reveal">
			<img src="<?php echo esc_url( $hd_img . 'avant-mobile.webp' ); ?>" alt="Avant : travail assis, tête penchée vers l'écran" width="800" height="800" loading="lazy">
			<img class="ba__after" src="<?php echo esc_url( $hd_img . 'apres-mobile.webp' ); ?>" alt="Après : travail debout avec HomeDesk, écran à hauteur des yeux" width="800" height="800" loading="lazy">
			<span class="ba__tag ba__tag--before">AVANT</span><span class="ba__tag ba__tag--after">APRÈS</span>
			<div class="ba__line"></div>
			<input type="range" min="0" max="100" value="50" aria-label="Comparer avant et après">
		</div>
		<div class="ba-legend">
			<div class="is-before"><h4>Avant</h4><ul><li>Assis toute la journée</li><li>Tête penchée vers l'écran</li><li>Dos courbé</li></ul></div>
			<div class="is-after"><h4>Après</h4><ul><li>Vous alternez assis et debout</li><li>Écran à hauteur des yeux</li><li>Bonne posture</li></ul></div>
		</div>
	</div>
</section>
