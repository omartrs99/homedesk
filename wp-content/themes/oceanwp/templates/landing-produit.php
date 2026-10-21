<?php
/**
 * Template Name: Landing produit HomeDesk
 *
 * Landing de vente (accueil + landings Meta Ads /lp/{audience}/).
 * Design : product-page/product-page.html. Le contenu propre à chaque audience
 * (hero) vient de templates/landing/{audience}.php ; le formulaire est celui
 * du plugin one-page-cod. Réglages : boîte « Landing HomeDesk » de la page.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$hd_lp       = homedesk_landing_settings();
$hd_product  = wc_get_product( $hd_lp['product_id'] );
$hd_img      = get_template_directory_uri() . '/assets/landing/img/';
$hd_video    = get_template_directory_uri() . '/assets/landing/video/';

// Contenu : page générale + surcharges de l'audience
$hd_content = include __DIR__ . '/landing/generale.php';
if ( 'generale' !== $hd_lp['audience'] && file_exists( __DIR__ . '/landing/' . $hd_lp['audience'] . '.php' ) ) {
	$hd_content = array_merge( $hd_content, include __DIR__ . '/landing/' . $hd_lp['audience'] . '.php' );
}

// Prix réels des variations (attribut pa_version : medium / large) + remise « Solo »
$hd_prices = array(
	'medium' => array( 'price' => 199, 'regular' => 219 ),
	'large'  => array( 'price' => 209, 'regular' => 229 ),
);
if ( $hd_product && $hd_product->is_type( 'variable' ) ) {
	foreach ( $hd_product->get_available_variations() as $hd_vd ) {
		$hd_var = wc_get_product( $hd_vd['variation_id'] );
		foreach ( $hd_vd['attributes'] as $hd_value ) {
			if ( isset( $hd_prices[ $hd_value ] ) && $hd_var ) {
				$hd_prices[ $hd_value ] = array(
					'price'   => (float) wc_get_price_to_display( $hd_var ),
					'regular' => (float) wc_get_price_to_display( $hd_var, array( 'price' => $hd_var->get_regular_price() ) ),
				);
			}
		}
	}
}
$hd_solo     = function_exists( 'opc_get_nobag_discount' ) ? (float) opc_get_nobag_discount() : 0;
$hd_dt       = function ( $n ) { return esc_html( wp_strip_all_tags( number_format_i18n( $n ) ) . ' DT' ); };
$hd_from     = min( $hd_prices['medium']['price'], $hd_prices['large']['price'] ) - $hd_solo;
$hd_hero_img = $hd_content['hero'];
$hd_pick     = '';
foreach ( (array) $hd_content['cta_pick'] as $hd_k => $hd_v ) {
	$hd_pick .= ' data-pick-' . esc_attr( $hd_k ) . '="' . esc_attr( $hd_v ) . '"';
}

// Formulaire COD : titre adapté à la landing
add_filter( 'opc_form_title', function () { return 'Votre commande'; } );

$hd_tip = '<span class="tip"><button class="tip__btn" type="button" aria-label="Conditions de remboursement">i</button>'
	. '<span class="tip__box" role="tooltip"><b>Conditions de remboursement</b>'
	. 'Retournez le produit complet, dans son état d\'origine : sans casse, détérioration ni salissure. Après vérification, vous êtes remboursé intégralement sous 7 jours ouvrables.'
	. '</span></span>';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preload" as="image" href="<?php echo esc_url( $hd_img . $hd_hero_img['src'] ); ?>" fetchpriority="high">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Poppins:wght@400;500;600&display=swap">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'hd-landing hd-landing--' . $hd_lp['audience'] ); ?>>
<?php wp_body_open(); ?>

<div class="topbar">🎁 Sac de transport offert · Testez-le 3 jours, satisfait ou remboursé</div>

<header class="header">
	<div class="container">
		<a class="header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="HomeDesk, accueil"><img src="<?php echo esc_url( $hd_img . 'logo.webp' ); ?>" alt="HomeDesk" width="160" height="22"></a>
		<a class="header__cta" href="#commander">Commander · À partir de <?php echo $hd_dt( $hd_from ); ?></a>
	</div>
</header>

<main id="top" data-lp-slug="<?php echo esc_attr( $hd_lp['slug'] ); ?>" data-lp-profil="<?php echo esc_attr( $hd_lp['profil'] ); ?>">

	<!-- HERO (contenu propre à l'audience) -->
	<section class="hero">
		<div class="container hero__grid">
			<div>
				<span class="eyebrow"><?php echo esc_html( $hd_content['eyebrow'] ); ?></span>
				<h1><?php echo wp_kses( $hd_content['h1'], array( 'span' => array( 'class' => true ), 'br' => array() ) ); ?></h1>
				<p class="hero__sub"><?php echo wp_kses( $hd_content['sub'], array( 'strong' => array() ) ); ?></p>
				<ul class="hero__bullets">
					<?php foreach ( $hd_content['bullets'] as $hd_bullet ) : ?>
						<li><?php echo esc_html( $hd_bullet ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="hero__price"><b><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?></b><s><?php echo $hd_dt( $hd_prices['medium']['regular'] ); ?></s><span>Sac offert · valeur 85 DT</span></div>
				<div class="rating" style="margin-top:12px"><span class="rating__stars">★★★★★</span><span><strong>4,9/5</strong> · +200 professionnels équipés</span></div>
				<div class="cta-wrap" style="margin-top:22px">
					<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
					<p class="cta-note">À partir de <strong><?php echo $hd_dt( $hd_from ); ?></strong> · Paiement à la livraison · Livraison gratuite</p>
				</div>
			</div>
			<div class="gallery" data-gallery>
				<div class="gallery__main">
					<img src="<?php echo esc_url( $hd_img . $hd_hero_img['src'] ); ?>" alt="<?php echo esc_attr( $hd_hero_img['alt'] ); ?>" width="<?php echo (int) $hd_hero_img['w']; ?>" height="<?php echo (int) $hd_hero_img['h']; ?>" fetchpriority="high" data-gallery-main>
					<span class="gallery__badge">Assis ↔ debout en 5 sec</span>
				</div>
				<ul class="gallery__thumbs">
					<?php
					$hd_thumbs = array(
						array( $hd_hero_img['src'], $hd_hero_img['alt'], 'Photo 1' ),
						array( 'femme-sourire.webp', 'Femme travaillant debout dans un bureau avec HomeDesk', 'Photo 2 : au bureau' ),
						array( 'detail-clavier.webp', 'Gros plan sur l\'étagère clavier du HomeDesk', 'Photo 3 : étagère clavier' ),
						array( 'detail-laptop.webp', 'Ordinateur portable posé sur l\'étagère haute du HomeDesk', 'Photo 4 : étagère ordinateur' ),
						array( 'sac-4.webp', 'Sac de transport noir HomeDesk', 'Photo 5 : sac de transport' ),
					);
					if ( 'femme-sourire.webp' === $hd_hero_img['src'] ) {
						$hd_thumbs[1] = array( 'hero-homme-pc.webp', 'Homme souriant travaillant debout, son ordinateur posé sur un HomeDesk', 'Photo 2 : en usage debout' );
					}
					foreach ( $hd_thumbs as $hd_i => $hd_t ) :
						?>
						<li><button type="button" aria-current="<?php echo 0 === $hd_i ? 'true' : 'false'; ?>" aria-label="<?php echo esc_attr( $hd_t[2] ); ?>" data-src="<?php echo esc_url( $hd_img . $hd_t[0] ); ?>" data-alt="<?php echo esc_attr( $hd_t[1] ); ?>"><img src="<?php echo esc_url( $hd_img . $hd_t[0] ); ?>" alt="" width="200" height="200" loading="lazy"></button></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<!-- RÉASSURANCE -->
	<div class="trust">
		<ul class="container trust__list">
			<li><span>🚚</span>Livraison gratuite partout en Tunisie (72h)</li>
			<li><span>💳</span>Paiement à la livraison</li>
			<li><span>↩️</span>3 jours pour essayer</li>
			<li><span>📍</span>Fabriqué en Tunisie</li>
		</ul>
	</div>

	<!-- PROBLÈME -->
	<section class="section">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow">Vous vous reconnaissez ?</span>
				<h2 class="h2">Assis du matin au soir, sans jamais changer de position</h2>
				<p class="lead">Télétravail, bureau, révisions : on passe des heures devant un écran, dans la même posture. Et on le sent en fin de journée.</p>
			</div>
			<div class="pains">
				<div class="pain reveal"><i>💻</i><b>L'écran trop bas</b><p>Le laptop posé à plat vous oblige à baisser la tête pendant des heures.</p></div>
				<div class="pain reveal"><i>🪑</i><b>Une seule position possible</b><p>Votre bureau ne vous laisse qu'un choix : rester assis, même quand l'énergie baisse.</p></div>
				<div class="pain reveal"><i>😮‍💨</i><b>La fatigue de fin de journée</b><p>Nuque raide, épaules tendues, envie de s'étirer : rester assis sans bouger fatigue le corps.</p></div>
			</div>
			<p class="pivot reveal">Ce n'est pas un manque de volonté.<br>C'est votre installation qui <span class="hl">ne vous laisse pas bouger</span>.</p>
			<ul class="who reveal" aria-label="Pour qui ?">
				<li>👨‍💻 Développeurs</li><li>🎨 Designers</li><li>🏠 Télétravailleurs</li><li>🧳 Freelances</li><li>📚 Étudiants</li>
			</ul>
		</div>
	</section>

	<!-- SOLUTION + DÉMO -->
	<section class="section section--alt">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow">Comment ça marche</span>
				<h2 class="h2">Ajoutez la position debout à votre bureau actuel</h2>
				<p class="lead">Pas de nouveau meuble, pas de moteur, rien à brancher. Trois étapes, et votre poste change.</p>
			</div>
			<ol class="steps reveal">
				<li><strong>Posez-le sur votre bureau</strong><span>Les pièces s'assemblent sans outil, en quelques minutes.</span></li>
				<li><strong>Mettre en place le PC</strong><span>L'ordinateur en haut, le clavier et la souris sur l'étagère du dessous.</span></li>
				<li><strong>Alternez quand vous voulez</strong><span>1 heure Assis, 15 min debout : 5 secondes pour changer.</span></li>
			</ol>
			<div class="reveal" style="margin-top:32px">
				<div class="video">
					<video src="<?php echo esc_url( $hd_video . 'homedesk-demo.mp4' ); ?>" poster="<?php echo esc_url( $hd_img . 'video-poster.webp' ); ?>" muted loop playsinline controls preload="none" aria-label="Démonstration HomeDesk : passage de la position assise à debout"></video>
				</div>
				<div class="stats">
					<div class="stat"><b>5 sec</b><small>assis ↔ debout</small></div>
					<div class="stat"><b>0</b><small>outil requis</small></div>
					<div class="stat"><b>3 j</b><small>pour essayer</small></div>
				</div>
			</div>
		</div>
	</section>

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

	<!-- AVANT / APRÈS -->
	<section class="section section--alt">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow">La différence</span>
				<h2 class="h2">Avant / après HomeDesk</h2>
				<p class="lead">Faites glisser pour comparer.</p>
			</div>
			<div class="ba reveal">
				<img src="<?php echo esc_url( $hd_img . 'avant-mobile.webp' ); ?>" alt="Avant : travail assis, tête penchée vers l'écran" width="800" height="800" loading="lazy">
				<img class="ba__after" src="<?php echo esc_url( $hd_img . 'apres-mobile.webp' ); ?>" alt="Après : travail debout avec HomeDesk, écran à hauteur des yeux" width="800" height="800" loading="lazy">
				<span class="ba__tag ba__tag--before">AVANT</span><span class="ba__tag ba__tag--after">APRÈS</span>
				<div class="ba__line"></div>
				<input type="range" min="0" max="100" value="50" aria-label="Comparer avant et après">
			</div>
			<div class="ba-legend">
				<div class="is-before"><h4>Avant</h4><ul><li>Assis toute la journée</li><li>Tête penchée vers l'écran</li><li>Dos courbé</li></ul></div>
				<div class="is-after"><h4>Après</h4><ul><li>Vous alternez assis et debout</li><li>Écran à hauteur des yeux</li><li>Support transportable</li></ul></div>
			</div>
		</div>
	</section>

	<!-- AVIS CLIENTS -->
	<section class="section">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow">Avis clients</span>
				<h2 class="h2">Ils travaillent déjà avec HomeDesk</h2>
				<p class="lead"><span class="rating__stars">★★★★★</span> 4,9/5 · +200 professionnels équipés en Tunisie</p>
			</div>

			<!-- Avis réel : commentaire public de Soulayma Ben Hamida (TikTok HomeDesk) -->
			<figure class="featured reveal" data-temoignage="reel" style="margin-top:0">
				<img src="<?php echo esc_url( $hd_img . 'avis-soulayma.webp' ); ?>" alt="Photo envoyée par Soulayma : son HomeDesk installé chez elle, ordinateur portable sur l'étagère haute" width="571" height="826" loading="lazy">
				<div class="featured__body">
					<span class="verified">✓ Avis client vérifié</span>
					<div class="review__stars" style="margin:8px 0 0">★★★★★</div>
					<blockquote>«&nbsp;Très satisfaite.&nbsp;»</blockquote>
					<div class="featured__src">
						<img src="<?php echo esc_url( $hd_img . 'avis-soulayma-avatar.webp' ); ?>" alt="" width="88" height="88" loading="lazy">
						<div><b>Soulayma B.</b><span>Cliente HomeDesk · commentaire TikTok avec photo de son installation</span></div>
					</div>
					<p class="featured__note">Photo réelle, prise par la cliente chez elle, sans retouche.</p>
				</div>
			</figure>

			<!-- TÉMOIGNAGES FICTIFS (maquette) — à remplacer par de vrais avis clients avant diffusion en pub -->
			<div class="reviews">
				<figure class="review reveal" data-temoignage="fictif">
					<div class="review__stars">★★★★★</div>
					<blockquote>« Je l'ai posé sur mon bureau habituel, monté en quelques secondes. Maintenant je peux basculer d'une position à une autre. »</blockquote>
					<figcaption class="review__who"><span class="avatar">YK</span><div><b>Yassine K.</b><span>Développeur · Tunis</span></div></figcaption>
				</figure>
				<figure class="review reveal" data-temoignage="fictif">
					<div class="review__stars">★★★★★</div>
					<blockquote>« J'avais peur que ça bouge quand je tape. Au final c'est stable, et l'écran est enfin à la bonne hauteur. Je l'emporte même au coworking dans son sac. »</blockquote>
					<figcaption class="review__who"><span class="avatar">MS</span><div><b>Mariem S.</b><span>Freelance · Sousse</span></div></figcaption>
				</figure>
				<figure class="review reveal" data-temoignage="fictif">
					<div class="review__stars">★★★★★</div>
					<blockquote>« Au début, j'ai voulu le testé pendant 3 jours. J'ai fini maintenant par le garder : alterner assis et debout est devenu un réflexe pour moi. »</blockquote>
					<figcaption class="review__who"><span class="avatar">AB</span><div><b>Amine B.</b><span>Télétravailleur · Sfax</span></div></figcaption>
				</figure>
			</div>

			<div class="ugc" aria-label="Photos de clients HomeDesk">
				<?php
				$hd_ugc = array(
					'Cliente HomeDesk avec un café, en position debout',
					'Cliente HomeDesk travaillant debout',
					'Client HomeDesk installé à son bureau',
					'Client HomeDesk à son poste de travail',
					'Client HomeDesk au travail',
					'Cliente HomeDesk au travail',
					'Client HomeDesk debout devant son ordinateur',
					'Client HomeDesk en position debout',
				);
				foreach ( $hd_ugc as $hd_i => $hd_alt ) :
					?>
					<img src="<?php echo esc_url( $hd_img . 'client-' . ( $hd_i + 1 ) . '.webp' ); ?>" alt="<?php echo esc_attr( $hd_alt ); ?>" width="480" height="853" loading="lazy">
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- OBJECTION PRINCIPALE : stabilité + fiche technique -->
	<section class="section section--alt">
		<div class="container solid">
			<div class="solid__pics reveal">
				<img src="<?php echo esc_url( $hd_img . 'gal-2.webp' ); ?>" alt="Femme qui tape au clavier debout devant son HomeDesk, PC portable posé sur l'étagère haute" width="500" height="500" loading="lazy">
				<img src="<?php echo esc_url( $hd_img . 'detail-angle.webp' ); ?>" alt="Détail des encoches de réglage du HomeDesk" width="500" height="500" loading="lazy">
				<img src="<?php echo esc_url( $hd_img . 'detail-clavier.webp' ); ?>" alt="Clavier posé sur l'étagère du HomeDesk" width="500" height="500" loading="lazy">
			</div>
			<div class="reveal">
				<span class="eyebrow">La question qu'on nous pose le plus</span>
				<h2 class="h2">«&nbsp;Ça reste stable quand je tape&nbsp;?&nbsp;»</h2>
				<p class="lead">Oui. Votre écran reste en place pendant que vous tapez, assis comme debout. HomeDesk n'a rien d'un support pliant qui tangue : c'est une structure en bois qui pose bien à plat sur votre bureau.</p>
				<ul class="facts">
					<li><span><strong>Une étagère séparée pour le clavier</strong> et la souris : vous tapez en bas, l'écran reste immobile en haut.</span></li>
					<li><span><strong>Des pièces de 18 mm qui s'emboîtent au millimètre</strong>, découpées à la CNC pour un assemblage bien ajusté.</span></li>
					<li><span><strong>Une base large et un vrai poids</strong> : 36 × 22 cm et 5 kg (Medium), 45 × 34 cm et 7 kg (Large).</span></li>
				</ul>
				<img class="solid__plan" src="<?php echo esc_url( $hd_img . 'hero-6.webp' ); ?>" alt="Dimensions des HomeDesk Large et Medium : base 45 et 36 cm, étagère clavier 54 cm, étagère haute 40 × 27 cm" width="1024" height="1024" loading="lazy">
				<table class="specs">
					<thead><tr><th scope="col">Fiche technique</th><th scope="col">Medium</th><th scope="col">Large</th></tr></thead>
					<tbody>
						<tr><th scope="row">Pour une taille</th><td>jusqu'à 1,87 m</td><td>plus de 1,87 m</td></tr>
						<tr><th scope="row">Hauteur</th><td>55 cm</td><td>68 cm</td></tr>
						<tr><th scope="row">Base (L × P)</th><td>36 × 22 cm</td><td>45 × 34 cm</td></tr>
						<tr><th scope="row">Étagère haute</th><td>40 × 27 cm</td><td>40 × 27 cm</td></tr>
						<tr><th scope="row">Étagère clavier</th><td>54 × 22 cm</td><td>54 × 27 cm</td></tr>
						<tr><th scope="row">PC portable</th><td>jusqu'à 17"</td><td>jusqu'à 17"</td></tr>
						<tr><th scope="row">Étagère tél/tablette</th><td>—</td><td>✓</td></tr>
						<tr><th scope="row">Poids du support</th><td>5 kg</td><td>7 kg</td></tr>
					</tbody>
				</table>
				<?php if ( $hd_product ) : ?>
					<p class="spec-link"><a href="<?php echo esc_url( get_permalink( $hd_product->get_id() ) ); ?>">Voir la fiche produit complète →</a></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- CHOISIR SA VERSION -->
	<section class="section" id="versions">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow">Votre version</span>
				<h2 class="h2">Choisissez selon votre taille</h2>
				<p class="lead">La bonne taille garde l'écran à hauteur des yeux quand vous êtes debout.</p>
			</div>
			<div class="size-q reveal"><span>📏 Moins de 1,87 m → <strong>Medium</strong></span><span>📏 Plus de 1,87 m → <strong>Large</strong></span></div>
			<div class="versions">
				<div class="version is-selected reveal" data-pick-taille="medium" data-pick-sac="oui">
					<span class="version__badge">Le plus choisi</span>
					<div class="version__row">
						<img src="<?php echo esc_url( $hd_img . 'taille-medium.webp' ); ?>" alt="HomeDesk version Medium avec ses dimensions" width="700" height="700" loading="lazy">
						<div><h3>Medium + sac offert</h3><p>Jusqu'à 1,87 m · hauteur 55 cm</p><div class="version__price"><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?><s><?php echo $hd_dt( $hd_prices['medium']['regular'] ); ?></s></div></div>
					</div>
					<ul class="version__list"><li>Support HomeDesk Medium</li><li>Sac de transport (valeur 85 DT)</li><li>Porte-clés HomeDesk</li></ul>
				</div>
				<div class="version reveal" data-pick-taille="large" data-pick-sac="oui">
					<div class="version__row">
						<img src="<?php echo esc_url( $hd_img . 'taille-large.webp' ); ?>" alt="HomeDesk version Large avec ses dimensions" width="700" height="700" loading="lazy">
						<div><h3>Large + sac offert</h3><p>Plus de 1,87 m · hauteur 68 cm</p><div class="version__price"><?php echo $hd_dt( $hd_prices['large']['price'] ); ?><s><?php echo $hd_dt( $hd_prices['large']['regular'] ); ?></s></div></div>
					</div>
					<ul class="version__list"><li>Support HomeDesk Large + étagère tél/tablette</li><li>Sac de transport (valeur 85 DT)</li><li>Porte-clés HomeDesk</li></ul>
				</div>
			</div>
			<?php if ( $hd_solo > 0 ) : ?>
				<div class="essentiel reveal">
					<span class="essentiel__sac"><img src="<?php echo esc_url( $hd_img . 'sac-1.webp' ); ?>" alt="Sac de transport HomeDesk, non inclus dans la version Solo" width="600" height="600" loading="lazy"><i aria-hidden="true">✕</i></span>
					<p>
						<b>HomeDesk Solo</b><br>
						Prenez-le <strong>sans sac</strong> et économisez <?php echo $hd_dt( $hd_solo ); ?> : <strong><?php echo $hd_dt( $hd_prices['medium']['price'] - $hd_solo ); ?></strong> (Medium) ou <strong><?php echo $hd_dt( $hd_prices['large']['price'] - $hd_solo ); ?></strong> (Large).<br>
						<a href="#commander" data-pick-sac="non" data-pick-taille="medium">Commander sans sac →</a>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- OFFRE + FORMULAIRE COD (plugin one-page-cod) -->
	<section class="section section--alt" id="commander">
		<div class="container order">
			<div class="order__media">
				<span class="eyebrow">Sans aucun risque</span>
				<h2 class="h2">Commandez maintenant, payez à la réception</h2>
				<img src="<?php echo esc_url( $hd_img . 'femme-assise.webp' ); ?>" alt="Femme travaillant assise, son ordinateur posé sur un HomeDesk" width="900" height="900" loading="lazy">
				<ul class="order__includes">
					<li>Support HomeDesk en MDF stratifié 18 mm</li>
					<li>Sac de transport offert (valeur 85 DT)</li>
					<li>Porte-clés HomeDesk</li>
					<li>Livraison gratuite partout en Tunisie, sous 72h</li>
				</ul>
			</div>

			<div class="form lp-order">
				<?php
				if ( $hd_product ) {
					echo do_shortcode( '[one_page_cod product_id="' . (int) $hd_product->get_id() . '"]' );
				}
				?>
				<ul class="form__reassure">
					<li>💳 Paiement à la livraison · 🚚 Livraison gratuite sous 72h</li>
					<li>↩️ 3 jours pour l'essayer, sinon vous êtes remboursé <?php echo $hd_tip; // phpcs:ignore -- HTML statique ?></li>
				</ul>
			</div>
		</div>
	</section>

	<!-- GARANTIE -->
	<section class="section section--tight">
		<div class="container">
			<div class="guarantee guarantee--pro reveal">
				<div class="seal" aria-hidden="true">
					<svg class="seal__ring" viewBox="0 0 200 200">
						<defs><path id="seal-path" d="M100,100 m-78,0 a78,78 0 1,1 156,0 a78,78 0 1,1 -156,0"/></defs>
						<text><textPath href="#seal-path" textLength="488">SATISFAIT OU REMBOURSÉ · SATISFAIT OU REMBOURSÉ ·</textPath></text>
					</svg>
					<div class="seal__core">
						<svg class="seal__check" viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.3 8 11 4.6-1.7 8-6 8-11V5l-8-3Z"/><path class="seal__tick" d="m8.5 12 2.5 2.5 4.5-5"/></svg>
						<b>3 jours</b><small>d'essai</small>
					</div>
				</div>
				<div>
					<span class="eyebrow">Garantie satisfait ou remboursé</span>
					<h3>Essayez-le chez vous, sans engagement</h3>
					<p>Vous ne payez qu'à la réception, après avoir vu le produit. Ensuite, vous avez 3 jours pour l'essayer dans vos vraies journées de travail. Pas convaincu ? Vous êtes remboursé.</p>
					<ol class="g-steps">
						<li><span>📦</span><div><b>Vous recevez</b> et payez à la livraison</div></li>
						<li><span>🧑‍💻</span><div><b>Vous l'essayez</b> 3 jours chez vous</div></li>
						<li><span>↩️</span><div><b>Pas convaincu ?</b> Vous êtes remboursé</div></li>
					</ol>
					<a class="g-link" href="#faq-remboursement" data-open-faq>Voir les conditions de remboursement →</a>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<section class="section section--alt" id="faq">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow">Vos questions</span>
				<h2 class="h2">Les réponses avant de commander</h2>
			</div>
			<div class="faq">
				<details><summary>Quelle taille choisir ?</summary><p>Medium si vous mesurez jusqu'à 1,87 m (hauteur 55 cm). Large au-delà de 1,87 m (hauteur 68 cm, avec une étagère pour téléphone ou tablette en plus).</p></details>
				<details><summary>Est-ce solide et stable ?</summary><p>HomeDesk est découpé à la CNC dans du MDF stratifié de 18 mm d'épaisseur. Il accueille un PC portable jusqu'à 17 pouces, avec une étagère séparée pour le clavier et la souris.</p></details>
				<details><summary>Est-ce que ça aide contre le mal de dos ?</summary><p>HomeDesk vous permet d'alterner facilement entre assis et debout et de placer l'écran à hauteur des yeux, ce qui aide à réduire l'inconfort lié à la position assise prolongée. Ce n'est pas un dispositif médical : en cas de douleur persistante, consultez un professionnel de santé.</p></details>
				<details id="faq-remboursement"><summary>Et si ça ne me convient pas ?</summary><p>Vous avez 3 jours pour l'essayer chez vous. Si vous n'êtes pas satisfait, vous êtes remboursé.</p><p>Pour être remboursé, retournez le produit complet, avec tous ses accessoires, dans son état d'origine : sans casse, détérioration ni salissure. Après vérification à réception, vous êtes remboursé intégralement sous 7 jours ouvrables.</p></details>
				<details><summary>C'est compliqué à monter ?</summary><p>Non. Les pièces s'assemblent sans outil, en quelques minutes. Ensuite, passer d'assis à debout prend 5 secondes.</p></details>
				<details><summary>Ça prend de la place sur mon bureau ?</summary><p>Peu : la base de la version Medium mesure 36 × 22 cm. Et comme il se démonte, vous pouvez le ranger dans son sac quand vous n'en avez pas besoin.</p></details>
			</div>
		</div>
	</section>

	<!-- CTA FINAL -->
	<section class="section final">
		<div class="container">
			<h2 class="h2">Demain, travaillez debout quand vous le voulez.</h2>
			<p>Gardez votre bureau, ajoutez la position debout, et changez de posture en 5 secondes. Vous ne payez qu'à la réception.</p>
			<div class="cta-wrap">
				<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
				<p class="cta-note">À partir de <?php echo $hd_dt( $hd_from ); ?> · Livraison gratuite · 3 jours pour essayer</p>
			</div>
		</div>
	</section>
</main>

<footer class="footer">
	<div class="container">
		<?php
		$hd_links = array();
		foreach ( homedesk_footer_links() as $hd_link ) {
			$hd_links[] = '<a href="' . esc_url( $hd_link[0] ) . '">' . esc_html( $hd_link[1] ) . '</a>';
		}
		echo implode( ' · ', $hd_links ); // phpcs:ignore -- échappé ci-dessus
		?>
		<p>Copyright © <?php echo esc_html( gmdate( 'Y' ) ); ?> · HomeDesk · Fabriqué en Tunisie</p>
	</div>
</footer>

<div class="sticky-cta" id="sticky-cta">
	<div class="sticky-cta__price">À partir de <b><?php echo $hd_dt( $hd_from ); ?></b></div>
	<a class="btn" href="#commander">Je commande</a>
</div>

<?php wp_footer(); ?>
</body>
</html>
