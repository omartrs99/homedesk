<?php
/**
 * Landing produit, audience « Étudiants », section « solution ».
 * Source : product-page/lp-etudiants.html (5. SOLUTION + DÉMO : le plan de Fenny).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- SOLUTION + DÉMO -->
<section class="section section--alt">
	<div class="container">
		<div class="fenny reveal">
			<img src="<?php echo esc_url( $hd_img . 'post-fenny.webp' ); ?>" alt="Fenny, la mascotte fennec de HomeDesk, coach ergonomique" width="800" height="993" loading="lazy">
			<div>
				<span class="eyebrow">Le plan de Fenny</span>
				<h2 class="h2">Ta table devient un vrai poste de révision</h2>
				<div class="bubble"><b>Salut, moi c'est Fenny 🦊</b><br>HomeDesk se pose sur n'importe quelle table : ton bureau, la table de la chambre, celle de la coloc. Tu poses ton laptop dessus et tu alternes assis ↔ debout quand l'énergie baisse. Simple.</div>
			</div>
		</div>
		<ol class="steps reveal">
			<li><strong>Tu le poses</strong><span>Sur ta table ou ton bureau. Il s'assemble sans outil, en quelques minutes.</span></li>
			<li><strong>Tu installes ton laptop</strong><span>Écran en haut, clavier et souris en dessous. PC jusqu'à 17 pouces.</span></li>
			<li><strong>Tu alternes</strong><span>Assis pour les fiches, debout pour relire : 5 secondes pour changer.</span></li>
		</ol>
		<div class="reveal" style="margin-top:36px">
			<div class="video">
				<video src="<?php echo esc_url( $hd_video . 'homedesk-demo.mp4' ); ?>" poster="<?php echo esc_url( $hd_img . 'video-poster.webp' ); ?>" muted loop playsinline controls preload="none" aria-label="Démonstration HomeDesk : passage de la position assise à debout"></video>
			</div>
			<div class="stats">
				<div class="stat"><b>5 sec</b><small>pour changer</small></div>
				<div class="stat"><b>0</b><small>outil</small></div>
				<div class="stat"><b>36×22</b><small>cm au sol</small></div>
			</div>
		</div>
	</div>
</section>
