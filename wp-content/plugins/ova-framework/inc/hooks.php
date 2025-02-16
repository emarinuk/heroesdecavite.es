<?php

class ovaframework_hooks {

	public function __construct() {
		
		// Customize Menu Structures
		add_filter( 'wp_nav_menu_args', array( $this, 'ova_prefix_modify_nav_menu_args' ) );
		
		// Share Social in Single Post
		add_filter( 'ova_share_social', array( $this, 'muzze_content_social' ), 2, 10 );

		// Allow add font class to title of widget
		add_filter( 'widget_title', array( $this, 'ova_html_widget_title' ) );
		

		add_filter( 'widget_text', 'do_shortcode' );

		add_filter( 'ova_title_blog', array($this, 'muzze_title_blog' ));

		

    }

    /* Filter Walker for all menu */
	public function ova_prefix_modify_nav_menu_args( $args ) {
		
		if( class_exists('ova_megamenu_Walker_Nav_Menu') ){
			return array_merge( $args, array(
		        'fallback_cb' => 'ova_megamenu_Walker_Nav_Menu::fallback',
		        'walker' 	=> new ova_megamenu_Walker_Nav_Menu()
		    ) );	
		}else{
			return array_merge( $args, array(
		       	'fallback_cb' => 'Ova_Walker_Menu::fallback',
		        'walker' 	=> new Ova_Walker_Menu()

		    ) );	
		}
		

	}
	

	public function muzze_content_social( $link, $title ) {
 		$html = '<ul class="share-social-icons clearfix">

				<li><a class="share-ico ico-twitter" target="_blank" href="https://twitter.com/share?url='.$link.'">'.esc_html__("Twitter", "ova-framework").'</a></li>

				<li><a class="share-ico ico-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u='.$link.'">'.esc_html__("Facebook", "ova-framework").'</a></li>

				<li><a class="share-ico ico-pinterest" target="_blank" href="http://www.pinterest.com/pin/create/button/?url='.$link.'">'.esc_html__("Pinterest", "ova-framework").'</a></li>

				<li><a class="share-ico ico-mail" target="_blank" href="mailto:?body='.$link.'">'.esc_html__("Email", "ova-framework").'</a></li>
			
				<li><a class="share-ico ico-copy-url" data-url = "'.$link.'" id="ova-copy-link">'.esc_html__("Copy Url", "ova-framework").'</a></li>
				

			</ul>';

		return $html;
 	}


	// Filter class in widget title
	public function ova_html_widget_title( $title ) {
		$title = str_replace( '{{', '<i class="', $title );
		$title = str_replace( '}}', '"></i>', $title );
		return $title;
	}

	public function muzze_title_blog () {

		$blog_template = (isset($_GET['blog_template'])) ? $_GET['blog_template'] : "default";

		switch ($blog_template) {
			case "grid" : {
				$title = esc_html__( "New Grid", 'ova-framework' );
				break;
			}

			case "grid_sidebar" : {
				$title = esc_html__( "New Grid", 'ova-framework' );
				break;
			}

			case "classic" : {
				$title = esc_html__( "New Classic", 'ova-framework' );
				break;
			}

			default: {
				$title = get_theme_mod( 'blog_title_header', '');
				break;
			}
		}

		return $title;
	}



	

	public function ova_share_social_pro(){

	 ?>
	    <div class="share_social">
	        <i class="fa fa-share-alt"></i>
	        <span class="ova_label"><?php esc_html_e('Share', 'ova-framework'); ?></span>
	        <?php echo apply_filters('ova_share_social', get_the_permalink(), get_the_title() ); ?>
	    </div>
	<?php
	 
	}

	



}

new ovaframework_hooks();

