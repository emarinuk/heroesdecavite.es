<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php

$url_image_default = get_template_directory_uri() . '/assets/img/bgr-catalog.jpg';
$url_image = (!empty(get_theme_mod( 'header_shop_background_image'))) ? get_theme_mod( 'header_shop_background_image') : $url_image_default;

?>
	<div class="breadcrumb-muzze" style="background: url(<?php echo esc_url($url_image);?>);">
		<div class="container">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>
		<div class="overlay"></div>
		</div>
	</div>
	
	<div class="wrap_site">	
		
		<div id="main-content-woo" class="woo-content">
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

			

			<?php
				/**
				 * woocommerce_archive_description hook.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
			?>

			<?php if ( have_posts() ) : ?>

				<?php
					/**
					 * woocommerce_before_shop_loop hook.
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>

				<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php
					/**
					 * woocommerce_after_shop_loop hook.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				?>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>

			<?php
				/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );

				// do_action( 'woocommerce_sidebar' );
			?>
		</div>

		<?php get_sidebar('shop'); ?>

	</div>

<?php 

get_footer( 'shop' ); ?>
