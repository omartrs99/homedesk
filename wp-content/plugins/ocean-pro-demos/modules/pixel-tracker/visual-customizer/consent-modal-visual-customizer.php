<?php
/**
 * Class OPD_ConsentBannerCustomizer
 * Handles customizer settings for the consent banner visual appearance.
 */
class OPD_ConsentBannerCustomizer {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'create_settings_page' ) );
		add_action( 'admin_init', array( $this, 'settings_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'output_inline_styles' ) );
		add_action( 'admin_init', array( $this, 'handle_reset_to_defaults' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Creates the settings page.
	 */
	public function create_settings_page() {
		add_submenu_page(
			'oceanwp',
			__( 'Consent Banner Settings', 'ocean-ecommerce' ),
			__( 'Consent Banner Settings', 'ocean-ecommerce' ),
			'manage_options',
			'consent-banner-customizer',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Initializes the settings.
	 */
	public function settings_init() {
		register_setting( 'consent_banner_options_group', 'consent_banner_settings' );

		// General Section for the entire consent banner.
		add_settings_section(
			'consent_banner_general_section',
			__( 'General Consent Banner Settings', 'ocean-ecommerce' ),
			null,
			'consent-banner-customizer'
		);

		// Button Section for consent banner button customization.
		add_settings_section(
			'consent_banner_allow_button_section',
			__( 'Allow Button Settings', 'ocean-ecommerce' ),
			null,
			'consent-banner-customizer'
		);

		// Button Section for consent banner button customization.
		add_settings_section(
			'consent_banner_deny_button_section',
			__( 'Deny Button Settings', 'ocean-ecommerce' ),
			null,
			'consent-banner-customizer'
		);

		// Fields for General Consent Banner Settings.
		$general_fields = array(
			array(
				'consent_banner_bg_color',
				__( 'Background Color', 'ocean-ecommerce' ),
				'color',
				'default' => '#2e3243',
			),
			array(
				'consent_banner_text_color',
				__( 'Text Color', 'ocean-ecommerce' ),
				'color',
				'default' => '#ffffff',
			),
			array(
				'consent_banner_border_radius',
				__( 'Border Radius', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 5px',
				'default'     => '0 4px 0 0',
			),
			array(
				'consent_banner_padding',
				__( 'Padding', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 10px',
				'default'     => '30px',
			),
			array(
				'consent_banner_width',
				__( 'Width', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 100%',
				'default'     => '400px',
			),
			array(
				'consent_banner_font_size',
				__( 'Font Size', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 14px',
				'default'     => '14px',
			),
			array(
				'consent_banner_main_text',
				__( 'Main Text', 'ocean-ecommerce' ),
				'textarea',
				'placeholder' => 'Enter the main text for the consent banner',
				'default'     => 'This site uses cookies and other tracking technologies to assist with navigation, analyze your use of our services, and provide content from third parties.',
			),
			array(
				'consent_banner_secondary_text',
				__( 'Secondary Text', 'ocean-ecommerce' ),
				'textarea',
				'placeholder' => 'Enter the secondary text for the consent banner',
				'default'     => 'By clicking "Accept" you agree to our use of cookies and other tracking technologies in accordance with our Privacy Policy.',
			),
		);

		// Fields for Consent Banner Allow Button Settings.
		$button_allow_fields = array(
			array(
				'consent_button_bg_color',
				__( 'Button Background Color', 'ocean-ecommerce' ),
				'color',
				'default' => '#135af4',
			),
			array(
				'consent_button_text_color',
				__( 'Button Text Color', 'ocean-ecommerce' ),
				'color',
				'default' => '#ffffff',
			),
			array(
                'consent_button_hover_bg_color',
                __( 'Button Hover Background Color', 'ocean-ecommerce' ),
                'color',
                'default' => '#0e4ac1',
            ),
            array(
                'consent_button_hover_text_color',
                __( 'Button Hover Text Color', 'ocean-ecommerce' ),
                'color',
                'default' => '#ffffff',
            ),			
			array(
				'consent_button_padding',
				__( 'Button Padding', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 10px',
				'default'     => '10px 20px',
			),
			array(
				'consent_button_border_radius',
				__( 'Button Border Radius', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 5px',
				'default'     => '5px',
			),
			array(
				'consent_button_text',
				__( 'Button Text', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'Enter the text for the allow button',
				'default'     => 'Accept',
			),
		);

		// Fields for Consent Banner Deny Button Settings.
		$button_deny_fields = array(
			array(
				'deny_button_bg_color',
				__( 'Deny Button Background Color', 'ocean-ecommerce' ),
				'color',
				'default' => '#dc3545',
			),
			array(
				'deny_button_color',
				__( 'Deny Text Color', 'ocean-ecommerce' ),
				'color',
				'default' => '#ffffff',
			),
			array(
                'deny_button_hover_bg_color',
                __( 'Deny Button Hover Background Color', 'ocean-ecommerce' ),
                'color',
                'default' => '#a71d2a',
            ),
            array(
                'deny_button_hover_text_color',
                __( 'Deny Button Hover Text Color', 'ocean-ecommerce' ),
                'color',
                'default' => '#ffffff',
            ),			
			array(
				'deny_button_padding',
				__( 'Deny Button Padding', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 10px',
				'default'     => '10px 20px',
			),
			array(
				'deny_button_border_radius',
				__( 'Deny Button Border Radius', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'e.g. 5px',
				'default'     => '5px',
			),
			array(
				'deny_button_text',
				__( 'Button Text', 'ocean-ecommerce' ),
				'text',
				'placeholder' => 'Enter the text for the deny button',
				'default'     => 'Deny',
			),
		);

		// Dynamically add fields for each section.
		$this->add_fields_to_section( $general_fields, 'consent_banner_general_section' );
		$this->add_fields_to_section( $button_allow_fields, 'consent_banner_allow_button_section' );
		$this->add_fields_to_section( $button_deny_fields, 'consent_banner_deny_button_section' );
	}

	/**
	 * Helper function to add fields to a given section.
	 */
	private function add_fields_to_section( $fields, $section ) {
		foreach ( $fields as $field ) {
			$args = array(
				'label_for' => $field[0],
				'type'      => $field[2],
				'default'   => $field['default'] ?? '',
			);

			if ( isset( $field[3] ) ) {
				if ( $field[2] === 'select' && is_array( $field[3] ) ) {
					$args['options'] = $field[3];
				} elseif ( $field[2] === 'text' || $field[2] === 'textarea' ) {
					if ( isset( $field[3]['placeholder'] ) ) {
						$args['placeholder'] = $field[3]['placeholder'];
					}
				} elseif ( is_array( $field[3] ) ) {
					foreach ( $field[3] as $key => $value ) {
						$args[ $key ] = $value;
					}
				}
			}

			add_settings_field(
				$field[0],
				$field[1],
				array( $this, 'render_field_callback' ),
				'consent-banner-customizer',
				$section,
				$args
			);
		}
	}

	/**
	 * Callback for rendering fields.
	 */
	public function render_field_callback( $args ) {
		$options = get_option( 'consent_banner_settings' );
		$value   = $options[ $args['label_for'] ] ?? $args['default'];
		$type    = $args['type'];

		switch ( $type ) {
			case 'color':
				echo "<input type='text' class='color-picker' id='" . esc_attr( $args['label_for'] ) . "' name='consent_banner_settings[" . esc_attr( $args['label_for'] ) . "]' value='" . esc_attr( $value ) . "' />";
				break;

			case 'text':
				$placeholder = $args['placeholder'] ?? '';
				echo "<input type='text' id='" . esc_attr( $args['label_for'] ) . "' name='consent_banner_settings[" . esc_attr( $args['label_for'] ) . "]' value='" . esc_attr( $value ) . "' placeholder='" . esc_attr( $placeholder ) . "' />";
				break;

			case 'textarea':
				$placeholder = $args['placeholder'] ?? '';
				echo "<textarea id='" . esc_attr( $args['label_for'] ) . "' name='consent_banner_settings[" . esc_attr( $args['label_for'] ) . "]' placeholder='" . esc_attr( $placeholder ) . "' rows='4' cols='60'>" . esc_textarea( $value ) . '</textarea>';
				break;
		}
	}

	/**
	 * Renders the settings page.
	 */
	public function render_settings_page() {

		$options           = get_option( 'consent_banner_settings' );
		$main_text         = $options['consent_banner_main_text'] ?? __( 'This site uses cookies and other tracking technologies to assist with navigation, analyze your use of our services, and provide content from third parties. ', 'ocean-ecommerce' );
		$secondary_text    = $options['consent_banner_secondary_text'] ?? __( 'By clicking "Accept" you agree to our use of cookies and other tracking technologies in accordance with our Privacy Policy.', 'ocean-ecommerce' );
		$allow_button_text = $options['consent_button_text'] ?? __( 'Accept', 'ocean-ecommerce' );
		$deny_button_text  = $options['deny_button_text'] ?? __( 'Deny', 'ocean-ecommerce' );

		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Consent Banner Settings', 'ocean-ecommerce' ); ?></h1>
			<div class="consent-banner-settings-flex-wrapper">
				<div class="consent-banner-settings-column">
						<form method="post" action="options.php">
							<?php
							settings_fields( 'consent_banner_options_group' );
							do_settings_sections( 'consent-banner-customizer' );
							?>

							<div style="display: flex; justify-content: space-between; align-items: center; width: fit-content;margin-top: 50px;column-gap: 50px;">
								<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
								<input type="submit" name="consent_banner_reset_defaults" class="button button-secondary" value="Reset to Defaults" onclick="return confirm('Are you sure you want to reset to defaults? All changes will be lost.');">
							</div>
						</form>
				</div>
	
				<div class="consent-banner-preview-column">
					<h2 class="live-preview-heading"><?php echo esc_html__( 'Live Preview', 'ocean-ecommerce' ); ?></h2>
					<div id="consent-banner-preview-wrapper">
					<div class="consent-banner">
						<p><?php echo esc_html__( $main_text ); ?></p>
						<p><?php echo esc_html__( $secondary_text ); ?></p>
						<div class="consent-button-wrapper">
							<button id="acceptConsentButton" class="button allow"><?php echo esc_html( $allow_button_text ); ?></button>
							<button id="denyConsentButton" class="button deny"><?php echo esc_html( $deny_button_text ); ?></button>
						</div>
					</div>
					</div>  
				</div>  
			</div>
		</div>	
		<?php
	}

	/**
	 * Handle the reset to default settings action.
	 */
	public function handle_reset_to_defaults() {
		if ( current_user_can( 'manage_options' ) && isset( $_POST['consent_banner_reset_defaults'] ) ) {
			delete_option( 'consent_banner_settings' );
			add_option( 'consent_banner_reset_notice', 'true' );
			wp_safe_redirect( add_query_arg( array( 'page' => 'consent-banner-customizer' ), admin_url( 'admin.php' ) ) );
			exit;
		}
	}

	/**
	 * Display admin notices for confirmation of reset.
	 */
	public function admin_notices() {
		if ( get_option( 'consent_banner_reset_notice' ) ) {
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Settings have been reset to defaults.', 'ocean-ecommerce' ) . '</p></div>';
			delete_option( 'consent_banner_reset_notice' );
		}
	}

	/**
	 * Enqueues scripts and styles.
	 *
	 * @param string $hook The current admin page hook.
	 */
	public function enqueue_scripts( $hook ) {
		if ( 'oceanwp_page_consent-banner-customizer' !== $hook ) {
			return;
		}

		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'coupon-customizer-script', $this->get_assets_url( '/consent-banner-customizer.js', 'js' ), array( 'jquery', 'wp-color-picker' ), OPD_VERSION, true );
		wp_enqueue_style( 'coupon-customizer-style', $this->get_assets_url( '/consent-banner-customizer.css', 'css' ), array(), OPD_VERSION );
	}


	/**
	 * Get the URL for the assets.
	 *
	 * @param string $file     The file name.
	 * @param string $css_js   CSS or JS.
	 *
	 * @return string
	 */
	public function get_assets_url( $file = '', $css_js = '' ) {
		return untrailingslashit( OPD_URL . 'modules/pixel-tracker/visual-customizer/assets/' . $css_js ) . $file;
	}

	/**
	 * Outputs the inline styles for the consent banner.
	 */
	public function output_inline_styles() {
		$options = get_option( 'consent_banner_settings' );

		$bg_color      = $options['consent_banner_bg_color'] ?? '#2e3243';
		$text_color    = $options['consent_banner_text_color'] ?? '#ffffff';
		$border_radius = $options['consent_banner_border_radius'] ?? '0 4px 0 0';
		$padding       = $options['consent_banner_padding'] ?? '30px';
		$width         = $options['consent_banner_width'] ?? '400px';
		$font_size     = $options['consent_banner_font_size'] ?? '14px';

		$button_bg_color      = $options['consent_button_bg_color'] ?? '#135af4';
		$button_text_color    = $options['consent_button_text_color'] ?? '#ffffff';
		$button_padding       = $options['consent_button_padding'] ?? '10px 20px';
		$button_border_radius = $options['consent_button_border_radius'] ?? '5px';
		$button_hover_bg_color = $options['consent_button_hover_bg_color'] ?? '#0e4ac1';
        $button_hover_text_color = $options['consent_button_hover_text_color'] ?? '#ffffff';

		$deny_button_bg_color      = $options['deny_button_bg_color'] ?? '#dc3545';
		$deny_button_color         = $options['deny_button_color'] ?? '#ffffff';
		$deny_button_padding       = $options['deny_button_padding'] ?? '10px 20px';
		$deny_button_border_radius = $options['deny_button_border_radius'] ?? '5px';
		$deny_button_hover_bg_color = $options['deny_button_hover_bg_color'] ?? '#a71d2a';
        $deny_button_hover_text_color = $options['deny_button_hover_text_color'] ?? '#ffffff';

		echo "<style>
            .consent-banner {
                background-color: {$bg_color};
                color: {$text_color};
                border-radius: {$border_radius};
                padding: {$padding};
                width: {$width};
                font-size: {$font_size};
            }
            .consent-banner p{
                font-size: {$font_size};
            }
            .consent-banner button.allow {
                background-color: {$button_bg_color};
                color: {$button_text_color};
                padding: {$button_padding};
                border-radius: {$button_border_radius};
            }
            .consent-banner button.allow:hover {
                background-color: {$button_hover_bg_color};
                color: {$button_hover_text_color};
            }	
            .consent-banner button.deny {
                background-color: {$deny_button_bg_color};
                color: {$deny_button_color};
                padding: {$deny_button_padding};
                border-radius: {$deny_button_border_radius};
            }
			.consent-banner button.deny:hover {
                background-color: {$deny_button_hover_bg_color};
                color: {$deny_button_hover_text_color};
            }
        </style>";
	}
}

$oec_consent_banner_customizer = new OPD_ConsentBannerCustomizer();
