<?php
/**
 * Template Name: Landing produit HomeDesk
 *
 * Landing de vente (accueil + landings Meta Ads /lp/{audience}/).
 * Design : product-page/product-page.html et product-page/lp-{audience}.html.
 * Contenu propre à chaque audience :
 *  - hero : templates/landing/{audience}.php (surcharge de landing/generale.php) ;
 *  - sections : templates/landing/{audience}/{section}.php remplace landing/sections/{section}.php.
 * Le formulaire est celui du plugin one-page-cod. Réglages : boîte « Landing HomeDesk » de la page.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$hd_lp       = homedesk_landing_settings();
$hd_product  = wc_get_product( $hd_lp['product_id'] );
$hd_img      = get_template_directory_uri() . '/assets/landing/img/';
$hd_video    = get_template_directory_uri() . '/assets/landing/video/';

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

// Contenu : page générale + surcharges de l'audience (les fichiers d'audience peuvent utiliser les prix ci-dessus)
$hd_content = include __DIR__ . '/landing/generale.php';
if ( 'generale' !== $hd_lp['audience'] && file_exists( __DIR__ . '/landing/' . $hd_lp['audience'] . '.php' ) ) {
	$hd_content = array_merge( $hd_content, include __DIR__ . '/landing/' . $hd_lp['audience'] . '.php' );
}
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
	<?php if ( ! empty( $hd_content['fonts'] ) ) : // polices propres à l'audience ?>
		<link rel="stylesheet" href="<?php echo esc_url( $hd_content['fonts'] ); ?>">
	<?php endif; ?>
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
	<?php
	foreach ( array( 'hero', 'reassurance', 'probleme', 'solution', 'benefices', 'avant-apres', 'avis', 'objection', 'versions', 'commander', 'garantie', 'faq', 'final' ) as $hd_section ) {
		include homedesk_landing_section( $hd_lp['audience'], $hd_section );
	}
	?>
</main>

<footer class="footer">
	<div class="container">
		<?php
		$hd_links = array();
		foreach ( homedesk_footer_links() as $hd_link ) {
			$hd_links[] = '<a href="' . esc_url( $hd_link[0] ) . '">' . esc_html( $hd_link[1] ) . '</a>';
		}
		echo implode( ' · ', $hd_links ); // phpcs:ignore -- échappé ci-dessus
		homedesk_footer_contact( 'footer' );
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
