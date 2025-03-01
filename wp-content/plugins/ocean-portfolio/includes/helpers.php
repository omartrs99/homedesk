<?php
/**
 * Helpers
 */


if ( ! function_exists( 'op_portfolio_taxonomy' ) ) {

	function op_portfolio_taxonomy() {

		$bool = false;
		if ( ! is_search()
			&& ( is_tax( 'ocean_portfolio_category' )
				|| is_tax( 'ocean_portfolio_tag' ) ) ) {
			$bool = true;
		}

		return apply_filters( 'op_portfolio_taxonomy', $bool );

	}
}

/**
 * List terms for specific taxonomy
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'op_portfolio_category_meta' ) ) {

	function op_portfolio_category_meta() {

		// Category taxonomy
		$taxonomy = 'ocean_portfolio_category';

		// Make sure taxonomy exists
		if ( ! taxonomy_exists( $taxonomy ) ) {
			return;
		}

		// Vars
		$links = array();
		$terms = wp_get_post_terms( get_the_ID(), $taxonomy );

		// Return if no terms
		if ( ! $terms ) {
			return;
		}

		// Loop through terms
		foreach ( $terms as $term ) {
			$links[] = '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" class="op-link" title="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</a>';
		}

		// Turn into comma seperated string
		if ( $links && is_array( $links ) ) {
			$links = implode( '<span class="owp-sep">,</span> ', $links );
		} else {
			return;
		}

		// Apply filter
		$links = apply_filters( 'op_portfolio_category_meta', $links, $taxonomy );

		// Return
		return $links;

	}
}

/**
 * Returns portfolio single elements for the customizer
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'op_portfolio_single_elements' ) ) {

	function op_portfolio_single_elements() {

		// Default elements
		$elements = apply_filters(
			'op_portfolio_single_elements',
			array(
				'featured_image'    => esc_html__( 'Featured Image', 'ocean-portfolio' ),
				'title'             => esc_html__( 'Title', 'ocean-portfolio' ),
				'meta'              => esc_html__( 'Meta', 'ocean-portfolio' ),
				'content'           => esc_html__( 'Content', 'ocean-portfolio' ),
				'tags'              => esc_html__( 'Tags', 'ocean-portfolio' ),
				'social_share'      => esc_html__( 'Social Share', 'ocean-portfolio' ),
				'next_prev'         => esc_html__( 'Next/Prev Links', 'ocean-portfolio' ),
				'related_portfolio' => esc_html__( 'Related Portfolio', 'ocean-portfolio' ),
				'single_comments'   => esc_html__( 'Comments', 'ocean-portfolio' ),
			)
		);

		// Return elements
		return $elements;

	}
}

/**
 * Returns portfolio single elements positioning
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'op_portfolio_single_elements_positioning' ) ) {

	function op_portfolio_single_elements_positioning() {

		// Default sections
		$sections = array( 'featured_image', 'title', 'meta', 'content', 'tags', 'social_share', 'next_prev', 'related_portfolio', 'single_comments' );

		// Get sections from Customizer
		$sections = get_theme_mod( 'op_portfolio_single_elements_positioning', $sections );

		// Turn into array if string
		if ( $sections && ! is_array( $sections ) ) {
			$sections = explode( ',', $sections );
		}

		// Apply filters for easy modification
		$sections = apply_filters( 'op_portfolio_single_elements_positioning', $sections );

		// Return sections
		return $sections;

	}
}

/**
 * Returns portfolio single meta
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'op_portfolio_single_meta' ) ) {

	function op_portfolio_single_meta() {

		// Default sections
		$sections = array( 'author', 'date', 'categories', 'comments' );

		// Get sections from Customizer
		$sections = get_theme_mod( 'op_portfolio_single_meta', $sections );

		// Turn into array if string
		if ( $sections && ! is_array( $sections ) ) {
			$sections = explode( ',', $sections );
		}

		// Apply filters for easy modification
		$sections = apply_filters( 'op_portfolio_single_meta', $sections );

		// Return sections
		return $sections;

	}
}

/**
 * Return the correct icon
 *
 * @param string  $icon        Icon class.
 * @param bool    $echo        Print string.
 * @param string  $class       Icon class.
 * @param string  $title       Optional SVG title.
 * @param string  $desc        Optional SVG description.
 * @param string  $aria_hidden Optional SVG description.
 * @param boolean $fallback    Fallback icon.
 *
 * @return string OceanWP Icon.
 */
