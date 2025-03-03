 <?php
/**
 * Portfolio archive
 */

// Vars
$posts_per_page 	= get_theme_mod( 'op_portfolio_posts_per_page' );
$posts_per_page 	= $posts_per_page ? $posts_per_page : 12;
$columns 			= get_theme_mod( 'op_portfolio_columns' );
$columns 			= $columns ? $columns : '3';
$tablet_columns 	= get_theme_mod( 'op_portfolio_tablet_columns' );
$tablet_columns    	= $tablet_columns ? $tablet_columns : 2;
$mobile_columns 	= get_theme_mod( 'op_portfolio_mobile_columns' );
$mobile_columns    	= $mobile_columns ? $mobile_columns : 1;
$masonry 			= get_theme_mod( 'op_portfolio_masonry' );
$masonry 			= $masonry ? $masonry : 'off';
$title 				= get_theme_mod( 'op_portfolio_title' );
$title 				= $title ? $title : 'on';
$pagination 		= get_theme_mod( 'op_portfolio_pagination' );
$pagination 		= $pagination ? $pagination : 'off';
$pagination_pos 	= get_theme_mod( 'op_portfolio_pagination_position' );
$pagination_pos 	= $pagination_pos ? $pagination_pos : 'center';
$filter 			= get_theme_mod( 'op_portfolio_filter' );
$filter 			= $filter ? $filter : 'off';
$filter_type 	    = get_theme_mod( 'op_portfolio_filter_type' );
$filter_type 	    = $filter_type ? $filter_type : 'default';
$filter_btn_icon    = get_theme_mod( 'op_portfolio_filter_button_icon', 'menu' );
$filter_btn_icon    = $filter_btn_icon ? $filter_btn_icon : '';
$reset_btn_icon     = get_theme_mod( 'op_portfolio_filter_reset_button_icon', 'sync' );
$reset_btn_icon     = $reset_btn_icon ? $reset_btn_icon : '';
$all_filter 		= get_theme_mod( 'op_portfolio_all_filter' );
$all_filter 		= $all_filter ? $all_filter : 'on';
$filter_pos 		= get_theme_mod( 'op_portfolio_filter_position' );
$filter_pos 		= $filter_pos ? $filter_pos : 'center';
$filter_tax 		= get_theme_mod( 'op_portfolio_filter_taxonomy' );
$filter_tax 		= $filter_tax ? $filter_tax : 'categories';
$image_target 		= get_theme_mod( 'op_portfolio_image_target' );
$image_target 		= $image_target ? $image_target : 'item';
$overlay_icons 		= get_theme_mod( 'op_portfolio_img_overlay_icons' );
$overlay_icons 		= $overlay_icons ? $overlay_icons : 'on';
$lightbox_icon 		= get_theme_mod( 'op_portfolio_img_overlay_lightbox_icon' );
$lightbox_icon 		= $lightbox_icon ? $lightbox_icon : 'on';
$authors 			= get_theme_mod( 'op_portfolio_authors' );
$authors 			= $authors ? $authors : '';
$category_ids 		= get_theme_mod( 'op_portfolio_category_ids' );
$category_ids 		= $category_ids ? $category_ids : '';
$tags 				= get_theme_mod( 'op_portfolio_tags' );
$tags 				= $tags ? $tags : '';
$offset 			= get_theme_mod( 'op_portfolio_offset' );
$offset 			= $offset ? $offset : '';
$order 				= get_theme_mod( 'op_portfolio_order' );
$order 				= $order ? $order : 'DESC';
$orderby 			= get_theme_mod( 'op_portfolio_orderby' );
$orderby 			= $orderby ? $orderby : 'date';
$exclude_cat 		= get_theme_mod( 'op_portfolio_exclude_category' );
$exclude_cat 		= $exclude_cat ? $exclude_cat : '';
$op_animation       = get_theme_mod( 'op_portfolio_img_animation', false );

