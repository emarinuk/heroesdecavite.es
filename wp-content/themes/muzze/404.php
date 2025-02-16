<?php get_header();  ?>

<div class="muzze_404_page">
	<div class="container">
		<div class="pnf-content">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/404_error.png';?>" alt="<?php esc_attr_e( 'Page Not Found', 'muzze' ) ?>">
			<h2 class="second_font"><?php esc_html_e( 'Ohh! Page Not Found', 'muzze' ); ?></h2>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Click the button below to return home.', 'muzze' ); ?></p>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="go_back"><?php esc_html_e( 'GO BACK HOME', 'muzze' ); ?></a>
		</div>	
	</div>  
</div>
<?php get_footer(); ?>