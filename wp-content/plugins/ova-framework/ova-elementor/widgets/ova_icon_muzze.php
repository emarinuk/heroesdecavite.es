<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_icon_muzze extends Widget_Base {

	public function get_name() {
		return 'ova_icon_muzze';
	}

	public function get_title() {
		return __( 'Icon Muzze', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-social-icons';
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
				'label' => __( 'Icon Muzze', 'ova-framework' ),
			]
		);
 
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icons Muzze', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'flaticon-circus-tent',
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
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);


			$this->add_control(
				'color_icon',
				[
					'label' => __( 'Color Icon', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} i:before' => 'color : {{VALUE}};',
					],
				]
			);


			$this->add_control(
				'font_size_icon',
				[
					'label' => __( 'Font Size Icon', 'ova-framework' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 150,
						],
					],
					'selectors' => [
						'{{WRAPPER}} i:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);


			$this->add_responsive_control(
				'margin_icon',
				[
					'label' => __( 'Margin', 'ova-framework' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_icon',
				[
					'label' => __( 'Padding', 'ova-framework' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		// end tab section_content

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon = "";
		$icon = $settings['icon'];
	?>
		<div class="ova-icon-muzze">
			<i class="<?php echo $icon ?>"></i>
		</div>
	<?php
	}
}
