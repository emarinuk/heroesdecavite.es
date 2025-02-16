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


class ova_muzze_according extends Widget_Base {

	public function get_name() {
		return 'ova_muzze_according';
	}

	public function get_title() {
		return __( 'Muzze According', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-accordion';
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
				'label' => __( 'Muzze According', 'ova-framework' ),
			]
		);

			$this->add_control(
				'is_faq',
				[
					'label' => __( 'Type Faq Page', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);

			$this->add_control(
				'is_visit',
				[
					'label' => __( 'Type Visit Page', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);

 
			$repeater = new Repeater();

			$repeater->add_control(
				'open',
				[
					'label' => __( 'Open', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Title', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'sub_title',
				[
					'label' => __( 'Sub Title', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Sub Title', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'content',
				[
					'label' => __( 'Content', 'ova-framework' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __('Content', 'ova-framework'),
					'placeholder' => __( 'Type your content here', 'ova-framework' ),
				]
			);


			$repeater->add_control(
				'link',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( '#', 'ova-framework' ),
					'show_external' => true,
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);

			$repeater->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Apply Now', 'ova-framework'),
				]
			);


			$this->add_control(
				'tabs_muzze_according',
				[
					'label' => __( 'Items', 'ova-framework' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_control(
				'margin_bottom',
				[
					'label' => __( 'Marin Bottom', 'ova-framework' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .ova_muzze_according .accor-muzze-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		// end tab section_content

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tabs_content = $settings['tabs_muzze_according'];
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$class_faq = ($settings['is_faq'] === 'yes') ? ' ova-faq ' : '';
		$class_visit = ($settings['is_visit'] === 'yes') ? ' ova-visit ' : '';
	?>

	<div class="ova_muzze_according wp-ova-according-<?php echo esc_attr($id_int) ?>">
		<?php
			if (!empty($tabs_content)) :
				$i=$id_int;
				foreach ($tabs_content as $item) :
					$i++;
					if ($item['open'] == 'yes') {
						$class_active = " active show ";
					} else {
						$class_active = " hide ";
					}

					$target = ($item['link']['is_external'] == 'on') ? 'target="_blank"' : '';
					$nofollow = ($item['link']['nofollow'] == 'on') ? 'rel="nofollow"' : '';

					?>
					<div class="accor-muzze-content <?php echo esc_attr($class_faq) . esc_attr($class_visit) . esc_attr($class_active) ?>">
						<div class="wp-title" data-option="<?php echo esc_attr($id_int) ?>">
							<span class="title" ><?php echo esc_html($item['title']) ?></span>
							<?php if(!empty($item['sub_title'])) : ?>
								<span class="sub-title"><?php echo esc_html($item['sub_title']) ?></span>
							<?php endif ?>
							<span class="icon-accor" ><i class="fa fa-angle-down" id="<?php echo esc_attr($i) ?>" ></i></span>
						</div>
						<div id="slide-<?php echo esc_attr($i) ?>" class="content " >
							<?php if (!empty($item['content'])) : ?>
								<div class="item-conten">
									<?php echo $item['content'] ?>
								</div>
							<?php endif ?>

							<?php if(!empty($item['text_button'])) : ?>
								<a class="button-text" href="<?php echo esc_attr($item['link']['url']) ?>" <?php echo $target.' '.$nofollow; ?> >
									<?php echo esc_html($item['text_button']) ?>
								</a>
							<?php endif ?>

						</div>
					</div>
					<?php
				endforeach;
			endif;
		?>
	</div>
	<?php
	}
}
