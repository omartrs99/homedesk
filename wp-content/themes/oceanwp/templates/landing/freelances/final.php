<?php
/**
 * Landing produit, audience « Freelances », section « final ».
 * Source : product-page/lp-freelances.html (14. CTA FINAL).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- CTA FINAL -->
<section class="section final">
	<div class="container">
		<span class="eyebrow">Prochain lieu de travail ?</span>
		<h2 class="h2">Ta liberté mérite <em>un vrai poste.</em></h2>
		<p>Emporte ton setup assis-debout partout, avec son sac offert. Tu paies seulement quand tu le reçois.</p>
		<div class="cta-wrap">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>>Je commande mon HomeDesk →</a>
			<p class="cta-note"><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?> avec sac offert · Livraison gratuite · 3 jours pour essayer</p>
		</div>
	</div>
</section>
