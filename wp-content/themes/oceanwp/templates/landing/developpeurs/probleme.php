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
			<p class="lead">Tu connais la boucle : vibe coding assis, meet assis, debug assis, review assis. Le laptop à plat sur le bureau, la tête qui descend vers l'écran au fil des heures.</p>
			<div class="log" role="img" aria-label="Journée type d'un développeur">
				<div><time>[09:00]</time>vibe coding ... assis sur ta chaise</div>
				<div><time>[11:30]</time><span class="w">WARN</span> nuque penchée vers l'écran du laptop</div>
				<div><time>[15:00]</time><span class="w">WARN</span> énergie en baisse, 3ᵉ café</div>
				<div><time>[19:00]</time><span class="e">ERROR</span> git push… et le dos qui commence à faire mal</div>
			</div>
			<p class="pivot">Ce n'est pas un bug. C'est ton bureau qui te bloque.</p>
		</div>
		<img class="reveal" src="<?php echo esc_url( $hd_img . '01-Teletravail-v2.jpg' ); ?>" alt="Développeur penché vers son écran, le dos voûté et la nuque tendue" width="928" height="1152" loading="lazy">
	</div>
</section>
