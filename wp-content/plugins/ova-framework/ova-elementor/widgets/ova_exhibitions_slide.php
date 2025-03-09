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

class ova_exhibitions_slide extends Widget_Base {

	public function get_name() {
		
		return 'ova_exhibitions_slide';
	}

	public function get_title() {
		return __( 'Exhibitions Slide', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
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

		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

		

		$this->add_control(
			'bg_image',
			[
				'label' => __( 'Background Image', 'ova-framework' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'id_link',
			[
				'label' => __( 'Id Link section', 'ova-framework' ),
				'type'  => Controls_Manager::TEXT,
				'default' => "#ova-link",
			]
		);

		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'sub_title',
			[
				'label' => __( 'sub_title ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'CURRENTLY ONVIEW', 'ova-framework' ),
			]
		);


		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Mark Anderson', 'ova-framework' ),
			]
		);



		$repeater->add_control(
			'date',
			[
				'label' => __( 'Date ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Onview Through 26 May 2019', 'ova-framework' ),
			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => __( 'Content ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Shown for the first time in the United States, this comprehensive collection of ukiyo-e', 'ova-framework' ),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Image ', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => false,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);



		$this->add_control(
			'tabs',
			[
				'label' => __( 'Items', 'ova-framework' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		//END SECTION CONTENT


		/*****************************************************************
				START SECTION ADDITIONAL
				******************************************************************/

				$this->start_controls_section(
					'section_additional_options',
					[
						'label' => __( 'Additional Options', 'ova-framework' ),
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
					'smartspeed',
					[
						'label'   => __( 'Smart Speed', 'ova-framework' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => 500,
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

				$this->add_control(
					'nav_down',
					[
						'label' => __( 'Navigation Down', 'ova-framework' ),
						'type'  => Controls_Manager::MEDIA,
					]
				);

				$this->add_control(
					'heading_animate_sub_title',
					[
						'label' => __( 'Animate Sub Title', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);


				$this->add_control(
					'show_animation_sub_title',
					[
						'label' => __( 'Show Animate', 'ova-framework' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
					]
				);

				$this->add_control(
					'animation_style_sub_title',
					[
						'label' => __( 'Type Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $animation_array,
						'condition' => [
							'show_animation_sub_title' => 'yes',
						],
					]
				);

				$this->add_control(
					'animation_dur_sub_title',
					[
						'label' => __( 'Time Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 2000,
						'condition' => [
							'show_animation_sub_title' => 'yes',
						],
					]
				);

				$this->add_control(
					'heading_animate_title',
					[
						'label' => __( 'Animate Title', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);


				$this->add_control(
					'show_animation_title',
					[
						'label' => __( 'Show Animate', 'ova-framework' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
					]
				);

				$this->add_control(
					'animation_style_title',
					[
						'label' => __( 'Type Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $animation_array,
						'condition' => [
							'show_animation_title' => 'yes',
						],
					]
				);

				$this->add_control(
					'animation_dur_title',
					[
						'label' => __( 'Time Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 2000,
						'condition' => [
							'show_animation_title' => 'yes',
						],
					]
				);

				$this->add_control(
					'heading_animate_date',
					[
						'label' => __( 'Animate Date', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);


				$this->add_control(
					'show_animation_date',
					[
						'label' => __( 'Show Animate', 'ova-framework' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
					]
				);

				$this->add_control(
					'animation_style_date',
					[
						'label' => __( 'Type Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $animation_array,
						'condition' => [
							'show_animation_date' => 'yes',
						],
					]
				);

				$this->add_control(
					'animation_dur_date',
					[
						'label' => __( 'Time Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 2000,
						'condition' => [
							'show_animation_date' => 'yes',
						],
					]
				);


				$this->add_control(
					'heading_animate_content',
					[
						'label' => __( 'Animate Content', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);


				$this->add_control(
					'show_animation_content',
					[
						'label' => __( 'Show Animate', 'ova-framework' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
					]
				);

				$this->add_control(
					'animation_style_content',
					[
						'label' => __( 'Type Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $animation_array,
						'condition' => [
							'show_animation_content' => 'yes',
						],
					]
				);

				$this->add_control(
					'animation_dur_content',
					[
						'label' => __( 'Time Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 2000,
						'condition' => [
							'show_animation_content' => 'yes',
						],
					]
				);

				$this->add_control(
					'heading_animate_image',
					[
						'label' => __( 'Animate Image', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);


				$this->add_control(
					'show_animation_image',
					[
						'label' => __( 'Show Animate', 'ova-framework' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
					]
				);

				$this->add_control(
					'animation_style_image',
					[
						'label' => __( 'Type Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $animation_array,
						'condition' => [
							'show_animation_image' => 'yes',
						],
					]
				);

				$this->add_control(
					'animation_dur_image',
					[
						'label' => __( 'Time Animation', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'default' => 2000,
						'condition' => [
							'show_animation_image' => 'yes',
						],
					]
				);


				$this->end_controls_section();
		#########################    END SECTION ADDITIONAL  #########################

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

		$data_animate_sub_title = $data_animate_class_sub_title = $data_animate_title = $data_animate_class_title = $data_animate_date = $data_animate_class_date = $data_animate_content = $data_animate_class_content = $data_animate_image = $data_animate_class_image = "";

		if ($settings['show_animation_sub_title'] === 'yes') {
			$data_animate_sub_title = "data-animation='" . $settings['animation_style_sub_title'] . "' data-animation_dur='".$settings['animation_dur_sub_title']."' style='animation-duration: ".$settings['animation_dur_sub_title']."ms; opacity: 1;'";
			$data_animate_class_sub_title = "animated elementor-slide-sub-title-2 " . $settings['animation_style_sub_title'];
		}
		
		if ($settings['show_animation_title'] === 'yes') {
			$data_animate_title = "data-animation='" . $settings['animation_style_title'] . "' data-animation_dur='".$settings['animation_dur_title']."' style='animation-duration: ".$settings['animation_dur_title']."ms; opacity: 1;'";
			$data_animate_class_title = "animated elementor-slide-title " . $settings['animation_style_title'];
		}
		

		if ($settings['show_animation_date'] === 'yes') {
			$data_animate_date = "data-animation='" . $settings['animation_style_date'] . "' data-animation_dur='".$settings['animation_dur_date']."' style='animation-duration: ".$settings['animation_dur_date']."ms; opacity: 1;'";
			$data_animate_class_date = "animated elementor-slide-subtitle " . $settings['animation_style_date'];
		}

		

		if ($settings['show_animation_content'] === 'yes') {
			$data_animate_content = "data-animation='" . $settings['animation_style_content'] . "' data-animation_dur='".$settings['animation_dur_content']."' style='animation-duration: ".$settings['animation_dur_content']."ms; opacity: 1;'";
			$data_animate_class_content = "animated elementor-slide-description " . $settings['animation_style_content'];
		}

		

		if ($settings['show_animation_image'] === 'yes') {
			$data_animate_image = "data-animation='" . $settings['animation_style_image'] . "' data-animation_dur='".$settings['animation_dur_image']."' ";
			$data_animate_class_image = "animated elementor-slide-button " . $settings['animation_style_image'];
		}
		

		$tabs = $settings['tabs'];

		$background_nav_down = $settings['nav_down']['url'];
		$background_nav_down = "background-image:url(".$background_nav_down.")";


		$data_options['rtl'] 			= false;
		$data_options['nav'] 			= true;
		$data_options['items'] 			= 1;
		$data_options['slideBy'] 			= $settings['slides_to_scroll'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop'] 			 	= $settings['infinite'] === 'yes' ? true : false;
		
		$data_options['autoplay'] 			= ($settings['autoplay'] === 'yes') ? true : false;
		$data_options['autoplayTimeout']	= $data_options['autoplay'] ? $settings['autoplay_speed'] : 999999999;

		$data_options['smartSpeed']			= $settings['smartspeed'] ;
		$data_options['navText'] 			=[
			'<i class="arrow_carrot-left"></i>',
			'<i class="arrow_carrot-right"></i>'
		];

		$background_image = '';
		if ($settings['bg_image']['url'] !== "") {
			$background_image = "background-image: url(".$settings['bg_image']['url'].")";
		}

		?>

		<div class="ova-exhibitions-slide">
			<div class="list-exhibitions owl-carousel owl-exhibitions elementor-slides owl-carousel owl-theme owl-loaded"  data-owl_carousel="<?php echo esc_attr(json_encode($data_options)) ?>">
				<?php
				if (!empty($tabs)) : foreach ($tabs as $item) : 
					
					$background_img = $item['image']['url'] !== "" ? "background-image: url(".$item['image']['url'].")" : "";

					$target 	= $item['link']['is_external'] ? ' target="_blank"' : '';
					$nofollow 	= $item['link']['nofollow'] ? ' rel="nofollow"' : '';

					?>
					<article class="item-exhibition " >
						<div class="content">
							<h3 <?php echo $data_animate_sub_title ?> class="sub-title <?php echo $data_animate_class_sub_title ?>"><?php echo esc_html($item['sub_title']) ?></h3>
							<h2 <?php echo $data_animate_title ?> class=" title <?php echo $data_animate_class_title ?>">
								<a class="second_font" href="<?php echo esc_attr($item['link']['url']) ?>"<?php echo $target.$nofollow; ?>>
									<?php echo esc_html($item['title']) ?>
								</a>
							</h2>
							<?php if ($item['date'] != "") : ?>
								<div <?php echo $data_animate_date ?> class="date <?php echo $data_animate_class_date ?>">
									<p><?php echo esc_html($item['date']) ?></p>
								</div>
							<?php endif ?>
							<div <?php echo $data_animate_content ?> class="excerpt <?php echo $data_animate_class_content ?>">
								<p><?php echo $item['content']; ?></p>
							</div>
						</div>
						<div class="media" style='<?php echo esc_attr($background_image); ?>'>
							<a <?php echo $data_animate_image; ?> class="image-box <?php echo $data_animate_class_image; ?>" href="<?php echo esc_attr($item['link']['url']); ?>" style="animation-duration: <?php echo $settings['animation_dur_image']; ?>ms; opacity: 1;<?php echo esc_attr($background_img); ?>"<?php echo $target.$nofollow; ?>>
								<img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
							</a>
						</div>

					</article>
				<?php endforeach; endif; ?>

			</div>
			<!-- end list-exhibitions -->
			<div class="wp-button-scroll">
				<a class="button-scroll" href="<?php echo esc_attr($settings['id_link']) ?>" style="<?php echo esc_attr($background_nav_down) ?>">
					
				</a>
			</div>
		</div>
		<!-- end ova-exhibitions-slide -->
		
		<?php
	}
}
