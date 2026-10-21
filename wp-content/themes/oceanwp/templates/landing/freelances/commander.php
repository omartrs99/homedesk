<?php
/**
 * Landing produit, audience « Freelances », section « commander ».
 * Source : product-page/lp-freelances.html (11. OFFRE + FORMULAIRE COD).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OFFRE + FORMULAIRE COD (plugin one-page-cod) -->
<section class="section" id="commander">
	<div class="container order">
		<div class="order__media">
			<span class="eyebrow">Commande en 1 minute</span>
			<h2 class="h2">Commande maintenant, paie à la réception</h2>
			<img src="<?php echo esc_url( $hd_img . 'post-merci-sac.webp' ); ?>" alt="HomeDesk avec son sac de transport, prêt à partir" width="800" height="1000" loading="lazy">
			<ul class="order__includes">
				<li>Support HomeDesk en MDF stratifié blanc</li>
				<li>Sac de transport offert (valeur 85 DT)</li>
				<li>Porte-clés HomeDesk</li>
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
				<li>🚚 Livraison gratuite sous 72h · ↩️ 3 jours pour essayer <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></li>
			</ul>
		</div>
	</div>
</section>
