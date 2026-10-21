<?php
/**
 * Landing produit, audience « Dos et cou » : objection « Est-ce que ça va vraiment m'aider ? ».
 * Source : product-page/lp-dos-cou.html. Pas de promesse médicale (regles-product-page.md §6).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OBJECTION PRINCIPALE : est-ce que ça va vraiment m'aider ? -->
<section class="section">
	<div class="container">
		<div class="honest reveal">
			<div>
				<span class="eyebrow">En toute honnêteté</span>
				<h2 class="h2">«&nbsp;Est-ce que ça va vraiment m'aider&nbsp;?&nbsp;»</h2>
				<p class="lead">On préfère être clair avec vous : HomeDesk n'est pas un traitement et ne remplace pas l'avis d'un professionnel de santé. Ce qu'il fait, il le fait bien :</p>
				<ul class="honest__list">
					<li class="yes"><b>✓</b><span>Il vous permet de <strong>changer de position facilement et souvent</strong>, au lieu de rester assis des heures.</span></li>
					<li class="yes"><b>✓</b><span>Il place votre <strong>écran à hauteur des yeux</strong>, pour éviter la tête penchée.</span></li>
					<li class="yes"><b>✓</b><span>Il aide à réduire l'inconfort lié à la position assise prolongée, en rendant l'alternance simple.</span></li>
					<li class="no"><b>✗</b><span>Il ne soigne pas une pathologie. En cas de douleur persistante, consultez un professionnel.</span></li>
				</ul>
				<p style="margin-top:18px">Le mieux reste encore de juger par vous-même : <strong>vous avez 3 jours pour l'essayer chez vous</strong>, et vous ne payez qu'à la réception.</p>
				<div class="cta-wrap">
					<a class="btn" href="#commander">J'essaie 3 jours chez moi →</a>
					<p class="cta-note">Pas convaincu ? <strong>Satisfait ou remboursé.</strong> <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
				</div>
			</div>
			<img src="<?php echo esc_url( $hd_img . 'post-alignement.webp' ); ?>" alt="Comparaison de posture : assis le dos courbé, puis debout et aligné avec HomeDesk" width="800" height="800" loading="lazy">
		</div>
	</div>
</section>
