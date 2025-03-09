<?php
namespace ova_framework\Widgets;
use Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class ova_menu_page extends Widget_Base {

	public function get_name() {
		return 'ova_menu_page';
	}

	public function get_title() {
		return __( 'Menu Page', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_keywords() {
		return [ 'menu', 'foter' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'ova-framework' ),
			]
		);


		$menus = \wp_get_nav_menus();
		$list_menu = array();
		foreach ($menus as $menu) {
			$list_menu[$menu->slug] = $menu->name;
		}

		$this->add_control(
			'menu_slug',
			[
				'label' => __( 'Select Menu', 'ova-framework' ),
				'type' => Controls_Manager::SELECT,
				'options' => $list_menu,
				'default' => '',
			]
		);

		$this->add_control(
			'heading_style',
			[
				'label' => __( 'Style', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typo_menu',
				'selector' => '{{WRAPPER}} .ova_menu_page .menu li',
			]
		);

		$this->add_responsive_control(
			'padding_menu',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_page .menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_menu',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_page .menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'color_menu',
			[
				'label' => __( 'Color Text', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_page .menu li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'color_menu_hover',
			[
				'label' => __( 'Hover', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_page .menu li:hover a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'color_line',
			[
				'label' => __( 'Color Line', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_page .menu li:before' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		?>
		<div class="ova_menu_page">
			<?php
			wp_nav_menu( array(
				'menu'              => $settings['menu_slug'],
				'depth'             => 3,
				'container'         => '',
				'container_class'   => '',
				'container_id'      => '',
			));
			?>
		</div>
		<?php 
	}
}