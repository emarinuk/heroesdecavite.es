<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_image_muzze extends Widget_Base {

	public function get_name() {
		return 'ova_image_muzze';
	}

	public function get_title() {
		return __( 'Muzze Image', 'ova-framework' );
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
			'section_version_info',
			[
				'label' => __( 'Version Info', 'ova-framework' ),
			]
		);
			$this->add_control(
				'version',
				[
					'label' => __( 'Choose Type Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'version_1',
					'options' => [
						'version_1' => __( 'Version 1', 'ova-framework' ),
						'version_2' => __( 'Version 2', 'ova-framework' ),
					],
				]
			);
		$this->end_controls_section();

		//version 1
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
				'condition' => [
					'version' => 'version_1',
				]
			]
		);

			$this->add_control(
				'image',
				[
					'label' => __( 'Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);

			

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'show_external' => false,
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Modern Art', 'ova-framework'),
				]
			);


			$this->add_control(
				'background_color',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content

		//version 2
		$this->start_controls_section(
			'section_content_ver_2',
			[
				'label' => __( 'Content', 'ova-framework' ),
				'condition' => [
					'version' => 'version_2',
				]
			]
		);

			$this->add_control(
				'image_ver_2',
				[
					'label' => __( 'Image', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);

			

			$this->add_control(
				'link_ver_2',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'show_external' => false,
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Plan Your Visit', 'ova-framework'),
				]
			);

		$this->end_controls_section();
		// end tab section_content
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$version = $settings['version'];
		$target 	= isset( $settings['link']['is_external'] ) && $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow 	= isset( $settings['link']['nofollow'] ) && $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		$target_2 	= isset( $settings['link_ver_2']['is_external'] ) && $settings['link_ver_2']['is_external'] ? ' target="_blank"' : '';
		$nofollow_2 = isset( $settings['link_ver_2']['nofollow'] ) && $settings['link_ver_2']['nofollow'] ? ' rel="nofollow"' : '';
	?>
		<?php if ($version == 'version_1') : ?>
			<div class="ova-image-muzze <?php echo esc_attr($version) ?>">
				<div class="image">
					<a href="<?php echo esc_attr($settings['link']['url']) ?>" <?php echo $target . ' ' . $nofollow ?>>
						<img src="<?php echo esc_attr($settings['image']['url']) ?>" alt="<?php echo esc_html($settings['text_button']) ?>">
					</a>
				</div>
				<div class="text-button">
					<a href="<?php echo esc_attr($settings['link']['url']) ?>" <?php echo $target . ' ' . $nofollow ?>><?php echo esc_html($settings['text_button']) ?></a>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($version == 'version_2') : ?>
			<div class="ova-image-muzze <?php echo esc_attr($version) ?>">
				<div class="image">
					<a href="<?php echo esc_attr($settings['link_ver_2']['url']) ?>" <?php echo $target_2 . ' ' . $nofollow_2 ?>>
						<img src="<?php echo esc_attr($settings['image_ver_2']['url']) ?>" alt="<?php echo esc_attr($settings['desc'])?>">
						<span class="desc"><?php echo esc_html($settings['desc']) ?></span>
					</a>
				</div>
			</div>
		<?php endif; ?>
	<?php
	}
}
