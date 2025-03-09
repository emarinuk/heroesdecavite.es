<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_open_contact extends Widget_Base {

	public function get_name() {
		return 'ova_open_contact';
	}

	public function get_title() {
		return __( 'Open And Contact', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-address-book-o';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Artist', 'ova-framework' ),
			]
		);

			$this->add_responsive_control(
				'width',
				[
					'label' => __( 'Width', 'ova-framework' ),
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
					'selectors' => [
						'{{WRAPPER}} .ova-open-contact' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
 
			$this->add_control(
				'title_open',
				[
					'label' => __( 'Title Open', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Opening Hours', 'ova-framework'),
				]
			);

			$this->add_control(
				'sub_title_1_open',
				[
					'label' => __( 'Sub Title 1', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Open Daily 10am–5pm', 'ova-framework'),
				]
			);

			$this->add_control(
				'sub_title_2_open',
				[
					'label' => __( 'Sub Title 2', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Sunday Until 8pm.', 'ova-framework'),
				]
			);



			$this->add_control(
				'title_contact',
				[
					'label' => __( 'Title Contact', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Contact Info', 'ova-framework'),
				]
			);

			$this->add_control(
				'sub_title_1_contact',
				[
					'label' => __( 'Sub Title 1', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('22720 EL Camino Real', 'ova-framework'),
				]
			);

			$this->add_control(
				'sub_title_2_contact',
				[
					'label' => __( 'Sub Title 2', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Santa Margarita, NY 93453', 'ova-framework'),
				]
			);



			$this->add_control(
				'phone',
				[
					'label' => __( 'Phone', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('1 (617) 987-6543', 'ova-framework'),
				]
			);

			$this->add_control(
				'email',
				[
					'label' => __( 'Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('museum@example.org', 'ova-framework'),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
							'title' => __( 'Left', 'elementor' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'elementor' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'elementor' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'left',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_color',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-open-contact' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
		<div class="ova-open-contact">
			<div class="open">
				<h2 class="title-open second_font"><?php echo esc_html($settings['title_open']) ?></h2>
				<p class="sub-title-1-open"><?php echo esc_html($settings['sub_title_1_open']) ?></p>
				<p class="sub-title-2-open"><?php echo esc_html($settings['sub_title_2_open']) ?></p>
			</div>
			
			<div class="contact">
				<h2 class="title-contact second_font"><?php echo esc_html($settings['title_contact']) ?></h2>
				<p class="sub-title-1-contact"><?php echo esc_html($settings['sub_title_1_contact']) ?></p>
				<p class="sub-title-2-contact"><?php echo esc_html($settings['sub_title_2_contact']) ?></p>
			</div>
			<p class="phone"><?php echo esc_html($settings['phone']) ?></p>
			<p class="email"><?php echo esc_html($settings['email']) ?></p>
		</div>
	<?php
	}
}
