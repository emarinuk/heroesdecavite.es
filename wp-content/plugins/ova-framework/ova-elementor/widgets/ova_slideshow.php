<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use ElementorPro\Base\Base_Widget;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_slideshow extends Widget_Base {

	
	public function get_name() {
		return 'ova_slideshow';
	}

	public function get_title() {
		return __( 'Slides Show', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_keywords() {
		return [ 'slides', 'carousel', 'image', 'title', 'slider' ];
	}

	public function get_script_depends() {
		// Carousel
		wp_enqueue_style( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'script-elementor' ];
	}

	protected function register_controls() {

		$animation_array =array(
			'bounce'  => 'bounce',
			'flash'  => 'flash',
			'pulse'  => 'pulse',
			'rubberBand'  => 'rubberBand',
			'shake'  => 'shake',
			'swing'  => 'swing',
			'tada'  => 'tada',
			'wobble'  => 'wobble',
			'jello'  => 'jello',
			'bounceIn'  => 'bounceIn',
			'bounceInDown'  => 'bounceInDown',
			'bounceInLeft'  => 'bounceInLeft',
			'bounceInRight'  => 'bounceInRight',
			'bounceInUp'  => 'bounceInUp',
			'bounceOut'  => 'bounceOut',
			'bounceOutDown'  => 'bounceOutDown',
			'bounceOutLeft'  => 'bounceOutLeft',
			'bounceOutRight'  => 'bounceOutRight',
			'bounceOutUp'  => 'bounceOutUp',
			'fadeIn'  => 'fadeIn',
			'fadeInDown'  => 'fadeInDown',
			'fadeInDownBig'  => 'fadeInDownBig',
			'fadeInLeft'  => 'fadeInLeft',
			'fadeInLeftBig'  => 'fadeInLeftBig',
			'fadeInRight'  => 'fadeInRight',
			'fadeInRightBig'  => 'fadeInRightBig',
			'fadeInUp'  => 'fadeInUp',
			'fadeInUpBig'  => 'fadeInUpBig',
			'fadeOut'  => 'fadeOut',
			'fadeOutDown'  => 'fadeOutDown',
			'fadeOutDownBig'  => 'fadeOutDownBig',
			'fadeOutLeft'  => 'fadeOutLeft',
			'fadeOutLeftBig'  => 'fadeOutLeftBig',
			'fadeOutRight'  => 'fadeOutRight',
			'fadeOutRightBig'  => 'fadeOutRightBig',
			'fadeOutUp'  => 'fadeOutUp',
			'fadeOutUpBig'  => 'fadeOutUpBig',
			'flip'  => 'flip',
			'flipInX'  => 'flipInX',
			'flipInY'  => 'flipInY',
			'flipOutX'  => 'flipOutX',
			'flipOutY'  => 'flipOutY',
			'lightSpeedIn'  => 'lightSpeedIn',
			'lightSpeedOut'  => 'lightSpeedOut',
			'rotateIn'  => 'rotateIn',
			'rotateInDownLeft'  => 'rotateInDownLeft',
			'rotateInDownRight'  => 'rotateInDownRight',
			'rotateInUpLeft'  => 'rotateInUpLeft',
			'rotateInUpRight'  => 'rotateInUpRight',
			'rotateOut'  => 'rotateOut',
			'rotateOutDownLeft'  => 'rotateOutDownLeft',
			'rotateOutDownRight'  => 'rotateOutDownRight',
			'rotateOutUpLeft'  => 'rotateOutUpLeft',
			'rotateOutUpRight'  => 'rotateOutUpRight',
			'slideInUp'  => 'slideInUp',
			'slideInDown'  => 'slideInDown',
			'slideInLeft'  => 'slideInLeft',
			'slideInRight'  => 'slideInRight',
			'slideOutUp'  => 'slideOutUp',
			'slideOutDown'  => 'slideOutDown',
			'slideOutLeft'  => 'slideOutLeft',
			'slideOutRight'  => 'slideOutRight',
			'zoomIn'  => 'zoomIn',
			'zoomInDown'  => 'zoomInDown',
			'zoomInLeft'  => 'zoomInLeft',
			'zoomInRight'  => 'zoomInRight',
			'zoomInUp'  => 'zoomInUp',
			'zoomOut'  => 'zoomOut',
			'zoomOutDown'  => 'zoomOutDown',
			'zoomOutLeft'  => 'zoomOutLeft',
			'zoomOutRight'  => 'zoomOutRight',
			'zoomOutUp'  => 'zoomOutUp',
			'hinge'  => 'hinge',
			'jackInTheBox'  => 'jackInTheBox',
			'rollIn'  => 'rollIn',
			'rollOut'  => 'rollOut'


		);

		$this->start_controls_section(
			'section_slides',
			[
				'label' => __( 'Slides', 'ova-framework' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );

		// *****Repeater Background***** 
		$repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'ova-framework' ) ] );

		$repeater->add_control(
			'background_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label' => _x( 'Background Image', 'Background Control', 'ova-framework' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);

		$repeater->add_control(
			'background_size',
			[
				'label' => _x( 'Size', 'Background Control', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => _x( 'Cover', 'Background Control', 'ova-framework' ),
					'contain' => _x( 'Contain', 'Background Control', 'ova-framework' ),
					'auto' => _x( 'Auto', 'Background Control', 'ova-framework' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-bg' => 'background-size: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_ken_burns',
			[
				'label' => __( 'Ken Burns Effect', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'zoom_direction',
			[
				'label' => __( 'Zoom Direction', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'in',
				'options' => [
					'in' => __( 'In', 'ova-framework' ),
					'out' => __( 'Out', 'ova-framework' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_ken_burns',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay',
			[
				'label' => __( 'Background Overlay', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ova-framework' ),
				'label_off' => __( 'Hide', 'ova-framework' ),
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-background-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_overlay_gradient',
			[
				'label' => __( 'Gradient', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-background-overlay:after' => 'background-image: linear-gradient({{VALUE}})',
				],
			]
		);

		$repeater->add_control(
			'background_overlay_gradient_opacity',
			[
				'label' => __( 'Gradient Opacity', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-background-overlay:after' => 'opacity: {{SIZE}};',
				],
			]
		);

		$repeater->add_control(
			'background_overlay_blend_mode',
			[
				'label' => __( 'Blend Mode', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'ova-framework' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-background-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$repeater->end_controls_tab(); 
		// *****Repeater Background*****


		// *****Repeater Content*****
		$repeater->start_controls_tab( 'content', [ 'label' => __( 'Content', 'ova-framework' ) ] );
		$repeater->add_control(
			'slide_name',
			[
				'label' => __( 'Slide Name', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Name', 'ova-framework' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Sub Title', 'ova-framework' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Title', 'ova-framework' ),
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'ova-framework' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Desccription', 'ova-framework' ),
				'separator' => 'before',
			]
		);

		
		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'ova-framework' ),
			]
		);

		

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'ova-framework' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
			]
		);

		

		$repeater->add_control(
			'lines',
			[
				'label' => __( 'Line', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater->end_controls_tab(); // *****End Repeater Content*****

		// *****Repeater Style*****
		$repeater->start_controls_tab( 'style', [ 'label' => __( 'Style', 'ova-framework' ) ] );

		$repeater->add_control(
			'custom_style',
			[
				'label' => __( 'Custom', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => __( 'Set custom style that will only affect this specific slide.', 'ova-framework' ),
			]
		);

		$repeater->add_control(
			'horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ova-framework' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-slide-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-left: 0',
					'center' => 'margin: 0 auto',
					'right' => 'margin-right: 0',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'vertical_position',
			[
				'label' => __( 'Vertical Position', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'ova-framework' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ova-framework' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ova-framework' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'text_align',
			[
				'label' => __( 'Text Align', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ova-framework' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner' => 'text-align: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'content_color',
			[
				'label' => __( 'Content Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-slide-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-slide-sub_title' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-slide-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner .elementor-slide-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->end_controls_tab(); // *****End Repeater Style*****

		$repeater->end_controls_tabs(); // *****End Repeater*****

		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'ova-framework' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slide_name' => __('Slide 1', 'ova-framework'),
						'subtitle' => __( 'Sub Title', 'ova-framework' ),
						'title' => __( 'Title Slide 1', 'ova-framework' ),
						'description' => __( 'I am slide content. Description', 'ova-framework' ),
						'button_text' => __( 'Click Here', 'ova-framework' ),
						'background_color' => '#ffffff',
					],
					[
						'slide_name' => __('Slide 2', 'ova-framework'),
						'subtitle' => __( 'Sub Title', 'ova-framework' ),
						'title' => __( 'Title Slide 2', 'ova-framework' ),
						'description' => __( 'I am slide content. Description', 'ova-framework' ),
						'button_text' => __( 'Click Here', 'ova-framework' ),
						'background_color' => '#ffffff',
					],
					[
						'slide_name' => __('Slide 3', 'ova-framework'),
						'subtitle' => __( 'Sub Title', 'ova-framework' ),
						'title' => __( 'Title Slide 3', 'ova-framework' ),
						'description' => __( 'I am slide content. Description', 'ova-framework' ),
						'button_text' => __( 'Click Here', 'ova-framework' ),
						'background_color' => '#ffffff',
					],
				],
				'title_field' => '{{{ slide_name }}}',
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __( 'Height', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1080,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 600,
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .items' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// *****Slider Options*****
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'ova-framework' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __( 'Arrows and Dots', 'ova-framework' ),
					'arrows' => __( 'Arrows', 'ova-framework' ),
					'dots' => __( 'Dots', 'ova-framework' ),
					'none' => __( 'None', 'ova-framework' ),
				],
			]
		);

		// $this->add_control(
		// 	'dots_container',
		// 	[
		// 		'label' => __( 'Dots Container', 'ova-framework' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'owl-dots container',
		// 		'options' => [
		// 			'container' => __( 'Yes', 'ova-framework' ),
		// 			'' => __( 'No', 'ova-framework' ),
		// 		],
		// 		'condition' => [
		// 			'navigation' => [ 'dots', 'both' ],
		// 		],
		// 	]
		// );

		$this->add_control(
			'line_arrows',
			[
				'label' => __( 'Line Arrows', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-prev:after' => 'display: block;',
					'{{WRAPPER}} .ova_slideshow .owl-next:after' => 'display: block;',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]

		);

		

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed (ms)', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10000,
				'condition' => [
					'autoplay' => 'yes',
				],
				
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		// $this->add_control(
		// 	'lazy_load',
		// 	[
		// 		'label' => __( 'Lazy Load', 'ova-framework' ),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'default' => 'yes',
		// 	]
		// );

		$this->add_control(
			'zoom_speed',
			[
				'label' => __( 'Zoom Speed (ms)', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'selectors' => [
					'{{WRAPPER}} .slide-bg' => 'animation-duration: calc({{VALUE}}ms);',
				],
			]
		);

		$this->end_controls_section(); // *****End Slider Options Section*****

		// *****Style Slides*****
		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __( 'Slides', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __( 'Content Width', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '66',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .slide-inner ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ova-framework' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				// 'prefix_class' => 'elementor--h-position-',
				'selectors' => [
					'{{WRAPPER}} .slide-inner .elementor-slide-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
			]
		);

		$this->add_control(
			'slides_vertical_position',
			[
				'label' => __( 'Vertical Position', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'ova-framework' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ova-framework' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ova-framework' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				// 'prefix_class' => 'elementor--v-position-',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-inner' => 'align-items: {{VALUE}}!important',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
			]
		);

		$this->add_control(
			'slides_text_align',
			[
				'label' => __( 'Text Align', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ova-framework' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-content' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section(); 
		// *****End Style Slides*****



		// *****Style Sub Title*****
		$this->start_controls_section(
			'section_style_subtitle',
			[
				'label' => __( 'Sub Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .slide-inner .elementor-slide-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .elementor-slide-subtitle',
			]
		);

		$this->add_control(
			'show_animation_subtitle',
			[
				'label' => __( 'Animate', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'animation_style_subtitle',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $animation_array,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_subtitle',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'animation_dur_subtitle',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
				
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_subtitle',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->end_controls_section(); 
		// End Style Title


		// Style Title
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .slide-inner .elementor-slide-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-title' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'scheme' => Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elementor-slide-title',
			]
		);

		$this->add_control(
			'show_animation_title',
			[
				'label' => __( 'Animate', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'animation_style_title',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $animation_array,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_title',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'animation_dur_title',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1000,
				
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_title',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		$this->end_controls_section(); 
		// End Style Sub Title


		// Style Description
		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Description', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .slide-inner .elementor-slide-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elementor-slide-description',
			]
		);

		$this->add_control(
			'show_animation_description',
			[
				'label' => __( 'Animate', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'animation_style_desc',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $animation_array,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_description',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'animation_dur_desc',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1500,
				
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_description',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);


		$this->end_controls_section(); 
		// End Style Description

		// Style Button
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_button',
			[
				'label' => __( 'Show Button', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}}  .ova_slideshow .elementor-slide-button' => 'display: inline-block',
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => __( 'Style 1', 'ova-framework' ),
					'style_2' => __( 'Style 2', 'ova-framework' ),
				],
			]
		);

		$this->add_control(
			'show_animation_button',
			[
				'label' => __( 'Animate', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);

		$this->add_control(
			'animation_style_btn',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $animation_array,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_button',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'animation_dur_btn',
			[
				'label' => __( 'Animation', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2000,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_animation_button',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .ova_slideshow .elementor-slide-button',
				'scheme' => Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Width', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button' => 'border-width:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button.style_2:before' => 'border-width:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button.style_2:after' => 'border-width:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'padding_button',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button' => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', 'ova-framework' ) ] );

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button.style_2:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .ova_slideshow .elementor-slide-button.style_2:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', 'ova-framework' ) ] );

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section(); 
		// End Style Button

		// Style Navigation
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __( 'Navigation', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __( 'Arrows', 'ova-framework' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __( 'Arrows Position', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __( 'Inside', 'ova-framework' ),
					'outside' => __( 'Outside', 'ova-framework' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'auto_show_arrows',
			[
				'label' => __( 'Show Arrows', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'always',
				'options' => [
					'always' => __( 'Always', 'ova-framework' ),
					'hover' => __( 'Hover', 'ova-framework' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __( 'Arrows Size', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-prev, {{WRAPPER}} .ova_slideshow .owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
				'default' => ['px' => 20,],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-prev, {{WRAPPER}} .ova_slideshow .owl-next' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
				'default' => '#ffffff',
			]
		);
		$this->add_control(
			'arrows_color_hover',
			[
				'label' => __( 'Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-prev:hover, {{WRAPPER}} .ova_slideshow .owl-next:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
				'default' => '#ffffff',
				'separator' => 'after',
			]
		);

		// Dots
		$this->add_control(
			'heading_style_dots',
			[
				'label' => __( 'Dots', 'ova-framework' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
				// 'separator' => 'before',
			]
		);

		$this->add_control(
			'dots_style',
			[
				'label' => __( 'Dots Style', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dots_style',
				'options' => [
					'dots_style' => __( 'Dots', 'ova-framework' ),
					'square_style' => __( 'Square', 'ova-framework' ),
					'line_style' => __( 'Line', 'ova-framework' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __( 'Dots Position', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					// 'outside' => __( 'Outside', 'ova-framework' ),
					'bottom' => __( 'Bottom', 'ova-framework' ),
					'middle' => __( 'Middle', 'ova-framework' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'hide_in_mobile',
			[
				'label' => __( 'Hide In Mobile', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'owl-dots',
				'options' => [
					'owl-dots' => __( 'No', 'ova-framework' ),
					'owl-dots hide_in_mobile' => __( 'Yes', 'ova-framework' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_align',
			[
				'label' => __( 'Dots Align', 'ova-framework' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'toggle' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ova-framework' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dots ' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'left: 0;',
					'center' => 'left: 50%; transform: translateX(-50%); align-items: center',
					'right' => 'right: 0; align-items: flex-end',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Dots Size', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dots span' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ova_slideshow.square_style .owl-dots span' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
					'terms' => [
						[
							'name' => 'dots_style',
							'operator' => '!=',
							'value' => 'line_style',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'dots_padding',
			[
				'label' => __( 'Padding Dots', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'dot_margin',
			[
				'label' => __( 'Margin Dot', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dots .owl-dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);
		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dots .active span' => 'background: {{VALUE}};',
					'{{WRAPPER}} .ova_slideshow .owl-dots span' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
				// 'default' => '#b9a171',
			]
		);

		$this->add_control(
			'dots_color_hover',
			[
				'label' => __( 'Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dot:hover span' => 'background: {{VALUE}};',
					'{{WRAPPER}} .ova_slideshow.line_style .owl-dot:hover span' => 'border-color: {{VALUE}};',
				],
				// 'default' => '#b9a171',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_background',
			[
				'label' => __( 'Background', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_slideshow .owl-dots span' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();
		// *****End Style Navigation*****
	}


	protected function render() {

		$settings = $this->get_settings();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$show_animation_title = $settings['show_animation_title'];
		$show_animation_subtitle = $settings['show_animation_subtitle'];
		$show_animation_description = $settings['show_animation_description'];
		$show_animation_button = $settings['show_animation_button'];


		// $this->add_render_attribute( 'wrap_dots', 'class', [$settings['dots_container'] ]);

		$this->add_render_attribute( 'button', 'class', [ 'elementor-slide-button', $settings['button_style'] ] );

		if( $show_animation_button != '' ){
			$this->add_render_attribute( 'button', 'data-animation', [ $settings['animation_style_btn'] ]);
			$this->add_render_attribute( 'button', 'data-animation_dur', [ $settings['animation_dur_btn'] ]);
			$this->add_render_attribute( 'button', 'style', ['animation-duration: '.$settings['animation_dur_btn'] ] );
		}

		$slides = [];
		$slide_count = 0;

		
		foreach ( $settings['slides'] as $slide ) {
			$slide_html       = $slide_all_html = '';
			$btn_attributes   = '';
			$slide_url        = $slide['link']['url'];

			$animation_class = '';
			$background_ken_burns = $slide['background_ken_burns'];
			$zoom_direction = $slide['zoom_direction'];

			if ( 'yes' === $background_ken_burns && 'in' === $zoom_direction ) {
				$animation_class = ' elementor-ken-in';
			}
			if ( 'yes' === $background_ken_burns && 'out' === $zoom_direction ) {
				$animation_class = ' elementor-ken-out';
			}

			if ( ! empty( $slide_url ) ) {
				$this->add_render_attribute( 'slide_link' . $slide_count,
					[
						'href' => $slide_url,

					]
				);

				if ( $slide['link']['is_external'] ) {
					$this->add_render_attribute( 'slide_link' . $slide_count,
						[
							'target' => '_blank',
							'rel' => 'nofollow',
						]
					);
				}
				
				
				$btn_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );

			}

			if ( 'yes' === $slide['background_overlay'] ) {
				$slide_html .= '<div class="elementor-background-overlay"></div>';
			}
			$slide_html .= '<div class="container"><div class="row"><div class="elementor-slide-content">';
			

			if ( $slide['lines'] ) {
				$slide_html .= '<span class="line_top"></span><span class="line_bottom"></span>';
			}

			if ( $slide['subtitle'] && $show_animation_subtitle != '' ) {
				$slide_html .= '<div data-animation="'.$settings['animation_style_subtitle'].'" data-animation_dur="'.trim($settings['animation_dur_subtitle']).'" class="second_font elementor-slide-subtitle" style="animation-duration: '.trim($settings['animation_dur_subtitle']).'ms">' . $slide['subtitle'] . '</div>';
			}else{
				$slide_html .= '<div class="second_font elementor-slide-subtitle">' . $slide['subtitle'] . '</div>';
			}

			if ( $slide['title'] && $show_animation_title != '' ) {
				$slide_html .= '<div data-animation="'.$settings['animation_style_title'].'" data-animation_dur="'.trim($settings['animation_dur_title']).'"  class="second_font elementor-slide-title " style="animation-duration: '.trim($settings['animation_dur_title']).'ms">' . $slide['title'] . '</div>';
			}else{
				$slide_html .= '<div class="second_font elementor-slide-title ">' . $slide['title'] . '</div>';
			}


			if ( $slide['description'] && $show_animation_description != '' ) {
				$slide_html .= '<div class="elementor-slide-description" data-animation="'.$settings['animation_style_desc'].'" data-animation_dur="'.trim($settings['animation_dur_desc']).'" style="animation-duration: '.trim($settings['animation_dur_desc']).'ms">' . $slide['description'] . '</div>';
			}else{
				$slide_html .= '<div class="elementor-slide-description">' . $slide['description'] . '</div>';
			}

			if ( $slide['button_text'] && $show_animation_button != '' ) {
				$slide_html .= '<a '.$btn_attributes.' data-animation="'.$settings['animation_style_btn'].'" data-animation_dur="'.trim($settings['animation_dur_btn']).'" style="animation-duration: '.trim($settings['animation_dur_btn']).'ms" class="elementor-slide-button '.$settings['button_style'].'">' . $slide['button_text'] . '</a>';
			}

			
			$slide_html .= '</div></div></div>';
			
			$slide_all_html = '<div class=" slide-bg'.$animation_class.'" ></div>
			<div class="slide-inner">'.$slide_html.'</div>';

			$slides[] = '<div class=" elementor-repeater-item-' . $slide['_id'] . ' items" data-dot=" <div>'.$slide['slide_name'].'</div> <button><span></span></button>">' . $slide_all_html . '</div>';
			$slide_count++;
		}
		
		$is_rtl         = is_rtl() ? true : false;
		$direction      = $is_rtl ? 'rtl' : 'ltr';
		$show_dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$autoplay_owl   = ( 'yes' === $settings['autoplay'] ) ? true : false;
		$loop_owl       = ( 'yes' === $settings['infinite'] ) ? true : false;
		// $lazyLoad_owl   = ( 'yes' === $settings['lazy_load'] ) ? true : false;
		$autoplay_speed = $settings['autoplay_speed'];
		$mouseDrag      = count($slides) == 1 ? false : true;
		$owl_carousel = [
			'items'           => 1,
			'singleItem'      => 1,
			'autoplayTimeout' => $autoplay_speed,
			'autoplay'        => $autoplay_owl,
			'loop'            => $loop_owl,
			// 'lazyLoad'        => $lazyLoad_owl,
			'nav'             => $show_arrows,
			'dots'            => $show_dots,
			'rtl'             => $is_rtl,
			'dotsClass'       => $settings['hide_in_mobile'],
			'mouseDrag'       => $mouseDrag,
			'navText' => [
				'<i class="ti-angle-left"></i>',
				'<i class="ti-angle-right"></i>'
			],

		];
		
		$carousel_classes = [ 'elementor-slides owl-carousel owl-theme owl-loaded' ];

		if ( $show_arrows ) {
			$carousel_classes[] = 'arrows-' . $settings['arrows_position'];
			$carousel_classes[] = 'arrows-show-' . $settings['auto_show_arrows'];
		}

		if ( $show_dots ) {
			$carousel_classes[] = 'dots-' . $settings['dots_position'];
		}

		$carousel_classes[] = 'animated owl-animated-out owl-animated-in';

		$this->add_render_attribute( 'slides', [
			'class' => $carousel_classes,
			'data-owl_carousel' => wp_json_encode( $owl_carousel),
		] );

		?>
		<div class="ova_slideshow elementor-slides-wrapper <?php echo esc_attr( $settings['dots_style'] ); ?> " dir="<?php echo esc_attr( $direction ); ?>">
			<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
				<?php echo implode( '', $slides ); ?>
			</div>
		</div>
		<?php
	}
}