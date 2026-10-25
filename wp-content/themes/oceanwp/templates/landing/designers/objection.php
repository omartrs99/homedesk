<?php
/**
 * Landing produit, audience « Designers » : section « objection » (s'accorder avec l'espace).
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OBJECTION PRINCIPALE : s'accorder avec l'espace / le setup -->
<section class="section section--alt">
	<div class="container">
		<div class="num reveal"><b>06</b>Fiche technique</div>
		<div class="sheet">
			<figure class="sheet__fig reveal">
				<img src="<?php echo esc_url( $hd_img . 'tailles-comparatif.webp' ); ?>" alt="Schéma coté des versions Medium et Large de HomeDesk" width="700" height="700" loading="lazy">
				<figcaption><span>Medium · Large</span><span>Cotes en cm</span></figcaption>
			</figure>
			<div class="reveal">
				<h2 class="h2">«&nbsp;S'accordera-t-il avec <em>mon espace</em>&nbsp;?&nbsp;»</h2>
				<p class="lead">Blanc, ajouré, sans moteur ni câble : HomeDesk s'efface. Voici ses cotes exactes, pour le projeter sur votre bureau.</p>
				<table class="specs">
					<thead><tr><th scope="col">Cote</th><th scope="col">Medium</th><th scope="col">Large</th></tr></thead>
					<tbody>
						<tr><th scope="row">Recommandé</th><td>≤ 1,87 m</td><td>&gt; 1,87 m</td></tr>
						<tr><th scope="row">Hauteur</th><td>55 cm</td><td>68 cm</td></tr>
						<tr><th scope="row">Emprise (L × P)</th><td>36 × 22 cm</td><td>45 × 34 cm</td></tr>
						<tr><th scope="row">Étagère écran</th><td>40 × 27 cm</td><td>40 × 27 cm</td></tr>
						<tr><th scope="row">Étagère clavier</th><td>54 × 22 cm</td><td>54 × 27 cm</td></tr>
						<tr><th scope="row">Étagère tél / tablette</th><td>—</td><td>Incluse</td></tr>
						<tr><th scope="row">PC portable</th><td>jusqu'à 17"</td><td>jusqu'à 17"</td></tr>
						<tr><th scope="row">Poids du support</th><td>5 kg</td><td>7 kg</td></tr>
					</tbody>
				</table>
				<div class="cta-wrap">
					<a class="btn" href="#commander">Je l'essaie 3 jours chez moi</a>
					<p class="cta-note">Il ne s'accorde pas avec votre espace ? <strong>Satisfait ou remboursé.</strong> <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
