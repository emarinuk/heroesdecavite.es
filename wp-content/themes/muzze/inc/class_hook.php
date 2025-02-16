<?php

class Muzze_Hooks {

	public function __construct() {
		
		// Return HTML for Header
		add_filter( 'muzze_render_header', array( $this, 'muzze_render_header' ) );

		// Return HTML for Footer
		add_filter( 'muzze_render_footer', array( $this, 'muzze_render_footer' ) );


		/* Get All Header */
		add_filter( 'muzze_list_header', array( $this, 'muzze_list_header' ) );

		/* Get All Footer */
		add_filter( 'muzze_list_footer', array( $this,  'muzze_list_footer' ) );

		/* Define Layout */
		add_filter( 'muzze_define_layout', array( $this,  'muzze_define_layout' ) );

		/* Define Wide */
		add_filter( 'muzze_define_wide_boxed', array( $this,  'muzze_define_wide_boxed' ) );

		/* Get layout */
		add_filter( 'muzze_get_layout', array( $this, 'muzze_get_layout' ) );

		/* Get layout woo */
		add_filter( 'muzze_get_layout_woo', array( $this, 'muzze_get_layout_woo' ) );

		/* Get sidebar */
		add_filter( 'muzze_theme_sidebar', array( $this, 'muzze_theme_sidebar' )  );

		/* Wide or Boxed */
		add_filter( 'muzze_width_site', array( $this, 'muzze_width_site' ) );

		/* Get Blog Template */
		add_filter( 'muzze_blog_template', array( $this, 'muzze_blog_template' ) );
		
		/* Get sidebar woo*/
		add_filter( 'muzze_theme_sidebar_woo', array( $this, 'muzze_theme_sidebar_woo' )  );

		/* Search CPT */
		add_action( 'pre_get_posts', array( $this, 'muzze_search_all' ) );
		add_filter( 'template_include', array( $this, 'muzze_search_all_template' ) ); 

		
		
    }


