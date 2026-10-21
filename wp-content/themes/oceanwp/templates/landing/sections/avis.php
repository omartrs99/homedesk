<?php
/**
 * Landing produit, section « avis » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/avis.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVIS CLIENTS -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Avis clients</span>
			<h2 class="h2">Ils travaillent déjà avec HomeDesk</h2>
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
				<blockquote>« Je l'ai posé sur mon bureau habituel, monté en quelques secondes. Maintenant je peux basculer d'une position à une autre. »</blockquote>
				<figcaption class="review__who"><span class="avatar">YK</span><div><b>Yassine K.</b><span>Développeur · Tunis</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« J'avais peur que ça bouge quand je tape. Au final c'est stable, et l'écran est enfin à la bonne hauteur. Je l'emporte même au coworking dans son sac. »</blockquote>
				<figcaption class="review__who"><span class="avatar">MS</span><div><b>Mariem S.</b><span>Freelance · Sousse</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="fictif">
				<div class="review__stars">★★★★★</div>
				<blockquote>« Au début, j'ai voulu le testé pendant 3 jours. J'ai fini maintenant par le garder : alterner assis et debout est devenu un réflexe pour moi. »</blockquote>
				<figcaption class="review__who"><span class="avatar">AB</span><div><b>Amine B.</b><span>Télétravailleur · Sfax</span></div></figcaption>
			</figure>
		</div>

		<div class="ugc" aria-label="Photos de clients HomeDesk">
			<?php
			$hd_ugc = array(
				'Cliente HomeDesk avec un café, en position debout',
				'Cliente HomeDesk travaillant debout',
				'Client HomeDesk installé à son bureau',
				'Client HomeDesk à son poste de travail',
				'Client HomeDesk au travail',
				'Cliente HomeDesk au travail',
				'Client HomeDesk debout devant son ordinateur',
				'Client HomeDesk en position debout',
			);
			foreach ( $hd_ugc as $hd_i => $hd_alt ) :
				?>
				<img src="<?php echo esc_url( $hd_img . 'client-' . ( $hd_i + 1 ) . '.webp' ); ?>" alt="<?php echo esc_attr( $hd_alt ); ?>" width="480" height="853" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>
