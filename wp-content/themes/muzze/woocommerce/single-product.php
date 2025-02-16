<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div class="wrap_site">	
		
		<div id="main-content-woo-single" class="woo-content">

		<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
			do_action( 'woocommerce_before_main_content' );
		?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php $id = get_the_id();
					$product_cats = get_the_terms( $id, 'product_cat' );
					
					$flag = false;
					if( !empty( $product_cats ) ):
						foreach ($product_cats as $cat) {
							if( $cat->slug == 'ticket' ){
								wc_get_template_part( 'content', 'single-product-ticket' );
								$flag = true;
								break;
							}

						}
					endif;
					if( !$flag ) wc_get_template_part( 'content', 'single-product' );	
					
					
				 ?>
				<?php  ?>

			<?php endwhile; // end of the loop. ?>

		<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
		?>


	</div>

	<?php get_sidebar('shop'); ?>

</div>
	
<?php get_footer( 'shop' ); ?>
