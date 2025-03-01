<?php
// class-taxonomy-layout-handler.php
class Ocean_Taxonomy_Layout_Handler {

	public function __construct() {
		add_filter( 'ocean_post_layout_class', array( $this, 'apply_layout_class' ), 20 );
		add_filter( 'ocean_blog_wrap_classes', array( $this, 'apply_wrap_classes' ), 20 );
		add_filter( 'ocean_blog_entry_classes', array( $this, 'apply_entry_classes' ), 20 );
		add_filter( 'ocean_blog_entry_columns', array( $this, 'apply_archive_entry_columns' ), 20 );
	}

	/**
	 * Apply layout class for taxonomy archives.
	 *
	 * @param string $class The current layout class.
	 * @return string The modified layout class.
	 */
	public function apply_layout_class( $class ) {
		if ( is_tax() ) {
			$taxonomy         = get_query_var( 'taxonomy' );
			$saved_taxonomies = get_option( 'custom_taxonomy_manager_options', array() );

			if ( isset( $saved_taxonomies[ $taxonomy ] ) ) {
				$layout = $saved_taxonomies[ $taxonomy ]['archive_layout'] ?? 'full-width';
				$class  = $layout;
			}
		}

		return $class;
	}

	/**
	 * Apply wrap classes for taxonomy archives.
	 *
	 * @param array $classes The current wrap classes.
	 * @return array The modified wrap classes.
	 */
	public function apply_wrap_classes( $classes ) {
		if ( is_tax() ) {
			$taxonomy         = get_query_var( 'taxonomy' );
			$saved_taxonomies = get_option( 'custom_taxonomy_manager_options', array() );

			if ( isset( $saved_taxonomies[ $taxonomy ] ) ) {
				$style = $saved_taxonomies[ $taxonomy ]['archive_style'] ?? 'large-entry';

				// Admin defaults.
				$classes = array( 'entries', 'clr' );

				// Isotope classes.
				if ( $style == 'grid-entry' ) {
					$classes[] = 'oceanwp-row';
					if ( 'masonry' == oceanwp_blog_grid_style() ) {
						$classes[] = 'blog-masonry-grid';
					} else {
						$classes[] = 'blog-grid';
					}
				}

				// Equal heights.
				if ( oceanwp_blog_entry_equal_heights() ) {
					$classes[] = 'blog-equal-heights';
				}

				// Infinite scroll class.
				if ( 'infinite_scroll' == oceanwp_blog_pagination_style() ) {
					$classes[] = 'infinite-scroll-wrap';
				}

				// Turn classes into space separated string.
				if ( is_array( $classes ) ) {
					$classes = implode( ' ', $classes );
				}
			}
		}

		return $classes;
	}

	/**
	 * Apply entry classes for taxonomy archives.
	 *
	 * @param array $classes The current entry classes.
	 * @return array The modified entry classes.
	 */
	public function apply_entry_classes( $classes ) {
		if ( is_tax() ) {
			$taxonomy         = get_query_var( 'taxonomy' );
			$saved_taxonomies = get_option( 'custom_taxonomy_manager_options', array() );

			if ( isset( $saved_taxonomies[ $taxonomy ] ) ) {
				$style = $saved_taxonomies[ $taxonomy ]['archive_style'] ?? 'large-entry';
				// Define classes array.
				$classes = array();

				// Entry Style.
				$entry_style = $style;

				// Core classes.
				$classes[] = 'blog-entry';
				$classes[] = 'clr';

				// Masonry classes.
				if ( 'masonry' == oceanwp_blog_grid_style() ) {
					$classes[] = 'isotope-entry';
				}

				// Add columns for grid style entries.
				if ( $entry_style == 'grid-entry' ) {
					$classes[] = 'col';
					$classes[] = oceanwp_grid_class( oceanwp_blog_entry_columns() );

					// Counter
					global $oceanwp_count;
					if ( $oceanwp_count ) {
						$classes[] = 'col-' . $oceanwp_count;
					}
				}

				// No Featured Image Class, don't add if oembed or self hosted meta are defined.
				if ( ! has_post_thumbnail()
					&& '' == get_post_meta( get_the_ID(), 'ocean_post_self_hosted_shortcode', true )
					&& '' == get_post_meta( get_the_ID(), 'ocean_post_oembed', true ) ) {
					$classes[] = 'no-featured-image';
				}

				// Infinite scroll class.
				if ( 'infinite_scroll' == oceanwp_blog_pagination_style() ) {
					$classes[] = 'item-entry';
				}

				// Blog entry style.
				$classes[] = $entry_style;
			}
		}

		return $classes;
	}

	/**
	 * Apply the number of columns for taxonomy archives.
	 *
	 * @param int $columns The current number of columns.
	 * @return int The modified number of columns.
	 */
	public function apply_archive_entry_columns( $columns ) {
		if ( is_tax() ) {
			$taxonomy         = get_query_var( 'taxonomy' );
			$saved_taxonomies = get_option( 'custom_taxonomy_manager_options', array() );

			if ( isset( $saved_taxonomies[ $taxonomy ] ) ) {
				$columns = $saved_taxonomies[ $taxonomy ]['archive_columns'] ?? $columns;
			}
		}

		return $columns;
	}
}

new Ocean_Taxonomy_Layout_Handler();
