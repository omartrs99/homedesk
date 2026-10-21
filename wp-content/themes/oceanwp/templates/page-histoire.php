<?php
/**
 * Template Name: Notre histoire HomeDesk
 *
 * Page /notre-histoire/ : récit du fondateur, contenu versionné ici (déployé avec git).
 * Source : histoire/histoire.txt + photos fournies par HomeDesk (assets/histoire/).
 * Le fond de page passe du sombre (la douleur) à la lumière (la solution) au fil des chapitres.
 *
 * Santé : récit personnel du fondateur, aucune promesse médicale pour le produit
 * (regles-product-page.md §6) + mention « pas un dispositif médical » en fin de page.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$hd_img         = get_template_directory_uri() . '/assets/histoire/';
$hd_landing_img = get_template_directory_uri() . '/assets/landing/img/';
$hd_product_id  = function_exists( 'homedesk_default_product_id' ) ? homedesk_default_product_id() : 0;
$hd_product_url = $hd_product_id ? get_permalink( $hd_product_id ) : home_url( '/' );

get_header();
?>

<div class="hd-story" data-tone="night">
	<div class="hd-story__progress" aria-hidden="true"><span></span></div>

	<!-- OUVERTURE -->
	<header class="hd-story__hero" data-tone="night">
		<img class="hd-story__hero-img" src="<?php echo esc_url( $hd_img . 'douleur-nuit.webp' ); ?>" alt="Le fondateur de HomeDesk, tard le soir à son bureau, une main dans le bas du dos" width="927" height="1152" fetchpriority="high">
		<div class="hd-story__hero-text">
			<span class="hd-story__eyebrow">Notre histoire</span>
			<h1>Tout a commencé par <em>un mal de dos.</em></h1>
			<p>Je suis développeur web. Voici comment une douleur, à force de revenir, a fini par devenir HomeDesk.</p>
			<a class="hd-story__scroll" href="#chapitre-1">Lire l'histoire <span aria-hidden="true">↓</span> <small>3 min</small></a>
		</div>
	</header>

	<!-- 01 · LE DÉCLIC -->
	<section class="hd-story__chapter" id="chapitre-1" data-tone="night">
		<div class="hd-story__grid">
			<div class="hd-story__text reveal">
				<span class="hd-story__num">01</span>
				<h2>Le déclic</h2>
				<p>Mon métier, c'est d'écrire du code. Des heures entières devant un écran, assis, sans vraiment bouger. Pendant longtemps, je n'y ai pas prêté attention.</p>
				<p>Puis la douleur est arrivée. D'abord en fin de journée. Ensuite dès le matin. Les lombaires, toujours au même endroit, et de plus en plus souvent.</p>
				<p>Un jour, j'ai passé une IRM. Le verdict tenait en quelques mots : <strong>un début de hernie discale.</strong></p>
			</div>
			<figure class="hd-story__figure hd-story__figure--irm reveal">
				<img src="<?php echo esc_url( $hd_img . 'irm.webp' ); ?>" alt="IRM de la colonne lombaire du fondateur, avec un cercle rouge autour du début de hernie discale" width="1047" height="1200" loading="lazy">
				<figcaption>Mon IRM. Le cercle rouge, c'est là que tout a commencé.</figcaption>
			</figure>
		</div>
		<blockquote class="hd-story__quote reveal">«&nbsp;Mon corps me demandait de bouger. Mon bureau, lui, ne me laissait qu'une seule position.&nbsp;»</blockquote>
	</section>

	<!-- 02 · TOUT ESSAYER -->
	<section class="hd-story__chapter" id="chapitre-2" data-tone="dusk">
		<div class="hd-story__grid hd-story__grid--reverse">
			<div class="hd-story__text reveal">
				<span class="hd-story__num">02</span>
				<h2>Tout essayer</h2>
				<p>Alors j'ai cherché. J'ai essayé de nombreux supports pour PC. J'ai travaillé dans toutes les positions possibles, même allongé sur mon lit, l'ordinateur posé sur un support pliable.</p>
				<p>Rien n'y faisait. Chaque solution réglait un détail et en créait un autre. Je ne trouvais rien qui me soulage vraiment.</p>
			</div>
			<div class="hd-story__duo">
				<figure class="hd-story__figure reveal">
					<img src="<?php echo esc_url( $hd_img . 'lit.webp' ); ?>" alt="Le fondateur travaillant allongé sur son lit, l'ordinateur sur une petite table pliable" width="927" height="1152" loading="lazy">
					<figcaption>Le soir, sur le lit.</figcaption>
				</figure>
				<figure class="hd-story__figure reveal">
					<img src="<?php echo esc_url( $hd_img . 'support-pliable.webp' ); ?>" alt="Le fondateur penché sur son bureau, l'ordinateur sur un support pliable en aluminium" width="927" height="1152" loading="lazy">
					<figcaption>Le jour, le support pliable.</figcaption>
				</figure>
			</div>
		</div>
	</section>

	<!-- 03 · EURÊKA -->
	<section class="hd-story__chapter" id="chapitre-3" data-tone="dawn">
		<blockquote class="hd-story__quote hd-story__quote--big reveal">«&nbsp;Et si je pouvais travailler assis… <em>et debout</em>, sur le même bureau&nbsp;?&nbsp;»</blockquote>
		<div class="hd-story__grid">
			<div class="hd-story__text reveal">
				<span class="hd-story__num">03</span>
				<h2>L'idée</h2>
				<p>C'est là que l'idée m'est venue. Pas un nouveau bureau. Pas un meuble électrique hors de prix. <strong>Un support pour PC qui se pose sur le bureau qu'on a déjà</strong>, et qui permet de passer d'une position à l'autre.</p>
				<p>J'ai commencé à le dessiner. Ergonomique, modulable, simple à utiliser. Un objet qui s'adapte à chacun, au lieu de demander à chacun de s'adapter.</p>
			</div>
			<figure class="hd-story__figure reveal">
				<img src="<?php echo esc_url( $hd_img . 'croquis.webp' ); ?>" alt="Le fondateur souriant, regardant son croquis du futur support HomeDesk" width="927" height="1152" loading="lazy">
				<figcaption>Les premiers croquis.</figcaption>
			</figure>
		</div>
	</section>

	<!-- 04 · DU CROQUIS AU BOIS -->
	<section class="hd-story__chapter" id="chapitre-4" data-tone="cream">
		<div class="hd-story__grid hd-story__grid--reverse">
			<div class="hd-story__text reveal">
				<span class="hd-story__num">04</span>
				<h2>Du croquis au bois</h2>
				<p>Ensuite, il a fallu passer du papier à la réalité. J'ai passé des mois à concevoir, à tester, à refaire. J'ai travaillé avec des designers. J'ai mis les prototypes entre les mains de mes collègues et de mes amis, et j'ai écouté chacune de leurs remarques.</p>
				<p>Petit à petit, le support a trouvé sa forme : du bois de 18&nbsp;mm découpé au millimètre, des pièces qui s'emboîtent sans outil, une étagère pour l'écran, une autre pour le clavier.</p>
				<ul class="hd-story__facts">
					<li><b>18 mm</b><span>de MDF stratifié</span></li>
					<li><b>0</b><span>outil pour le monter</span></li>
					<li><b>5 sec</b><span>pour passer debout</span></li>
				</ul>
			</div>
			<div class="hd-story__duo">
				<figure class="hd-story__figure reveal">
					<img src="<?php echo esc_url( $hd_landing_img . 'detail-angle.webp' ); ?>" alt="Détail des encoches de réglage du HomeDesk" width="500" height="500" loading="lazy">
				</figure>
				<figure class="hd-story__figure reveal">
					<img src="<?php echo esc_url( $hd_landing_img . 'detail-clavier.webp' ); ?>" alt="Clavier posé sur l'étagère du HomeDesk" width="500" height="500" loading="lazy">
				</figure>
				<p class="hd-story__duo-caption">Le HomeDesk aujourd'hui : découpé à la CNC, fabriqué en Tunisie.</p>
			</div>
		</div>
	</section>

	<!-- 05 · LA NAISSANCE -->
	<section class="hd-story__chapter hd-story__chapter--wide" id="chapitre-5" data-tone="light">
		<figure class="hd-story__wide reveal">
			<img src="<?php echo esc_url( $hd_img . 'debout.webp' ); ?>" alt="Le fondateur travaillant debout, souriant, devant son HomeDesk posé sur une table en bois, dans une pièce ensoleillée" width="927" height="1152" loading="lazy">
		</figure>
		<div class="hd-story__text hd-story__text--center reveal">
			<span class="hd-story__num">05</span>
			<h2>Et voilà comment est né HomeDesk.</h2>
			<p class="hd-story__mission">Ma mission&nbsp;: proposer des produits <strong>ergonomiques et design</strong>, qui améliorent le quotidien de celles et ceux qui travaillent devant un écran, <strong>assis comme debout</strong>.</p>
		</div>
	</section>

	<!-- ET VOUS ? -->
	<section class="hd-story__end" data-tone="teal">
		<div class="hd-story__grid">
			<figure class="hd-story__figure reveal">
				<img src="<?php echo esc_url( $hd_img . 'fondateur.webp' ); ?>" alt="Le fondateur de HomeDesk souriant, assis à un bureau, un support HomeDesk derrière lui" width="927" height="1152" loading="lazy">
			</figure>
			<div class="hd-story__text reveal">
				<h2>Et vous&nbsp;?</h2>
				<p>Si vous passez vos journées assis et que votre dos ou votre nuque vous le font sentir, vous n'êtes pas seul. C'est exactement pour ça que j'ai créé HomeDesk&nbsp;: pouvoir changer de position quand le corps le demande, sans changer de bureau.</p>
				<p class="hd-story__sign">— Le fondateur de HomeDesk</p>
				<div class="hd-story__btns">
					<a class="hd-story__btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Découvrir HomeDesk →</a>
					<a class="hd-story__btn hd-story__btn--ghost" href="<?php echo esc_url( $hd_product_url ); ?>">Voir la fiche produit</a>
				</div>
				<p class="hd-story__note">HomeDesk n'est pas un dispositif médical. En cas de douleur persistante, consultez un professionnel de santé. Certaines images de cette page sont des illustrations.</p>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();
