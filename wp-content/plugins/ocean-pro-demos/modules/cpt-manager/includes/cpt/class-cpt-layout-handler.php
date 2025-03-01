<?php
// class-cpt-layout-handler.php
class Ocean_CPT_Layout_Handler {

	/**
	 * Constructor for the Ocean_CPT_Layout_Handler class.
	 */
	public function __construct() {
		add_filter( 'ocean_post_layout_class', array( $this, 'apply_layout_class' ), 20 );

		add_filter( 'ocean_blog_wrap_classes', array( $this, 'apply_wrap_classes' ), 20 );
		add_filter( 'body_class', array( $this, 'apply_cpt_archive_layout' ), 20 );
		add_filter( 'body_class', array( $this, 'apply_cpt_type' ), 20 );

		add_filter( 'ocean_blog_entry_classes', array( $this, 'apply_entry_classes' ), 20 );
		add_filter( 'ocean_blog_entry_columns', array( $this, 'apply_archive_entry_columns' ), 20 );

		add_filter( 'oceanwp_single_post_header_template', array( $this, 'single_post_header_template' ), 25 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_filter( 'oceanwp_single_post_header_allowed_post_types', array( $this, 'add_custom_post_types' ) );
		add_action( 'template_redirect', array( $this, 'conditionally_remove_original_header' ) );
		add_filter( 'ocean_blog_post_related_query_args', array( $this, 'modify_related_posts_query_args' ), 10, 1 );
		add_filter( 'ocean_get_sidebar', array( $this, 'custom_sidebar_display' ), 20 );
	}

	/**
	 * Apply layout class for custom post types.
	 *
	 * @param string $class The current layout class.
	 * @return string The modified layout class.
	 */
	public function apply_layout_class( $class ) {
		if ( is_singular() && ! is_singular( 'post' ) ) {
			$cpt        = get_post_type();
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$layout = $saved_cpts[ $cpt ]['archive_layout'] ?? 'full-width';
				$class  = $layout;
			}
		}

		return $class;
	}

	/**
	 * Adds the 'ocean-cpt' CSS class to the body classes array for custom post types.
	 *
	 * This method checks if the current page is a singular view of a custom post type
	 * (excluding the default 'post' type). If so, and if the post type exists in the
	 * saved custom post types options, it appends 'ocean-cpt' to the array of body classes.
	 *
	 * @param array $classes The existing array of body classes.
	 * @return array The modified array of body classes with 'ocean-cpt' added if applicable.
	 */
	public function apply_cpt_type( $classes ) {
		if ( is_singular() && ! is_singular( 'post' ) ) {
			$cpt        = get_post_type();
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$classes[]  = 'ocean-cpt';
			}
		}

