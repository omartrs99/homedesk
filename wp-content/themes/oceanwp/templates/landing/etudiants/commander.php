<?php
/**
 * Landing produit, audience « Étudiants », section « commander » (texte et image ; le formulaire reste celui du plugin).
 * Source : product-page/lp-etudiants.html (11. OFFRE + FORMULAIRE COD).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OFFRE + FORMULAIRE COD (plugin one-page-cod) -->
<section class="section section--alt" id="commander">
	<div class="container order">
		<div class="order__media">
			<span class="eyebrow">Dernière étape</span>
			<h2 class="h2">Commande maintenant, paie à la réception</h2>
			<img src="<?php echo esc_url( $hd_img . 'femme-assise-2.webp' ); ?>" alt="Étudiante qui travaille assise à son bureau avec HomeDesk" width="900" height="845" loading="lazy">
			<ul class="order__includes">
				<li>Support HomeDesk en MDF stratifié blanc</li>
				<li>Porte-clés HomeDesk</li>
				<li>+ sac de transport offert (valeur 85 DT) avec la version avec sac</li>
				<li>Livraison gratuite partout en Tunisie</li>
			</ul>
		</div>

		<div class="form lp-order">
			<?php
			if ( $hd_product ) {
				echo do_shortcode( '[one_page_cod product_id="' . (int) $hd_product->get_id() . '"]' );
			}
			?>
			<ul class="form__reassure">
				<li>💳 Tu ne paies rien maintenant, seulement à la réception</li>
				<li>🚚 Livraison gratuite sous 72h · ↩️ 3 jours pour essayer, sinon tu es remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></li>
			</ul>
		</div>
	</div>
</section>
