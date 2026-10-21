<?php
/**
 * Landing produit, audience « Dos et cou » : section « solution ».
 * Source : product-page/lp-dos-cou.html.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- SOLUTION + DÉMO -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">La solution simple</span>
			<h2 class="h2">Votre bureau, avec la position debout en plus</h2>
			<p class="lead">Pas besoin d'acheter un nouveau bureau ni de tout réaménager. HomeDesk s'ajoute à ce que vous avez déjà.</p>
		</div>
		<ol class="steps reveal">
			<li><strong>Posez-le sur votre bureau</strong><span>Il s'assemble sans outil, en quelques minutes.</span></li>
			<li><strong>Installez écran et clavier</strong><span>L'ordinateur en haut, le clavier et la souris en dessous.</span></li>
			<li><strong>Alternez quand vous voulez</strong><span>Assis le matin, debout après le déjeuner : 5 secondes pour changer.</span></li>
		</ol>
		<div class="reveal" style="margin-top:32px">
			<div class="video">
				<video src="<?php echo esc_url( $hd_video . 'homedesk-demo.mp4' ); ?>" poster="<?php echo esc_url( $hd_img . 'video-poster.webp' ); ?>" muted loop playsinline controls preload="none" aria-label="Démonstration HomeDesk : passage de la position assise à debout"></video>
			</div>
			<div class="stats">
				<div class="stat"><b>5 sec</b><small>pour changer</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>2</b><small>tailles</small></div>
			</div>
		</div>
	</div>
</section>
