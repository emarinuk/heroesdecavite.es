<?php
	if(defined('MUZZE_URL') 	== false) 	define('MUZZE_URL', get_template_directory());
	if(defined('MUZZE_URI') 	== false) 	define('MUZZE_URI', get_template_directory_uri());

	load_theme_textdomain( 'muzze', MUZZE_URL . '/languages' );
	
	// require libraries, function
	require( MUZZE_URL.'/inc/init.php' );

	// Add js, css
	require( MUZZE_URL.'/extend/add_js_css.php' );
	
	// require walker menu
	require_once (MUZZE_URL.'/inc/ova_walker_nav_menu.php');
	

	// register menu, widget
	require( MUZZE_URL.'/extend/register_menu_widget.php' );

	// require content
	require_once (MUZZE_URL.'/content/define_blocks_content.php');
	
	// require breadcrumbs
	require( MUZZE_URL.'/extend/breadcrumbs.php' );

	// Hooks
	require( MUZZE_URL.'/inc/class_hook.php' );

	
	/* Customize */
	if( current_user_can('customize') ){
	    require_once MUZZE_URL.'/customize/custom-control/google-font.php';
	    require_once MUZZE_URL.'/customize/custom-control/heading.php';
	}
	require_once MUZZE_URL.'/customize/class-customize.php';
    require_once MUZZE_URL.'/customize/render-style.php';
    
    
    
	
	// Require metabox
	if( is_admin() ){
		// Require TGM
		require_once ( MUZZE_URL.'/install_resource/active_plugins.php' );		
	}

	