<?php get_header(); ?>

	<div class="blog_header">
		<a class="link-all-blog" href="<?php echo esc_url(get_post_type_archive_link( 'post' )); ?>"><?php echo esc_html__('Back to all Post', 'muzze') ?></a>
		<h1 class="title-blog-single second_font"><?php the_title(); ?></h1>
		<?php muzze_content_meta_clone(); ?>
	</div>
	<div class="wrap_site">
		<div id="main-content" class="main">

			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();

				get_template_part( 'content/post', 'default' );

			    if ( comments_open() || get_comments_number() ) {
			    	comments_template();
			    }
				
			endwhile; else :
			    get_template_part( 'content/content', 'none' );
			endif;
			 ?>
			
		</div> <!-- #main-content -->
		<?php get_sidebar(); ?>
	</div> <!-- .wrap_site -->

<?php get_footer(); ?>