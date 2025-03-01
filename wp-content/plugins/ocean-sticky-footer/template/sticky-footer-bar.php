<?php
/**
 * Sticky footer bar
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get icon
$icon_html  = '';
$icon       = get_theme_mod( 'osf_opening_icon' );
$icon_type = oceanwp_theme_icon_class();

if ( 'svg' === $icon_type ) {

	if ( ! empty( $icon ) || null !== $icon ) {
		$icon = $icon ? $icon : 'angle_up';
	} else {
		$icon = 'angle_up';
	}

	$icon_html = Ocean_Sticky_Footer::osf_svg_icon( $icon, false );


} else {

	if ( null !== $icon ) {
		$icon = $icon ? $icon : 'icon-arrow-up';
	} else {
		$icon = 'icon-arrow-up';
	}

	$icon_html = '<span class="' . esc_attr( $icon ) . '"></span>';

}

// Get text
$text = oceanwp_tm_translation( 'osf_text', get_theme_mod( 'osf_text', 'Click the arrow to reveal more amazing content.' ) );

// Get menu location and apply filters for child theming
$menu_location = 'sticky_footer_menu';
$menu_location = apply_filters( 'ocean_sticky_footer_menu_location', $menu_location);

// Responsive
$nav_class 	= '';
$text_class = '';
if ( true == get_theme_mod( 'osf_hide_nav_on_mobile', false ) ) {
	$nav_class 	= ' hide-on-mobile';
}
if ( true == get_theme_mod( 'osf_hide_text_on_mobile', true ) ) {
	$text_class = ' hide-on-mobile';
}

// Add class if has custom opening icon
if ( '' != get_theme_mod( 'osf_opening_icon' ) ) {
	$icon_class = ' custom-icon';
} else {
	$icon_class = ' default-icon';
} ?>

<div id="footer-bar" class="clr">

	<ul class="osf-left navigation clr<?php echo esc_attr( $nav_class ); ?>">
		<li class="osf-btn<?php echo esc_attr( $icon_class ); ?> clr"><a href="#"><?php echo $icon_html ?></span></a></li>

		<?php
		// Display menu if location is defined
		if ( has_nav_menu( $menu_location ) ) :

			// Display menu
			wp_nav_menu( array(
				'theme_location' => $menu_location,
				'sort_column'    => 'menu_order',
				'container'      => false,
				'fallback_cb'    => false,
				'items_wrap'     => '%3$s',
				'walker'         => new OceanWP_Custom_Nav_Walker(),
			) );

		endif; ?>
	</ul>

	<ul class="osf-left osf-text clr<?php echo esc_attr( $text_class ); ?>">
		<li>
			<?php
			// Text
			echo do_shortcode( $text ); ?>
		</li>
	</ul>

	<ul class="osf-right clr">
		<li>
			<?php
			// Scroll up button
			get_template_part( 'partials/scroll-top' ); ?>
		</li>
	</ul>

</div><!-- #footer-bar -->