$op_animation_class = '';
if ( true === $op_animation ) {
	$op_animation_class = 'op-has-animation';
}

// All text
$all_text = apply_filters( 'op_portfolio_all_text', esc_html__( 'All', 'ocean-portfolio' ) );

// Wrap classes
$wrap_classes 	   	= array( 'portfolio-entries', 'clr', 'tablet-col', 'mobile-col' );
$wrap_classes[] 	= 'tablet-' . $tablet_columns . '-col';
$wrap_classes[] 	= 'mobile-' . $mobile_columns . '-col';

// Is masonry
if ( 'on' == $masonry && 'off' == $filter ) {
	$wrap_classes[] = 'masonry-grid';
}

// Enable isotope if filter
if ( 'on' == $filter ) {
	$wrap_classes[] = 'isotope-grid';
}

// Filter type
if ( 'button' === $filter_type ) {
	$wrap_classes[] = 'filter-type--button';
}

// Add class if no overlay icon
if ( 'lightbox' != $image_target
	&& ( 'on' != $overlay_icons
		|| 'on' != $lightbox_icon ) ) {
	$wrap_classes[] = 'no-lightbox';
}

$wrap_classes 		= implode( ' ', $wrap_classes );

// Query args
$args = array(
	'post_type'      	=> 'ocean_portfolio',
	'posts_per_page' 	=> $posts_per_page,
	'order'				=> $order,
	'orderby'			=> $orderby,
	'post_status' 		=> 'publish',
	'tax_query' 		=> array(
		'relation' 		=> 'AND',
	),
);

// Authors
if ( isset( $authors ) && $authors !== '[]' && $authors !== ''  ) {

    if ( ! is_array( $authors ) ) {
        $authors = explode( ',', $authors );
    }

	$authors = array_filter( $authors, 'is_numeric' );

    // Add to query arg
    $args['author__in'] = $authors;
}

// Categories IDs
if ( isset( $category_ids ) && $category_ids !== '[]' && $category_ids !== ''  ) {

	if ( ! is_array( $category_ids ) ) {
        $category_ids = explode( ',', $category_ids );
    }

	// Add to query arg
	$args['tax_query'][] = array(
		'taxonomy' => 'ocean_portfolio_category',
		'field'    => 'slug',
		'terms'    => $category_ids,
		'operator' => 'IN',
	);

}

// // Tags
if ( isset( $tags ) && $tags !== '[]' && $tags !== '' ) {

	if ( ! is_array( $tags ) ) {
        $tags = explode( ',', $tags );
    }

	// Add to query arg
	$args['tax_query'][] = array(
		'taxonomy' => 'ocean_portfolio_tag',
		'field'    => 'slug',
		'terms'    => $tags,
		'operator' => 'IN',
	);

}

// // Offset
if ( ! empty( $offset ) && $offset > 0 ) {
	$args['offset'] = $offset;
}

// Exclude category
if ( isset( $exclude_cat ) && $exclude_cat !== '[]' && $exclude_cat !== '' ) {

	if ( ! is_array( $exclude_cat ) ) {
        $exclude_cat = explode( ',', $exclude_cat );
    }

	// Add to query arg
	$args['tax_query'][] = array(
		'taxonomy' => 'ocean_portfolio_category',
		'field'    => 'slug',
		'terms'    => $exclude_cat,
		'operator' => 'NOT IN',
	);

}

