<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class admission_price extends Widget_Base {

	public function get_name() {
		return 'admission_price';
	}

	public function get_title() {
		return __( 'Admission Price', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-sign-in';
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
				'label' => __( 'Admission Price', 'ova-framework' ),
			]
		);

 
			$repeater = new Repeater();

			$repeater->add_control(
				'object',
				[
					'label' => __( 'Oject', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('object', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'price',
				[
					'label' => __( 'Price', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('$12', 'ova-framework'),
				]
			);

			$this->add_control(
				'tabs',
				[
					'label' => __( 'Items', 'ova-framework' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ object }}}',
					'default' => [
						[
							'object' => __( 'Adults', 'ova-framework' ),
							'price' => __( '$25', 'ova-framework' ),
						],
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tabs = $settings['tabs'];
		$id_int = substr( $this->get_id_int(), 0, 3 );
		
	?>
	<div class="admission-price">
		<?php if (!empty($tabs)) : foreach ($tabs as $item) : ?>
		<div class="item-price">
			<div class="con-item">
				<span class="object"><?php echo esc_html($item['object']) ?></span>
				<span class="price"><?php echo esc_html($item['price']) ?></span>
			</div>
		</div>
		<?php endforeach; endif; ?>
	</div>
	
	<?php
	}
}
