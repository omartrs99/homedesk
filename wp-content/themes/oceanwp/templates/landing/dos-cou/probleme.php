<?php
/**
 * Landing produit, audience « Dos et cou » : section « probleme » (journée type + carte du corps).
 * Source : product-page/lp-dos-cou.html. Formulations prudentes (regles-product-page.md §6).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- PROBLÈME -->
<section class="section">
	<div class="container">
		<div class="empathy reveal">
			<span class="eyebrow">Vous vous reconnaissez ?</span>
			<p class="empathy__quote">« Le matin ça va. <span>Le soir, j'ai la nuque raide et le dos qui tire.</span> »</p>
			<p class="lead" style="margin:0 auto">Vous n'êtes pas seul. Quand on travaille des heures devant un écran, le corps reste dans la même position du matin au soir. Et c'est souvent là que l'inconfort s'installe.</p>
		</div>
		<ol class="day">
			<li class="reveal"><time>9h</time><div><b>Vous démarrez bien installé</b><p>Le dos est droit, l'énergie est là. Tout va bien… pour l'instant.</p></div></li>
			<li class="reveal"><time>13h</time><div><b>Les épaules montent, la tête avance</b><p>Sans vous en rendre compte, vous vous penchez vers l'écran. Les premières tensions apparaissent.</p></div></li>
			<li class="reveal"><time>18h</time><div><b>Raideur, fatigue, envie de s'étirer</b><p>La nuque est raide, le bas du dos tire. Et demain, la même journée recommence.</p></div></li>
		</ol>
		<p class="pivot-soft reveal">Ce n'est pas votre faute. Ce n'est pas un manque de volonté.<br>C'est la <span class="soft">position figée</span> qui fatigue votre corps.</p>
	</div>
</section>

<!-- CARTE DU CORPS -->
<section class="section section--alt">
	<div class="container body-map">
		<div class="body-map__fig reveal">
			<svg viewBox="0 0 200 320" role="img" aria-label="Silhouette indiquant la nuque, les épaules, le haut du dos et le bas du dos">
				<g fill="#cfe7e3">
					<circle cx="100" cy="42" r="26"/>
					<rect x="88" y="66" width="24" height="18" rx="8"/>
					<path d="M52 92c0-8 8-12 20-12h56c12 0 20 4 20 12l-6 98c0 8-6 12-14 12H72c-8 0-14-4-14-12z"/>
					<rect x="30" y="96" width="18" height="96" rx="9"/>
					<rect x="152" y="96" width="18" height="96" rx="9"/>
					<rect x="70" y="200" width="24" height="108" rx="12"/>
					<rect x="106" y="200" width="24" height="108" rx="12"/>
				</g>
				<g fill="#e8857a" fill-opacity=".9" font-family="Montserrat, sans-serif" font-weight="800" font-size="11" text-anchor="middle">
					<circle cx="100" cy="76" r="11"/><text x="100" y="80" fill="#fff">1</text>
					<circle cx="62" cy="96" r="11"/><text x="62" y="100" fill="#fff">2</text>
					<circle cx="138" cy="96" r="11"/><text x="138" y="100" fill="#fff">2</text>
					<circle cx="100" cy="122" r="11"/><text x="100" y="126" fill="#fff">3</text>
					<circle cx="100" cy="180" r="11"/><text x="100" y="184" fill="#fff">4</text>
				</g>
			</svg>
		</div>
		<div>
			<div class="reveal">
				<span class="eyebrow">Là où ça se ressent</span>
				<h2 class="h2">Quatre zones qui subissent la position assise prolongée</h2>
				<p class="lead">Changer de position ne fait pas de miracle. Mais ça évite de rester des heures dans la même posture.</p>
			</div>
			<ul class="zones">
				<li class="zone reveal"><h3><i>1</i>Nuque</h3><p>Écran trop bas, tête penchée en avant pendant des heures.</p><p class="after">Écran à hauteur des yeux, assis comme debout</p></li>
				<li class="zone reveal"><h3><i>2</i>Épaules</h3><p>Elles remontent et se crispent au fil de la journée.</p><p class="after">Clavier sur sa propre étagère, bras plus détendus</p></li>
				<li class="zone reveal"><h3><i>3</i>Haut du dos</h3><p>Le dos s'arrondit quand on se rapproche de l'écran.</p><p class="after">Debout, on se tient plus droit naturellement</p></li>
				<li class="zone reveal"><h3><i>4</i>Bas du dos</h3><p>Assis sans bouger, la raideur s'installe.</p><p class="after">Alterner assis et debout pour bouger plus souvent</p></li>
			</ul>
		</div>
	</div>
</section>
