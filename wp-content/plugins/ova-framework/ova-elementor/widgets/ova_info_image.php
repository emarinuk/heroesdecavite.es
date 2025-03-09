<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_info_image extends Widget_Base {

	public function get_name() {
		return 'ova_info_image';
	}

	public function get_title() {
		return __( 'Info Image', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-picture-o';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_version',
			[
				'label' => __( 'Version', 'ova-framework' ),
			]
		);

			$this->add_control(
				'version_info',
				[
					'label' => __( 'Choose Type Info', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'info_position',
					'options' => [
						'info_position' => __( 'Info Position', 'ova-framework' ),
						'info_plan' => __( 'Info Plan', 'ova-framework' ),
						'info_location' => __( 'Info Location', 'ova-framework' ),
					],
				]
			);

		$this->end_controls_section();
		// end tab section content version info


		/******************************************************************
								SECTION INFO POSITION
		*******************************************************************/
		$this->start_controls_section(
			'section_content_position',
			[
				'label' => __( 'Info Position', 'ova-framework' ),
				'condition' => [
					'version_info' => ['info_position'],
				],
			]
		);

			$this->add_control(
				'image',
				[
					'label' => __( 'Choose Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);
 
			$this->add_control(
				'position',
				[
					'label' => __( 'Position', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Internships','ova-framework'),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __('We serve hot and cold drinks, sandwiches, breakfast bites, hot pastries, cakes and snacks in our café.', 'ova-framework'),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
					'show_external' => false,
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);


			$this->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Learn More','ova-framework'),
				]
			);

			$this->add_responsive_control(
				'align_info_position',
				[
					'label' => __( 'Alignment', 'ova-framework' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
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
					'default' => 'left',
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section content info position


		/******************************************************************
								SECTION INFO PLAN
		*******************************************************************/
		$this->start_controls_section(
			'section_content_plan',
			[
				'label' => __( 'Info Plan', 'ova-framework' ),
				'condition' => [
					'version_info' => ['info_plan'],
				],
			]
		);

			$this->add_control(
				'image_plan',
				[
					'label' => __( 'Choose Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);
 
			$this->add_control(
				'plan',
				[
					'label' => __( 'Plan', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Plan Your Event','ova-framework'),
				]
			);

			$this->add_control(
				'desc_plan',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __('Analytics virality user experience burn rate. Business-to-business first mover advantage business model.', 'ova-framework'),
				]
			);

			$this->add_control(
				'link_plan',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
					'show_external' => false,
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);


			$this->add_control(
				'text_button_plan',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Learn More','ova-framework'),
				]
			);

			$this->add_responsive_control(
				'align_info_plan',
				[
					'label' => __( 'Alignment', 'ova-framework' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
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
						'{{WRAPPER}} .ova_info_position.info_plan' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section content info plan


		/******************************************************************
								SECTION INFO PLAN
		*******************************************************************/
		$this->start_controls_section(
			'section_content_location',
			[
				'label' => __( 'Info Location', 'ova-framework' ),
				'condition' => [
					'version_info' => ['info_location'],
				],
			]
		);

			$this->add_control(
				'image_location',
				[
					'label' => __( 'Choose Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);
 
			$this->add_control(
				'location',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Modern Homestead','ova-framework'),
				]
			);

			$this->add_control(
				'desc_location',
				[
					'label' => __( 'Time Open', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __('Open Daily 10AM-9PM', 'ova-framework'),
				]
			);

			$this->add_control(
				'address_location',
				[
					'label' => __( 'Address', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __('1 West 52 Street, Mangatha', 'ova-framework'),
				]
			);

			$this->add_control(
				'link_location',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
					'show_external' => false,
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);


			$this->add_control(
				'text_button_location',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Plan Your Visit','ova-framework'),
				]
			);

			$this->add_responsive_control(
				'align_info_location',
				[
					'label' => __( 'Alignment', 'ova-framework' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left'    => [
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
						'{{WRAPPER}} .ova_info_position.info_location' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section content info Location



		/****************************************************************************************************
										SECTION STYLE POSITION
		*****************************************************************************************************/

		//SECTION TAB STYLE BACKGROUND COLOR
		$this->start_controls_section(
			'section_style_background',
			[
				'label' => __( 'Background', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'background_color',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		//END SECTION TAB STYLE BACKGROUND COLOR

		//SECTION TAB STYLE TITLE 
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_position'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_position .content .title h3 a',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => __( 'Color Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .title h3 a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_hover_title',
				[
					'label' => __( 'Color Hover Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .title h3 a:hover' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE 


		//SECTION TAB STYLE DESC 
		$this->start_controls_section(
			'section_style_desc',
			[
				'label' => __( 'Description', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_position'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_position .content .desc p',
				]
			);

			$this->add_control(
				'color_desc',
				[
					'label' => __( 'Color Description', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .desc p' => 'color : {{VALUE}};',
					],
				]
			);			

		$this->end_controls_section();
		//END SECTION TAB STYLE DESC 

		//SECTION TAB STYLE DESC 
		$this->start_controls_section(
			'section_style_text_button',
			[
				'label' => __( 'Text Button', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_position'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_button_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_position .content .text-button a',
				]
			);

			$this->add_control(
				'color_text_button',
				[
					'label' => __( 'Color Text Button', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .text-button a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_border_text_button',
				[
					'label' => __( 'Color Border', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .text-button a' => 'border-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_border_text_button',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .text-button a' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_text_button_hover',
				[
					'label' => __( 'Color Hover Text Button', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .text-button a:hover' => 'color : {{VALUE}};',
					],
				]
			);	

			

			$this->add_control(
				'color_border_hover_text_button_hover',
				[
					'label' => __( 'Color Border Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .text-button a:hover' => 'border-color : {{VALUE}};',
					],
				]
			);	

			$this->add_control(
				'bg_color_hover_text_button_hover',
				[
					'label' => __( 'Background Color Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_position .content .text-button a:hover' => 'background-color : {{VALUE}};',
					],
				]
			);		

		$this->end_controls_section();
		//END SECTION TAB STYLE DESC 


		/****************************************************************************************************
										SECTION STYLE LOCATION
		*****************************************************************************************************/

		//SECTION TAB STYLE TITLE 
		$this->start_controls_section(
			'section_style_title_location',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_location'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_loca_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_location .content .title h3 a',
				]
			);

			$this->add_control(
				'color_title_loca',
				[
					'label' => __( 'Color Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .title h3 a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_hover_title_loca',
				[
					'label' => __( 'Color Hover Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .title h3 a:hover' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE 


		//SECTION TAB STYLE DESC 
		$this->start_controls_section(
			'section_style_desc_loca',
			[
				'label' => __( 'Description', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_location'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'desc_loca_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_location .content .desc p',
				]
			);

			$this->add_control(
				'color_desc_loca',
				[
					'label' => __( 'Color Description', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .desc p' => 'color : {{VALUE}};',
					],
				]
			);			

		$this->end_controls_section();
		//END SECTION TAB STYLE DESC 

		//SECTION TAB STYLE DESC 
		$this->start_controls_section(
			'section_style_text_button_loca',
			[
				'label' => __( 'Text Button', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_location'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_button_loca_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_location .content .text-button a',
				]
			);

			$this->add_control(
				'color_text_button_loca',
				[
					'label' => __( 'Color Text Button', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .text-button a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_border_text_button_loca',
				[
					'label' => __( 'Color Border', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .text-button a' => 'border-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_colorr_text_button_loca',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .text-button a' => 'background-color : {{VALUE}};',
					],
				]
			);


			$this->add_control(
				'color_text_button_loca_hover',
				[
					'label' => __( 'Color Hover Text Button', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .text-button a:hover' => 'color : {{VALUE}};',
					],
				]
			);	

			
			$this->add_control(
				'color_border_hover_text_button_loca_hover',
				[
					'label' => __( 'Color Border Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .text-button a:hover' => 'border-color : {{VALUE}};',
					],
				]
			);	

			$this->add_control(
				'bg_color_hover_text_button_loca_hover',
				[
					'label' => __( 'background Color Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_location .content .text-button a:hover' => 'background-color : {{VALUE}};',
					],
				]
			);		

		$this->end_controls_section();
		//END SECTION TAB STYLE DESC 


		/****************************************************************************************************
										SECTION STYLE PLAN
		*****************************************************************************************************/


		//SECTION TAB STYLE TITLE 
		$this->start_controls_section(
			'section_style_title_plan',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_plan'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_plan_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_plan .content .title h3 a',
				]
			);

			$this->add_control(
				'color_title_plan',
				[
					'label' => __( 'Color Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .title h3 a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_hover_title_plan',
				[
					'label' => __( 'Color Hover Title', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .title h3 a:hover' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE 


		//SECTION TAB STYLE DESC 
		$this->start_controls_section(
			'section_style_desc_plan',
			[
				'label' => __( 'Description', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_plan'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'desc_plan_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_plan .content .desc p',
				]
			);

			$this->add_control(
				'color_desc_plan',
				[
					'label' => __( 'Color Description', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .desc p' => 'color : {{VALUE}};',
					],
				]
			);			

		$this->end_controls_section();
		//END SECTION TAB STYLE DESC 

		//SECTION TAB STYLE DESC 
		$this->start_controls_section(
			'section_style_text_button_plan',
			[
				'label' => __( 'Text Button', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'version_info' => ['info_plan'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_button_plan_typography',
					'selector' => '{{WRAPPER}} .ova_info_position.info_plan .content .text-button a',
				]
			);

			$this->add_control(
				'color_text_button_plan',
				[
					'label' => __( 'Color Text Button', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .text-button a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_border_text_button_plan',
				[
					'label' => __( 'Color Border', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .text-button a' => 'border-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_text_button_plan',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .text-button a' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_text_button_plan_hover',
				[
					'label' => __( 'Color Hover Text Button', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .text-button a:hover' => 'color : {{VALUE}};',
					],
				]
			);	

			

			$this->add_control(
				'color_border_hover_text_button_plan_hover',
				[
					'label' => __( 'Color Border Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .text-button a:hover' => 'border-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_text_button_plan_hover',
				[
					'label' => __( 'Background Color Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_position.info_plan .content .text-button a:hover' => 'background-color : {{VALUE}};',
					],
				]
			);			

		$this->end_controls_section();
		//END SECTION TAB STYLE DESC 

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$version_info = $settings['version_info'];
		$title = $desc = $link = $text_button = $class_version = $address = '';
		switch ($version_info) {
			case "info_position" : {
				$image = $settings['image']['url'];
				$title = $settings['position'];
				$desc = $settings['desc'];
				$link = $settings['link']['url'];
				$target 	= $settings['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow 	= $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
				$text_button = $settings['text_button'];
				$class_version = 'info_position';
				break;
			}
			case "info_plan" : {
				$image = $settings['image_plan']['url'];
				$title = $settings['plan'];
				$desc = $settings['desc_plan'];
				$link = $settings['link_plan']['url'];
				$target 	= $settings['link_plan']['is_external'] ? ' target="_blank"' : '';
				$nofollow 	= $settings['link_plan']['nofollow'] ? ' rel="nofollow"' : '';
				$text_button = $settings['text_button_plan'];
				$class_version = ' info_plan ';
				break;
			}
			case "info_location" : {
				$image = $settings['image_location']['url'];
				$title = $settings['location'];
				$desc = $settings['desc_location'];
				$address = $settings['address_location'];
				$link = $settings['link_location']['url'];
				$target 	= $settings['link_location']['is_external'] ? ' target="_blank"' : '';
				$nofollow 	= $settings['link_location']['nofollow'] ? ' rel="nofollow"' : '';
				$text_button = $settings['text_button_location'];
				$class_version = ' info_plan info_location ';
			}
		}
		
	?>
		<div class="ova_info_position <?php echo esc_attr($class_version) ?>">
			<?php if(!empty($image)) : ?>
				<div class="post-media">
					<img src="<?php echo esc_attr($image) ?>" alt="<?php echo esc_html($title) ?>">
				</div>
			<?php endif ?>
			<div class="content">
				<?php if(!empty($title)) : ?>
					<div class="title">
						<h3><a class="second_font" href="<?php echo esc_attr($link) ?>"><?php echo esc_html($title) ?></a></h3>
					</div>
				<?php endif ?>
				<?php if(!empty($desc)) : ?>
					<div class="desc">
						<p><?php echo esc_html($desc) ?></p>
					</div>
				<?php endif ?>

				<?php if(!empty($address)) : ?>
					<div class="address">
						<span><?php echo esc_html($address) ?></span>
					</div>
				<?php endif ?>

				<?php if(!empty($text_button)) : ?>
					<div class="text-button">
						<a href="<?php echo esc_attr( $link ); ?>"<?php echo $target.$nofollow; ?>>
							<?php echo esc_html($text_button); ?>
						</a>
					</div>
				<?php endif ?>
			</div>
			

		</div>
	<?php
	}
}
