<?php
namespace ova_framework\Widgets;
use Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class ova_search extends Widget_Base {

	public function get_name() {
		return 'ova_search';
	}

	public function get_title() {
		return __( 'Search', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-search';
	}

	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_keywords() {
		return [ 'search' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_search',
			[
				'label' => __( 'Search', 'ova-framework' ),
			]
		);

		$this->add_control(
			'search_image',
			[
				'label' => __( 'Choose Image', 'ova-framework' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'search_w',
			[
				'label' => __( 'Icon Search Width', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 19,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap_search_muzze_popup img.icon-search' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'search_h',
			[
				'label' => __( 'Icon Search Height', 'ova-framework' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .wrap_search_muzze_popup img.icon-search' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);						

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();

		if ( empty( $settings['search_image']['url'] ) ) {
			return;
		}

		?>
		<div class="wrap_search_muzze_popup">
			<!-- <i class="flaticon-search"></i> -->
			<img src="<?php echo esc_url( $settings['search_image']['url'] ); ?>" alt="search" class="icon-search" />
			<div class="search_muzze_popup">
				<span class="btn_close icon_close"></span>
				<div class="container">

					<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
					        <input type="search" class="search-field" placeholder="<?php echo esc_attr_e( 'Search …', 'ova-framework' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_e( 'Search for:', 'ova-framework' ) ?>" />
			   			 	<input type="submit" class="search-submit" value="<?php echo esc_attr_e( 'Search', 'ova-framework' ) ?>" />
					</form>
										
				</div>
			</div>
		</div>
		<?php
	}

}

