<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_circle_text extends Widget_Base {

	public function get_name() {
		return 'ova_circle_text';
	}

	public function get_title() {
		return __( 'Circle Text', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-circle-o';
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
				'label' => __( 'Circle Text', 'ova-framework' ),
			]
		);
 
			$this->add_control(
				'text',
				[
					'label' => __( 'Text', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'EST',
				]
			);

			$this->add_control(
				'number',
				[
					'label' => __( 'Number', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '1965',
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

		$this->end_controls_section();

		// end tab section_content

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
		<div class="ova-circle-text">
			<span class="circle-text">
				<span class="text"><?php echo esc_html($settings['text']) ?></span>
				<span class="number"><?php echo esc_html($settings['number']) ?></span>
			</span>
		</div>
	<?php
	}
}