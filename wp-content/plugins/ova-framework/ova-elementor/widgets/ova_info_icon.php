<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_info_icon extends Widget_Base {

	public function get_name() {
		return 'ova_info_icon';
	}

	public function get_title() {
		return __( 'Info Icon', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-info-circle';
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
				'label' => __( 'Info Icon', 'ova-framework' ),
			]
		);

			$this->add_control(
				'version_info_icon',
				[
					'label' => __( 'Choose Version', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'normal' => __('Normal', 'ova-framework'),
						'vertical_type_1' => __('Vertical Type 1', 'ova-framework'),
						'vertical_type_2' => __('Vertical Type 2', 'ova-framework')
					],
					'default' => 'normal',
				]
			);
 
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('flaticon-calendar', 'ova-framework'),
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova_info_icon .icon i:before',
				]
			);

			$this->add_control(
				'color_icon',
				[
					'label' => __( 'Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .icon i:before' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'heading_title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Location', 'ova-framework'),
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova_info_icon .content h3.title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => __( 'Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content h3.title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'heading_desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => __('2270 S Real Camino Lake California, US 90967', 'ova-framework'),
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography',
					'selector' 	=> '{{WRAPPER}} .ova_info_icon .content .desc p',
				]
			);

			$this->add_control(
				'color_desc',
				[
					'label' => __( 'Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .desc p' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'heading_button',
				[
					'label' => __( 'Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Getting Here', 'ova-framework'),
					'condition' => [
						'version_info_icon' => 'normal',
					]
				]
			);



			$this->add_control(
				'text_button_v2',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Getting Here', 'ova-framework'),
					'condition' => [
						'version_info_icon' => 'vertical_type_2',
					]
				]
			);

			$this->add_control(
				'icon_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('arrow_right', 'ova-framework'),
					'condition' => [
						'version_info_icon' => 'vertical_type_1',
					]
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .ova_info_icon .content .readmore a.readmore',
				]
			);

			$this->add_control(
				'color_button',
				[
					'label' => __( 'Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .readmore a.readmore' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'border_color_button',
				[
					'label' => __( 'Color Border', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .readmore a.readmore' => 'border-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_button',
				[
					'label' => __( 'Background Color', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .readmore a.readmore' => 'background-color: {{VALUE}};',
					],
				]
			);



			$this->add_control(
				'color_button_hover',
				[
					'label' => __( 'Color Button Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .readmore a.readmore:hover ' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'border_color_button_hiver',
				[
					'label' => __( 'Color Border Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .readmore a.readmore:hover' => 'border-color : {{VALUE}};',
					],
				]
			);


			$this->add_control(
				'bg_color_button_hover',
				[
					'label' => __( 'Background Color Hover', 'ova-framework' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_info_icon .content .readmore a.readmore:hover' => 'background-color: {{VALUE}};',
					],
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

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$text_button = $icon_button = $class_version = '';

		$target 	= $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow 	= $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

		switch ($settings['version_info_icon']) {
			case 'normal' : {
				$text_button = $settings['text_button'];
				$class_version = 'normal';
				break;
			}
			case 'vertical_type_1' : {
				$icon_button = $settings['icon_button'];
				$class_version = 'vertical_type_1';
				break;
			}
			case 'vertical_type_2' : {
				$text_button = $settings['text_button_v2'];
				$class_version = 'vertical_type_2';
				break;
			}
		}

		
	?>
		<div class="ova_info_icon <?php echo esc_attr($class_version); ?>">
			<?php if(!empty($settings['icon'])) : ?>
			<div class="icon">
				<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
			</div>
			<?php endif ?>
			<div class="content">
				<?php if(!empty($settings['title'])) : ?>
				<h3 class="title"><?php echo esc_html($settings['title']); ?></h3>
				<?php endif ?>
				<?php if(!empty($settings['desc'])) : ?>
				<div class="desc">
					<?php echo $settings['desc'] ?>
				</div>
				<?php endif ?>
				<?php if(!empty($text_button)) : ?>
				<div class="readmore">
					<a href="<?php echo esc_attr($settings['link']['url']) ?>" class="readmore"<?php echo $target.$nofollow; ?>>
						<?php echo esc_html($text_button); ?>
					</a>
				</div>
				<?php endif ?>

				<?php if(!empty($icon_button)) : ?>
				<div class="readmore ">
					<a href="<?php echo esc_attr($settings['link']['url']); ?>" class="readmore"<?php echo $target.$nofollow; ?>>
						<span class="<?php echo esc_attr($icon_button); ?>"></span>
					</a>
				</div>
				<?php endif ?>
			</div>

		</div>
	<?php
	}
}
