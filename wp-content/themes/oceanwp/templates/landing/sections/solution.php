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
		<ol class="steps reveal">
			<li><strong>Posez-le sur votre bureau</strong><span>Les pièces s'assemblent sans outil, en quelques minutes.</span></li>
			<li><strong>Mettre en place le PC</strong><span>L'ordinateur en haut, le clavier et la souris sur l'étagère du dessous.</span></li>
			<li><strong>Alternez quand vous voulez</strong><span>1 heure Assis, 15 min debout : 5 secondes pour changer.</span></li>
		</ol>
		<div class="reveal" style="margin-top:32px">
			<div class="video">
				<video src="<?php echo esc_url( $hd_video . 'homedesk-demo.mp4' ); ?>" poster="<?php echo esc_url( $hd_img . 'video-poster.webp' ); ?>" muted loop playsinline controls preload="none" aria-label="Démonstration HomeDesk : passage de la position assise à debout"></video>
			</div>
			<div class="stats">
				<div class="stat"><b>5 sec</b><small>assis ↔ debout</small></div>
				<div class="stat"><b>0</b><small>outil requis</small></div>
				<div class="stat"><b>3 j</b><small>pour essayer</small></div>
			</div>
		</div>
	</div>
</section>
