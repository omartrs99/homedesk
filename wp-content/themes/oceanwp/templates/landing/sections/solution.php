<?php
/**
 * Landing produit, section « solution » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/solution.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- SOLUTION + DÉMO -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Comment ça marche</span>
			<h2 class="h2">Ajoutez la position debout à votre bureau actuel</h2>
			<p class="lead">Pas de nouveau meuble, pas de moteur, rien à brancher. Trois étapes, et votre poste change.</p>
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
				<li><strong>Posez-le sur votre bureau</strong><span>Les pièces s'assemblent sans outil, en quelques minutes.</span></li>
				<li><strong>Mettre en place le PC</strong><span>L'ordinateur en haut, le clavier et la souris sur l'étagère du dessous.</span></li>
				<li><strong>Alternez quand vous voulez</strong><span>1 heure Assis, 15 min debout : 5 secondes pour changer.</span></li>
			</ol>
			<div class="stats reveal">
				<div class="stat"><b>5 sec</b><small>assis ↔ debout</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>3 j</b><small>pour essayer</small></div>
			</div>
		</div>
	</div>
</section>
