<?php
/**
 * OceanWP Customizer Class: Side Panel
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function osp_customizer_options() {

	$options = [
		'title'    => esc_html__( 'Side Panel', 'ocean-side-panel' ),
		'priority' => 11,
		'options'  => [
			'osp_side_panel_breakpoints' => [
				'id'                => 'osp_side_panel_breakpoints',
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Breakpoints', 'ocean-side-panel' ),
				'desc'              => esc_html__( 'Set the screen width at which your website will stop displaying the Side Panel.', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'refresh',
				'default'           => '959',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'never'  => esc_html__( 'Never Hide the Side Panel', 'ocean-side-panel' ),
					'1280'   => esc_html__( 'From 1280px', 'ocean-side-panel' ),
					'1080'   => esc_html__( 'From 1080px', 'ocean-side-panel' ),
					'959'    => esc_html__( 'From 959px', 'ocean-side-panel' ),
					'767'    => esc_html__( 'From 767px', 'ocean-side-panel' ),
					'480'    => esc_html__( 'From 480px', 'ocean-side-panel' ),
					'320'    => esc_html__( 'From 320px', 'ocean-side-panel' ),
					'custom' => esc_html__( 'Custom Media Query', 'ocean-side-panel' ),
				]
			],

			'osp_side_panel_custom_breakpoint' => [
				'label'             => esc_html__( 'Custom Media Query', 'ocean-side-panel' ),
				'desc'              => esc_html__( 'Add your custom media query width. (px)', 'ocean-side-panel' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => false,
				'min'               => 0,
				'max'               => 2000,
				'step'              => 1,
				'active_callback'   => 'osp_cac_has_custom_breakpoint',
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'osp_side_panel_custom_breakpoint',
						'label' => esc_html__( 'Desktop', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osp_side_panel_title_for_opening_button_title' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Opening Button', 'ocean-side-panel' ),
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osp_side_panel_open_btn_position' => [
				'id'                => 'osp_side_panel_open_btn_position',
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Opening Button Position', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'refresh',
				'default'           => 'menu',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'menu'   => esc_html__( 'Inside the Main Menu', 'ocean-side-panel' ),
					'beside' => esc_html__( 'Beside the Panel', 'ocean-side-panel' ),
					'manual' => esc_html__( 'Disabled', 'ocean-side-panel' ),
				]
			],

			'osp_spacer_before_open_button_icon' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osp_side_panel_open_btn_icon' => [
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Opening Button Icon', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'default'           => 'menu',
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => true,
				'sanitize_callback' => 'sanitize_text_field',
				'choices'           => osp_opening_btn_icons_list(),
			],

			'osp_side_panel_custom_open_btn' => [
				'id'                => 'osp_side_panel_custom_open_btn',
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Opening Button Animation', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'refresh',
				'default'           => 'default',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'sanitize_callback' => 'sanitize_key',
				'active_callback'   => 'osp_cac_has_menu_open_btn',
				'choices'           => oceanwp_hamburgers_styles(),
			],

			'osp_divider_after_btn_icon_size' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_side_panel_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 20,
				'bottom'          => 20,
				'active_callback' => 'osp_cac_has_menu_open_btn',
			],

			'osp_side_panel_open_btn_text' => [
				'label'             => esc_html__( 'Opening Button Text', 'ocean-side-panel' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'default'           => '',
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'   => 'osp_cac_has_menu_open_btn',
			],

			'osp_spacer_before_open_button_text_position' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osp_side_panel_open_btn_text_position' => [
				'id'                => 'osp_side_panel_open_btn_text_position',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Text Position', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'default'           => 'after-icon',
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'active_callback'   => 'osp_cac_has_menu_open_btn',
				'choices' => [
					'before-icon'  => [
						'id'      => 'before-icon',
						'label'   => esc_html__( 'Before', 'ocean-side-panel' ),
						'content' => esc_html__( 'Before', 'ocean-side-panel' ),
					],
					'after-icon'  => [
						'id'      => 'after-icon',
						'label'   => esc_html__( 'After', 'ocean-side-panel' ),
						'content' => esc_html__( 'After', 'ocean-side-panel' ),
					]
				]
			],

			'osp_side_panel_title_for_side_panel_content' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Side Panel Content', 'ocean-side-panel' ),
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osp_side_panel_position' => [
				'id'                => 'osp_side_panel_position',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Panel Position', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'default'           => 'osp-right',
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'osp-right'  => [
						'id'      => 'osp-right',
						'label'   => esc_html__( 'Right', 'ocean-side-panel' ),
						'content' => esc_html__( 'Right', 'ocean-side-panel' ),
					],
					'osp-left'  => [
						'id'      => 'osp-left',
						'label'   => esc_html__( 'Left', 'ocean-side-panel' ),
						'content' => esc_html__( 'Left', 'ocean-side-panel' ),
					]
				]
			],

			'osp_spacer_before_panel_width' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osp_side_panel_width' => [
				'label'             => esc_html__( 'Panel Width (px)', 'ocean-side-panel' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => true,
				'min'               => 100,
				'max'               => 800,
				'step'              => 1,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'osp_side_panel_width',
						'label' => esc_html__( 'Desktop', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 300,
						],
					],
					'tablet' => [
						'id'    => 'osp_side_panel_width_tablet',
						'label' => esc_html__( 'Tablet', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'mobile' => [
						'id'    => 'osp_side_panel_width_mobile',
						'label' => esc_html__( 'Mobile', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				]
			],

			'osp_divider_after_side_panel_width' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 25,
			],

			'osp_padding' => [
				'id'           => 'osp_padding',
				'label'        => esc_html__( 'Content Padding (px)', 'ocean-side-panel' ),
				'type'         => 'ocean-spacing',
				'section'      => 'ocean_side_panel_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'isType'       => 'padding',
				'setting_args' => [
					'spacingTop' => [
						'id'    => 'osp_top_padding',
						'label' => esc_html__( 'Top', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					],
					'spacingRight' => [
						'id'    => 'osp_right_padding',
						'label' => esc_html__( 'Right', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingBottom' => [
						'id'    => 'osp_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingLeft' => [
						'id'    => 'osp_left_padding',
						'label' => esc_html__( 'Left', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingTopTablet' => [
						'id'    => 'osp_tablet_top_padding',
						'label' => esc_html__( 'Top', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightTablet' => [
						'id'    => 'osp_tablet_right_padding',
						'label' => esc_html__( 'Right', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'osp_tablet_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftTablet' => [
						'id'    => 'osp_tablet_left_padding',
						'label' => esc_html__( 'Left', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopMobile' => [
						'id'    => 'osp_mobile_top_padding',
						'label' => esc_html__( 'Top', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightMobile' => [
						'id'    => 'osp_mobile_right_padding',
						'label' => esc_html__( 'Right', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'osp_mobile_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftMobile' => [
						'id'    => 'osp_mobile_left_padding',
						'label' => esc_html__( 'Left', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => '#side-panel-wrap #side-panel-content',
					'property' => 'padding',
				]
			],

			'osp_divider_after_padding' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osp_template' => [
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Custom Side Panel Content', 'ocean-side-panel' ),
				'desc'              => esc_html__( 'Choose a template created in OceanWP > My Library to replace the content.', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'refresh',
				'default'           => '0',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'choices'           => oceanwp_library_template_choices(),
				'sanitize_callback' => 'sanitize_key',
			],

			'osp_side_panel_title_for_side_panel_effect' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Side Panel Effects', 'ocean-side-panel' ),
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osp_side_panel_displace' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Displace', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'default'           => true,
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osp_side_panel_overlay' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Color Overlay', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'default'           => false,
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osp_side_panel_title_for_close_button' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Close Button', 'ocean-side-panel' ),
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osp_side_panel_close_btn' => [
				'type'      => 'ocean-switch',
				'label'     => esc_html__( 'Display Close Button', 'ocean-side-panel' ),
				'section'   => 'ocean_side_panel_settings',
				'default'   => true,
				'transport' => 'refresh',
				'priority'  => 10,
				'hideLabel' => false,
			],

			'osp_spacer_before_close_button_text' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osp_close_button_text' => [
				'label'             => esc_html__( 'Close Button Text', 'ocean-side-panel' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Close Panel', 'ocean-side-panel' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post'
			],

			'osp_side_panel_title_for_typography_and_colors' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Typography and Colors', 'ocean-side-panel' ),
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osp_beside_open_btn_icon_size' => [
				'label'             => esc_html__( 'Icon Size (px)', 'ocean-side-panel' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => false,
				'min'               => 0,
				'max'               => 100,
				'step'              => 1,
				'active_callback'   => 'osp_cac_has_beside_open_btn',
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'osp_beside_open_btn_icon_size',
						'label' => esc_html__( 'Desktop', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					]
				]
			],

			'osp_divider_after_beside_open_btn_icon_size' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_side_panel_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 1,
				'bottom'          => 20,
				'active_callback' => 'osp_cac_has_beside_open_btn',
			],

			'osp_beside_open_btn_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Button Background', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'active_callback'   => 'osp_cac_has_beside_open_btn',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_beside_open_btn_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a.side-panel-btn' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'osp_beside_open_btn_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Button Icon', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'active_callback'   => 'osp_cac_has_beside_open_btn',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_beside_open_btn_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a.side-panel-btn, #side-panel-wrap a.side-panel-btn:hover' => 'color',
							'#side-panel-wrap a.side-panel-btn .owp-icon use, #side-panel-wrap a.side-panel-btn:hover .owp-icon use' => 'stroke',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					]
				]
			],

			'osp_beside_open_btn_border_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Button Border', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'active_callback'   => 'osp_cac_has_beside_open_btn',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_beside_open_btn_border_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a.side-panel-btn' => 'border-color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#eaeaea',
						],
					]
				]
			],

			'osp_side_panel_open_btn_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Opening Button Icon', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'active_callback'   => 'osp_cac_hasnt_beside_open_btn',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_side_panel_open_btn_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-side-panel' ),
						'selector' => [
							'.side-panel-btn, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn' => 'color',
							'.side-panel-btn .owp-icon use, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn .owp-icon use' => 'stroke',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					],
					'hover' => [
						'id'       => 'osp_side_panel_open_btn_hover_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-side-panel' ),
						'selector' => [
							'.side-panel-btn:hover, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn:hover' => 'color',
							'.side-panel-btn:hover .owp-icon use, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn:hover .owp-icon use' => 'stroke'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osp_side_panel_custom_open_btn_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Custom Open Button Color', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'active_callback'   => 'osp_cac_has_custom_open_btn',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_side_panel_custom_open_btn_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'.side-panel-btn .hamburger-inner, .side-panel-btn .hamburger-inner::before, .side-panel-btn .hamburger-inner::after' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#000000',
						],
					]
				]
			],

			'osp_divider_before_background_colors' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_side_panel_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 10,
				'bottom'          => 20,
			],

			'osp_side_panel_overlay_color' => [
				'type' => 'ocean-color',
				'label' => esc_html__( 'Color Overlay', 'ocean-side-panel' ),
				'section' => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority' => 10,
				'hideLabel' => false,
				'showAlpha' => true,
				'showPalette' => true,
				'active_callback' => 'osp_cac_has_overlay',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args' => [
					'normal' => [
						'id' => 'osp_side_panel_overlay_color',
						'key' => 'normal',
						'label' => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'.osp-overlay' => 'background-color'
						],
						'attr' => [
							'transport' => 'postMessage',
							'default'   => 'rgba(0,0,0,0.3)',
						],
					]
				]
			],

			'osp_divider_after_color_overlay_color' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_side_panel_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 10,
				'bottom'          => 20,
				'active_callback' => 'osp_cac_has_overlay',
			],

			'osp_side_panel_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Panel Background', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_side_panel_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#1b1b1b',
						],
					]
				]
			],

			'osp_divider_before_close_button_colors' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_side_panel_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 10,
				'bottom'          => 20,
			],

			'osp_close_button_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Close Button Background', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_close_button_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a.close-panel' => 'background-color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#111111',
						],
					],
					'hover' => [
						'id' => 'osp_close_button_hover_bg',
						'key' => 'hover',
						'label' => esc_html__( 'Hover', 'ocean-side-panel' ),
						'attr' => [
							'transport' => 'postMessage',
							'default'   => '#111111',
						],
					]
				]
			],

			'osp_close_button_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Close Button Text / Icon', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_close_button_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a.close-panel' => 'color',
							'#side-panel-wrap a.close-panel .owp-icon use' => 'stroke',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#dddddd',
						],
					],
					'hover' => [
						'id'       => 'osp_close_button_hover_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a.close-panel:hover' => 'color',
							'#side-panel-wrap a.close-panel:hover .owp-icon use' => 'stroke'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'osp_divider_before_content_colors' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_side_panel_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 10,
				'bottom'          => 20,
			],

			'osp_headings_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Headings', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_headings_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap h1,#side-panel-wrap h2,#side-panel-wrap h3,#side-panel-wrap h4,#side-panel-wrap h5,#side-panel-wrap h6,#side-panel-wrap .sidebar-box .panel-widget-title' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'osp_text_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Text', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_text_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap,#side-panel-wrap p,#side-panel-wrap #wp-calendar caption,#side-panel-wrap #wp-calendar th,#side-panel-wrap #wp-calendar td' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#888888',
						],
					]
				]
			],

			'osp_links_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Links', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_links_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap a:not(.close-panel)' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#888888',
						],
					],
					'hover' => [
						'id'    => 'osp_links_hover_color',
						'key'   => 'hover',
						'label' => esc_html__( 'Hover', 'ocean-side-panel' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					]
				]
			],

			'osp_list_border_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Widget Dividers', 'ocean-side-panel' ),
				'section'           => 'ocean_side_panel_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osp_list_border_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-side-panel' ),
						'selector' => [
							'#side-panel-wrap .ocean-widget-recent-posts-li,#side-panel-wrap .widget_categories li,#side-panel-wrap .widget_recent_entries li,#side-panel-wrap .widget_archive li,#side-panel-wrap .widget_recent_comments li,#side-panel-wrap .widget_layered_nav li,#side-panel-wrap .widget-recent-posts-icons li,#side-panel-wrap .ocean-widget-recent-posts-li:first-child,#side-panel-wrap .widget_categories li:first-child,#side-panel-wrap .widget_recent_entries li:first-child,#side-panel-wrap .widget_archive li:first-child,#side-panel-wrap .widget_recent_comments li:first-child,#side-panel-wrap .widget_layered_nav li:first-child,#side-panel-wrap .widget-recent-posts-icons li:first-child' => 'border-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#555555',
						],
					]
				]
			],

			'osp_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-side-panel' ), '<a href="https://docs.oceanwp.org/article/916-customizer-side-panel/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_side_panel_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],
		]
	];

	return apply_filters( 'osp_customizer_options', $options );

}
