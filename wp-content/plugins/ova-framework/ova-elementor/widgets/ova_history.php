<?php

namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_history extends Widget_Base {

	public function get_name() {
		return 'ova_history';
	}

	public function get_title() {
		return __( 'Ova History', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-history';
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

				

			$repeater = new Repeater();

			$repeater->add_control(
				'tab_year_about',
				[
					'label' => __( 'Year About', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('2000 - 2009', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'tab_content',
				[
					'label' => __( 'Content', 'ova-framework' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => __('Boursin smelly cheese emmental. Fromage who moved my cheese airedale blue castello everyone loves pecorino rubber cheese roquefort. Cheese and biscuits swiss fromage cheese and wine halloumi brie.', 'ova-framework'),
				]
			);

			$this->add_control(
				'tabs_history',
				[
					'label' => __( 'History Items', 'elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ tab_year_about }}}',
				]
			);


		$this->end_controls_section();

		//SECTION TAB STYLE YEAR ABOUT
		$this->start_controls_section(
			'section_year_about',
			[
				'label' => __( 'Year About', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'about_typography',
				'selector' => '{{WRAPPER}} .ova-history .item-history .year-about h3.title',
			]
		);

		$this->add_control(
			'color_about',
			[
				'label' => __( 'Color Year About', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-history .item-history .year-about h3.title' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE YEAR ABOUT

		//SECTION TAB STYLE CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ova-history .item-history .year-about h3.title',
			]
		);

		$this->add_control(
			'color_content',
			[
				'label' => __( 'Color Content', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-history .item-history .content p' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE CONTENT
		
		
	}

	protected function render() {
		$settings = $this->get_settings();
		$tabs_history = $settings['tabs_history'];
		?>
		<div class="ova-history">
			<?php if ( ! empty($tabs_history)) : foreach ($tabs_history as $index => $item) : ?>
				<div class="item-history">
					<div class="year-about">
						<h3 class="title"><?php echo esc_html($item['tab_year_about']) ?></h3>
					</div>
					<div class="content">
						<p><?php echo esc_html($item['tab_content']) ?></p>
					</div>
				</div>

			<?php endforeach; endif; ?>
		</div>
		
		<?php
	}
	// end render
}


