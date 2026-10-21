<?php
/**
 * Landing produit, audience « Freelances », section « objection ».
 * Source : product-page/lp-freelances.html (9. OBJECTION PRINCIPALE : transport, sac en vedette + démontage).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OBJECTION PRINCIPALE : transport (sac en vedette) -->
<section class="section section--dark">
	<div class="container bag">
		<div class="reveal">
			<span class="eyebrow">Le sac, ton meilleur allié</span>
			<h2 class="h2">«&nbsp;Ça se transporte vraiment&nbsp;?&nbsp;»<br><span class="sand">Oui, dans son propre sac.</span></h2>
			<p class="lead">La version principale est livrée avec un sac de transport sur mesure. HomeDesk se démonte sans outil, se range à plat, et part avec toi.</p>
			<div class="bag-math" aria-label="Calcul de l'offre">
				<div><span>Sac de transport (valeur)</span><span>85 DT</span></div>
				<div><span>Porte-clés HomeDesk</span><span>inclus</span></div>
				<div><span>Avec HomeDesk Medium</span><span>offerts</span></div>
				<div class="total-line"><span>Tu paies</span><b><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?></b></div>
			</div>
			<div class="cta-wrap">
				<a class="btn" href="#commander" data-pick-taille="medium" data-pick-sac="oui">Je prends la version avec sac →</a>
				<?php if ( $hd_solo > 0 ) : ?>
					<p class="cta-note">Tu ne le déplaceras jamais ? <strong>HomeDesk Solo sans sac : <?php echo $hd_dt( $hd_prices['medium']['price'] - $hd_solo ); ?>.</strong></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="bag-gallery reveal">
			<img src="<?php echo esc_url( $hd_img . 'sac-1.webp' ); ?>" alt="Sac de transport HomeDesk, vue de face" width="600" height="600" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'sac-2.webp' ); ?>" alt="Sac de transport HomeDesk, vue de côté avec bandoulière" width="600" height="600" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'sac-3.webp' ); ?>" alt="Sac de transport HomeDesk à plat" width="600" height="600" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'sac-4.webp' ); ?>" alt="Détail du sac de transport HomeDesk" width="600" height="600" loading="lazy">
		</div>
	</div>
</section>

<!-- Démontage + fiche voyage -->
<section class="section">
	<div class="container objection">
		<div class="reveal">
			<span class="eyebrow">Démontage &amp; transport</span>
			<h2 class="h2">Du bureau au sac en quelques minutes</h2>
			<ul class="pack-steps">
				<li><i>🧩</i><div><b>Démonte</b><span>Les pièces se séparent à la main, sans outil.</span></div></li>
				<li><i>🎒</i><div><b>Range</b><span>Tout tient dans le sac de transport, avec bandoulière.</span></div></li>
				<li><i>📍</i><div><b>Remonte ailleurs</b><span>Sur n'importe quelle table : maison, coworking, café, client.</span></div></li>
			</ul>
			<?php if ( $hd_product ) : ?>
				<p class="spec-link"><a href="<?php echo esc_url( get_permalink( $hd_product->get_id() ) ); ?>">Voir la fiche produit complète →</a></p>
			<?php endif; ?>
		</div>
		<div class="ticket reveal">
			<div class="ticket__head"><span>FICHE VOYAGE</span><span>HOMEDESK</span></div>
			<table>
				<tr><th scope="row">Poids</th><td>Medium : 5 kg · Large : 7 kg</td></tr>
				<tr><th scope="row">Encombrement</th><td>Medium : 36 × 22 cm · Large : 45 × 34 cm</td></tr>
				<tr><th scope="row">Hauteur</th><td>Medium : 55 cm · Large : 68 cm</td></tr>
				<tr><th scope="row">PC compatible</th><td>Jusqu'à 17 pouces</td></tr>
				<tr><th scope="row">Montage</th><td>Sans outil, en quelques minutes</td></tr>
				<tr><th scope="row">Électricité</th><td>Aucune, 100 % mécanique</td></tr>
			</table>
		</div>
	</div>
</section>
