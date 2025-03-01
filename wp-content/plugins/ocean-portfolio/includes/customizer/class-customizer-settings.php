<?php
/**
 * Customizer Settings
 */

if ( ! class_exists( 'OceanWP_Portfolio_Customizer' ) ) {

	class OceanWP_Portfolio_Customizer {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			//add_action( 'customize_register', array( $this, 'customizer_options' ) );
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_filter( 'ocean_head_css', array( $this, 'head_css' ) );
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 *
		 * @since 1.0.0
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'op_portfolio-customizer', plugins_url( '/assets/js/customizer.min.js', __FILE__ ), array( 'customize-preview' ), '1.0', true );
		}

		/**
		 * Customizer options
		 *
		 * @since 1.0.0
		 */
		public function customizer_options( $wp_customize ) {

			// if ( OCEAN_EXTRA_ACTIVE
			// 	&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

			// 	if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_portfolio_panel' ) ) ) {
			// 		return false;
			// 	}

			// }

			// // Helpers functions
			// require_once OP_PATH .'/includes/customizer/customizer-helpers.php';
			// require_once OP_PATH .'/includes/admin/sanitize.php';

			// $path = OP_PATH . '/includes/customizer/';
			// $options = ocean_customize_options('options', false, $path);

			// foreach ( $options as $section_key => $section_options ) {

			// 	$section_args = [
			// 		'title'    => $section_options['title'],
			// 		'priority' => $section_options['priority']
			// 	];

			// 	$wp_customize->add_section(
			// 		$section_key,
			// 		$section_args
			// 	);

			// 	OceanWP_Customizer_Init::register_options_recursive($wp_customize, $section_key, $section_options['options'] );
			// }

		}

		/**
		 * Added localize in customizer js
		 */
		public function register_customize_options($options) {

			if ( OCEAN_EXTRA_ACTIVE
				&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

				if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_portfolio_panel' ) ) ) {
					return $options;
				}

			}

			require_once OP_PATH .'/includes/customizer/customizer-helpers.php';
			require_once OP_PATH .'/includes/customizer/options.php';
			require_once OP_PATH .'/includes/admin/sanitize.php';

			$options['ocean_portfolio_settings'] = op_customizer_options();

			return $options;
		}

		/**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public function head_css( $output ) {

			// Styling vars
			$full_filter_links 						= get_theme_mod( 'op_portfolio_responsive_filter_links' );
			$full_filter_links 						= $full_filter_links ? $full_filter_links : '480';
			$custom_full_filter_links 				= get_theme_mod( 'op_portfolio_responsive_filter_links_custom' );
			$filter_margin 							= get_theme_mod( 'op_portfolio_filter_margin' );
			$filter_links_margin 					= get_theme_mod( 'op_portfolio_filter_links_margin' );
			$filter_links_padding 					= get_theme_mod( 'op_portfolio_filter_links_padding' );
			$filter_links_bg 						= get_theme_mod( 'op_portfolio_filter_links_bg', '#f6f6f6' );
			$filter_links_color 					= get_theme_mod( 'op_portfolio_filter_links_color', '#444444' );
			$filter_active_link_bg 					= get_theme_mod( 'op_portfolio_filter_active_link_bg', '#13aff0' );
			$filter_active_link_color 				= get_theme_mod( 'op_portfolio_filter_active_link_color', '#ffffff' );
			$filter_hover_links_bg 					= get_theme_mod( 'op_portfolio_filter_hover_links_bg', '#13aff0' );
			$filter_hover_links_color 				= get_theme_mod( 'op_portfolio_filter_hover_links_color', '#ffffff' );
			$img_overlay_color 						= get_theme_mod( 'op_portfolio_img_overlay_color', 'rgba(0,0,0,0.4)' );
			$img_overlay_icons_width 				= get_theme_mod( 'op_portfolio_img_overlay_icons_width', 45 );
			$img_overlay_icons_height 				= get_theme_mod( 'op_portfolio_img_overlay_icons_height', 45 );
			$img_overlay_icons_size 				= get_theme_mod( 'op_portfolio_img_overlay_icons_size', 16 );
			$img_overlay_icons_bg 					= get_theme_mod( 'op_portfolio_img_overlay_icons_bg', 'rgba(255,255,255,0.2)' );
			$img_overlay_icons_hover_bg 			= get_theme_mod( 'op_portfolio_img_overlay_icons_hover_bg', 'rgba(255,255,255,0.4)' );
			$img_overlay_icons_color 				= get_theme_mod( 'op_portfolio_img_overlay_icons_color', '#ffffff' );
			$img_overlay_icons_hover_color 			= get_theme_mod( 'op_portfolio_img_overlay_icons_hover_color', '#ffffff' );
			$img_overlay_icons_border_radius 		= get_theme_mod( 'op_portfolio_img_overlay_icons_border_radius' );
			$img_overlay_icons_border_width 		= get_theme_mod( 'op_portfolio_img_overlay_icons_border_width', '1px' );
			$img_overlay_icons_border_style 		= get_theme_mod( 'op_portfolio_img_overlay_icons_border_style', 'solid' );
			$img_overlay_icons_border_color 		= get_theme_mod( 'op_portfolio_img_overlay_icons_border_color', 'rgba(255,255,255,0.4)' );
			$img_overlay_icons_hover_border_color 	= get_theme_mod( 'op_portfolio_img_overlay_icons_hover_border_color' );
			$item_margin 							= get_theme_mod( 'op_portfolio_item_margin', '10px' );
			$item_padding 							= get_theme_mod( 'op_portfolio_item_padding' );
			$item_border_radius 					= get_theme_mod( 'op_portfolio_item_border_radius' );
			$item_border_width 						= get_theme_mod( 'op_portfolio_item_border_width' );
			$item_border_style 						= get_theme_mod( 'op_portfolio_item_border_style' );
			$item_border_color 						= get_theme_mod( 'op_portfolio_item_border_color' );
			$item_bg 								= get_theme_mod( 'op_portfolio_item_bg' );
			$outside_content_padding 				= get_theme_mod( 'op_portfolio_outside_content_padding', '25px' );
			$outside_content_bg 					= get_theme_mod( 'op_portfolio_outside_content_bg', '#f9f9f9' );
			$title_color 							= get_theme_mod( 'op_portfolio_title_color', '#333333' );
			$title_hover_color 						= get_theme_mod( 'op_portfolio_title_hover_color', '#13aff0' );
			$category_color 						= get_theme_mod( 'op_portfolio_category_color', '#a7a7a7' );
			$category_hover_color 					= get_theme_mod( 'op_portfolio_category_hover_color', '#333333' );

			// Typography
			$filter_font_family 					= get_theme_mod( 'op_portfolio_filter_typo_font_family' );
			$filter_font_size 						= get_theme_mod( 'op_portfolio_filter_typo_font_size' );
			$filter_font_weight 					= get_theme_mod( 'op_portfolio_filter_typo_font_weight' );
			$filter_font_style 						= get_theme_mod( 'op_portfolio_filter_typo_font_style' );
			$filter_text_transform 					= get_theme_mod( 'op_portfolio_filter_typo_transform' );
			$filter_line_height 					= get_theme_mod( 'op_portfolio_filter_typo_line_height' );
			$filter_letter_spacing 					= get_theme_mod( 'op_portfolio_filter_typo_spacing' );
			$title_font_family 						= get_theme_mod( 'op_portfolio_title_typo_font_family' );
			$title_font_size 						= get_theme_mod( 'op_portfolio_title_typo_font_size' );
			$title_font_weight 						= get_theme_mod( 'op_portfolio_title_typo_font_weight' );
			$title_font_style 						= get_theme_mod( 'op_portfolio_title_typo_font_style' );
			$title_text_transform 					= get_theme_mod( 'op_portfolio_title_typo_transform' );
			$title_line_height 						= get_theme_mod( 'op_portfolio_title_typo_line_height' );
			$title_letter_spacing 					= get_theme_mod( 'op_portfolio_title_typo_spacing' );
			$cat_font_family 						= get_theme_mod( 'op_portfolio_category_typo_font_family' );
			$cat_font_size 							= get_theme_mod( 'op_portfolio_category_typo_font_size' );
			$cat_font_weight 						= get_theme_mod( 'op_portfolio_category_typo_font_weight' );
			$cat_font_style 						= get_theme_mod( 'op_portfolio_category_typo_font_style' );
			$cat_text_transform 					= get_theme_mod( 'op_portfolio_category_typo_transform' );
			$cat_line_height 						= get_theme_mod( 'op_portfolio_category_typo_line_height' );
			$cat_letter_spacing 					= get_theme_mod( 'op_portfolio_category_typo_spacing' );

			// Tablet device
			$tablet_item_margin 					= get_theme_mod( 'op_portfolio_tablet_item_margin' );
			$tablet_item_padding 					= get_theme_mod( 'op_portfolio_tablet_item_padding' );
			$tablet_item_border_radius 				= get_theme_mod( 'op_portfolio_tablet_item_border_radius' );
			$tablet_item_border_width 				= get_theme_mod( 'op_portfolio_tablet_item_border_width' );
			$tablet_filter_font_size 				= get_theme_mod( 'op_portfolio_tablet_filter_typo_font_size' );
			$tablet_filter_text_transform 			= get_theme_mod( 'op_portfolio_tablet_filter_typo_transform' );
			$tablet_filter_line_height 				= get_theme_mod( 'op_portfolio_tablet_filter_typo_line_height' );
			$tablet_filter_letter_spacing 			= get_theme_mod( 'op_portfolio_tablet_filter_typo_spacing' );
			$tablet_title_font_size 				= get_theme_mod( 'op_portfolio_tablet_title_typo_font_size' );
			$tablet_title_text_transform 			= get_theme_mod( 'op_portfolio_tablet_title_typo_transform' );
			$tablet_title_line_height 				= get_theme_mod( 'op_portfolio_tablet_title_typo_line_height' );
			$tablet_title_letter_spacing 			= get_theme_mod( 'op_portfolio_tablet_title_typo_spacing' );
			$tablet_cat_font_size 					= get_theme_mod( 'op_portfolio_tablet_category_typo_font_size' );
			$tablet_cat_font_style 					= get_theme_mod( 'op_portfolio_tablet_category_typo_font_style' );
			$tablet_cat_text_transform 				= get_theme_mod( 'op_portfolio_tablet_category_typo_transform' );
			$tablet_cat_line_height 				= get_theme_mod( 'op_portfolio_tablet_category_typo_line_height' );
			$tablet_cat_letter_spacing 				= get_theme_mod( 'op_portfolio_tablet_category_typo_spacing' );

			// Mobile device
			$mobile_item_margin 					= get_theme_mod( 'op_portfolio_mobile_item_margin' );
			$mobile_item_padding 					= get_theme_mod( 'op_portfolio_mobile_item_padding' );
			$mobile_item_border_radius 				= get_theme_mod( 'op_portfolio_mobile_item_border_radius' );
			$mobile_item_border_width 				= get_theme_mod( 'op_portfolio_mobile_item_border_width' );
			$mobile_filter_font_size 				= get_theme_mod( 'op_portfolio_mobile_filter_typo_font_size' );
			$mobile_filter_text_transform 			= get_theme_mod( 'op_portfolio_mobile_filter_typo_transform' );
			$mobile_filter_line_height 				= get_theme_mod( 'op_portfolio_mobile_filter_typo_line_height' );
			$mobile_filter_letter_spacing 			= get_theme_mod( 'op_portfolio_mobile_filter_typo_spacing' );
			$mobile_title_font_size 				= get_theme_mod( 'op_portfolio_mobile_title_typo_font_size' );
			$mobile_title_text_transform 			= get_theme_mod( 'op_portfolio_mobile_title_typo_transform' );
			$mobile_title_line_height 				= get_theme_mod( 'op_portfolio_mobile_title_typo_line_height' );
			$mobile_title_letter_spacing 			= get_theme_mod( 'op_portfolio_mobile_title_typo_spacing' );
			$mobile_cat_font_size 					= get_theme_mod( 'op_portfolio_mobile_category_typo_font_size' );
			$mobile_cat_font_style 					= get_theme_mod( 'op_portfolio_mobile_category_typo_font_style' );
			$mobile_cat_text_transform 				= get_theme_mod( 'op_portfolio_mobile_category_typo_transform' );
			$mobile_cat_line_height 				= get_theme_mod( 'op_portfolio_mobile_category_typo_line_height' );
			$mobile_cat_letter_spacing 				= get_theme_mod( 'op_portfolio_mobile_category_typo_spacing' );

			// Both sidebars single product layout
			$single_layout 							= get_theme_mod( 'op_portfolio_single_layout', 'full-width' );
			$bs_single_content_width 				= get_theme_mod( 'op_portfolio_single_both_sidebars_content_width' );
			$bs_single_sidebars_width 				= get_theme_mod( 'op_portfolio_single_both_sidebars_sidebars_width' );

			// Filter Style - button
			$filter_button_padding_top 				= get_theme_mod( 'op_portfolio_filter_button_top_padding' );
			$filter_button_padding_right 		    = get_theme_mod( 'op_portfolio_filter_button_right_padding' );
			$filter_button_padding_bottom 		    = get_theme_mod( 'op_portfolio_filter_button_bottom_padding' );
			$filter_button_padding_left				= get_theme_mod( 'op_portfolio_filter_button_left_padding' );
			$filter_button_tablet_padding_top 	    = get_theme_mod( 'op_portfolio_filter_button_tablet_top_padding' );
			$filter_button_tablet_padding_right 	= get_theme_mod( 'op_portfolio_filter_button_tablet_right_padding' );
			$filter_button_tablet_padding_bottom 	= get_theme_mod( 'op_portfolio_filter_button_tablet_bottom_padding' );
			$filter_button_tablet_padding_left		= get_theme_mod( 'op_portfolio_filter_button_tablet_left_padding' );
			$filter_button_mobile_padding_top 		= get_theme_mod( 'op_portfolio_filter_button_mobile_top_padding' );
			$filter_button_mobile_padding_right 	= get_theme_mod( 'op_portfolio_filter_button_mobile_right_padding' );
			$filter_button_mobile_padding_bottom    = get_theme_mod( 'op_portfolio_filter_button_mobile_bottom_padding' );
			$filter_button_mobile_padding_left		= get_theme_mod( 'op_portfolio_filter_button_mobile_left_padding' );
			$filter_button_border_width				= get_theme_mod( 'op_portfolio_filter_button_border_width' );
			$filter_button_border_radius		    = get_theme_mod( 'op_portfolio_filter_button_border_radius' );
			$filter_button_text_color               = get_theme_mod( 'op_portfolio_filter_button_text_color' );
			$filter_button_text_color_hover         = get_theme_mod( 'op_portfolio_filter_button_text_hover_color' );
			$filter_button_bg_color                 = get_theme_mod( 'op_portfolio_filter_button_bg_color' );
			$filter_button_bg_color_hover           = get_theme_mod( 'op_portfolio_filter_button_bg_hover_color' );
			$filter_button_icon_color               = get_theme_mod( 'op_portfolio_filter_button_icon_color' );
			$filter_button_icon_color_hover         = get_theme_mod( 'op_portfolio_filter_button_icon_hover_color' );
			$filter_button_border_color             = get_theme_mod( 'op_portfolio_filter_button_border_color' );
			$filter_button_border_color_hover       = get_theme_mod( 'op_portfolio_filter_button_border_hover_color' );

			$reset_button_padding_top 				= get_theme_mod( 'op_portfolio_filter_reset_button_top_padding' );
			$reset_button_padding_right 			= get_theme_mod( 'op_portfolio_filter_reset_button_right_padding' );
			$reset_button_padding_bottom 		    = get_theme_mod( 'op_portfolio_filter_reset_button_bottom_padding' );
			$reset_button_padding_left				= get_theme_mod( 'op_portfolio_filter_reset_button_left_padding' );
			$reset_button_border_width				= get_theme_mod( 'op_portfolio_filter_reset_button_border_width' );
			$reset_button_border_radius		        = get_theme_mod( 'op_portfolio_filter_reset_button_border_radius' );
			$reset_button_text_color                = get_theme_mod( 'op_portfolio_filter_reset_button_text_color' );
			$reset_button_text_color_hover          = get_theme_mod( 'op_portfolio_filter_reset_button_text_hover_color' );
			$reset_button_bg_color                  = get_theme_mod( 'op_portfolio_filter_reset_button_bg_color' );
			$reset_button_bg_color_hover            = get_theme_mod( 'op_portfolio_filter_reset_button_bg_hover_color' );
			$reset_button_icon_color                = get_theme_mod( 'op_portfolio_filter_reset_button_icon_color' );
			$reset_button_icon_color_hover          = get_theme_mod( 'op_portfolio_filter_reset_button_icon_hover_color' );
			$reset_button_border_color              = get_theme_mod( 'op_portfolio_filter_reset_button_border_color' );
			$reset_button_border_color_hover        = get_theme_mod( 'op_portfolio_filter_reset_button_border_hover_color' );

			$apply_button_padding_top 				= get_theme_mod( 'op_portfolio_filter_apply_button_top_padding' );
			$apply_button_padding_right 			= get_theme_mod( 'op_portfolio_filter_apply_button_right_padding' );
			$apply_button_padding_bottom 		    = get_theme_mod( 'op_portfolio_filter_apply_button_bottom_padding' );
			$apply_button_padding_left				= get_theme_mod( 'op_portfolio_filter_apply_button_left_padding' );
			$apply_button_border_width				= get_theme_mod( 'op_portfolio_filter_apply_button_border_width' );
			$apply_button_border_radius		        = get_theme_mod( 'op_portfolio_filter_apply_button_border_radius' );
			$apply_button_text_color                = get_theme_mod( 'op_portfolio_filter_apply_button_text_color' );
			$apply_button_text_color_hover          = get_theme_mod( 'op_portfolio_filter_apply_button_text_hover_color' );
			$apply_button_bg_color                  = get_theme_mod( 'op_portfolio_filter_apply_button_bg_color' );
			$apply_button_bg_color_hover            = get_theme_mod( 'op_portfolio_filter_apply_button_bg_hover_color' );
			$apply_button_border_color              = get_theme_mod( 'op_portfolio_filter_apply_button_border_color' );
			$apply_button_border_color_hover        = get_theme_mod( 'op_portfolio_filter_apply_button_border_hover_color' );

			$inside_reset_button_padding_top 	    = get_theme_mod( 'op_portfolio_filter_inside_reset_button_top_padding' );
			$inside_reset_button_padding_right 		= get_theme_mod( 'op_portfolio_filter_inside_reset_button_right_padding' );
			$inside_reset_button_padding_bottom 	= get_theme_mod( 'op_portfolio_filter_inside_reset_button_bottom_padding' );
			$inside_reset_button_padding_left	    = get_theme_mod( 'op_portfolio_filter_inside_reset_button_left_padding' );
			$inside_reset_button_border_width		= get_theme_mod( 'op_portfolio_filter_inside_reset_button_border_width' );
			$inside_reset_button_border_radius		= get_theme_mod( 'op_portfolio_filter_inside_reset_button_border_radius' );
			$inside_reset_button_text_color         = get_theme_mod( 'op_portfolio_filter_inside_reset_button_text_color' );
			$inside_reset_button_text_color_hover   = get_theme_mod( 'op_portfolio_filter_inside_reset_button_text_hover_color' );
			$inside_reset_button_bg_color           = get_theme_mod( 'op_portfolio_filter_inside_reset_button_bg_color' );
			$inside_reset_button_bg_color_hover     = get_theme_mod( 'op_portfolio_filter_inside_reset_button_bg_hover_color' );
			$inside_reset_button_border_color       = get_theme_mod( 'op_portfolio_filter_inside_reset_button_border_color' );
			$inside_reset_button_border_color_hover = get_theme_mod( 'op_portfolio_filter_inside_reset_button_border_hover_color' );

			$img_animation                          = get_theme_mod( 'op_portfolio_img_animation', false );
			$img_animation_duration                 = get_theme_mod( 'op_portfolio_img_animation_duration', '10s' );
			$img_animation_delay                    = get_theme_mod( 'op_portfolio_img_animation_delay' );
			$img_transform_origin_inital            = get_theme_mod( 'op_portfolio_img_animation_transform_origin_initial', 'bottom left' );
			$img_transform_inital                   = get_theme_mod( 'op_portfolio_img_animation_transform_initial', 'scale(1.0)' );
			$img_transform_origin_final             = get_theme_mod( 'op_portfolio_img_animation_transform_origin_initial' );
			$img_transform_final                    = get_theme_mod( 'op_portfolio_img_animation_transform_initial', 'scale(1.3)' );

			// Define css var
			$css 						= '';
			$overlay_icons_css 			= '';
			$owp_icons_svg              = '';
			$overlay_icons_svg_css      = '';
			$overlay_icons_hover_css 	= '';
			$overlay_icons_hover_svg    = '';
			$border_css 				= '';
			$filter_typo_css 			= '';
			$title_typo_css 			= '';
			$cat_typo_css 				= '';
			$tablet_css 				= '';
			$tablet_filter_typo_css 	= '';
			$tablet_title_typo_css 		= '';
			$tablet_cat_typo_css 		= '';
			$mobile_css 				= '';
			$mobile_filter_typo_css 	= '';
			$mobile_title_typo_css 		= '';
			$mobile_cat_typo_css 		= '';

			// Add full width filter links in reponsive
			if ( ! empty( $full_filter_links ) ) {

				if ( 'custom' == $full_filter_links && ! empty( $custom_full_filter_links ) ) {
					$full_filter_links = $custom_full_filter_links;
				}

				$css .= '@media (max-width: '. $full_filter_links .'px) {.portfolio-entries .portfolio-filters li{width:100%;}}';
			}

			// Add filter margin
			if ( ! empty( $filter_margin ) ) {
				$css .= '.portfolio-entries .portfolio-filters{margin:'. $filter_margin .';}';
			}

			// Add filter links margin
			if ( ! empty( $filter_links_margin ) ) {
				$css .= '.portfolio-entries .portfolio-filters li{margin:'. $filter_links_margin .';}';
			}

			// Add filter links padding
			if ( ! empty( $filter_links_padding ) ) {
				$css .= '.portfolio-entries .portfolio-filters li a{padding:'. $filter_links_padding .';}';
			}

			// Add filter links background
			if ( ! empty( $filter_links_bg ) && '#f6f6f6' != $filter_links_bg ) {
				$css .= '.portfolio-entries .portfolio-filters li a{background-color:'. $filter_links_bg .';}';
			}

			// Add filter links color
			if ( ! empty( $filter_links_color ) && '#444444' != $filter_links_color ) {
				$css .= '.portfolio-entries .portfolio-filters li a{color:'. $filter_links_color .';}';
			}

			// Add filter active link background
			if ( ! empty( $filter_active_link_bg ) && '#13aff0' != $filter_active_link_bg ) {
				$css .= 'body .portfolio-entries .portfolio-filters li.active a{background-color:'. $filter_active_link_bg .';}';
			}

			// Add filter active link color
			if ( ! empty( $filter_active_link_color ) && '#ffffff' != $filter_active_link_color ) {
				$css .= 'body .portfolio-entries .portfolio-filters li.active a{color:'. $filter_active_link_color .';}';
			}

			// Add filter hover links background
			if ( ! empty( $filter_hover_links_bg ) && '#13aff0' != $filter_hover_links_bg ) {
				$css .= '.portfolio-entries .portfolio-filters li a:hover{background-color:'. $filter_hover_links_bg .';}';
			}

			// Add filter hover links color
			if ( ! empty( $filter_hover_links_color ) && '#ffffff' != $filter_hover_links_color ) {
				$css .= '.portfolio-entries .portfolio-filters li a:hover{color:'. $filter_hover_links_color .';}';
			}

			// Add images overlay color
			if ( ! empty( $img_overlay_color ) ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .overlay{background-color:'. $img_overlay_color .';}';
			}

			// Add images overlay icons style
			if ( ! empty( $img_overlay_icons_width ) && 45 != $img_overlay_icons_width ) {
				$overlay_icons_css .= 'width:' . $img_overlay_icons_width .'px;';
			}
			if ( ! empty( $img_overlay_icons_height ) && 45 != $img_overlay_icons_height ) {
				$overlay_icons_css .= 'height:' . $img_overlay_icons_height .'px;';
			}
			if ( ! empty( $img_overlay_icons_size ) && 16 != $img_overlay_icons_size ) {
				$overlay_icons_css .= 'font-size:' . $img_overlay_icons_size .'px;';
				$owp_icons_svg     .= 'width:' . $img_overlay_icons_size .'px; height:' . $img_overlay_icons_size .'px;';
			}
			if ( ! empty( $img_overlay_icons_bg ) && 'rgba(255,255,255,0.2)' != $img_overlay_icons_bg ) {
				$overlay_icons_css .= 'background-color:' . $img_overlay_icons_bg .';';
			}
			if ( ! empty( $img_overlay_icons_color ) && '#ffffff' != $img_overlay_icons_color ) {
				$overlay_icons_css     .= 'color:' . $img_overlay_icons_color .';';
				$overlay_icons_svg_css .= 'stroke:' . $img_overlay_icons_color .';';
			}
			if ( ! empty( $img_overlay_icons_border_radius ) ) {
				$overlay_icons_css .= 'border-radius:' . $img_overlay_icons_border_radius .';';
			}
			if ( ! empty( $img_overlay_icons_border_width ) && '1px' != $img_overlay_icons_border_width ) {
				$overlay_icons_css .= 'border-width:' . $img_overlay_icons_border_width .';';
			}
			if ( ! empty( $img_overlay_icons_border_style ) && 'solid' != $img_overlay_icons_border_style ) {
				$overlay_icons_css .= 'border-style:' . $img_overlay_icons_border_style .';';
			}
			if ( ! empty( $img_overlay_icons_border_color ) ) {
				$overlay_icons_css .= 'border-color:' . $img_overlay_icons_border_color .';';
			}
			if ( ! empty( $overlay_icons_css ) ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a{'. $overlay_icons_css .'}';
			}
			if ( ! empty( $owp_icons_svg ) ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a .owp-icon{'. $owp_icons_svg .'}';
			}
			if ( ! empty( $overlay_icons_svg_css ) ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a .owp-icon use{'. $overlay_icons_svg_css .'}';
			}

			if ( ! empty( $img_overlay_icons_hover_bg ) && 'rgba(255,255,255,0.4)' != $img_overlay_icons_hover_bg ) {
				$overlay_icons_hover_css .= 'background-color:' . $img_overlay_icons_hover_bg .';';
			}
			if ( ! empty( $img_overlay_icons_hover_color ) && '#ffffff' != $img_overlay_icons_hover_color ) {
				$overlay_icons_hover_css .= 'color:' . $img_overlay_icons_hover_color .';';
				$overlay_icons_hover_svg .= 'stroke:' . $img_overlay_icons_hover_color .';';
			}
			if ( ! empty( $img_overlay_icons_hover_border_color ) ) {
				$overlay_icons_hover_css .= 'border-color:' . $img_overlay_icons_hover_border_color .';';
			}
			if ( ! empty( $overlay_icons_hover_css ) ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a:hover{'. $overlay_icons_hover_css .'}';
			}
			if ( ! empty( $overlay_icons_hover_svg ) ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .portfolio-overlay-icons li a:hover .owp-icon use{'. $overlay_icons_hover_svg .'}';
			}

			// Add item margin
			if ( ! empty( $item_margin ) && '10px' != $item_margin ) {
				$css .= '.portfolio-entries {margin: 0 -'. $item_margin .';}';
				$css .= '.portfolio-entries .portfolio-entry{padding:'. $item_margin .';}';
			}

			// Add padding
			if ( ! empty( $item_padding ) ) {
				$css .= '.portfolio-entries .portfolio-entry .portfolio-entry-inner{padding:'. $item_padding .';}';
			}

			// Add border radius
			if ( ! empty( $item_border_radius ) ) {
				$css .= '.portfolio-entries .portfolio-entry .portfolio-entry-inner{border-radius:'. $item_border_radius .';overflow: hidden;}';
			}

			// Add border
			if ( ! empty( $item_border_width ) ) {
				$border_css .= 'border-width:' . $item_border_width .';';
				if ( ! empty( $item_border_style ) && 'none' != $item_border_style ) {
					$border_css .= 'border-style:' . $item_border_style .';';
				}
				if ( ! empty( $item_border_color ) ) {
					$border_css .= 'border-color:' . $item_border_color .';';
				}
				$css .= '.portfolio-entries .portfolio-entry .portfolio-entry-inner{'. $border_css .'}';
			}

			// Add background color
			if ( ! empty( $item_bg ) ) {
				$css .= '.portfolio-entries .portfolio-entry .portfolio-entry-inner{background-color:'. $item_bg .';}';
			}

			// Add outside content background color
			if ( ! empty( $outside_content_padding ) && '25px' != $outside_content_padding ) {
				$css .= '.portfolio-entries .portfolio-content{padding:'. $outside_content_padding .';}';
			}
			
			if ( ! empty( $outside_content_bg ) && '#f9f9f9' != $outside_content_bg ) {
				$css .= '.portfolio-entries .portfolio-entry-thumbnail .triangle-wrap{border-bottom-color:'. $outside_content_bg .';}';
				$css .= '.portfolio-entries .portfolio-content{background-color:'. $outside_content_bg .';}';
			}

			// Add title color
			if ( ! empty( $title_color ) && '#333333' != $title_color ) {
				$css .= '.portfolio-entries .portfolio-entry-title a, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .portfolio-entry-title a{color:'. $title_color .';}';
			}

			if ( ! empty( $title_hover_color ) && '#13aff0' != $title_hover_color ) {
				$css .= '.portfolio-entries .portfolio-entry-title a:hover, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .portfolio-entry-title a:hover{color:'. $title_hover_color .';}';
			}

			// Add category color
			if ( ! empty( $category_color ) && '#a7a7a7' != $category_color ) {
				$css .= '.portfolio-entries .categories, .portfolio-entries .categories a, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .categories, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .categories a{color:'. $category_color .';}';
			}

			if ( ! empty( $category_hover_color ) && '#333333' != $category_hover_color ) {
				$css .= '.portfolio-entries .categories a:hover, .portfolio-entries .portfolio-entry-thumbnail .portfolio-inside-content .categories a:hover{color:'. $category_hover_color .';}';
			}

			// Add filter font family
			if ( ! empty( $filter_font_family ) ) {
				$filter_typo_css .= 'font-family:'. $filter_font_family .';';
			}

			// Add filter font size
			if ( ! empty( $filter_font_size ) ) {
				$filter_typo_css .= 'font-size:'. $filter_font_size .';';
			}

			// Add filter font weight
			if ( ! empty( $filter_font_weight ) ) {
				$filter_typo_css .= 'font-weight:'. $filter_font_weight .';';
			}

			// Add filter font style
			if ( ! empty( $filter_font_style ) ) {
				$filter_typo_css .= 'font-style:'. $filter_font_style .';';
			}

			// Add filter text transform
			if ( ! empty( $filter_text_transform ) ) {
				$filter_typo_css .= 'text-transform:'. $filter_text_transform .';';
			}

			// Add filter line height
			if ( ! empty( $filter_line_height ) ) {
				$filter_typo_css .= 'line-height:'. $filter_line_height .';';
			}

			// Add filter letter spacing
			if ( ! empty( $filter_letter_spacing ) ) {
				$filter_typo_css .= 'letter-spacing:'. $filter_letter_spacing .';';
			}

			// Filter typography css
			if ( ! empty( $filter_typo_css ) ) {
				$css .= '.portfolio-entries .portfolio-filters li a{'. $filter_typo_css .'}';
			}

			// Add title font family
			if ( ! empty( $title_font_family ) ) {
				$title_typo_css .= 'font-family:'. $title_font_family .';';
			}

			// Add title font size
			if ( ! empty( $title_font_size ) ) {
				$title_typo_css .= 'font-size:'. $title_font_size .';';
			}

			// Add title font weight
			if ( ! empty( $title_font_weight ) ) {
				$title_typo_css .= 'font-weight:'. $title_font_weight .';';
			}

			// Add title font style
			if ( ! empty( $title_font_style ) ) {
				$title_typo_css .= 'font-style:'. $title_font_style .';';
			}

			// Add title text transform
			if ( ! empty( $title_text_transform ) ) {
				$title_typo_css .= 'text-transform:'. $title_text_transform .';';
			}

			// Add title line height
			if ( ! empty( $title_line_height ) ) {
				$title_typo_css .= 'line-height:'. $title_line_height .';';
			}

			// Add title letter spacing
			if ( ! empty( $title_letter_spacing ) ) {
				$title_typo_css .= 'letter-spacing:'. $title_letter_spacing .';';
			}

			// Title typography css
			if ( ! empty( $title_typo_css ) ) {
				$css .= '.portfolio-entries .portfolio-entry-title{'. $title_typo_css .'}';
			}

			// Add category font family
			if ( ! empty( $cat_font_family ) ) {
				$cat_typo_css .= 'font-family:'. $cat_font_family .';';
			}

			// Add category font size
			if ( ! empty( $cat_font_size ) ) {
				$cat_typo_css .= 'font-size:'. $cat_font_size .';';
			}

			// Add category font weight
			if ( ! empty( $cat_font_weight ) ) {
				$cat_typo_css .= 'font-weight:'. $cat_font_weight .';';
			}

			// Add category font style
			if ( ! empty( $cat_font_style ) ) {
				$cat_typo_css .= 'font-style:'. $cat_font_style .';';
			}

			// Add category text transform
			if ( ! empty( $cat_text_transform ) ) {
				$cat_typo_css .= 'text-transform:'. $cat_text_transform .';';
			}

			// Add category line height
			if ( ! empty( $cat_line_height ) ) {
				$cat_typo_css .= 'line-height:'. $cat_line_height .';';
			}

			// Add category letter spacing
			if ( ! empty( $cat_letter_spacing ) ) {
				$cat_typo_css .= 'letter-spacing:'. $cat_letter_spacing .';';
			}

			// Category typography css
			if ( ! empty( $cat_typo_css ) ) {
				$css .= '.portfolio-entries .categories{'. $cat_typo_css .'}';
			}

			// Add tablet item margin
			if ( ! empty( $tablet_item_margin ) ) {
				$css .= '@media (max-width: 1023px) {.portfolio-entries {margin: 0 -'. $tablet_item_margin .';}}';
				$css .= '@media (max-width: 1023px) {.portfolio-entries .portfolio-entry{padding:'. $tablet_item_margin .';}}';
			}

			// Add tablet padding
			if ( ! empty( $tablet_item_padding ) ) {
				$tablet_css .= 'padding:'. $tablet_item_padding .';';
			}

			// Add tablet border radius
			if ( ! empty( $tablet_item_border_radius ) ) {
				$tablet_css .= 'border-radius:'. $tablet_item_border_radius .';overflow: hidden;';
			}

			// Add tablet border
			if ( ! empty( $item_border_width ) && ! empty( $tablet_item_border_width ) ) {
				$tablet_css .= 'border-width:' . $tablet_item_border_width .';';
			}

			// Tablet css
			if ( ! empty( $tablet_css ) ) {
				$css .= '@media (max-width: 1023px) {.portfolio-entries .portfolio-entry .portfolio-entry-inner{'. $tablet_css .'}}';
			}

			// Add tablet filter font size
			if ( ! empty( $tablet_filter_font_size ) ) {
				$tablet_filter_typo_css .= 'font-size:'. $tablet_filter_font_size .';';
			}

			// Add tablet filter text transform
			if ( ! empty( $tablet_filter_text_transform ) ) {
				$tablet_filter_typo_css .= 'text-transform:'. $tablet_filter_text_transform .';';
			}

			// Add tablet filter line height
			if ( ! empty( $tablet_filter_line_height ) ) {
				$tablet_filter_typo_css .= 'line-height:'. $tablet_filter_line_height .';';
			}

			// Add tablet filter letter spacing
			if ( ! empty( $tablet_filter_letter_spacing ) ) {
				$tablet_filter_typo_css .= 'letter-spacing:'. $tablet_filter_letter_spacing .';';
			}

			// Tablet Typo css
			if ( ! empty( $tablet_filter_typo_css ) ) {
				$css .= '@media (max-width: 1023px) {.portfolio-entries .portfolio-filters li a{'. $tablet_filter_typo_css .'}}';
			}

			// Add tablet title font size
			if ( ! empty( $tablet_title_font_size ) ) {
				$tablet_title_typo_css .= 'font-size:'. $tablet_title_font_size .';';
			}

			// Add tablet title text transform
			if ( ! empty( $tablet_title_text_transform ) ) {
				$tablet_title_typo_css .= 'text-transform:'. $tablet_title_text_transform .';';
			}

			// Add tablet title line height
			if ( ! empty( $tablet_title_line_height ) ) {
				$tablet_title_typo_css .= 'line-height:'. $tablet_title_line_height .';';
			}

			// Add tablet title letter spacing
			if ( ! empty( $tablet_title_letter_spacing ) ) {
				$tablet_title_typo_css .= 'letter-spacing:'. $tablet_title_letter_spacing .';';
			}

			// Tablet Typo css
			if ( ! empty( $tablet_title_typo_css ) ) {
				$css .= '@media (max-width: 1023px) {.portfolio-entries .portfolio-entry-title{'. $tablet_title_typo_css .'}}';
			}

			// Add tablet category font size
			if ( ! empty( $tablet_cat_font_size ) ) {
				$tablet_cat_typo_css .= 'font-size:'. $tablet_cat_font_size .';';
			}

			// Add tablet category text transform
			if ( ! empty( $tablet_cat_text_transform ) ) {
				$tablet_cat_typo_css .= 'text-transform:'. $tablet_cat_text_transform .';';
			}

			// Add tablet category line height
			if ( ! empty( $tablet_cat_line_height ) ) {
				$tablet_cat_typo_css .= 'line-height:'. $tablet_cat_line_height .';';
			}

			// Add tablet category letter spacing
			if ( ! empty( $tablet_cat_letter_spacing ) ) {
				$tablet_cat_typo_css .= 'letter-spacing:'. $tablet_cat_letter_spacing .';';
			}

			// Tablet category typography css
			if ( ! empty( $tablet_cat_typo_css ) ) {
				$css .= '@media (max-width: 1023px) {.portfolio-entries .categories{'. $tablet_cat_typo_css .'}}';
			}

			// Add mobile item margin
			if ( ! empty( $mobile_item_margin ) ) {
				$css .= '@media (max-width: 767px) {.portfolio-entries {margin: 0 -'. $mobile_item_margin .';}}';
				$css .= '@media (max-width: 767px) {.portfolio-entries .portfolio-entry{padding:'. $mobile_item_margin .';}}';
			}

			// Add mobile padding
			if ( ! empty( $mobile_item_padding ) ) {
				$mobile_css .= 'padding:'. $mobile_item_padding .';';
			}

			// Add mobile border radius
			if ( ! empty( $mobile_item_border_radius ) ) {
				$mobile_css .= 'border-radius:'. $mobile_item_border_radius .';overflow: hidden;';
			}

			// Add mobile border
			if ( ! empty( $item_border_width ) && ! empty( $mobile_item_border_width ) ) {
				$mobile_css .= 'border-width:' . $mobile_item_border_width .';';
			}

			// Mobile css
			if ( ! empty( $mobile_css ) ) {
				$css .= '@media (max-width: 767px) {.portfolio-entries .portfolio-entry .portfolio-entry-inner{'. $mobile_css .'}}';
			}

			// Add mobile filter font size
			if ( ! empty( $mobile_filter_font_size ) ) {
				$mobile_filter_typo_css .= 'font-size:'. $mobile_filter_font_size .';';
			}

			// Add mobile filter text transform
			if ( ! empty( $mobile_filter_text_transform ) ) {
				$mobile_filter_typo_css .= 'text-transform:'. $mobile_filter_text_transform .';';
			}

			// Add mobile filter line height
			if ( ! empty( $mobile_filter_line_height ) ) {
				$mobile_filter_typo_css .= 'line-height:'. $mobile_filter_line_height .';';
			}

			// Add mobile filter letter spacing
			if ( ! empty( $mobile_filter_letter_spacing ) ) {
				$mobile_filter_typo_css .= 'letter-spacing:'. $mobile_filter_letter_spacing .';';
			}

			// Mobile typo css
			if ( ! empty( $mobile_filter_typo_css ) ) {
				$css .= '@media (max-width: 767px) {.portfolio-entries .portfolio-filters li a{'. $mobile_filter_typo_css .'}}';
			}

			// Add mobile title font size
			if ( ! empty( $mobile_title_font_size ) ) {
				$mobile_title_typo_css .= 'font-size:'. $mobile_title_font_size .';';
			}

			// Add mobile title text transform
			if ( ! empty( $mobile_title_text_transform ) ) {
				$mobile_title_typo_css .= 'text-transform:'. $mobile_title_text_transform .';';
			}

			// Add mobile title line height
			if ( ! empty( $mobile_title_line_height ) ) {
				$mobile_title_typo_css .= 'line-height:'. $mobile_title_line_height .';';
			}

			// Add mobile title letter spacing
			if ( ! empty( $mobile_title_letter_spacing ) ) {
				$mobile_title_typo_css .= 'letter-spacing:'. $mobile_title_letter_spacing .';';
			}

			// Mobile typo css
			if ( ! empty( $mobile_title_typo_css ) ) {
				$css .= '@media (max-width: 767px) {.portfolio-entries .portfolio-entry-title{'. $mobile_title_typo_css .'}}';
			}

			// Add mobile category font size
			if ( ! empty( $mobile_cat_font_size ) ) {
				$mobile_cat_typo_css .= 'font-size:'. $mobile_cat_font_size .';';
			}

			// Add mobile category text transform
			if ( ! empty( $mobile_cat_text_transform ) ) {
				$mobile_cat_typo_css .= 'text-transform:'. $mobile_cat_text_transform .';';
			}

			// Add mobile category line height
			if ( ! empty( $mobile_cat_line_height ) ) {
				$mobile_cat_typo_css .= 'line-height:'. $mobile_cat_line_height .';';
			}

			// Add mobile category letter spacing
			if ( ! empty( $mobile_cat_letter_spacing ) ) {
				$mobile_cat_typo_css .= 'letter-spacing:'. $mobile_cat_letter_spacing .';';
			}

			// Mobile category typography css
			if ( ! empty( $mobile_cat_typo_css ) ) {
				$css .= '@media (max-width: 767px) {.portfolio-entries .categories{'. $mobile_cat_typo_css .'}}';
			}

			// If single item Both Sidebars layout
			if ( 'both-sidebars' == $single_layout ) {

				// Both Sidebars layout single item content width
				if ( ! empty( $bs_single_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-ocean_portfolio.content-both-sidebars .content-area {width: '. $bs_single_content_width .'%;}
							body.single-ocean_portfolio.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.single-ocean_portfolio.content-both-sidebars.ssc-style .widget-area {left: -'. $bs_single_content_width .'%;}
						}';
				}

				// Both Sidebars layout single item sidebars width
				if ( ! empty( $bs_single_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-ocean_portfolio.content-both-sidebars .widget-area{width:'. $bs_single_sidebars_width .'%;}
							body.single-ocean_portfolio.content-both-sidebars.scs-style .content-area{left:'. $bs_single_sidebars_width .'%;}
							body.single-ocean_portfolio.content-both-sidebars.ssc-style .content-area{left:'. $bs_single_sidebars_width * 2 .'%;}
						}';
				}

			}

			/**
			 * Filter - button style
			 */
			if ( isset( $filter_button_padding_top ) && '' != $filter_button_padding_top
				|| isset( $filter_button_padding_right ) && '' != $filter_button_padding_right
				|| isset( $filter_button_padding_bottom ) && '' != $filter_button_padding_bottom
				|| isset( $filter_button_padding_left ) && '' != $filter_button_padding_left ) {
				$css .= '.filter-buttons-wrap a.open{padding:'. oceanwp_spacing_css( $filter_button_padding_top, $filter_button_padding_right, $filter_button_padding_bottom, $filter_button_padding_left ) .'}';
			}
			if ( isset( $filter_button_tablet_padding_top ) && '' != $filter_button_tablet_padding_top
				|| isset( $filter_button_tablet_padding_right ) && '' != $filter_button_tablet_padding_right
				|| isset( $filter_button_tablet_padding_bottom ) && '' != $filter_button_tablet_padding_bottom
				|| isset( $filter_button_tablet_padding_left ) && '' != $filter_button_tablet_padding_left ) {
				$css .= '@media (max-width: 768px){.filter-buttons-wrap a.open{padding:'. oceanwp_spacing_css( $filter_button_tablet_padding_top, $filter_button_tablet_padding_right, $filter_button_tablet_padding_bottom, $filter_button_tablet_padding_left ) .'}}';
			}
			if ( isset( $filter_button_mobile_padding_top ) && '' != $filter_button_mobile_padding_top
				|| isset( $filter_button_mobile_padding_right ) && '' != $filter_button_mobile_padding_right
				|| isset( $filter_button_mobile_padding_bottom ) && '' != $filter_button_mobile_padding_bottom
				|| isset( $filter_button_mobile_padding_left ) && '' != $filter_button_mobile_padding_left ) {
				$css .= '@media (max-width: 480px){.filter-buttons-wrap a.open{padding:'. oceanwp_spacing_css( $filter_button_mobile_padding_top, $filter_button_mobile_padding_right, $filter_button_mobile_padding_bottom, $filter_button_mobile_padding_left ) .'}}';
			}
			if ( ! empty( $filter_button_border_width ) ) {
				$css .= '.filter-buttons-wrap a.open{border-width:' . $filter_button_border_width .';}';
				$css .= '.filter-buttons-wrap a.open{border-style: solid;}';
			}
			if ( ! empty( $filter_button_border_radius ) ) {
				$css .= '.filter-buttons-wrap a.open{border-radius:' . $filter_button_border_radius .';}';
			}
			if ( ! empty( $filter_button_text_color ) ) {
				$css .= '.filter-buttons-wrap a.open{color:' . $filter_button_text_color .';}';
			}
			if ( ! empty( $filter_button_text_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.open:hover{color:' . $filter_button_text_color_hover .';}';
			}
			if ( ! empty( $filter_button_bg_color ) ) {
				$css .= '.filter-buttons-wrap a.open{background-color:' . $filter_button_bg_color .';}';
			}
			if ( ! empty( $filter_button_bg_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.open:hover, .filter-buttons-wrap a.open:focus{background-color:' . $filter_button_bg_color_hover .';}';
			}
			if ( ! empty( $filter_button_icon_color ) ) {
				$css .= '.filter-buttons-wrap a.open i{color:' . $filter_button_icon_color .';}';
				$css .= '.filter-buttons-wrap a.open .owp-icon use{stroke:' . $filter_button_icon_color .';}';
			}
			if ( ! empty( $filter_button_icon_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.open:hover i{color:' . $filter_button_icon_color_hover .';}';
				$css .= '.filter-buttons-wrap a.open:hover .owp-icon use{stroke:' . $filter_button_icon_color_hover .';}';
			}
			if ( ! empty( $filter_button_border_color ) ) {
				$css .= '.filter-buttons-wrap a.open{border-color:' . $filter_button_border_color .';}';
			}
			if ( ! empty( $filter_button_border_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.open:hover{border-color:' . $filter_button_border_color_hover .';}';
			}

			if ( isset( $reset_button_padding_top ) && '' != $reset_button_padding_top
				|| isset( $reset_button_padding_right ) && '' != $reset_button_padding_right
				|| isset( $reset_button_padding_bottom ) && '' != $reset_button_padding_bottom
				|| isset( $reset_button_padding_left ) && '' != $reset_button_padding_left ) {
				$css .= '.filter-buttons-wrap a.reset{padding:'. oceanwp_spacing_css( $reset_button_padding_top, $reset_button_padding_right, $reset_button_padding_bottom, $reset_button_padding_left ) .'}';
			}
			if ( isset( $reset_button_tablet_padding_top ) && '' != $reset_button_tablet_padding_top
				|| isset( $reset_button_tablet_padding_right ) && '' != $reset_button_tablet_padding_right
				|| isset( $reset_button_tablet_padding_bottom ) && '' != $reset_button_tablet_padding_bottom
				|| isset( $reset_button_tablet_padding_left ) && '' != $reset_button_tablet_padding_left ) {
				$css .= '@media (max-width: 768px){.filter-buttons-wrap a.reset{padding:'. oceanwp_spacing_css( $reset_button_tablet_padding_top, $reset_button_tablet_padding_right, $reset_button_tablet_padding_bottom, $reset_button_tablet_padding_left ) .'}}';
			}
			if ( isset( $reset_button_mobile_padding_top ) && '' != $reset_button_mobile_padding_top
				|| isset( $reset_button_mobile_padding_right ) && '' != $reset_button_mobile_padding_right
				|| isset( $reset_button_mobile_padding_bottom ) && '' != $reset_button_mobile_padding_bottom
				|| isset( $reset_button_mobile_padding_left ) && '' != $reset_button_mobile_padding_left ) {
				$css .= '@media (max-width: 480px){.filter-buttons-wrap a.reset{padding:'. oceanwp_spacing_css( $reset_button_mobile_padding_top, $reset_button_mobile_padding_right, $reset_button_mobile_padding_bottom, $reset_button_mobile_padding_left ) .'}}';
			}
			if ( ! empty( $reset_button_border_width ) ) {
				$css .= '.filter-buttons-wrap a.reset{border-width:' . $reset_button_border_width .';}';
				$css .= '.filter-buttons-wrap a.reset{border-style: solid;}';
			}
			if ( ! empty( $reset_button_border_radius ) ) {
				$css .= '.filter-buttons-wrap a.reset{border-radius:' . $reset_button_border_radius .';}';
			}
			if ( ! empty( $reset_button_text_color ) ) {
				$css .= '.filter-buttons-wrap a.reset{color:' . $reset_button_text_color .';}';
			}
			if ( ! empty( $reset_button_text_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.reset:hover{color:' . $reset_button_text_color_hover .';}';
			}
			if ( ! empty( $reset_button_bg_color ) ) {
				$css .= '.filter-buttons-wrap a.reset{background-color:' . $reset_button_bg_color .';}';
			}
			if ( ! empty( $reset_button_bg_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.reset:hover, .filter-buttons-wrap a.reset:focus{background-color:' . $reset_button_bg_color_hover .';}';
			}
			if ( ! empty( $reset_button_icon_color ) ) {
				$css .= '.filter-buttons-wrap a.reset i{color:' . $reset_button_icon_color .';}';
				$css .= '.filter-buttons-wrap a.reset .owp-icon use{stroke:' . $reset_button_icon_color .';}';
			}
			if ( ! empty( $reset_button_icon_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.reset:hover i{color:' . $reset_button_icon_color_hover .';}';
				$css .= '.filter-buttons-wrap a.reset:hover .owp-icon use{stroke:' . $reset_button_icon_color_hover .';}';
			}
			if ( ! empty( $reset_button_border_color ) ) {
				$css .= '.filter-buttons-wrap a.reset{border-color:' . $reset_button_border_color .';}';
			}
			if ( ! empty( $reset_button_border_color_hover ) ) {
				$css .= '.filter-buttons-wrap a.reset:hover{border-color:' . $reset_button_border_color_hover .';}';
			}

			if ( isset( $apply_button_padding_top ) && '' != $apply_button_padding_top
				|| isset( $apply_button_padding_right ) && '' != $apply_button_padding_right
				|| isset( $apply_button_padding_bottom ) && '' != $apply_button_padding_bottom
				|| isset( $apply_button_padding_left ) && '' != $apply_button_padding_left ) {
				$css .= '.filter--form-wrap .apply-button{padding:'. oceanwp_spacing_css( $apply_button_padding_top, $apply_button_padding_right, $apply_button_padding_bottom, $apply_button_padding_left ) .'}';
			}
			if ( isset( $apply_button_tablet_padding_top ) && '' != $apply_button_tablet_padding_top
				|| isset( $apply_button_tablet_padding_right ) && '' != $apply_button_tablet_padding_right
				|| isset( $apply_button_tablet_padding_bottom ) && '' != $apply_button_tablet_padding_bottom
				|| isset( $apply_button_tablet_padding_left ) && '' != $apply_button_tablet_padding_left ) {
				$css .= '@media (max-width: 768px){.filter--form-wrap .apply-button{padding:'. oceanwp_spacing_css( $apply_button_tablet_padding_top, $apply_button_tablet_padding_right, $apply_button_tablet_padding_bottom, $apply_button_tablet_padding_left ) .'}}';
			}
			if ( isset( $apply_button_mobile_padding_top ) && '' != $apply_button_mobile_padding_top
				|| isset( $apply_button_mobile_padding_right ) && '' != $apply_button_mobile_padding_right
				|| isset( $apply_button_mobile_padding_bottom ) && '' != $apply_button_mobile_padding_bottom
				|| isset( $apply_button_mobile_padding_left ) && '' != $apply_button_mobile_padding_left ) {
				$css .= '@media (max-width: 480px){.filter--form-wrap .apply-button{padding:'. oceanwp_spacing_css( $apply_button_mobile_padding_top, $apply_button_mobile_padding_right, $apply_button_mobile_padding_bottom, $apply_button_mobile_padding_left ) .'}}';
			}
			if ( ! empty( $apply_button_border_width ) ) {
				$css .= '.filter--form-wrap .apply-button{border-width:' . $apply_button_border_width .';}';
				$css .= '.filter--form-wrap .apply-button{border-style: solid;}';
			}
			if ( ! empty( $apply_button_border_radius ) ) {
				$css .= '.filter--form-wrap .apply-button{border-radius:' . $apply_button_border_radius .';}';
			}
			if ( ! empty( $apply_button_text_color ) ) {
				$css .= '.filter--form-wrap .apply-button{color:' . $apply_button_text_color .';}';
			}
			if ( ! empty( $apply_button_text_color_hover ) ) {
				$css .= '.filter--form-wrap .apply-button:hover{color:' . $apply_button_text_color_hover .';}';
			}
			if ( ! empty( $apply_button_bg_color ) ) {
				$css .= '.filter--form-wrap .apply-button{background-color:' . $apply_button_bg_color .';}';
			}
			if ( ! empty( $apply_button_bg_color_hover ) ) {
				$css .= '.filter--form-wrap .apply-button:hover, .filter--form-wrap .apply-button:focus{background-color:' . $apply_button_bg_color_hover .';}';
			}
			if ( ! empty( $apply_button_border_color ) ) {
				$css .= '.filter--form-wrap .apply-button{border-color:' . $apply_button_border_color .';}';
			}
			if ( ! empty( $apply_button_border_color_hover ) ) {
				$css .= '.filter--form-wrap .apply-button:hover{border-color:' . $apply_button_border_color_hover .';}';
			}

			if ( isset( $inside_reset_button_padding_top ) && '' != $inside_reset_button_padding_top
				|| isset( $inside_reset_button_padding_right ) && '' != $inside_reset_button_padding_right
				|| isset( $inside_reset_button_padding_bottom ) && '' != $inside_reset_button_padding_bottom
				|| isset( $inside_reset_button_padding_left ) && '' != $inside_reset_button_padding_left ) {
				$css .= '.filter--form-wrap .reset-button{padding:'. oceanwp_spacing_css( $inside_reset_button_padding_top, $inside_reset_button_padding_right, $inside_reset_button_padding_bottom, $inside_reset_button_padding_left ) .'}';
			}
			if ( isset( $inside_reset_button_tablet_padding_top ) && '' != $inside_reset_button_tablet_padding_top
				|| isset( $inside_reset_button_tablet_padding_right ) && '' != $inside_reset_button_tablet_padding_right
				|| isset( $inside_reset_button_tablet_padding_bottom ) && '' != $inside_reset_button_tablet_padding_bottom
				|| isset( $inside_reset_button_tablet_padding_left ) && '' != $inside_reset_button_tablet_padding_left ) {
				$css .= '@media (max-width: 768px){.filter--form-wrap .reset-button{padding:'. oceanwp_spacing_css( $inside_reset_button_tablet_padding_top, $inside_reset_button_tablet_padding_right, $inside_reset_button_tablet_padding_bottom, $inside_reset_button_tablet_padding_left ) .'}}';
			}
			if ( isset( $inside_reset_button_mobile_padding_top ) && '' != $inside_reset_button_mobile_padding_top
				|| isset( $inside_reset_button_mobile_padding_right ) && '' != $inside_reset_button_mobile_padding_right
				|| isset( $inside_reset_button_mobile_padding_bottom ) && '' != $inside_reset_button_mobile_padding_bottom
				|| isset( $inside_reset_button_mobile_padding_left ) && '' != $inside_reset_button_mobile_padding_left ) {
				$css .= '@media (max-width: 480px){.filter--form-wrap .reset-button{padding:'. oceanwp_spacing_css( $inside_reset_button_mobile_padding_top, $inside_reset_button_mobile_padding_right, $inside_reset_button_mobile_padding_bottom, $inside_reset_button_mobile_padding_left ) .'}}';
			}
			if ( ! empty( $inside_reset_button_border_width ) ) {
				$css .= '.filter--form-wrap .reset-button{border-width:' . $inside_reset_button_border_width .';}';
				$css .= '.filter--form-wrap .reset-button{border-style: solid;}';
			}
			if ( ! empty( $inside_reset_button_border_radius ) ) {
				$css .= '.filter--form-wrap .reset-button{border-radius:' . $inside_reset_button_border_radius .';}';
			}

			if ( ! empty( $inside_reset_button_text_color ) ) {
				$css .= '.filter--form-wrap .reset-button{color:' . $inside_reset_button_text_color .';}';
			}
			if ( ! empty( $inside_reset_button_text_color_hover ) ) {
				$css .= '.filter--form-wrap .reset-button:hover{color:' . $inside_reset_button_text_color_hover .';}';
			}
			if ( ! empty( $inside_reset_button_bg_color ) ) {
				$css .= '.filter--form-wrap .reset-button{background-color:' . $inside_reset_button_bg_color .';}';
			}
			if ( ! empty( $inside_reset_button_bg_color_hover ) ) {
				$css .= '.filter--form-wrap .reset-button:hover, .filter--form-wrap .reset-button:focus{background-color:' . $inside_reset_button_bg_color_hover .';}';
			}
			if ( ! empty( $inside_reset_button_border_color ) ) {
				$css .= '.filter--form-wrap .reset-button{border-color:' . $inside_reset_button_border_color .';}';
			}
			if ( ! empty( $inside_reset_button_border_color_hover ) ) {
				$css .= '.filter--form-wrap .reset-button:hover{border-color:' . $inside_reset_button_border_color_hover .';}';
			}

			// Add entry image animation
			if ( true === $img_animation ) {

				if ( ! empty( $img_animation_duration ) && '10s' !==  $img_animation_duration  ) {
					$css .= '.op-has-animation .portfolio-entry-thumbnail:hover img{animation-duration:'. $img_animation_duration .' !important;}';
				}
				if ( ! empty( $img_animation_delay ) ) {
					$css .= '.op-has-animation .portfolio-entry-thumbnail:hover img{animation-delay:'. $img_animation_delay .' !important;}';
				}

				if ( ! empty( $img_transform_origin_inital ) ) {
					$css .= '@keyframes move { 0% { transform-origin:'. $img_transform_origin_inital .';}}';
				}
				if ( ! empty( $img_transform_inital ) ) {
					$css .= '@keyframes move { 0% { transform:'. $img_transform_inital .';}}';
				}

				if ( ! empty( $img_transform_origin_final ) ) {
					$css .= '@keyframes move { 100% { transform-origin:'. $img_transform_origin_final .';}}';
				}
				if ( ! empty( $img_transform_final ) ) {
					$css .= '@keyframes move { 100% { transform:'. $img_transform_final .';}}';
				}

				if ( ! empty( $img_transform_inital ) ) {
					$css .= '@keyframes moveout { 100% { transform:'. $img_transform_inital .';}}';
				}
				if ( ! empty( $img_transform_final ) ) {
					$css .= '@keyframes moveout { 0% { transform:'. $img_transform_final .';}}';
				}
			}

			// Return CSS
			if ( ! empty( $css ) ) {
				$output .= '/* Portfolio CSS */'. $css;
			}

			// Return output css
			return $output;

		}

	}

}
new OceanWP_Portfolio_Customizer();