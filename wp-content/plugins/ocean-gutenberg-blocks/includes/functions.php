<?php
/**
 * Ocean Gutenberg blocks: common functions
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get block data
 *
 * @param string $content Content.
 * @param array  $data    Data.
 *
 * @return array $data
 */
function ogb_get_block_data( $content, $data = array(), $depth = 0 ) {
	if ( ! is_array( $content ) || empty( $content ) ) {
		return;
	}

	foreach ( $content as $index => $block ) {
		if ( ! is_object( $block ) && is_array( $block ) && isset( $block['blockName'] ) ) {
			if ( 'ogb/alert' === $block['blockName'] ) {
				$data['alert'][] = $block['attrs'];
			}

			if ( 'ogb/banner' === $block['blockName'] ) {
				$data['banner'][] = $block['attrs'];
			}

			if ( 'ogb/business-hour' === $block['blockName'] ) {
				$data['business-hour'][] = $block['attrs'];
			}

			if ( 'ogb/business-hours' === $block['blockName'] ) {
				$data['business-hours'][] = $block['attrs'];
			}

			if ( 'ogb/divider' === $block['blockName'] ) {
				$data['divider'][] = $block['attrs'];
			}

			if ( 'ogb/info-boxes' === $block['blockName'] ) {
				$data['info-boxes'][] = $block['attrs'];
			}

			if ( 'ogb/info-box' === $block['blockName'] ) {
				$data['info-box'][] = $block['attrs'];
			}

			if ( 'ogb/testimonial' === $block['blockName'] ) {
				$data['testimonial'][] = $block['attrs'];
			}

			if ( 'ogb/timeline' === $block['blockName'] ) {
				$data['timeline'][] = $block['attrs'];
			}

			if ( 'ogb/blog-grid' === $block['blockName'] ) {
				$data['blog-grid'][] = $block['attrs'];
			}

			if ( 'ogb/blog-list' === $block['blockName'] ) {
				$data['blog-list'][] = $block['attrs'];
			}

			if ( 'ogb/heading' === $block['blockName'] ) {
				$data['heading'][] = $block['attrs'];
			}

			if ( 'ogb/newsletter' === $block['blockName'] ) {
				$data['newsletter'][] = $block['attrs'];
			}

			if ( 'ogb/columns' === $block['blockName'] ) {
				$data['columns'][] = $block['attrs'];
			}

			if ( 'ogb/column' === $block['blockName'] ) {
				$data['column'][] = $block['attrs'];
			}

			if ( 'ogb/call-to-action' === $block['blockName'] ) {
				$data['call-to-action'][] = $block['attrs'];
			}

			if ( 'ogb/icon-list' === $block['blockName'] ) {
				$data['icon-list'][] = $block['attrs'];
			}

			if ( 'ogb/section' === $block['blockName'] ) {
				$data['section'][] = $block['attrs'];
			}

			if ( 'ogb/team' === $block['blockName'] ) {
				$data['team'][] = $block['attrs'];
			}

			if ( 'ogb/button' === $block['blockName'] ) {
				$data['button'][] = $block['attrs'];
			}

			if ( 'ogb/modal' === $block['blockName'] ) {
				$data['modal'][] = $block['attrs'];
			}

			if ( 'ogb/recipe' === $block['blockName'] ) {
				$data['recipe'][] = $block['attrs'];
			}

			if ( 'ogb/star-rating' === $block['blockName'] ) {
				$data['star-rating'][] = $block['attrs'];
			}

			if ( 'ogb/circle-progress' === $block['blockName'] ) {
				$data['circle-progress'][] = $block['attrs'];
			}

			if ( 'ogb/pricing-menu' === $block['blockName'] ) {
				$data['pricing-menu'][] = $block['attrs'];
			}

			if ( 'ogb/acf' === $block['blockName'] ) {
				$data['acf'][] = $block['attrs'];
			}

			if ( 'ogb/clipboard' === $block['blockName'] ) {
				$data['clipboard'][] = $block['attrs'];
			}

			if ( 'core/block' === $block['blockName'] ) {
				if ( isset( $block['attrs'] ) && is_array( $block['attrs'] ) ) {
					$atts = $block['attrs'];

					if ( isset( $atts['ref'] ) ) {
						$reusable_block = get_post( $atts['ref'] );

						if ( $reusable_block && 'wp_block' === $reusable_block->post_type && 'publish' === $reusable_block->post_status ) {
							$reuse_data_block = parse_blocks( $reusable_block->post_content );

							if ( ! empty( $reuse_data_block ) ) {
								$data = ogb_get_block_data( $reuse_data_block, $data );
							}
						}
					}
				}
			}

			if ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
				$data = ogb_get_block_data( $block['innerBlocks'], $data, $depth );
			}
		}
	}

	return $data;

}

/**
 * Parse content for blocks.
 *
 * @param string $content Optional: Content.
 */
