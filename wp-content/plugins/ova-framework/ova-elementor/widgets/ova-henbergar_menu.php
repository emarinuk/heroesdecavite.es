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

class henbergar_menu extends Widget_Base {

	public function get_name() {
		return 'henbergar_menu';
	}

	public function get_title() {
		return __( 'Henbergar Menu', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fas fa-bars';
	}

	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {


		/* Global Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_menu_type',
			[
				'label' => __( 'Choose Menu', 'ova-framework' ),
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
				'prefix_class' => 'elementor-view-',
			]
		);

		$this->end_controls_section();	


		/* Parent Menu Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Parent Menu', 'ova-framework' ),
			]
		);



		$this->add_responsive_control(
			'padding_menu',
			[
				'label' => __( 'Padding Menu', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_menu_item',
			[
				'label' => __( 'Padding Menu Items', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'menu_alignment',
			[
				'label' => __( 'Alignment', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ova-framework' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-end',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu' => 'justify-content: {{VALUE}}; align-items: {{VALUE}}'
				]

			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li > button > i' => 'color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Text Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li > a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li > button:hover > i' => 'color: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'text_color_active',
			[
				'label' => __( 'Text Color Active', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li.active > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ova_nav_canvas ul.menu > li.active > button > i' => 'color: {{VALUE}};',
				]

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector'	=> '{{WRAPPER}} .ova_nav_canvas ul.menu > li > a, {{WRAPPER}} .ova_nav_canvas ul.menu > li > button > i'
			]
		);

		$this->end_controls_section();


		/* Sub Menu Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_submenu_content',
			[
				'label' => __( 'Sub Menu', 'ova-framework' ),
			]
		);

		$this->add_control(
			'submenu_min_width',
			[
				'label' => __( 'Width', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					],
					'rem' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => 13,
				],
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas .dropdown-menu' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'sub_menu_dir',
			[
				'label' => __( 'Menu Direction', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'sub_menu_dir_left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-h-align-left',
					],
					'sub_menu_dir_right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'sub_menu_dir_left'
			]
		);

		$this->add_responsive_control(
			'padding_sub_menu',
			[
				'label' => __( 'Padding Menu', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_sub_menu_item',
			[
				'label' => __( 'Padding Menu Item', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top' => '5',
					'right' => '15',
					'bottom' => '5',
					'left' => '15',
					'isLinked' => true,
				]
			]
		);


		$this->add_control(
			'submenu_bg_color',
			[
				'label' => __( 'Background Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before'

			]
		);

		$this->add_control(
			'submenu_text_color',
			[
				'label' => __( 'Text Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li > button > i' => 'color: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'submenu_text_color_hover',
			[
				'label' => __( 'Text Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li > a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li > button:hover > i' => 'color: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'submenu_text_color_active',
			[
				'label' => __( 'Text Color Active', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li.active > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li.active > button > i' => 'color: {{VALUE}};',
				]

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'submenu_typography',
				'selector'	=> '{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li a, {{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li button i',
			]
		);


		$this->add_control(
			'border_submenu',
			[
				'label' => __( 'Border Menu', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'submenu_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu',

			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		$this->add_control(
			'border_submenu_item',
			[
				'label' => __( 'Border Menu Item', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'submenu_border_item',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li',

			]
		);

		$this->add_control(
			'label_submenu_latest_item',
			[
				'label' => __( 'Border Menu Latest Item', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'submenu_border_latest_item',
				'label' => __( 'Border Sub-Menu Latest Item', 'ova-framework' ),
				'placeholder' => '0px',
				'default' => '0px',
				'selector' => '{{WRAPPER}} .ova_nav_canvas ul.menu .dropdown-menu li:last-child',

			]
		);


		$this->end_controls_section();


		/* IPad, Mobile Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_submenu_ipad_mobile',
			[
				'label' => __( 'Canvas Menu', 'ova-framework' ),
			]
		);



		$this->add_control(
			'canvas_dir',
			[
				'label' => __( 'Display Canvas', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'canvas_left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-h-align-left',
					],
					'canvas_right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'canvas_left'
			]
		);

		$this->add_control(
			'canvas_bg',
			[
				'label' => __( 'Background Color', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'canvas_bg_gray'  => __( 'Gray', 'ova-framework' ),
					'canvas_bg_white' => __( 'White', 'ova-framework' ),

				],
				'default' => 'canvas_bg_gray',
			]
		);

		$this->add_control(
			'ipad_mobile_openNav',
			[
				'label' => __( 'Menu Button', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'openNavBtn_align',
			[
				'label' => __( 'Align', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'NavBtn_left' => [
						'title' => __( 'Left', 'ova-framework' ),
						'icon' => 'eicon-text-align-left',
					],
					'NavBtn_right' => [
						'title' => __( 'Right', 'ova-framework' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'NavBtn_left'
			]
		);

		$this->add_control(
			'openNavBtn_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ova_openNav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'openNavBtn_padding',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ova_openNav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'openNavBtn_bg_color',
			[
				'label' => __( 'Background Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_openNav' => 'background-color: {{VALUE}};',
				]

			]
		);
		$this->add_control(
			'openNavBtn_color',
			[
				'label' => __( 'Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav .bar .bar-menu-line' => 'background: {{VALUE}};',
				]

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'openNavBtn_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .ova_openNav',

			]
		);

		$this->add_control(
			'openNavBtn_border',
			[
				'label' => __( 'Border Radius', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_openNav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		$this->add_control(
			'ipad_mobile_arrow_dropdown',
			[
				'label' => __( 'Allow Dropdown', 'ova-framework' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'ipad_mobile_arrow_dropdown_padding',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dropdown button.dropdown-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/***********************************************
		SECTION INFO
		***********************************************/
		$this->start_controls_section(
			'info_top_section',
			[
				'label' => __('Info Contact', 'ova-framework')
			]
		);

		$repeat = new \Elementor\Repeater();

		$repeat->add_control(
			'info_contact',
			[
				'label' => __('Info Contact','ova-framework'),
				'type' => Controls_Manager::TEXT,
				'show_label' => true
			]
		);

		$this->add_control(
			'tab_info',
			[
				'label' => __('Item Info Top','ova-framework'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeat->get_controls(),
			]
		);
		$this->add_control(
			'info_bottom_privacy',
			[
				'label' => __('Privacy Policy','ova-framework'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Privacy Policy','ova-framework')
			]
		);

		$this->add_control(
			'privacy_link',
			[
				'label' => __( 'Privacy Policy Link', 'ova-framework' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
							//'show_external' => false,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'info_bottom_terms',
			[
				'label' => __('Terms of Use','ova-framework'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Terms of Use','ova-framework')
			]
		);

		$this->add_control(
			'terms_link',
			[
				'label' => __( 'Terms of Use Link', 'ova-framework' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
							//'show_external' => false,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_contact_typography',
				'selector' => '{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info-top li span',
			]
		);


		$this->add_responsive_control(
			'padding_info_contact',
			[
				'label' => __( 'Padding Info Top', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info-top li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_info_contact',
			[
				'label' => __( 'Margin Info Top', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info-top li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);				

		$this->add_control(
			'info_contact_color',
			[
				'label' => __( 'Color Info Top', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info-top li span' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'info_contact_color_hover',
			[
				'label' => __( 'Color Info Top Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info-top li span:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_bottom_typography',
				'selector' => '{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info_bottom',
			]
		);

		$this->add_control(
			'info_bottom_color',
			[
				'label' => __( 'Color Info Top', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .info_bottom' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		/***********************************************
		SECTION SOCIAL
		***********************************************/
		$this->start_controls_section(
			'section_social',
			[
				'label' => __('Social', 'ova-framework'),
			]
		);
		$repeat = new \Elementor\Repeater();


		$repeat->add_control(
			'url_follow',
			[
				'label' => __('Url', 'ova-framework'),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
				]
			]
		);

		$repeat->add_control(
			'icon_social',
			[
				'label' => __('Icon', 'ova-framework'),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-facebook',
			]
		);
		$this->add_control(
			'tab_icon',
			[
				'label' => __( 'Item Icon', 'ova-framework' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeat->get_controls(),
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_icon_typography',
				'selector' => '{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon a span',
			]
		);


		$this->add_responsive_control(
			'padding_icon',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_icon',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'space_icon',
			[
				'label' => 'Space Icon Text',
				'type' => Controls_Manager::SLIDER,
				'ranger' => [
					'px' => [
						'min' => -20,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon a i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'color_icon',
			[
				'label' => __( 'Color Icon', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon a i' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'color_icon_hover',
			[
				'label' => __( 'Color Icon Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon a:hover i' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'text_color_text',
			[
				'label' => __( 'Color Text', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon a span' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'text_color_text_hove',
			[
				'label' => __( 'Color Text Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas .menu-icon-social .item-icon a:hover span' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __('Option Menu', 'ova-framework'),
			]
		);
		$this->add_responsive_control(
			'width_menu',
			[
				'label' => 'Width menu',
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas.show' => 'width: {{SIZE}}{{UNIT}};' 
				]
			]
		);

		$this->add_responsive_control(
			'min_height_menu',
			[
				'label' => 'Min Height Menu',
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_nav_canvas.show' => 'min-height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'color_icon_button_icon',
			[
				'label' => 'Color Icon',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav .bar .bar-menu-line' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'color_icon_button_hover',
			[
				'label' => 'Color Icon Hover',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav:hover .bar .bar-menu-line' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'color_text_button',
			[
				'label' => 'Color Text',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav .title_menu_f' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'color_text_button_hover',
			[
				'label' => 'Color Text Hover',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav:hover .title_menu_f' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'background_color_button',
			[
				'label' => 'Background Color Button',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'padding_button',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_button',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ova_menu_canvas .ova_openNav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		
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
		
		$settings = $this->get_settings();
		$tab_icon = $settings['tab_icon'];

		$info_bottom_privacy = $settings['info_bottom_privacy']; 
		$info_bottom_terms = $settings['info_bottom_terms'];

		$target_privacy = $settings['privacy_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow_privacy = $settings['privacy_link']['nofollow'] ? ' rel="nofollow"' : '';

		$target_terms = $settings['terms_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow_terms = $settings['terms_link']['nofollow'] ? ' rel="nofollow"' : '';


		?>
		<div class="ova_menu_canvas">
			<div class="ova_wrap_nav <?php echo esc_attr( $settings['openNavBtn_align'] ); ?>">

				<button class="ova_openNav" type="button">
					<span class="bar">
						<span class="bar-menu-line"></span>
						<span class="bar-menu-line"></span>
						<span class="bar-menu-line"></span>
					</span>
				</button>

				<div class="ova_nav_canvas <?php echo esc_attr( $settings['canvas_dir'] ).' '.esc_attr( $settings['canvas_bg'] ); ?>">

					<a href="javascript:void(0)" class="ova_closeNav"><i class="fas fa-times"></i></a>

					<?php
					wp_nav_menu( array(
						'menu'              => $settings['menu_slug'],
						'depth'             => 3,
						'container'         => '',
						'container_class'   => '',
						'container_id'      => '',
						'menu_class'        => 'menu'.' '.$settings['sub_menu_dir']
					));
					?>
					<div class="content-social-info">
						<?php if( $settings['tab_info'] != '' ){ ?>
							<ul class="info-top">
								<?php if( !empty($settings['tab_info'])) : foreach ($settings['tab_info'] as $index => $item ) :  ?>
									<li><span><?php echo esc_html( $item['info_contact'] ); ?></span></li>
								<?php endforeach; endif; ?>
							</ul>
						<?php }?>
						
						<ul class="menu-icon-social">
							<?php if (!empty($tab_icon)) : foreach ($tab_icon as $icon) : ?>
								<?php 
								$target_icon = $icon['url_follow']['is_external'] ? ' target="_blank" ' : '';
								$nofollow_icon = $icon['url_follow']['nofollow'] ? ' rel="nofollow" ' : '';
								?>
								<li class="item-icon"><a href="<?php echo $icon['url_follow']['url'] ?>" <?php echo esc_attr($target_icon . ' ' .$nofollow_icon ); ?> ><i class="<?php echo $icon['icon_social'] ?>"></i></a></li>
							<?php endforeach; endif; ?>
						</ul>

						<span class="info_bottom"><a href="<?php echo esc_attr($settings['privacy_link']['url']);?>"  <?php echo $target_privacy; ?> <?php echo $nofollow_privacy;?> ><?php echo esc_html($info_bottom_privacy);?></a> / <a href="<?php echo esc_attr($settings['terms_link']['url']);?>" <?php echo $target_terms;?> <?php echo $nofollow_terms;?> ><?php echo esc_html($info_bottom_terms);?></a></span>

					</div>
				</div>

				<div class="ova_closeCanvas ova_closeNav"></div>
			</div>
		</div>

		

	<?php }
	
}


