<?php
namespace owpElementor\Modules\StoryPortfolio\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Story_Portfolio extends Widget_Base {

	public function get_name() {
		return 'oew-story-portfolio';
	}

	public function get_title() {
		return __( 'Story Portfolio', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'portfolio',
			'story',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-story-portfolio' );
	}

	public function get_script_depends() {
		return array( 'oew-story-portfolio' );
	}

	protected function register_controls() {

		$site_layout = get_theme_mod( 'ocean_main_layout_style', 'wide' );

		$default_repeater_items = array(
			array(
				'title'           => 'Lorem Ipsum Title 1',
				'description'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
				'website_url'     => array( 'url' => 'https://www.example.com' ),
				'additional_info' => 'First project additional information.',
				'video_type'      => 'youtube',
				'video_youtube'   => 'https://www.youtube.com/watch?v=t6elMWAe3dQ',
				'mobile_image'    => array( 'url' => plugins_url( 'assets/img/story-portfolio-placeholder.png', OWP_ELEMENTOR__FILE__ ) ),
				'autoplay'        => '1',
				'mute'            => '1',
				'loop'            => '1',
			),
			array(
				'title'           => 'Lorem Ipsum Title 2',
				'description'     => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'website_url'     => array( 'url' => 'https://www.example.com' ),
				'additional_info' => 'Second project additional information.',
				'video_type'      => 'youtube',
				'video_youtube'   => 'https://www.youtube.com/watch?v=t6elMWAe3dQ',
				'mobile_image'    => array( 'url' => plugins_url( 'assets/img/story-portfolio-placeholder.png', OWP_ELEMENTOR__FILE__ ) ),
				'autoplay'        => '1',
				'mute'            => '1',
				'loop'            => '1',
			),
			array(
				'title'           => 'Lorem Ipsum Title 3',
				'description'     => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
				'website_url'     => array( 'url' => 'https://www.example.com' ),
				'additional_info' => 'Third project additional information.',
				'video_type'      => 'youtube',
				'video_youtube'   => 'https://www.youtube.com/watch?v=t6elMWAe3dQ',
				'mobile_image'    => array( 'url' => plugins_url( 'assets/img/story-portfolio-placeholder.png', OWP_ELEMENTOR__FILE__ ) ),
				'autoplay'        => '1',
				'mute'            => '1',
				'loop'            => '1',
			),
		);

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Lorem Ipsum Title',
				'placeholder' => __( 'Enter your title', 'ocean-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'placeholder' => __( 'Enter your description', 'ocean-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'website_url',
			array(
				'label'       => __( 'Website URL', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://www.example.com',
				'default'     => array(
					'url'         => 'https://www.example.com',
					'is_external' => true,
					'nofollow'    => true,
				),
				'description' => __( 'Enter URL for the website related to this slide.', 'ocean-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'additional_info',
			array(
				'label'       => __( 'Additional Information', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'placeholder' => __( 'Enter additional details here', 'ocean-elementor-widgets' ),
				'description' => __( 'Additional details like technology stack, features etc.', 'ocean-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'video_type',
			array(
				'label'       => __( 'Video Type', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'mp4'     => __( 'MP4 File', 'ocean-elementor-widgets' ),
					'youtube' => __( 'YouTube', 'ocean-elementor-widgets' ),
					'image'   => __( 'Image', 'ocean-elementor-widgets' ),
				),
				'default'     => 'youtube',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'video_mp4',
			array(
				'label'       => __( 'Video MP4', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'media_type'  => 'video',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'video_type' => 'mp4',
				),
				'description' => __( 'Upload or select an MP4 video from the media library.', 'ocean-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'video_youtube',
			array(
				'label'       => __( 'YouTube Video URL', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'Enter YouTube URL', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'video_type' => 'youtube',
				),
				'description' => __( 'Enter the YouTube video URL.', 'ocean-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'slide_image',
			array(
				'label'       => __( 'Slide Image', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'video_type' => 'image',
				),
				'description' => __( 'Upload or select an image.', 'ocean-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'autoplay',
			array(
				'label'        => esc_html__( 'Autoplay', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default'      => '',
				'separator'    => 'before',
			)
		);

		$repeater->add_control(
			'mute',
			array(
				'label'        => esc_html__( 'Mute', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default'      => '',
			)
		);

		$repeater->add_control(
			'loop',
			array(
				'label'        => esc_html__( 'Loop', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default'      => '',
			)
		);

		$repeater->add_control(
			'mobile_image',
			array(
				'label'       => __( 'Mobile Image', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => array(
					'url' => plugins_url( 'assets/img/story-portfolio-placeholder.png', __FILE__ ),
				),
				'description' => __( 'Upload or select a mobile image from the media library.', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'slides',
			array(
				'label'       => __( 'Slides', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => $default_repeater_items,
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_container',
			array(
				'label' => __( 'Container', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .story-portfolio',
			)
		);

		$this->add_responsive_control(
			'container_inner_padding',
			array(
				'label'      => __( 'Inner Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .story-portfolio-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => '5',
					'right'    => '11',
					'bottom'   => '0',
					'left'     => '5',
					'unit'     => '%',
					'isLinked' => false,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_title',
			array(
				'label' => __( 'Project Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text .project-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .portfolio-text .project-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .portfolio-text .project-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_dash_section',
			array(
				'label' => __( 'Title Dash', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_dash_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text:before' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_dash_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'em' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text:before' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_dash_height',
			array(
				'label'      => __( 'Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text:before' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_url',
			array(
				'label' => __( 'Project URL', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'url_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text .project-url' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'url_hover_color',
			array(
				'label'     => __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text .project-url:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'underline_color',
			array(
				'label'     => __( 'Underline Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text .project-url:after' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'url_typography',
				'selector' => '{{WRAPPER}} .portfolio-text .project-url',
			)
		);

		$this->add_responsive_control(
			'url_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-url' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'url_text_shadow',
				'selector' => '{{WRAPPER}} .portfolio-text .project-url',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_description',
			array(
				'label' => __( 'Project Description', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text .project-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .portfolio-text .project-description',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'description_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'description_text_shadow',
				'selector' => '{{WRAPPER}} .portfolio-text .project-description',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_additional_info',
			array(
				'label' => __( 'Project Additional Info', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'additional_info_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-text .project-additional-info' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'additional_info_typography',
				'selector' => '{{WRAPPER}} .portfolio-text .project-additional-info',
			)
		);

		$this->add_responsive_control(
			'additional_info_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-additional-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'additional_info_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio-text .project-additional-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'additional_info_text_shadow',
				'selector' => '{{WRAPPER}} .portfolio-text .project-additional-info',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_navigation',
			array(
				'label' => __( 'Navigation', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'navigation_arrow_color',
			array(
				'label'     => __( 'Arrow Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio-navigation span, {{WRAPPER}} .portfolio-navigation span:after, {{WRAPPER}} .portfolio-navigation span:before' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'nav_text_heading',
			array(
				'label'     => __( 'Navigation Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_nav_text_style' );

		$this->start_controls_tab(
			'tab_nav_text_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'nav_text_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .story-portfolio .nav-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_nav_text_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'nav_text_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .story-portfolio .nav-text:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nav_text_typography',
				'selector' => '{{WRAPPER}} .story-portfolio .nav-text',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'nav_text_shadow',
				'selector' => '{{WRAPPER}} .story-portfolio .nav-text',
			)
		);

		$this->add_control(
			'nav_project_heading',
			array(
				'label' => __( 'Navigation Project', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->start_controls_tabs( 'tabs_nav_project_style' );

		$this->start_controls_tab(
			'tab_nav_project_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'nav_project_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .story-portfolio .nav-project' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_nav_project_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'nav_project_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .story-portfolio .nav-project:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nav_project_typography',
				'selector' => '{{WRAPPER}} .story-portfolio .nav-project',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'nav_project_shadow',
				'selector' => '{{WRAPPER}} .story-portfolio .nav-project',
			)
		);

		$this->add_responsive_control(
			'nav_project_top_spacing',
			array(
				'label'     => __( 'Top Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .portfolio-navigation .nav-project' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_video',
			array(
				'label' => __( 'Video', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'video_box_shadow',
				'selector' => '{{WRAPPER}} .portfolio-big-image',
			)
		);



		if ( $site_layout == 'boxed' ) {
			$this->add_control(
				'image_height_boxed',
				array(
					'label'      => __( 'Image/Video Height', 'ocean-elementor-widgets' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%', 'vh' ),
					'range'      => array(
						'px' => array(
							'min'  => 100,
							'max'  => 1000,
							'step' => 5,
						),
						'%'  => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
						'vh' => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 474,
					),
					'selectors'  => array(
						'.boxed-layout #wrap {{WRAPPER}} .portfolio-big-image' => 'height: {{SIZE}}{{UNIT}};',
					),
				)
			);
		};

		if ( $site_layout == 'wide' ) {
			$this->add_control(
				'image_height_wide',
				array(
					'label'      => __( 'Image/Video Height', 'ocean-elementor-widgets' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%', 'vh' ),
					'range'      => array(
						'px' => array(
							'min'  => 100,
							'max'  => 1000,
							'step' => 5,
						),
						'%'  => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
						'vh' => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 674,
					),
					'selectors'  => array(
						':not(.boxed-layout)>#wrap {{WRAPPER}} .portfolio-big-image' => 'height: {{SIZE}}{{UNIT}};',
					),
				)
			);
		};

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section_mobile_image',
			array(
				'label' => __( 'Mobile Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		if ( $site_layout == 'boxed' ) {
			$this->add_control(
				'mobile_image_position_boxed',
				array(
					'label'      => __( 'Mobile Image Position from Top', 'ocean-elementor-widgets' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%', 'vh' ),
					'range'      => array(
						'px' => array(
							'min'  => 100,
							'max'  => 1000,
							'step' => 5,
						),
						'%'  => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
						'vh' => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 164,
					),
					'selectors'  => array(
						'.boxed-layout #wrap {{WRAPPER}} .portfolio-mobile-image' => 'top: {{SIZE}}{{UNIT}};',
					),
				)
			);
		};

		if ( $site_layout == 'wide' ) {
			$this->add_control(
				'mobile_image_position_wide',
				array(
					'label'      => __( 'Mobile Image Position from Top', 'ocean-elementor-widgets' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%', 'vh' ),
					'range'      => array(
						'px' => array(
							'min'  => 100,
							'max'  => 1000,
							'step' => 5,
						),
						'%'  => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
						'vh' => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 364,
					),
					'selectors'  => array(
						':not(.boxed-layout)>#wrap {{WRAPPER}} .portfolio-mobile-image' => 'top: {{SIZE}}{{UNIT}};',
					),
				)
			);
		};

		$this->end_controls_section();
	}

	protected function get_youtube_embed_url( $url ) {
		$urlParts = parse_url( $url );
		parse_str( $urlParts['query'], $queryParams );
		$videoId = isset( $queryParams['v'] ) ? $queryParams['v'] : '';
		return 'https://www.youtube.com/embed/' . $videoId;
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$widget_id        = 'story-portfolio-' . $this->get_id();
		$encoded_settings = htmlspecialchars( json_encode( $settings['slides'] ), ENT_QUOTES, 'UTF-8' );

		?>
		<div class="story-portfolio active actEnd" data-settings="<?php echo $encoded_settings; ?>" id="<?php echo $widget_id; ?>">
			<div class="story-portfolio-container">
				<div class="story-portfolio-inner">
					<div class="story-portfolio-item">
						<div class="portfolio-text">
							<?php foreach ( $settings['slides'] as $index => $slide ) : ?>
								<div id="<?php echo $widget_id . '-text-' . $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" style="<?php echo $index === 0 ? 'display: block;' : 'display: none;'; ?>">
									<h3 class="project-title"><?php echo esc_html( $slide['title'] ); ?></h3>
									<?php if ( ! empty( $slide['website_url']['url'] ) ) : ?>
										<a href="<?php echo esc_url( $slide['website_url']['url'] ); ?>" class="project-url">Website</a>
									<?php endif; ?>
									<p class="project-description"><?php echo esc_html( $slide['description'] ); ?></p>
									<p class="project-additional-info"><?php echo esc_html( $slide['additional_info'] ); ?></p>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="portfolio-slide">
						<div id="<?php echo $widget_id . '-big-image'; ?>" class="portfolio-big-image">

							<svg id="video-preloader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" style="display: none;">
								<!-- SVG content for preloader -->
								<circle cx="50" cy="50" r="40" stroke="grey" stroke-width="4" fill="none" stroke-linecap="round"/>
							</svg>

							<?php
							foreach ( $settings['slides'] as $slide ) {
								$autoplay = $slide['autoplay'] === '1' ? 'autoplay' : '';
								$mute     = $slide['mute'] === '1' ? 'muted' : '';
								$loop     = $slide['loop'] === '1' ? 'loop' : '';

								if ( isset( $slide['mobile_image']['url'] ) ) {
									echo '<div id="' . $widget_id . '-mobile-image" class="portfolio-mobile-image"></div>';
								}

								if ( $slide['video_type'] === 'youtube' && $slide['video_youtube'] ) {
									echo '<iframe src="' . $this->get_youtube_embed_url( $slide['video_youtube'] ) . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
								} elseif ( $slide['video_type'] === 'mp4' && $slide['video_mp4'] && $slide['video_mp4']['url'] ) {
									echo '<video ' . $mute . ' ' . $autoplay . ' playsinline ' . $loop . ' poster="' . esc_url( $slide['mobile_image']['url'] ) . '">
                                            <source src="' . esc_url( $slide['video_mp4']['url'] ) . '" type="video/mp4">
                                          </video>';
								} elseif ( $slide['video_type'] === 'image' && $slide['slide_image'] && $slide['slide_image']['url'] ) {
									echo '<img src="' . esc_url( $slide['slide_image']['url'] ) . '" alt="Displayed Image">';
								}
							}
							?>
						</div>
					</div>

						<?php
						$prev_index   = count( $settings['slides'] ) > 1 ? count( $settings['slides'] ) - 1 : 0;
						$next_index   = count( $settings['slides'] ) > 1 ? 1 : 0;
						$prev_project = esc_html( $settings['slides'][ $prev_index ]['title'] );
						$next_project = esc_html( $settings['slides'][ $next_index ]['title'] );
						?>

						<div class="portfolio-navigation">
							<div class="prev" id="<?php echo $widget_id . '-prev'; ?>">
								<div class="nav-text"><?php echo esc_html__( 'Previous Project', 'ocean-elementor-widgets' ); ?></div>
								<span></span>
								<p class="nav-project"><?php echo $prev_project; ?></p>
							</div>
							<div class="next" id="<?php echo $widget_id . '-next'; ?>">
								<div class="nav-text"><?php echo esc_html__( 'Next Project', 'ocean-elementor-widgets' ); ?></div>
								<span></span>
								<p class="nav-project"><?php echo $next_project; ?></p>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