// // If filter
if ( 'on' == $filter && 'default' === $filter_type ) {

	// Get taxonomy
	if ( 'categories' == $filter_tax ) {
		$taxonomy = 'ocean_portfolio_category';
		$tax = 'cat';
	} else if ( 'tags' == $filter_tax ) {
		$taxonomy = 'ocean_portfolio_tag';
		$tax = 'tag';
	}

	// Filter args
	$filter_args = array(
		'taxonomy' 	 => $taxonomy,
		'hide_empty' => 1,
	);

// 	// If categories IDs, tags or exclude category
	if ( ! empty( $category_ids ) || ! empty( $tags ) || ! empty( $exclude_cat ) ) {

		if ( ! empty( $category_ids ) ) {
			$term_arg 	= 'include';
			$get_term 	= $category_ids;
			$term_tax 	= 'ocean_portfolio_category';
		} else if ( ! empty( $tags ) ) {
			$term_arg 	= 'include';
			$get_term 	= $tags;
			$term_tax 	= 'ocean_portfolio_tag';
		} else if ( ! empty( $exclude_cat ) ) {
			$term_arg 	= 'exclude';
			$get_term 	= $exclude_cat;
			$term_tax 	= 'ocean_portfolio_category';
		}

		if ( ! is_array( $get_term ) ) {
			$get_term = explode( ',', $get_term );
		}

		// Array
		$term_ids = array();

		// Get terms by ID
		if ( is_array( $get_term ) ) {
			foreach ( $get_term as $cat_id ) {
				$term_objects = get_term_by( 'slug', $cat_id, $term_tax );

				if ( $term_objects && ! is_wp_error( $term_objects ) ) {
					$term_ids[]   = $term_objects->term_id;
				}
			}
		}

	    // Add to filter arg
	    $filter_args[$term_arg] = $term_ids;

	}

// 	// Get filter terms
	$filter_terms = get_terms( $filter_args );

}

// // If pagination
if ( 'on' == $pagination && ! is_single() ) {
	$paged_query 	= is_front_page() ? 'page' : 'paged';
	$args['paged'] 	= get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
}

$oceanwp_query = new WP_Query( $args );

