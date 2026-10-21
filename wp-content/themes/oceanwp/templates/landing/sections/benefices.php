<?php
/**
 * Landing produit, section « benefices » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/benefices.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- BÉNÉFICES -->
<section class="section">
	<div class="container benefits">
		<img class="reveal" src="<?php echo esc_url( $hd_img . 'post-toute-table.webp' ); ?>" alt="Homme travaillant debout avec son ordinateur sur un HomeDesk posé sur une table" width="800" height="1006" loading="lazy">
		<div>
			<div class="section-head reveal" style="margin-bottom:24px">
				<span class="eyebrow">Ce que ça change</span>
				<h2 class="h2">Un poste de travail qui s'adapte à vous</h2>
			</div>
			<div class="grid grid--2">
				<article class="card reveal"><div class="card__icon">👀</div><h3>L'écran à hauteur des yeux</h3><p>Assis comme debout, vous regardez droit devant au lieu de baisser la tête.</p><span class="card__spec">Plusieurs niveaux de hauteur</span></article>
				<article class="card reveal"><div class="card__icon">🔄</div><h3>Vous bougez plus souvent</h3><p>Changez de position quand l'énergie baisse, sans interrompre votre travail.</p><span class="card__spec">Assis ↔ debout en 5 secondes</span></article>
				<article class="card reveal"><div class="card__icon">🏠</div><h3>Gardez votre bureau</h3><p>Il se pose sur n'importe quelle table : rien à racheter, rien à réaménager.</p><span class="card__spec">Compact · se pose sur votre bureau</span></article>
				<article class="card reveal"><div class="card__icon">🧳</div><h3>Il vous suit partout</h3><p>Il se démonte et se range dans son sac : maison, bureau, coworking.</p>
					<ul class="sac-pics" aria-label="Photos du sac de transport HomeDesk">
						<li><img src="<?php echo esc_url( $hd_img . 'sac-1.webp' ); ?>" alt="Sac de transport HomeDesk vu de face, poignées et logo" width="600" height="600" loading="lazy"></li>
						<li><img src="<?php echo esc_url( $hd_img . 'sac-2.webp' ); ?>" alt="Sac de transport HomeDesk vu de profil, fin, avec sa bandoulière" width="600" height="600" loading="lazy"></li>
						<li><img src="<?php echo esc_url( $hd_img . 'sac-4.webp' ); ?>" alt="Sac de transport HomeDesk avec bandoulière" width="600" height="600" loading="lazy"></li>
					</ul>
					<span class="card__spec">Sac de transport offert · valeur 85 DT</span></article>
				<article class="card reveal"><div class="card__icon">🔧</div><h3>Prêt en quelques minutes</h3><p>Aucun outil, aucun bricolage : les pièces s'emboîtent.</p><span class="card__spec">Montage sans outil</span></article>
				<article class="card reveal"><div class="card__icon">⚡</div><h3>Rien qui tombe en panne</h3><p>Pas de moteur ni de prise : il fonctionne toujours, partout.</p><span class="card__spec">100 % mécanique</span></article>
			</div>
			<div class="cta-wrap" style="text-align:center">
				<a class="btn" href="#commander">Je passe debout →</a>
				<p class="cta-note">↩️ 3 jours pour essayer sinon vous êtes remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
			</div>
		</div>
	</div>
</section>
