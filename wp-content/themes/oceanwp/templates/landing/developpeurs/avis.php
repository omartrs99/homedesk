<?php
/**
 * Landing produit, section « avis » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (avis réel conservé en vedette).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVIS CLIENTS -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">code review</span>
			<h2 class="h2">Ils codent déjà debout</h2>
			<p class="lead"><span class="rating__stars">★★★★★</span> 4,9/5 · +200 professionnels équipés en Tunisie</p>
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
				<blockquote>« Je l'ai posé sur mon bureau d'open space. Je passe debout pour les longues sessions de debug, et le laptop est enfin à hauteur des yeux. »</blockquote>
				<figcaption class="review__who"><span class="avatar">YB</span><div><b>Yassine B.</b><span class="review__role">Full-stack · Tunis</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« J'avais peur que ça bouge quand je tape. Le clavier est sur sa propre étagère, en dessous de l'écran, et ça reste stable. Monté en quelques minutes. »</blockquote>
				<figcaption class="review__who"><span class="avatar">MK</span><div><b>Mariem K.</b><span class="review__role">Data engineer · Sfax</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« Je bosse en remote et parfois au coworking. Je le démonte, je le mets dans le sac et je retrouve mon setup partout. Payé à la livraison, aucun stress. »</blockquote>
				<figcaption class="review__who"><span class="avatar">AT</span><div><b>Ahmed T.</b><span class="review__role">Dev mobile · Sousse</span></div></figcaption>
			</figure>
		</div>

		<div class="ugc" aria-label="Photos de clients HomeDesk">
			<?php
			$hd_ugc = array(
				'client-1.webp'  => 'Client HomeDesk travaillant debout',
				'client-3.webp'  => 'Cliente HomeDesk à son bureau',
				'client-9.webp'  => 'Client HomeDesk debout devant son laptop',
				'client-10.webp' => 'Laptop posé sur HomeDesk',
				'client-5.webp'  => 'Cliente HomeDesk au travail',
				'client-7.webp'  => "Détail d'un laptop sur HomeDesk",
			);
			foreach ( $hd_ugc as $hd_src => $hd_alt ) :
				?>
				<img src="<?php echo esc_url( $hd_img . $hd_src ); ?>" alt="<?php echo esc_attr( $hd_alt ); ?>" width="480" height="853" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>
