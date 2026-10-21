<?php
/**
 * Landing produit, audience « Freelances », section « benefices ».
 * Source : product-page/lp-freelances.html (6. BÉNÉFICES).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- BÉNÉFICES : liste numérotée en 2 colonnes -->
<section class="section section--alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Ce que tu y gagnes</span>
			<h2 class="h2">Pensé pour ceux qui bougent</h2>
		</div>
		<div class="benefits benefits--list">
			<div class="benefit reveal"><span class="benefit__n">01</span><div><h3>Un vrai poste, partout</h3><p>Plus besoin de t'adapter à chaque table : c'est la table qui s'adapte à toi.</p><small>Se pose sur une surface existante</small></div></div>
			<div class="benefit reveal"><span class="benefit__n">02</span><div><h3>Il voyage avec toi</h3><p>Démonté et rangé dans son sac, il part avec ton laptop.</p><small>Sac de transport offert · valeur 85 DT</small></div></div>
			<div class="benefit reveal"><span class="benefit__n">03</span><div><h3>Écran à hauteur des yeux</h3><p>Tu travailles la tête droite, au café comme chez le client.</p><small>Plusieurs niveaux de hauteur</small></div></div>
			<div class="benefit reveal"><span class="benefit__n">04</span><div><h3>Debout quand l'énergie baisse</h3><p>Coup de mou avant la deadline ? Lève-toi et continue, en 5 secondes.</p><small>Assis ↔ debout en 5 sec</small></div></div>
			<div class="benefit reveal"><span class="benefit__n">05</span><div><h3>Rien à brancher</h3><p>Pas de moteur, pas de prise : il marche partout, même sans électricité.</p><small>100 % mécanique</small></div></div>
			<div class="benefit reveal"><span class="benefit__n">06</span><div><h3>Une image pro</h3><p>Design blanc minimaliste : ton setup fait sérieux devant les clients.</p><small>MDF stratifié blanc · découpe CNC</small></div></div>
		</div>
		<div class="cta-wrap center">
			<a class="btn" href="#commander" data-pick-taille="medium" data-pick-sac="oui">Je veux mon setup mobile →</a>
			<p class="cta-note">↩️ 3 jours pour essayer sinon tu es remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></p>
		</div>
	</div>
</section>
