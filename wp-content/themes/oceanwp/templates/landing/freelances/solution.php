<?php
/**
 * Landing produit, audience « Freelances », section « solution ».
 * Source : product-page/lp-freelances.html (5. SOLUTION : itinéraire + démo).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- SOLUTION : itinéraire d'une journée + démo -->
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow">Une journée avec HomeDesk</span>
			<h2 class="h2">Un seul setup. <span class="tealtxt">Tous tes lieux de travail.</span></h2>
			<p class="lead">HomeDesk se pose sur n'importe quelle table. Partout où tu ouvres ton laptop, tu retrouves un poste assis-debout.</p>
		</div>
		<div class="route-line" aria-hidden="true"></div>
		<div class="route" aria-label="Itinéraire d'une journée de freelance">
			<article class="stop reveal"><span class="stop__n">1</span><img src="<?php echo esc_url( $hd_img . 'femme-cuisine.webp' ); ?>" alt="Freelance qui travaille debout chez elle avec HomeDesk" width="900" height="900" loading="lazy"><h3>Maison</h3><p>Session focus du matin, debout près de la fenêtre.</p></article>
			<article class="stop reveal"><span class="stop__n">2</span><img src="<?php echo esc_url( $hd_img . 'post-suit-partout.webp' ); ?>" alt="Freelance qui transporte HomeDesk dans son sac en ville" width="800" height="800" loading="lazy"><h3>Coworking</h3><p>Démonté, dans le sac, sur l'épaule.</p></article>
			<article class="stop reveal"><span class="stop__n">3</span><img src="<?php echo esc_url( $hd_img . 'post-cafe.webp' ); ?>" alt="Freelance qui travaille debout en terrasse de café avec HomeDesk" width="800" height="800" loading="lazy"><h3>Café</h3><p>Même une table de terrasse devient un poste debout.</p></article>
			<article class="stop reveal"><span class="stop__n">4</span><img src="<?php echo esc_url( $hd_img . 'homme-debout.webp' ); ?>" alt="Professionnel debout devant son laptop sur HomeDesk au bureau" width="900" height="900" loading="lazy"><h3>Chez le client</h3><p>Ton propre setup, sur la table qu'on te prête.</p></article>
		</div>

		<!-- Vidéo verticale : à gauche des étapes sur ordinateur, entre les étapes et les chiffres sur mobile -->
		<div class="demo">
			<div class="demo__media reveal">
				<div class="video video--vertical">
					<video muted loop playsinline controls preload="none" data-autoplay poster="<?php echo esc_url( $hd_video . 'homedesk-landing-farah-vertical-poster.webp' ); ?>" width="720" height="1280" aria-label="Démonstration HomeDesk : passage de la position assise à debout">
						<source src="<?php echo esc_url( $hd_video . 'homedesk-landing-farah-vertical-web.mp4' ); ?>" type="video/mp4">
					</video>
				</div>
			</div>
			<ol class="steps reveal">
				<li><strong>Sors-le du sac</strong><span>Les pièces s'assemblent sans outil, en quelques minutes.</span></li>
				<li><strong>Pose-le sur la table</strong><span>Laptop en haut, clavier et souris en dessous.</span></li>
				<li><strong>Alterne assis ↔ debout</strong><span>5 secondes pour changer de position.</span></li>
			</ol>
			<div class="stats reveal">
				<div class="stat"><b>5 sec</b><small>assis ↔ debout</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>5 kg</b><small>poids (Medium)</small></div>
			</div>
		</div>
	</div>
</section>
