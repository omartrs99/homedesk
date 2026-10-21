<?php
/**
 * Landing produit, section « benefices » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement, univers IDE).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- BÉNÉFICES : changelog -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">CHANGELOG v2.0</span>
			<h2 class="h2">Ce qui change dans ta journée</h2>
		</div>
		<div class="grid grid--3">
			<article class="card reveal"><span class="tag tag--feat">feat</span><h3>Écran à hauteur des yeux</h3><p>Ton regard tombe droit sur le code, assis comme debout. La nuque arrête de plonger vers le laptop.</p><span class="card__spec">Plusieurs niveaux de hauteur</span></article>
			<article class="card reveal"><span class="tag tag--feat">feat</span><h3>Mode debout pour le debug</h3><p>Une session de debug qui coince ? Lève-toi et continue, sans rien débrancher.</p><span class="card__spec">Assis ↔ debout en 5 sec</span></article>
			<article class="card reveal"><span class="tag tag--fix">fix</span><h3>Ton bureau reste ton bureau</h3><p>Pas besoin de tout racheter : tu ajoutes la position debout au bureau que tu as déjà.</p><span class="card__spec">Se pose sur un bureau existant</span></article>
			<article class="card reveal"><span class="tag tag--perf">perf</span><h3>Zéro moteur, zéro panne</h3><p>Rien à brancher, rien à mettre à jour, aucune pièce électronique à remplacer un jour.</p><span class="card__spec">100 % mécanique</span></article>
			<article class="card reveal"><span class="tag tag--feat">feat</span><h3>Setup portable</h3><p>Maison, open space, coworking : il se démonte et voyage dans son sac de transport.</p>
				<ul class="sac-pics" aria-label="Photos du sac de transport HomeDesk">
					<li><img src="<?php echo esc_url( $hd_img . 'sac-1.webp' ); ?>" alt="Sac de transport HomeDesk vu de face, poignées et logo" width="600" height="600" loading="lazy"></li>
					<li><img src="<?php echo esc_url( $hd_img . 'sac-2.webp' ); ?>" alt="Sac de transport HomeDesk vu de profil, fin, avec sa bandoulière" width="600" height="600" loading="lazy"></li>
					<li><img src="<?php echo esc_url( $hd_img . 'sac-4.webp' ); ?>" alt="Sac de transport HomeDesk avec bandoulière" width="600" height="600" loading="lazy"></li>
				</ul>
				<span class="card__spec">Sac offert · valeur 85 DT</span></article>
			<article class="card reveal"><span class="tag tag--perf">perf</span><h3>Un setup clean</h3><p>Lignes minimalistes, blanc mat : ton bureau gagne en clarté, sans câbles en plus.</p><span class="card__spec">MDF stratifié blanc · découpe CNC</span></article>
		</div>
		<div class="cta-wrap center">
			<a class="btn" href="#commander">Je mets à jour mon setup →</a>
			<p class="cta-note">↩️ 3 jours pour essayer sinon tu es remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
		</div>
	</div>
</section>
