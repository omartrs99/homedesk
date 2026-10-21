<?php
/**
 * Landing produit, audience « Dos et cou » : section « benefices » (bouger plus souvent).
 * Source : product-page/lp-dos-cou.html.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- BÉNÉFICES : bouger plus souvent -->
<section class="section section--alt">
	<div class="container habit">
		<img class="reveal" src="<?php echo esc_url( $hd_img . 'post-varier.webp' ); ?>" alt="Homme travaillant assis à son bureau, invitation à varier les postures" width="800" height="993" loading="lazy">
		<div class="reveal">
			<span class="eyebrow">Bouger plus souvent</span>
			<h2 class="h2">L'alternance devient une habitude, pas un effort</h2>
			<p class="lead">Le plus difficile, ce n'est pas de se lever. C'est d'y penser quand tout est installé pour rester assis. Avec HomeDesk, changer de position ne demande ni réglage compliqué ni déménagement de votre poste.</p>
			<div class="rhythm" aria-hidden="true"><span class="s">Assis</span><span class="d">Debout</span><span class="s">Assis</span><span class="d">Debout</span></div>
			<p class="rhythm-caption">Exemple de journée : vous alternez selon votre énergie et vos besoins.</p>
		</div>
	</div>
	<div class="container" style="margin-top:48px">
		<div class="grid grid--3">
			<article class="card reveal"><div class="card__icon">👀</div><h3>Le regard droit devant</h3><p>L'écran monte à hauteur des yeux : vous ne passez plus la journée tête baissée.</p><span class="card__spec">Plusieurs niveaux de hauteur</span></article>
			<article class="card reveal"><div class="card__icon">🔄</div><h3>Une pause sans quitter le travail</h3><p>Vous sentez la raideur arriver ? Levez-vous et continuez, sans rien débrancher.</p><span class="card__spec">Assis ↔ debout en 5 secondes</span></article>
			<article class="card reveal"><div class="card__icon">🏠</div><h3>Chez vous, comme au bureau</h3><p>Il se démonte et se transporte dans son sac, pour garder vos habitudes partout.</p><span class="card__spec">Sac de transport offert · valeur 85 DT</span></article>
		</div>
		<div class="cta-wrap" style="text-align:center">
			<a class="btn" href="#commander">Je donne une pause à mon dos →</a>
			<p class="cta-note">↩️ 3 jours pour essayer sinon vous êtes remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
		</div>
	</div>
</section>
