<?php
/**
 * Server-side rendering of the `ogb/timeline` block.
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

/**
 * The excerpt length set by the timeline block
 * set at render time and used by the block itself.
 *
 * @var int
 */
$block_ogb_timeline_excerpt_length = 0;

/**
 * Callback for the excerpt_length filter used by
 * the Latest Posts block at render time.
 *
 * @return int Returns the global $block_ogb_timeline_excerpt_length variable
 *             to allow the excerpt_length filter respect the Latest Block setting.
 */
function ogb_timeline_excerpt_length() {
	global $block_ogb_timeline_excerpt_length;
	return $block_ogb_timeline_excerpt_length;
}

/**
 * Renders the `ogb/timeline` block on server.
 *
 * @return string Returns the post content with latest posts added.
 */
function render_block_ogb_timeline() {
	global $post, $block_ogb_timeline_excerpt_length;

	$content = ogb_get_parsed_content();
	$data    = ogb_get_block_data( $content );

	if ( ! empty( $data ) ) {
		foreach ( $data as $name => $blockData ) {

			if ( 'timeline' === $name ) {

				if ( empty( $blockData ) ) {
					continue;
				}

				foreach ( $blockData as $atts ) {

					if ( ! isset( $atts['blockId'] ) ) {
						continue;
					}

					if( ogb_check_block_is_rendered( $atts['blockId'] ) ) {
						continue;
					}

					$block_id                 = isset ( $atts['blockId'] ) ? $atts['blockId'] : '';
					$post_to_show             = isset ( $atts['postsToShow'] ) ? $atts['postsToShow'] : 5;
					$post_order               = isset ( $atts['order'] ) ? $atts['order'] : 'desc';
					$orderby                  = isset ( $atts['orderBy'] ) ? $atts['orderBy'] : 'date';
					$excerpt_length           = isset ( $atts['excerptLength'] ) ? $atts['excerptLength'] : 17;
					$featured_image_size_slug = isset ( $atts['featuredImageSizeSlug'] ) ? $atts['featuredImageSizeSlug'] : 'thumbnail';
					$alignment                = isset ( $atts['alignment'] ) ? $atts['alignment'] : 'center';
					$show_featured_image      = isset ( $atts['displayFeaturedImage'] ) ? $atts['displayFeaturedImage'] : true;
					$show_post_title          = isset ( $atts['displayPostTitle'] ) ? $atts['displayPostTitle'] : true;
					$show_post_content        = isset ( $atts['displayPostContent'] ) ? $atts['displayPostContent'] : false;
					$show_post_categories     = isset ( $atts['displayPostCategories'] ) ? $atts['displayPostCategories'] : true;
					$show_post_date           = isset ( $atts['displayPostDate'] ) ? $atts['displayPostDate'] : false;
					$show_read_more           = isset ( $atts['displayReadMore'] ) ? $atts['displayReadMore'] : true;
					$read_more_icon_align     = isset ( $atts['readMoreIconAlign'] ) ? $atts['readMoreIconAlign'] : 'right';
					$read_more_text           = isset ( $atts['readMoreText'] ) ? $atts['readMoreText'] : 'Read More';

					// Wrap class
					$class_wrap = array();
					$class_wrap[] = 'ogb-block';
					$class_wrap[] = 'ogb-timeline';
					$class_wrap[] = 'ogb-timeline-' . $block_id;
					if ( $alignment ) {
						$class_wrap[] = 'ogb-timeline-' . $alignment;
					}
					$class_wrap = implode( ' ', $class_wrap );

					$args = array(
						'posts_per_page'   => $post_to_show,
						'post_status'      => 'publish',
						'order'            => $post_order,
						'orderby'          => $orderby,
						'suppress_filters' => false,
					);

					$block_ogb_timeline_excerpt_length = $excerpt_length;
					add_filter( 'excerpt_length', 'ogb_timeline_excerpt_length', 20 );

					if ( isset( $atts['categories'] ) ) {
						$args['category__in'] = array_column( $atts['categories'], 'id' );
					}
					if ( isset( $atts['selectedAuthor'] ) ) {
						$args['author'] = $atts['selectedAuthor'];
					}

					$query = new WP_Query( $args );

					if ($query->have_posts()): ob_start(); ?>
						<div class="<?php echo esc_attr( $class_wrap ); ?>">
							<div class="ogb-timeline-inner">

								<?php
								$count = 0;

								while ($query->have_posts()) : $query->the_post();
									$count++;

									$thumbnail   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
									$post_format = get_post_format() ? : 'standard';
									$category    = '';
									$position    = ( $count%2 == 0 ) ? 'right' : 'left';
									$date_class  = ( 'center' == $alignment ) ? 'hidden' : 'normal';

									$postFormatIcon = '<i class="far fa-file-alt"></i>';
									if ( 'standard' === $post_format ) {
										$postFormatIcon = '<i class="far fa-file-alt"></i>';
									} else if ( 'link' === $post_format ) {
										$postFormatIcon = '<i class="fas fa-link"></i>';
									} else if ( 'audio' === $post_format ) {
										$postFormatIcon = '<i class="fas fa-volume-up"></i>';
									} else if ( 'video' === $post_format ) {
										$postFormatIcon = '<i class="fas fa-video"></i>';
									} else if ( 'gallery' === $post_format ) {
										$postFormatIcon = '<i class="far fa-images"></i>';
									} else if ( 'quote' === $post_format ) {
										$postFormatIcon = '<i class="fas fa-quote-right"></i>';
									}

									if ( $count%2 == 0
										&& 'center' == $alignment ) { ?>
										<div class="ogb-timeline-item">
											<div class="ogb-timeline-date ogb-timeline-date-right"><span><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></span></div>
										</div>
										<?php
									} ?>

									<div class="ogb-timeline-item ogb-timeline-item-<?php echo esc_attr( $position ); ?>">
										<div class="ogb-timeline-item-wrap">

											<div class="ogb-timeline-line<?php echo $query->current_post + 1 === $query->post_count ? ' ogb-last-line' : '' ?>"><span></span></div>

											<div class="ogb-timeline-item-container">
												<div class="ogb-timeline-icon ogb-timeline-post-icon ogb-post-format-<?php echo esc_attr( $post_format ); ?>">
													<span>
														<?php echo $postFormatIcon; ?>
													</span>
												</div>

												<div class="ogb-timeline-item-main">
													<span class="ogb-timeline-arrow"></span>

													<?php if ( $show_featured_image && isset( $thumbnail[0] ) ) { ?>
														<div class="ogb-timeline-thumbnail">
															<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
																<img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
															</a>
														</div>
													<?php } ?>

													<div class="ogb-timeline-desc">
														<?php
														if ( $show_post_title ) { ?>
															<h4 class="ogb-timeline-title">
																<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
															</h4>
															<?php
														}

														if ( $show_post_categories || $show_post_date ) { ?>
															<ul class="ogb-timeline-meta">
																<?php if ( $show_post_date ) { ?>
																	<li class="ogb-timeline-meta-date ogb-timeline-<?php echo esc_attr( $date_class ); ?>"><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></li>
																<?php } ?>
																<?php if ( $show_post_categories ) { ?>
																	<li><?php echo get_the_category_list( ', ' ); ?></li>
																<?php } ?>
															</ul>
															<?php
														}

														if ( $show_post_content ) { ?>
															<div class="ogb-timeline-excerpt"><?php do_shortcode( the_excerpt() ); ?></div>
															<?php
														}

														if ( $show_read_more ) { ?>
															<a href="<?php echo esc_url( get_permalink() ); ?>" class="ogb-timeline-readmore button">
																<?php
																if ( $read_more_icon_align && 'left' == $read_more_icon_align ) { ?>
																	<span class="ogb-button-icon ogb-align-<?php echo esc_attr( $read_more_icon_align ); ?>">
																		<i class="fas fa-long-arrow-alt-left"></i>
																	</span>
																	<?php
																} ?>

																<?php
																if ( $read_more_text ) {
																	?>
																	<span><?php echo esc_html( $read_more_text ); ?></span>
																	<?php
																}
																?>

																<?php
																if ( $read_more_icon_align && 'right' == $read_more_icon_align ) { ?>
																	<span class="ogb-button-icon ogb-align-<?php echo esc_attr( $read_more_icon_align ); ?>">
																		<i class="fas fa-long-arrow-alt-right"></i>
																	</span>
																	<?php
																} ?>
															</a>
															<?php
														} ?>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php
									if ( $count%2 == 1
										&& ( 'center' == $alignment ) ) { ?>
										<?php
										$position = ( $count%2 == 1 ) ? 'right' : 'left'; ?>
										<div class="ogb-timeline-item">
											<div class="ogb-timeline-date"><span><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></span></div>
										</div>
										<?php
									} ?>

									<?php
								endwhile;
								wp_reset_postdata();
								?>

							</div>
						</div>

						<?php
						remove_filter( 'excerpt_length', 'ogb_timeline_excerpt_length', 20 );
						ogb_add_block_to_rendered_list( $atts['blockId'] );
						return ob_get_clean();
					endif;

				}

			}

		}

	}
}
