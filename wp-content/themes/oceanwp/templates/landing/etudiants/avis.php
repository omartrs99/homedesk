<?php
/**
 * Landing produit, audience « Étudiants », section « avis ».
 * Source : product-page/lp-etudiants.html (8. PREUVES SOCIALES). L'avis réel de Soulayma reste en vedette.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVIS CLIENTS -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Ils ont validé</span>
			<h2 class="h2">La note de la promo : 4,9/5</h2>
			<p class="lead"><span class="rating__stars">★★★★★</span> +200 clients équipés en Tunisie</p>
		</div>

		<!-- Avis réel : commentaire public de Soulayma Ben Hamida (TikTok HomeDesk) -->
		<figure class="featured reveal" data-temoignage="reel" style="margin-top:0">
			<img src="<?php echo esc_url( $hd_img . 'avis-soulayma.webp' ); ?>" alt="Photo envoyée par Soulayma : son HomeDesk installé chez elle, ordinateur portable sur l'étagère haute" width="571" height="826" loading="lazy">
			<div class="featured__body">
				<span class="verified">✓ Avis client vérifié</span>
				<div class="review__stars" style="margin:8px 0 0">★★★★★</div>
				<blockquote>«&nbsp;Très satisfaite.&nbsp;»</blockquote>
				<div class="featured__src">
					<img src="<?php echo esc_url( $hd_img . 'avis-soulayma-avatar.webp' ); ?>" alt="" width="88" height="88" loading="lazy">
					<div><b>Soulayma B.</b><span>Cliente HomeDesk · commentaire TikTok avec photo de son installation</span></div>
				</div>
				<p class="featured__note">Photo réelle, prise par la cliente chez elle, sans retouche.</p>
			</div>
		</figure>

		<!-- TÉMOIGNAGES FICTIFS (maquette) — à remplacer par de vrais avis clients avant diffusion en pub -->
		<div class="reviews">
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« J'ai fait tout mon semestre d'exams avec. Je relis mes fiches debout et je tiens beaucoup plus longtemps qu'avant sur mon lit. »</blockquote>
				<figcaption class="review__who"><span class="avatar">IS</span><div><b>Ines S.</b><span>Étudiante en médecine · Monastir</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« Ma chambre est minuscule, j'avais peur que ça prenne trop de place. Il tient sur mon petit bureau, et il est monté en quelques minutes. »</blockquote>
				<figcaption class="review__who"><span class="avatar">OM</span><div><b>Omar M.</b><span>Prépa ingénieur · Tunis</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« J'ai pris le Solo<?php echo $hd_solo > 0 ? ' à ' . $hd_dt( $hd_prices['medium']['price'] - $hd_solo ) : ''; ?>, payé à la livraison. Parfait pour mon PFE, mes colocs veulent tous le même maintenant. »</blockquote>
				<figcaption class="review__who"><span class="avatar">SB</span><div><b>Sarra B.</b><span>Master informatique · Sfax</span></div></figcaption>
			</figure>
		</div>

		<div class="ugc" aria-label="Photos de clients HomeDesk">
			<?php
			$hd_ugc = array(
				array( 'client-2.webp', 'Cliente HomeDesk à son bureau' ),
				array( 'client-4.webp', 'Client HomeDesk travaillant debout' ),
				array( 'client-6.webp', 'HomeDesk installé sur un bureau' ),
				array( 'client-8.webp', 'Cliente HomeDesk debout devant son laptop' ),
				array( 'client-1.webp', 'Client HomeDesk au travail' ),
				array( 'client-10.webp', 'Laptop posé sur HomeDesk' ),
			);
			foreach ( $hd_ugc as $hd_u ) :
				?>
				<img src="<?php echo esc_url( $hd_img . $hd_u[0] ); ?>" alt="<?php echo esc_attr( $hd_u[1] ); ?>" width="480" height="853" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>
