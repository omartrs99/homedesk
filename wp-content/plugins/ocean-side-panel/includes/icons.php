<?php
/**
 * Array of Icons for the opening button
 */

if ( ! function_exists( 'osp_opening_btn_icons' ) ) {

	function osp_opening_btn_icons( $return = 'menu', $default = 'none' ) {

		// Add none to top of array
		$icons_array = array(
			'none' =>''
		);

		// Define return icons
		$return_icons = array();

		// Returns
		if ( 'menu' == $return ) {
			$return_icons = array('menu','double_arrows_left','double_arrows_right','angle_left','angle_right','long_arrow_alt_left','long_arrow_alt_right','hand_point_left','hand_point_right');
			$return_icons = array_combine($return_icons, $return_icons);
		}

		return apply_filters( 'osp_opening_btn_icons', array_merge( $icons_array, $return_icons ) );

	}

}

/**
 * Get Cart Icons list
 */
if ( ! function_exists( 'osp_opening_btn_icons_list' ) ) {

	function osp_opening_btn_icons_list() {

		$icons = [
			'none' => [
				'id'     => 'none',
				'label'   => esc_html__('None', 'oceanwp'),
				'content' => '',
			],
			'menu' => [
				'id'     => 'menu',
				'label'   => esc_html__('Menu', 'oceanwp'),
				'content' => oceanwp_icon( 'menu', false ),
			],
			'double_arrows_left'  => [
				'id'     => 'double_arrows_left',
				'label'   => esc_html__('Double Arrow Left', 'oceanwp'),
				'content' => oceanwp_icon( 'double_arrows_left', false ),
			],
			'double_arrows_right'  => [
				'id'     => 'double_arrows_right',
				'label'   => esc_html__('Double Arrow Right', 'oceanwp'),
				'content' => oceanwp_icon( 'double_arrows_right', false ),
			],
			'angle_left'  => [
				'id'     => 'angle_left',
				'label'   => esc_html__('Angle Left', 'oceanwp'),
				'content' => oceanwp_icon( 'angle_left', false ),
			],
			'angle_right'  => [
				'id'     => 'angle_right',
				'label'   => esc_html__('Angle Right', 'oceanwp'),
				'content' => oceanwp_icon( 'angle_right', false ),
			],
			'long_arrow_alt_left'  => [
				'id'     => 'long_arrow_alt_left',
				'label'   => esc_html__('Long Arrow Left', 'oceanwp'),
				'content' => oceanwp_icon( 'long_arrow_alt_left', false ),
			],
			'long_arrow_alt_right'  => [
				'id'     => 'long_arrow_alt_right',
				'label'   => esc_html__('Long Arrow Right', 'oceanwp'),
				'content' => oceanwp_icon( 'long_arrow_alt_right', false ),
			],
			'hand_point_left'  => [
				'id'     => 'hand_point_left',
				'label'   => esc_html__('Hand Point Left', 'oceanwp'),
				'content' => oceanwp_icon( 'hand_point_left', false ),
			],
			'hand_point_right'  => [
				'id'     => 'hand_point_right',
				'label'   => esc_html__('Hand Point Right', 'oceanwp'),
				'content' => oceanwp_icon( 'hand_point_right', false ),
			]
		];

		return apply_filters( 'osp_opening_btn_icons_list', $icons );

	}
}