<?php
namespace ova_framework\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_time_countdown extends Widget_Base {

	public function get_name() {
		return 'ova_time_countdown';
	}

	public function get_title() {
		return __( 'Time Countdown', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-clock-o';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'jquery-countdown-plugin', OVA_PLUGIN_URI.'/assets/libs/jquery-countdown/jquery.plugin.min.js', array(), null );
        wp_enqueue_script( 'jquery-countdown', OVA_PLUGIN_URI.'/assets/libs/jquery-countdown/jquery.countdown.min.js', array(), null );
        
        $language =  get_theme_mod( 'choice_language' );
        if ($language != '') {
            wp_enqueue_script( 'jquery-countdown-', OVA_PLUGIN_URI.'/assets/libs/jquery-countdown/jquery.countdown-'.$language.'.js', array(), null );
        }
		return [ 'script-elementor' ];
	}

	protected function register_controls() {

		


		/*************** Section Countdouwn Offers ***************/
		$this->start_controls_section(
			'section_countdown',
			[
				'label' => __( 'Countdown', 'ova-framework' ),
			]
		);
			$this->add_control(
				'due_date',
				[
					'label' => __( 'Due Date', 'ova-framework' ),
					'type' => Controls_Manager::DATE_TIME,
					'default' => date_i18n( 'Y-m-d H:i', strtotime( '+1 day' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
					'description' => sprintf( __( 'Date set according to your timezone: %s.', 'ova-framework' ), Utils::get_timezone_string() ),
					'separator' => 'after',
				]
			);

			$this->add_control(
				'number_countdown',
				[
					'label' => __( 'Number', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'number_countdown_typo',
					'selector' => '{{WRAPPER}} .ova_time_countdown .due_date .countdown-amount',
				]
			);

			$this->add_control(
				'number_countdown_color',
				[
					'label' => __( 'Color', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .due_date .countdown-section .countdown-amount' => 'color: {{VALUE}}',
					],
				]
			);


			$this->add_control(
				'label_countdown',
				[
					'label' => __( 'Label', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'label_typo',
					'selector' => '{{WRAPPER}} .ova_time_countdown .due_date .countdown-period',
				]
			);

			$this->add_control(
				'period_color',
				[
					'label' => __( 'Color', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .due_date .countdown-period' => 'color: {{VALUE}}',
					],
				]
			);


			$this->add_control(
				'label_background',
				[
					'label' => __( 'Background', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'background_time',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown' => 'background-color: {{VALUE}}',
					],
				]
			);



			$this->add_control(
				'show_days',
				[
					'label' => __( 'Days', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'default' => 'yes',
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .due_date .countdown-section:nth-child(1)' => 'display: inline-block;',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'show_hours',
				[
					'label' => __( 'Hours', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'default' => 'yes',
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .due_date .countdown-section:nth-child(2)' => 'display: inline-block;',
					],
				]
			);

			$this->add_control(
				'show_minutes',
				[
					'label' => __( 'Minutes', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'default' => 'yes',
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .due_date .countdown-section:nth-child(3)' => 'display: inline-block;',
					],
				]
			);

			$this->add_control(
				'show_seconds',
				[
					'label' => __( 'Seconds', 'ova-framework' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'default' => 'yes',
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .due_date .countdown-section:nth-child(4)' => 'display: inline-block;',
					],
				]
			);

			$this->add_responsive_control(
				'spacing_countdown',
				[
					'label' => __( 'Spacing', 'ova-framework' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova_time_countdown .countdown-section:not(:last-child) ' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
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
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_section();

		
	}
	protected function render() {
		$settings = $this->get_settings();
		$due_date = $settings['due_date'];
		?>
		<div class="ova_time_countdown">
			<div class="due_date" data-day="<?php echo $due_date; ?>"></div>
		</div>
		<?php
	}
}