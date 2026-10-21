<?php
/**
 * Landing produit, audience « Dos et cou » : section « final ».
 * Source : product-page/lp-dos-cou.html.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- CTA FINAL -->
<section class="section final">
	<div class="container">
		<h2 class="h2">Demain, ne restez pas figé toute la journée.</h2>
		<p>Gardez votre bureau, ajoutez la position debout, et alternez dès que votre corps vous le demande. Vous ne payez qu'à la réception.</p>
		<div class="cta-wrap">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
			<p class="cta-note">À partir de <?php echo $hd_dt( $hd_from ); ?> · Livraison gratuite · 3 jours pour essayer</p>
		</div>
	</div>
</section>