		return $classes;
	}

	/**
	 * Apply archive styles for custom post types.
	 */
	public function apply_archive_styles() {
		if ( is_post_type_archive() ) {
			$cpt        = get_query_var( 'post_type' );
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$archive_style   = $saved_cpts[ $cpt ]['archive_style'] ?? 'grid-entry';
				$archive_columns = $saved_cpts[ $cpt ]['archive_columns'] ?? 3;

				// Apply these settings to the layout, such as adding classes or styles.
				echo '<style>
                    .archive-' . esc_attr( $cpt ) . ' .entry {
                        display: ' . ( 'grid-entry' === $archive_style ? 'grid' : 'block' ) . ';
                        grid-template-columns: repeat(' . esc_attr( $archive_columns ) . ', 1fr);
                    }
                </style>';
			}
		}
	}

	/**
	 * Adds layout-specific CSS classes to the body classes array for custom post type archives.
	 *
	 * This method checks if the current page is a post type archive and modifies the body classes
	 * array based on the 'main_archive_layout' setting for the custom post type from the saved options.
	 * It appends appropriate classes to control the layout (e.g., full-width, left-sidebar, etc.)
	 * according to the user's selection in the CPT settings.
	 *
	 * @param array $classes The existing array of body classes.
	 * @return array The modified array of body classes with layout-specific classes added for CPT archives.
	 */	
	public function apply_cpt_archive_layout( $classes ) {
		if ( is_post_type_archive() ) {
			$cpt        = get_query_var( 'post_type' );
			$saved_cpts = get_option( 'cpt_manager_options', array() );
	
			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$layout = $saved_cpts[ $cpt ]['main_archive_layout'] ?? 'left-sidebar';
	
				switch ( $layout ) {
					case 'full-width':
						$classes[] = 'content-full-width';
						$classes[] = 'ocean-cpt';
						break;
					case 'left-sidebar':
						$classes[] = 'has-sidebar';
						$classes[] = 'content-left-sidebar';
						$classes[] = 'ocean-cpt';
						break;
					case 'right-sidebar':
						$classes[] = 'has-sidebar';
						$classes[] = 'content-right-sidebar';
						$classes[] = 'ocean-cpt';
						break;
					case 'both-sidebars':
						$classes[] = 'has-sidebar';
						$classes[] = 'content-both-sidebars';
						$classes[] = 'scs-style';
						$classes[] = 'ocean-cpt';
						break;
					case 'full-screen':
						$classes[] = 'content-full-screen';
						$classes[] = 'ocean-cpt';
						break;
					default:
						$classes[] = 'right-sidebar';
						$classes[] = 'ocean-cpt';
				}
			}
		}
		return $classes;
	}

	
	/**
	 * Apply wrap classes for custom post types archives.
	 *
	 * @param array $classes The current wrap classes.
	 * @return array The modified wrap classes.
	 */
	public function apply_wrap_classes( $classes ) {
		if ( is_post_type_archive() ) {
			$cpt        = get_query_var( 'post_type' );
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$style = $saved_cpts[ $cpt ]['archive_style'] ?? 'large-entry';

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
	 * Apply entry classes for custom post types archives.
	 *
	 * @param array $classes The current entry classes.
	 * @return array The modified entry classes.
	 */
	public function apply_entry_classes( $classes ) {
		if ( is_post_type_archive() ) {
			$cpt        = get_query_var( 'post_type' );
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$style = $saved_cpts[ $cpt ]['archive_style'] ?? 'large-entry';
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
	 * Apply the number of columns for custom post types archives.
	 *
	 * @param int $columns The current number of columns.
	 * @return int The modified number of columns.
	 */
	public function apply_archive_entry_columns( $columns ) {
		if ( is_post_type_archive() ) {
			$cpt        = get_query_var( 'post_type' );
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$columns = $saved_cpts[ $cpt ]['archive_columns'] ?? $columns;
			}
		}

		return $columns;
	}

	/**
	 * Customize the sidebar display for custom post types.
	 *
	 * @param string $sidebar The current sidebar ID.
	 * @return string The modified sidebar ID.
	 */
	public function custom_sidebar_display( $sidebar ) {
		if ( is_singular() && ! is_singular( 'post' ) ) {
			$cpt        = get_post_type();
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				if ( $saved_cpts[ $cpt ]['sidebar'] ?? false ) {
					return 'my_custom_sidebar_id';
				}
			}
		}
		return $sidebar;
	}

	/**
	 * Get the template for the single post header for custom post types.
	 *
	 * @param string $template The current template.
	 * @return string The modified template.
	 */
	public function single_post_header_template( $template ) {
		if ( is_singular() && ! is_singular( 'post' ) ) {
			$cpt        = get_post_type();
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			if ( isset( $saved_cpts[ $cpt ] ) ) {
				$template_style = $saved_cpts[ $cpt ]['single_post_header_style'] ?? 'default';
				$template_path  = '';

				if ( 'default' === $template_style ) {
					$template_path = 'partials/page-header';
				} elseif ( 'sph_style_2' === $template_style ) {
					$template_path = 'partials/single/headers/header-2';
				} elseif ( 'sph_style_3' === $template_style ) {
					$template_path = 'partials/single/headers/header-3';
				} elseif ( 'sph_style_4' === $template_style ) {
					$template_path = 'partials/single/headers/header-4';
				} elseif ( 'sph_style_5' === $template_style ) {
					$template_path = 'partials/single/headers/header-5';
				} elseif ( 'sph_style_6' === $template_style ) {
					$template_path = 'partials/single/headers/header-6';
				} elseif ( 'sph_style_7' === $template_style ) {
					$template_path = 'partials/single/headers/header-7';
				}

				return $template_path;
			}
		}
		return $template;
	}

	/**
	 * Display the custom page header template for custom post types.
	 */
	public function custom_oceanwp_page_header_template() {
		$post_type         = get_post_type();
		$custom_post_types = $this->get_custom_post_types();

		if ( is_singular() && in_array( $post_type, $custom_post_types ) ) {
			// Custom post types: use custom header
			$template = $this->single_post_header_template( '' );
			if ( $template ) {
				get_template_part( $template );
			}
		}
	}

	/**
	 * Get the custom post types from options.
	 *
	 * @return array The list of custom post types.
	 */
	private function get_custom_post_types() {
		$saved_cpts        = get_option( 'cpt_manager_options', array() );
		$custom_post_types = array();

		foreach ( $saved_cpts as $cpt => $options ) {
			if ( isset( $options['post_type_slug'] ) ) {
				$custom_post_types[] = $options['post_type_slug'];
			}
		}

		return $custom_post_types;
	}

	/**
	 * Enqueue styles for custom post types.
	 */
	public function enqueue_styles() {
		$dir           = OCEANWP_CSS_DIR_URI;
		$theme_version = OCEANWP_THEME_VERSION;
		wp_enqueue_style( 'oceanwp-blog-headers', $dir . 'blog/blog-post-headers.css', false, $theme_version );
	}

	/**
	 * Add custom post types to the allowed single post header types.
	 *
	 * @param array $post_types The current post types.
	 * @return array The modified post types.
	 */
	public function add_custom_post_types( $post_types ) {
		$saved_cpts = get_option( 'cpt_manager_options', array() );
		foreach ( $saved_cpts as $cpt => $options ) {
			if ( isset( $options['post_type_slug'] ) ) {
				$post_types[] = $options['post_type_slug'];
			}
		}
		return $post_types;
	}

	/**
	 * Modify the related posts query arguments for custom post types.
	 *
	 * @param array $args The current query arguments.
	 * @return array The modified query arguments.
	 */
	public function modify_related_posts_query_args( $args ) {
		if ( is_singular() && ! is_singular( 'post' ) ) {
			$post_type  = get_post_type();
			$saved_cpts = get_option( 'cpt_manager_options', array() );

			// Check if related posts are enabled for this CPT
			if ( isset( $saved_cpts[ $post_type ]['enable_related_posts'] ) && ! $saved_cpts[ $post_type ]['enable_related_posts'] ) {
				return; // Exit early if related posts are disabled
			}

			// Get all taxonomies for the current post type.
			$taxonomies = get_object_taxonomies( $post_type );

			if ( empty( $taxonomies ) ) {
				return $args; // Exit early if no taxonomies found.
			}

			// Use the first taxonomy in the list
			$taxonomy = $taxonomies[0];

			// Check if terms exist for the selected taxonomy.
			$terms = wp_get_post_terms( get_the_ID(), $taxonomy );
			if ( empty( $terms ) ) {
				return $args; // Exit early if no terms found.
			}

			$terms_ids = array();
			foreach ( $terms as $term ) {
				$terms_ids[] = $term->term_id;
			}

			// Adjust query arguments for custom post type.
			$args['post_type'] = $post_type;
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $terms_ids,
				),
			);

			// Remove category__in to prevent it from conflicting.
			unset( $args['category__in'] );

		}

		return $args;
	}

	/**
	 * Conditionally remove the original header and add a custom header for custom post types.
	 */
	public function conditionally_remove_original_header() {
		$post_type         = get_post_type();
		$custom_post_types = $this->get_custom_post_types();

		if ( is_singular() && in_array( $post_type, $custom_post_types ) ) {
			remove_action( 'ocean_page_header', 'oceanwp_page_header_template' );
			add_action( 'ocean_page_header', array( $this, 'custom_oceanwp_page_header_template' ) );
		}
	}
}

new Ocean_CPT_Layout_Handler();
