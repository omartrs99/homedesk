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
				<li><strong>Posez-le sur votre bureau</strong><span>Il s'assemble sans outil, en quelques minutes.</span></li>
				<li><strong>Installez écran et clavier</strong><span>L'ordinateur en haut, le clavier et la souris en dessous.</span></li>
				<li><strong>Alternez quand vous voulez</strong><span>Assis le matin, debout après le déjeuner : 5 secondes pour changer.</span></li>
			</ol>
			<div class="stats reveal">
				<div class="stat"><b>5 sec</b><small>pour changer</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>2</b><small>tailles</small></div>
			</div>
		</div>
	</div>
</section>
