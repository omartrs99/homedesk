<?php
/**
 * Landing produit, audience « Designers » : section « benefices ».
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- BÉNÉFICES -->
<section class="section">
	<div class="container">
		<div class="num reveal"><b>03</b>Les détails</div>
		<h2 class="h2 reveal" style="margin-bottom:24px">Pensé comme <em>un objet</em>,<br>pas comme un accessoire.</h2>
		<div>
			<article class="feature reveal">
				<div class="feature__img"><img src="<?php echo esc_url( $hd_img . 'post-ecran-hauteur.webp' ); ?>" alt="Homme debout, écran de laptop à hauteur des yeux grâce à HomeDesk" width="800" height="993" loading="lazy"></div>
				<div><h3>Le regard à la bonne hauteur</h3><p>Votre écran remonte face à vous. Vous voyez la composition entière sans plonger la tête vers le bureau.</p><span class="feature__spec">Plusieurs niveaux de hauteur</span></div>
			</article>
			<article class="feature reveal">
				<div class="feature__img"><img src="<?php echo esc_url( $hd_img . 'post-travaillez-debout.webp' ); ?>" alt="Homme travaillant debout sur clavier et laptop posés sur HomeDesk" width="800" height="993" loading="lazy"></div>
				<div><h3>Changer de point de vue</h3><p>Quand une idée bloque, levez-vous et continuez. Changer de position, c'est aussi relancer l'énergie.</p><span class="feature__spec">Assis ↔ debout en 5 secondes</span></div>
			</article>
			<article class="feature reveal">
				<div class="feature__img"><img src="<?php echo esc_url( $hd_img . 'detail-angle.webp' ); ?>" alt="Détail des lignes et de la découpe CNC de HomeDesk" width="500" height="500" loading="lazy"></div>
				<div><h3>Des lignes qui s'effacent</h3><p>Blanc mat, silhouette ajourée, aucun câble : HomeDesk se fond dans un espace soigné au lieu de l'encombrer.</p><span class="feature__spec">MDF stratifié blanc 18 mm · découpe CNC</span></div>
			</article>
			<article class="feature reveal">
				<div class="feature__img"><img src="<?php echo esc_url( $hd_img . 'post-modulaire.webp' ); ?>" alt="HomeDesk compact et portable avec son sac de transport" width="800" height="993" loading="lazy"></div>
				<div><h3>Votre espace, partout</h3><p>Studio, agence, client : HomeDesk se démonte et voyage dans son sac. Votre poste debout vous suit.</p><span class="feature__spec">Démontable · sac offert, valeur 85 DT</span></div>
			</article>
		</div>
		<div class="cta-wrap center">
			<a class="btn" href="#commander">Je choisis mon HomeDesk</a>
			<p class="cta-note">💳 Vous ne payez qu'à la réception · ↩️ 3 jours pour essayer sinon vous êtes remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
		</div>
	</div>
</section>
