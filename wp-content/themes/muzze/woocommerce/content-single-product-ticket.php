<?php 
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
} ?>


<div class="page_ticket_detail">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<?php the_content(); ?>
			</div>
			<div class="col-md-6 col-sm-12">
				<?php
				remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
				remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
				
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
				
				remove_action( 'woocommerce_single_product_summary', 'WC_Structured_Data::generate_product_data', 60 );

				do_action( 'woocommerce_single_product_summary' );
				
				?>
			</div>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>