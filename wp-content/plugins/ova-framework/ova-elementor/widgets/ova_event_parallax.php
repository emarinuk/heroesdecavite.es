<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_event_parallax extends Widget_Base {

	public function get_name() {
		return 'ova_event_parallax';
	}

	public function get_title() {
		return __( 'Event Parallax', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
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

		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);
			$this->add_control(
				'category',
				[
					'label'   => __( 'Category', 'ova-framework' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge( $catAll, $cate_array )
				]
			);

			$this->add_control(
				'total_count',
				[
					'label' => __( 'Number post', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => 4,
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' => __('Order By', 'ova-framework'),
					'type' => Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [
						'asc' => __('ASC', 'ova-framework'),
						'desc' => __('DESC', 'ova-framework'),
					]
				]
			);

			$this->add_control(
				'readmore',
				[
					'label' => __( 'Text Read More', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __("Learn More", "'ova-framework"),
				]
			);

		$this->end_controls_section();
		//END SECTION CONTENT

		// section style //

		// Title style
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'label'    => __( 'Typography', 'ova-framework' ),
					'selector' => '{{WRAPPER}} .ova-event-parallax .item-event .content .title a',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => __( 'Title Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .title a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_hover_color',
				[
					'label'     => __( 'Title Hover Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .title a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_magin',
				[
					'label'      => __( 'Title Margin', 'ova-framework' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

		$this->end_controls_section();

		// DATE style
		$this->start_controls_section(
			'section_date_style',
			[
				'label' => __( 'Date', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'date_typography',
					'label'    => __( 'Typography', 'ova-framework' ),
					'selector' => '{{WRAPPER}} .ova-event-parallax .item-event .content .date p',
				]
			);

			$this->add_control(
				'date_color',
				[
					'label'     => __( 'Date Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .date p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'date_magin',
				[
					'label'      => __( 'Title Margin', 'ova-framework' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

		$this->end_controls_section();

		// Excerpt style
		$this->start_controls_section(
			'section_excerpt_style',
			[
				'label' => __( 'Excerpt', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'excerpt_typography',
					'label'    => __( 'Typography', 'ova-framework' ),
					'selector' => '{{WRAPPER}} .ova-event-parallax .item-event .content .desc p',
				]
			);

			$this->add_control(
				'excerpt_color',
				[
					'label'     => __( 'Excerpt Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .desc p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'excerpt_magin',
				[
					'label'      => __( 'Title Margin', 'ova-framework' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

		$this->end_controls_section();

		// read more
		$this->start_controls_section(
			'section_read_more_style',
			[
				'label' => __( 'Read More', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'read_more_typography',
					'label' => __( 'Typography', 'ova-framework' ),
					'selector' => '{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a',
				]
			);

			$this->add_responsive_control(
				'read_more_padding',
				[
					'label' => __( 'Read More Padding', 'ova-framework' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'read_more_margin',
				[
					'label' => __( 'Read More Margin', 'ova-framework' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );
				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => __( 'Normal', 'ova-framework' ),
					]
				);

				$this->add_control(
					'read_more_text_color',
					[
						'label' => __( 'Text Color', 'ova-framework' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'read_more_background_color',
					[
						'label' => __( 'Background Color', 'ova-framework' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->end_controls_tab();

				// Tab button hover
				$this->start_controls_tab(
					'tab_button_hover',
					[
						'label' => __( 'Hover', 'ova-framework' ),
					]
				);

					$this->add_control(
						'hover_color',
						[
							'label' => __( 'Text Color', 'ova-framework' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_background_hover_color',
						[
							'label' => __( 'Background Color', 'ova-framework' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a:hover' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'button_hover_border_color',
						[
							'label' => __( 'Border Color', 'ova-framework' ),
							'type' => Controls_Manager::COLOR,
							'condition' => [
								'border_border!' => '',
							],
							'selectors' => [
								'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a:hover' => 'border-color: {{VALUE}};',
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
					'selector' => '{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'border_radius',
				[
					'label' => __( 'Border Radius', 'ova-framework' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-event-parallax .item-event .content .readmore a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$settings = $this->get_settings_for_display();

		if( $settings['category'] == 'all'){
			$args= array(
				'post_type' => 'event',
			 	'post_status' => 'publish',
				'order' => $settings['order_by'],
			 	'posts_per_page' => $settings['total_count']
		 	);
		} else {
			$args= array(
				'post_type' => 'event',
			 	'post_status' => 'publish',
		 	 	'tax_query' => array(
					array(
						'taxonomy' => 'event_type',
						'field'    => 'slug',
						'terms'    => $settings['category'],
					)
				),
				'order' => $settings['order_by'],
			 	'posts_per_page' => $settings['total_count']
		 	);
		}

		$events = new \WP_Query($args);


		?>
		<div class="ova-event-parallax">
			<?php
				$i = 0;
				if ($events->have_posts()) : while ($events->have_posts()) : $events->the_post();
					$thumbnail_url = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');

					$background_img = $thumbnail_url !== "" ? "background-image: url(".$thumbnail_url.")" : "";

					$ovaev_venue      = get_post_meta( get_the_ID(), 'ovaev_venue', true );
					$ovaev_start_date_int = get_post_meta( get_the_ID(), 'ovaev_start_date', true );
					$ovaev_end_date_int   = get_post_meta( get_the_ID(), 'ovaev_end_date', true );

					$date_day_start = $date_day_end = "";
					$format_date_day = "d M Y";
					$format_date_time = "H:i";
					if ($ovaev_start_date_int != "") {
						$date_day_start = date_i18n($format_date_day, $ovaev_start_date_int);
					}

					if ($ovaev_end_date_int != "") {
						$date_day_end = date_i18n($format_date_day, $ovaev_end_date_int);
					}

					if ($date_day_start === $date_day_end && $date_day_start !== "" && $date_day_end !== "") {
						$time_display = $date_day_start.": " . date_i18n($format_date_time,$ovaev_start_date_int) . " - " . date_i18n($format_date_time,$ovaev_end_date_int);
					} elseif ($date_day_start === "" && $date_day_end !== "") {
						$time_display = $date_day_end;
					} elseif($date_day_end === "" && $date_day_start !== "") {
						$time_display = $date_day_start;
					} else{
						$time_display = esc_html('From ', 'ova-framework') . $date_day_start . esc_html(' until ', 'ova-framework') . $date_day_end;
					}

					if ($date_day_start === "" && $date_day_end === "") {
						$time_display = "";
					}
					if ($time_display !== "" && $ovaev_venue !== "") {
						$time_display = $time_display . esc_html(' - ', 'ova-framework') . $ovaev_venue ;
					} elseif ($time_display !== ""){
						$time_display = $time_display;
					} elseif ($ovaev_venue !== "") {
						$time_display = $ovaev_venue;
					}

					$i++;
					$class_odd_even = ($i % 2) !== 0  ? " odd " : " even ";



			?>

				<article class="item-event <?php echo esc_attr($class_odd_even) ?> ">
						<div class="image-box" style="<?php echo esc_attr($background_img) ?>">
							
						</div>
						<div class="image-box-mobile">
							<img src="<?php echo esc_attr($thumbnail_url) ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
						</div>
						<div class="content">
							<h2 class="title"><a class="second_font" href="<?php echo esc_attr(the_permalink()) ?>"><?php echo esc_html(the_title()) ?></a></h2>
							<?php if ($time_display != "") : ?>
							<div class="date">
								<p><?php echo esc_html($time_display) ?></p>
							</div>
							<?php endif ?>
							<div class="desc">
								<p><?php echo esc_html(muzze_custom_text(get_the_excerpt(), 18)); ?></p>
							</div>
							<div class="readmore">
								<a href="<?php echo esc_attr(the_permalink()) ?>"><?php echo esc_html($settings['readmore']) ?></a>
							</div>
						</div>
				</article>
				
				<?php
					endwhile; endif;
					wp_reset_postdata();
				?>
			
		</div>
		
		<?php
	}
}