    public function muzze_search_all( $query ) {
		$post_types = array('post','page','event','give_forms','collection','artist','exhibition');

		if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
			$query->set( 'post_type', apply_filters( 'muzze_search_custom_post_type', $post_types ) );
		}
	}

	function muzze_search_all_template( $template ) {
		global $wp_query;

		if ( $wp_query->is_main_query() && $wp_query->is_search() && ! is_admin() ) {
			return locate_template('search.php');
		} 

		return $template;
	} 

   

    function muzze_get_layout_woo(){
		$layout = get_theme_mod( 'woo_layout', 'layout_1c' );
		$width_sidebar = get_theme_mod( 'woo_sidebar_width', '320' );

		if( isset( $_GET['layout_sidebar'] ) ){
			$layout = $_GET['layout_sidebar'];
		}
		return array( $layout, $width_sidebar );
	}
	

	function muzze_theme_sidebar_woo(){
		$layout = get_theme_mod( 'woo_layout', 'layout_1c' );
		if( isset( $_GET['layout_sidebar'] ) ){
			$layout = $_GET['layout_sidebar'];
		}
		return $layout;	
	}

	
	public function muzze_render_header(){

		$current_id = muzze_get_current_id();

		// Get header default from customizer
		$global_header = get_theme_mod('global_header','default');

		// Header in Metabox of Post, Page
	    $meta_header = get_post_meta($current_id, 'ova_met_header_version', 'true');
	  	
	  	

	    // Header use in post,page
	    if( $current_id != '' && $meta_header != 'global'  && $meta_header != '' ){

	    	$header = $meta_header;

	  	}else if( muzze_is_blog_archive() ){ // Header use in blog

	  		$header = get_theme_mod('blog_header', 'default');

	  	}else if( muzze_is_woo_active() && ( is_shop() || is_product_category() || is_product_tag() ) ){

	  		$header = get_theme_mod('woo_header_archive', 'default');

	  	}else if( muzze_is_woo_active() && is_product() ){
			
			$header = get_theme_mod('woo_header_single', 'default');

	  	}else if( is_post_type_archive( 'collection' ) && class_exists('OVACOLL_Settings') ){

	  		$header = OVACOLL_Settings::archive_collection_header();

	  	}else if( is_singular('collection') && class_exists('OVACOLL_Settings') ){

	  		$header = OVACOLL_Settings::single_collection_header();

	  	}else if( is_post_type_archive( 'artist' ) && class_exists('OVACOLL_Settings') ){

	  		$header = OVACOLL_Settings::archive_artist_header();

	  	}else if( is_singular('artist') && class_exists('OVACOLL_Settings') ){

	  		$header = OVACOLL_Settings::single_artist_header();

	  	}else if( is_post_type_archive( 'exhibition' ) && class_exists('OVAEX_Settings') ){

	  		$header = OVAEX_Settings::archive_exhibition_header();

	  	}else if( is_singular('exhibition') && class_exists('OVAEX_Settings') ){

	  		$header = OVAEX_Settings::single_exhibition_header();

	  	}else if( is_post_type_archive( 'event' ) && class_exists('OVAEV_Settings') ){

	  		$header = OVAEV_Settings::archive_event_header();

	  	}else if( is_singular('event') && class_exists('OVAEV_Settings')  ){

	  		$header = OVAEV_Settings::single_event_header();

	  	}else if( is_singular('post') ){ // Header use in single post

	  		$header = get_theme_mod('single_header', 'default');

	  	}else{ // Header use in global

	  		$header = $global_header;

	  	}

		$header_split = explode(',', $header);

		if ( muzze_is_elementor_active() && isset( $header_split[1] ) ) {

			$post_id_header = muzze_get_id_by_slug( $header_split[1] );
			
			// Check WPML
			if( function_exists( 'icl_object_id' ) ){
				$post_id_header = icl_object_id($post_id_header, 'ova_framework_hf_el', false);	

				if ( ! $post_id_header ) {
					$post_id_header = muzze_get_id_by_slug( $header_split[1] );
				}
			}

			return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id_header );

		}else if ( muzze_is_elementor_active() && !isset( $header_split[1] ) ) {

			return get_template_part( 'header/header', $header );

		}else if ( !muzze_is_elementor_active()  ) {

			return get_template_part( 'header/header', 'default' );

		}

	}


	
	public function muzze_render_footer(){

		$current_id = muzze_get_current_id();

		// Get Footer default from customizer
		$global_footer = get_theme_mod('global_footer', 'default' );

		// Footer in Metabox of Post, Page
	    $meta_footer =  get_post_meta( $current_id, 'ova_met_footer_version', 'true' );
		
	  	

	  	if( $current_id != '' && $meta_footer != 'global'  && $meta_footer != '' ){
	  		
	  		$footer = $meta_footer;

	  	}else if( muzze_is_blog_archive() ){

	  		$footer = get_theme_mod('blog_footer', 'default');

	  	}else if( muzze_is_woo_active() && ( is_shop() || is_product_category() || is_product_tag() ) ){

			$footer = get_theme_mod('woo_archive_footer', 'default');

	  	}else if( muzze_is_woo_active() && is_product() ){

	  		$footer = get_theme_mod('woo_single_footer', 'default');

	  	}else if( is_post_type_archive( 'collection' ) && class_exists('OVACOLL_Settings') ){

	  		$footer = OVACOLL_Settings::archive_collection_footer();

	  	}else if( is_singular('collection') && class_exists('OVACOLL_Settings') ){

	  		$footer = OVACOLL_Settings::single_collection_footer();

	  	}else if( is_post_type_archive( 'artist' ) && class_exists('OVACOLL_Settings') ){

	  		$footer = OVACOLL_Settings::archive_artist_footer();

	  	}else if( is_singular('artist') && class_exists('OVACOLL_Settings') ){

	  		$footer = OVACOLL_Settings::single_artist_footer();

	  	}else if( is_post_type_archive( 'exhibition' ) && class_exists('OVAEX_Settings') ){

	  		$footer = OVAEX_Settings::archive_exhibition_footer();

	  	}else if( is_singular('exhibition') && class_exists('OVAEX_Settings') ){

	  		$footer = OVAEX_Settings::single_exhibition_footer();

	  	}else if( is_post_type_archive( 'event' ) && class_exists('OVAEV_Settings') ){

	  		$footer = OVAEV_Settings::archive_event_footer();

	  	}else if( is_singular('event') && class_exists('OVAEV_Settings') ){

	  		$footer = OVAEV_Settings::single_event_footer();

	  	}else if( is_singular('post') ){

	  		$footer = get_theme_mod('single_footer', 'default');

	  	}else{

	  		$footer = $global_footer;

	  	}

	  	$footer_split = explode(',', $footer);

		if ( muzze_is_elementor_active() && isset( $footer_split[1] ) ) {

			$post_id_footer = muzze_get_id_by_slug( $footer_split[1] );

			// Check WPML 
			if( function_exists( 'icl_object_id' ) ){
				$post_id_footer = icl_object_id($post_id_footer, 'ova_framework_hf_el', false);	

				if ( ! $post_id_footer ) {
					$post_id_footer = muzze_get_id_by_slug( $footer_split[1] );
				}
			}

			return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id_footer );
			
		}else if ( muzze_is_elementor_active() && !isset( $footer_split[1] ) ) {

			get_template_part( 'footer/footer', $footer );

		}else if( !muzze_is_elementor_active() ){

			get_template_part( 'footer/footer', 'default' );			
		}
	}

	function muzze_list_header() {
	    $hf_header_array['default'] = esc_html__( 'Default', 'muzze' );

	    if ( ! muzze_is_elementor_active() ) return $hf_header_array;

	    $args_hf = array(
	        'post_type' 		=> 'ova_framework_hf_el',
	        'post_status'   	=> 'publish',
	        'posts_per_page' 	=> '-1',
	        'meta_query' 		=> array(
	            array(
	                'key'     	=> 'hf_options',
	                'value'   	=> 'header',
	                'compare' 	=> '=',
	            ),
	        )
	    );

	    $hf = get_posts( $args_hf );

	    foreach ( $hf as $post ) {
	    	setup_postdata( $post );
	    	$hf_header_array[ 'ova,'.$post->post_name ] = get_the_title( $post->ID );
	    }

	   

	    return $hf_header_array;
	}

	function muzze_list_footer() {
	    $hf_footer_array['default'] = esc_html__( 'Default', 'muzze' );

	    if ( ! muzze_is_elementor_active() ) return $hf_footer_array;

	    $args_hf = array(
	        'post_type' 		=> 'ova_framework_hf_el',
	        'post_status'   	=> 'publish',
	        'posts_per_page' 	=> '-1',
	        'meta_query' 		=> array(
	            array(
	                'key'     	=> 'hf_options',
	                'value'   	=> 'footer',
	                'compare' 	=> '=',
	            ),
	        )
	    );

	    $hf = get_posts( $args_hf );

	    foreach ( $hf as $post ) {
	    	setup_postdata( $post );
	    	$hf_footer_array[ 'ova,'.$post->post_name ] = get_the_title( $post->ID );
	    }

	    

	    return $hf_footer_array;
	}


	function muzze_define_layout(){
		return array(
			'layout_1c' => esc_html__('No Sidebar', 'muzze'),
			'layout_2r' => esc_html__('Right Sidebar', 'muzze'),
			'layout_2l' => esc_html__('Left Sidebar', 'muzze'),
		);
	}


	function muzze_get_layout(){
		
		$current_id = muzze_get_current_id();

		$layout = get_post_meta( $current_id, 'ova_met_main_layout', true );

		if( is_singular( 'post' ) ){

		    $layout = get_theme_mod( 'single_layout', 'layout_2r' );
		    $width_sidebar = get_theme_mod( 'single_sidebar_width', '320' );

		}else if( muzze_is_woo_active() && is_product_category() ){
			
			$layout = get_theme_mod( 'woo_layout', 'layout_1c' );
			$width_sidebar = get_theme_mod( 'woo_sidebar_width', '320' );
		}
		else if( muzze_is_blog_archive() ){

		    $layout = get_theme_mod( 'blog_layout', 'layout_2r' );
		    $width_sidebar = get_theme_mod( 'blog_sidebar_width', '320' );

		}else{

		    $layout = get_theme_mod( 'global_layout', 'layout_1c' );
		    $width_sidebar = get_theme_mod( 'global_sidebar_width', '320' );
		}

		if( $current_id && $layout == 'global' ){
		    $layout = get_post_meta( $current_id, 'ova_met_main_layout', true );
		}

		if( isset( $_GET['layout_sidebar'] ) ){
			$layout = $_GET['layout_sidebar'];
		}

		return array( $layout, $width_sidebar );
	}

	function muzze_width_site(){
		$current_id = muzze_get_current_id();
		$width_site = get_post_meta( $current_id, 'ova_met_width_site', true );

		if( $current_id && $width_site != 'global' ){
		    $width = $width_site;
		}else{
			$width = get_theme_mod( 'global_width_site', 'wide' );
		}

		return $width;
	}

	function muzze_theme_sidebar(){
		$layout_sidebar = apply_filters( 'muzze_get_layout', '' );
		return $layout_sidebar[0];
	}

	function muzze_define_wide_boxed(){
		return array(
			'wide' => esc_html__('Wide', 'muzze'),
			'boxed' => esc_html__('Boxed', 'muzze'),
		);
	}


	function muzze_blog_template(){
		$blog_template = get_theme_mod( 'blog_template', 'default' );
		if( isset( $_GET['blog_template'] ) ){
			$blog_template = $_GET['blog_template'];
		}
		return $blog_template;
	}

	


}

new Muzze_Hooks();