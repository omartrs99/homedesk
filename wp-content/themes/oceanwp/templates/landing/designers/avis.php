<?php
/**
 * Landing produit, audience « Designers » : section « avis ».
 * Source : product-page/lp-designers.html (avis réel de Soulayma repris de la page générale)
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- AVIS CLIENTS -->
<section class="section">
	<div class="container">
		<div class="num reveal"><b>05</b>Ils en parlent</div>
		<div class="section-head reveal">
			<h2 class="h2">Adopté par <em>+200 professionnels</em></h2>
			<p class="lead"><span class="rating__stars">★★★★★</span> 4,9/5 de note moyenne</p>
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
		<div class="quotes">
			<figure class="quote reveal" data-temoignage="">
				<blockquote>Je cherchais un standing desk qui ne casse pas l'esthétique de mon studio. Il est blanc, épuré, et je fais mes revues de maquettes debout.</blockquote>
				<figcaption><span class="mono-av">S</span><div><b>Sarra M.</b><span>UI designer · Tunis</span></div></figcaption>
			</figure>
			<figure class="quote reveal" data-temoignage="">
				<blockquote>Mon laptop est enfin à hauteur des yeux. Je garde ma tablette graphique sur le bureau et je passe debout l'après-midi.</blockquote>
				<figcaption><span class="mono-av">K</span><div><b>Karim H.</b><span>Directeur artistique · La Marsa</span></div></figcaption>
			</figure>
			<figure class="quote reveal" data-temoignage="">
				<blockquote>Monté sans outil en quelques minutes. Je l'emporte chez mes clients dans son sac. On me demande toujours où je l'ai trouvé.</blockquote>
				<figcaption><span class="mono-av">I</span><div><b>Ines B.</b><span>Architecte d'intérieur · Sousse</span></div></figcaption>
			</figure>
		</div>

		<div class="ugc" aria-label="Photos de clients HomeDesk">
			<?php
			$hd_ugc = array(
				'client-2.webp'  => 'Client HomeDesk dans son espace de travail',
				'client-4.webp'  => 'Cliente HomeDesk travaillant debout',
				'client-6.webp'  => 'Cliente HomeDesk à son bureau',
				'client-8.webp'  => 'Client HomeDesk debout devant son laptop',
				'client-10.webp' => 'Laptop posé sur HomeDesk',
				'client-1.webp'  => 'Client HomeDesk au travail',
			);
			foreach ( $hd_ugc as $hd_src => $hd_alt ) :
				?>
				<img src="<?php echo esc_url( $hd_img . $hd_src ); ?>" alt="<?php echo esc_attr( $hd_alt ); ?>" width="480" height="853" loading="lazy">
			<?php endforeach; ?>
		</div>
	</div>
</section>
