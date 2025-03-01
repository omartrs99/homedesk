<?php
/**
 * OceanWP Customizer Class: Sticky Header
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function osh_customizer_options() {

	$options = [
		'title'    => esc_html__( 'Sticky Header', 'ocean-sticky-header' ),
		'priority' => 12,
		'options'  => [
			'osh_title_for_header_elements' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Sticky Header Elements', 'ocean-sticky-header' ),
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osh_has_sticky_topbar' => [
				'type' => 'ocean-switch',
				'label' => esc_html__( 'Sticky Top Bar', 'ocean-sticky-header' ),
				'section' => 'ocean_sticky_header_settings',
				'default'  => false,
				'transport' => 'refresh',
				'priority' => 10,
				'hideLabel' => false,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osh_has_sticky_mobile' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Sticky Mobile', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => false,
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osh_divider_after_has_sticky_mobile_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

			'osh_sticky_choose' => [
				'id'                => 'osh_sticky_choose',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Custom Header Type: Sticky Options', 'ocean-sticky-header' ),
				'desc'              => sprintf( esc_html__( 'This option has been designed for the Custom Header type. %1$sLearn more%2$s.', 'ocean-sticky-header' ), '<a href="http://docs.oceanwp.org/article/460-sticky-header-for-the-custom-header-style" target="_blank">', '</a>' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => 'auto',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'auto'   => [
						'id'      => 'auto',
						'label'   => esc_html__( 'Auto', 'ocean-sticky-header' ),
						'content' => esc_html__( 'Auto', 'ocean-sticky-header' ),
					],
					'manual' => [
						'id'      => 'manual',
						'label'   => esc_html__( 'Manual', 'ocean-sticky-header' ),
						'content' => esc_html__( 'Manual', 'ocean-sticky-header' ),
					]
				]
			],

			'osh_divider_after_sticky_choose_setting' => [
				'type'            => 'ocean-divider',
				'section'         => 'ocean_sticky_header_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'top'             => 10,
				'bottom'          => 10,
				'active_callback' => 'ocean_cac_header_medium_style',
			],

			'ocean_medium_header_hidden_menu' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Hide Menu on Sticky', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => true,
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'active_callback'   => 'ocean_cac_header_medium_style',
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'ocean_medium_header_stick_menu' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Stick Only The Menu', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => false,
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'active_callback'   => 'ocean_cac_header_medium_style',
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osh_title_for_sticky_style_and_effects' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Sticky Style and Effects', 'ocean-sticky-header' ),
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osh_sticky_header_style' => [
				'id'                => 'osh_sticky_header_style',
				'type'              => 'ocean-buttons',
				'label'             => esc_html__( 'Sticky Style', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => 'shrink',
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'wrap'              => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'shrink'  => [
						'id'     => 'shrink',
						'label'   => esc_html__( 'Shrink', 'ocean-sticky-header' ),
						'content' => esc_html__( 'Shrink', 'ocean-sticky-header' ),
					],
					'fixed'  => [
						'id'     => 'fixed',
						'label'   => esc_html__( 'Fixed', 'ocean-sticky-header' ),
						'content' => esc_html__( 'Fixed', 'ocean-sticky-header' ),
					]
				]
			],

			'osh_shrink_header_height' => [
				'id'                => 'osh_shrink_header_height',
				'label'             => esc_html__( 'Sticky Shrink Style: Height (px)', 'ocean-sticky-header' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => false,
				'min'               => 30,
				'max'               => 100,
				'step'              => 1,
				'active_callback'   => 'osh_cac_has_shrink_style',
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'osh_shrink_header_height',
						'label' => esc_html__( 'Desktop', 'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 54,
						],
					]
				],
				'preview' => 'queryWithType',
				'css'     => [
					'.is-sticky #site-header.shrink-header #site-logo #site-logo-inner, .is-sticky #site-header.shrink-header #oceanwp-social-menu .social-menu-inner, .is-sticky #site-header.shrink-header.full_screen-header .menu-bar-inner' => ['height'],
					'.is-sticky #site-header.shrink-header #site-navigation-wrap .dropdown-menu > li > a, .is-sticky #site-header.shrink-header #oceanwp-mobile-menu-icon a' => ['line-height'],
				]
			],

			'osh_divider_after_shrink_header_height' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

			'osh_sticky_header_effect' => [
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Sticky Scrolling Effect', 'ocean-sticky-header' ),
				'desc'              => esc_html__( 'Sticky effects are not supported by all header types.', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'refresh',
				'default'           => 'none',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'sanitize_callback' => 'sanitize_key',
				'choices'           => [
					'none'  => esc_html__( 'No Effect', 'ocean-sticky-header' ),
					'slide' => esc_html__( 'Slide', 'ocean-sticky-header' ),
					'up'    => esc_html__( 'Show Up/Hide Down', 'ocean-sticky-header' ),
				],
			],

			'osh_divider_after_sticky_header_effect' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 10,
			],

			'osh_has_full_width_header' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Full Width on Sticky', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => false,
				'transport'         => 'refresh',
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osh_no_shadow' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'No Shadow on Sticky', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'default'           => false,
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'osh_spacer_before_sticky_opacity' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osh_sticky_header_opacity' => [
				'id'                => 'osh_sticky_header_opacity',
				'label'             =>  esc_html__( 'Sticky Opacity', 'ocean-sticky-header' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => false,
				'min'               => 0.1,
				'max'               => 1,
				'step'              => 0.01,
				'sanitize_callback' => 'oceanwp_sanitize_number',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'osh_sticky_header_opacity',
						'label' => esc_html__( 'Desktop', 'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 0.95,
						],
					]
				],
				'preview' => 'queryWithType',
				'css'     => [
					'.is-sticky #site-header,.oceanwp-sticky-top-bar-holder.is-sticky #top-bar-wrap,.is-sticky .header-top' => ['opacity'],
				]
			],

			'osh_divider_after_header_opacity_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 25,
			],

			'osh_header_top_padding' => [
				'id'           => 'osh_header_top_padding',
				'label'        => esc_html__( 'Sticky Padding (px)',  'ocean-sticky-header' ),
				'type'         => 'ocean-spacing',
				'section'      => 'ocean_sticky_header_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'isType'       => 'padding',
				'setting_args' => [
					'spacingTop' => [
						'id'    => 'osh_header_top_padding',
						'label' => esc_html__( 'Top',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRight' => [
						'id'    => 'osh_header_right_padding',
						'label' => esc_html__( 'Right',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',                     ],
					],
					'spacingBottom' => [
						'id'    => 'osh_header_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeft' => [
						'id'    => 'osh_header_left_padding',
						'label' => esc_html__( 'Left',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopTablet' => [
						'id'    => 'osh_header_tablet_top_padding',
						'label' => esc_html__( 'Top',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightTablet' => [
						'id'    => 'osh_header_tablet_right_padding',
						'label' => esc_html__( 'Right',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'osh_header_tablet_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftTablet' => [
						'id'    => 'osh_header_tablet_left_padding',
						'label' => esc_html__( 'Left',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopMobile' => [
						'id'    => 'osh_header_mobile_top_padding',
						'label' => esc_html__( 'Top',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingRightMobile' => [
						'id'    => 'osh_header_mobile_right_padding',
						'label' => esc_html__( 'Right',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'osh_header_mobile_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingLeftMobile' => [
						'id'    => 'osh_header_mobile_left_padding',
						'label' => esc_html__( 'Left',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => 'body .is-sticky #site-header.fixed-scroll #site-header-inner',
					'property' => 'padding',
				]
			],

			'ocean_medium_header_sticky_top_header_padding' => [
				'id'              => 'ocean_medium_header_sticky_top_header_padding',
				'label'           => esc_html__( 'Medium Header Sticky Padding (px)',  'ocean-sticky-header' ),
				'type'            => 'ocean-spacing',
				'section'         => 'ocean_sticky_header_settings',
				'transport'       => 'postMessage',
				'priority'        => 10,
				'hideLabel'       => false,
				'isType'          => 'padding',
				'isLeft'          => false,
				'isRight'         => false,
				'active_callback' => 'ocean_cac_header_medium_style',
				'setting_args'    => [
					'spacingTop' => [
						'id'    => 'ocean_medium_header_sticky_top_header_top_padding',
						'label' => esc_html__( 'Top',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'=> 20,
						],
					],
					'spacingBottom' => [
						'id'    => 'ocean_medium_header_sticky_top_header_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 20,
						],
					],
					'spacingTopTablet' => [
						'id'    => 'ocean_medium_header_sticky_top_header_tablet_top_padding',
						'label' => esc_html__( 'Top',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'ocean_medium_header_sticky_top_header_tablet_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingTopMobile' => [
						'id'    => 'ocean_medium_header_sticky_top_header_mobile_top_padding',
						'label' => esc_html__( 'Top',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'ocean_medium_header_sticky_top_header_mobile_bottom_padding',
						'label' => esc_html__( 'Bottom',  'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => '.is-sticky #site-header.medium-header .top-header-wrap',
					'property' => 'padding',
				]
			],

			'osh_title_for_header_logo' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Sticky Header Logo', 'ocean-sticky-header' ),
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osh_logo' => [
				'label'     => esc_html__( 'Sticky Logo', 'ocean-sticky-header' ),
				'desc'      => esc_html__( 'Display a different logo on Sticky (optional)', 'ocean-sticky-header' ),
				'type'      => 'ocean-image',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'refresh',
				'priority'  => 10,
				'hideLabel' => false,
				'mediaType' => 'image',
				'savetype'  => 'url',
				'sanitize_callback' => 'ocean_sanitize_image_control'
			],

			'osh_spacer_before_sticky_retina' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osh_logo_retina' => [
				'label'     => esc_html__( 'Sticky Retina Logo', 'ocean-sticky-header' ),
				'type'      => 'ocean-image',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'refresh',
				'priority'  => 10,
				'hideLabel' => false,
				'mediaType' => 'image',
				'savetype'  => 'url',
				'sanitize_callback' => 'ocean_sanitize_image_control'
			],

			'osh_divider_after_header_logo_retina' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'osh_shrink_header_logo_height' => [
				'label'             =>  esc_html__( 'Sticky Logo Height (px)', 'ocean-sticky-header' ),
				'type'              => 'ocean-range-slider',
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'isUnit'            => false,
				'isResponsive'      => false,
				'min'               => 10,
				'max'               => 100,
				'step'              => 1,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args'      => [
					'desktop' => [
						'id'    => 'osh_shrink_header_logo_height',
						'label' => esc_html__( 'Desktop', 'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					]
				]
			],

			'osh_title_for_typography_and_colors' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Typography and Colors', 'ocean-sticky-header' ),
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'osh_background_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Sticky Background', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id' => 'osh_background_color',
						'key'   => 'normal',
						'label' => esc_html__( 'Select Color', 'ocean-sticky-header' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osh_divider_after_sticky_background_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

			'osh_links_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Menu Items: Link', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'    => 'osh_links_color',
						'key'   => 'normal',
						'label' => esc_html__( 'Normal', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky #site-navigation-wrap .dropdown-menu > li > a,.is-sticky .oceanwp-mobile-menu-icon a,.is-sticky #searchform-header-replace-close' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					],
					'hover' => [
						'id'       => 'osh_links_hover_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky #site-navigation-wrap .dropdown-menu > li > a:hover,.is-sticky .oceanwp-mobile-menu-icon a:hover,.is-sticky #searchform-header-replace-close:hover' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osh_links_bg_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Menu Items: Background', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osh_links_bg_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky #site-navigation-wrap .dropdown-menu > li > a' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					],
					'hover' => [
						'id'       => 'osh_links_hover_bg_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky #site-navigation-wrap .dropdown-menu > li > a:hover,.is-sticky #site-navigation-wrap .dropdown-menu > li.sfHover > a' => 'background-color',
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osh_divider_after_menu_items_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

			'osh_links_active_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Active Menu Item: Link', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osh_links_active_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a > span,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a:hover > span' => 'color'
						],
						'attr' => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osh_links_active_bg_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Active Menu Item: Background', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osh_links_active_bg_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a > span,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a:hover > span' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osh_divider_after_active_menu_color' => [
				'type'              => 'ocean-divider',
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'top'               => 10,
				'bottom'            => 20,
				'active_callback'   => 'oceanwp_cac_has_menu_social',
			],

			'osh_menu_social_links_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'Simple Social Links Color', 'ocean-sticky-header' ),
				'section'           => 'ocean_sticky_header_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'active_callback'   => 'oceanwp_cac_has_menu_social',
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'osh_menu_social_links_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky .oceanwp-social-menu ul li a,.is-sticky #site-header.full_screen-header .oceanwp-social-menu.simple-social ul li a' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					],
					'hover' => [
						'id'       => 'osh_menu_social_hover_links_color',
						'key'      => 'hover',
						'label'    => esc_html__( 'Hover', 'ocean-sticky-header' ),
						'selector' => [
							'.is-sticky .oceanwp-social-menu ul li a:hover,.is-sticky #site-header.full_screen-header .oceanwp-social-menu.simple-social ul li a:hover' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
						],
					]
				]
			],

			'osh_content_for_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-sticky-header' ), '<a href="https://docs.oceanwp.org/article/915-customizer-sticky-header/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_sticky_header_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],
		]
	];

	return apply_filters( 'osh_customizer_options', $options );

}

