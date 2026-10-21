<?php
/**
 * Landing produit, audience « Designers » : section « final ».
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- CTA FINAL -->
<section class="section final">
	<div class="container">
		<h2 class="h2">Le bon espace <em>vous laisse bouger.</em></h2>
		<p>Gardez votre bureau. Ajoutez une hauteur. Payez seulement à la réception.</p>
		<div class="cta-wrap">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
			<p class="cta-note">À partir de <?php echo $hd_dt( $hd_from ); ?> · Livraison gratuite · 3 jours pour essayer</p>
		</div>
	</div>
</section>
