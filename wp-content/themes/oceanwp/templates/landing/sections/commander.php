<?php
/**
 * Landing produit, section « commander » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/commander.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OFFRE + FORMULAIRE COD (plugin one-page-cod) -->
<section class="section section--alt" id="commander">
	<div class="container order">
		<div class="order__media">
			<span class="eyebrow">Sans aucun risque</span>
			<h2 class="h2">Commandez maintenant, payez à la réception</h2>
			<img src="<?php echo esc_url( $hd_img . 'femme-assise.webp' ); ?>" alt="Femme travaillant assise, son ordinateur posé sur un HomeDesk" width="900" height="900" loading="lazy">
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
				<li>💳 Paiement à la livraison · 🚚 Livraison gratuite sous 72h</li>
				<li>↩️ 3 jours pour l'essayer, sinon vous êtes remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></li>
			</ul>
		</div>
	</div>
</section>
