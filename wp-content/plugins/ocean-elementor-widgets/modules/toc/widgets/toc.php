<?php
namespace owpElementor\Modules\TOC\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class TOC extends Widget_Base {

	public function get_name() {
		return 'oew-toc';
	}

	public function get_title() {
		return __( 'Table of Contents', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-table-of-contents';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'toc',
			'table of contents',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-toc' );
	}

	public function get_style_depends() {
		return array( 'oew-toc' );
	}

	public function get_frontend_settings() {
		$frontend_settings = parent::get_frontend_settings();

		if ( Plugin::$instance->experiments->is_feature_active( 'e_font_icon_svg' ) && ! empty( $frontend_settings['icon']['value'] ) ) {
			$frontend_settings['icon']['rendered_tag'] = Icons_Manager::render_font_icon( $frontend_settings['icon'] );
		}

		return $frontend_settings;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_toc',
			array(
				'label' => __( 'ToC', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'disable_header',
			array(
				'label'        => __( 'Disable Header', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);



		$this->add_control(
			'title',
			array(
				'label'       => __( 'ToC Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'disable_header!' => 'yes',
				),
				'label_block' => true,
				'default'     => __( 'Table of Contents', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'html_tag',
			array(
				'label'   => __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'h5'  => 'H5',
					'h6'  => 'H6',
					'div' => 'div',
				),
				'default' => 'h4',
			)
		);

		$this->start_controls_tabs( 'include_exclude_tags', array( 'separator' => 'before' ) );

		$this->start_controls_tab(
			'include',
			array(
				'label' => __( 'Include', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'headings_by_tags',
			array(
				'label'              => __( 'Anchors By Tags', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SELECT2,
				'multiple'           => true,
				'default'            => array( 'h2', 'h3', 'h4', 'h5', 'h6' ),
				'options'            => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'label_block'        => true,
				'frontend_available' => true,
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'exclude',
			array(
				'label' => __( 'Exclude', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'exclude_headings_by_selector',
			array(
				'label'              => __( 'Anchors By Selector', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::TEXT,
				'description'        => __( 'CSS selectors, in a comma-separated list', 'ocean-elementor-widgets' ),
				'default'            => array(),
				'label_block'        => true,
				'frontend_available' => true,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'marker_view',
			array(
				'label'              => __( 'Marker View', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'numbers',
				'options'            => array(
					'numbers' => __( 'Numbers', 'ocean-elementor-widgets' ),
					'bullets' => __( 'Bullets', 'ocean-elementor-widgets' ),
				),
				'separator'          => 'before',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'                  => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'                   => Controls_Manager::ICONS,
				'default'                => array(
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				),
				'recommended'            => array(
					'fa-solid'   => array(
						'circle',
						'dot-circle',
						'square-full',
					),
					'fa-regular' => array(
						'circle',
						'dot-circle',
						'square-full',
					),
				),
				'condition'              => array(
					'marker_view' => 'bullets',
				),
				'skin'                   => 'inline',
				'label_block'            => false,
				'exclude_inline_options' => array( 'svg' ),
				'frontend_available'     => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_options',
			array(
				'label' => __( 'Options', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'minimize_box',
			array(
				'label'              => __( 'Collapse Box', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'expand_icon',
			array(
				'label'       => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-chevron-down',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid'   => array(
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					),
					'fa-regular' => array(
						'caret-square-down',
					),
				),
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'minimize_box' => 'yes',
				),
			)
		);

		$this->add_control(
			'collapse_icon',
			array(
				'label'       => __( 'Minimize Icon', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-chevron-up',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid'   => array(
						'chevron-up',
						'angle-up',
						'angle-double-up',
						'caret-up',
						'caret-square-up',
					),
					'fa-regular' => array(
						'caret-square-up',
					),
				),
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'minimize_box' => 'yes',
				),
			)
		);

		$this->add_control(
			'hierarchical_view',
			array(
				'label'              => __( 'Hierarchical View', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'container_style',
			array(
				'label' => __( 'Container', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'container_background',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'container_border',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
			)
		);

		$this->add_control(
			'container_border_radius',
			array(
				'label'     => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'container_padding',
			array(
				'label'     => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'padding: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'container_min_height',
			array(
				'label'              => __( 'Min Height', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'          => array(
					'{{WRAPPER}} .elementor-widget-container' => 'min-height: {{SIZE}}{{UNIT}}',
				),
				'frontend_available' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'container_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'header_style',
			array(
				'label'     => __( 'ToC Header', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'disable_header!' => 'yes',
				),
			)
		);

		$this->add_control(
			'header_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-header' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'header_border',
				'selector'       => '{{WRAPPER}} .oew-toc-header',
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '1',
							'left'     => '0',
							'isLinked' => false,
						),
					),
					'color'  => array(
						'default' => '#333',
					),
				),
			)
		);

		$this->add_control(
			'header_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .oew-toc-header-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_typography',
				'selector' => '{{WRAPPER}} .oew-toc-header, {{WRAPPER}} .oew-toc-header-title',

			)
		);

		$this->add_control(
			'toggle_button_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'minimize_box' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-toggle-button i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-toc-toggle-button svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'toggle_button_size',
			array(
				'label'              => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SLIDER,
				'condition'          => array(
					'minimize_box' => 'yes',
				),
				'selectors'          => array(
					'{{WRAPPER}} .oew-toc-toggle-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-toc-toggle-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list_style',
			array(
				'label' => __( 'ToC List', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'list_typography',
				'selector' => '{{WRAPPER}} .oew-toc-list-item',

			)
		);

		$this->add_control(
			'list_indent',
			array(
				'label'      => __( 'Indent', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'unit' => 'em',
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-toc-list-item' => 'padding-left: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->start_controls_tabs( 'item_text_style' );

		$this->start_controls_tab(
			'normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'item_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'item_text_underline_normal',
			array(
				'label'     => __( 'Underline', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a' => 'text-decoration: underline',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'item_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'item_text_underline_hover',
			array(
				'label'     => __( 'Underline', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a:hover' => 'text-decoration: underline',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'active',
			array(
				'label' => __( 'Active', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'item_text_color_active',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a:active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'item_text_underline_active',
			array(
				'label'     => __( 'Underline', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a:active' => 'text-decoration: underline',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_marker',
			array(
				'label'     => __( 'Marker', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'marker_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item-text-wrapper i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-toc-list-item-text-wrapper svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'marker_size',
			array(
				'label'      => __( 'Size', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-toc-list-item-text-wrapper i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .oew-toc-list-item-text-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'top_level_item_style',
			array(
				'label'     => __( 'Top Level Items', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'hierarchical_view' => 'yes',
				),
			)
		);

		$this->add_control(
			'top_level_item_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => array(
					'{{WRAPPER}} .oew-toc-list-item a.oew-toc-top-level' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'               => 'top_level_item_typography',
				'selector'           => '{{WRAPPER}} .oew-toc-list-item a.oew-toc-top-level',
				'fields_options'     => array(
					'font_weight' => array(
						'default' => '700',
					),
				),
				'frontend_available' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'top_level_item_border',
				'selector' => '{{WRAPPER}} .oew-toc-list-item a.oew-toc-top-level',
			)
		);

		$this->add_responsive_control(
			'top_level_item_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-toc-list-item a.oew-toc-top-level' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();
	}



	protected function render() {
		$settings = $this->get_settings_for_display();
		$toc_id   = 'oew-toc-' . $this->get_id();

		$this->add_render_attribute( 'header', 'class', 'oew-toc-header' );
		$this->add_render_attribute(
			'body',
			array(
				'id'    => $toc_id,
				'class' => 'oew-toc-body',
			)
		);


		if ( 'yes' === $settings['minimize_box'] ) {
			$this->add_render_attribute(
				'expand-button',
				array(
					'class'         => 'oew-toc-toggle-button oew-toc-toggle-button-expand',
					'role'          => 'button',
					'tabindex'      => '0',
					'aria-controls' => $toc_id,
					'aria-expanded' => 'true',
					'aria-label'    => esc_html__( 'Open table of contents', 'ocean-elementor-widgets' ),
				)
			);
			$this->add_render_attribute(
				'collapse-button',
				array(
					'class'         => 'oew-toc-toggle-button oew-toc-toggle-button-collapse',
					'role'          => 'button',
					'tabindex'      => '0',
					'aria-controls' => $toc_id,
					'aria-expanded' => 'true',
					'aria-label'    => esc_html__( 'Close table of contents', 'ocean-elementor-widgets' ),
				)
			);
		}

		if ( 'yes' !== $settings['disable_header'] ) {
			?>
		<div <?php $this->print_render_attribute_string( 'header' ); ?>>
			<<?php echo esc_attr( $settings['html_tag'] ); ?> class="oew-toc-header-title">
				<?php echo esc_html( $settings['title'] ); ?>
			</<?php echo esc_attr( $settings['html_tag'] ); ?>>
			<?php if ( 'yes' === $settings['minimize_box'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'expand-button' ); ?>>
					<?php Icons_Manager::render_icon( $settings['expand_icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</div>
				<div <?php $this->print_render_attribute_string( 'collapse-button' ); ?>>
					<?php Icons_Manager::render_icon( $settings['collapse_icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
			<?php
		}
		?>
		<div <?php $this->print_render_attribute_string( 'body' ); ?>></div>
		<?php
	}
}
