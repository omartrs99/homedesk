<?php
/**
 * Server-side rendering of the `ogb/blog-list` block.
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

/**
 * The excerpt length set by the blog-list block
 * set at render time and used by the block itself.
 *
 * @var int
 */
global $block_ogb_blog_list_excerpt_length;
$block_ogb_blog_list_excerpt_length = 0;

/**
 * Callback for the excerpt_length filter used by
 * the Latest Posts block at render time.
 *
 * @return int Returns the global $block_ogb_blog_list_excerpt_length variable
 *             to allow the excerpt_length filter respect the Latest Block setting.
 */
function ogb_blog_list_excerpt_length() {
	global $block_ogb_blog_list_excerpt_length;
	return $block_ogb_blog_list_excerpt_length;
}

/**
 * Renders the `ogb/blog-list` block on server.
 *
 * @return string Returns the post content with latest posts added.
 */
function render_block_ogb_blog_list() {
	global $post, $block_ogb_blog_list_excerpt_length;

	$content = ogb_get_parsed_content();
	$data    = ogb_get_block_data( $content );

	if ( ! empty( $data ) ) {
		foreach ( $data as $name => $blockData ) {

			if ( 'blog-list' === $name ) {

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
					$show_featured_image      = isset ( $atts['displayFeaturedImage'] ) ? $atts['displayFeaturedImage'] : true;
					$show_post_title          = isset ( $atts['displayPostTitle'] ) ? $atts['displayPostTitle'] : true;
					$show_post_content        = isset ( $atts['displayPostContent'] ) ? $atts['displayPostContent'] : false;
					$show_post_categories     = isset ( $atts['displayPostCategories'] ) ? $atts['displayPostCategories'] : true;
					$show_post_date           = isset ( $atts['displayPostDate'] ) ? $atts['displayPostDate'] : false;
					$show_read_more           = isset ( $atts['displayReadMore'] ) ? $atts['displayReadMore'] : true;
					$show_comments            = isset ( $atts['displayComments'] ) ? $atts['displayComments'] : true;
					$read_more_text           = isset ( $atts['readMoreText'] ) ? $atts['readMoreText'] : 'Read More';
					$author_avatar            = isset ( $atts['authorAvatar'] ) ? $atts['authorAvatar'] : true;
					$title_tag                = isset ( $atts['titleWrapperTag'] ) ? $atts['titleWrapperTag'] : 'h2';

					// Wrap class
					$class_wrap = array( 'ogb-block', 'ogb-blog-list', 'clr' );
					$class_wrap[] = 'ogb-blog-list-' . $block_id;
					$class_wrap = implode( ' ', $class_wrap );

					$args = array(
						'posts_per_page'   => $post_to_show,
						'post_status'      => 'publish',
						'order'            => $post_order,
						'orderby'          => $orderby,
						'suppress_filters' => false,
					);

					$block_ogb_blog_list_excerpt_length = $excerpt_length;
					add_filter( 'excerpt_length', 'ogb_blog_list_excerpt_length', 20 );

					if ( isset( $atts['categories'] ) ) {
						$args['category__in'] = array_column( $atts['categories'], 'id' );
					}
					if ( isset( $atts['selectedAuthor'] ) ) {
						$args['author'] = $atts['selectedAuthor'];
					}

					$query = new WP_Query( $args );

					if($query->have_posts()):?>
						<?php ob_start(); ?>
						<div class="<?php echo esc_attr( $class_wrap ); ?>">
							<?php
							$count = 0;

							while ( $query->have_posts() ) : $query->the_post();
								$count++;

								$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
								$category  = '';

								$inner_classes = array( 'ogb-list-entry', 'clr' );

								$inner_classes = implode( ' ', $inner_classes );

								// If equal heights
								$details_class = '';

								// Meta class
								$meta_class = '';

								// Readmore class
								$readmore_class = '';

								if ( isset( $atts['metaColorBg'] ) ) {
									$meta_class = ' meta-style';
								}

								if ( isset( $atts['bgColorPbtn'] ) ) {
									$readmore_class = ' readmore-style';
								}

								if ( has_post_thumbnail()
									|| true == $show_post_title
									|| true == $show_post_content
								) { ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( $inner_classes ); ?>>

										<?php
										// Open details if the elements are yes
										if ( true == $show_post_title
											|| true == $show_post_content
										) { ?>

											<div class="ogb-list-inner clr">

												<?php if ( has_post_thumbnail() ) { ?>

													<div class="ogb-list-media clr">

														<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo  esc_attr( get_the_title() ); ?>" class="ogb-list-img">

															<?php if ( $show_featured_image && isset( $thumbnail[0] ) ) { ?>
																<img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
															<?php } ?>

															<span class="overlay"></span>

														</a>

													</div><!-- .ogb-list-media -->

												<?php } ?>

												<?php
													// Open details element if the title or excerpt are yes
													if ( true == $show_post_title || true == $show_post_content ) { ?>

														<div class="ogb-list-details<?php echo esc_attr( $details_class ); ?> clr">

															<div class="ogb-post-details-inner">

																<?php
																// Display title if $title is yes and there is a post title
																if ( true == $show_post_title ) { ?>

																	<<?php echo esc_attr( $title_tag ); ?> class="ogb-list-title entry-title">
																		<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a>
																	</<?php echo esc_attr( $title_tag ); ?>>

																<?php } ?>

																<?php
																// Display excerpt if $excerpt is yes
																if ( true == $show_post_content ) { ?>

																	<div class="ogb-list-excerpt ogb-list-post-content clr">
																		<?php do_shortcode( the_excerpt() ); ?>
																		<?php
																		// Display read more
																		if ( '' != $read_more_text && $show_read_more ) { ?>
																			<span class="readmore-button<?php echo esc_attr( $readmore_class ); ?>">
																				<a class="readmore-btn-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo $read_more_text; ?></a>
																			</span>
																		<?php } ?>
																	</div>

																<?php } ?>

																<?php
																if ( true == $show_comments || true == $show_post_categories ) { ?>

																	<ul class="ogb-list-meta<?php echo esc_attr( $meta_class ); ?> clr">

																		<?php if ( $show_post_date ) { ?>
																			<li><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></li>
																		<?php } ?>

																		<?php if ( true == $show_comments && comments_open() && ! post_password_required() ) { ?>
																			<li class="meta-comments"><i class="far fa-comment-alt"></i> <?php comments_popup_link( esc_html__( '0 Comments', 'ocean-gutenberg-blocks' ), esc_html__( '1 Comment',  'ocean-gutenberg-blocks' ), esc_html__( '% Comments', 'ocean-gutenberg-blocks' ), 'comments-link' ); ?></li>
																		<?php } ?>

																		<?php if ( true == $show_post_categories ) { ?>
																			<li class="meta-cat"><i class="far fa-folder-open"></i> <?php the_category( ' , ', get_the_ID() ); ?></li>
																		<?php } ?>

																	</ul>

																<?php } ?>

															</div>

														</div><!-- .ogb-list-details -->

													<?php }
												?>

											</div>

										<?php } ?>
									</article>
								<?php } ?>
								<?php
							endwhile;
							wp_reset_postdata();
							?>

						</div>

						<?php
						remove_filter( 'excerpt_length', 'ogb_blog_list_excerpt_length', 20 );
						ogb_add_block_to_rendered_list( $atts['blockId'] );
						return ob_get_clean();

					endif;

				}

			}

		}

	}
}
