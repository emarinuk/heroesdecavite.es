<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_price_table extends Widget_Base {

	public function get_name() {
		return 'ova_price_table';
	}

	public function get_title() {
		return __( 'Price Table', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-table';
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
				'label' => __( 'Price Table', 'ova-framework' ),
			]
		);
 
			$this->add_control(
				'type',
				[
					'label' => __( 'Type', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Individual', 'ova-framework'),
				]
			);


			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('flaticon-user', 'ova-framework'),
				]
			);

			$this->add_control(
				'price',
				[
					'label' => __( 'Price', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('£50', 'ova-framework'),
				]
			);

			$this->add_control(
				'per_time',
				[
					'label' => __( 'Per Time', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('year', 'ova-framework'),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => __('Invitations to members-only events, priority registration and program discounts, and more.', 'ova-framework'),
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('JOIN NOW', 'ova-framework'),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);


		$this->end_controls_section();

		// end tab section_content

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Content', 'ova-framework' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'content_background',
				[
					'label' => esc_html__( 'Background', 'ova-framework' ),
					'type' 	=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-table' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'content_border',
					'selector' 	=> '{{WRAPPER}} .ova-price-table',
				]
			);

			$this->add_control(
				'content_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'content_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'type_style_section',
			[
				'label' => esc_html__( 'Type', 'ova-framework' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'type_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .type h3',
				]
			);

			$this->add_control(
				'type_color',
				[
					'label' => esc_html__( 'Color', 'ova-framework' ),
					'type' 	=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-table .type h3' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'type_background',
				[
					'label' => esc_html__( 'Background', 'ova-framework' ),
					'type' 	=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-table .type' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'type_border',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .type',
				]
			);

			$this->add_control(
				'type_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .type' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'type_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .type' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => esc_html__( 'Icon', 'ova-framework' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'color_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .wp-icon .icon i:before',
				]
			);

			$this->start_controls_tabs(
				'icon_tabs'
			);

				$this->start_controls_tab(
					'icon_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'ova-framework' ),
					]
				);

					$this->add_control(
						'icon_color',
						[
							'label' => esc_html__( 'Color', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table .wp-icon .icon i:before' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'icon_background',
						[
							'label' => esc_html__( 'Background', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table .wp-icon .icon i' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'icon_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'ova-framework' ),
					]
				);

					$this->add_control(
						'icon_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .wp-icon .icon i:before' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'icon_background_hover',
						[
							'label' => esc_html__( 'Background', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .wp-icon .icon i' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'icon_weight',
				[
					'label' 		=> esc_html__( 'Weight', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-price-table .wp-icon .icon i' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'icon_border',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .wp-icon .icon i',
				]
			);

			$this->add_control(
				'icon_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .wp-icon .icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .wp-icon .icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'price_style_section',
			[
				'label' => esc_html__( 'Price & Year', 'ova-framework' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'price_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .wp-price .price',
				]
			);

			$this->add_control(
				'price_color',
				[
					'label' => esc_html__( 'Color', 'ova-framework' ),
					'type' 	=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-table .wp-price .price' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'separator_options',
				[
					'label' => esc_html__( 'Separator Options', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'separator_typography',
						'selector' 	=> '{{WRAPPER}} .ova-price-table .wp-price .separator',
					]
				);

				$this->add_control(
					'separator_color',
					[
						'label' => esc_html__( 'Color', 'ova-framework' ),
						'type' 	=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-price-table .wp-price .separator' => 'color: {{VALUE}}',
						],
					]
				);

			$this->add_control(
				'time_options',
				[
					'label' => esc_html__( 'Time Options', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'time_typography',
						'selector' 	=> '{{WRAPPER}} .ova-price-table .wp-price .per_time',
					]
				);

				$this->add_control(
					'time_color',
					[
						'label' => esc_html__( 'Color', 'ova-framework' ),
						'type' 	=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-price-table .wp-price .per_time' => 'color: {{VALUE}}',
						],
					]
				);

			$this->add_control(
				'price_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'separator' 	=> 'before',
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .wp-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'price_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .wp-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__( 'Description', 'ova-framework' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .desc p',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' => esc_html__( 'Color', 'ova-framework' ),
					'type' 	=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-table .desc p' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'description_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'separator' 	=> 'before',
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .desc' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-price-table .desc p' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'description_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .desc' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-price-table .desc p' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Button', 'ova-framework' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .readmore a.text-button',
				]
			);

			$this->start_controls_tabs(
				'button_tabs'
			);

				$this->start_controls_tab(
					'button_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'ova-framework' ),
					]
				);

					$this->add_control(
						'button_color',
						[
							'label' => esc_html__( 'Color', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table .readmore a.text-button' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background',
						[
							'label' => esc_html__( 'Background', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table .readmore a.text-button' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'button_style_active_tab',
					[
						'label' => esc_html__( 'Active', 'ova-framework' ),
					]
				);

					$this->add_control(
						'button_color_active',
						[
							'label' => esc_html__( 'Color', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .readmore a.text-button' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background_active',
						[
							'label' => esc_html__( 'Background', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .readmore a.text-button' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_border_color_active',
						[
							'label' => esc_html__( 'Border Color Hover', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .readmore a.text-button' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'button_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'ova-framework' ),
					]
				);

					$this->add_control(
						'button_color_hover',
						[
							'label' => esc_html__( 'Color', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .readmore a.text-button:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background_hover',
						[
							'label' => esc_html__( 'Background', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .readmore a.text-button:hover' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_border_color_hover',
						[
							'label' => esc_html__( 'Border Color Hover', 'ova-framework' ),
							'type' 	=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-price-table:hover .readmore a.text-button:hover' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'button_border',
					'selector' 	=> '{{WRAPPER}} .ova-price-table .readmore a.text-button',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .readmore a.text-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'button_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .readmore a.text-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'button_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'ova-framework' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-price-table .readmore a.text-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();

		$target 	= $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow 	= $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
	?>
		<div class="ova-price-table">
			<div class="type">
				<h3><?php echo esc_html($settings['type']); ?></h3>
			</div>
			<div class="wp-icon">
				<div class="icon">
					<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
				</div>
			</div>
			<div class="wp-price">
				<span class="price"><?php echo esc_html($settings['price']); ?></span>
				<span class="separator"><?php echo esc_html__('/', 'ova-framework'); ?></span>
				<span class="per_time"><?php echo esc_html($settings['per_time']); ?></span>
			</div>
			<div class="desc"><?php echo $settings['desc']; ?></div>
			<div class="readmore">
				<a href="<?php echo esc_attr($settings['link']['url']); ?>" class="text-button"<?php echo $target.$nofollow; ?>>
					<?php echo esc_html($settings['text_button']); ?>
				</a>
			</div>
		</div>
	<?php
	}
}
