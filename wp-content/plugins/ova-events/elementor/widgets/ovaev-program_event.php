<?php
namespace ova_ovaev_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_events_cat extends Widget_Base {


	public function get_name() {		
		return 'ova_events_cat';
	}

	public function get_title() {
		return __( 'Events & Programs', 'ovaev' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		// Carousel
		wp_enqueue_style( 'owl-carousel', OVAEV_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', OVAEV_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'script-elementor' ];
	}

	protected function register_controls() {


	   	$args = array(
           'taxonomy' => 'event_type',
           'orderby' => 'name',
           'order'   => 'ASC'
       	);
	
		$categories = get_categories($args);
		$catAll = array( 'all' => 'All categories');
		$cate_array = array();
		if ($categories) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->cat_name] = $cate->slug;
			}
		} else {
			$cate_array["No content Category found"] = 0;
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ovaev' ),
			]
		);

			$this->add_control(
				'category',
				[
					'label'   => __( 'Category', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge( $catAll, $cate_array )
				]
			);

			$this->add_control(
				'time_event',
				[
					'label'   => __('Choose time', 'ovaev'),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						''     => __('All','ovaev'),
						'current'  => __('Current','ovaev'),
						'upcoming' => __('Upcoming','ovaev'),
						'current_upcoming' => __('Current & Upcoming','ovaev'),
						'past'     => __('Past','ovaev'),
					],
					'default'   => '',
				]
			);

			$this->add_control(
				'upcoming_day',
				[
					'label'     => __('Upcoming Day','ovaev'),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 100,
					'min'       => 1,
					'condition' => [
						'time_event' => 'upcoming'
					]
				]
			);

			$this->add_control(
				'event_type_select',
				[
					'label' => __('Event Type','ovaev'),
					'type' => Controls_Manager::SELECT,
					'default' => 'type1',
					'options' => [
						'type1' => __('Type 1', 'ovaev'),
						'type2' => __('Type 2', 'ovaev'),
						'type3' => __('Type 3', 'ovaev')
 					]
				]
			);

			$this->add_control(
				'slide_type',
				[
					'label'        => __( 'Using Slide', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'no',
					'separator'    => 'before',
					'condition'    => [
						'event_type_select' => 'type3'
					]
				]
			);

			$this->add_control(
				'total_columns_slide',
				[
					'label'   => __( 'Desktop: Total item each slide', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '2',
					'options' => [
						'1' => __( '1 items', 'ovaev' ),
						'2' => __( '2 items', 'ovaev' ),
						'3' => __( '3 items', 'ovaev' ),
						'4' => __( '4 items', 'ovaev' ),
					],
					'condition' => [
						'slide_type' => 'yes',  
					]
				]
			);

			$this->add_control(
				'items_ipad',
				[
					'label'   => __( 'Ipad: Total item each slide', 'ovaev'),
					'type'    => Controls_Manager::SELECT,
					'default' => '2',
					'options' => [
						'1' => __( '1 items', 'ovaev'),
						'2' => __( '2 items', 'ovaev'),
						'3' => __( '3 items', 'ovaev'),
						'4' => __( '4 items', 'ovaev'),
					],
					'condition' => [
						'slide_type' => 'yes',

					]
				]
			);

			$this->add_control(
				'items_mobile',
				[
					'label'   => __( 'Mobile: Total item each slide', 'ovaev'),
					'type'    => Controls_Manager::SELECT,
					'default' => '1',
					'options' => [
						'1' => __( '1 items', 'ovaev'),
						'2' => __( '2 items', 'ovaev'),
						'3' => __( '3 items', 'ovaev'),
						'4' => __( '4 items', 'ovaev'),
					],
					'condition' => [
						'slide_type' => 'yes',
					]
				]
			);

			$this->add_control(
				'order_by',
				[
					'label'   => __( 'Order By', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'title',
					'options' => [
						'title'             => __( 'Title', 'ovaev' ),
						'event_custom_sort' => __( 'Custom Sort', 'ovaev' ),
						'ovaev_start_date'  => __( 'Start Date', 'ovaev' ),
						'ID'                => __( 'ID', 'ovaev' ),					
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => __( 'Order', 'ovaev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => __( 'Descending', 'ovaev' ),
						'ASC'  => __( 'Ascending', 'ovaev' ),
						
					],

				]
			);

			$this->add_control(
				'total_count',
				[
					'label'   => __( 'Total Post', 'ovaev' ),
					'type'    => Controls_Manager::NUMBER,
					'min'     => 1,
					'default' => 4
				]
			);

			$this->add_control(
				'show_title',
				[
					'label'        => __( 'Show Title', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
				]
			);

			$this->add_control(
				'show_date',
				[
					'label'        => __( 'Show Date', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			$this->add_control(
				'show_excerpt',
				[
					'label'        => __( 'Show Excerpt', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'condition' => [
						'event_type_select' => 'type1'
					]
				]
			);

			$this->add_control(
				'show_read_more',
				[
					'label'        => __( 'Show Read More', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
				]
			);

			$this->add_control(
				'text_read_more',
				[
					'label'       => __( 'Text Read More', 'ovaev' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => 'Details',
					'placeholder' => 'Text',
					'conditions'  => [
						'terms' => [
							[
								'name' => 'show_read_more',
								'operator' => '!=',
								'value' => '',
							],
						],
					],
				]
			);

			$this->add_control(
				'show_book_button',
				[
					'label'        => __( 'Show Book Button', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
				]
			);

			$this->add_control(
				'show_free_button',
				[
					'label'        => __( 'Show Free Button', 'ovaev' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
				]
			);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Slider Settings', 'ovaev' ),
				'condition' => [
					'slide_type' => 'yes'
				]
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label' => __( 'Margin Right Items', 'ovaev' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'arows_control',
				[
					'label' => __('Show Navigation', 'ovaev'),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$this->add_control(
				'dots_control',
				[
					'label'   => __('Show Paging', 'ovaev'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);


			$this->add_control(
				'pause_on_hover',
				[
					'label'   => __( 'Pause on Hover', 'ovaev' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => __( 'Autoplay', 'ovaev' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => __( 'Autoplay Speed', 'ovaev' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5000,
					'condition' => [
						'autoplay' => 'yes',
					]
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => __( 'Infinite Loop', 'ovaev' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => __( 'Smart Speed', 'ovaev' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500
				]
			);

			$this->add_control(
				'slideby',
				[
					'label' => __( "Navigation slide by x. 'page' string can be set to slide by page.", 'ovaev' ),
					'type'  => Controls_Manager::NUMBER,
					'description' => __( 'Example: 1', 'ovaev' ),
					'default'     => '1'
				]
			);

		$this->end_controls_section();

		// section style //

		// Title style
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .event_title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'ovaev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .event_title a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_hover_color',
				[
					'label' => __( 'Title Hover Color', 'ovaev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .event_title a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_magin',
				[
					'label' => __( 'Title Margin', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .event_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

		$this->end_controls_section();

		// time style
		$this->start_controls_section(
			'section_time_style',
			[
				'label' => __( 'Time Event', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'time_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .time-event span',
				]
			);
			$this->add_control(
				'time_color',
				[
					'label' => __( 'Color', 'ovaev' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .time-event span' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'time_padding',
				[
					'label' => __( 'Date Padding', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .time-event' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
		$this->end_controls_section();

		// date style
		$this->start_controls_section(
			'section_date_style',
			[
				'label' => __( 'Date Event', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'date_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .date-event .date',

				]
			);
			$this->add_control(
				'date_color',
				[
					'label' => __( 'Color', 'ovaev' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .date-event .date' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'date_background_color',
				[
					'label' => __( 'Background', 'ovaev' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .date-event .date' => 'background: {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_section();

		// excerpt_style
		$this->start_controls_section(
			'section_excerpt_style',
			[
				'label' => __( 'Excerpt', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'event_type_select' => 'type1'
				]
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'excerpt_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .excerpt',
				]
			);

			$this->add_control(
				'excerpt_color',
				[
					'label' => __( 'Text Color', 'ovaev' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .excerpt' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'excerpt_padding',
				[
					'label' => __( 'Excerpt Margin', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			
		$this->end_controls_section();

		// read more
		$this->start_controls_section(
			'section_read_more_style',
			[
				'label' => __( 'Button Read More', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'read_more_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail',
				]
			);

			$this->add_responsive_control(
				'read_more_padding',
				[
					'label' => __( 'Button Padding', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'read_more_margin',
				[
					'label' => __( 'Button Margin', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );
				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => __( 'Normal', 'ovaev' ),
					]
				);

				$this->add_control(
					'read_more_text_color',
					[
						'label' => __( 'Text Color', 'ovaev' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'read_more_background_color',
					[
						'label' => __( 'Background Color', 'ovaev' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->end_controls_tab();

				// Tab button hover
				$this->start_controls_tab(
					'tab_button_hover',
					[
						'label' => __( 'Hover', 'ovaev' ),
					]
				);

					$this->add_control(
						'hover_color',
						[
							'label' => __( 'Text Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_background_hover_color',
						[
							'label' => __( 'Background Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail:hover' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_hover_border_color',
						[
							'label' => __( 'Border Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'border_radius',
				[
					'label' => __( 'Border Radius', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .view_detail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();

		// Button Book Online

		$this->start_controls_section(
			'section_book_online_style',
			[
				'label' => __( 'Button Book Online', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'book_online_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book',
				]
			);

			$this->add_responsive_control(
				'book_online_padding',
				[
					'label' => __( 'Button Padding', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'book_online_margin',
				[
					'label' => __( 'Button Margin', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_booking_online_style' );
				$this->start_controls_tab(
					'tab_button_book_normal',
					[
						'label' => __( 'Normal', 'ovaev' ),
					]
				);

				$this->add_control(
					'book_online_text_color',
					[
						'label' => __( 'Text Color', 'ovaev' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'book_online_background_color',
					[
						'label' => __( 'Background Color', 'ovaev' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->end_controls_tab();

				// Tab button hover
				$this->start_controls_tab(
					'tab_button_book_hover',
					[
						'label' => __( 'Hover', 'ovaev' ),
					]
				);

					$this->add_control(
						'book_online_hover_color',
						[
							'label' => __( 'Text Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'book_online_background_hover_color',
						[
							'label' => __( 'Background Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book:hover' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'book_online_hover_border_color',
						[
							'label' => __( 'Border Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border_book',
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'book_online_border_radius',
				[
					'label' => __( 'Border Radius', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();

		// Button Free

		$this->start_controls_section(
			'section_button_free_style',
			[
				'label' => __( 'Button Free', 'ovaev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'button_free_typography',
					'label' => __( 'Typography', 'ovaev' ),
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free',
				]
			);

			$this->add_responsive_control(
				'button_free_padding',
				[
					'label' => __( 'Button Padding', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'button_free_margin',
				[
					'label' => __( 'Button Margin', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_button_free_style' );
				$this->start_controls_tab(
					'tab_button_free_normal',
					[
						'label' => __( 'Normal', 'ovaev' ),
					]
				);

				$this->add_control(
					'button_free_text_color',
					[
						'label' => __( 'Text Color', 'ovaev' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'button_free_background_color',
					[
						'label' => __( 'Background Color', 'ovaev' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->end_controls_tab();

				// Tab button hover
				$this->start_controls_tab(
					'tab_button_free_hover',
					[
						'label' => __( 'Hover', 'ovaev' ),
					]
				);

					$this->add_control(
						'button_free_hover_color',
						[
							'label' => __( 'Text Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_free_background_hover_color',
						[
							'label' => __( 'Background Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free:hover' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_free_hover_border_color',
						[
							'label' => __( 'Border Color', 'ovaev' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border_free',
					'placeholder' => '1px',
					'default' => '1px',
					'selector' => '{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'button_free_border_radius',
				[
					'label' => __( 'Border Radius', 'ovaev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .archive_event .content .desc .event_post .button_event .book.btn-free' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		//Get setting slide

		$data_option['total_columns_slide'] = absint( $settings['total_columns_slide'] ); 
		$data_option['items_ipad']          = absint( $settings['items_ipad'] ); 
		$data_option['items_mobile']        = absint( $settings['items_mobile'] ); 
		$data_option['smartSpeed']          = absint( $settings['smartspeed'] );
		$data_option['margin']              = absint( $settings['margin_items'] ); 
		$data_option['loop']                =  ( $settings['infinite'] == 'yes') ? true : false;
		$data_option['autoplay']            =  ( $settings['autoplay'] == 'yes') ? true : false;
		$data_option['autoplayTimeout']     = absint( $settings['autoplay_speed'] );
		$data_option['autoplayHoverPause']  =  ( $settings['pause_on_hover'] == 'yes') ? true : false;
		$data_option['dots']                =  ( $settings['dots_control'] == 'yes') ? true : false;
		$data_option['nav']                 =  ( $settings['arows_control'] == 'yes') ? true : false;
		$data_option['slideBy']             = absint( $settings['slideby'] );
		$data_option['prev'] = '<i class="ti-angle-left"></i>';
		$data_option['next'] = '<i class="ti-angle-right"></i>';

		$data_option_encode = wp_json_encode($data_option);

		$data_options = $settings['slide_type'] === 'yes' ? "data-options='".esc_attr($data_option_encode)."'" : '';

		$class_slide = '';

		if( $settings['slide_type'] === 'yes' ){
			$class_slide = 'event-slide-owl owl-carousel';
		}
 
		$event_type_select = $settings['event_type_select'] != '' ? $settings['event_type_select'] : 'type1';

		$text_read_more = $settings['text_read_more'] != '' ? $settings['text_read_more'] : 'Details';
			
		$term = get_term_by('name', $settings['category'], 'event_type');
		$term_link = get_term_link( $term );

		$upcoming_day = absint( $settings['upcoming_day'] );

		if( $settings['category'] === 'all'){

			if( $settings['time_event'] === 'current'){
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'meta_query'     => array(
						array(
							array(
								'relation' => 'AND',
									array(
									'key'     => 'ovaev_start_date',
									'value'   => current_time('timestamp' ),
									'compare' => '<'
									),
									array(
									'key'     => 'ovaev_end_date',
									'value'   => current_time('timestamp' ),
									'compare' => '>='
									)
							)
						)
					)
			 	);
			} elseif( $settings['time_event'] === 'upcoming' ){
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'meta_query'     => array(
						array(
							'relation' => 'AND',
							array(
							'key'     => 'ovaev_start_date',
							'value'   => current_time( 'timestamp' ),
							'compare' => '>'
							),
							array(
							'key'     => 'ovaev_start_date',
							'value'   => current_time( 'timestamp') + ( $upcoming_day * 24 * 60 * 60 ),
							'compare' => '<='
							)	
						)
					)
			 	);
			} elseif( $settings['time_event'] === 'current_upcoming' ){

				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'meta_query'     => array(
					
							array(
							'key'     => 'ovaev_end_date',
							'value'   => current_time( 'timestamp'),
							'compare' => '>='
							)	
						
					)
			 	);

			}elseif( $settings['time_event'] === 'past' ){
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'meta_query'     => array(
			     	 	array(
							'key'     => 'ovaev_end_date',
							'value'   => current_time('timestamp' ),
							'compare' => '<',					
			     	 	),
				  	),
			 	);
			} else{	
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
			 	);
			}

		} elseif( $settings['category'] != 'all' ) {
			if( $settings['time_event'] === 'current'){
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'tax_query'      => array(
						array(
							'taxonomy' => 'event_type',
							'field'    => 'slug',
							'terms'    => $settings['category'],
						)
					),
					'meta_query'     => array(
						array(
							'relation' => 'OR',
							array(
								'key'     => 'ovaev_start_date',
								'value'   => array( current_time('timestamp' )-1, current_time('timestamp' )+(24*60*60)+1 ),
								'type'    => 'numeric',
								'compare' => 'BETWEEN'	
							),
							array(
								'relation' => 'AND',
									array(
									'key'     => 'ovaev_start_date',
									'value'   => current_time('timestamp' ),
									'compare' => '<'
									),
									array(
									'key'     => 'ovaev_end_date',
									'value'   => current_time('timestamp' ),
									'compare' => '>='
									)
							)
						)
					)
			 	);
			} elseif( $settings['time_event'] === 'upcoming' ){
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'tax_query'      => array(
						array(
							'taxonomy' => 'event_type',
							'field'    => 'slug',
							'terms'    => $settings['category'],
						)
					),
					'meta_query'     => array(
						array(
							'relation' => 'AND',
							array(
							'key'     => 'ovaev_start_date',
							'value'   => current_time( 'timestamp' ),
							'compare' => '>'
							),
							array(
							'key'     => 'ovaev_start_date',
							'value'   => current_time( 'timestamp') + ( $upcoming_day * 24 * 60 * 60 ),
							'compare' => '<='
							)	
						)
					)
			 	);
			} elseif( $settings['time_event'] === 'past' ){
				$args= array(
					'post_type'      => 'event',
					'post_status'    => 'publish',
					'posts_per_page' => $settings['total_count'],
					'order'          => $settings['order'],
					'tax_query'      => array(
						array(
							'taxonomy' => 'event_type',
							'field'    => 'slug',
							'terms'    => $settings['category'],
						)
					),
					'meta_query'     => array(
			     	 	array(
							'key'     => 'ovaev_end_date',
							'value'   => current_time('timestamp' ),
							'compare' => '<',					
			     	 	),
				  	),
			 	);
			} else{
				$args= array(
					'post_type'   => 'event',
					'post_status' => 'publish',
					'tax_query'   => array(
						array(
							'taxonomy' => 'event_type',
							'field'    => 'slug',
							'terms'    => $settings['category'],
						)
					),
					'order'          => $settings['order'],
					'posts_per_page' => $settings['total_count']
			 	);
			} 


		}


		switch ( $settings['order_by'] ) {

			case 'title':
			$args_orderby =  array( 'orderby' => 'title' );
			break;

			case 'event_custom_sort':
			$args_orderby =  array( 'orderby' => 'meta_value_num', 'meta_key' => $settings['order_by'] );
			break;

			case 'ovaev_start_date':
			$args_orderby =  array( 'orderby' => 'meta_value_num', 'meta_key' =>$settings['order_by'] );
			break;
			
			case 'ID':
			$args_orderby =  array( 'orderby' => 'ID');
			break;
			
			default:
			break;

		}
		
		$html = '';

		$args = array_merge( $args, $args_orderby );

		$events = new \WP_Query($args);

		$html.='<div class="archive_event '.esc_attr($event_type_select).' element '.esc_attr($class_slide).' " '.$data_options.'>';

			if( $events->have_posts() ) : while( $events->have_posts() ) : $events->the_post();

				$img_src    = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );
				$img_srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id(), 'medium' );

				$post_ID = get_the_ID();

				$ovaev_venue      = get_post_meta( $post_ID, 'ovaev_venue', true );
				$ovaev_start_date = get_post_meta( $post_ID, 'ovaev_start_date', true );
				$ovaev_end_date   = get_post_meta( $post_ID, 'ovaev_end_date', true );
				
				$date_start  = $ovaev_start_date != '' ? date_i18n(get_option('date_format'), $ovaev_start_date) : '';
				$time_start  = $ovaev_start_date != '' ? date_i18n(get_option('time_format'), $ovaev_start_date) : '';
				$date_end    = $ovaev_end_date != '' ? date_i18n(get_option('date_format'), $ovaev_end_date) : '';
				$time_end    = $ovaev_end_date != '' ? date_i18n(get_option('time_format'), $ovaev_end_date) : '';
				
				$date_event  = $ovaev_start_date != '' ? date_i18n('d', $ovaev_start_date) : '';
				$month_event = $ovaev_start_date != '' ? date_i18n('F', $ovaev_start_date) : '';
				$week_day    = $ovaev_start_date != '' ? date_i18n('l', $ovaev_start_date) : '';
				$month_event_M = $ovaev_start_date != '' ? date_i18n('M', $ovaev_start_date ) : '';
				$year_event    = $ovaev_start_date != '' ? date_i18n('Y', $ovaev_start_date ) : '';

				$ovaev_book        = get_post_meta( $post_ID, 'ovaev_book', true );
				$ovaev_book_link   = get_post_meta( $post_ID, 'ovaev_book_link', true );
				$ovaev_target_book = get_post_meta( $post_ID, 'ovaev_target_book', true );


			$html .= '<div class="content element-event">';
				if( $settings['show_date'] == 'yes'){		
				$html .='<div class="date-event">';
					if( $event_type_select == 'type1'){
						$html .= '<span class="date-month">'.esc_html($date_event).'<span class="month">'.esc_html($month_event).'</span></span>';
						$html .= '<span class="weekday second_font">'.esc_html($week_day).'</span>';
					} elseif( $event_type_select == 'type2' || $event_type_select == 'type3'){
						$html .= '<span class="date">'.esc_html($date_event).'</span>';
						$html .= '<span class="month-year"><span class="month">'.esc_html($month_event_M).'</span><span class="year">'.esc_html($year_event).'</span></span>';
					}

				$html .='</div>';
				}
				$html .='<div class="desc">';
					if( $event_type_select == 'type1' || $event_type_select == 'type2' ){
						if( has_image_size( 'shop_single' ) ){
							$html .= '<div class="event-thumbnail">'.get_the_post_thumbnail( $post_ID, 'shop_single', '' ).'</div>';
						}else{
							$html .= '<div class="event-thumbnail">'.get_the_post_thumbnail( $post_ID, 'medium_large', '' ).'</div>';
						}
					}
					if( $event_type_select == 'type3'){
						$html .= '<div class="event-thumbnail" style="background: url('.$img_src.');"></div>';
					}
					$html .= '<div class="event_post">';
						if( $event_type_select == 'type1' || $event_type_select == 'type2'){
							$taxonomy = 'event_type';
							$terms = get_the_terms( $post_ID , $taxonomy );
							if ( $terms && ! is_wp_error($terms) ){
								$tslugs_arr = array();
							    foreach ($terms as $term) {
							        $tslugs_arr[] = $term->name;
							    }
							    $terms_slug_str = join( ", ", $tslugs_arr );
							    $html .= '<div class="post_cat"><span class="event_type">'.esc_html($terms_slug_str).'</span></div>';
							}
						}
                        global $wp;
                        if ( $settings['show_title'] == 'yes' ){
                            if ( $time_end == '00:00' ) {
                                if(add_query_arg(array(), $wp->request) == 'proximos-eventos') {
                                    $html .= '<h2 class="second_font event_title">' . get_the_title() . '</h2>';
                                } else {
                                    $html .= '<h2 class="second_font event_title"><a href="https://wordpress-1413764-5263504.cloudwaysapps.com/proximos-eventos/">' . get_the_title() . '</h2>';
                                }
                            } else {
                                $html .= '<h2 class="second_font event_title"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h2>';
                            }
						}
						
						$html .='<div class="time-event">';
							if( $date_start != '' && $event_type_select == 'type1' ) : 
							$html .='<span class="evn-mobile">'.esc_html__('Time: ', 'ovaev') .$week_day.',&nbsp;'.$date_start.'</span>';
							endif;
							if( $date_start === $date_end && $date_end != '' && $date_start != '' ){ 
							$html .='<span>'.esc_html($time_start).' / </span>';
//							$html .='<span>'.esc_html($time_end).' / </span>';
							$html .= '<span class="number">'.esc_attr( $ovaev_venue ).'</span>';
							}elseif( $date_start != $date_end && $date_end != '' && $date_start != '' ){
							$html .= '<span>'.esc_html($date_start) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_start).' / </span>';
//							$html .= '<span>'.esc_html($date_end) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end).' / </span>';
							$html .= '<span class="number">'.esc_attr( $ovaev_venue ).'</span>';
							}
						$html .= '</div>';
						if (function_exists('muzze_custom_text') && $settings['show_excerpt'] == 'yes' && $event_type_select == 'type1' ) {
							$html .= '<div class="excerpt">'.esc_html(get_the_excerpt()).'</div>';
						}
						$html .='<div class="button_event">';
							if( $settings['show_read_more'] == 'yes' ){
								$html .='<a class="view_detail" href="'.get_the_permalink().'">'.esc_html( $text_read_more ).'</a>';
								
							}
							
						if ('extra_link' == $ovaev_book) {
							if( $settings['show_book_button'] == 'yes' ){ 
								$html .= '<a class="book" href="'.esc_attr( $ovaev_book_link ).'" target="'.$ovaev_target_book.'">'.esc_html__('Book Online','ovaev').'</a>';
							}
						} else { 
							if( $settings['show_free_button'] == 'yes' ){
								$html .= '<span class="book btn-free">'.esc_html__('Free','ovaev').'</span>';
							}
						}
							
							
						$html .= '</div>'; 
					$html .= '</div>';
				$html .='</div>';
			$html .= '</div>';


			endwhile; endif; wp_reset_postdata();
		$html.='</div>';

		echo $html;
	}
}
