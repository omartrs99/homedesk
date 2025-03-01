<?php
/**
 * OceanWP Customizer Class: Sticky Footer
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function osf_customizer_options() {

    $options = [
		'title'    => esc_html__( 'Sticky Footer', 'ocean-sticky-footer' ),
		'priority' => 13,
		'options'  => [
            'osf_title_for_sticky_footer_bar' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Sticky Footer Bar', 'ocean-sticky-footer' ),
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
                'top'       => 20,
                'bottom'    => 20,
			],

            'osf_text' => [
                'type'              => 'ocean-textarea',
                'label'             => esc_html__( 'Text', 'ocean-sticky-footer' ),
				'desc'              => esc_html__( 'Add text that will appear in the Sticky Footer bar or delete to display nothing.', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'default'           => esc_html__( 'Click the arrow to reveal more amazing content.', 'ocean-sticky-footer' ),
                'hideLabel'         => false,
                'sanitize_callback' => 'wp_kses_post',
            ],

            'osf_divider_after_text_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 20,
				'bottom'    => 20,
			],

            'osf_opening_icon' => [
                'label'             => esc_html__( 'Custom Opening Icon', 'ocean-sticky-footer' ),
				'desc'              => esc_html__( 'Enter your full icon class.', 'ocean-sticky-footer' ),
                'type'              => 'ocean-text',
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'wp_kses_post',
            ],

            'osf_title_for_responsive_setting' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Responsive Settings', 'ocean-sticky-footer' ),
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
                'top'       => 20,
                'bottom'    => 20,
			],

            'osf_hide_nav_on_mobile' => [
                'type'              => 'ocean-switch',
                'label'             => esc_html__( 'Hide Navigation on Mobile', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'default'           => false,
                'transport'         => 'refresh',
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'oceanwp_sanitize_checkbox',
            ],

            'osf_hide_text_on_mobile' => [
                'type'              => 'ocean-switch',
                'label'             => esc_html__( 'Hide Text on Mobile', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'default'           => true,
                'transport'         => 'refresh',
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'oceanwp_sanitize_checkbox',
            ],

            'osf_title_for_styling_and_typo_and colors_settings' => [
				'type'      => 'ocean-title',
				'label'     => esc_html__( 'Sticky Footer Styling', 'ocean-sticky-footer' ),
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
                'top'       => 20,
                'bottom'    => 20,
			],

            'osf_footer_opacity' => [
                'id'                => 'osf_footer_opacity',
                'label'             =>  esc_html__( 'Sticky Footer Opacity', 'ocean-sticky-footer' ),
                'type'              => 'ocean-range-slider',
                'section'           => 'ocean_sticky_footer_settings',
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
                        'id'    => 'osf_footer_opacity',
                        'label' => esc_html__( 'Desktop', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                            'default'   => 0.95,
                        ],
                    ]
                ],
                'preview' => 'queryWithType',
                'css'     => [
                    '.osf-footer .site-footer' => ['opacity'],
                ]
            ],

            'osf_divider_after_footer_opacity_setting' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 10,
			],

            'osf_footer_bar_typo' => [
                'id'           => 'osf_footer_bar_typo',
                'type'         => 'ocean-typography',
                'label'        => esc_html__( 'Sticky Footer Text', 'ocean-sticky-footer' ),
                'section'      => 'ocean_sticky_footer_settings',
                'transport'    => 'postMessage',
                'priority'     => 10,
                'hideLabel'    => false,
                'selector'     => '#footer-bar .osf-left li.menu-item a, #footer-bar .osf-text',
                'setting_args' => [
                    'fontFamily' => [
                        'id'    => 'osf_footer_bar_typo_font_family',
                        'label' => esc_html__( 'Font Family', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontWeight' => [
                        'id'    => 'osf_footer_bar_typo_font_weight',
                        'label' => esc_html__( 'Font Weight', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontWeightTablet' => [
                        'id'    => 'osf_footer_bar_typo_font_weight_tablet',
                        'label' => esc_html__( 'Font Weight', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontWeightMobile' => [
                        'id'    => 'osf_footer_bar_typo_font_weight_mobile',
                        'label' => esc_html__( 'Font Weight', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontSubset' => [
                        'id'    => 'osf_footer_bar_typo_font_subset',
                        'label' => esc_html__( 'Font Subset', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontSize' => [
                        'id'    => 'osf_footer_bar_typo_font_size',
                        'label' => esc_html__( 'Font Size', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                            'default'   => 15,
                        ],
                    ],
                    'fontSizeTablet' => [
                        'id'    => 'osf_footer_bar_typo_font_size_tablet',
                        'label' => esc_html__( 'Font Size', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontSizeMobile' => [
                        'id'    => 'osf_footer_bar_typo_font_size_mobile',
                        'label' => esc_html__( 'Font Size', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'fontSizeUnit' => [
                        'id'    => 'osf_footer_bar_typo_font_size_unit',
                        'label' => esc_html__( 'Unit', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                            'default'   => 'px',
                        ],
                    ],
                    'letterSpacing' => [
                        'id'    => 'osf_footer_bar_typo_spacing',
                        'label' => esc_html__( 'Letter Spacing', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'letterSpacingTablet' => [
                        'id'    => 'osf_footer_bar_typo_spacing_tablet',
                        'label' => esc_html__( 'Letter Spacing', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'letterSpacingMobile' => [
                        'id'    => 'osf_footer_bar_typo_spacing_mobile',
                        'label' => esc_html__( 'Letter Spacing', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'letterSpacingUnit' => [
                        'id'    => 'osf_footer_bar_typo_spacing_unit',
                        'label' => esc_html__( 'Unit', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                            'default'   => 'px',
                        ],
                    ],
                    'lineHeight' => [
                        'id'    => 'osf_footer_bar_typo_line_height',
                        'label' => esc_html__( 'Line Height', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'lineHeightTablet' => [
                        'id'    => 'osf_footer_bar_typo_line_height_tablet',
                        'label' => esc_html__( 'Line Height', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'lineHeightMobile' => [
                        'id'    => 'osf_footer_bar_typo_line_height_mobile',
                        'label' => esc_html__( 'Line Height', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'lineHeightUnit' => [
                        'id'    => 'osf_footer_bar_typo_line_height_unit',
                        'label' => esc_html__( 'Unit', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'textTransform' => [
                        'id'    => 'osf_footer_bar_typo_transform',
                        'label' => esc_html__( 'Text Transform', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'textTransformTablet' => [
                        'id'    => 'osf_footer_bar_typo_transform_tablet',
                        'label' => esc_html__( 'Text Transform', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'textTransformMobile' => [
                        'id'    => 'osf_footer_bar_typo_transform_mobile',
                        'label' => esc_html__( 'Text Transform', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'textDecoration' => [
                        'id'    => 'osf_footer_bar_typo_text_decoration',
                        'label' => esc_html__( 'Text Decoration', 'ocean-sticky-footer' ),
                        'attr'  => [
                            'transport' => 'postMessage',
                        ],
                    ],
                ]
            ],

            'osf_text_color' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Sticky Footer Text', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_text_color',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Select Color', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-text' => 'color',
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#a9a9a9',
                        ],
                    ]
                ]
            ],

            'osf_divider_after_text_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

            'osf_footer_bar_background' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Background', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_footer_bar_background',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Select Color', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar' => 'background-color'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#131313',
                        ],
                    ]
                ]
            ],

            'osf_divider_after_footer_bar_background' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

            'osf_opening_btn_background' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Open Button: Background', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_opening_btn_background',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Normal', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.osf-btn a' => 'background-color'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'hover' => [
                        'id'       => 'osf_opening_btn_hover_background',
                        'key'      => 'hover',
                        'label'    => esc_html__( 'Hover', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.osf-btn a:hover' => 'background-color',
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#333333',
                        ],
                    ]
                ]
            ],

            'osf_opening_btn_color' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Open Button: Icon', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_opening_btn_color',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Normal', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.osf-btn a' => 'color',
                            '#footer-bar .osf-left li.osf-btn a .owp-icon use' => 'stroke',
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#ffffff',
                        ],
                    ],
                    'hover' => [
                        'id'       => 'osf_opening_btn_hover_color',
                        'key'      => 'hover',
                        'label'    => esc_html__( 'Hover', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.osf-btn a:hover' => 'color',
                            '#footer-bar .osf-left li.osf-btn a:hover .owp-icon use' => 'stroke'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#ffffff',
                        ],
                    ]
                ]
            ],

            'osf_divider_after_opening_btn_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

			'osf_menu_items_color' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Menu Item: Link', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_menu_items_color',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Normal', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.menu-item a' => 'color'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#ffffff',
                        ],
                    ],
                    'hover' => [
                        'id'       => 'osf_menu_items_hover_color',
                        'key'      => 'hover',
                        'label'    => esc_html__( 'Hover', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.menu-item a:hover' => 'color',
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#ffffff',
                        ],
                    ]
                ]
            ],

            'osf_menu_items_background' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Menu Item: Background', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_menu_items_background',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Normal', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.menu-item a' => 'background-color'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'hover' => [
                        'id'       => 'osf_menu_items_hover_background',
                        'key'      => 'hover',
                        'label'    => esc_html__( 'Hover', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-left li.menu-item a:hover' => 'background-color'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#333333',
                        ],
                    ]
                ]
            ],

            'osf_divider_after_menu_items_color' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 10,
				'bottom'    => 20,
			],

            'osf_scroll_top_background' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Scroll to Top: Background', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_scroll_top_background',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Normal', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-right li #scroll-top' => 'background-color'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                        ],
                    ],
                    'hover' => [
                        'id'       => 'osf_scroll_top_hover_background',
                        'key'      => 'hover',
                        'label'    => esc_html__( 'Hover', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-right li #scroll-top:hover' => 'background-color',
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#333333',
                        ],
                    ]
                ]
            ],

            'osf_scroll_top_color' => [
                'type'              => 'ocean-color',
                'label'             => esc_html__( 'Scroll to Top: Icon', 'ocean-sticky-footer' ),
                'section'           => 'ocean_sticky_footer_settings',
                'transport'         => 'postMessage',
                'priority'          => 10,
                'hideLabel'         => false,
                'showAlpha'         => true,
                'showPalette'       => true,
                'sanitize_callback' => 'wp_kses_post',
                'setting_args'      => [
                    'normal' => [
                        'id'       => 'osf_scroll_top_color',
                        'key'      => 'normal',
                        'label'    => esc_html__( 'Normal', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-right li #scroll-top' => 'color',
                            '#footer-bar .osf-right li #scroll-top .owp-icon use' => 'stroke',
                        ],
                        'attr' => [
                            'transport' => 'postMessage',
                            'default'   => '#ffffff',
                        ],
                    ],
                    'hover' => [
                        'id'       => 'osf_scroll_top_hover_color',
                        'key'      => 'hover',
                        'label'    => esc_html__( 'Hover', 'ocean-sticky-footer' ),
                        'selector' => [
                            '#footer-bar .osf-right li #scroll-top:hover' => 'color',
                            '#footer-bar .osf-right li #scroll-top:hover .owp-icon use' => 'stroke'
                        ],
                        'attr'     => [
                            'transport' => 'postMessage',
                            'default'   => '#ffffff',
                        ],
                    ]
                ]
            ],

			'ofs_footer_content_for_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-sticky-footer' ), '<a href="https://docs.oceanwp.org/article/917-customizer-sticky-footer/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_sticky_footer_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
            ],

        ]
    ];

    return apply_filters( 'osf_customizer_options', $options );

}
