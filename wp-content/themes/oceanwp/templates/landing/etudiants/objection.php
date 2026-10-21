<?php
/**
 * Landing produit, audience « Étudiants », section « objection » : le prix.
 * Source : product-page/lp-etudiants.html (9. OBJECTION PRINCIPALE : le prix, ticket de caisse).
 * Prix réels (variations + remise Solo). Sans version Solo configurée, on garde l'objection commune.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( $hd_solo <= 0 ) {
	include __DIR__ . '/../sections/objection.php';
	return;
}

$hd_solo_m = $hd_prices['medium']['price'] - $hd_solo;
$hd_day    = $hd_solo_m / 365;
$hd_day_tx = $hd_day < 0.5 ? '< 0,50 DT / jour' : '≈ ' . number_format_i18n( $hd_day, 2 ) . ' DT / jour';
?>
<!-- OBJECTION PRINCIPALE : le prix -->
<section class="section section--alt">
	<div class="container objection">
		<div class="reveal">
			<span class="eyebrow">On en parle ?</span>
			<h2 class="h2">«&nbsp;C'est trop cher pour moi.&nbsp;»</h2>
			<p class="lead">On comprend, le budget étudiant, c'est sacré. C'est pour ça qu'on a créé <strong>HomeDesk Solo</strong> : le même support, sans le sac, à <strong><?php echo $hd_dt( $hd_solo_m ); ?></strong>.</p>
			<ul class="checks">
				<li>Aucun acompte, aucune carte bancaire : tu paies en espèces à la livraison</li>
				<li>Livraison gratuite, même dans ta ville universitaire</li>
				<li>3 jours pour l'essayer dans ta chambre, sinon remboursé</li>
				<li>Tu vas aussi à la bibliothèque ? Version avec sac à <?php echo $hd_dt( $hd_prices['medium']['price'] ); ?> (sac d'une valeur de 85 DT offert)</li>
			</ul>
			<div class="cta-wrap">
				<a class="btn" href="#commander" data-pick-taille="medium" data-pick-sac="non">Je choisis le Solo →</a>
			</div>
		</div>
		<div class="ticket reveal" role="img" aria-label="<?php echo esc_attr( 'Calcul : ' . wp_strip_all_tags( $hd_dt( $hd_solo_m ) ) . ' répartis sur un an, soit ' . str_replace( '<', 'moins de', $hd_day_tx ) ); ?>">
			<h3>🧾 Le calcul malin</h3>
			<small>HomeDesk Solo · Medium</small>
			<div class="row"><span>HomeDesk Solo</span><span><?php echo $hd_dt( $hd_solo_m ); ?></span></div>
			<div class="row"><span>Livraison</span><span>0 DT</span></div>
			<div class="row"><span>Acompte</span><span>0 DT</span></div>
			<div class="row row--total"><span>Total à la livraison</span><span><?php echo $hd_dt( $hd_solo_m ); ?></span></div>
			<div class="big">÷ 365 jours de révisions<b><?php echo esc_html( $hd_day_tx ); ?></b></div>
		</div>
	</div>
</section>
