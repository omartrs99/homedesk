<?php
/**
 * Landing produit, section « probleme » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement, univers IDE).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- PROBLÈME -->
<section class="section">
	<div class="container problem">
		<div class="reveal">
			<span class="eyebrow">while (true) { assis(); }</span>
			<h2 class="h2">8h de code. <span class="hl">0 minute debout.</span></h2>
			<p class="lead">Tu connais la boucle : stand-up assis, sprint assis, debug assis, review assise. Le laptop à plat sur le bureau, la tête qui descend vers l'écran au fil des heures.</p>
			<div class="log" role="img" aria-label="Journée type d'un développeur">
				<div><time>[09:00]</time>stand-up… depuis ta chaise</div>
				<div><time>[11:30]</time><span class="w">WARN</span> nuque penchée vers l'écran du laptop</div>
				<div><time>[15:00]</time><span class="w">WARN</span> énergie en baisse, 3ᵉ café</div>
				<div><time>[19:00]</time><span class="e">ERROR</span> git push… et le dos qui tire</div>
			</div>
			<p class="pivot">Ce n'est pas un bug de motivation. C'est ton setup qui est figé.</p>
		</div>
		<img class="reveal" src="<?php echo esc_url( $hd_img . 'post-code-mal-dos.webp' ); ?>" alt="Développeur qui se tient le bas du dos après 4 heures de code" width="800" height="993" loading="lazy">
	</div>
</section>
