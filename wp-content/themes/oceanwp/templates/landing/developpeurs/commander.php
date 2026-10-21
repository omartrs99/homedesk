<?php
/**
 * Landing produit, section « commander » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OFFRE + FORMULAIRE COD (plugin one-page-cod) -->
<section class="section section--alt" id="commander">
	<div class="container order">
		<div class="order__media">
			<span class="eyebrow">git checkout -b debout</span>
			<h2 class="h2">Commande maintenant, paie à la réception</h2>
			<img src="<?php echo esc_url( $hd_img . 'setup-ecran-laptop.webp' ); ?>" alt="Setup développeur avec HomeDesk" width="1100" height="1100" loading="lazy">
			<ul class="order__includes">
				<li>Support HomeDesk en MDF stratifié 18 mm</li>
				<li>Sac de transport offert (valeur 85 DT)</li>
				<li>Porte-clés HomeDesk</li>
				<li>Livraison gratuite partout en Tunisie, sous 72h</li>
			</ul>
		</div>

		<div class="form lp-order">
			<?php
			if ( $hd_product ) {
				echo do_shortcode( '[one_page_cod product_id="' . (int) $hd_product->get_id() . '"]' );
			}
			?>
			<ul class="form__reassure">
				<li>💳 Tu ne paies rien maintenant, seulement à la réception · 🚚 Livraison gratuite sous 72h</li>
				<li>↩️ 3 jours pour l'essayer, sinon tu es remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></li>
			</ul>
		</div>
	</div>
</section>
