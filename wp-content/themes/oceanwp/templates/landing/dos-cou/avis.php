<?php
/**
 * Landing produit, audience « Dos et cou » : section « avis ».
 * Source : product-page/lp-dos-cou.html (+ avis réel de Soulayma, commun à toutes les landings).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVIS CLIENTS -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Ils ont changé leurs habitudes</span>
			<h2 class="h2">Ce qu'ils ressentent au quotidien</h2>
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
				<div class="review__stars">★★★★★</div>
				<blockquote>« Je finissais mes journées avec la nuque raide. Maintenant je passe debout l'après-midi, et je me sens nettement moins tendue le soir. »</blockquote>
				<figcaption class="review__who"><span class="avatar">SH</span><div><b>Salma H.</b><span>Comptable en télétravail · Tunis</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="">
				<div class="review__stars">★★★★★</div>
				<blockquote>« Ce qui m'a convaincu, c'est la simplicité : je change de position en quelques secondes, sans y réfléchir. Mon écran est enfin à la bonne hauteur. »</blockquote>
				<figcaption class="review__who"><span class="avatar">KM</span><div><b>Karim M.</b><span>Chargé de clientèle · Ariana</span></div></figcaption>
			</figure>
			<figure class="review reveal" data-temoignage="">
				<div class="review__stars">★★★★★</div>
				<blockquote>« J'hésitais, alors j'ai profité des 3 jours d'essai. Je l'ai gardé : alterner assis et debout est devenu un réflexe, et mes fins de journée sont plus confortables. »</blockquote>
				<figcaption class="review__who"><span class="avatar">NB</span><div><b>Nour B.</b><span>Assistante de direction · Nabeul</span></div></figcaption>
			</figure>
		</div>

		<div class="ugc" aria-label="Photos de clients HomeDesk">
			<?php
			$hd_ugc = array(
				2 => 'Cliente HomeDesk travaillant debout',
				4 => 'Client HomeDesk à son poste de travail',
				6 => 'Cliente HomeDesk au travail',
				8 => 'Client HomeDesk debout devant son ordinateur',
				1 => 'Cliente HomeDesk avec un café, en position debout',
				3 => 'Client HomeDesk installé à son bureau',
			);
			foreach ( $hd_ugc as $hd_i => $hd_alt ) :
				?>
				<img src="<?php echo esc_url( $hd_img . 'client-' . $hd_i . '.webp' ); ?>" alt="<?php echo esc_attr( $hd_alt ); ?>" width="480" height="853" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>
