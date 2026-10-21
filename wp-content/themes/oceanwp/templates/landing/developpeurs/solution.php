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
		<ol class="steps reveal">
			<li><code>install</code><strong>Pose-le sur ton bureau</strong><span>Il s'assemble sans outil, en quelques minutes.</span></li>
			<li><code>config</code><strong>Place laptop, clavier, souris</strong><span>Écran en haut, clavier en dessous, chacun à sa hauteur.</span></li>
			<li><code>run</code><strong>Alterne assis ↔ debout</strong><span>5 secondes pour changer de position, autant de fois que tu veux.</span></li>
		</ol>
		<div class="reveal" style="margin-top:32px">
			<div class="video">
				<video src="<?php echo esc_url( $hd_video . 'homedesk-demo.mp4' ); ?>" poster="<?php echo esc_url( $hd_img . 'video-poster.webp' ); ?>" muted loop playsinline controls preload="none" aria-label="Démonstration HomeDesk : passage de la position assise à debout"></video>
			</div>
			<div class="stats">
				<div class="stat"><b>5 sec</b><small>pour switcher</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>17"</b><small>PC max</small></div>
			</div>
		</div>
	</div>
</section>
