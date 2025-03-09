<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_artist extends Widget_Base {

	public function get_name() {
		return 'ova_artist';
	}

	public function get_title() {
		return __( 'Artist', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-info';
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
				'label' => __( 'Artist', 'ova-framework' ),
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
				'name',
				[
					'label' => __( 'Name', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Nimrod Barshad', 'ova-framework'),
				]
			);

			$this->add_control(
				'skill',
				[
					'label' => __( 'Skill', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Painter, Sculptor, Conceptual Artist', 'ova-framework'),
				]
			);

			$this->add_control(
				'phone',
				[
					'label' => __( 'Phone', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('+61 98654 3210', 'ova-framework'),
				]
			);

			$this->add_control(
				'email',
				[
					'label' => __( 'Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('E-mail', 'ova-framework'),
				]
			);

			$this->add_control(
				'link_email',
				[
					'label' => __( 'Link Email', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('someone@example.com', 'ova-framework'),
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
						'{{WRAPPER}} .ova-artist .items-artist' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$target 	= $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow 	= $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
	?>
		<div class="ova-artist">
			<div class="items-artist">
				<a class="img" href="<?php echo esc_attr($settings['link']['url']); ?>"<?php echo $target.$nofollow; ?>>
					<img src="<?php echo esc_attr($settings['image']['url']); ?>" alt="<?php echo esc_html($settings['name']) ?>">
				</a>
				<a class="name second_font" href="<?php echo esc_attr($settings['link']['url']); ?>"<?php echo $target.$nofollow; ?>>
					<?php echo esc_html($settings['name']) ?>
				</a>
				<?php if ($settings['skill'] != '') { ?>
					<div class="skill"> 
						<?php echo esc_html($settings['skill']);  ?>
					</div>
				<?php } ?>
				<div class="contact">
					<?php if ($settings['phone'] != '') { ?>
						<a class="phone" href="tel:<?php echo esc_attr($settings['phone']) ?>" > 
							<?php echo esc_html($settings['phone'] . ' /');  ?>
						</a>
					<?php } ?>
					<?php if ($settings['email'] != '') { ?>
						<a class="email" href="mailto:<?php echo esc_html($settings['link_email']) ?>"> 
							<?php echo esc_html($settings['email']);  ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php
	}
}
