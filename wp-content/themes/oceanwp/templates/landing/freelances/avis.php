<?php
/**
 * Landing produit, audience « Freelances », section « avis ».
 * Source : product-page/lp-freelances.html (8. PREUVES SOCIALES).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVIS CLIENTS -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Ils l'emportent partout</span>
			<h2 class="h2">Des freelances déjà équipés</h2>
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
			<figure class="review reveal" data-temoignage="">
				<span class="review__place">☕ Café · Coworking</span>
				<div class="review__stars">★★★★★</div>
				<blockquote>« Je change de lieu presque tous les jours. Le sac a tout changé : je le démonte en deux minutes et je retrouve mon poste debout au coworking comme au café. »</blockquote>
				<figcaption class="review__who"><span class="avatar">SH</span><div><b>Sarra H.</b><span>Rédactrice web freelance · La Marsa</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="">
				<span class="review__place">🤝 Chez le client</span>
				<div class="review__stars">★★★★★</div>
				<blockquote>« Je passe des journées entières chez mes clients. Avant, je bossais sur un coin de table. Maintenant, j'arrive avec mon setup et je travaille debout quand je veux. »</blockquote>
				<figcaption class="review__who"><span class="avatar">KM</span><div><b>Karim M.</b><span>Consultant IT · Tunis</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="">
				<span class="review__place">🏠 Maison</span>
				<div class="review__stars">★★★★★</div>
				<blockquote>« Je l'ai pris pour la maison et je l'emmène finalement partout. Payé à la livraison, aucune mauvaise surprise. La version avec sac vaut vraiment le coup. »</blockquote>
				<figcaption class="review__who"><span class="avatar">IB</span><div><b>Ines B.</b><span>Community manager · Sousse</span></div></figcaption>
			</figure>
		</div>

		<div class="ugc" aria-label="Photos de clients HomeDesk">
			<?php
			$hd_ugc = array(
				'client-1'  => 'Cliente HomeDesk travaillant debout',
				'client-4'  => 'Client HomeDesk à son poste',
				'client-2'  => 'Cliente HomeDesk au travail',
				'client-6'  => 'HomeDesk en situation de travail',
				'client-8'  => 'Client HomeDesk debout devant son laptop',
				'client-10' => 'Laptop posé sur HomeDesk',
			);
			foreach ( $hd_ugc as $hd_file => $hd_alt ) :
				?>
				<img src="<?php echo esc_url( $hd_img . $hd_file . '.webp' ); ?>" alt="<?php echo esc_attr( $hd_alt ); ?>" width="480" height="853" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>
