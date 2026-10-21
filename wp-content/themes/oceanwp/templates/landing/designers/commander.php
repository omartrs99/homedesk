<?php
/**
 * Landing produit, audience « Designers » : section « commander » (visuel et textes propres,
 * formulaire one-page-cod identique à la page générale).
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OFFRE + FORMULAIRE COD (plugin one-page-cod) -->
<section class="section section--alt" id="commander">
	<div class="container order">
		<div class="order__media">
			<div class="num"><b>08</b>Commande</div>
			<h2 class="h2">Commandez aujourd'hui, <em>payez à la réception</em></h2>
			<img src="<?php echo esc_url( $hd_img . 'setup-ecran-laptop.webp' ); ?>" alt="Setup créatif avec HomeDesk, laptop et écran externe" width="1100" height="1100" loading="lazy">
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
				<li>💳 Rien à payer maintenant, seulement à la réception</li>
				<li>🚚 Livraison gratuite sous 72h · ↩️ 3 jours pour essayer <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></li>
			</ul>
		</div>
	</div>
</section>
