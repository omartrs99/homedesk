<?php
/**
 * Landing produit, section « versions » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- CHOISIR SA VERSION -->
<section class="section" id="versions">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">choose your build</span>
			<h2 class="h2">Choisis ta version</h2>
			<p class="lead">Moins de 1,87 m → <strong>Medium</strong>. Plus de 1,87 m → <strong>Large</strong>. Tu ne le déplaceras jamais ? Prends le <strong>Solo</strong> sans sac.</p>
		</div>
		<div class="size-q reveal"><span>📏 Moins de 1,87 m → <strong>Medium</strong></span><span>📏 Plus de 1,87 m → <strong>Large</strong></span></div>
		<div class="versions">
			<div class="version is-selected reveal" data-pick-taille="medium" data-pick-sac="oui">
				<span class="version__badge">Recommandé</span>
				<div class="version__row">
					<img src="<?php echo esc_url( $hd_img . 'taille-medium.webp' ); ?>" alt="HomeDesk version Medium avec ses dimensions" width="700" height="700" loading="lazy">
					<div><h3>Medium + sac offert</h3><p>Jusqu'à 1,87 m · hauteur 55 cm</p><div class="version__price"><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?><s><?php echo $hd_dt( $hd_prices['medium']['regular'] ); ?></s></div></div>
				</div>
				<ul class="version__list"><li>Support HomeDesk Medium</li><li>Sac de transport (valeur 85 DT)</li><li>Porte-clés HomeDesk</li></ul>
			</div>
			<div class="version reveal" data-pick-taille="large" data-pick-sac="oui">
				<div class="version__row">
					<img src="<?php echo esc_url( $hd_img . 'taille-large.webp' ); ?>" alt="HomeDesk version Large avec ses dimensions" width="700" height="700" loading="lazy">
					<div><h3>Large + sac offert</h3><p>Plus de 1,87 m · hauteur 68 cm</p><div class="version__price"><?php echo $hd_dt( $hd_prices['large']['price'] ); ?><s><?php echo $hd_dt( $hd_prices['large']['regular'] ); ?></s></div></div>
				</div>
				<ul class="version__list"><li>Support HomeDesk Large + étagère tél/tablette</li><li>Sac de transport (valeur 85 DT)</li><li>Porte-clés HomeDesk</li></ul>
			</div>
		</div>
		<?php if ( $hd_solo > 0 ) : ?>
			<div class="essentiel reveal">
				<span class="essentiel__sac"><img src="<?php echo esc_url( $hd_img . 'sac-1.webp' ); ?>" alt="Sac de transport HomeDesk, non inclus dans la version Solo" width="600" height="600" loading="lazy"><i aria-hidden="true">✕</i></span>
				<p>
					<b>HomeDesk Solo</b><br>
					Prends-le <strong>sans sac</strong> et économise <?php echo $hd_dt( $hd_solo ); ?> : <strong><?php echo $hd_dt( $hd_prices['medium']['price'] - $hd_solo ); ?></strong> (Medium) ou <strong><?php echo $hd_dt( $hd_prices['large']['price'] - $hd_solo ); ?></strong> (Large).<br>
					<a href="#commander" data-pick-sac="non" data-pick-taille="medium">Commander sans sac →</a>
				</p>
			</div>
		<?php endif; ?>
	</div>
</section>
