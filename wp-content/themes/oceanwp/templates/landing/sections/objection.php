<?php
/**
 * Landing produit, section « objection » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/objection.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OBJECTION PRINCIPALE : stabilité + fiche technique -->
<section class="section section--alt">
	<div class="container solid">
		<div class="solid__pics reveal">
			<img src="<?php echo esc_url( $hd_img . 'gal-2.webp' ); ?>" alt="Femme qui tape au clavier debout devant son HomeDesk, PC portable posé sur l'étagère haute" width="500" height="500" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'detail-angle.webp' ); ?>" alt="Détail des encoches de réglage du HomeDesk" width="500" height="500" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'detail-clavier.webp' ); ?>" alt="Clavier posé sur l'étagère du HomeDesk" width="500" height="500" loading="lazy">
		</div>
		<div class="reveal">
			<span class="eyebrow">La question qu'on nous pose le plus</span>
			<h2 class="h2">«&nbsp;Ça reste stable quand je tape&nbsp;?&nbsp;»</h2>
			<p class="lead">Oui. Votre écran reste en place pendant que vous tapez, assis comme debout. HomeDesk n'a rien d'un support pliant qui tangue : c'est une structure en bois qui pose bien à plat sur votre bureau.</p>
			<ul class="facts">
				<li><span><strong>Une étagère séparée pour le clavier</strong> et la souris : vous tapez en bas, l'écran reste immobile en haut.</span></li>
				<li><span><strong>Des pièces de 18 mm qui s'emboîtent au millimètre</strong>, découpées à la CNC pour un assemblage bien ajusté.</span></li>
				<li><span><strong>Une base large et un vrai poids</strong> : 36 × 22 cm et 5 kg (Medium), 45 × 34 cm et 7 kg (Large).</span></li>
			</ul>
			<img class="solid__plan" src="<?php echo esc_url( $hd_img . 'hero-6.webp' ); ?>" alt="Dimensions des HomeDesk Large et Medium : base 45 et 36 cm, étagère clavier 54 cm, étagère haute 40 × 27 cm" width="1024" height="1024" loading="lazy">
			<table class="specs">
				<thead><tr><th scope="col">Fiche technique</th><th scope="col">Medium</th><th scope="col">Large</th></tr></thead>
				<tbody>
					<tr><th scope="row">Pour une taille</th><td>jusqu'à 1,87 m</td><td>plus de 1,87 m</td></tr>
					<tr><th scope="row">Hauteur</th><td>55 cm</td><td>68 cm</td></tr>
					<tr><th scope="row">Base (L × P)</th><td>36 × 22 cm</td><td>45 × 34 cm</td></tr>
					<tr><th scope="row">Étagère haute</th><td>40 × 27 cm</td><td>40 × 27 cm</td></tr>
					<tr><th scope="row">Étagère clavier</th><td>54 × 22 cm</td><td>54 × 27 cm</td></tr>
					<tr><th scope="row">PC portable</th><td>jusqu'à 17"</td><td>jusqu'à 17"</td></tr>
					<tr><th scope="row">Étagère tél/tablette</th><td>—</td><td>✓</td></tr>
					<tr><th scope="row">Poids du support</th><td>5 kg</td><td>7 kg</td></tr>
				</tbody>
			</table>
			<?php if ( $hd_product ) : ?>
				<p class="spec-link"><a href="<?php echo esc_url( get_permalink( $hd_product->get_id() ) ); ?>">Voir la fiche produit complète →</a></p>
			<?php endif; ?>
		</div>
	</div>
</section>
