<?php

namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\REPEATER;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_home_fullscreen extends Widget_Base {


	public function get_name() {
		return 'ova_home_fullscreen';
	}

	public function get_title() {
		return __( 'Muzze Full Screen', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'fullpage-css', OVA_PLUGIN_URI.'assets/libs/fullPage/fullpage.min.css' );
		wp_enqueue_script( 'fullpage-js', OVA_PLUGIN_URI.'assets/libs/fullPage/fullpage.extensions.min.js', array('jquery'), false, true );
		return [ 'script-elementor' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

			$repeater = new Repeater();

			$repeater->add_control(
				'program',
				[
					'label'   => __('Program','ova-framework'),
					'type'    => Controls_Manager::TEXT,
					'description' => __('Ex: Upcoming Exhibition or Currently Onview','ova-framework')
				]
			);
			$repeater->add_control(
				'background_img',
				[
					'label' => __( 'Background', 'ova-framework' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'title_event',
				[
					'label' => __('Title','ova-framework'),
					'type'  => Controls_Manager::TEXTAREA
				]
			);

			$repeater->add_control(
				'title_link',
				[
					'label'         => __( 'Link', 'ova-framework' ),
					'type'          => Controls_Manager::URL,
					'placeholder'   => __( 'https://your-link.com', 'ova-framework' ),
					'show_external' => true,
					'default'       => [
					'url'           => '',
					'is_external'   => false,
					'nofollow'      => false,
					],
				]
			);

			$repeater->add_control(
				'date_event',
				[
					'label' => __('Date Event','ova-framework'),
					'type' => Controls_Manager::TEXTAREA,
					'description' => __('Add Your Date, Time Event, Venue. Ex: From 13 Oct 2018 Until 15 Feb 2019 or 12:00pm - 5:00pm / Western Avenue, Allston, MA','ova-framework'),
				]
			);

			$this->add_control(
			'list_event',
			[
				'label' => __( 'Add Event', 'ova-framework' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title_event' => __('Joey Frank: Seeker An The Trick','ova-framework'),
					],
					[
						'title_event' => __('Berthe Morisot: Woman Impressionist','ova-framework'),											
					],
					[
						'title_event' => __('The Upstairs Room of a Art Taminiau','ova-framework'),
					],
					[
						'title_event' => __('Rough Cut: Independent Japanese Antiquity','ova-framework'),
					],
					[
						'title_event' => __('Living Proof: Drawing in 20th-Century','ova-framework'),
					]
				],
			]
		);
			
		$this->end_controls_section();

		// Label
		$this->start_controls_section(
			'section_label_type',
			[
				'label' => __( 'Label Program', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'label_type_typography',
					'label'    => __( 'Typography', 'ova-framework' ),
					'selector' => '{{WRAPPER}} #fullpage .content span.type',
				]
			);

			$this->add_control(
				'label_type_color',
				[
					'label'     => __( 'Label Type Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} #fullpage .content span.type' => 'color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

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
					'selector' => '{{WRAPPER}} #fullpage .content h3',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => __( 'Title Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} #fullpage .content h3 a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_hover_color',
				[
					'label'     => __( 'Title Hover Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} #fullpage .content h3 a:hover' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} #fullpage .content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_times',
			[
				'label' => __( 'Label Date/Time', 'ova-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'label_time_typography',
					'label'    => __( 'Typography', 'ova-framework' ),
					'selector' => '{{WRAPPER}} #fullpage .content .time-event span',
				]
			);

			$this->add_control(
				'label_date_time_color',
				[
					'label'     => __( 'Label Date/Time Color', 'ova-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} #fullpage .content .time-event span' => 'color: {{VALUE}};',
					],
				]
			);


		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings();
 
		?>
			
	    <div id="fullpage">
			<?php 
				$item = 0;
				foreach( $settings['list_event'] as $value ) : ?>
				<div class="section" id="<?php echo 'item-'.$item; ?>" style="background-image: url(<?php echo esc_url($value['background_img']['url']);?>);">
					<?php 

						$date_event = $value['date_event'] != '' ? $value['date_event'] : '';

						$target   = $value['title_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $value['title_link']['nofollow'] ? ' rel="nofollow"' : '';

					?>
					<div class="content_width">
						<div class="content">
							<span class="type"><?php echo esc_html($value['program']);?></span>
							<h3 class="second_font"><a href="<?php echo esc_url($value['title_link']['url']);?>" <?php echo $target . $nofollow;?>><?php echo esc_html($value['title_event']);?></a></h3>
							<div class="time-event">
								<?php if( $date_event != '') : ?>
								<span><?php echo esc_html($date_event);?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php $item++;endforeach; ?>
	    </div>			

	<?php }
}
