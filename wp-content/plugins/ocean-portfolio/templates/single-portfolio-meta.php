<?php
/**
 * Portfolio single meta
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$meta_style = get_theme_mod( 'ocean_portfolio_single_meta_style', 'minimal' );

// Get meta separator class.
$meta_sep = oceanwp_portfolio_meta_separator();

// Get meta sections
$sections = op_portfolio_single_meta();

// Return if sections are empty
if ( empty( $sections ) ) {
	return;
}
?>

<ul class="meta meta-style-<?php echo esc_attr($meta_style ); ?> opms-<?php echo esc_attr( $meta_sep ); ?> clr">

	<?php
	// Loop through meta sections
	foreach ( $sections as $section ) { ?>

		<?php if ( 'minimal' === $meta_style ) : ?>

			<?php if ( 'author' == $section ) { ?>
				<li class="meta-author"<?php oceanwp_schema_markup( 'author_name' ); ?>><?php echo the_author_posts_link(); ?></li>
			<?php } ?>

			<?php if ( 'date' == $section ) { ?>
				<li class="meta-date"<?php oceanwp_schema_markup( 'publish_date' ); ?>><?php echo get_the_date(); ?></li>
			<?php } ?>

			<?php if ( 'categories' == $section ) { ?>
				<?php if ( $categories = op_portfolio_category_meta() ) {?>
					<li class="meta-cat"><?php echo $categories; ?></li>
				<?php } ?>
			<?php } ?>

			<?php if ( 'comments' == $section && comments_open() && ! post_password_required() ) { ?>
				<li class="meta-comments"><?php comments_popup_link( esc_html__( '0 Comments', 'ocean-portfolio' ), esc_html__( '1 Comment',  'ocean-portfolio' ), esc_html__( '% Comments', 'ocean-portfolio' ), 'comments-link' ); ?></li>
			<?php } ?>

		<?php endif; ?>

		<?php if ( 'stylish' === $meta_style ) : ?>

			<?php if ( 'author' == $section ) { ?>
				<li class="meta-author"<?php oceanwp_schema_markup( 'author_name' ); ?>><?php op_svg_icon( 'user' ); ?><?php echo the_author_posts_link(); ?></li>
			<?php } ?>

			<?php if ( 'date' == $section ) { ?>
				<li class="meta-date"<?php oceanwp_schema_markup( 'publish_date' ); ?>><?php op_svg_icon( 'date' ); ?><?php echo get_the_date(); ?></li>
			<?php } ?>

			<?php if ( 'categories' == $section ) { ?>
				<?php if ( $categories = op_portfolio_category_meta() ) {?>
					<li class="meta-cat"><?php op_svg_icon( 'category' ); ?><?php echo $categories; ?></li>
				<?php } ?>
			<?php } ?>

			<?php if ( 'comments' == $section && comments_open() && ! post_password_required() ) { ?>
				<li class="meta-comments"><?php op_svg_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'ocean-portfolio' ), esc_html__( '1 Comment',  'ocean-portfolio' ), esc_html__( '% Comments', 'ocean-portfolio' ), 'comments-link' ); ?></li>
			<?php } ?>

		<?php endif; ?>

	<?php } ?>

</ul>


