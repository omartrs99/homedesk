<?php
/**
 * Landing produit, audience « Étudiants », section « versions » : la version Solo d'abord.
 * Source : product-page/lp-etudiants.html (10. CHOISIR SA VERSION).
 * Sans version Solo configurée, on garde le choix de version commun.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( $hd_solo <= 0 ) {
	include __DIR__ . '/../sections/versions.php';
	return;
}
?>
<!-- CHOISIR SA VERSION -->
<section class="section" id="versions">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">À toi de choisir</span>
			<h2 class="h2">Quelle version pour toi ?</h2>
			<p class="lead">Tu le laisses dans ta chambre → <strong>Solo</strong>. Tu l'emmènes à la fac → <strong>avec sac</strong>. Tu mesures plus de 1,87 m → <strong>Large</strong>.</p>
		</div>
		<div class="versions">
			<div class="version is-selected reveal" data-pick-taille="medium" data-pick-sac="non">
				<span class="version__badge">Le choix malin</span>
				<div class="version__row">
					<img src="<?php echo esc_url( $hd_img . 'taille-medium.webp' ); ?>" alt="HomeDesk Solo version Medium" width="700" height="700" loading="lazy">
					<div><h3>Solo · Medium</h3><p>Jusqu'à 1,87 m · le support seul, sans sac</p><div class="version__price"><?php echo $hd_dt( $hd_prices['medium']['price'] - $hd_solo ); ?></div></div>
				</div>
			</div>
			<div class="version reveal" data-pick-taille="medium" data-pick-sac="oui">
				<div class="version__row">
					<img src="<?php echo esc_url( $hd_img . 'sac-1.webp' ); ?>" alt="Sac de transport HomeDesk" width="600" height="600" loading="lazy">
					<div><h3>Medium + sac offert</h3><p>Pour la fac et la bibliothèque · sac + porte-clés</p><div class="version__price"><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?><s><?php echo $hd_dt( $hd_prices['medium']['regular'] ); ?></s></div></div>
				</div>
			</div>
		</div>
		<p class="center cta-note" style="margin-top:22px">📏 Plus de 1,87 m ? <a href="#commander" data-pick-taille="large" data-pick-sac="non"><strong>Large Solo à <?php echo $hd_dt( $hd_prices['large']['price'] - $hd_solo ); ?></strong></a> ou <a href="#commander" data-pick-taille="large" data-pick-sac="oui"><strong>Large + sac à <?php echo $hd_dt( $hd_prices['large']['price'] ); ?></strong></a>.</p>
	</div>
</section>
