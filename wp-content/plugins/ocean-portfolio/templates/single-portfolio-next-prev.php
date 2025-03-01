<?php
/**
 * Next/previous links pagionation - navigate to another portfolio based on the same query.
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Navigation icons.
$prev_arrow = is_rtl() ? op_svg_icon( 'long_arrow_alt_right', false ) : op_svg_icon( 'long_arrow_alt_left', false );
$next_arrow = is_rtl() ? op_svg_icon( 'long_arrow_alt_left', false ) : op_svg_icon( 'long_arrow_alt_right', false );

the_post_navigation(
	array(
		'prev_text'             => '<span class="title">' . $prev_arrow . esc_html__( 'Previous Post', 'ocean-portfolio' ) .'</span><span class="post-title">%title</span>',
		'next_text'             => '<span class="title">' . $next_arrow . esc_html__( 'Next Post', 'ocean-portfolio' ) .'</span><span class="post-title">%title</span>',
		'in_same_term'          => true,
		'taxonomy'              => 'ocean_portfolio_tag',
		'screen_reader_text'    => esc_html__( 'Continue Reading', 'ocean-portfolio' ),
	)
);
?>
