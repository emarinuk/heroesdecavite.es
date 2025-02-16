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
class ova_testimonial extends Widget_Base {

	public function get_name() {
		return 'ova_testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
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

		$this->start_controls_section(
			'section_version',
			[
				'label' => __( 'Version Testimonial' , 'ova-framework'),
			]
		);
		$this->add_control(
			'version_testimonial',
			[
				'label' => __( 'Choose Version Testimonial', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'testimonial_version_1',
				'options' => [
					'testimonial_version_1' => __( 'Testimonial Version 1', 'ova-framework' ),
					'testimonial_version_2' => __( 'Testimonial Version 2', 'ova-framework' ),
				],
			]
		);

		$this->end_controls_section();


		/*************************************************************************************************
		SECTION VERSION TESTIMONIAL 1
		*************************************************************************************************/

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
				'condition' => [
					'version_testimonial' => 'testimonial_version_1',
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'What Our Visitors Saying', 'ova-framework' ),
				'row' => 2,
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label' => __( 'Icon Background ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'icon_quotations', 'ova-framework' ),
				'placeholder' => __( 'Class Font Elegant', 'ova-framework' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		

		$repeater->add_control(
			'author',
			[
				'label' => __( 'Author ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Mark Anderson', 'ova-framework' ),
			]
		);

		

		$repeater->add_control(
			'content',
			[
				'label' => __( 'Content ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( '“Designing is a matter of concentration. You go deep into what you want to do. It’s about intensive research, really. The concentration is warm and intimate and like the fire inside the earth.”', 'ova-framework' ),
				'row' => 2,
			]
		);


		$this->add_control(
			'tabs_testimonial',
			[
				'label' => __( 'Items Testimonial', 'ova-framework' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ author }}}',
			]
		);

		$this->end_controls_section();

############################ END SECTION VERSIONTION TESTIMONIAL 1  ##############################



		/*************************************************************************************************
		SECTION VERSION TESTIMONIAL 2
		*************************************************************************************************/

		$this->start_controls_section(
			'section_content_v2',
			[
				'label' => __( 'Content', 'ova-framework' ),
				'condition' => [
					'version_testimonial' => 'testimonial_version_2',
				],
			]
		);



		$repeater_v_2 = new \Elementor\Repeater();

		$repeater_v_2->add_control(
			'icon_background_v_2',
			[
				'label' => __( 'Icon Background ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'icon_quotations', 'ova-framework' ),
				'placeholder' => __( 'Class Font Elegant', 'ova-framework' ),
				'row' => 2,
			]
		);

		$repeater_v_2->add_control(
			'author_v_2',
			[
				'label' => __( 'Author ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Mark Anderson', 'ova-framework' ),
			]
		);

		$repeater_v_2->add_control(
			'image_author',
			[
				'label' => __( 'Image Author', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater_v_2->add_control(
			'job_v_2',
			[
				'label' => __( 'Job', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Visitors', 'ova-framework' ),
			]
		);

		$repeater_v_2->add_control(
			'num_star',
			[
				'label' => __( 'Number Star', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				],
			]
		);


		$repeater_v_2->add_control(
			'content_v_2',
			[
				'label' => __( 'Content ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( '“Designing is a matter of concentration. You go deep into what you want to do. It’s about intensive research, really. The concentration is warm and intimate and like the fire inside the earth.”', 'ova-framework' ),
				'row' => 2,
			]
		);


		$this->add_control(
			'tabs_testimonial_v_2',
			[
				'label' => __( 'Items Testimonial', 'ova-framework' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_v_2->get_controls(),
			]
		);


		$this->add_control(
			'background_color_box',
			[
				'label' => __( 'Background Color Box', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-testimonial .testimo-ver-2 .testimonial-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		############################ END SECTION VERSIONTION TESTIMONIAL 2  ##############################



		/*****************************************************************
		START SECTION ADDITIONAL VERSIONT 1 TESTIMONIAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'ova-framework' ),
				'condition' => [
					'version_testimonial' => 'testimonial_version_1',
				]
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
					'{{WRAPPER}} .ova-testimonial .testimo-ver-1 .owl-carousel .owl-dots .owl-dot' => 'background-color : {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'color_dot_active',
			[
				'label' => __( 'Color Dot Active', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-testimonial .testimo-ver-1 .owl-carousel .owl-dots .owl-dot.active' => 'background-color : {{VALUE}} !important; border-color: {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_section();
		#########################    END SECTION ADDITIONAL  VERSION 1  #########################



		/*****************************************************************
		START SECTION ADDITIONAL VERSIONT 2 TESTIMONIAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options_v_2',
			[
				'label' => __( 'Additional Options', 'ova-framework' ),
				'condition' => [
					'version_testimonial' => 'testimonial_version_2',
				]
			]
		);

		$this->add_control(
			'margin_items_v_2',
			[
				'label' => __( 'Margin Right Items', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
			]

		);


		$this->add_control(
			'slides_to_scroll_v_2',
			[
				'label' => __( 'Slides to Scroll', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'ova-framework' ),
				'default' => '1',
			]
		);

		$this->add_control(
			'pause_on_hover_v_2',
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
			'infinite_v_2',
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
			'autoplay_v_2',
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
			'autoplay_speed_v_2',
			[
				'label' => __( 'Autoplay Speed', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'step' => 500,
				'frontend_available' => true,
				'condition' => [
					'autoplay_v_2' => 'yes',
				],
			]
		);

		$this->add_control(
			'smartspeed_v_2',
			[
				'label'   => __( 'Smart Speed', 'ova-framework' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'nav_prev_v_2',
			[
				'label' => __( 'Prev Navigation', 'ova-framework' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'nav_next_v_2',
			[
				'label' => __( 'Next Navigation', 'ova-framework' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'color_dot_ver_2',
			[
				'label' => __( 'Color Dot', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-testimonial .testimo-ver-2 .owl-carousel .owl-dots .owl-dot' => 'background-color : {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'color_dot_active_ver_2',
			[
				'label' => __( 'Color Dot Active', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-testimonial .testimo-ver-2 .owl-carousel .owl-dots .owl-dot.active' => 'background-color : {{VALUE}} !important; border-color: {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_section();
		#########################    END SECTION ADDITIONAL  VERSION 2  #########################

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
		$version_testimonial = $settings['version_testimonial'];

		$tabs_testimonial = $data_options = [];
		if ($version_testimonial == 'testimonial_version_1') {
			$tabs_testimonial = $settings['tabs_testimonial'];

			$data_options['slideBy'] 			= $settings['slides_to_scroll'];
			$data_options['margin'] 			= $settings['margin_items'];
			$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
			$data_options['loop'] 			 	= $settings['infinite'] === 'yes' ? true : false;
			$data_options['autoplay'] 			= $settings['autoplay'] === 'yes' ? true : false;
			$data_options['autoplayTimeout']	= $data_options['autoplay'] ? $settings['autoplay_speed'] : 3000;
			$data_options['smartSpeed']			= $settings['smartspeed'];

			if (!empty($settings['nav_prev']['url'])) {
				$data_options['prev'] = '<img src="'.esc_attr($settings['nav_prev']['url']).'"/>';
			}
			if (!empty($settings['nav_next']['url'])) {
				$data_options['next'] = '<img src="'.esc_attr($settings['nav_next']['url']).'"/>';
			}
		}

		if ($version_testimonial == 'testimonial_version_2') {
			$tabs_testimonial = $settings['tabs_testimonial_v_2'];

			$data_options['slideBy'] 			= $settings['slides_to_scroll_v_2'];
			$data_options['margin'] 			= $settings['margin_items_v_2'];
			$data_options['autoplayHoverPause'] = $settings['pause_on_hover_v_2'] === 'yes' ? true : false;
			$data_options['loop'] 			 	= $settings['infinite_v_2'] === 'yes' ? true : false;
			$data_options['autoplay'] 			= $settings['autoplay_v_2'] === 'yes' ? true : false;
			$data_options['autoplayTimeout']	= $data_options['autoplay'] ? $settings['autoplay_speed_v_2'] : 3000;
			$data_options['smartSpeed']			= $settings['smartspeed_v_2'];

			if (!empty($settings['nav_prev_v_2']['url'])) {
				$data_options['prev'] = '<img src="'.esc_attr($settings['nav_prev_v_2']['url']).'"/>';
			}
			if (!empty($settings['nav_next_v_2']['url'])) {
				$data_options['next'] = '<img src="'.esc_attr($settings['nav_next_v_2']['url']).'"/>';
			}
		}

		

		?>

		<div class="ova-testimonial">
			<?php if ($version_testimonial != "testimonial_version_2") : ?>
				<div class="testimo-ver-1">
					<div class="title-testimo">
						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<h3 class="title second_font"><?php echo esc_html($settings['title'])  ?></h3>
							<span class="text-background <?php echo esc_html($settings['icon_background']) ?>"></span>
						<?php endif ?>
					</div>
					<div class="list-testimonial testimonial-slider-ver-1 owl-carousel" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
						<?php if (!empty($tabs_testimonial)) : foreach ($tabs_testimonial as $item_testimonial) : ?>
							<div class="testimonial-item">
								
								<div class="content-testimo">
									<?php echo $item_testimonial['content'] ?>
								</div>
								<div class="author-testimo">
									<h3 class="author"><?php echo esc_html($item_testimonial['author']) ?></h3>
								</div>
							</div>
						<?php endforeach; endif; ?>
					</div>
				</div>
			<?php endif ?>

			<?php if ($version_testimonial == "testimonial_version_2") : ?>
				<div class="testimo-ver-2">
					<div class="list-testimonial testimonial-slider-ver-2 owl-carousel" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
						<?php if (!empty($tabs_testimonial)) : foreach ($tabs_testimonial as $item_testimonial) : ?>
							<div class="testimonial-item">
								
								<div class="icon-background">
									<?php if ( ! empty( $item_testimonial['icon_background_v_2'] ) ) : ?>
										<span class="text-background <?php echo esc_html($item_testimonial['icon_background_v_2']) ?>"></span>
									<?php endif ?>
								</div>
								<div class="wp-content">
									<div class="content-testimo">
										<?php echo $item_testimonial['content_v_2'] ?>
									</div>
									<div class="author-testimo">
										<div class="img-author">
											<img class="owl-lazy" data-src="<?php echo esc_attr($item_testimonial['image_author']['url']) ?>" src="<?php echo esc_attr($item_testimonial['image_author']['url']) ?>" alt="">
										</div>
										<div class="author">
											<div class="name">
												<span class="author-name second_font"><?php echo esc_html($item_testimonial['author_v_2']) ?></span>
												<span class="separator"><?php echo __('-', 'ova-framework') ?></span>
												<span class="visitior"><?php echo esc_html($item_testimonial['job_v_2']) ?></span>
											</div>
											<div class="num-star">
												<?php if($item_testimonial['num_star'] > 0) : for ($i=1; $i<=$item_testimonial['num_star']; $i++) : ?>
													<i class="fa fa-star"></i>
												<?php endfor; endif;?>

												<?php if((5 - $item_testimonial['num_star']) > 0) : for ($i=1; $i<=(5 - $item_testimonial['num_star']); $i++) : ?>
													<i class="fa fa-star-o"></i>
												<?php endfor; endif;?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; endif; ?>
					</div>
				</div>
			<?php endif ?>
		</div>

		<?php
	}
}

