<?php
/**
 * Landing produit, audience « Étudiants », section « final ».
 * Source : product-page/lp-etudiants.html (14. CTA FINAL). Prix par jour calculé sur le prix réel le plus bas.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$hd_day = $hd_from / 365;
?>
<!-- CTA FINAL -->
<section class="section final">
	<div class="container">
		<span class="hand">Prochaine session d'exams…</span>
		<h2 class="h2">Tu la passes sur le canapé ou sur HomeDesk ?</h2>
		<p>Un vrai coin de révision pour <?php echo $hd_day < 0.5 ? 'moins de 0,50 DT' : esc_html( 'environ ' . number_format_i18n( $hd_day, 2 ) . ' DT' ); ?> par jour. Et tu ne paies qu'à la livraison.</p>
		<div class="cta-wrap">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>>Je commande mon HomeDesk →</a>
			<p class="cta-note">Dès <?php echo $hd_dt( $hd_from ); ?> · Livraison gratuite · 3 jours pour essayer</p>
		</div>
	</div>
</section>
