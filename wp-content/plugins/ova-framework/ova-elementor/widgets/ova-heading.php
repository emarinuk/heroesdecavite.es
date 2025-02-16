<?php

namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_heading extends Widget_Base {

	public function get_name() {
		return 'ova_heading';
	}

	public function get_title() {
		return __( 'Ova Heading', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-heading';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {


		/**********************************************
					CONTENT SECTION
		**********************************************/
		$this->start_controls_section(
			'section_heading_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

				

				$this->add_responsive_control(
					'align',
					[
						'label' => __( 'Alignment', 'ova-framework' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
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
							'{{WRAPPER}} .ova_heading' => 'text-align: {{VALUE}}',
						]
					]
				);

				$this->add_control(
					'title',
					[
						'label' => __( 'Heading Title', 'ova-framework' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Heading Title',
					]
				);

				$this->add_control(
					'sub_title',
					[
						'label' => __( 'Sub Title', 'ova-framework' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => 'The Art & History Museum in addition to significant support from 
its Board of Trustees, receives contributions from many dedicated 
Sponsers and Partners. ',
					]
				);


		$this->end_controls_section();


		//section style title
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova_heading h1.heading_title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => __( 'Color Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_heading h1.heading_title' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		//section style sub title
		$this->start_controls_section(
			'section_sub_title',
			[
				'label' => __( 'Sub Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'sub_title_typography',
					'selector' => '{{WRAPPER}} .ova_heading h2.sub_title',
				]
			);

			$this->add_control(
				'color_sub_title',
				[
					'label' => __( 'Color Sub Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_heading h2.sub_title' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		
		
	}

	protected function render() {
		$settings = $this->get_settings();

		$title = $settings['title'];
		$sub_title = $settings['sub_title'];
		?>
		<div class="ova_heading">
			<?php if (!empty($title)) : ?>
				<h1 class="heading_title second_font"><?php echo esc_html($title) ?></h1>
			<?php endif ?>
			<?php if (!empty($sub_title)) : ?>
				<h2 class="sub_title second_font"><?php echo esc_html($sub_title) ?></h2>
			<?php endif ?>
		</div>
		<?php
		
	}
	// end render
}