function op_svg_icon( $icon, $echo = true, $class = '', $title = '', $desc = '', $aria_hidden = true, $fallback = false ) {

	// Get icon class.
	$theme_icons = oceanwp_theme_icons();

	if ( function_exists( 'oceanwp_icon' ) ) {
		return oceanwp_icon( $icon, $echo, $class, $title, $desc, $aria_hidden, $fallback );
	} else {

		if ( true === $echo ) {
			echo '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
		} else {
			return '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
		}

		return;

	}
}

/**
 * Numbered Pagination
 *
 * @since   1.0.0
 * @link    https://codex.wordpress.org/Function_Reference/paginate_links
 */
if ( ! function_exists( 'op_portfolio_pagination' ) ) {

	function op_portfolio_pagination( $max_num_pages, $align = 'center', $echo = true ) {

		// Don't run if there's only one page
		if ( $max_num_pages < 2 ) {
			return;
		}

		// Arrows with RTL support
		$prev_arrow = is_rtl() ? op_svg_icon( 'angle_right', false ) : op_svg_icon( 'angle_left', false );
		$next_arrow = is_rtl() ? op_svg_icon( 'angle_left', false ) : op_svg_icon( 'angle_right', false );

		// Set vars
		$big = 999999999;

		// Get current page
		$paged_query = is_front_page() ? 'page' : 'paged';
		$paged       = get_query_var( $paged_query ) ? intval( get_query_var( $paged_query ) ) : 1;

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = apply_filters(
			'ocean_pagination_args',
			array(
				'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
				'format'    => $format,
				'current'   => max( 1, $paged ),
				'total'     => $max_num_pages,
				'mid_size'  => 3,
				'type'      => 'list',
				'prev_text' => $prev_arrow,
				'next_text' => $next_arrow,
			)
		);

		$html = '<div class="oceanwp-pagination clr oceanwp-' . esc_attr( $align ) . '" data-total-pages="' . esc_attr( $max_num_pages ) . '">' . paginate_links( $args ) . '</div>';

		// Output pagination
		if ( true === $echo ) {
			echo $html;
		} else {
			return $html;
		}


	}
}

/**
 * Settings helpers
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'op_portfolio_helpers' ) ) {

	function op_portfolio_helpers( $return = null ) {

		// Return registered image sizes
		if ( 'img_sizes' == $return ) {
			global $_wp_additional_image_sizes;

			$sizes                        = array();
			$get_intermediate_image_sizes = get_intermediate_image_sizes();

			// Create the full array with sizes and crop info
			foreach ( $get_intermediate_image_sizes as $_size ) {
				if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
					$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
					$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
					$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
				} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
					$sizes[ $_size ] = array(
						'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
						'height' => $_wp_additional_image_sizes[ $_size ]['height'],
						'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
					);
				}
			}

			$image_sizes = array();

			foreach ( $sizes as $size_key => $size_attributes ) {
				$image_sizes[ $size_key ] = ucwords( str_replace( '_', ' ', $size_key ) ) . sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
			}

			$image_sizes['full']   = _x( 'Full', 'Image Size Control', 'ocean-portfolio' );
			$image_sizes['custom'] = _x( 'Custom', 'Image Size Control', 'ocean-portfolio' );

			return $image_sizes;

		}

		// Return authors array
		elseif ( 'authors' == $return ) {
			$args = array(
				'has_published_posts' => true,
				'fields'              => array(
					'ID',
					'display_name',
				),
			);

			// Capability queries were only introduced in WP 5.9.
			if ( version_compare( $GLOBALS['wp_version'], '5.9', '<' ) ) {
				$args['who'] = 'authors';
			} else {
				$args['capability'] = array( 'edit_posts' );
			}

			$user_query = new WP_User_Query( $args );

			$authors = array();

			foreach ( $user_query->get_results() as $result ) {
				$authors[ $result->ID ] = $result->display_name;
			}

			return $authors;
		}

		// Return categories ids array
		elseif ( 'category_ids' == $return ) {
			$terms = get_terms(
				array(
					'taxonomy'   => 'ocean_portfolio_category',
					'hide_empty' => false,
				)
			);

			$categories = array();

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$categories[ $term->slug ] = $term->name;
				}
			}

			return $categories;
		}

		// Return tags ids array
		elseif ( 'tags' == $return ) {
			$terms = get_terms(
				array(
					'taxonomy'   => 'ocean_portfolio_tag',
					'hide_empty' => false,
				)
			);

			$tags = array();

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$tags[ $term->slug ] = $term->name;
				}
			}

			return $tags;
		}

	}
}

/**
 * Portfolio Meta Separator
 *
 * @since 2.0
 */
