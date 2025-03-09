<?php

namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_heading_page extends Widget_Base {

	public function get_name() {
		return 'ova_heading_page';
	}

	public function get_title() {
		return __( 'Heading Page', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {
			
		$this->start_controls_section(
			'recommend_banner',
			[
				'label' => __('Content','ova-framework')
			]
		);

			$this->add_control(
				'background_banner',
				[
					'label' => __('Background','ova-framework'),
					'type'  => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src()
					]
				]				
			);

			$this->add_control(
				'title_banner',
				[
					'label' => __('Title','ova-framework'),
					'type' => Controls_Manager::TEXT,
					'default' => __('Add Your Heading Text Here', 'ova-framework')
				]
			);

			$this->add_control(
				'recommend_banner_alignment',
				[
					'label' => __( 'Alignment', 'ova-framework' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
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
						'{{WRAPPER}} .heading-page .cta-content h2' => 'text-align: {{VALUE}}',
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_banner_typography',
					'selector' => '{{WRAPPER}} .heading-page .cta-content h2',
				]
			);

			$this->add_control(
				'title_banner_color',
				[
					'label' => __('Title Color','ova-framework'),
					'type'  => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .heading-page .cta-content h2' => 'color: {{VALUE}};'
					]	
				]
			);			

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$background_banner = $settings['background_banner']['url'];
		$title_banner = $settings['title_banner'];

		?>

		<section class="heading-page" <?php if($background_banner != '') : ?>style="background-image: url(<?php echo esc_url($background_banner); ?>)" <?php endif;?>>
			<div class="container">
				<div class="cta-content">
					<?php if( $title_banner != ''){ ?>
						<h2 class="second_font"><?php echo esc_html( $title_banner );?></h2>
					<?php } ?>					
				</div>
			</div>
		</section>

	<?php }

}


