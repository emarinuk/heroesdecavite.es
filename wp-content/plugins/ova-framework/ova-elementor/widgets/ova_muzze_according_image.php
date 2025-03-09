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


class ova_muzze_according_image extends Widget_Base {

	public function get_name() {
		return 'ova_muzze_according_image';
	}

	public function get_title() {
		return __( 'Muzze According Image', 'ova-framework' );
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
				'wp_title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Lunch break', 'ova-framework'),
				]
			);

			$this->add_control(
				'wp_time',
				[
					'label' => __( 'Time', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('2:00pm', 'ova-framework'),
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
				'time',
				[
					'label' => __( 'Time', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('12:30pm', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' => __( 'Title', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Innovation & Technology', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'name',
				[
					'label' => __( 'Name', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Linda M. Dugan', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'job',
				[
					'label' => __( 'Job', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => __('Director', 'ova-framework'),
				]
			);

			$repeater->add_control(
				'content',
				[
					'label' => __( 'Content', 'ova-framework' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __('We care for more than 200 thousand exhibits spanning billions of years and welcome more than five million way
visitors annually.', 'ova-framework'),
					'placeholder' => __( 'Type your content here', 'ova-framework' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label' => __( 'Image', 'ova-framework' ),
					'type' => Controls_Manager::MEDIA,
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
					'default' => __('Convention Center, Hilton Hotel', 'ova-framework'),
				]
			);


			$this->add_control(
				'tabs_muzze_according_image',
				[
					'label' => __( 'Items', 'elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();
		// end tab section_content

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tabs_content = $settings['tabs_muzze_according_image'];
		$id_int = substr( $this->get_id_int(), 0, 3 );

	?>

	<div class="ova_muzze_according_image wp-ova-according-<?php echo esc_attr($id_int) ?>">
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
					$img_src = wp_get_attachment_image_src( $item['image']['id'], 'thumbnail' );

					$target 	= $item['link']['is_external'] ? ' target="_blank"' : '';
					$nofollow 	= $item['link']['nofollow'] ? ' rel="nofollow"' : '';
					?>
					<div class="accor-muzze-content-image <?php echo esc_attr($class_active) ?>">
						<div class="wp-time">
							<span><?php echo esc_html($item['time']) ?></span>
						</div>
						<div class="wp-content">
							<div class="thumb_image">
								<img src="<?php echo isset( $img_src[0] ) ? esc_url( $img_src[0] ) : ''; ?>" alt="<?php echo esc_attr($item['title']); ?>">
							</div>
							<div class="sub-content">
								<div class="wp-title" data-option="<?php echo esc_attr($id_int) ?>">
									<span class="title" ><?php echo esc_html($item['title']) ?></span>
									<?php if($item['name'] != "") : ?>
										<span class="name"><?php echo esc_html($item['name']) . esc_html__(',','ova-framework') ?></span>
									<?php endif ?>
									<?php  if($item['job'] != "") : ?>
										<span class="job"><?php echo esc_html($item['job']) ?></span>
									<?php endif ?>
									<span class="icon-accor" ><i class="fa fa-angle-down" id="<?php echo esc_attr($i) ?>" ></i></span>
								</div>
								<div id="slide-<?php echo esc_attr($i) ?>" class="content " >
									<?php if ($item['content'] != "") : ?>
										<div class="item-conten">
											<?php echo $item['content'] ?>
										</div>
									<?php endif ?>
									<?php if($item['text_button'] != "") : ?>
										<a class="button-text" href="<?php echo esc_attr($item['link']['url']); ?>"<?php echo $target.$nofollow; ?>>
											<?php echo esc_html($item['text_button']); ?>
										</a>
									<?php endif ?>
								</div>
							</div>
							<!-- end sub-content -->
						</div>
						<!-- end wp-content -->
					</div>
					<?php
				endforeach;
			endif;
		?>
		<?php if ($settings['wp_time'] != '' || $settings['wp_title'] != "") : ?>
		<div class="time-title">
			<div class="time">
				<span><?php echo esc_html($settings['wp_time']) ?></span>
			</div>
			<div class="title-element">
				<span><?php echo esc_html($settings['wp_title']) ?></span>
			</div>
		</div>
		<?php endif ?>
	</div>
	<?php
	}
}