if ( ! function_exists( 'oceanwp_portfolio_meta_separator' ) ) {

	function oceanwp_portfolio_meta_separator() {

		$sep = get_theme_mod( 'ocean_portfolio_single_meta_separator', 'default' );

		return $sep;
	}
}

/**
 * Entry template
 */
function op_entry_template( $has_post_id, $id = '', $classes = '', $echo = true, $shortcode = false ) {

	$shortcode_slug = '';
	if ( true === $shortcode ) {
		$shortcode_slug = '-shortcode';
	}

	$html = '';

	$html .= '<figure id="post-' . esc_attr( $has_post_id ) . '" class="' . esc_attr( $classes ) . '" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';

	$theme_file = get_stylesheet_directory() . '/templates/entry-portfolio' . $shortcode_slug . '.php';

	/**
	* Checks if the file exists in the theme first
	* Otherwise serve the file from the plugin
	*/
	$template_path = '';
	if ( file_exists( $theme_file ) ) {
		$template_path = $theme_file;
	} else {
		$template_path = OP_PATH . '/templates/entry-portfolio' . $shortcode_slug . '.php';
	}

	ob_start();
	set_query_var( 'sh_id', $id );
	$entry = load_template( $template_path, false );
	$entry = ob_get_clean();

	$html .= $entry;

	$html .= '</figure>';

	// Output posts.
	if ( true === $echo ) {
		echo $html;
	} else {
		return $html;
	}

}

/**
 * Returns post media
 */
function op_get_post_media( $post_id = '' ) {

	// Define video variable
	$video = '';

	// Get correct ID
	$post_id = $post_id ? $post_id : get_the_ID();

	// Embed
	if ( $meta = get_post_meta( $post_id, 'op_portfolio_post_video_embed', true ) ) {
		$video = $meta;
	}

	// Check for self-hosted first
	elseif ( $meta = get_post_meta( $post_id, 'op_portfolio_post_self_hosted_media', true ) ) {
		$video = $meta;
	}

	// Check for post oembed
	elseif ( $meta = get_post_meta( $post_id, 'op_portfolio_post_oembed', true ) ) {
		$video = $meta;
	}

	// Apply filters for child theming
	$video = apply_filters( 'op_get_post_media', $video );

	// Return data
	return $video;

}

/**
 * Returns post video HTML
 */
function op_get_post_video_html( $video = '' ) {

	// Get video
	$video = $video ? $video : op_get_post_media();

	// Return if video is empty
	if ( empty( $video ) ) {
		return;
	}

	// Get oembed code and return
	if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
		return '<div class="responsive-video-wrap">' . $oembed . '</div>';
	}

	// Display using apply_filters if it's self-hosted
	else {

		$video = apply_filters( 'the_content', $video );

		// Add responsive video wrap for youtube/vimeo embeds
		if ( strpos( $video, 'youtube' ) || strpos( $video, 'vimeo' ) ) {
			return '<div class="responsive-video-wrap">' . $video . '</div>';
		}

		// Else return without responsive wrap
		else {
			return $video;
		}
	}

}
