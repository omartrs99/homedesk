<?php
/**
 * Customizer class for Ocean Gutenberg blocks
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Customizer' ) ) {

	/**
	 * Main class
	 */
	class OGB_Customizer {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			$this->includes();

			add_action( 'customize_register', array( $this, 'ogb_customizer' ) );
			add_action( 'customize_preview_init', array( $this, 'ogb_customize_preview' ) );

		}

		/**
		 * Required files
		 */
		public function includes() {
			require_once OGB_INC . 'customizer/helper.php';
		}

		/**
		 * Setting up the customizer
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function ogb_customizer( $wp_customize ) {

			// Register the customizer section.
			$wp_customize->add_section(
				'ogb_blocks_section',
				array(
					'title'    => esc_html__( 'OceanWP Blocks', 'ocean-gutenberg-blocks' ),
					'priority' => 150,
				)
			);

			/**
			 * Output CSS
			 */
			$wp_customize->add_setting(
				'ogb_css_output_method',
				array(
					'transport'         => 'postMessage',
					'default'           => 'head',
					'sanitize_callback' => 'ogb_sanitize_select',
				)
			);

			$wp_customize->add_control(
				'ogb_css_output_method',
				array(
					'label'       => esc_html__( 'Styling Options Location', 'ocean-gutenberg-blocks' ),
					'description' => esc_html__( 'If you choose Custom File, a CSS file will be created in your uploads folder.', 'ocean-gutenberg-blocks' ),
					'type'        => 'select',
					'section'     => 'ogb_blocks_section',
					'priority'    => 10,
					'choices'     => array(
						'head' => esc_html__( 'WP Head', 'ocean-gutenberg-blocks' ),
						'file' => esc_html__( 'Custom File', 'ocean-gutenberg-blocks' ),
					),
				)
			);

			/**
			 * Mailchimp api key
			 */
			$wp_customize->add_setting(
				'ogb_mailchimp_api_key',
				array(
					'transport'           	=> 'postMessage',
					'default'           	=> '',
					'sanitize_callback' 	=> 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'ogb_mailchimp_api_key',
					array(
						'label'	   				=> esc_html__( 'Mailchimp API Key', 'ocean-gutenberg-blocks' ),
						'description'	   		=> sprintf( 'Used for the Newsletter blocks of the Ocean Gutenberg blocks. <a href="https://docs.oceanwp.org/article/520-get-your-mailchimp-api-key-and-list-id" target="_blank">Follow this article</a> to get your API Key and List ID.', 'ocean-gutenberg-blocks' ),
						'type'                  => 'text',
						'section'  				=> 'ogb_blocks_section',
						'priority' 				=> 10,
					)
				)
			);

			/**
			 * Mailchimp api key
			 */
			$wp_customize->add_setting(
				'ogb_mailchimp_audience_id',
				array(
					'transport'           	=> 'postMessage',
					'default'           	=> '',
					'sanitize_callback' 	=> 'wp_kses_post',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'ogb_mailchimp_audience_id',
					array(
						'label'	   				=> esc_html__( 'Mailchimp Audience Id', 'ocean-gutenberg-blocks' ),
						'description'	   		=> esc_html__( 'Enter Mailchimp Audience Id', 'ocean-gutenberg-blocks' ),
						'type'                  => 'text',
						'section'  				=> 'ogb_blocks_section',
						'priority' 				=> 10,
					)
				)
			);
		}

		/**
		 * Customizer preview
		 */
		public function ogb_customize_preview() {
			wp_enqueue_script(
				'ogb-customize-preview',
				OGB_URL . 'assets/js/customizer.min.js',
				array( 'customize-preview' ),
				OGB_VERSION,
				true
			);
		}

	}

}

/**
 * Kicking off this class
 */
return new OGB_Customizer();
