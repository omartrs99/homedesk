<?php
/**
 * Instagram Shortcode
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'OIG_Instagram_Shortcode' ) ) {

	class OIG_Instagram_Shortcode {

		/**
		 * Instagram Access Token
		 *
		 * @var string
		 */
		protected $access_token;

		/**
		 * Start things up
		 */
		public function __construct() {
			$options            = get_option( 'oig_instagram_settings_options' );
			$oig_access_token   = '';

			( isset( $options['oig_access_token'] ) && ! empty( $options['oig_access_token'] ) ) ? $oig_access_token = sanitize_text_field( $options['oig_access_token'] ) : $oig_access_token = '';
			$this->access_token = $oig_access_token;

			add_shortcode( 'oceanwp_instagram', array( $this, 'instagram_shortcode' ) );
		}

		/**
		 * Get the IMG
		 *
		 * @since 1.0.5
		 */
		public function instagram_display( $id ) {
			// Variables.
			$url            = 'https://graph.instagram.com/me';
			$token          = $this->access_token;
			$cache          = get_post_meta( $id, 'oig_instagram_cache', true );
			$cache          = $cache ? esc_attr( $cache ) : '60';
			$info_key       = 'oig_insta_info_' . md5( str_replace( '.', '_', $token ) . $cache );
			$media_key      = 'oig_insta_' . md5( str_replace( '.', '_', $token ) . $cache );
			$number         = get_post_meta( $id, 'oig_instagram_number', true );
			$number         = $number ? absint( $number ) : '6';
			$columns        = get_post_meta( $id, 'oig_instagram_columns', true );
			$columns        = $columns ? absint( $columns ) : '4';
			$force_square   = get_post_meta( $id, 'oig_instagram_force_square', true );
			$force_square   = $force_square ? esc_attr( $force_square ) : 'on';
			$wrap_link      = get_post_meta( $id, 'oig_instagram_link', true );
			$wrap_link      = $wrap_link ? esc_attr( $wrap_link ) : 'on';
			$wrap_target    = get_post_meta( $id, 'oig_instagram_link_target', true );
			$header         = get_post_meta( $id, 'oig_instagram_display_header', true );
			$header         = $header ? esc_attr( $header ) : 'off';
			$img            = get_post_meta( $id, 'oig_instagram_avatar', true );
			$username       = get_post_meta( $id, 'oig_instagram_username', true );
			$username       = $username ? esc_attr( $username ) : 'off';
			$button         = get_post_meta( $id, 'oig_instagram_follow', true );
			$button         = $button ? esc_attr( $button ) : 'on';
			$bio            = get_post_meta( $id, 'oig_instagram_bio', true );
			$target         = get_post_meta( $id, 'oig_instagram_btn_target', true );
			$button_text    = get_post_meta( $id, 'oig_instagram_button_text', true );
			$columns        = get_post_meta( $id, 'oig_instagram_columns', true );
			$columns        = $columns ? absint( $columns ) : '4';
			$square         = get_post_meta( $id, 'oig_instagram_square_image_size', true );
			$square         = $square ? esc_attr( $square ) : '200';
			$overlay        = get_post_meta( $id, 'oig_instagram_overlay', true );
			$overlay        = $overlay ? esc_attr( $overlay ) : 'on';
			$space          = get_post_meta( $id, 'oig_instagram_space', true );
			$space          = $space ? absint( $space ) : '0';
			$radius         = get_post_meta( $id, 'oig_instagram_border_radius', true );
			$radius         = $radius ? esc_attr( $radius ) : '0';
			$overlay_bg     = get_post_meta( $id, 'oig_instagram_overlay_bg', true );
			$overlay_bg     = $overlay_bg ? esc_attr( $overlay_bg ) : '#13aff0';
			$opacity        = get_post_meta( $id, 'oig_instagram_overlay_opacity', true );
			$opacity        = $opacity ? esc_attr( $opacity ) : '0.7';
			$overlay_icon   = get_post_meta( $id, 'oig_instagram_overlay_icon_color', true );
			$overlay_icon   = $overlay_icon ? esc_attr( $overlay_icon ) : '#ffffff';
			$tablet_columns = get_post_meta( $id, 'oig_instagram_tablet_columns', true );
			$tablet_columns = $tablet_columns ? absint( $tablet_columns ) : '3';
			$tablet_space   = get_post_meta( $id, 'oig_instagram_tablet_space', true );
			$tablet_space   = $tablet_space ? absint( $tablet_space ) : '';
			$mobile_columns = get_post_meta( $id, 'oig_instagram_mobile_columns', true );
			$mobile_columns = $mobile_columns ? absint( $mobile_columns ) : '1';
			$mobile_space   = get_post_meta( $id, 'oig_instagram_mobile_space', true );
			$mobile_space   = $mobile_space ? absint( $mobile_space ) : '';

			// Get info
			if ( get_transient( $info_key ) === false ) {
				$request_args = array(
					'timeout' => 10,
				);
				$data_info       = wp_remote_retrieve_body( wp_remote_get( $url . '?fields=id,username&access_token=' . $token, $request_args ) );
				$data_info_check = json_decode( $data_info, true );

				if ( ! empty( $data_info_check['data'] ) ) {
					set_transient( $info_key, $data_info, ( $cache * MINUTE_IN_SECONDS ) );
				}
			} else {
				$data_info = get_transient( $info_key );
			}

			// Get media
			if ( get_transient( $media_key ) === false ) {
				$request_args     = array(
					'timeout' => 10,
				);
				$data_media       = wp_remote_retrieve_body( wp_remote_get( $url . '/media/?fields=username,id,caption,media_type,media_url,permalink,thumbnail_url,timestamp&limit=200&access_token=' . $token, $request_args ) );
				$data_media_check = json_decode( $data_media, true );

				if ( ! empty( $data_media_check['data'] ) ) {
					set_transient( $media_key, $data_media, ( $cache * MINUTE_IN_SECONDS ) );
				}
			} else {
				$data_media = get_transient( $media_key );
			}

			$data_info  = json_decode( $data_info, true );
			$data_media = json_decode( $data_media, true );

			if ( empty( $data_media['data'] )
				|| empty( $number ) ) {
				return;
			}

			// Username.
			if ( ! empty( $username ) ) {
				$name = $username;
			} else {
				$name = $data_info['username'];
			}

			// Wrap classes.
			$wrap_classes = array( 'oig-insta', 'clr' );

			// Square.
			if ( 'on' == $force_square ) {
				$wrap_classes[] = 'oig-insta-square';
			}

			// Turn classes into space seperated string.
			$wrap_classes = implode( ' ', $wrap_classes );

			// If link.
			$link     = '';
			$end_link = '';
			if ( 'on' === $target ) {
				$header_target = '_blank';
			} else {
				$header_target = '_self';
			}
			if ( 'on' === $button ) {
				$link     = '<a href="https://www.instagram.com/' . $data_info['username'] . '" target="' . $header_target . '">';
				$end_link = '</a>';
			}

			if ( $items = $data_media['data'] ) {
				$items = array_splice( $items, ( 0 * $number ), $number ); ?>

		<div id="oig-<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $wrap_classes ); ?>">

					<?php
					$icon = '<svg aria-hidden="true" aria-label="Instagram" data-icon="instagram" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>';

					if ( 'on' === $header ) {
						?>
				<div class="oig-insta-header">

					<div class="oig-insta-left">

								<?php
								if ( ! empty( $img ) ) {
									// Generate image URL if using ID.
									if ( is_numeric( $img ) ) {
										$img = wp_get_attachment_image_src( $img, 'full' );
										$img = $img[0];
									}
									?>
							<div class="oig-insta-avatar"><?php echo $link; ?><img src="<?php echo $img; ?>"><?php echo $end_link; ?></div>
									<?php
								}
								?>

						<div class="oig-insta-details">
							<h3 class="oig-insta-username"><?php echo $link . $name . $end_link; ?></h3>
						
							<?php
							if ( ! empty( $bio ) ) {
								?>
								<p class="oig-insta-desc"><?php echo $bio; ?></p>
								<?php
							}
							?>
						</div>

					</div>

							<?php
							if ( 'on' === $button ) {
								?>
						<div class="oig-insta-button"><?php echo $link . $icon . '<span>' . $button_text . '</span>' . $end_link; ?></div>
								<?php
							}
							?>

				</div>
						<?php
					}
					?>

			<div class="oig-insta-pictures">
				<?php
				foreach ( $items as $item ) {
					if ( 'on' === $wrap_link ) {
						$tag = 'a';
						if ( 'on' === $wrap_target ) {
							$link_target = '_blank';
						} else {
							$link_target = '_self';
						}
						$link = ' href="' . $item['permalink'] . '" target="' . $link_target . '"';
					} else {
						$tag  = 'div';
						$link = '';
					}

					$image_src = ( $item['media_type'] == 'VIDEO' ) ? $item['thumbnail_url'] : $item['media_url'];
					?>

					<<?php echo $tag . $link; ?> class="oig-insta-item">
						<div class="oig-insta-item-inner">
							<?php
							if ( $item['media_type'] == 'CAROUSEL_ALBUM' ) {
								?>
								<div class="oig-insta-gallery-icon"><svg aria-hidden="true" data-icon="clone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48zM362 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h42v224c0 26.51 21.49 48 48 48h224v42a6 6 0 0 1-6 6zm96-96H150a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h308a6 6 0 0 1 6 6v308a6 6 0 0 1-6 6z"></path></svg></div>
								<?php
							}
							?>
							<img class="oig-insta-img" src="<?php echo $image_src; ?>">
							<?php
							if ( 'on' === $overlay ) {
								?>
								<div class="oig-insta-icon"><?php echo $icon; ?></div>
								<?php
							}
							?>
						</div>
					</<?php echo $tag; ?>>
					<?php
				}
				?>
			</div>

		</div>

				<?php
				// Define css var.
				$css        = '';
				$tablet_css = '';
				$mobile_css = '';

				// Columns.
				if ( ! empty( $columns ) ) {
					$css .= '#oig-' . $id . ' .oig-insta-item{width: calc( 100% / ' . $columns . ');}';
				}

				// Square.
				if ( ! empty( $square ) ) {
					$css .= '#oig-' . $id . '.oig-insta-square .oig-insta-img{width: 100%; height: ' . $square . 'px; object-fit: cover;}';
				}

				// Space.
				if ( ! empty( $space ) && '0' != $space ) {
					$css .= '#oig-' . $id . ' .oig-insta-item-inner{border: ' . $space . 'px solid transparent;}';
				}

				// Border radius.
				if ( ! empty( $radius ) && '0' != $radius ) {
					$css .= '#oig-' . $id . ' .oig-insta-item-inner{border-radius: ' . $radius . ';}';
				}

				// Overlay background.
				if ( ! empty( $overlay_bg ) && '#13aff0' != $overlay_bg ) {
					$css .= '#oig-' . $id . ' .oig-insta-item .oig-insta-icon{background-color: ' . $overlay_bg . ';}';
				}

				// Overlay opacity.
				if ( ! empty( $opacity ) && '0.7' != $opacity ) {
					$css .= '#oig-' . $id . ' .oig-insta-item:hover .oig-insta-icon{opacity: ' . $opacity . ';}';
				}

				// Overlay text color.
				if ( ! empty( $overlay_icon ) && '#ffffff' != $overlay_icon ) {
					$css .= '#oig-' . $id . ' .oig-insta-icon svg path{fill: ' . $overlay_icon . ';}';
				}

				// Tablet columns.
				if ( ! empty( $tablet_columns ) && '3' != $tablet_columns ) {
					$tablet_css .= '#oig-' . $id . ' .oig-insta-item{width: calc( 100% / ' . $tablet_columns . ') !important;}';
				}

				// Tablet space.
				if ( ! empty( $tablet_space ) ) {
					$tablet_css .= '#oig-' . $id . ' .oig-insta-item-inner{border: ' . $tablet_space . 'px solid transparent;}';
					$tablet_css .= '#oig-' . $id . ' .oig-insta-pictures{margin: 0 -' . $tablet_space . 'px;}';
				}

				// Tablet css.
				if ( ! empty( $tablet_css ) ) {
					$css .= '@media (max-width: 768px) {' . $tablet_css . '}';
				}

				// Mobile columns.
				if ( ! empty( $mobile_columns ) && '1' != $mobile_columns ) {
					$mobile_css .= '#oig-' . $id . ' .oig-insta-item{width: calc( 100% / ' . $mobile_columns . ') !important;}';
				}

				// Mobile space.
				if ( ! empty( $mobile_space ) ) {
					$mobile_css .= '#oig-' . $id . ' .oig-insta-item-inner{border: ' . $mobile_space . 'px solid transparent;}';
					$mobile_css .= '#oig-' . $id . ' .oig-insta-pictures{margin: 0 -' . $mobile_space . 'px;}';
				}

				// Mobile css.
				if ( ! empty( $mobile_css ) ) {
					$css .= '@media (max-width: 480px) {' . $mobile_css . '}';
				}

				// Return CSS.
				if ( ! empty( $css ) ) {
					?>
			<style type="text/css"><?php echo wp_strip_all_tags( oceanwp_minify_css( $css ) ); ?></style>
					<?php
				}
			}
		}

		/**
		 * Registers the function as a shortcode
		 *
		 * @since 1.0.0
		 */
		public function instagram_shortcode( $atts, $content = null ) {

			// Attributes.
			$atts = shortcode_atts(
				array(
					'id' => '',
				),
				$atts,
				'oceanwp_instagram'
			);

			ob_start();

			if ( $atts['id'] ) {
				$this->instagram_display( $atts['id'] );
			}

			return ob_get_clean();

		}

	}

}

new OIG_Instagram_Shortcode();
