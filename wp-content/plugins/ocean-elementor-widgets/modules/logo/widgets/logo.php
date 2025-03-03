<?php
namespace owpElementor\Modules\Logo\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Logo extends Widget_Base {

	public function get_name() {
		return 'oew-logo';
	}

	public function get_title() {
		return __( 'Logo', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'logo',
			'icon',
			'owp',
		);
	}

	protected function is_dynamic_content(): bool {
		return false;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_logo',
			array(
				'label' => __( 'Logo', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'position',
			array(
				'label'     => __( 'Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .custom-header-logo' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'max_width',
			array(
				'label'     => __( 'Max Width', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 10,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} #site-logo #site-logo-inner a img, #site-header.center-header #site-navigation .middle-site-logo a img' => 'max-width: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'max_height',
			array(
				'label'     => __( 'Max Height', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 10,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} #site-logo #site-logo-inner a img, #site-header.center-header #site-navigation .middle-site-logo a img' => 'max-height: {{SIZE}}px !important;',
				),
			)
		);

		// Border Radius.
		$this->add_responsive_control(
			'logo_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} #site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #site-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings(); ?>

		<div class="custom-header-logo clr">

			<?php
			// Logo
			get_template_part( 'partials/header/logo' );
			?>

		</div>

		<?php
	}
}
