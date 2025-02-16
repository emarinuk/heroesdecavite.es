<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ova_slider extends Widget_Base {

	public function get_name() {
		return 'ova_slider';
	}

	public function get_title() {
		return __( 'Slider', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}


	public function get_script_depends() {
		wp_enqueue_style( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'script-elementor' ];
	}

	protected function register_controls() {


		/*************************************************************************************************
									SECTION CONTENT SLIDER
		*************************************************************************************************/

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);


			$this->add_responsive_control(
				'height',
				[
					'label' => __( 'Height', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 600,
					],
					'selectors' => [
						'{{WRAPPER}} .ova-slider .list-slider .slider-item .image-box' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);



			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'image',
				[
					'label' => __( 'Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);


			$repeater->add_control(
				'title',
				[
					'label' => __( 'Title ', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __( 'Naive Painting Of The 19th Century', 'ova-framework' ),
					'row' => 2,
				]
			);

			$repeater->add_control(
				'sub_title',
				[
					'label' => __( 'Sub Title ', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __( 'From 13 Dec 2018 until 15 May 2019', 'ova-framework' ),
					'row' => 2,
				]
			);


			$this->add_control(
				'tabs_content',
				[
					'label' => __( 'Items', 'ova-framework' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		############################ END SECTION SLIDER  ############################


		/*****************************************************************
		START SECTION ADDITIONAL VERSIONT 1 TESTIMONIAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'ova-framework' ),
			]
		);


			$this->add_control(
				'margin_items',
				[
					'label' => __( 'Margin Right Items', 'ova-framework' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 30,
				]

			);


			$this->add_control(
				'slides_to_scroll',
				[
					'label' => __( 'Slides to Scroll', 'ova-framework' ),
					'type' => Controls_Manager::NUMBER,
					'description' => __( 'Set how many slides are scrolled per swipe.', 'ova-framework' ),
					'default' => '1',
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label' => __( 'Pause on Hover', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ova-framework' ),
						'no' => __( 'No', 'ova-framework' ),
					],
					'frontend_available' => true,
				]
			);


			$this->add_control(
				'infinite',
				[
					'label' => __( 'Infinite Loop', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ova-framework' ),
						'no' => __( 'No', 'ova-framework' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label' => __( 'Autoplay', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ova-framework' ),
						'no' => __( 'No', 'ova-framework' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label' => __( 'Autoplay Speed', 'ova-framework' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 3000,
					'step' => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
					'condition' => [
						'autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => __( 'Smart Speed', 'ova-framework' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'nav_prev',
				[
					'label' => __( 'Prev Navigation', 'ova-framework' ),
					'type'  => Controls_Manager::MEDIA,
				]
			);

			$this->add_control(
				'nav_next',
				[
					'label' => __( 'Next Navigation', 'ova-framework' ),
					'type'  => Controls_Manager::MEDIA,
				]
			);

			$this->add_control(
				'color_dot',
				[
					'label' => __( 'Color Dot', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-slider .owl-carousel .owl-dots .owl-dot' => 'background-color : {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'color_dot_active',
				[
					'label' => __( 'Color Dot Active', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-slider .owl-carousel .owl-dots .owl-dot.active' => 'background-color : {{VALUE}} !important; border-color: {{VALUE}} !important;',
					],
				]
			);


		$this->end_controls_section();
		#########################    END SECTION ADDITIONAL  VERSION 1  ########################

		}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$tabs_content = $data_options = [];
		$tabs_content = $settings['tabs_content'];

		$data_options['slideBy'] 			= $settings['slides_to_scroll'];
		$data_options['margin'] 			= $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop'] 			 	= $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay'] 			= $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']	= $settings['autoplay_speed'];
		$data_options['smartSpeed']			= $settings['smartspeed'];

		if (!empty($settings['nav_prev']['url'])) {
			$data_options['prev'] = '<img src="'.esc_attr($settings['nav_prev']['url']).'"/>';
		}
		if (!empty($settings['nav_next']['url'])) {
			$data_options['next'] = '<img src="'.esc_attr($settings['nav_next']['url']).'"/>';
		}

		?>

		<div class="ova-slider">
			<div class="list-slider ova-slider-carousel owl-carousel" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
				<?php if (!empty($tabs_content)) : foreach ($tabs_content as $item) : ?>
					<?php $background_image = $item['image']['url'] != "" ? " background-image: url(".$item['image']['url'].")"  : "" ?>
					<div class="slider-item">
						<div class="image-box" style="<?php echo esc_attr($background_image) ?>">
							<div class="content">
								<?php if($item['title'] != '') : ?>
									<h2 class="title second_font"><?php echo esc_html($item['title']) ?></h2>
								<?php endif ?>
								<?php if($item['sub_title']) : ?>
									<h3 class="sub-title"><?php echo esc_html($item['sub_title']) ?></h3>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php endforeach; endif; ?>
			</div>
		</div>

		<?php
	}
}
