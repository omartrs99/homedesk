<?php
/**
 * Landing produit, audience « Étudiants », section « probleme ».
 * Source : product-page/lp-etudiants.html (4. PROBLÈME : où tu révises vraiment ?).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- PROBLÈME -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">Semaine d'exams</span>
			<h2 class="h2">Avoue : tu révises où, vraiment ?</h2>
			<p class="lead">Les fiches sur le lit, le laptop sur les genoux, la nuit blanche sur le canapé de la coloc… On a tous testé. Et on a tous fini la journée tout raide.</p>
		</div>
		<div class="spots reveal">
			<div class="spot"><div class="spot__emoji">🛏️</div><h3>Le lit</h3><p>Le dos en virgule, et tu t'endors au 3ᵉ chapitre.</p><span class="spot__score">0/10 concentration</span></div>
			<div class="spot"><div class="spot__emoji">🛋️</div><h3>Le canapé</h3><p>Laptop sur les genoux, tête penchée pendant des heures.</p><span class="spot__score">Nuque en PLS</span></div>
			<div class="spot"><div class="spot__emoji">🍽️</div><h3>La table de cuisine</h3><p>Écran trop bas, et toute la coloc qui passe.</p><span class="spot__score">Bof</span></div>
			<div class="spot spot--win"><div class="spot__emoji">✨</div><h3>Avec HomeDesk</h3><p>Écran à hauteur des yeux, assis ou debout quand tu veux.</p><span class="spot__score">Mode exams ON</span></div>
		</div>
		<div class="problem-media">
			<img class="reveal" src="<?php echo esc_url( $hd_img . 'post-canape.webp' ); ?>" alt="Étudiant inconfortable avec son laptop sur le canapé, la mascotte Fenny lui dit que le canapé n'a jamais été un bureau" width="800" height="993" loading="lazy">
			<div class="reveal">
				<p class="quote-big">« Le canapé, c'est pour Netflix. »</p>
				<p class="lead">Rester assis des heures dans la même position, ça fatigue le corps et ça vide l'énergie. Ce n'est pas toi le problème : c'est ton coin de révision qui ne te laisse jamais bouger.</p>
				<p class="lead"><strong>La bonne nouvelle ?</strong> Pas besoin d'acheter un nouveau bureau pour régler ça.</p>
			</div>
		</div>
	</div>
</section>