function ogb_get_parsed_content( $content = '' ) {

	if ( ! function_exists( 'has_blocks' ) ) {
		return;
	}

	if ( ! $content && has_blocks( get_the_ID() ) ) {
		global $post;

		if ( ! is_object( $post ) ) {
			return;
		}

		$content = $post->post_content;
	}

	if ( ! function_exists( 'parse_blocks' ) ) {
		return;
	}

	$content = parse_blocks( $content );

	return $content;
}

/**
 * Newsletter Form
 */
if ( ! function_exists( 'ogb_newsletter_form' ) ) {

	function ogb_newsletter_form() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ogb_mailchimp' ) ) {
			wp_send_json( array( 'status' => false ) );
			wp_die();
		}

		$api_key = '';
		$list_id = '';

		if ( 'OceanWP' === OGB_Utils::ogb_get_theme( 'theme' ) || 'oceanwp' === OGB_Utils::ogb_get_theme( 'template' ) ) {
			$api_key = get_option( 'owp_mailchimp_api_key', '' );
			$list_id = get_option( 'owp_mailchimp_list_id' );
		} else {
			$api_key = get_theme_mod( 'ogb_mailchimp_api_key', '' );
			$list_id = get_theme_mod( 'ogb_mailchimp_audience_id', '' );
		}

		$email   = ( isset( $_POST['email'] ) && is_email( $_POST['email'] ) ) ? sanitize_email( $_POST['email'] ) : '';
		$status  = false;

		if ( $email && $api_key && $list_id ) {

			$apikey     = trim( $api_key );
			$dc         = explode( '-', $apikey );
			$datacenter = empty( $dc[1] ) ? 'us1' : $dc[1];
			$api_url    = esc_url( 'https://' . $datacenter . '.api.mailchimp.com/3.0/' );

			$params = array(
				'apikey'            => $apikey,
				'id'                => $list_id,
				'email_address'     => $email,
				'status'            => 'subscribed',
			);

			$url = esc_url( $api_url . 'lists/' . $list_id . '/members/' . md5(strtolower($email)) );

			$args = array(
				'method'      => 'PUT',
				'timeout'     => 30,
				'httpversion' => '1.1',
				'user-agent'  => 'OceanWP MailChimp Widget/' . esc_url( get_bloginfo( 'url' ) ),
				'headers'     => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:'. $apikey ),
					'Content-Type'  => 'application/json',
				),
				'sslverify'   => apply_filters( 'ocean_oemc_ssl_verify', false ),
				'body'        => wp_json_encode( $params ),
			);

			$args = apply_filters( 'ocean_mailchimp_api_args', $args );

			$request      = wp_remote_post( $url, $args );
			$request_code = ( is_array( $request ) ) ? $request['response']['code'] : '';

			if ( 200 === $request_code ) {
				$status = true;
			}
		}

		wp_send_json( array( 'status' => $status ) );

		wp_die();

	}

	add_action( 'wp_ajax_ogb_newsletter_form', 'ogb_newsletter_form' );
	add_action( 'wp_ajax_nopriv_ogb_newsletter_form', 'ogb_newsletter_form' );

}

/**
 * Return padding/margin values
 */
if ( ! function_exists( 'ogb_spacing_css' ) ) {

	function ogb_spacing_css( $top, $right, $bottom, $left ) {

		// Add px and 0 if no value
		$s_top    = ( isset( $top ) && '' !== $top ) ? intval( $top ) . 'px ' : '0px ';
		$s_right  = ( isset( $right ) && '' !== $right ) ? intval( $right ) . 'px ' : '0px ';
		$s_bottom = ( isset( $bottom ) && '' !== $bottom ) ? intval( $bottom ) . 'px ' : '0px ';
		$s_left   = ( isset( $left ) && '' !== $left ) ? intval( $left ) . 'px' : '0px';

		// Return one value if it is the same on every inputs.
		if ( ( intval( $s_top ) === intval( $s_right ) )
			&& ( intval( $s_right ) === intval( $s_bottom ) )
			&& ( intval( $s_bottom ) === intval( $s_left ) ) ) {
			return $s_left;
		}

		// Return.
		return $s_top . $s_right . $s_bottom . $s_left;
	}
}

if ( ! function_exists( 'ogb_add_block_to_rendered_list' ) ) {

	function ogb_add_block_to_rendered_list( $block_id ) {

		global $rendered_blocks;
		if ( empty( $rendered_blocks ) ) {
			$rendered_blocks = [];
		}

		$rendered_blocks[] = $block_id;
	}
}

if ( ! function_exists( 'ogb_check_block_is_rendered' ) ) {

	function ogb_check_block_is_rendered( $block_id ) {

		global $rendered_blocks;
		if ( empty( $rendered_blocks ) ) {
			$res = false;
		} else {
			if ( is_array( $rendered_blocks ) && in_array( $block_id, $rendered_blocks ) ) {
				$res = true;
			} else {
				$res = false;
			}
		}
		return $res;
	}
}
