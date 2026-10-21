<?php
/**
 * Landing produit, section « final » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement, univers IDE).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- CTA FINAL -->
<section class="section final">
	<div class="container">
		<h2 class="h2"><span class="mono">$ git commit -m "passer debout"</span>Ton prochain sprint, tu le fais debout ?</h2>
		<p>Garde ton bureau. Ajoute la position debout. Paie seulement quand tu le reçois.</p>
		<div class="cta-wrap">
			<a class="btn" href="#commander"<?php echo $hd_pick; ?>>Je commande mon HomeDesk →</a>
			<p class="cta-note">Dès <?php echo $hd_dt( $hd_from ); ?> · Livraison gratuite · 3 jours pour essayer</p>
		</div>
	</div>
</section>
