<?php
/**
 * OceanWP Customizer Class: Footer Callout
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function ofc_customizer_options() {

	$options = [
		'title'    => esc_html__( 'Footer Callout', 'ocean-footer-callout' ),
		'priority' => 13,
		'options'  => [
			'ofc_title_for_callout_default_cta_content' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Default CTA Content', 'ocean-side-panel' ),
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ofc_callout_text' => [
				'type'              => 'ocean-textarea',
				'label'             => esc_html__( 'Content',  'ocean-footer-callout' ),
				'section'           => 'ocean_footer_callout_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'default'           => esc_html__( 'Find what you are looking for and experience the difference.', 'ocean-footer-callout' ),
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_kses_post',
			],

			'ofc_divider_after_callout_text_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
			],

			'ofc_callout_button_section' => [
				'type'     => 'section',
				'title'    => esc_html__( 'Button', 'ocean-footer-callout' ),
				'section'  => 'ocean_footer_callout_settings',
				'after'    => 'ofc_divider_after_callout_text_setting',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'ofc_callout_button' => [
						'type'              => 'ocean-switch',
						'label'             => esc_html__( 'Display Button', 'ocean-footer-callout' ),
						'section'           => 'ofc_callout_button_section',
						'default'           => true,
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'oceanwp_sanitize_checkbox',
					],

					'ofc_divider_after_callout_button_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 20,
					],

					'ofc_callout_button_txt' => [
						'label'             => esc_html__( 'Button Text', 'ocean-footer-callout' ),
						'type'              => 'ocean-text',
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'refresh',
						'default'           => esc_html__( 'Get In Touch', 'ocean-footer-callout' ),
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
					],

					'ofc_divider_after_callout_button_txt_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 20,
						'bottom'    => 20,
					],

					'ofc_callout_button_url' => [
						'label'             => esc_html__( 'Button URL', 'ocean-footer-callout' ),
						'type'              => 'ocean-text',
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'refresh',
						'default'           => '#',
						'priority'          => 10,
						'hideLabel'         => false,
						'bottom'            => 20,
						'sanitize_callback' => 'esc_url_raw',
					],

					'ofc_callout_button_target' => [
						'id'                => 'ofc_callout_button_target',
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Button Target', 'ocean-footer-callout' ),
						'section'           => 'ofc_callout_button_section',
						'default'           => 'blank',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'blank'  => [
								'id'      => 'blank',
								'label'   => esc_html__( 'New Tab', 'ocean-footer-callout' ),
								'content' => esc_html__( 'New Tab', 'ocean-footer-callout' ),
							],
							'self'  => [
								'id'     => 'self',
								'label'   => esc_html__( 'Same Tab', 'ocean-footer-callout' ),
								'content' => esc_html__( 'Same Tab', 'ocean-footer-callout' ),
							]
						]
					],

					'ofc_callout_button_rel' => [
						'id'                => 'ofc_callout_button_rel',
						'type'              => 'ocean-select',
						'label'             => esc_html__( 'Button Rel', 'ocean-footer-callout' ),
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'postMessage',
						'default'           => '',
						'priority'          => 10,
						'hideLabel'         => false,
						'multiple'          => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							''           => esc_html__( 'None', 'ocean-footer-callout' ),
							'nofollow'   => esc_html__( 'Nofollow', 'ocean-footer-callout' ),
							'noopnoref'  => esc_html__( 'Noopener Noreferrer', 'ocean-footer-callout' ),
							'nofnopnorr' => esc_html__( 'Nofollow Noopener Noreferrer', 'ocean-footer-callout' ),
						]
					],

					'ofc_divider_after_callout_button_rel_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 20,
						'bottom'    => 20,
					],

					'ofc_callout_button_classes' => [
						'label'             => esc_html__( 'Button Custom Classes', 'ocean-footer-callout' ),
						'type'              => 'ocean-text',
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'refresh',
						'default'           => '',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
					],

					'ofc_divider_after_callout_button_classes_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 20,
						'bottom'    => 20,
					],

					'ofc_callout_button_border_radius' => [
						'id'                => 'ofc_callout_button_border_radius',
						'label'             =>  esc_html__( 'Button Border Radius (px)', 'ocean-footer-callout' ),
						'type'              => 'ocean-range-slider',
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'isUnit'            => false,
						'isResponsive'      => false,
						'min'               => 0,
						'max'               => 50,
						'step'              => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args'      => [
							'desktop' => [
								'id'    => 'ofc_callout_button_border_radius',
								'label' => esc_html__( 'Desktop', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 30,
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'#footer-callout .callout-button' => ['border-radius']
						]
					],

					'ofc_divider_after_callout_button_border_radius_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 10,
						'bottom'    => 10,
					],

					'ofc_callout_button_typo' => [
						'id'           => 'ofc_callout_button_typo',
						'type'         => 'ocean-typography',
						'label'        => esc_html__( 'Button Text', 'ocean-footer-callout' ),
						'section'      => 'ofc_callout_button_section',
						'transport'    => 'postMessage',
						'priority'     => 10,
						'hideLabel'    => false,
						'selector'     => '#footer-callout .callout-button',
						'setting_args' => [
							'fontFamily' => [
								'id'    => 'ofc_callout_button_typo_font_family',
								'label' => esc_html__( 'Font Family', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontWeight' => [
								'id'    => 'ofc_callout_button_typo_font_weight',
								'label' => esc_html__( 'Font Weight', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightTablet' => [
								'id'    => 'ofc_callout_button_typo_font_weight_tablet',
								'label' => esc_html__( 'Font Weight', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightMobile' => [
								'id'    => 'ofc_callout_button_typo_font_weight_mobile',
								'label' => esc_html__( 'Font Weight', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSubset' => [
								'id'    => 'ofc_callout_button_typo_font_subset',
								'label' => esc_html__( 'Font Subset', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSize' => [
								'id'    => 'ofc_callout_button_typo_font_size',
								'label' => esc_html__( 'Font Size', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 15,
								],
							],
							'fontSizeTablet' => [
								'id'    => 'ofc_callout_button_typo_font_size_tablet',
								'label' => esc_html__( 'Font Size', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeMobile' => [
								'id'    => 'ofc_callout_button_typo_font_size_mobile',
								'label' => esc_html__( 'Font Size', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeUnit' => [
								'id'    => 'ofc_callout_button_typo_font_size_unit',
								'label' => esc_html__( 'Unit', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'letterSpacing' => [
								'id'    => 'ofc_callout_button_typo_spacing',
								'label' => esc_html__( 'Letter Spacing', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingTablet' => [
								'id'    => 'ofc_callout_button_typo_spacing_tablet',
								'label' => esc_html__( 'Letter Spacing', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingMobile' => [
								'id'    => 'ofc_callout_button_typo_spacing_mobile',
								'label' => esc_html__( 'Letter Spacing', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingUnit' => [
								'id'    => 'ofc_callout_button_typo_spacing_unit',
								'label' => esc_html__( 'Unit', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 'px',
								],
							],
							'lineHeight' => [
								'id'    => 'ofc_callout_button_typo_line_height',
								'label' => esc_html__( 'Line Height', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightTablet' => [
								'id'    => 'ofc_callout_button_typo_line_height_tablet',
								'label' => esc_html__( 'Line Height', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightMobile' => [
								'id'    => 'ofc_callout_button_typo_line_height_mobile',
								'label' => esc_html__( 'Line Height', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightUnit' => [
								'id'    => 'ofc_callout_button_typo_line_height_unit',
								'label' => esc_html__( 'Unit', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textTransform' => [
								'id'    => 'ofc_callout_button_typo_transform',
								'label' => esc_html__( 'Text Transform', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textTransformTablet' => [
								'id'    => 'ofc_callout_button_typo_transform_tablet',
								'label' => esc_html__( 'Text Transform', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textTransformMobile' => [
								'id'    => 'ofc_callout_button_typo_transform_mobile',
								'label' => esc_html__( 'Text Transform', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'textDecoration' => [
								'id'    => 'ofc_callout_button_typo_text_decoration',
								'label' => esc_html__( 'Text Decoration', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'ofc_divider_after_callout_button_typo_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 20,
					],

					'ofc_callout_button_bg' => [
						'type'              => 'ocean-color',
						'label'             => esc_html__( 'Button Background', 'ocean-footer-callout' ),
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'showAlpha'         => true,
						'showPalette'       => true,
						'sanitize_callback' => 'wp_kses_post',
						'setting_args'      => [
							'normal' => [
								'id'       => 'ofc_callout_button_bg',
								'key'      => 'normal',
								'label'    => esc_html__( 'Normal', 'ocean-footer-callout' ),
								'selector' => [
									'#footer-callout .callout-button' => 'background-color'
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#13aff0',
								],
							],
							'hover' => [
								'id'    => 'ofc_callout_button_hover_bg',
								'key'   => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => '#0b7cac',
								],
							]
						]
					],

					'ofc_callout_button_color' => [
						'type'              => 'ocean-color',
						'label'             => esc_html__( 'Button Text', 'ocean-footer-callout' ),
						'section'           => 'ofc_callout_button_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'showAlpha'         => true,
						'showPalette'       => true,
						'sanitize_callback' => 'wp_kses_post',
						'setting_args'      => [
							'normal' => [
								'id'       => 'ofc_callout_button_color',
								'key'      => 'normal',
								'label'    => esc_html__( 'Normal', 'ocean-footer-callout' ),
								'selector' => [
									'#footer-callout .callout-button' => 'color'
								],
								'attr'     => [
									'transport' => 'postMessage',
									'default'   => '#ffffff',
								],
							],
							'hover' => [
								'id'    => 'ofc_callout_button_hover_color',
								'key'   => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-footer-callout' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => '#ffffff',
								],
							]
						]
					],

					'ofc_callout_button_need_help_link' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'oceanwp' ), '<a href="https://docs.oceanwp.org/article/918-customizer-footer-callout#Button-jQ9-a/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'ofc_callout_button_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],
				]
			],

			'ofc_title_for_callout_custom_cta_content' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Custom CTA Content', 'ocean-side-panel' ),
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ofc_callout_template' => [
				'type'              => 'ocean-select',
				'label'             => esc_html__( 'Select Template', 'ocean-footer-callout' ),
				'desc'              => esc_html__( 'Select a custom template you created in OceanWP > My Library.', 'ocean-footer-callout' ),
				'section'           => 'ocean_footer_callout_settings',
				'transport'         => 'refresh',
				'default'           => '0',
				'priority'          => 10,
				'hideLabel'         => false,
				'multiple'          => false,
				'choices'           => oceanwp_library_template_choices(),
				'sanitize_callback' => 'sanitize_key',
			],

			'ofc_title_for_callout_typography_and_colors' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Footer CTA Styling', 'ocean-side-panel' ),
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

			'ofc_callout_padding' => [
				'id'           => 'ofc_callout_padding',
				'label'        => esc_html__( 'Padding (px)', 'ocean-footer-callout' ),
				'type'         => 'ocean-spacing',
				'section'      => 'ocean_footer_callout_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'isType'       => 'padding',
				'isLeft'       => false,
				'isRight'      => false,
				'setting_args' => [
					'spacingTop' => [
						'id'    => 'ofc_callout_top_padding',
						'label' => esc_html__( 'Top', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingBottom' => [
						'id'    => 'ofc_callout_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingTopTablet' => [
						'id'    => 'ofc_callout_tablet_top_padding',
						'label' => esc_html__( 'Top', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingBottomTablet' => [
						'id'    => 'ofc_callout_tablet_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 30,
						],
					],
					'spacingTopMobile' => [
						'id'    => 'ofc_callout_mobile_top_padding',
						'label' => esc_html__( 'Top', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'spacingBottomMobile' => [
						'id'    => 'ofc_callout_mobile_bottom_padding',
						'label' => esc_html__( 'Bottom', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				],
				'preview' => 'queryWithType',
				'css'     => [
					'selector' => '#footer-callout-wrap',
					'property' => 'padding',
				],
			],

			'ofc_callout_divider_after_padding' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 15,
			],

			'ofc_callout_text_typo' => [
				'id'           => 'ofc_callout_text_typo',
				'type'         => 'ocean-typography',
				'label'        => esc_html__( 'CTA Content', 'ocean-footer-callout' ),
				'section'      => 'ocean_footer_callout_settings',
				'transport'    => 'postMessage',
				'priority'     => 10,
				'hideLabel'    => false,
				'selector'     => '#footer-callout .footer-callout-content',
				'setting_args' => [
					'fontFamily' => [
						'id'    => 'ofc_callout_text_typo_font_family',
						'label' => esc_html__( 'Font Family', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontWeight' => [
						'id'    => 'ofc_callout_text_typo_font_weight',
						'label' => esc_html__( 'Font Weight', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontWeightTablet' => [
						'id'    => 'ofc_callout_text_typo_font_weight_tablet',
						'label' => esc_html__( 'Font Weight', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontWeightMobile' => [
						'id'    => 'ofc_callout_text_typo_font_weight_mobile',
						'label' => esc_html__( 'Font Weight', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSubset' => [
						'id'    => 'ofc_callout_text_typo_font_subset',
						'label' => esc_html__( 'Font Subset', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSize' => [
						'id'    => 'ofc_callout_text_typo_font_size',
						'label' => esc_html__( 'Font Size', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 15,
						],
					],
					'fontSizeTablet' => [
						'id'    => 'ofc_callout_text_typo_font_size_tablet',
						'label' => esc_html__( 'Font Size', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSizeMobile' => [
						'id'    => 'ofc_callout_text_typo_font_size_mobile',
						'label' => esc_html__( 'Font Size', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'fontSizeUnit' => [
						'id'    => 'ofc_callout_text_typo_font_size_unit',
						'label' => esc_html__( 'Unit', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => 'px',
						],
					],
					'letterSpacing' => [
						'id'    => 'ofc_callout_text_typo_spacing',
						'label' => esc_html__( 'Letter Spacing', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'letterSpacingTablet' => [
						'id'    => 'ofc_callout_text_typo_spacing_tablet',
						'label' => esc_html__( 'Letter Spacing', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'letterSpacingMobile' => [
						'id'    => 'ofc_callout_text_typo_spacing_mobile',
						'label' => esc_html__( 'Letter Spacing', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'letterSpacingUnit' => [
						'id' => 'ofc_callout_text_typo_spacing_unit',
						'label' => esc_html__( 'Unit', 'ocean-footer-callout' ),
						'attr' => [
							'transport' => 'postMessage',
							'default'   => 'px',
						],
					],
					'lineHeight' => [
						'id'    => 'ofc_callout_text_typo_line_height',
						'label' => esc_html__( 'Line Height', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'lineHeightTablet' => [
						'id'    => 'ofc_callout_text_typo_line_height_tablet',
						'label' => esc_html__( 'Line Height', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'lineHeightMobile' => [
						'id'    => 'ofc_callout_text_typo_line_height_mobile',
						'label' => esc_html__( 'Line Height', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'lineHeightUnit' => [
						'id'    => 'ofc_callout_text_typo_line_height_unit',
						'label' => esc_html__( 'Unit', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textTransform' => [
						'id'    => 'ofc_callout_text_typo_transform',
						'label' => esc_html__( 'Text Transform', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textTransformTablet' => [
						'id'    => 'ofc_callout_text_typo_transform_tablet',
						'label' => esc_html__( 'Text Transform', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textTransformMobile' => [
						'id'    => 'ofc_callout_text_typo_transform_mobile',
						'label' => esc_html__( 'Text Transform', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
					'textDecoration' => [
						'id'    => 'ofc_callout_text_typo_text_decoration',
						'label' => esc_html__( 'Text Decoration', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
						],
					],
				]
			],

			'ofc_callout_divider_after_text_typo' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

			'ofc_callout_bg' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'CTA Background', 'ocean-footer-callout' ),
				'section'           => 'ocean_footer_callout_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'ofc_callout_bg',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-footer-callout' ),
						'selector' => [
							'#footer-callout-wrap' => 'background-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#1b1b1b',
						],
					]
				]
			],

			'ofc_callout_border' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'CTA Top Border', 'ocean-footer-callout' ),
				'section'           => 'ocean_footer_callout_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'ofc_callout_border',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-footer-callout' ),
						'selector' => [
							'#footer-callout-wrap' => 'border-color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#1b1b1b',
						],
					]
				]
			],

			'ofc_callout_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'CTA Text', 'ocean-footer-callout' ),
				'section'           => 'ocean_footer_callout_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'ofc_callout_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Select Color', 'ocean-footer-callout' ),
						'selector' => [
							'#footer-callout-wrap' => 'color'
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#dddddd',
						],
					]
				]
			],

			'ofc_callout_links_color' => [
				'type'              => 'ocean-color',
				'label'             => esc_html__( 'CTA Links', 'ocean-footer-callout' ),
				'section'           => 'ocean_footer_callout_settings',
				'transport'         => 'postMessage',
				'priority'          => 10,
				'hideLabel'         => false,
				'showAlpha'         => true,
				'showPalette'       => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args'      => [
					'normal' => [
						'id'       => 'ofc_callout_links_color',
						'key'      => 'normal',
						'label'    => esc_html__( 'Normal', 'ocean-footer-callout' ),
						'selector' => [
							'.footer-callout-content a' => 'color',
						],
						'attr'     => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						],
					],
					'hover' => [
						'id'    => 'ofc_callout_links_color_hover',
						'key'   => 'hover',
						'label' => esc_html__( 'Hover', 'ocean-footer-callout' ),
						'attr'  => [
							'transport' => 'postMessage',
							'default'   => '#13aff0',
						],
					]
				]
			],

			'ofc_callout_content_for_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-footer-callout' ), '<a href="https://docs.oceanwp.org/article/918-customizer-footer-callout/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_footer_callout_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

		]
	];

	return apply_filters( 'ofc_customizer_options', $options );
}
