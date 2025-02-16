<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ova_blog extends Widget_Base {

	public function get_name() {
		return 'ova_blog';
	}

	public function get_title() {
		return __( 'Blog', 'ova-framework' );
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

		$args = array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		  );

		$categories=get_categories($args);
		$cate_array = array();
		$arrayCateAll = array( 'all' => 'All categories ' );
		if ($categories) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->slug] = $cate->cat_name;
			}
		} else {
			$cate_array["No content Category found"] = 0;
		}



		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

			$this->add_control(
				'category',
				[
					'label' => __( 'Category', 'ova-framework' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge($arrayCateAll,$cate_array),
				]
			);

			$this->add_control(
				'total_count',
				[
					'label' => __( 'Total Post', 'ova-framework' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 3,
				]
			);

			$this->add_control(
				'number_title',
				[
					'label' => __( 'Number Word Title', 'ova-framework' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 8,
				]
			);

			$this->add_control(
				'number_content',
				[
					'label' => __( 'Number Word Content', 'ova-framework' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 23,
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
				'show_date',
				[
					'label' => __( 'Show Date', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_title',
				[
					'label' => __( 'Show Title', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_content',
				[
					'label' => __( 'Show Content', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_read_more',
				[
					'label' => __( 'Show Reada More', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'ova-framework' ),
					'label_off' => __( 'Hide', 'ova-framework' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

		$this->end_controls_section();
		//END SECTION CONTENT


		//SECTION TAB STYLE DATE
		$this->start_controls_section(
			'section_date',
			[
				'label' => __( 'Date', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .ova-blog .post-content .post-meta-content .post-date',
			]
		);

		$this->add_control(
			'color_date',
			[
				'label' => __( 'Color Date', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-content .post-meta-content .post-date' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE DATE

		//SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ova-blog .post-content h2.title a',
			]
		);

		$this->add_control(
			'color_title',
			[
				'label' => __( 'Color Title', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-content h2.title a' => 'color : {{VALUE}};border-color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_title_hover',
			[
				'label' => __( 'Color Title Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-content h2.title a:hover' => 'color : {{VALUE}};border-color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE

		//SECTION TAB STYLE DESCRIPTION
		$this->start_controls_section(
			'section_desc',
			[
				'label' => __( 'Description', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .ova-blog .post-content .post-body .post-excerpt p',
			]
		);

		$this->add_control(
			'color_desc',
			[
				'label' => __( 'Color Description', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-content .post-body .post-excerpt p' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE DESCRIPTION

		//SECTION TAB STYLE READMORE
		$this->start_controls_section(
			'section_readmore',
			[
				'label' => __( 'Read More', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'selector' => '{{WRAPPER}} .ova-blog .post-content .post-readmore a',
			]
		);

		$this->add_control(
			'color_readmore',
			[
				'label' => __( 'Color Read More', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-content .post-readmore a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_readmore_hover',
			[
				'label' => __( 'Color Read More Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-content .post-readmore a:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE READMORE

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
		
		$category = $settings['category'];
		$total_count = $settings['total_count'];
		$order = $settings['order_by'];

		$number_title = $settings['number_title'] ? $settings['number_title'] : 8;
		$number_content = $settings['number_content'] ? $settings['number_content'] : 23;

		$args = [];
		if ($category == 'all') {
			$args=[
				'post_type' => 'post',
				'posts_per_page' => $total_count,
				'order' => $order,
			];
		} else {
			$args=[
				'post_type' => 'post', 
				'category_name'=>$category,
				'posts_per_page' => $total_count,
				'order' => $order,
			];
		}

		$blog = new \WP_Query($args);

		?>
		<div class="ova-blog">
			<?php
				if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();
					$thumbnail_url = wp_get_attachment_image_url(get_post_thumbnail_id() , 'full' );
			?>
				<article class="blog-content">
					<div class="post-media" style="background-image: url(<?php echo esc_attr($thumbnail_url) ?>)">

			        </div>
			        <div class="post-content">
			        	<?php if ($settings['show_date'] === 'yes') : ?>
			        	<span class="post-meta-content">
						    <span class=" post-date"><?php the_time( get_option( 'date_format' ));?></span>
						</span>
						<?php endif ?>
						<?php if ($settings['show_title'] === 'yes') : ?>
						<div class="post-title">
							<h2 class="title">
								<a href="<?php echo esc_url(the_permalink()) ?>"><?php echo esc_html(muzze_custom_text(get_the_title(), $number_title)); ?></a>
							</h2>
					    </div>
					    <?php endif ?>
					    <?php if ($settings['show_content'] === 'yes') : ?>
				        <div class="post-body">
					    	<div class="post-excerpt">
					            <p><?php echo esc_html(muzze_custom_text(get_the_excerpt(), $number_content)); ?></p>
					        </div>
					    </div>
					    <?php endif ?>
					    <?php if ($settings['show_read_more'] === 'yes') : ?>
					    <div class="post-readmore">
							<a href="<?php echo esc_url(the_permalink()) ?>"><?php esc_html_e('Read more', 'ova-framework') ?></a>
					    </div>
					    <?php endif ?>
			        </div>
				</article>
				
			<?php
				endwhile; endif; wp_reset_postdata();
			?>
		</div>
		<?php
	}
}
