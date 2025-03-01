<?php
/**
 * OceanWP Customizer Class: Cookie Notice
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function ocn_customizer_options() {

	$options = [
		'title'    => esc_html__( 'Cookie Notice', 'ocean-cookie-notice' ),
		'priority' => 14,
		'options'  => [
			'ocn_content' => [
				'type'              => 'ocean-textarea',
				'label'             => esc_html__( 'Content', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'default'           => esc_html__( 'By continuing to use this website, you consent to the use of cookies in accordance with our Cookie Policy.', 'ocean-cookie-notice' ),
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
			],

			'ocn_title_for_close_button' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Close Button', 'ocean-cookie-notice' ),
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ocn_target' => [
				'id'                => 'ocn_target',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Close Target', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'default'           => 'button',
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'button'  => [
						'id'      => 'button',
						'label'   => esc_html__( 'Button', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'Button', 'ocean-cookie-notice' ),
					],
					'close'  => [
						'id'      => 'close',
						'label'   => esc_html__( 'Close Icon', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'Close Icon', 'ocean-cookie-notice' ),
					]
				]
			],

			'ocn_button_text' => [
				'label'             => esc_html__( 'Button Text', 'ocean-cookie-notice' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_cookie_notice_settings',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Accept', 'ocean-cookie-notice' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'ocn_cac_has_btn_target',
			],

			'ocn_title_for_appearance_and_style' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Appearance and Style', 'ocean-cookie-notice' ),
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ocn_style' => [
				'id'                => 'ocn_style',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Notice Layout Style', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'default'           => 'flyin',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'flyin'  => [
						'id'      => 'flyin',
						'label'   => esc_html__( 'Fly-Ins', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'Fly-Ins', 'ocean-cookie-notice' ),
					],
					'floating'  => [
						'id'      => 'floating',
						'label'   => esc_html__( 'Floating Bar', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'Floating Bar', 'ocean-cookie-notice' ),
					]
				]
			],

			'ocn_divider_after_style_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 1,
				'bottom'    => 10,
			],

			'ocn_overlay' => [
				'id'                => 'ocn_overlay',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Display Overlay', 'ocean-cookie-notice' ),
				'desc'              => esc_html__( 'Display an overlay that prevents the website usage until user consents.', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'default'           => 'no',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'yes'  => [
						'id'      => 'yes',
						'label'   => esc_html__( 'Yes', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'Yes', 'ocean-cookie-notice' ),
					],
					'no'  => [
						'id'      => 'no',
						'label'   => esc_html__( 'No', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'No', 'ocean-cookie-notice' ),
					]
				]
			],

			'ocn_title_for_notice_behaviour' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Notice Behavior', 'ocean-cookie-notice' ),
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ocn_expiry' => [
				'id'                => 'ocn_expiry',
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Cookie Expiration', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'transport'         => 'postMessage',
				'default'           => '1month',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'1hour'    => esc_html__( 'An Hour', 'ocean-cookie-notice' ),
					'1day'     => esc_html__( '1 day', 'ocean-cookie-notice' ),
					'1week'    => esc_html__( '1 Week', 'ocean-cookie-notice' ),
					'1month'   => esc_html__( '1 Month', 'ocean-cookie-notice' ),
					'3months'  => esc_html__( '3 Months', 'ocean-cookie-notice' ),
					'6months'  => esc_html__( '6 Months', 'ocean-cookie-notice' ),
					'1year'    => esc_html__( '1 Year', 'ocean-cookie-notice' ),
					'infinity' => esc_html__( 'Infinity', 'ocean-cookie-notice' ),
				]
			],

			'ocn_divider_after_expiry_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 10,
			],

			'ocn_reload' => [
				'id'               => 'ocn_reload',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Reload After Consent', 'ocean-cookie-notice' ),
				'desc'              => esc_html__( 'Reload the page after the user consent.', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'default'           => 'no',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'yes'  => [
						'id'      => 'yes',
						'label'   => esc_html__( 'Yes', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'Yes', 'ocean-cookie-notice' ),
					],
					'no'  => [
						'id'      => 'no',
						'label'   => esc_html__( 'No', 'ocean-cookie-notice' ),
						'content' => esc_html__( 'No', 'ocean-cookie-notice' ),
					]
				]
			],

			'ocn_divider_after_notice_reload_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
			],

			'ocn_scripts_section' => [
				'type'     => 'section',
				'title'    => esc_html__( 'Scripts', 'ocean-cookie-notice' ),
				'section'  => 'ocean_cookie_notice_settings',
				'after'    => 'ocn_divider_after_notice_reload_setting',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'ocn_head_scripts' => [
						'label'             => esc_html__( 'Head (before the closing head tag)', 'ocean-cookie-notice' ),
						'desc'              => esc_html__( 'Insert JavaScript code for cookies here. These cookies will be used only after users consent.', 'ocean-cookie-notice' ),
						'type'              => 'ocean-textarea',
						'section'           => 'ocn_scripts_section',
						'transport'         => 'postMessage',
						'default'           => '',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => false,
					],

					'ocn_body_scripts' => [
						'label'             => esc_html__( 'Body (before the closing body tag)', 'ocean-cookie-notice' ),
						'desc'              => esc_html__( 'Insert JavaScript code for cookies here. These cookies will be used only after users consent.', 'ocean-cookie-notice' ),
						'type'              => 'ocean-textarea',
						'section'           => 'ocn_scripts_section',
						'transport'         => 'postMessage',
						'default'           => '',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => false,
					]
				]
			],

			'ocn_title_for_styling_typography_and_colors' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Cookie Notice Styling', 'ocean-cookie-notice' ),
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ocn_width' => [
				'id'                => 'ocn_width',
				'label'             => esc_html__( 'Max Width (px)', 'ocean-cookie-notice' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_cookie_notice_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => false,
				'min'               => 100,
				'max'               => 2000,
				'step'              => 1,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'ocn_width',
						'label' => esc_html__( 'Desktop', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					]
				],
				'preview' => 'queryWithType',
				'css'     => [
					'#ocn-cookie-wrap.flyin, #ocn-cookie-wrap.floating #ocn-cookie-inner' => ['width'],
				]
			],

			'ocn_padding_dimensions' => [
				'id'           => 'ocn_padding_dimensions',
				'label'        => esc_html__( 'Padding (px)', 'ocean-cookie-notice' ),
				'type'         => 'ocean-spacing',
				'section'      => 'ocean_cookie_notice_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'isType'       => 'padding',
				'setting_args' => [
					'spacingTop' => [
						'id'    => 'ocn_top_padding',
						'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRight' => [
						'id'    => 'ocn_right_padding',
						'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottom' => [
						'id'    => 'ocn_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeft' => [
						'id'    => 'ocn_left_padding',
						'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopTablet' => [
						'id'    => 'ocn_tablet_top_padding',
						'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightTablet' => [
						'id'    => 'ocn_tablet_right_padding',
						'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'ocn_tablet_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftTablet' => [
						'id'    => 'ocn_tablet_left_padding',
						'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopMobile' => [
						'id'    => 'ocn_mobile_top_padding',
						'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightMobile' => [
						'id'    => 'ocn_mobile_right_padding',
						'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'ocn_mobile_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftMobile' => [
						'id'    => 'ocn_mobile_left_padding',
						'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => '#ocn-cookie-wrap.flyin,#ocn-cookie-wrap.floating',
					'property' => 'padding',
				]
			],

			'ocn_divider_after_padding_dimensions' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 1,
				'bottom'    => 10,
			],

			'ocn_background' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Background Color', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'ocn_background',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-cookie-notice' ),
						'selector' => [
							'#ocn-cookie-wrap' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'ocn_divider_after_background_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 1,
				'bottom'    => 10,
			],

			'ocn_content_typo' => [
				'id'           => 'ocn_content_typo',
				'type'         => 'ocean-typography',
				'label'        => esc_html__( 'Content Text', 'ocean-cookie-notice' ),
				'section'      => 'ocean_cookie_notice_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'selector'     => '#ocn-cookie-wrap .ocn-cookie-content',
				'setting_args' => [
					'fontFamily' => [
						'id'    => 'ocn_content_typo_font_family',
						'label' => esc_html__( 'Font Family', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontWeight' => [
						'id'    => 'ocn_content_typo_font_weight',
						'label' => esc_html__( 'Font Weight', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontWeightTablet' => [
						'id'    => 'ocn_content_typo_font_weight_tablet',
						'label' => esc_html__( 'Font Weight', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontWeightMobile' => [
						'id'    => 'ocn_content_typo_font_weight_mobile',
						'label' => esc_html__( 'Font Weight', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSubset' => [
						'id'    => 'ocn_content_typo_font_subset',
						'label' => esc_html__( 'Font Subset', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSize' => [
						'id'    => 'ocn_content_typo_font_size',
						'label' => esc_html__( 'Font Size', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 15,
						],
					],
					'fontSizeTablet' => [
						'id'    => 'ocn_content_typo_font_size_tablet',
						'label' => esc_html__( 'Font Size', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSizeMobile' => [
						'id'    => 'ocn_content_typo_font_size_mobile',
						'label' => esc_html__( 'Font Size', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSizeUnit' => [
						'id'    => 'ocn_content_typo_font_size_unit',
						'label' => esc_html__( 'Unit', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 'px',
						],
					],
					'letterSpacing' => [
						'id'    => 'ocn_content_typo_spacing',
						'label' => esc_html__( 'Letter Spacing', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'letterSpacingTablet' => [
						'id'    => 'ocn_content_typo_spacing_tablet',
						'label' => esc_html__( 'Letter Spacing', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'letterSpacingMobile' => [
						'id'    => 'ocn_content_typo_spacing_mobile',
						'label' => esc_html__( 'Letter Spacing', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'letterSpacingUnit' => [
						'id'    => 'ocn_content_typo_spacing_unit',
						'label' => esc_html__( 'Unit', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 'px',
						],
					],
					'lineHeight' => [
						'id'    => 'ocn_content_typo_line_height',
						'label' => esc_html__( 'Line Height', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'lineHeightTablet' => [
						'id'    => 'ocn_content_typo_line_height_tablet',
						'label' => esc_html__( 'Line Height', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'lineHeightMobile' => [
						'id'    => 'ocn_content_typo_line_height_mobile',
						'label' => esc_html__( 'Line Height', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'lineHeightUnit' => [
						'id'    => 'ocn_content_typo_line_height_unit',
						'label' => esc_html__( 'Unit', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textTransform' => [
						'id'    => 'ocn_content_typo_transform',
						'label' => esc_html__( 'Text Transform', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textTransformTablet' => [
						'id'    => 'ocn_content_typo_transform_tablet',
						'label' => esc_html__( 'Text Transform', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textTransformMobile' => [
						'id'    => 'ocn_content_typo_transform_mobile',
						'label' => esc_html__( 'Text Transform', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textDecoration' => [
						'id'    => 'ocn_content_typo_text_decoration',
						'label' => esc_html__( 'Text Decoration', 'ocean-cookie-notice' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				]
			],

			'ocn_text_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Content Text Color', 'ocean-cookie-notice' ),
				'section'           => 'ocean_cookie_notice_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'ocn_text_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-cookie-notice' ),
						'selector' => [
							'#ocn-cookie-wrap' => 'color'
						],
						'attr'    => [
							'transport' => 'postMessage',
							'default'   => '#777777',
						],
					]
				]
			],

			'ocn_divider_for_additional_styling_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
			],

			'ocn_additional_styling_section' => [
				'type'     => 'section',
				'title'    => esc_html__( 'Additional Styling', 'ocean-cookie-notice' ),
				'section'  => 'ocean_cookie_notice_settings',
				'after'    => 'ocn_divider_for_additional_styling_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'ocn_border_width' => [
						'id'                => 'ocn_border_width',
						'label'             => esc_html__( 'Border Width (px)', 'ocean-cookie-notice' ),
						'type'              => 'ocean-range-slider',
						'section'           => 'ocn_additional_styling_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'isUnit'            => false,
						'isResponsive'      => false,
						'min'               => 1,
						'max'               => 100,
						'step'              => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args'      => [
							'desktop' => [
								'id'    => 'ocn_border_width',
								'label' => esc_html__( 'Desktop', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							]
						],
						'preview' => 'queryWithType',
						'css'     => [
							'#ocn-cookie-wrap' => ['border-width'],
						]
					],

					'ocn_border_style' => [
						'id'                => 'ocn_border_style',
						'type'              => 'ocean-select',
						'label'             => esc_html__( 'Border Style', 'ocean-cookie-notice' ),
						'section'           => 'ocn_additional_styling_section',
						'transport'         => 'postMessage',
						'default'           => 'none',
						'priority'          => 10,
						'hideLabel'         => false,
						'multiple'          => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'none'   => esc_html__( 'None', 'ocean-cookie-notice' ),
							'solid'  => esc_html__( 'Solid', 'ocean-cookie-notice' ),
							'double' => esc_html__( 'Double', 'ocean-cookie-notice' ),
							'dotted' => esc_html__( 'Dotted', 'ocean-cookie-notice' ),
							'dashed' => esc_html__( 'Dashed', 'ocean-cookie-notice' ),
							'groove' => esc_html__( 'Groove', 'ocean-cookie-notice' ),
						],
						'preview' => 'queryWithAttr',
						'css'     => [
							'selector' => '#ocn-cookie-wrap',
							'property' => 'border-style'
						]
					],

					'ocn_spacer_before_border_color' => [
						'type'      => 'ocean-spacer',
						'section'   => 'ocn_additional_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'ocn_border_color' => [
						'type'              => 'ocean-color',
						'label'             => esc_html__( 'Border Color', 'ocean-cookie-notice' ),
						'section'           => 'ocn_additional_styling_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'showAlpha'         => true,
						'showPalette'       => true,
						'sanitize_callback' => 'wp_kses_post',
						'setting_args'      => [
							'normal' => [
								'id'       => 'ocn_border_color',
								'key'      => 'normal',
								'label'    => esc_html__( 'Select Color', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap' => 'border-color'
								],
								'attr'     => [
									'transport' => 'postMessage',
								],
							]
						]
					],

					'ocn_divider_after_button_text_setting' => [
						'type'            => 'ocean-divider',
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'top'             => 10,
						'active_callback' => 'ocn_cac_has_close_target',
					],

					'ocn_close_color' => [
						'type'              => 'ocean-color',
						'label'             => esc_html__( 'Close Icon Color', 'ocean-cookie-notice' ),
						'section'           => 'ocn_additional_styling_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'showAlpha'         => true,
						'showPalette'       => true,
						'active_callback'   => 'ocn_cac_has_close_target',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args'      => [
							'normal' => [
								'id'       => 'ocn_close_color',
								'key'      => 'normal',
								'label'    => esc_html__( 'Normal', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap .ocn-icon svg' => 'fill'
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#777777',
								],
							],
							'hover' => [
								'id'       => 'ocn_close_hover_color',
								'key'      => 'hover',
								'label'    => esc_html__( 'Hover', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap .ocn-icon:hover svg' => 'fill',
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#333333',
								],
							]
						]
					],

					'ocn_title_button_styling' => [
						'type'            => 'ocean-title',
						'label'           => esc_html__( 'Button', 'ocean-cookie-notice' ),
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'active_callback' => 'ocn_cac_has_btn_target',
					],

					'ocn_spacer_before_button_padding' => [
						'type'      => 'ocean-spacer',
						'section'   => 'ocn_additional_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'ocn_btn_padding_dimensions' => [
						'id'              => 'ocn_btn_padding_dimensions',
						'label'           => esc_html__( 'Padding (px)', 'ocean-cookie-notice' ),
						'type'            => 'ocean-spacing',
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'hideLabel'       => false,
						'isType'          => 'padding',
						'active_callback' => 'ocn_cac_has_btn_target',
						'setting_args'    => [
							'spacingTop' => [
								'id'    => 'ocn_btn_top_padding',
								'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingRight' => [
								'id'    => 'ocn_btn_right_padding',
								'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottom' => [
								'id'    => 'ocn_btn_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeft' => [
								'id'    => 'ocn_btn_left_padding',
								'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopTablet' => [
								'id'    => 'ocn_btn_tablet_top_padding',
								'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightTablet' => [
								'id'    => 'ocn_btn_tablet_right_padding',
								'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomTablet' => [
								'id'    => 'ocn_btn_tablet_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftTablet' => [
								'id'    => 'ocn_btn_tablet_left_padding',
								'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopMobile' => [
								'id'    => 'ocn_btn_mobile_top_padding',
								'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightMobile' => [
								'id'    => 'ocn_btn_mobile_right_padding',
								'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomMobile' => [
								'id'    => 'ocn_btn_mobile_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftMobile' => [
								'id'    => 'ocn_btn_mobile_left_padding',
								'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
						],
						'preview' => 'queryWithType',
						'css'     => [
							'selector' => '#ocn-cookie-wrap .ocn-btn',
							'property' => 'padding',
						]
					],

					'ocn_spacer_before_button_radius' => [
						'type'      => 'ocean-spacer',
						'section'   => 'ocn_additional_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'ocn_btn_border_radius_dimensions' => [
						'id'              => 'ocn_btn_border_radius_dimensions',
						'label'           => esc_html__( 'Border Radius (px)', 'ocean-cookie-notice' ),
						'type'            => 'ocean-spacing',
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'hideLabel'       => false,
						'isType'          => 'border-radius',
						'active_callback' => 'ocn_cac_has_btn_target',
						'setting_args'    => [
							'spacingTop' => [
								'id'    => 'ocn_btn_top_border_radius',
								'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingRight' => [
								'id'    => 'ocn_btn_right_border_radius',
								'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottom' => [
								'id'    => 'ocn_btn_bottom_border_radius',
								'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeft' => [
								'id'    => 'ocn_btn_left_border_radius',
								'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopTablet' => [
								'id'    => 'ocn_btn_tablet_top_border_radius',
								'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightTablet' => [
								'id'    => 'ocn_btn_tablet_right_border_radius',
								'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomTablet' => [
								'id'    => 'ocn_btn_tablet_bottom_border_radius',
								'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftTablet' => [
								'id'    => 'ocn_btn_tablet_left_border_radius',
								'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopMobile' => [
								'id'    => 'ocn_btn_mobile_top_border_radius',
								'label' => esc_html__( 'Top', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightMobile' => [
								'id'    => 'ocn_btn_mobile_right_border_radius',
								'label' => esc_html__( 'Right', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomMobile' => [
								'id'    => 'ocn_btn_mobile_right_border_radius',
								'label' => esc_html__( 'Bottom', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftMobile' => [
								'id'    => 'ocn_btn_mobile_left_border_radius',
								'label' => esc_html__( 'Left', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
						],
						'preview' => 'queryWithType',
						'css'     => [
							'selector' => '#ocn-cookie-wrap .ocn-btn',
							'property' => 'border-radius'
						],
					],

					'ocn_divider_after_button_border_radius_setting' => [
						'type'            => 'ocean-divider',
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'top'             => 20,
						'bottom'          => 10,
						'active_callback' => 'ocn_cac_has_btn_target',
					],

					'ocn_btn_background' => [
						'type'              => 'ocean-color',
						'label'             => esc_html__( 'Button Background', 'ocean-cookie-notice' ),
						'section'           => 'ocn_additional_styling_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'showAlpha'         => true,
						'showPalette'       => true,
						'active_callback'   => 'ocn_cac_has_btn_target',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args'      => [
							'normal' => [
								'id'       => 'ocn_btn_background',
								'key'      => 'normal',
								'label'    => esc_html__( 'Normal', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap .ocn-btn:hover' => 'background-color'
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#13aff0',
								],
							],
							'hover' => [
								'id'       => 'ocn_btn_hover_background',
								'key'      => 'hover',
								'label'    => esc_html__( 'Hover', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap .ocn-btn:hover:hover' => 'background-color',
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#0b7cac',
								],
							]
						]
					],

					'ocn_divider_after_button_background_color' => [
						'type'            => 'ocean-divider',
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'top'             => 10,
						'bottom'          => 10,
						'active_callback' => 'ocn_cac_has_btn_target',
					],

					'ocn_btn_typo' => [
						'id'              => 'ocn_btn_typo',
						'type'            => 'ocean-typography',
						'label'           => esc_html__( 'Button Text', 'ocean-cookie-notice' ),
						'section'         => 'ocn_additional_styling_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'hideLabel'       => false,
						'selector'        => '#ocn-cookie-wrap .ocn-btn',
						'active_callback' => 'ocn_cac_has_btn_target',
						'setting_args'    => [
							'fontFamily' => [
								'id'    => 'ocn_btn_typo_font_family',
								'label' => esc_html__( 'Font Family', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontWeight' => [
								'id'    => 'ocn_btn_typo_font_weight',
								'label' => esc_html__( 'Font Weight', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightTablet' => [
								'id'    => 'ocn_btn_typo_font_weight_tablet',
								'label' => esc_html__( 'Font Weight', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightMobile' => [
								'id'    => 'ocn_btn_typo_font_weight_mobile',
								'label' => esc_html__( 'Font Weight', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSubset' => [
								'id'    => 'ocn_btn_typo_font_subset',
								'label' => esc_html__( 'Font Subset', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSize' => [
								'id'    => 'ocn_btn_typo_font_size',
								'label' => esc_html__( 'Font Size', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 15,
								],
							],
							'fontSizeTablet' => [
								'id'    => 'ocn_btn_typo_font_size_tablet',
								'label' => esc_html__( 'Font Size', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeMobile' => [
								'id'    => 'ocn_btn_typo_font_size_mobile',
								'label' => esc_html__( 'Font Size', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeUnit' => [
								'id'    => 'ocn_btn_typo_font_size_unit',
								'label' => esc_html__( 'Unit', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 'px',
								],
							],
							'letterSpacing' => [
								'id'    => 'ocn_btn_typo_spacing',
								'label' => esc_html__( 'Letter Spacing', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingTablet' => [
								'id'    => 'ocn_btn_typo_spacing_tablet',
								'label' => esc_html__( 'Letter Spacing', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingMobile' => [
								'id'    => 'ocn_btn_typo_spacing_mobile',
								'label' => esc_html__( 'Letter Spacing', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingUnit' => [
								'id'    => 'ocn_btn_typo_spacing_unit',
								'label' => esc_html__( 'Unit', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 'px',
								],
							],
							'lineHeight' => [
								'id'    => 'ocn_btn_typo_line_height',
								'label' => esc_html__( 'Line Height', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightTablet' => [
								'id'    => 'ocn_btn_typo_line_height_tablet',
								'label' => esc_html__( 'Line Height', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightMobile' => [
								'id'    => 'ocn_btn_typo_line_height_mobile',
								'label' => esc_html__( 'Line Height', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightUnit' => [
								'id'    => 'ocn_btn_typo_line_height_unit',
								'label' => esc_html__( 'Unit', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textTransform' => [
								'id'    => 'ocn_btn_typo_transform',
								'label' => esc_html__( 'Text Transform', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textTransformTablet' => [
								'id'    => 'ocn_btn_typo_transform_tablet',
								'label' => esc_html__( 'Text Transform', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textTransformMobile' => [
								'id'    => 'ocn_btn_typo_transform_mobile',
								'label' => esc_html__( 'Text Transform', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textDecoration' => [
								'id'    => 'ocn_btn_typo_text_decoration',
								'label' => esc_html__( 'Text Decoration', 'ocean-cookie-notice' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'ocn_btn_color' => [
						'type'              => 'ocean-color',
						'label'             => esc_html__( 'Button Text', 'ocean-cookie-notice' ),
						'section'           => 'ocn_additional_styling_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'showAlpha'         => true,
						'showPalette'       => true,
						'active_callback'   => 'ocn_cac_has_btn_target',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args'      => [
							'normal' => [
								'id'       => 'ocn_btn_color',
								'key'      => 'normal',
								'label'    => esc_html__( 'Normal', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap .ocn-btn' => 'color'
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#ffffff',
								],
							],
							'hover' => [
								'id'       => 'ocn_btn_hover_color',
								'key'      => 'hover',
								'label'    => esc_html__( 'Hover', 'ocean-cookie-notice' ),
								'selector' => [
									'#ocn-cookie-wrap .ocn-btn:hover' => 'color',
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#ffffff',
								],
							]
						]
					],

					'ocn_notice_styling_content_for_need_help_link' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-cookie-notice' ), '<a href="https://docs.oceanwp.org/article/919-customizer-cookie-notice#Additional-Styling-VwG99/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'ocn_additional_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],
				]
			],

			'ocn_notice_content_for_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-cookie-notice' ), '<a href="https://docs.oceanwp.org/article/919-customizer-cookie-notice/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_cookie_notice_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],
		]
	];

	return apply_filters( 'ocn_customizer_options', $options );

}
