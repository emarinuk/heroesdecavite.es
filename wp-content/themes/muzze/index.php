<?php get_header(); ?>
<?php 
	$blog_layout = apply_filters( 'muzze_theme_sidebar','' ); 
	$blog_template = apply_filters( 'muzze_blog_template', '' );

	$title_blog = apply_filters('ova_title_blog', '');

	$sub_title_header = get_theme_mod( 'blog_sub_title_header', '');

		switch ($blog_template) {
			case "grid" : {
				$class_type_blog = "ova-grid";
				break;
			}
			case "grid_sidebar" : {
				$class_type_blog = "ova-grid_sidebar";
				break;
			}
			case "classic" : {
				$class_type_blog = "ova-classic";
				break;
			}
			default: {
				$class_type_blog = "ova-default";
				break;
			}
		}

?>
	<div class="blog_header">
		<?php if ($title_blog != '') : ?>
		<h1 class="title-blog-archive second_font"><?php echo esc_html($title_blog, 'muzze') ?></h1>
		<?php endif ?>
		<?php if ($sub_title_header != '') : ?>
		<p class="second_font"><?php echo esc_html($sub_title_header, 'muzze') ?></p>
		<?php endif ?>
	</div>
	<div class="wrap_site <?php echo esc_attr($blog_layout); ?>">
		<div id="main-content" class="main">
			<div class="<?php echo esc_html($class_type_blog) ?>">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php
						switch ($blog_template) {
							case "grid" : {
								get_template_part( 'content/blog', 'grid' );
								break;
							}
							case "grid_sidebar" : {
								get_template_part( 'content/blog', 'grid_sidebar' ); 
								break;
							}
							default: {
								get_template_part( 'content/blog', 'default' );
								break;
							}
						}
					?>

				<?php endwhile; ?>
				</div>
			    <div class="pagination-wrapper">
			        <?php muzze_pagination_theme(); ?>
				</div>
			<?php else : ?>
			        <?php get_template_part( 'content/content', 'none' ); ?>
			<?php endif; ?>
			
		</div> <!-- #main-content -->
		<?php get_sidebar(); ?>
	</div> <!-- .wrap_site -->

<?php get_footer(); ?>