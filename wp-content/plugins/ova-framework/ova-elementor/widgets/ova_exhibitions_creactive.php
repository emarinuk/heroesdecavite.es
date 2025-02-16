<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_exhibitions_creactive extends Widget_Base {

	public function get_name() {
		return 'ova_exhibitions_creactive';
	}

	public function get_title() {
		return __( 'Exhibitions Creactive', 'ova-framework' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {

		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

			$this->add_control(
				'total_count',
				[
					'label' => __( 'Number post', 'ova-framework' ),
					'type' => Controls_Manager::TEXT,
					'default' => 4,
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' => __('Order By', 'ova-framework'),
					'type' => Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [
						'asc' => __('ASC', 'ova-framework'),
						'desc' => __('DESC', 'ova-framework'),
					]
				]
			);

			$this->add_control(
				'speed_animate',
				[
					'label' => __( 'Speed Animate', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'description' => "milisecond",
					'default' => 2000,
				]
			);

		$this->end_controls_section();
		//END SECTION CONTENT

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$speed_animate = $settings['speed_animate'] !== '' ? (int)$settings['speed_animate'] : 2000;
		

		$total_count = $settings['total_count'];
		$order = $settings['order_by'];

		$args=[
			'post_type' => 'exhibition',
			'posts_per_page' => $total_count,
			'order' => $order,
			'meta_key' => 'ovaex_special',
			'meta_query'=> array(
		        array(
		            'key' => 'ovaex_special', // this key will change!
		            'compare' => '=',
		            'value' => 'checked',
		        )
		    ),
		];

		$exhibitions = new \WP_Query($args);

		?>

		<div class="ova-exhibitions-creactive">
			<?php $i = 0; $j = 0; if ($exhibitions->have_posts()) : while ($exhibitions->have_posts()) : $exhibitions->the_post();
				$thumbnail_url  = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');
				$background_img = $thumbnail_url !== "" ? "background-image: url(".$thumbnail_url.")" : "";

				$ex_time_type      = get_post_meta( get_the_ID(), 'ex_time_type', true );
				$ex_time_tba       = get_post_meta( get_the_ID(), 'ex_time_tba', true );
				$ex_start_date_int = get_post_meta( get_the_ID(), 'ex_start_date', true );
				$ex_end_date_int   = get_post_meta( get_the_ID(), 'ex_end_date', true );

				$date_day_start   = $date_day_end = "";
				$format_date_day  = "d M Y";
				$format_date_time = "H:i";

				if ($ex_start_date_int != "") {
					$date_day_start = date_i18n($format_date_day, $ex_start_date_int);
				}

				if ($ex_end_date_int != "") {
					$date_day_end = date_i18n($format_date_day, $ex_end_date_int);
				}

				if ($date_day_start === $date_day_end && $date_day_start !== "" && $date_day_end !== "") {
					$time_display = $date_day_start . esc_html__(': ', 'ova-framework') . date_i18n($format_date_time,$ex_start_date_int) . esc_html__(' - ', 'ova-framework') . date_i18n($format_date_time,$ex_end_date_int);
				} else {
					$time_display = $date_day_start . esc_html__(' - ', 'ova-framework') . $date_day_end;
				}

				if ($date_day_start === "" && $date_day_end === "") {
					$time_display = "";
				}

				$i++;
				$class_odd_even = "";

				if (( $i % 2 ) === 0) {
					$speed_animate += 100;
				}
			?>

			<?php 
				if ( ( $i % 2 ) !== 0 ) : 
					$j++;
					$class_odd_even = ($j % 2) === 0 ? " even " : " odd ";
			?>

			<div class="ova-row <?php echo esc_attr($class_odd_even); ?>">
			<?php endif; ?>
				<article class="item-exhibition fadeInUp-scroll" style= "transition:<?php echo esc_attr($speed_animate) ?>ms;">
					<div class="exhibition-con">
						<a class="image-box" href="<?php echo esc_attr(the_permalink()) ?>" style="<?php echo esc_attr($background_img) ?>">
							<img src="<?php echo esc_attr($thumbnail_url) ?>" alt="<?php echo esc_attr(the_title()) ?>">
						</a>
						<div class="content">
							<h2 class="title"><a class="second_font" href="<?php echo esc_attr(the_permalink()) ?>"><?php echo esc_html(the_title()) ?></a></h2>
							<?php if($ex_time_type == 'tba') { ?>
								<div class="date">
									<p><?php echo esc_html($ex_time_tba);?></p>
								</div>
							<?php } else { ?>
								<?php if ($time_display != "") : ?>
									<div class="date">
										<p><?php echo esc_html($time_display) ?></p>
									</div>
								<?php endif ?>
							<?php } ?>
						</div>
					</div>
				</article>
				<?php if ( ( $i % 2 ) === 0 ) : 
					$speed_animate -= 100;
				?>
			</div>
			<?php endif; ?>
				
			<?php endwhile; endif; wp_reset_postdata(); ?>
			
		</div>
		
		<?php
	}
}
