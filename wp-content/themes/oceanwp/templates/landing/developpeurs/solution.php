<?php
/**
 * Landing produit, section « solution » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement, univers IDE).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- SOLUTION + DÉMO -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">npm install posture</span>
			<h2 class="h2">Refactore ton setup en 3 étapes</h2>
			<p class="lead">HomeDesk n'est pas un nouveau bureau. C'est une mise à jour de celui que tu as déjà.</p>
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
				<li><code>install</code><strong>Pose-le sur ton bureau</strong><span>Il s'assemble sans outil, en quelques minutes.</span></li>
				<li><code>config</code><strong>Place laptop, clavier, souris</strong><span>Écran en haut, clavier en dessous, chacun à sa hauteur.</span></li>
				<li><code>run</code><strong>Alterne assis ↔ debout</strong><span>5 secondes pour changer de position, autant de fois que tu veux.</span></li>
			</ol>
			<div class="stats reveal">
				<div class="stat"><b>5 sec</b><small>pour switcher</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>17"</b><small>PC max</small></div>
			</div>
		</div>
	</div>
</section>
