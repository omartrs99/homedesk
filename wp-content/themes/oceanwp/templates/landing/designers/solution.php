<?php
/**
 * Landing produit, audience « Designers » : section « solution ».
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- SOLUTION + DÉMO -->
<section class="section section--alt">
	<div class="container">
		<div class="num reveal"><b>02</b>La solution</div>
		<div class="section-head reveal">
			<h2 class="h2">Un objet. <em>Deux positions.</em><br>Zéro compromis esthétique.</h2>
			<p class="lead">HomeDesk ne remplace pas votre bureau : il lui ajoute une hauteur. Assis le matin pour esquisser, debout l'après-midi pour itérer.</p>
		</div>
		<div class="mood reveal" aria-label="Moodboard HomeDesk">
			<figure class="m-a"><img src="<?php echo esc_url( $hd_img . 'gal-2.webp' ); ?>" alt="Créatrice travaillant debout sur son laptop posé sur HomeDesk" width="500" height="500" loading="lazy"><figcaption>Debout</figcaption></figure>
			<figure class="m-b"><img src="<?php echo esc_url( $hd_img . 'detail-angle.webp' ); ?>" alt="Détail de la structure en MDF blanc de HomeDesk" width="500" height="500" loading="lazy"><figcaption>Découpe CNC</figcaption></figure>
			<figure class="m-c"><img src="<?php echo esc_url( $hd_img . 'femme-assise.webp' ); ?>" alt="Femme travaillant assise avec HomeDesk sur son bureau" width="900" height="900" loading="lazy"><figcaption>Assis</figcaption></figure>
			<figure class="m-d"><img src="<?php echo esc_url( $hd_img . 'detail-laptop.webp' ); ?>" alt="Laptop posé sur l'étagère supérieure de HomeDesk" width="500" height="500" loading="lazy"><figcaption>Écran</figcaption></figure>
			<figure class="m-e"><img src="<?php echo esc_url( $hd_img . 'detail-clavier.webp' ); ?>" alt="Clavier posé sur l'étagère inférieure de HomeDesk" width="500" height="500" loading="lazy"><figcaption>Clavier</figcaption></figure>
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
				<li><strong>Posez</strong><span>Sur votre bureau actuel. Assemblage sans outil, en quelques minutes.</span></li>
				<li><strong>Composez</strong><span>Laptop en haut, clavier et souris en dessous, chacun à sa hauteur.</span></li>
				<li><strong>Alternez</strong><span>Assis ou debout en 5 secondes, au rythme de vos sessions.</span></li>
			</ol>
			<div class="stats reveal">
				<div class="stat"><b>5 sec</b><small>pour changer</small></div>
				<div class="stat"><b>18 mm</b><small>MDF stratifié</small></div>
				<div class="stat"><b>17"</b><small>PC max</small></div>
			</div>
		</div>
	</div>
</section>
