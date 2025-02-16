<?php
namespace ova_framework\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_instagram extends Widget_Base {

	public function get_name() {
		return 'ova_instagram';
	}

	public function get_title() {
		return __( 'Instagram', 'ova-framework' );
	}

	public function get_icon() {
		return ' fa fab fa-instagram';
	}

	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'script-elementor' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

		$this->add_control(
			'token',
			[
				'label' => __( 'Token', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'How to Get Instagram Access Token <a href="https://www.instagram.com/developer/authentication/" target="_blank" rel="nofollow">Click Here</a>'
			]
		);

		$this->add_control(
			'hashtag',
			[
				'label' => __( 'Hashtag', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		

		

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 30,
				'default' => 500,
			]
		);

		$this->add_control(
			'number_photo',
			[
				'label' => __( 'Number Photos', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'default' => 15,
			]
		);

		$this->add_control(
			'overlay',
			[
				'label' => __( 'Overlay Color', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .instagram .overlay' => 'background: {{VALUE}}',
				],
				'default' => 'rgba(0,0,0,0.7)',
			]
		);

		

		$this->add_control(
			'show_follow',
			[
				'label' => __( 'Show Follow', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'follow_style',
			[
				'label' => __( 'Follow', 'ova-framework' ),
				'tab' => \Elementor\Controls_Manager::HEADING,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'follow_version',
			[
				'label' => _x( 'Follow', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => _x( 'Version 1', 'ova-framework' ),
					'version_2' => _x( 'Version 2', 'ova-framework' ),
				],
			]
		);

		$this->add_control(
			'icon_follow_style',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Icon', 'elementor-pro' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_icon',
			[
				'label' => __( 'Social Icons', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fa fa-instagram',
			]
		);

		$this->add_control(
			'icon_follow_size',
			[
				'label' => __( 'Icon Size', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .follow .icon_follow' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_follow_color',
			[
				'label'  => __( 'Icon Color', 'ova-framework' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .follow .icon_follow' => 'color: {{VALUE}}',
				],
				'default' => '#b9a271',
			]
		);

		$this->add_responsive_control(
			'icon_follow_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Title', 'ova-framework' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Text', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Follow', 'ova-framework' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'ova-framework' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .follow .title' => 'color: {{VALUE}}',
				],
				'default' => '#020202',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .follow .title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'description_style',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Description', 'ova-framework' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Text', 'ova-framework' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'on instagrams', 'ova-framework' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Color', 'ova-framework' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .follow .description' => 'color: {{VALUE}}',
				],
				'default' => '#bfbfbf',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .follow .description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'content_follow_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slide',
			[
				'label' => __( 'Slide', 'ova-framework' ),
				'tab' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'show_nav',
			[
				'label' => __( 'Show Nav', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' => __( 'Items', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'item_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed (ms)', 'ova-framework' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'lazy_load',
			[
				'label' => __( 'Lazy Load', 'ova-framework' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$html = '';

		// Slide
		
		$instagram_slide = [
			'autoplayTimeout'    => absint( $settings['autoplay_speed'] ),
			'margin'             => absint( $settings['item_margin'] ),
			'autoplay'           => ( 'yes' === $settings['autoplay'] ),
			'loop'               => ( 'yes' === $settings['loop'] ),
			'autoplayHoverPause' => ( 'yes' === $settings['pause_on_hover'] ),
			'lazyLoad'           => ( 'yes' === $settings['lazy_load'] ),
			'nav'                => ( 'yes' === $settings['show_nav'] ),
			'navText'            => [
				'<i class="fa fa-angle-left" aria-hidden="true"></i>',
				'<i class="fa fa-angle-right" aria-hidden="true"></i>'
			],
			'dots' => false,
			'smartSpeed' => 1000,
			'responsive' => [
				'0' => [
					'items' => absint(1),
				],
				'900' => [
					'items' => absint(3),
				],
				'1200' => [
					'items' => absint( $settings['items'] ),
				]
			]
		];
		
		$this->add_render_attribute( 'slide', [
			'data-instagram_slide' => wp_json_encode( $instagram_slide),
		] );

		// Get Token Instagram
		$access_token = $settings['token'];

		$hashtag = $settings['hashtag'];
		
		$i =0;
		?>
		<?php if ($access_token != '') {

			// Get Data Instagram
			$number_photo  = absint( $settings['number_photo'] );

			
			$json_link    = "https://graph.instagram.com/me/media?fields=username,caption,media_url&access_token={$access_token}";
			
			$args = array(
				'timeout' => 60,
				'sslverify' => false
			);

			$result = wp_remote_get( $json_link, $args );

			

			if( is_array( $result ) && ! is_wp_error( $result ) ) {

				$obj = json_decode( str_replace( '%22', '&rdquo;', $result['body'] ), true );

				$user_name    = isset( $obj['data']['0']['username'] ) ? $obj['data']['0']['username'] : '' ;

			?>

				<div class="instagram">

					<?php if( $settings['show_follow'] == 'yes') { ?>
						<div class="follow <?php echo esc_attr($settings['follow_version']) ?>">
							<a href="//instagram.com/<?php echo esc_attr($user_name) ?>">
								<i class="<?php echo esc_attr($settings['text_icon']) ?> icon_follow text-center"></i>
								<div class="title second_font text-center"><?php echo esc_html($settings['title']) ?></div>
								<div class="description text-center"><?php echo esc_html($settings['description']) ?></div>
							</a>
						</div>
					<?php } ?>

					<div class="slide owl-carousel owl-theme" <?php echo $this->get_render_attribute_string( 'slide' ) ?> >
						<?php 
						if( isset($obj['data']) && $obj['data'] ){
							foreach ($obj['data'] as $post){ 

								if( $i == $number_photo ) break;

								$pic_text          = isset( $post['caption'] ) ? $post['caption'] : '';
								$pic_link          = $post['media_url'];
								$pic_src           = $post['media_url'];

								

								if ( $hashtag != '') {
									
								?>
									<?php if( strpos($pic_text, $hashtag) !== false ){ ?>
									<div class="item" >
										<div class="image" style="background-image: url('<?php echo esc_attr($pic_src) ?>'); height: <?php echo esc_attr( $settings['height'] ).'px' ?>"></div>
										<div class="overlay" >
											<a href="<?php echo esc_attr($pic_link) ?>" target="_blank"><i class="linkToIns fab fa-instagram" ></i></a>
										</div>
									</div>

									<?php $i++; } ?>
								
								<?php }else{ ?>

									<div class="item" >
										<div class="image" style="background-image: url('<?php echo esc_attr($pic_src) ?>'); height: <?php echo esc_attr( $settings['height'] ).'px' ?>"></div>
										<div class="overlay" >
											<a href="<?php echo esc_attr($pic_link) ?>" target="_blank"><i class="linkToIns fab fa-instagram" ></i></a>
										</div>
									</div>

								<?php $i++; }
							}
						} ?>
					</div>
				</div>
		<?php } } ?>
		<?php
	}
}
