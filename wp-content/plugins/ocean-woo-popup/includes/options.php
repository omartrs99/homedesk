<?php
/**
 * OceanWP Customizer Class: Woo Popup
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function ocean_woo_popup_customizer_options() {

	$options = [
		'title'    => esc_html__( 'Woo Popup', 'ocean-woo-popup' ),
		'priority' => 14,
		'options'  => [
			'owp_popup_display' => [
				'id'                => 'owp_popup_display',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Display Popup While Customizing', 'ocean-woo-popup' ),
				'desc'              => esc_html__( 'This option enables you to display and preview the popup while customizing.', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'default'           => '',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'on' => [
						'id'      => 'on',
						'label'   => esc_html__( 'Show Preview', 'ocean-woo-popup' ),
						'content' => esc_html__( 'Show Preview', 'ocean-woo-popup' ),
					],
					'off' => [
						'id'      => 'off',
						'label'   => esc_html__( 'Close', 'ocean-woo-popup' ),
						'content' => esc_html__( 'Close', 'ocean-woo-popup' ),
					]
				]
			],

			'owp_woo_popup_title_for_default_popup_content' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Default Popup Content', 'ocean-woo-popup' ),
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'owp_popup_elements_positioning' => [
				'label'     => esc_html__( 'Content Builder',  'ocean-woo-popup' ),
				'type'      => 'ocean-sortable',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'refresh',
				'priority'  => 10,
				'default'   => [ 'title', 'content', 'buttons', 'bottom_text' ],
				'hideLabel' => false,
				'choices'   => owp_popup_elements(),
				'sanitize_callback' => 'ocean_sanitize_sortable_control',
			],

			'owp_divider_after_woo_popup_elements_positioning_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 10
			],

			'owp_popup_title_text' => [
				'label'             => esc_html__( 'Title Text', 'ocean-woo-popup' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Item successfully added to your cart', 'ocean-woo-popup' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
			],

			'owp_spacer_before_content_text' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_content' => [
				'type'              => 'ocean-textarea',
				'label'             => esc_html__( 'Content',  'ocean-woo-popup' ),
				'desc'              => sprintf( esc_html__( 'Shortcodes allowed, %1$ssee the list%2$s.', 'ocean-woo-popup' ), '<a href="https://docs.oceanwp.org/category/369-shortcodes" target="_blank">', '</a>' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'default'           => esc_html__( '[oceanwp_woo_cart_items] items in your cart ([oceanwp_woo_total_cart])', 'ocean-woo-popup' ),
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
			],

			'owp_divider_after_woo_popup_content_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
			],

			'owp_popup_continue_btn_text' => [
				'label'             => esc_html__( 'Continue Button Text', 'ocean-woo-popup' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Continue Shopping', 'ocean-woo-popup' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			],

			'owp_spacer_before_cart_btn_text' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_cart_btn_text' => [
				'label'             => esc_html__( 'Go Cart Button Text', 'ocean-woo-popup' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'View Cart', 'ocean-woo-popup' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			],

			'owp_divider_after_woo_popup_cart_btn_text_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
			],

			'owp_popup_bottom_text' => [
				'label'             => esc_html__( 'Bottom Text', 'ocean-woo-popup' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'default'           => esc_html__( '[oceanwp_woo_free_shipping_left]', 'ocean-woo-popup' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
			],

			'owp_woo_popup_title_for_custom_popup_content' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Custom Popup Content', 'ocean-woo-popup' ),
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'owp_popup_template' => [
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Custom Template Select', 'ocean-woo-popup' ),
				'desc'              => esc_html__( 'Select a custom template you created in OceanWP > My Library.', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'refresh',
				'default'           => '0',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'choices'           => oceanwp_library_template_choices(),
				'sanitize_callback' => 'sanitize_key',
			],

			'owp_woo_popup_title_for_styling_content' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Styling and Colors', 'ocean-woo-popup' ),
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'owp_popup_width' => [
				'id'                => 'owp_popup_width',
				'label'             => esc_html__( 'Width (px)', 'ocean-woo-popup' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => true,
				'min'               => 10,
				'max'               => 5000,
				'step'              => 1,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'owp_popup_width',
						'label' => esc_html__( 'Desktop', 'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 600,
						],
					],
					'tablet' => [
						'id'    => 'owp_popup_width_tablet',
						'label' => esc_html__( 'Tablet', 'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'mobile' => [
						'id'    => 'owp_popup_width_mobile',
						'label' => esc_html__( 'Mobile', 'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'#woo-popup-wrap #woo-popup-inner' => ['width']
				]
			],

			'owp_spacer_before_popup_height' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_height' => [
				'id'                => 'owp_popup_height',
				'label'             => esc_html__( 'Height (px)', 'ocean-woo-popup' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => true,
				'min'               => 10,
				'max'               => 5000,
				'step'              => 1,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'owp_popup_height',
						'label' => esc_html__( 'Desktop', 'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 600,
						],
					],
					'tablet' => [
						'id'    => 'owp_popup_height_tablet',
						'label' => esc_html__( 'Tablet', 'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'mobile' => [
						'id'    => 'owp_popup_height_mobile',
						'label' => esc_html__( 'Mobile', 'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'#woo-popup-wrap #woo-popup-inner' => ['height']
				]
			],

			'owp_divider_after_woo_popup_popup_height_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 5,
				'bottom'    => 30,
			],

			'owp_popup_padding_dimensions' => [
				'id'           => 'owp_popup_padding_dimensions',
				'label'        => esc_html__( 'Padding (px)',  'ocean-woo-popup' ),
				'type'         => 'ocean-spacing',
				'section'      => 'ocean_woo_popup_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'isType'       => 'padding',
				'setting_args' => [
					'spacingTop' => [
						'id'    => 'owp_popup_top_padding',
						'label' => esc_html__( 'Top',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 50,
						],
					],
					'spacingRight' => [
						'id'    => 'owp_popup_right_padding',
						'label' => esc_html__( 'Right',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 25
						],
					],
					'spacingBottom' => [
						'id'    => 'owp_popup_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 50,
						],
					],
					'spacingLeft' => [
						'id'    => 'owp_popup_left_padding',
						'label' => esc_html__( 'Left',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 25,
						],
					],
					'spacingTopTablet' => [
						'id'    => 'owp_popup_tablet_top_padding',
						'label' => esc_html__( 'Top',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					],
					'spacingRightTablet' => [
						'id'    => 'owp_popup_tablet_right_padding',
						'label' => esc_html__( 'Right',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'owp_popup_tablet_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					],
					'spacingLeftTablet' => [
						'id'    => 'owp_popup_tablet_left_padding',
						'label' => esc_html__( 'Left',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					],
					'spacingTopMobile' => [
						'id'    => 'owp_popup_mobile_top_padding',
						'label' => esc_html__( 'Top',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightMobile' => [
						'id'    => 'owp_popup_mobile_right_padding',
						'label' => esc_html__( 'Right',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'owp_popup_mobile_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftMobile' => [
						'id'    => 'owp_popup_mobile_left_padding',
						'label' => esc_html__( 'Left',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => '#woo-popup-wrap #woo-popup-inner',
					'property' => 'padding',
				]
			],

			'owp_spacer_before_border_radius' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_radius_dimensions' => [
				'id'           => 'owp_popup_radius_dimensions',
				'label'        => esc_html__( 'Border Radius (px)',  'ocean-woo-popup' ),
				'type'         => 'ocean-spacing',
				'section'      => 'ocean_woo_popup_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'isType'       => 'border-radius',
				'setting_args' => [
					'spacingTop' => [
						'id'    => 'owp_popup_top_radius',
						'label' => esc_html__( 'Top',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default' => 600,
						],
					],
					'spacingRight' => [
						'id'    => 'owp_popup_right_radius',
						'label' => esc_html__( 'Right',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default' => 600,
						],
					],
					'spacingBottom' => [
						'id'    => 'owp_popup_bottom_radius',
						'label' => esc_html__( 'Bottom',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default' => 600,
						],
					],
					'spacingLeft' => [
						'id'    => 'owp_popup_left_radius',
						'label' => esc_html__( 'Left',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default' => 600,
						],
					],
					'spacingTopTablet' => [
						'id'    => 'owp_popup_tablet_top_radius',
						'label' => esc_html__( 'Top',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightTablet' => [
						'id'    => 'owp_popup_tablet_right_radius',
						'label' => esc_html__( 'Right',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'owp_popup_tablet_bottom_radius',
						'label' => esc_html__( 'Bottom',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftTablet' => [
						'id'    => 'owp_popup_tablet_left_radius',
						'label' => esc_html__( 'Left',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopMobile' => [
						'id'    => 'owp_popup_mobile_top_radius',
						'label' => esc_html__( 'Top',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightMobile' => [
						'id'    => 'owp_popup_mobile_right_radius',
						'label' => esc_html__( 'Right',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'owp_popup_mobile_right_radius',
						'label' => esc_html__( 'Bottom',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftMobile' => [
						'id'    => 'owp_popup_mobile_left_radius',
						'label' => esc_html__( 'Left',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => '#woo-popup-wrap #woo-popup-inner',
					'property' => 'border-radius'
				],
			],

			'owp_divider_after_woo_popup_radius_dimensions_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Popup Background',  'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color',  'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap #woo-popup-inner' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'owp_popup_overlay_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Background Overlay',  'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_overlay_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color',  'ocean-woo-popup' ),
						'selector' => [
							'#side-panel-wrap,#side-panel-wrap p,#side-panel-wrap #wp-calendar caption,#side-panel-wrap #wp-calendar th,#side-panel-wrap #wp-calendar td' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#000000',
						],
					]
				]
			],

			'owp_divider_after_woo_popup_overlay_color_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_checkmark_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Check Mark Background',  'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'    => 'owp_popup_checkmark_bg',
						'key'   => 'normal',
						'label' => esc_html__( 'Select Color',  'ocean-woo-popup' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => '#5bc142',
						],
					]
				]
			],

			'owp_popup_checkmark_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Check Mark Icon',  'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_checkmark_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color',  'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .checkmark-check' => 'stroke'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'owp_divider_after_check_mark_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_title_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Title',  'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_title_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color',  'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .popup-title' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#333333',
						],
					]
				]
			],

			'owp_popup_content_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Content',  'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_content_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color',  'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .popup-content' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#777777',
						],
					]
				]
			],

			'owp_divider_after_woo_popup_content_color_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_continue_btn_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Continue Button Background', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_continue_btn_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.continue-btn' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					],
					'hover' => [
						'id'       => 'owp_popup_continue_btn_hover_bg',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.continue-btn:hover' => 'background-color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					]
				]
			],

			'owp_popup_continue_btn_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Continue Button Text', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_continue_btn_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.continue-btn' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					],
					'hover' => [
						'id'       => 'owp_popup_continue_btn_hover_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.continue-btn:hover' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'owp_popup_continue_btn_border_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Continue Button Border', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_continue_btn_border_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.continue-btn' => 'border-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					],
					'hover' => [
						'id'       => 'owp_popup_continue_btn_hover_border_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.continue-btn:hover' => 'border-color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					]
				]
			],

			'owp_divider_after_woo_popup_continue_btn_border_color_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_cart_btn_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Cart Button Background', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_cart_btn_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.cart-btn' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					],
					'hover' => [
						'id'       => 'owp_popup_cart_btn_hover_bg',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.cart-btn:hover' => 'background-color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#41c389',
						],
					]
				]
			],

			'owp_popup_cart_btn_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Cart Button Text', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_cart_btn_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.cart-btn' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#41c389',
						],
					],
					'hover' => [
						'id'       => 'owp_popup_cart_btn_hover_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.cart-btn:hover' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'owp_popup_cart_btn_border_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Cart Button Border', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_cart_btn_border_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.cart-btn' => 'border-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#41c389',
						],
					],
					'hover' => [
						'id'       => 'owp_popup_cart_btn_hover_border_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .buttons-wrap a.cart-btn:hover' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					]
				]
			],

			'owp_divider_after_woo_popup_cart_btn_border_color_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'owp_popup_text_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Bottom Text', 'ocean-woo-popup' ),
				'section'           => 'ocean_woo_popup_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'owp_popup_text_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-woo-popup' ),
						'selector' => [
							'#woo-popup-wrap .popup-text' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#777777',
						],
					]
				]
			],

			'owp_popup_content_for_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-woo-popup' ), '<a href="https://docs.oceanwp.org/article/920-customizer-woo-popup/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_woo_popup_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],
		]
	];

	return apply_filters( 'ocean_woo_popup_customizer_options', $options );
}
