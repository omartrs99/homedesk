<?php
/**
 * OceanWP Customizer Class
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Options
 */
function op_customizer_options() {

	$options = [
		'title'    => esc_html__( 'Portfolio', 'ocean-portfolio' ),
		'priority' => 11,
		'options'  => [
			'op_spacer_for_general_section' => [
				'type'      => 'ocean-spacer',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
				'top'       => 1,
				'bottom'    => 10,
			],

			'op_portfolio_general_section' => [
				'type'     => 'section',
				'title'    => esc_html__('General', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_spacer_for_general_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_portfolio_page' => [
						'type'              => 'ocean-dropdown-pages',
						'label'             => esc_html__( 'Portfolio Page', 'ocean-portfolio' ),
						'desc'              => esc_html__('Select the main portfolio page. This page will be linked in breadcrumbs.', 'ocean-portfolio'),
						'section'           => 'op_portfolio_general_section',
						'transport'         => 'refresh',
						'default'           => '',
						'priority'          => 10,
						'hideLabel'         => false,
						'multiple'          => false,
						'sanitize_callback' => 'oceanwp_sanitize_dropdown_pages',
					],

					'op_divider_after_portfolio_page_setting' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_general_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'op_portfolio_slug' => [
						'label'             => esc_html__( 'Portfolio Item Slug', 'ocean-portfolio' ),
						'desc'              => esc_html__( 'If you edit this field, you will need to update permalinks to avoid broken links.', 'ocean-portfolio' ),
						'type'              => 'ocean-text',
						'section'           => 'op_portfolio_general_section',
						'transport'         => 'postMessage',
						'default'           => 'portfolio',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
					],

					'op_spacer_after_portfolio_slug' => [
						'type'      => 'ocean-spacer',
						'section'   => 'op_portfolio_general_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'op_portfolio_category_slug' => [
						'label'             => esc_html__( 'Portfolio Category Slug', 'ocean-portfolio' ),
						'desc'              => esc_html__( 'If you edit this field, you will need to update permalinks to avoid broken links.', 'ocean-portfolio' ),
						'type'              => 'ocean-text',
						'section'           => 'op_portfolio_general_section',
						'transport'         => 'postMessage',
						'default'           => 'portfolio-category',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
					],

					'op_spacer_after_category_slug' => [
						'type'      => 'ocean-spacer',
						'section'   => 'op_portfolio_general_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'op_portfolio_tag_slug' => [
						'label'              => esc_html__( 'Portfolio Tag Slug', 'ocean-portfolio' ),
						'desc'              => esc_html__( 'If you edit this field, you will need to update permalinks to avoid broken links.', 'ocean-portfolio' ),
						'type'              => 'ocean-text',
						'section'           => 'op_portfolio_general_section',
						'transport'         => 'postMessage',
						'default'           => 'portfolio-tag',
						'priority'          => 10,
						'hideLabel'         => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
					],

					'op_general_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#General-edFgd/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_general_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],
				]
			],

			'op_divider_for_archive_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'op_portfolio_archive_section' => [
				'type'     => 'section',
				'title'    => esc_html__('Archive', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_divider_for_archive_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_portfolio_archive_layout' => [
						'label'             => esc_html__( 'Layout', 'ocean-portfolio' ),
						'type'              => 'ocean-radio-image',
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'refresh',
						'default'           => 'full-width',
						'priority'          => 10,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'right-sidebar' => [
								'label' => esc_html__( 'Right Sidebar', 'ocean-portfolio' ),
								'icon'  => 'right-sidebar',
							],
							'left-sidebar'  => [
								'label' => esc_html__( 'Left Sidebar', 'ocean-portfolio' ),
								'icon'  => 'left-sidebar',
							],
							'full-width'    => [
								'label' => esc_html__( 'Full Width', 'ocean-portfolio' ),
								'icon'  => 'full_width-no_sidebar',
							],
							'full-screen'   => [
								'label' => esc_html__( '100% Full Width', 'ocean-portfolio' ),
								'icon'  => 'fullscreen_width',
							],
							'both-sidebars' => [
								'label' => esc_html__( 'Both Sidebar', 'ocean-portfolio' ),
								'icon'  => 'both_sidebar_layout',
							]
						]
					],

					'op_divider_after_portfolio_archive_layout_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

					'op_portfolio_archive_both_sidebars_style' => [
						'type'              => 'ocean-select',
						'label'             => esc_html__('Both Sidebars: Style', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'refresh',
						'default'           => 'scs-style',
						'priority'          => 10,
						'hideLabel'         => false,
						'multiple'          => false,
						'active_callback'   => 'op_portfolio_cac_has_archive_bs_layout',
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'ocean-portfolio' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'ocean-portfolio' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'ocean-portfolio' ),
						],
					],

					'op_portfolio_archive_both_sidebars_content_width' => [
						'label'             => esc_html__( 'Both Sidebars: Content Width', 'ocean-portfolio' ),
						'type'              => 'ocean-range-slider',
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'isUnit'            => true,
						'isResponsive'      => false,
						'min'               => 0,
						'max'               => 100,
						'step'              => 1,
						'active_callback'   => 'op_portfolio_cac_has_archive_bs_layout',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args'      => [
							'desktop' => [
								'id'    => 'op_portfolio_archive_both_sidebars_content_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id'    => 'op_portfolio_archive_both_sidebars_content_width_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default' => '%',
								],
							],
						],
					],

					'op_portfolio_archive_both_sidebars_sidebars_width' => [
						'label'             => esc_html__( 'Both Sidebars: Each Sidebar Width', 'ocean-portfolio' ),
						'type'              => 'ocean-range-slider',
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'postMessage',
						'priority'          => 10,
						'hideLabel'         => false,
						'isUnit'            => true,
						'isResponsive'      => false,
						'min'               => 0,
						'max'               => 100,
						'step'              => 1,
						'active_callback'   => 'op_portfolio_cac_has_archive_bs_layout',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args'      => [
							'desktop' => [
								'id'    => 'op_portfolio_archive_both_sidebars_sidebars_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id'    => 'op_portfolio_archive_both_sidebars_sidebars_width_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default' => '%',
								],
							],
						],
					],

					'op_divider_after_portfolio_archive_both_sidebars_width_settings' => [
						'type'            => 'ocean-divider',
						'section'         => 'op_portfolio_archive_section',
						'transport'       => 'postMessage',
						'priority'        => 10,
						'top'             => 1,
						'active_callback' => 'op_portfolio_cac_has_archive_bs_layout',
					],

					'op_portfolio_posts_per_page' => [
						'label'	            => esc_html__( 'Posts Per Page', 'ocean-portfolio' ),
						'desc'              => esc_html__( 'Insert -1 to display all portfolio items. Default number of items is 12.', 'ocean-portfolio' ),
						'type'              => 'ocean-range-slider',
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'isUnit'            => false,
						'isResponsive'      => false,
						'min'               => -1,
						'max'               => 500,
						'step'              => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args'      => [
							'desktop' => [
								'id'    => 'op_portfolio_posts_per_page',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 12,
								],
							]
						],
					],

					'op_divider_after_portfolio_posts_per_page_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_columns' => [
						'label'	            => esc_html__( 'Columns', 'ocean-portfolio' ),
						'type'              => 'ocean-range-slider',
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'isUnit'            => false,
						'isResponsive'      => true,
						'min'               => 1,
						'max'               => 10,
						'step'              => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args'      => [
							'desktop' => [
								'id'    => 'op_portfolio_columns',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 3,
								],
							],
							'tablet' => [
								'id'    => 'op_portfolio_tablet_columns',
								'label' => esc_html__( 'Tablet', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 2,
								],
							],
							'mobile' => [
								'id'    => 'op_portfolio_mobile_columns',
								'label' => esc_html__( 'Mobile', 'ocean-portfolio' ),
								'attr'  => [
									'transport' => 'postMessage',
									'default'   => 2,
								],
							]
						],
					],

					'op_divider_after_portfolio_columns_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_masonry' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Masonry', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'off',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'on'  => [
								'id'      => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off' => [
								'id'      => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_masonry_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_title_cat_position' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Title / Category Position', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'outside',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'inside'  => [
								'id'      => 'inside',
								'label'   => esc_html__('Inside', 'ocean-portfolio'),
								'content' => esc_html__('Inside', 'ocean-portfolio'),
							],
							'outside' => [
								'id'      => 'outside',
								'label'   => esc_html__('Outside', 'ocean-portfolio'),
								'content' => esc_html__('Outside', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_title_cat_position_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_title' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Display Title', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'on',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'on'  => [
								'id'      => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off' => [
								'id'      => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_title_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_add_title_link' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Add Title Link', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'on',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'on'  => [
								'id'      => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off' => [
								'id'      => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_add_title_link_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_title_tag' => [
						'type'              => 'ocean-select',
						'label'             => esc_html__('Title HTML Tag', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'transport'         => 'refresh',
						'default'           => 'h3',
						'priority'          => 10,
						'hideLabel'         => false,
						'multiple'          => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback'   => 'op_portfolio_cac_has_title',
						'choices' 			=> array(
							'h1'   => esc_html__( 'H1', 'ocean-portfolio' ),
							'h2'   => esc_html__( 'H2', 'ocean-portfolio' ),
							'h3'   => esc_html__( 'H3', 'ocean-portfolio' ),
							'h4'   => esc_html__( 'H4', 'ocean-portfolio' ),
							'h5'   => esc_html__( 'H5', 'ocean-portfolio' ),
							'h6'   => esc_html__( 'H6', 'ocean-portfolio' ),
							'div'  => esc_html__( 'div', 'ocean-portfolio' ),
							'span' => esc_html__( 'span', 'ocean-portfolio' ),
							'p'    => esc_html__( 'p', 'ocean-portfolio' ),
						),
					],

					'op_divider_after_portfolio_title_tag_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 10,
						'bottom'    => 10,
					],

					'op_portfolio_category' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Display Category', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'on',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'on'  => [
								'id'      => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off' => [
								'id'      => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_category_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_pagination' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Display Pagination', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'off',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'on'  => [
								'id'      => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off' => [
								'id'      => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_pagination_settings' => [
						'type'      => 'ocean-divider',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
						'top'       => 1,
						'bottom'    => 10,
					],

					'op_portfolio_pagination_position' => [
						'type'              => 'ocean-buttons',
						'label'             => esc_html__( 'Pagination Position', 'ocean-portfolio' ),
						'section'           => 'op_portfolio_archive_section',
						'default'           => 'center',
						'transport'         => 'refresh',
						'priority'          => 10,
						'hideLabel'         => false,
						'wrap'              => false,
						'sanitize_callback' => 'sanitize_key',
						'choices'           => [
							'left'   => [
								'id'      => 'left',
								'label'   => esc_html__( 'Left', 'ocean-portfolio' ),
								'content' => esc_html__( 'Left', 'ocean-portfolio' ),
							],
							'center' => [
								'id'      => 'center',
								'label'   => esc_html__( 'Center', 'ocean-portfolio' ),
								'content' => esc_html__( 'Center', 'ocean-portfolio' ),
							],
							'right'  => [
								'id'      => 'right',
								'label'   => esc_html__( 'Right', 'ocean-portfolio' ),
								'content' => esc_html__( 'Right', 'ocean-portfolio' ),
							]
						]
					],

					'op_archives_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#Archive-LX2di/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],
				]
			],

			'op_divider_for_filter_bar_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'op_portfolio_filter_bar_section' => [
				'type'     => 'section',
				'title'    => esc_html__('Filter Bar', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_divider_for_filter_bar_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_portfolio_filter' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Display Filter', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'default'  => 'off',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'on' => [
								'id'     => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off'  => [
								'id'     => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_filter_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter',
					],

					'op_portfolio_filter_type' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Filter Type', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'default'  => 'default',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_filter',
						'choices' => [
							'default' => [
								'id'     => 'default',
								'label'   => esc_html__('Default', 'ocean-portfolio'),
								'content' => esc_html__('Default', 'ocean-portfolio'),
							],
							'button'  => [
								'id'     => 'button',
								'label'   => esc_html__('Filter Button', 'ocean-portfolio'),
								'content' => esc_html__('Filter Button', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_filter_type_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter',
					],

					'op_portfolio_all_filter' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Display Link All', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'default'  => 'on',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'choices' => [
							'on' => [
								'id'     => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off'  => [
								'id'     => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_all_filter_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_filter_position' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Filter Position', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'default'  => 'center',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_filter',
						'choices' => [
							'full' => [
								'id'     => 'full',
								'label'   => esc_html__('Full', 'ocean-portfolio'),
								'content' => esc_html__('Full', 'ocean-portfolio'),
							],
							'left'  => [
								'id'     => 'left',
								'label'   => esc_html__('Left', 'ocean-portfolio'),
								'content' => esc_html__('Left', 'ocean-portfolio'),
							],
							'center'  => [
								'id'     => 'center',
								'label'   => esc_html__('Center', 'ocean-portfolio'),
								'content' => esc_html__('Center', 'ocean-portfolio'),
							],
							'right'  => [
								'id'     => 'right',
								'label'   => esc_html__('Right', 'ocean-portfolio'),
								'content' => esc_html__('Right', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_filter_position_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_filter_taxonomy' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Taxonomy', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'default'  => 'categories',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'choices' => [
							'categories' => [
								'id'     => 'categories',
								'label'   => esc_html__('Categories', 'ocean-portfolio'),
								'content' => esc_html__('Categories', 'ocean-portfolio'),
							],
							'tags'  => [
								'id'     => 'tags',
								'label'   => esc_html__('Tags', 'ocean-portfolio'),
								'content' => esc_html__('tags', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_filter_taxonomy_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_responsive_filter_links' => [
						'type' => 'ocean-select',
						'label' => esc_html__( 'Responsive Filter Links', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Choose the media query where you want the filter bar links to be full width.', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'refresh',
						'default' => '480',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'1280' 		=> esc_html__( 'From 1280px', 'ocean-portfolio' ),
							'1080' 		=> esc_html__( 'From 1080px', 'ocean-portfolio' ),
							'959' 		=> esc_html__( 'From 959px', 'ocean-portfolio' ),
							'767' 		=> esc_html__( 'From 767px', 'ocean-portfolio' ),
							'480' 		=> esc_html__( 'From 480px', 'ocean-portfolio' ),
							'320' 		=> esc_html__( 'From 320px', 'ocean-portfolio' ),
							'custom' 	=> esc_html__( 'Custom media query', 'ocean-portfolio' ),
						],
					],

					'op_divider_after_portfolio_responsive_filter_links_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_responsive_filter_links_custom' => [
						'label' => esc_html__( 'Custom Media Query', 'ocean-portfolio' ),
						'desc'=> esc_html__( 'Enter your custom media query where you want the filter bar links to be full width.', 'ocean-portfolio' ),
						'type' => 'ocean-range-slider',
						'section' => 'op_portfolio_archive_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 2000,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_custom_responsive_filter_links',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_responsive_filter_links_custom',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'op_divider_after_portfolio_responsive_ilter_links_custom_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_custom_responsive_filter_links',
					],

					'op_portfolio_filter_margin' => [
						'label'	=> esc_html__( 'Filter Bar Margin', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
						'type' => 'ocean-text',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'default'   => '',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_filter_links_margin' => [
						'label'	=> esc_html__( 'Filter Links: Margin', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
						'type' => 'ocean-text',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'default'   => '',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_filter_links_padding' => [
						'label'	=> esc_html__( 'Filter Links: Padding', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
						'type' => 'ocean-text',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'default'   => '',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_divider_after_portfolio_filter_links_padding_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
					],

					'op_portfolio_filter_links_bg' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Filter Links: Background Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_links_bg',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-filters li a' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#f6f6f6',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_hover_links_bg',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-filters li a:hover' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#13aff0',
								],
							],
						]
					],

					'op_portfolio_filter_links_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Filter Links: Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_links_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-filters li a' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#444444',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_hover_links_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-filters li a:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#ffffff',
								],
							],
						]
					],

					'op_portfolio_filter_active_link_bg' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Filter Links: Active Background', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_active_link_bg',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-filters li.active a' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#13aff0',
								],
							]
						]
					],

					'op_portfolio_filter_active_link_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Filter Links: Active Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_default',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_active_link_color',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-filters li.active a' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#ffffff',
								],
							]
						]
					],

					'op_title_for_filter_bar_button_settings' => [
						'type' => 'ocean-title',
						'label' => esc_html__( 'Filter Button', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_button_icon' => [
						'label' => esc_html__( 'Filter Button Icon Class', 'ocean-portfolio' ),
						'desc' => esc_html__('Enter a full icon class to replace the default icon.', 'ocean-portfolio'),
						'type'     => 'ocean-text',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'default'   => 'menu',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_divider_after_filter_button_icon_class_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_button_top_padding' => [
						'id' => 'op_portfolio_filter_button_top_padding',
						'label'    => esc_html__( 'Padding (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-spacing',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isType'       => 'padding',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'spacingTop' => [
								'id' => 'op_portfolio_filter_button_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRight' => [
								'id' => 'op_portfolio_filter_button_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottom' => [
								'id' => 'op_portfolio_filter_button_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeft' => [
								'id' => 'op_portfolio_filter_button_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopTablet' => [
								'id' => 'op_portfolio_filter_button_tablet_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightTablet' => [
								'id' => 'op_portfolio_filter_button_tablet_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomTablet' => [
								'id' => 'op_portfolio_filter_button_tablet_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftTablet' => [
								'id' => 'op_portfolio_filter_button_tablet_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopMobile' => [
								'id' => 'op_portfolio_filter_button_mobile_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightMobile' => [
								'id' => 'op_portfolio_filter_button_mobile_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomMobile' => [
								'id' => 'op_portfolio_filter_button_mobile_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftMobile' => [
								'id' => 'op_portfolio_filter_button_mobile_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						],
						'preview' => 'queryWithType',
						'css' => [
							'selector' => '.filter-buttons-wrap a.open',
							'property' => 'padding'
						],
					],

					'op_divider_after_filter_button_padding_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_button_border_width' => [
						'id' => 'op_portfolio_filter_button_border_width',
						'label'	 => esc_html__( 'Border Width', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_button_border_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_button_border_width_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter-buttons-wrap a.open' => ['border-width']
						]
					],

					'op_portfolio_filter_button_border_radius' => [
						'id' => 'op_portfolio_filter_button_border_radius',
						'label'	 => esc_html__( 'Border Radius', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_button_border_radius',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_button_border_radius_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter-buttons-wrap a.open' => ['border-radius']
						]
					],

					'op_divider_after_filter_button_border_radius_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_button_text_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Text Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_button_text_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_button_text_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_button_bg_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Background Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_button_bg_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_button_bg_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open:hover' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_button_icon_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Icon Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_button_icon_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open i' => 'color',
									'.filter-buttons-wrap a.open .owp-icon use' => 'stroke'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_button_icon_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open:hover i' => 'color',
									'.filter-buttons-wrap a.open:hover .owp-icon use' => 'stroke'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_button_border_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Border Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_button_border_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_button_border_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter-buttons-wrap a.open:hover' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_title_for_filter_bar_reset_button_settings' => [
						'type' => 'ocean-title',
						'label' => esc_html__( 'Filter Reset Button', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_reset_button_icon' => [
						'label' => esc_html__( 'Reset Button Icon Class', 'ocean-portfolio' ),
						'desc' => esc_html__('Enter a full icon class to replace the default icon.', 'ocean-portfolio'),
						'type'     => 'ocean-text',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'default'   => 'sync',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_filter_nohtml_kses',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_divider_after_filter_reset_button_icon_class_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_reset_button_top_padding' => [
						'id' => 'op_portfolio_filter_reset_button_top_padding',
						'label'    => esc_html__( 'Padding (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-spacing',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isType'       => 'padding',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'spacingTop' => [
								'id' => 'op_portfolio_filter_reset_button_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRight' => [
								'id' => 'op_portfolio_filter_reset_button_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottom' => [
								'id' => 'op_portfolio_filter_reset_button_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeft' => [
								'id' => 'op_portfolio_filter_reset_button_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopTablet' => [
								'id' => 'op_portfolio_filter_reset_button_tablet_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightTablet' => [
								'id' => 'op_portfolio_filter_reset_button_tablet_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomTablet' => [
								'id' => 'op_portfolio_filter_reset_button_tablet_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftTablet' => [
								'id' => 'op_portfolio_filter_reset_button_tablet_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopMobile' => [
								'id' => 'op_portfolio_filter_reset_button_mobile_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightMobile' => [
								'id' => 'op_portfolio_filter_reset_button_mobile_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomMobile' => [
								'id' => 'op_portfolio_filter_reset_button_mobile_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftMobile' => [
								'id' => 'op_portfolio_filter_reset_button_mobile_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						],
						'preview' => 'queryWithType',
						'css' => [
							'selector' => '.filter--form-wrap .reset-button',
							'property' => 'padding'
						],
					],

					'op_divider_after_filter_reset_button_padding_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_reset_button_border_width' => [
						'id' => 'op_portfolio_filter_reset_button_border_width',
						'label'	 => esc_html__( 'Border Width', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_reset_button_border_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_reset_button_border_width_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter--form-wrap .reset-button' => ['border-width']
						]
					],

					'op_portfolio_filter_reset_button_border_radius' => [
						'id' => 'op_portfolio_filter_reset_button_border_radius',
						'label'	 => esc_html__( 'Border Radius', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_reset_button_border_radius',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_reset_button_border_radius_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter--form-wrap .reset-button' => ['border-radius']
						]
					],

					'op_divider_after_filter_reset_button_border_radius_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_reset_button_text_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Text Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_reset_button_text_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_reset_button_text_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_reset_button_bg_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Background Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_reset_button_bg_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_reset_button_bg_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_reset_button_icon_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Icon Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_reset_button_icon_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button i' => 'color',
									'.filter--form-wrap .reset-button .owp-icon use' => 'stroke'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_reset_button_icon_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover i' => 'color',
									'.filter--form-wrap .reset-button:hover .owp-icon use' => 'stroke'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_reset_button_border_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Border Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_reset_button_border_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_reset_button_border_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_title_for_filter_bar_apply_button_settings' => [
						'type' => 'ocean-title',
						'label' => esc_html__( 'Filter Apply Button', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_apply_button_top_padding' => [
						'id' => 'op_portfolio_filter_apply_button_top_padding',
						'label'    => esc_html__( 'Padding (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-spacing',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isType'       => 'padding',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'spacingTop' => [
								'id' => 'op_portfolio_filter_apply_button_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRight' => [
								'id' => 'op_portfolio_filter_apply_button_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottom' => [
								'id' => 'op_portfolio_filter_apply_button_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeft' => [
								'id' => 'op_portfolio_filter_apply_button_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopTablet' => [
								'id' => 'op_portfolio_filter_apply_button_tablet_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightTablet' => [
								'id' => 'op_portfolio_filter_apply_button_tablet_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomTablet' => [
								'id' => 'op_portfolio_filter_apply_button_tablet_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftTablet' => [
								'id' => 'op_portfolio_filter_apply_button_tablet_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopMobile' => [
								'id' => 'op_portfolio_filter_apply_button_mobile_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightMobile' => [
								'id' => 'op_portfolio_filter_apply_button_mobile_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomMobile' => [
								'id' => 'op_portfolio_filter_apply_button_mobile_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftMobile' => [
								'id' => 'op_portfolio_filter_apply_button_mobile_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						],
						'preview' => 'queryWithType',
						'css' => [
							'selector' => '.filter--form-wrap .apply-button',
							'property' => 'padding'
						],
					],

					'op_divider_after_filter_apply_button_padding_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_apply_button_border_width' => [
						'id' => 'op_portfolio_filter_apply_button_border_width',
						'label'	 => esc_html__( 'Border Width', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_apply_button_border_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_apply_button_border_width_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter--form-wrap .apply-button' => ['border-width']
						]
					],

					'op_portfolio_filter_apply_button_border_radius' => [
						'id' => 'op_portfolio_filter_apply_button_border_radius',
						'label'	 => esc_html__( 'Border Radius', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_apply_button_border_radius',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_apply_button_border_radius_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter--form-wrap .apply-button' => ['border-radius']
						]
					],

					'op_divider_after_filter_apply_button_border_radius_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_apply_button_text_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Text Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_apply_button_text_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .apply-button' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_apply_button_text_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .apply-button:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_apply_button_bg_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Background Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_apply_button_bg_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .apply-button' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_apply_button_bg_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .apply-button:hover' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_apply_button_border_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Border Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_apply_button_border_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .apply-button' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_apply_button_border_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .apply-button:hover' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_title_for_filter_bar_inside_reset_button_settings' => [
						'type' => 'ocean-title',
						'label' => esc_html__( 'Filter Inside Reset Button', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_inside_reset_button_top_padding' => [
						'id' => 'op_portfolio_filter_inside_reset_button_top_padding',
						'label'    => esc_html__( 'Padding (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-spacing',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isType'       => 'padding',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'spacingTop' => [
								'id' => 'op_portfolio_filter_inside_reset_button_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRight' => [
								'id' => 'op_portfolio_filter_inside_reset_button_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottom' => [
								'id' => 'op_portfolio_filter_inside_reset_button_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeft' => [
								'id' => 'op_portfolio_filter_inside_reset_button_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopTablet' => [
								'id' => 'op_portfolio_filter_inside_reset_button_tablet_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightTablet' => [
								'id' => 'op_portfolio_filter_inside_reset_button_tablet_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomTablet' => [
								'id' => 'op_portfolio_filter_inside_reset_button_tablet_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftTablet' => [
								'id' => 'op_portfolio_filter_inside_reset_button_tablet_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingTopMobile' => [
								'id' => 'op_portfolio_filter_inside_reset_button_mobile_top_padding',
								'label' => esc_html__( 'Top', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingRightMobile' => [
								'id' => 'op_portfolio_filter_inside_reset_button_mobile_right_padding',
								'label' => esc_html__( 'Right', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingBottomMobile' => [
								'id' => 'op_portfolio_filter_inside_reset_button_mobile_bottom_padding',
								'label' => esc_html__( 'Bottom', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'spacingLeftMobile' => [
								'id' => 'op_portfolio_filter_inside_reset_button_mobile_left_padding',
								'label' => esc_html__( 'Left', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						],
						'preview' => 'queryWithType',
						'css' => [
							'selector' => '.filter--form-wrap .reset-button',
							'property' => 'padding'
						],
					],

					'op_divider_after_filter_inside_reset_button_padding_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_inside_reset_button_border_width' => [
						'id' => 'op_portfolio_filter_inside_reset_button_border_width',
						'label'	 => esc_html__( 'Border Width', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_inside_reset_button_border_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_inside_reset_button_border_width_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter--form-wrap .reset-button' => ['border-width']
						]
					],

					'op_portfolio_filter_inside_reset_button_border_radius' => [
						'id' => 'op_portfolio_filter_inside_reset_button_border_radius',
						'label'	 => esc_html__( 'Border Radius', 'ocean-portfolio' ),
						'type'  => 'ocean-range-slider',
						'section'  => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => true,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 50,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_filter_inside_reset_button_border_radius',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'unit' => [
								'id' => 'op_portfolio_filter_inside_reset_button_border_radius_unit',
								'label' => esc_html__( 'Unit', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'px'
								],
							]
						],
						'preview' => 'queryWithType',
						'css' => [
							'.filter--form-wrap .reset-button' => ['border-radius']
						]
					],

					'op_divider_after_filter_inside_reset_button_border_radius_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
					],

					'op_portfolio_filter_inside_reset_button_text_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Text Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_inside_reset_button_text_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_inside_reset_button_text_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_inside_reset_button_bg_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Background Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_inside_reset_button_bg_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_inside_reset_button_bg_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_filter_inside_reset_button_border_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Border Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_filter_type_button',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_filter_inside_reset_button_border_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_filter_inside_reset_button_border_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.filter--form-wrap .reset-button:hover' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_filter_bar_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#Filter-Bar-lxzhB/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_filter_bar_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

				]
			],

			'op_divider_for_portfolio_image_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'op_portfolio_image_section' => [
				'type'     => 'section',
				'title'    => esc_html__('Image', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_divider_for_portfolio_image_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_portfolio_image_target' => [
						'type' => 'ocean-buttons',
						'label'	=> esc_html__( 'Image Target', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Choose if you want to open your portfolio item or a lightbox to the image click.', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'default'  => 'item',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'item' => [
								'id'     => 'item',
								'label'   => esc_html__('Open Portfolio Item', 'ocean-portfolio'),
								'content' => esc_html__('Open Portfolio Item', 'ocean-portfolio'),
							],
							'lightbox'  => [
								'id'     => 'lightbox',
								'label'   => esc_html__('Open Lightbox', 'ocean-portfolio'),
								'content' => esc_html__('Open Lightbox', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_portfolio_image_target_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_size' => [
						'type' => 'ocean-select',
						'label' => esc_html__('Image Size', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default' => 'medium',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => op_portfolio_helpers( 'img_sizes' ),
					],

					'op_divider_after_portfolio_size_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_img_width' => [
						'label'       => esc_html__( 'Image Width', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 1000,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_image_custom_size',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_img_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'op_portfolio_img_height' => [
						'label'       => esc_html__( 'Image Width', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 1000,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'active_callback' => 'op_portfolio_cac_has_image_custom_size',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_img_height',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'op_divider_after_portfolio_img_height_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_image_custom_size',
					],

					'op_portfolio_img_overlay_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Overlay Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_img_overlay_color',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .overlay' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'rgba(0,0,0,0.4)',
								],
							]
						]
					],

					'op_divider_after_portfolio_img_overlay_color_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_img_overlay_icons' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Display Overlay Icons', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'default'  => 'on',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'on' => [
								'id'     => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off'  => [
								'id'     => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_portfolio_img_overlay_link_icon' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Display Link Icon', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'default'  => 'on',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'choices' => [
							'on' => [
								'id'     => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off'  => [
								'id'     => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_portfolio_img_overlay_lightbox_icon' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Display Lightbox Icon', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'default'  => 'on',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'choices' => [
							'on' => [
								'id'     => 'on',
								'label'   => esc_html__('On', 'ocean-portfolio'),
								'content' => esc_html__('On', 'ocean-portfolio'),
							],
							'off'  => [
								'id'     => 'off',
								'label'   => esc_html__('Off', 'ocean-portfolio'),
								'content' => esc_html__('Off', 'ocean-portfolio'),
							]
						]
					],

					'op_divider_after_img_overlay_lightbox_icon_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
					],

					'op_portfolio_img_overlay_icons_width' => [
						'label'       => esc_html__( 'Overlay Icons Width (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 600,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_img_overlay_icons_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 45,
								],
							]
						],
					],

					'op_portfolio_img_overlay_icons_height' => [
						'label'       => esc_html__( 'Overlay Icons Height (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 600,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_img_overlay_icons_height',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 45,
								],
							]
						],
					],

					'op_portfolio_img_overlay_icons_size' => [
						'label'       => esc_html__( 'Overlay Icons Size (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 600,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_img_overlay_icons_height',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 16,
								],
							]
						],
					],

					'op_divider_after_img_overlay_icons_size_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
					],

					'op_portfolio_img_overlay_icons_bg' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Overlay Icons Background', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_img_overlay_icons_bg',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'rgba(255,255,255,0.2)',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_img_overlay_icons_hover_bg',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a:hover' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'rgba(255,255,255,0.4)',
								],
							],
						]
					],

					'op_portfolio_img_overlay_icons_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Overlay Icons Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_img_overlay_icons_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a' => 'color',
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a .owp-icon use' => 'stroke'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#ffffff',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_img_overlay_icons_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a:hover' => 'color',
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li:hover a .owp-icon use' => 'stroke'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#ffffff',
								],
							],
						]
					],

					'op_divider_after_img_overlay_icons_color_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
					],

					'op_portfolio_img_overlay_icons_border_radius' => [
						'label'	=> esc_html__( 'Overlay Icons Border Radius', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
						'type' => 'ocean-text',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'default'   => '',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'sanitize_text_field',
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
					],

					'op_portfolio_img_overlay_icons_border_width' => [
						'label'	=> esc_html__( 'Overlay Icons Border Width', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
						'type' => 'ocean-text',
						'section'  => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'default'   => '1px',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'sanitize_text_field',
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
					],

					'op_portfolio_img_overlay_icons_border_style' => [
						'type' => 'ocean-select',
						'label' => esc_html__('Overlay Icons Border Style', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'default' => 'solid',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'sanitize_callback' => 'sanitize_key',
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'choices' => [
							'none' => esc_html__( 'None', 'ocean-portfolio' ),
							'solid' => esc_html__( 'Solid', 'ocean-portfolio' ),
							'double' => esc_html__( 'Double', 'ocean-portfolio' ),
							'dashed' => esc_html__( 'Dashed', 'ocean-portfolio' ),
						],
					],

					'op_divider_after_img_overlay_icons_border_style_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
					],

					'op_portfolio_img_overlay_icons_border_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Overlay Icons Border', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_image_overlay_icons',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_img_overlay_icons_border_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => 'rgba(255,255,255,0.4)',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_img_overlay_icons_hover_border_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_img_animation_heading' => [
						'type' => 'ocean-title',
						'label' => esc_html__( 'Image Animation', 'ocean-portfolio' ),
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
					],

					'op_portfolio_img_animation' => [
						'type' => 'ocean-switch',
						'label' => esc_html__('Image Animation', 'ocean-portfolio'),
						'section' => 'op_portfolio_image_section',
						'default'  => false,
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'oceanwp_sanitize_checkbox',
					],

					'op_divider_after_img_animation_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_portfolio_img_animation_duration' => [
						'label' => esc_html__( 'Animation Duration', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Edit animation duration as per your need.', 'ocean-portfolio' ),
						'type'  => 'ocean-text',
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default'   => '10s',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_kses',
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_portfolio_img_animation_delay' => [
						'label' => esc_html__( 'Animation Delay', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Edit animation Delay as per your need.', 'ocean-portfolio' ),
						'type'  => 'ocean-text',
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default'   => '',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_kses',
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_portfolio_img_animation_transform_origin_initial' => [
						'label' => esc_html__( 'Transform Origin ( Initial )', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Set initial transform origin.', 'ocean-portfolio' ),
						'type'  => 'ocean-text',
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default'   => 'bottom left',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_kses',
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_portfolio_img_animation_transform_initial' => [
						'label' => esc_html__( 'Transform ( Initial )', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Set initial transform.', 'ocean-portfolio' ),
						'type'  => 'ocean-text',
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default'   => 'scale(1.0)',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_kses',
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_portfolio_img_animation_transform_origin_final' => [
						'label' => esc_html__( 'Transform Origin ( Final )', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Set final transform origin.', 'ocean-portfolio' ),
						'type'  => 'ocean-text',
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default'   => '',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_kses',
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_portfolio_img_animation_transform_final' => [
						'label' => esc_html__( 'Transform ( Final )', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Set transform origin.', 'ocean-portfolio' ),
						'type'  => 'ocean-text',
						'section' => 'op_portfolio_image_section',
						'transport' => 'refresh',
						'default'   => 'scale(1.3)',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'wp_kses',
						'active_callback' => 'op_portfolio_cac_has_img_animation',
					],

					'op_image_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#Image-gOgdj/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_image_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],
				]
			],

			'op_divider_for_portfolio_query_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'op_portfolio_query_section' => [
				'type'     => 'section',
				'title'    => esc_html__('Query', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_divider_for_portfolio_query_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_portfolio_authors' => [
						'type' => 'ocean-multiselect',
						'label' => esc_html__( 'Author', 'ocean-portfolio' ),
						'section' => 'op_portfolio_query_section',
						'default'  => [],
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'choices'  => op_portfolio_helpers( 'authors' ),
					],

					'op_portfolio_category_ids' => [
						'type' => 'ocean-multiselect',
						'label' => esc_html__( 'Categories', 'ocean-portfolio' ),
						'section' => 'op_portfolio_query_section',
						'default'  => [],
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'choices'  => op_portfolio_helpers( 'category_ids' ),
					],

					'op_portfolio_exclude_category' => [
						'type' => 'ocean-multiselect',
						'label' => esc_html__( 'Exclude Categories', 'ocean-portfolio' ),
						'section' => 'op_portfolio_query_section',
						'default'  => [],
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'choices'  => op_portfolio_helpers( 'category_ids' ),
					],

					'op_portfolio_tags' => [
						'type' => 'ocean-multiselect',
						'label' => esc_html__( 'Tags', 'ocean-portfolio' ),
						'section' => 'op_portfolio_query_section',
						'default'  => [],
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'choices'  => op_portfolio_helpers( 'tags' ),
					],

					'op_divider_after_portfolio_tags_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_query_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_offset' => [
						'label' => esc_html__( 'Offset', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Number of item to displace (this setting breaks pagination).', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_query_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 500,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_offset',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'op_divider_after_portfolio_offset_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_query_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_orderby' => [
						'type' => 'ocean-select',
						'label' => esc_html__( 'Order By', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Sort retrieved posts by parameter.', 'ocean-portfolio' ),
						'section' => 'op_portfolio_query_section',
						'transport' => 'refresh',
						'default' => 'date',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' 				=>[
							'none' 				=> esc_html__( 'No Order', 'ocean-portfolio' ),
							'ID' 				=> esc_html__( 'ID', 'ocean-portfolio' ),
							'author' 			=> esc_html__( 'Author', 'ocean-portfolio' ),
							'title' 			=> esc_html__( 'Title', 'ocean-portfolio' ),
							'name' 				=> esc_html__( 'Slug', 'ocean-portfolio' ),
							'type' 				=> esc_html__( 'Post Type', 'ocean-portfolio' ),
							'date' 				=> esc_html__( 'Date', 'ocean-portfolio' ),
							'modified' 			=> esc_html__( 'Modified', 'ocean-portfolio' ),
							'parent' 			=> esc_html__( 'Parent', 'ocean-portfolio' ),
							'rand' 				=> esc_html__( 'Random', 'ocean-portfolio' ),
							'comment_count' 	=> esc_html__( 'Comment Count', 'ocean-portfolio' )
						],
					],

					'op_divider_after_portfolio_orderby_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_query_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_order' => [
						'type' => 'ocean-buttons',
						'label'	=> esc_html__( 'Order', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Designates the ascending or descending order.', 'ocean-portfolio' ),
						'section' => 'op_portfolio_query_section',
						'default'  => 'DESC',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'ASC' => [
								'id'     => 'ASC',
								'label'   => esc_html__('Ascending Order', 'ocean-portfolio'),
								'content' => esc_html__('Ascending Order', 'ocean-portfolio'),
							],
							'DESC'  => [
								'id'     => 'DESC',
								'label'   => esc_html__('Descending Order', 'ocean-portfolio'),
								'content' => esc_html__('Descending Order', 'ocean-portfolio'),
							]
						]
					],

					'op_query_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#Query-AH_OM/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_query_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

				]
			],

			'op_divider_for_single_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'op_portfolio_single_section' => [
				'type'     => 'section',
				'title'    => esc_html__('Single Portfolio Item', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_divider_for_single_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_portfolio_single_layout' => [
						'label' => esc_html__( 'Layout', 'ocean-portfolio' ),
						'type' => 'ocean-radio-image',
						'section' => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'default' => 'full-width',
						'priority' => 10,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'right-sidebar' => [
								'label' => esc_html__( 'Right Sidebar', 'ocean-portfolio' ),
								'icon' => 'right-sidebar',
							],
							'left-sidebar'  => [
								'label' => esc_html__( 'Left Sidebar', 'ocean-portfolio' ),
								'icon' => 'left-sidebar',
							],
							'full-width'    => [
								'label' => esc_html__( 'Full Width', 'ocean-portfolio' ),
								'icon' => 'full_width-no_sidebar',
							],
							'full-screen'   => [
								'label' => esc_html__( '100% Full Width', 'ocean-portfolio' ),
								'icon' => 'fullscreen_width',
							],
							'both-sidebars' => [
								'label' => esc_html__( 'Both Sidebar', 'ocean-portfolio' ),
								'icon' => 'both_sidebar_layout',
							]
						]
					],

					'ocean_divider_after_portfolio_single_layout_settings' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10
					],

					'op_portfolio_single_both_sidebars_style' => [
						'type' => 'ocean-select',
						'label' => esc_html__('Both Sidebars: Style', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'default' => 'scs-style',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'active_callback' => 'op_portfolio_cac_has_single_bs_layout',
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'ssc-style' => esc_html__( 'Sidebar / Sidebar / Content', 'ocean-portfolio' ),
							'scs-style' => esc_html__( 'Sidebar / Content / Sidebar', 'ocean-portfolio' ),
							'css-style' => esc_html__( 'Content / Sidebar / Sidebar', 'ocean-portfolio' ),
						],
					],

					'op_portfolio_single_both_sidebars_content_width' => [
						'label'       => esc_html__( 'Both Sidebars: Content Width', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 1,
						'max'          => 100,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_single_bs_layout',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_single_both_sidebars_content_width',
								'label' =>esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'op_portfolio_single_both_sidebars_sidebars_width' => [
						'label'       => esc_html__( 'Both Sidebars: Each Sidebar Width', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 1,
						'max'          => 100,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_single_bs_layout',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_single_both_sidebars_sidebars_width',
								'label' =>esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'ocean_divider_after_single_both_sidebars_sidebars_width' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_single_bs_layout',
					],

					'op_portfolio_single_featured_image_title' => [
						'type' => 'ocean-switch',
						'label' => esc_html__('Featured Image In Page Header', 'ocean-portfolio'),
						'section' => 'op_portfolio_single_section',
						'default'  => false,
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'oceanwp_sanitize_checkbox',
					],

					'op_portfolio_single_title_bg_image_height' => [
						'label'    => esc_html__( 'Page Header Height (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 1,
						'max'          => 800,
						'step'         => 1,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_single_title_bg_image_height',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 400
								],
							]
						]
					],

					'op_portfolio_single_title_bg_image_position' => [
						'id' => 'op_portfolio_single_title_bg_image_position',
						'type' => 'ocean-select',
						'label' => esc_html__('Position', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'default' => 'top center',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'initial'       => esc_html__( 'Default', 'ocean-portfolio' ),
							'top left'      => esc_html__( 'Top Left', 'ocean-portfolio' ),
							'top center'    => esc_html__( 'Top Center', 'ocean-portfolio' ),
							'top right'     => esc_html__( 'Top Right', 'ocean-portfolio' ),
							'center left'   => esc_html__( 'Center Left', 'ocean-portfolio' ),
							'center center' => esc_html__( 'Center Center', 'ocean-portfolio' ),
							'center right'  => esc_html__( 'Center Right', 'ocean-portfolio' ),
							'bottom left'   => esc_html__( 'Bottom Left', 'ocean-portfolio' ),
							'bottom center' => esc_html__( 'Bottom Center', 'ocean-portfolio' ),
							'bottom right'  => esc_html__( 'Bottom Right', 'ocean-portfolio' ),
						],
						'preview' => 'queryWithAttr',
						'css' => [
							'selector' => '.single-ocean_portfolio .page-header',
							'property' => 'background-position'
						]
					],

					'op_portfolio_single_title_bg_image_repeat' => [
						'id' => 'op_portfolio_single_title_bg_image_repeat',
						'type' => 'ocean-select',
						'label' => esc_html__('Repeat', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'default' => 'no-repeat',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'initial'   => esc_html__( 'Default', 'ocean-portfolio' ),
							'no-repeat' => esc_html__( 'No-repeat', 'ocean-portfolio' ),
							'repeat'    => esc_html__( 'Repeat', 'ocean-portfolio' ),
							'repeat-x'  => esc_html__( 'Repeat-x', 'ocean-portfolio' ),
							'repeat-y'  => esc_html__( 'Repeat-y', 'ocean-portfolio' ),
						],
						'preview' => 'queryWithAttr',
						'css' => [
							'selector' => '.single-ocean_portfolio .page-header',
							'property' => 'background-repeat'
						]
					],

					'op_portfolio_single_title_bg_image_attachment' => [
						'id' => 'op_portfolio_single_title_bg_image_attachment',
						'type' => 'ocean-buttons',
						'label' => esc_html__('Attachment', 'ocean-portfolio'),
						'section' => 'op_portfolio_single_section',
						'default'  => 'initial',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'initial' => [
								'id'     => 'initial',
								'label'   => esc_html__('Initial', 'ocean-portfolio'),
								'content' => 'Initial'
							],
							'scroll'  => [
								'id'     => 'scroll',
								'label'   => esc_html__('Scroll', 'ocean-portfolio'),
								'content' => 'Scroll'
							],
							'fixed'  => [
								'id'     => 'fixed',
								'label'   => esc_html__('Fixed', 'ocean-portfolio'),
								'content' => 'Fixed'
							]
						],
						'preview' => 'queryWithAttr',
						'css' => [
							'selector' => '.single-ocean_portfolio .page-header',
							'property' => 'background-attachment'
						]
					],

					'op_portfolio_single_title_bg_image_size' => [
						'id' => 'op_portfolio_single_title_bg_image_size',
						'type' => 'ocean-buttons',
						'label' => esc_html__('Size', 'ocean-portfolio'),
						'section' => 'op_portfolio_single_section',
						'default'  => 'cover',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'initial' => [
								'id'     => 'initial',
								'label'   => esc_html__('Default', 'ocean-portfolio'),
								'content' => 'Initial'
							],
							'auto'  => [
								'id'     => 'auto',
								'label'   => esc_html__('Auto', 'ocean-portfolio'),
								'content' => 'Auto'
							],
							'cover'  => [
								'id'     => 'cover',
								'label'   => esc_html__('Cover', 'ocean-portfolio'),
								'content' => 'Cover'
							],
							'contain'  => [
								'id'     => 'contain',
								'label'   => esc_html__('Contain', 'ocean-portfolio'),
								'content' => 'Contain'
							]
						],
						'preview' => 'queryWithAttr',
						'css' => [
							'selector' => '.single-ocean_portfolio .page-header',
							'property' => 'background-size'
						]
					],

					'ocean_divider_after_single_title_bg_image_size' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
					],

					'op_portfolio_single_title_bg_image_overlay_opacity' => [
						'label'    => esc_html__( 'Overlay Opacity', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0.1,
						'max'          => 1,
						'step'         => 0.1,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'oceanwp_sanitize_number',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_single_title_bg_image_overlay_opacity',
								'label' =>esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 0.5
								],
							]
						]
					],

					'op_portfolio_single_title_bg_image_overlay_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Overlay Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'active_callback' => 'op_portfolio_cac_has_single_title_bg_image',
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_single_title_bg_image_overlay_color',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.single-ocean_portfolio .background-image-page-header-overlay' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default'   => '#000000',
								],
							],
						]
					],

					'ocean_divider_after_single_title_bg_image_overlay_color' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
					],

					'op_portfolio_single_title_tag' => [
						'type' => 'ocean-select',
						'label' => esc_html__('Title HTML Tag', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'default' => 'h2',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' 				=> array(
							'h1' 		=> esc_html__( 'H1', 'ocean-portfolio' ),
							'h2' 		=> esc_html__( 'H2', 'ocean-portfolio' ),
							'h3' 		=> esc_html__( 'H3', 'ocean-portfolio' ),
							'h4' 		=> esc_html__( 'H4', 'ocean-portfolio' ),
							'h5' 		=> esc_html__( 'H5', 'ocean-portfolio' ),
							'h6' 		=> esc_html__( 'H6', 'ocean-portfolio' ),
							'div' 		=> esc_html__( 'div', 'ocean-portfolio' ),
							'span' 		=> esc_html__( 'span', 'ocean-portfolio' ),
							'p' 		=> esc_html__( 'p', 'ocean-portfolio' ),
						),
					],

					'ocean_divider_after_single_title_tag_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
					],

					'op_portfolio_single_elements_positioning' => [
						'label' => esc_html__( 'Elements Positioning', 'ocean-portfolio' ),
						'type' => 'ocean-sortable',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'default'  => [ 'featured_image', 'title', 'meta', 'content', 'tags', 'social_share', 'next_prev', 'related_portfolio', 'single_comments' ],
						'hideLabel' => false,
						'choices' => op_portfolio_single_elements(),
						'sanitize_callback' => 'ocean_sanitize_sortable_control',
					],

					'op_portfolio_single_meta' => [
						'label' => esc_html__( 'Meta Positioning', 'ocean-portfolio' ),
						'type' => 'ocean-sortable',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'default'  => [ 'author', 'date', 'categories', 'comments' ],
						'hideLabel' => false,
						'sanitize_callback' => 'ocean_sanitize_sortable_control',
						'choices' => apply_filters( 'op_portfolio_meta_choices',
							[
								'author'     => esc_html__( 'Author', 'ocean-portfolio' ),
								'date'       => esc_html__( 'Date', 'ocean-portfolio' ),
								'categories' => esc_html__( 'Categories', 'ocean-portfolio' ),
								'comments'   => esc_html__( 'Comments', 'ocean-portfolio' ),
							]
						),
					],

					'ocean_divider_after_single_meta_positioning_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
					],

					'op_portfolio_related_count' => [
						'label'       => esc_html__( 'Related Portfolio Count', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 2,
						'max'          => 12,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_related_count',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 3,
								],
							]
						],
					],

					'ocean_divider_after_single_related_count_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
					],

					'op_portfolio_related_columns' => [
						'label'       => esc_html__( 'Related Posts Columns', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 1,
						'max'          => 6,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_related_columns',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
									'default' => 3,
								],
							]
						],
					],

					'ocean_divider_after_single_related_columns_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
					],

					'op_portfolio_related_img_width' => [
						'label'       => esc_html__( 'Related Posts Image Width (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 800,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_related_img_width',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'op_portfolio_related_img_height' => [
						'label'       => esc_html__( 'Related Posts Image Height (px)', 'ocean-portfolio' ),
						'type'     => 'ocean-range-slider',
						'section'  => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel'    => false,
						'isUnit'       => false,
						'isResponsive' => false,
						'min'          => 0,
						'max'          => 800,
						'step'         => 1,
						'sanitize_callback' => 'oceanwp_sanitize_number_blank',
						'setting_args' => [
							'desktop' => [
								'id' => 'op_portfolio_related_img_height',
								'label' => esc_html__( 'Desktop', 'ocean-portfolio' ),
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						],
					],

					'ocean_divider_after_single_related_img_height_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10,
					],

					'ocean_portfolio_single_meta_style' => [
						'type' => 'ocean-buttons',
						'label' => esc_html__( 'Meta Style', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'default'  => 'stylish',
						'transport' => 'refresh',
						'priority' => 10,
						'hideLabel' => false,
						'wrap'    => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'minimal' => [
								'id'     => 'minimal',
								'label'   => esc_html__('Minimal', 'ocean-portfolio'),
								'content' => esc_html__('Minimal', 'ocean-portfolio'),
							],
							'stylish'  => [
								'id'     => 'stylish',
								'label'   => esc_html__('Stylish', 'ocean-portfolio'),
								'content' => esc_html__('Stylish', 'ocean-portfolio'),
							]
						]
					],

					'ocean_portfolio_single_meta_separator' => [
						'type' => 'ocean-select',
						'label' => esc_html__( 'Meta Separator', 'ocean-portfolio' ),
						'section' => 'op_portfolio_single_section',
						'transport' => 'refresh',
						'default' => 'default',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'default' => esc_html__( 'Default', 'ocean-portfolio' ),
							'classic' => esc_html__( 'Classic', 'ocean-portfolio' ),
							'stylish' => esc_html__( 'Stylish', 'ocean-portfolio' ),
							'modern'  => esc_html__( 'Modern', 'ocean-portfolio' ),
							'none'    => esc_html__( 'None', 'ocean-portfolio' ),
						],
					],

					'op_single_portfolio_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#Single-Portfolio-Item-Lx4Kr/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_single_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],
				]
			],

			'op_divider_for_styling_section' => [
				'type'      => 'ocean-divider',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

			'op_portfolio_styling_section' => [
				'type'     => 'section',
				'title'    => esc_html__('Styling and Typography', 'ocean-portfolio'),
				'section'  => 'ocean_portfolio_settings',
				'after'    => 'op_divider_for_styling_section',
				'class'    => 'section-site-layout',
				'priority' => 10,
				'options'  => [
					'op_spacer_for_styling_desktop_style_section' => [
						'type' => 'ocean-spacer',
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10
					],

					'op_portfolio_styling_desktop_style_section' => [
						'type' => 'section',
						'title' => esc_html__('General Style', 'ocean-portfolio'),
						'section' => 'op_portfolio_styling_section',
						'after' => 'op_spacer_for_styling_desktop_style_section',
						'class' => 'section-site-layout',
						'priority' => 10,
						'options' => [
							'op_portfolio_item_margin' => [
								'label'	=> esc_html__( 'Item Margin', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_desktop_style_section',
								'transport' => 'postMessage',
								'default'   => '10px',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_item_padding' => [
								'label'	=> esc_html__( 'Item Padding', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_desktop_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_item_border_radius' => [
								'label'	=> esc_html__( 'Item Border Radius', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_desktop_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_item_border_width' => [
								'label'	=> esc_html__( 'Item Border Width', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_desktop_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

						]
					],

					'op_spacer_for_styling_tablet_style_section' => [
						'type' => 'ocean-spacer',
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
					],

					'op_portfolio_styling_tablet_style_section' => [
						'type' => 'section',
						'title' => esc_html__('Tablet Style', 'ocean-portfolio'),
						'section' => 'op_portfolio_styling_section',
						'after' => 'op_spacer_for_styling_tablet_style_section',
						'class' => 'section-site-layout',
						'priority' => 10,
						'options' => [
							'op_portfolio_tablet_item_margin' => [
								'label'	=> esc_html__( 'Item Margin', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_tablet_style_section',
								'transport' => 'postMessage',
								'default'   => '10px',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_tablet_item_padding' => [
								'label'	=> esc_html__( 'Item Padding', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_tablet_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_tablet_item_border_radius' => [
								'label'	=> esc_html__( 'Item Border Radius', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_tablet_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_tablet_item_border_width' => [
								'label'	=> esc_html__( 'Item Border Width', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_tablet_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],
						]
					],

					'op_spacer_for_styling_mobile_style_section' => [
						'type' => 'ocean-spacer',
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 10,
						'bottom' => 10
					],

					'op_portfolio_styling_mobile_style_section' => [
						'type' => 'section',
						'title' => esc_html__('Mobile Style', 'ocean-portfolio'),
						'section' => 'op_portfolio_styling_section',
						'after' => 'op_spacer_for_styling_mobile_style_section',
						'class' => 'section-site-layout',
						'priority' => 10,
						'options' => [
							'op_portfolio_mobile_item_margin' => [
								'label'	=> esc_html__( 'Item Margin', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_mobile_style_section',
								'transport' => 'postMessage',
								'default'   => '10px',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_mobile_item_padding' => [
								'label'	=> esc_html__( 'Item Padding', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_mobile_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_mobile_item_border_radius' => [
								'label'	=> esc_html__( 'Item Border Radius', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_mobile_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],

							'op_portfolio_mobile_item_border_width' => [
								'label'	=> esc_html__( 'Item Border Width', 'ocean-portfolio' ),
								'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
								'type' => 'ocean-text',
								'section'  => 'op_portfolio_styling_mobile_style_section',
								'transport' => 'postMessage',
								'default'   => '',
								'priority' => 10,
								'hideLabel' => false,
								'sanitize_callback' => 'sanitize_text_field',
							],
						]
					],

					'op_divider_after_styling_mobile_style_section' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
					],

					'op_portfolio_outside_content_padding' => [
						'label'	=> esc_html__( 'Outside Content Padding', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Format: top/right/bottom/left.', 'ocean-portfolio' ),
						'type' => 'ocean-text',
						'section'  => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'default'   => '25px',
						'priority' => 10,
						'hideLabel' => false,
						'sanitize_callback' => 'sanitize_text_field',
						'active_callback' => 'op_portfolio_cac_has_outside_title_cat_position',
					],

					'op_portfolio_item_border_style' => [
						'type' => 'ocean-select',
						'label' => esc_html__( 'Item Border Style', 'ocean-portfolio' ),
						'desc' => esc_html__( 'Designates the ascending or descending order.', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'refresh',
						'default' => 'none',
						'priority' => 10,
						'hideLabel' => false,
						'multiple' => false,
						'sanitize_callback' => 'sanitize_key',
						'choices' => [
							'none' 		=> esc_html__( 'None', 'ocean-portfolio' ),
							'solid' 	=> esc_html__( 'Solid', 'ocean-portfolio' ),
							'double' 	=> esc_html__( 'Double', 'ocean-portfolio' ),
							'dashed' 	=> esc_html__( 'Dashed', 'ocean-portfolio' ),
						],
					],

					'op_divider_after_item_border_style_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_typography' => [
						'id' => 'op_portfolio_typography',
						'type' => 'ocean-typography',
						'label' => esc_html__( 'Filter Typography', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'selector' => '.omw-modal',
						'setting_args' => [
							'fontFamily' => [
								'id' => 'op_portfolio_filter_typo_font_family',
								'label' => esc_html__('Font Family', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeight' => [
								'id' => 'op_portfolio_filter_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightTablet' => [
								'id' => 'op_portfolio_tablet_filter_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightMobile' => [
								'id' => 'op_portfolio_mobile_filter_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSubset' => [
								'id' => 'op_portfolio_filter_typo_font_subset',
								'label' => esc_html__('Font Subset', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSize' => [
								'id' => 'op_portfolio_filter_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeTablet' => [
								'id' => 'op_portfolio_tablet_filter_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeMobile' => [
								'id' => 'op_portfolio_mobile_filter_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeUnit' => [
								'id' => 'op_portfolio_filter_typo_font_size_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'letterSpacing' => [
								'id' => 'op_portfolio_filter_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingTablet' => [
								'id' => 'op_portfolio_tablet_filter_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingMobile' => [
								'id' => 'op_portfolio_mobile_filter_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingUnit' => [
								'id' => 'op_portfolio_filter_typo_spacing_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'lineHeight' => [
								'id' => 'op_portfolio_filter_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightTablet' => [
								'id' => 'op_portfolio_tablet_filter_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightMobile' => [
								'id' => 'op_portfolio_mobile_filter_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightUnit' => [
								'id' => 'op_portfolio_filter_typo_line_height_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransform' => [
								'id' => 'op_portfolio_filter_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransformTablet' => [
								'id' => 'op_portfolio_tablet_filter_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransformMobile' => [
								'id' => 'op_portfolio_mobile_filter_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textDecoration' => [
								'id' => 'op_portfolio_filter_typo_text_decoration',
								'label' => esc_html__('Text Decoration', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_title_typo' => [
						'id' => 'op_portfolio_title_typo',
						'type' => 'ocean-typography',
						'label' => esc_html__( 'Title Typography', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'selector' => '.omw-modal',
						'setting_args' => [
							'fontFamily' => [
								'id' => 'op_portfolio_title_typo_font_family',
								'label' => esc_html__('Font Family', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeight' => [
								'id' => 'op_portfolio_title_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightTablet' => [
								'id' => 'op_portfolio_tablet_title_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightMobile' => [
								'id' => 'op_portfolio_mobile_title_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSubset' => [
								'id' => 'op_portfolio_title_typo_font_subset',
								'label' => esc_html__('Font Subset', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSize' => [
								'id' => 'op_portfolio_title_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeTablet' => [
								'id' => 'op_portfolio_tablet_title_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeMobile' => [
								'id' => 'op_portfolio_mobile_title_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeUnit' => [
								'id' => 'op_portfolio_title_typo_font_size_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'letterSpacing' => [
								'id' => 'op_portfolio_title_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingTablet' => [
								'id' => 'op_portfolio_tablet_title_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingMobile' => [
								'id' => 'op_portfolio_mobile_title_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingUnit' => [
								'id' => 'op_portfolio_title_typo_spacing_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'lineHeight' => [
								'id' => 'op_portfolio_title_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightTablet' => [
								'id' => 'op_portfolio_tablet_title_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightMobile' => [
								'id' => 'op_portfolio_mobile_title_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightUnit' => [
								'id' => 'op_portfolio_title_typo_line_height_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransform' => [
								'id' => 'op_portfolio_title_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransformTablet' => [
								'id' => 'op_portfolio_tablet_title_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransformMobile' => [
								'id' => 'op_portfolio_mobile_title_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textDecoration' => [
								'id' => 'op_portfolio_title_typo_text_decoration',
								'label' => esc_html__('Text Decoration', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_portfolio_category_typo' => [
						'id' => 'op_portfolio_category_typo',
						'type' => 'ocean-typography',
						'label' => esc_html__( 'Category Typography', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'selector' => '.omw-modal',
						'setting_args' => [
							'fontFamily' => [
								'id' => 'op_portfolio_category_typo_font_family',
								'label' => esc_html__('Font Family', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeight' => [
								'id' => 'op_portfolio_category_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightTablet' => [
								'id' => 'op_portfolio_tablet_category_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontWeightMobile' => [
								'id' => 'op_portfolio_mobile_category_typo_font_weight',
								'label' => esc_html__('Font Weight', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSubset' => [
								'id' => 'op_portfolio_category_typo_font_subset',
								'label' => esc_html__('Font Subset', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSize' => [
								'id' => 'op_portfolio_category_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeTablet' => [
								'id' => 'op_portfolio_tablet_category_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeMobile' => [
								'id' => 'op_portfolio_mobile_category_typo_font_size',
								'label' => esc_html__('Font Size', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'fontSizeUnit' => [
								'id' => 'op_portfolio_category_typo_font_size_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'letterSpacing' => [
								'id' => 'op_portfolio_category_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingTablet' => [
								'id' => 'op_portfolio_tablet_category_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingMobile' => [
								'id' => 'op_portfolio_mobile_category_typo_spacing',
								'label' => esc_html__('Letter Spacing', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'letterSpacingUnit' => [
								'id' => 'op_portfolio_category_typo_spacing_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
									'default'   => 'px'
								],
							],
							'lineHeight' => [
								'id' => 'op_portfolio_category_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightTablet' => [
								'id' => 'op_portfolio_tablet_category_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightMobile' => [
								'id' => 'op_portfolio_mobile_category_typo_line_height',
								'label' => esc_html__('Line Height', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'lineHeightUnit' => [
								'id' => 'op_portfolio_category_typo_line_height_unit',
								'label' => esc_html__('Unit', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransform' => [
								'id' => 'op_portfolio_category_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransformTablet' => [
								'id' => 'op_portfolio_tablet_category_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textTransformMobile' => [
								'id' => 'op_portfolio_mobile_category_typo_transform',
								'label' => esc_html__('Text Transform', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
							'textDecoration' => [
								'id' => 'op_portfolio_category_typo_text_decoration',
								'label' => esc_html__('Text Decoration', 'ocean-portfolio'),
								'attr' => [
									'transport' => 'postMessage',
								],
							],
						]
					],

					'op_divider_after_category_typo_setting' => [
						'type' => 'ocean-divider',
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'top' => 1,
						'bottom' => 10,
					],

					'op_portfolio_item_border_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Item Border Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_item_border_color',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry .portfolio-entry-inner' => 'border-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						]
					],

					'op_portfolio_item_bg' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Item Background Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'sanitize_callback' => 'wp_kses_post',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_item_bg',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry .portfolio-entry-inner' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
								],
							]
						]
					],

					'op_portfolio_outside_content_bg' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Outside Content Background', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'sanitize_callback' => 'wp_kses_post',
						'active_callback' => 'op_portfolio_cac_has_outside_title_cat_position',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_outside_content_bg',
								'key' => 'normal',
								'label' => esc_html__( 'Select Color', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-thumbnail .triangle-wrap' => 'border-bottom-color',
										'.portfolio-entries .portfolio-content' => 'background-color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#f9f9f9',
								],
							]
						]
					],

					'op_portfolio_title_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Title Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'sanitize_callback' => 'wp_kses_post',
						'active_callback' => 'op_portfolio_cac_has_title',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_title_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-title, .portfolio-entries .portfolio-entry-title a, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .portfolio-entry-title a' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#333333',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_title_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .portfolio-entry-title a:hover, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .portfolio-entry-title a:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#13aff0',
								],
							]
						]
					],

					'op_portfolio_category_color' => [
						'type' => 'ocean-color',
						'label' => esc_html__( 'Category Color', 'ocean-portfolio' ),
						'section' => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority' => 10,
						'hideLabel' => false,
						'showAlpha' => true,
						'showPalette' => true,
						'sanitize_callback' => 'wp_kses_post',
						'active_callback' => 'op_portfolio_cac_has_category',
						'setting_args' => [
							'normal' => [
								'id' => 'op_portfolio_category_color',
								'key' => 'normal',
								'label' => esc_html__( 'Normal', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .categories, .portfolio-entries .categories a, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .categories, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .categories a' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#a7a7a7',
								],
							],
							'hover' => [
								'id' => 'op_portfolio_category_hover_color',
								'key' => 'hover',
								'label' => esc_html__( 'Hover', 'ocean-portfolio' ),
								'selector' => [
									'.portfolio-entries .categories a:hover, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .categories a:hover' => 'color'
								],
								'attr' => [
									'transport' => 'postMessage',
									'default' => '#333333',
								],
							]
						]
					],

					'op_styling_tab_need_help' => [
						'type'      => 'ocean-content',
						'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio#Styling-and-Typography-AQ6HU/" target="_blank">', '</a>' ),
						'class'     => 'need-help',
						'section'   => 'op_portfolio_styling_section',
						'transport' => 'postMessage',
						'priority'  => 10,
					],

				]
			],

			'op_content_for_need_help_link' => [
				'type'      => 'ocean-content',
				'isContent' => sprintf( esc_html__( '%1$s Need Help? %2$s', 'ocean-portfolio' ), '<a href="https://docs.oceanwp.org/article/921-customizer-portfolio/" target="_blank">', '</a>' ),
				'class'     => 'need-help',
				'section'   => 'ocean_portfolio_settings',
				'transport' => 'postMessage',
				'priority'  => 10,
			],

		]

	];

	return apply_filters( 'op_customizer_options', $options );

}
