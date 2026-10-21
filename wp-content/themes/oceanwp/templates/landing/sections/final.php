<?php
/**
 * Landing produit, section « final » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/final.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- CTA FINAL -->
<section class="section final">
	<div class="container">
		<h2 class="h2">Demain, travaillez debout quand vous le voulez.</h2>
		<p>Gardez votre bureau, ajoutez la position debout, et changez de posture en 5 secondes. Vous ne payez qu'à la réception.</p>
		<div class="cta-wrap">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
			<p class="cta-note">À partir de <?php echo $hd_dt( $hd_from ); ?> · Livraison gratuite · 3 jours pour essayer</p>
		</div>
	</div>
</section>
