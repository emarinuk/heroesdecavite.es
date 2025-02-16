<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_muzze_shop extends Widget_Base {


	public function get_name() {
		return 'ova_muzze_shop';
	}


	public function get_title() {
		return __( 'Muzze Shop', 'ova-framework' );
	}


	public function get_icon() {
		return 'eicon-products';
	}


	public function get_categories() {
		return [ 'ovatheme' ];
	}


	public function get_script_depends() {
		return [ 'script-elementor' ];
	}

	protected function register_controls() {

		$categories = get_categories(
                array(
                'type'                     => 'product',
                'child_of'                 => 0,
                'parent'                   => '',
                'orderby'                  => 'name',
                'order'                    => 'ASC',
                'hide_empty'               => 1,
                'hierarchical'             => 1,
                'exclude'                  => '',
                'include'                  => '',
                'number'                   => '',
                'taxonomy'                 => 'product_cat',
                'pad_counts'               => false 

              )
     	);
		$term_ids = array();
		$catAll = array( 'all' => 'All categories');
		if ($categories) {
			foreach ( $categories as $cate ) {				
			    $term_ids[$cate->slug] = $cate->cat_name;
			}
		}else {
			$term_ids["No content Category found"] = 0;
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-framework' ),
			]
		);

			
			$this->add_control(
				'category',
				[
					'label'       => __( 'Select Category', 'ova-framework' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'all',
					'options'     => array_merge( $catAll, $term_ids ),
				]
			);

			$this->add_control(
				'product_featured',
				[
					'label'        => __('Show Featured Product','ova-framework'),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'ova-framework' ),
					'label_off'    => __( 'Hide', 'ova-framework' ),
					'return_value' => 'yes',
					'default'      => 'no',
 				]
			);

			$this->add_control(
				'show_price',
				[
					'label'        => __('Show Price','ova-framework'),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'ova-framework' ),
					'label_off'    => __( 'Hide', 'ova-framework' ),
					'return_value' => 'yes',
					'default'      => 'yes',
 				]
			);

			$this->add_control(
				'order',
				[
					'label'   => __( 'Order', 'ova-framework' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => __( 'Descending', 'ova-framework' ),
						'ASC'  => __( 'Ascending', 'ova-framework' ),
						
					],

				]
			);

			$this->add_control(
				'total_items_cat',
				[
					'label'       => __( 'Total items in each category', 'ova-framework' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => __( 'Insert -1 to display all items in category', 'ova-framework' ),
					'min'         => -1,
					"default"     => 4
				]
			);

			$this->add_control(
				'number_product_on_row',
				[
					'label'   => __( 'Number Product on row', 'ova-framework' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'pr4_columns',
					'options' => [
						'pr2_columns' => __( '2 Product', 'ova-framework' ),
						'pr3_columns' => __( '3 Product', 'ova-framework' ),
						'pr4_columns' => __( '4 Product', 'ova-framework' ),
					],
				]
			);

		$this->end_controls_section();

		//Tab Style

		$this->start_controls_section(
			'section_muzze_cat_title',
			[
				'label' => __( 'Title', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_room_cat_typography',
				'selector' => '{{WRAPPER}} .muzze_shop .content_product .items h3',
			]
		);

		$this->add_control(
			'title_muzze_cat_color',
			[
				'label' => __( 'Title Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .content_product .items h3 a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_muzze_cat_hover_color',
			[
				'label' => __( 'Title Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .content_product .items h3 a:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_muzze_cat_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .content_product .items h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_muzze_cat_price',
			[
				'label' => __( 'Price', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_room_cat_typography',
				'selector' => '{{WRAPPER}} .muzze_shop .content_product .items span.amount',
			]
		);

		$this->add_control(
			'price_muzze_cat_color',
			[
				'label' => __( 'Price Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .content_product .items span.amount' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_muzze_cat_hover_color',
			[
				'label' => __( 'Price Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .content_product .items span.amount:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_muzze_cat_bt',
			[
				'label' => __( 'Button View All', 'ova-framework' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_bt_typography',
				'selector' => '{{WRAPPER}} .muzze_shop .return_shop .btn_shop',
			]
		);

		$this->add_control(
			'muzze_bt_color',
			[
				'label' => __( 'Button Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'muzze_bt_hover_color',
			[
				'label' => __( 'Button Color Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'muzze_bt_background',
			[
				'label' => __( 'Button Background', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop' => 'background : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'muzze_bt_background_hover',
			[
				'label' => __( 'Button Background Hover', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop:hover' => 'background : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'muzze_bt_border_color',
			[
				'label' => __( 'Button Border Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop' => 'border-color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'muzze_bt_border_hover_color',
			[
				'label' => __( 'Button Border Hover Color', 'ova-framework' ),
				'type' => Controls_Manager::COLOR,
				'default' => "",
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop:hover' => 'border-color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'muzze_bt_room_margin',
			[
				'label' => __( 'Margin', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'muzze_bt_room_padding',
			[
				'label' => __( 'Padding', 'ova-framework' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .muzze_shop .return_shop .btn_shop' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		
	}



	protected function render() {
	?>
		<?php 

			$settings = $this->get_settings();

			$p_slug = '';

			if( function_exists('OVAMT') ){
				$p_slug = apply_filters( 'ovamt_ticket_product_settings', '' );
			} 	
			
			$number_product = $settings['number_product_on_row'];

			if( $p_slug != '' ){

				$product_obj = get_page_by_path( $p_slug, OBJECT, 'product' );			
				$id_ticket   = $product_obj->ID;

				if( $settings['category'] == 'all'){
					if( $settings['product_featured'] == 'yes'){
						$args_product = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
							'fields'         => 'ids',
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
								)  
							),
							'post__not_in' => array($id_ticket),
			            );
					} else{
						$args_product = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
							'post__not_in' => array($id_ticket),
			            );
					}
					
				} else {
					if( $settings['product_featured'] == 'yes' ){
						$args_product = array(
							'post_type'   => 'product',
							'post_status' => 'publish',
							'fields'         => 'ids',
							'tax_query'   => array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
								),  
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $settings['category'],
								)
							),
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
							'post__not_in' => array($id_ticket),
			            );
					} else{
						$args_product = array(
							'post_type'   => 'product',
							'post_status' => 'publish',
							'tax_query'   => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $settings['category'],
								)
							),
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
							'post__not_in' => array($id_ticket),
			            );
					}
				}
			} else{
				if( $settings['category'] == 'all'){
					if( $settings['product_featured'] == 'yes'){
						$args_product = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
							'fields'         => 'ids',
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
								)  
							),
			            );
					} else{
						$args_product = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
			            );
					}
					
				} else {
					if( $settings['product_featured'] == 'yes' ){
						$args_product = array(
							'post_type'   => 'product',
							'post_status' => 'publish',
							'fields'         => 'ids',
							'tax_query'   => array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
								),  
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $settings['category'],
								)
							),
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
			            );
					} else{
						$args_product = array(
							'post_type'   => 'product',
							'post_status' => 'publish',
							'tax_query'   => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $settings['category'],
								)
							),
							'posts_per_page' => $settings['total_items_cat'],
							'order'          => $settings['order'],
			            );
					}
				}
			}
 
            
        	$category_link = get_term_link( $settings['category'], 'product_cat' );
            $products = new \WP_Query($args_product); 

        ?>

        <div class="muzze_shop">

			<div class="content_product">
				<?php if( $products -> have_posts() ) : while( $products -> have_posts() ) : $products -> the_post();  global $product; ?>
				<div class="items <?php echo esc_attr($number_product); ?>">
					<a href="<?php the_permalink();?>" alt="<?php the_title();?>">
						<?php if( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail(); ?>
						<?php endif; ?>
					</a>
					<?php 
					if($products->product_type == "variable"){ 
						woocommerce_variable_add_to_cart(); 
					} else { 
						woocommerce_template_loop_add_to_cart(); 
					}
					?>
					<h3 class="second_font"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h3>
					<?php 
						$price = get_post_meta( get_the_ID(), '_regular_price', true);  
						$sale  = get_post_meta( get_the_ID(), '_sale_price', true);
						if( $settings['show_price'] == 'yes'){
							if($sale){
								echo wc_price($sale);
							}else{
								echo wc_price($price);
							}					
						}
					?>
					
				</div>
				<?php endwhile; else : ?>
				<div class="search_not_found">
					<?php esc_html_e( 'No Products Found', 'ova-framework' ); ?>
				</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>

			<div class="return_shop">
				<?php 
					if( $settings['category'] == 'all'){ ?>
						<a class="btn_shop" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__('Explore the Shop','ova-framework')?></a>
					<?php }else{ ?>
						<a class="btn_shop" href="<?php echo esc_url($category_link);?>"><?php echo esc_html__('Explore the Shop','ova-framework')?></a>
					<?php }
				?>
			</div>
              	                               	                            	                          	              	        
	    </div>

	<?php } 
	
}