// Output posts
if ( $oceanwp_query->have_posts() ) : ?>

	<div class="<?php echo esc_attr( $wrap_classes ); ?>">

		<?php
		// Filter
		if ( 'on' == $filter && ! empty( $filter_terms ) && 'default' === $filter_type ) {

			// Class
			$filter_classes 	   	= array( 'portfolio-filters' );

			// Filter position
			if ( 'center' != $filter_pos ) {
				$filter_classes[] 	= 'filter-pos-' . $filter_pos;
			}

			$filter_classes 		= implode( ' ', $filter_classes ); ?>

			<ul class="<?php echo esc_attr( $filter_classes ); ?>">
				<?php
				// Filter
				if ( 'on' == $all_filter ) { ?>
					<li class="portfolio-filter active"><a href="#" data-filter="*"><?php echo esc_html( $all_text ); ?></a></li>
				<?php }
				foreach ( $filter_terms as $term ) { ?>
					<li class="portfolio-filter"><a href="#" data-filter=".<?php echo $tax; ?>-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
				<?php } ?>
			</ul>

		<?php }

		// Filter
		if ( 'on' == $filter && 'button' === $filter_type ) {

			// Class
			$filter_classes = array( 'portfolio__filter-style-button' );

			$filter_classes = implode( ' ', $filter_classes ); ?>

			<div class="<?php echo esc_attr( $filter_classes ); ?>">

				<div class="filter-buttons-wrap <?php echo esc_attr( $filter_pos ); ?>">
					<a href="#" class="filter-button button open">
						<?php
						if ( $filter_btn_icon ) {
							oceanwp_icon( $filter_btn_icon );
						}
						?>
						<span class="filter-text"><?php esc_html_e( 'Filter', 'ocean-portfolio' ); ?></span>
					</a>

					<a href="#" class="filter-button button reset">
						<?php
						if ( $reset_btn_icon ) {
							oceanwp_icon( $reset_btn_icon );
						}
						?>
						<span class="filter-text"><?php esc_html_e( 'Reset', 'ocean-portfolio' ); ?></span>
					</a>
				</div>

				<div class="portfolio-filter-area">
					<span class="has-arrow"></span>
					<div class="filter--form-wrap">

						<div class="filter-fields type-change">
							<select class="select-filter by-category" aria-label="Select the desired category to filter out content">
								<option value=""><?php esc_html_e( 'Select Category', 'ocean-portfolio' ); ?></option>
								<?php
								$categories = get_terms([
									'taxonomy' => 'ocean_portfolio_category',
									'hide_empty' => true,
								]);

								foreach ( $categories as $category ) {
									?>
									<option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
									<?php
								}
								?>
							</select>
							<select class="select-filter by-tag" aria-label="Select the desired tag to filter out content">
								<option value=""><?php esc_html_e( 'Select Tag', 'ocean-portfolio' ); ?></option>
								<?php
								$tags = get_terms([
									'taxonomy' => 'ocean_portfolio_tag',
									'hide_empty' => true,
								]);

								foreach ( $tags as $tag ) {
									?>
									<option value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
									<?php
								}
								?>
							</select>
						</div>

						<div class="filter-divider">
							<span class="divider"><?php echo esc_html__( 'OR', 'ocean-portfolio' ); ?></span>
						</div>

						<div class="filter-fields type-search">
							<label for="input-portfolio-search" class="label-portfolio-search">
								<span class="screen-reader-text"><?php esc_html_e( 'Type in your query to search among portfolio', 'ocean-portfolio' ); ?></span>
								<input type="text" name="input-portfolio-search" id="input-portfolio-search" class="by-search" placeholder="<?php esc_html_e( 'Search portfolio...', 'ocean-portfolio' ); ?>"></input>
							</label>
						</div>

						<div class="filter-action">
							<a href="#" class="button apply-button"><?php esc_html_e( 'Apply', 'ocean-portfolio' ); ?></a>
							<a href="#" class="button reset-button"><?php esc_html_e( 'Reset', 'ocean-portfolio' ); ?></a>
						</div>
					</div>
				</div>

			</div>

		<?php }

		// If masonry
		if ( 'on' == $masonry ) {
			$data = 'masonry';
		} else {
			$data = 'fitRows';
		} ?>

		<div class="portfolio-wrap <?php echo esc_attr( $op_animation_class ); ?>" data-layout="<?php echo esc_attr( $data ); ?>" itemscope itemtype="http://schema.org/ImageGallery">

			<?php
			// Define counter for clearing floats
			$op_count = 0;

			// Loop
			while ( $oceanwp_query->have_posts() ) : $oceanwp_query->the_post();

				// Add to counter
				$op_count++;

				// Inner classes
				$inner_classes 		= array( 'portfolio-entry', 'clr', 'col' );
				$inner_classes[] 	= 'column-'. $columns;
				$inner_classes[] 	= 'col-'. $op_count;

				// If title
				if ( 'on' == $title ) {
					$inner_classes[] = 'has-title';
				}

				// If filter
				if ( 'on' == $filter && ! empty( $filter_terms ) ) {

					$terms_list = wp_get_post_terms( get_the_ID(), $taxonomy );

					foreach ( $terms_list as $term ) {
						$inner_classes[] = $tax . '-' . $term->term_id;
					}

				}

				$inner_classes = implode( ' ', $inner_classes );

				op_entry_template( get_the_ID(), '', $inner_classes );


			// Reset counter to clear floats
			if ( $columns == $op_count ) {
				$op_count=0;
			}

			// End entry loop
			endwhile; ?>

		</div>

	    <?php
		// Pagination
		if ( 'on' == $pagination && ! is_single() ) {
			op_portfolio_pagination( $oceanwp_query->max_num_pages, $pagination_pos );
		}

		// Reset the post data to prevent conflicts with WP globals
		wp_reset_postdata(); ?>

	</div><!-- .portfolio-entries -->

<?php
// No portfolio found
else : ?>

	<p class="portfolio-not-found"><?php esc_html_e( 'You have no portfolio items', 'ocean-portfolio' ); ?></p>

<?php
endif;