<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_icon_landing_page extends Widget_Base {

	public function get_name() {
		return 'ova_icon_landing_page';
	}

	public function get_title() {
		return __( 'Icon Landing Page', 'ova-framework' );
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
				'label' => __( 'Icon Landing Muzze', 'ova-framework' ),
			]
		);
 
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icons Muzze', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => 'ti-mobile',
				]
			);

			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Responsive Retina Ready', 'ova-framework'),
				]
			);


			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('When we hover this area will come. Please change real content here for each items separately.', 'ova-framework'),
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
		<div class="ova-icon-landing-page">
			<div class="wp-icon">
				<div class="icon">
					<i class="<?php echo $settings['icon'] ?>"></i>
				</div>
			</div>
			<div class="content">
				<h3 class="title"><?php echo esc_html($settings['title']) ?></h3>
				<p class="desc"><?php echo esc_html($settings['desc']) ?></p>
			</div>
		</div>
	<?php
	}
}
