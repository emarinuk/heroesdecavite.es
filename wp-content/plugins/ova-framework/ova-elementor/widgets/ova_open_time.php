<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_open_time extends Widget_Base {

	public function get_name() {
		return 'ova_open_time';
	}

	public function get_title() {
		return __( 'Open Time', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-hourglass-o';
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
						'{{WRAPPER}} .ova-open-time' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'row' => 2,
					'default' => __('Open Time', 'ova-framework'),
				]
			);

			$this->add_control(
				'time',
				[
					'label' => __( 'Time', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Daily: 10 a.m. – 5 p.m. ', 'ova-framework'),
				]
			);

			$this->add_control(
				'orther',
				[
					'label' => __( 'Other', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Monday & Holidays: Closed', 'ova-framework'),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'show_external' => false,
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Plan Your Visit', 'ova-framework'),
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
						'{{WRAPPER}}' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();

		$target 	= $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow 	= $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
	?>
		<div class="ova-open-time">
			<div class="content">
				<?php if ($settings['title'] != "") : ?>
				<h2 class="title"><?php echo esc_html($settings['title']); ?></h2>
				<?php endif ?>
				<?php if($settings['time'] != "") : ?>
					<p class="time"><?php echo esc_html($settings['time']); ?></p>
				<?php endif ?>
				<?php if($settings['orther'] != "") : ?>
					<p class="orther"><?php echo esc_html($settings['orther']); ?></p>
				<?php endif ?>
			</div>
			<div class="text-button">
				<?php if($settings['text_button']) : ?>
					<a href="<?php echo esc_attr($settings['link']['url']); ?>"<?php echo $target.$nofollow; ?>>
						<?php echo esc_html($settings['text_button']); ?>
					</a>
				<?php endif ?>
			</div>
		</div>
	<?php
	}
}
