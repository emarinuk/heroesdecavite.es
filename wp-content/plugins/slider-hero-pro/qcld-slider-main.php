<?php
/**
 * Plugin Name: Slider Hero Pro
 * Plugin URI: https://www.quantumcloud.com/products/slider-hero/
 * Description: Slider Hero is Unique, Responsive WordPress Slider Plugin with Background Animation Effects & Product Intro Builder. Create INCREDIBLE Adverts, Animation Sliders, Animated Header with Text Carousel.
 * Version: 9.2.3
 * Author: QuantumCloud
 * Author URI: https://www.quantumcloud.com/
 * Requires at least: 4.0
 * Tested up to: 6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit

//define global variable
$qcld_sliderhero_admin_menu_pages;
//Define table names For Slider-Hero.
global $wpdb;
define("QCLD_HERO_VERSION", '9.2.2');
define( "QCLD_TABLE_SLIDERS", $wpdb->prefix . 'qcld_slider_hero_sliders');
define( "QCLD_TABLE_SLIDES", $wpdb->prefix . 'qcld_slider_hero_slides' );
define('QCLD_SLIDERHERO_PLUGIN_URL', plugin_dir_url(__FILE__));
define( "QCLD_SLIDERHERO_DEFAULT_IMAGES", plugins_url( 'default_images', __FILE__ ) );
define( "QCLD_SLIDERHERO_CSS", plugins_url( 'css', __FILE__ ) );
define( "QCLD_SLIDERHERO_JS", plugins_url( 'js', __FILE__ ) );
define( "QCLD_SLIDERHERO_IMAGES", plugins_url( 'images', __FILE__ ) );
define( "QCLD_SLIDERHERO_GRADIENT", plugins_url( 'gradient', __FILE__ ) );
define( "QCLD_SLIDERHERO_PROMO", plugins_url( 'qc-promo-page', __FILE__ ) );
define( "QCLD_SLIDERHERO_FONTS", plugins_url( 'fonts', __FILE__ ) );

define( "QCLD_SLIDERHERO_ASSET", plugins_url( 'asset', __FILE__ ) );

define('QCLD_SLIDER_HERO_DIR', dirname(__FILE__));


//print_r(get_current_screen());exit;


add_filter( 'ot_theme_mode', '__return_false', 999 );
require_once( 'option-tree/ot-loader.php' );

define('QCLD_SLIDERHERO_VIEW', QCLD_SLIDER_HERO_DIR . "/qc-view");
require_once( "qcld-slider-framework.php" );
require_once( "qc-fnc/qcld_sliderhero_helper_fnc.php" );
require_once( "qc-fnc/qcld_sliderhero_import_export.php" );



require_once( "qcld-hero-gradient.php" );

require_once( "qc-fnc/qcld_sliderhero_ajax.php" );
require_once( "qc-fnc/qcld_sliderhero_shortcode.php" );
require_once( "qc-fnc/qcld_sliderhero_ajax_prev.php" );
require_once( "qc-fnc/qcld_sliderhero_ajax_prev2.php" );
require_once( "qc-fnc/qcld_sliderhero_pop.php" );
require_once( "qc-fnc/qcld_slider_hero_edit_config.php" );
require_once( "qc-view/qcld_sliderhero_slider_create.php" );

require_once( "qcld_sliderhero_help_section.php" );
require('plugin-upgrader/plugin-upgrader.php');

//hooks

add_action( 'admin_menu', 'qcld_sliderhero_options_panels' );
add_action( 'admin_enqueue_scripts', 'qcld_sliderhero_admin_style_script' );
add_action( "wp_loaded", "qcld_sliderhero_loaded_slider_callback" );
add_action( "wp_loaded", "qc_slider_hero_duplicate" );
add_action( "wp_loaded", "qcld_slider_hero_change_effect" );

add_action( 'wp_ajax_qcld_sliderhero_actions', 'qcld_sliderhero_ajax_action_callback' );

add_action( 'wp_ajax_nopriv_qcld_sliderhero_actions', 'qcld_sliderhero_ajax_action_callback' );

//activation hook for Slider-Hero
register_activation_hook( __FILE__, 'qcld_sliderhero_slider_activate');

/**
 * shortcode hooks
 */
add_shortcode( 'qcld_hero', 'qcld_qchero_resliders_shortcode' );



/*TinyMCE button for Inserting Shortcode*/
/* Add Slider Shortcode Button on Post Visual Editor */
function qclider_tinymce_button_function() {
	add_filter ("mce_external_plugins", "qslider_sld_btn_js");
	add_filter ("mce_buttons", "qcheror_sld_btn");
	
}

function qslider_sld_btn_js($plugin_array) {
	$plugin_array['slider_short_btn'] = plugins_url('js/qcld-tinymce-button.js', __FILE__);
	return $plugin_array;
}

function qcheror_sld_btn($buttons) {
	array_push ($buttons, 'slider_short_btn');
	return $buttons;
}


add_action ('init', 'qclider_tinymce_button_function'); 

//
//Font awesome for front end
add_action('wp_enqueue_scripts', 'slider_hero_font_awesome');
function slider_hero_font_awesome(){
	wp_enqueue_style( 'qcld-sliderhero-front-end-fontawesome-css', QCLD_SLIDERHERO_CSS . '/font-awesome.min.css');
}

/* Inserting jquery */
function hero_insert_jquery(){
wp_enqueue_script('jquery', false, array(), false, false);
}
add_action('wp_enqueue_scripts','hero_insert_jquery',999);



function qcld_sliderhero_admin_style_script($hook){
	global $qcld_sliderhero_admin_menu_pages, $wpdb;
	$table        = QCLD_TABLE_SLIDERS;
	wp_enqueue_style( 'qcld_admin_slider_modal_css1', QCLD_SLIDERHERO_CSS . "/shortcode.css");
	if(!isset($qcld_sliderhero_admin_menu_pages['main_page'])){
		return;
	}
	if (  $hook ==  $qcld_sliderhero_admin_menu_pages['main_page'] ) {
		wp_enqueue_media();
		wp_enqueue_style( 'qcld-sliderhero-admin-fontawesome-css', QCLD_SLIDERHERO_CSS . '/font-awesome.min.css');
		wp_enqueue_style( 'qcld-sliderhero_admin_css', QCLD_SLIDERHERO_CSS . "/admin.css");
		wp_enqueue_style( 'qcld-sliderhero_pop_css', QCLD_SLIDERHERO_CSS . "/slider_hero_pop.css");
		wp_enqueue_style( 'qcld-sliderhero_gradient_css', QCLD_SLIDERHERO_CSS . "/hero-gradient.css");
		if ( ! wp_script_is( "thickbox" ) ) {
			add_thickbox();
		}
		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script( 'jquery' );
		}
		/*if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
			wp_enqueue_script( 'jquery-ui-sortable', false, array( 'jquery' ) );
		}*/
		
	wp_enqueue_style( 'qcld_slider_hero_css_animate', QCLD_SLIDERHERO_CSS . "/animate.css");
	wp_enqueue_style( 'qcld_slider_hero_css', QCLD_SLIDERHERO_CSS . "/slider_hero.css");
	wp_enqueue_style( 'qcld_slider_hero_css_chosen', QCLD_SLIDERHERO_CSS . "/chosen.css");

	wp_enqueue_style( 'qcld_slider_hero_button_css', QCLD_SLIDERHERO_CSS . "/slider_hero_button.css");
	wp_enqueue_style( 'qcld_slider_hero_letter_fx_css', QCLD_SLIDERHERO_CSS . "/jquery-letterfx.css");
	
	
	
	wp_enqueue_script( 'qcld_hero_particles_js', QCLD_SLIDERHERO_JS . '/particles.js', array(), false, false );
	wp_enqueue_script( 'qcld_hero_particles_app_js', QCLD_SLIDERHERO_JS . "/particle_app.js", array('jquery'),QCLD_HERO_VERSION, $in_footer = false);

	wp_enqueue_script( 'qcld_hero_slider_app_js', QCLD_SLIDERHERO_JS . "/jquery.slider_x.js", array('jquery'), QCLD_HERO_VERSION );
	wp_enqueue_script( 'qcld_hero_slider_changeword_js', QCLD_SLIDERHERO_JS . "/jquery.changethewords2.js", array('jquery'), QCLD_HERO_VERSION);
	wp_enqueue_script( 'qcld_hero_slider_app_letter_fx_js', QCLD_SLIDERHERO_JS . "/jquery-letterfx.js", array('jquery'), QCLD_HERO_VERSION);
		
		wp_enqueue_script( 'qcld_sliderhero_helper_script', QCLD_SLIDERHERO_JS . '/helper.js' );
		
		wp_enqueue_script( 'qcld_sliderhero_tinymce_script', QCLD_SLIDERHERO_JS . '/tinymce/tinymce.min.js' );
		
		wp_register_script( 'qcld_sliderhero_add_slide_popups', QCLD_SLIDERHERO_JS . '/add_popup.js' );
		wp_enqueue_script('qcld_sliderhero_add_slide_popups');
		
		wp_localize_script( 'qcld_sliderhero_add_slide_popups', 'i18n_obj', array(
			'editslider_link' => admin_url( 'admin.php?page=Slider-Hero&task=editslider&id=1' ),
		) );
		
		wp_enqueue_script( 'qcld_sliderhero_ajax', QCLD_SLIDERHERO_JS . '/ajax.js' );
		wp_localize_script( 'qcld_sliderhero_ajax', 'audio', array(
			'url' => QCLD_SLIDERHERO_IMAGES.'/audio.png',
			'video' => QCLD_SLIDERHERO_IMAGES.'/video.png'
		) );
		if(isset($_GET['task']) && $_GET['task']=='editslider' && $_GET['id']!=''){
			$slider_row = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table  WHERE id = %d", $_GET['id'] ) );
			
			wp_localize_script( 'qcld_sliderhero_add_slide_popups', 'heroslider', array(
				'type' => $slider_row[0]->type,
				'video' => QCLD_SLIDERHERO_IMAGES.'/video.png'
			) );
			wp_localize_script( 'qcld_sliderhero_ajax', 'heroslider', array(
				'type' => $slider_row[0]->type,
				'video' => QCLD_SLIDERHERO_IMAGES.'/video.png'
			) );
			
		}
		
		
		
		
		
		wp_enqueue_script( 'qcld_sliderhero_admin_js', QCLD_SLIDERHERO_JS . '/admin.js' );
		
		wp_enqueue_script( 'QCLD_SLIDERHERO_GRADIENT_js', QCLD_SLIDERHERO_JS . '/hero-gradient.js' );
		
		
		//code for color picker//
		wp_enqueue_style( 'wp-color-picker' ); 
		
		//wp_enqueue_script( 'slider_hero_custom-color-picker-handle', QCLD_SLIDERHERO_JS . '/alpha-color-picker.js', array( 'jquery', 'wp-color-picker' ), null, true ); 
		
		//wp_enqueue_style( 'qcld_slider_hero_custom-color-picker_css', QCLD_SLIDERHERO_CSS . "/alpha-color-picker.css", array('wp-color-picker'));
		
        wp_enqueue_script( 'slider_hero_custom-script-handle', QCLD_SLIDERHERO_JS . '/custom-script.js', array( 'wp-color-picker' ), QCLD_HERO_VERSION, true ); 
		
        wp_enqueue_script( 'slider_hero_custom-chosen-handle', QCLD_SLIDERHERO_JS . '/chosen.jquery.js', array( 'jquery' ), null, true ); 
		
		//for alpha color picker
        //wp_enqueue_script( 'slider_hero_custom-script-alpha-handle', QCLD_SLIDERHERO_JS . '/custom-script-alpha.js', array( 'slider_hero_custom-color-picker-handle' ), null, true ); 
       
		//popup script

		//popup script
		$ajax_object = array(
				'ajax_url'    => admin_url( 'admin-ajax.php' ),
				'plugin_name' => 'Slider-Hero',
				'images_url'  => untrailingslashit( QCLD_SLIDERHERO_DEFAULT_IMAGES ),
			);
			
				if( isset($_GET['id']) ){
				$id = intval( $_GET['id'] );
				if(!$id) $id = 0;

				$ajax_object['editSlideNonce'] = wp_create_nonce('qchero_editslide_'.$id);
				$ajax_object['saveAllNonce'] = wp_create_nonce('qchero_save_all_'.$id);
				$ajax_object['saveImagesNonce'] = wp_create_nonce('qchero_save_images_'.$id);
				$ajax_object['saveImageNonce'] = wp_create_nonce('qchero_save_image_'.$id);
				$ajax_object['removeImageNonce'] = wp_create_nonce('qchero_remove_image_'.$id);
				$ajax_object['onImageNonce'] = wp_create_nonce('qchero_on_image_'.$id);
				$ajax_object['emptyNameAlert'] = __("Fill in the name before saving the slider.","qchero");
				$ajax_object['noImageAlert'] = __("Firstly add slides in your slider!","qchero");
			}
			wp_localize_script( 'qcld_sliderhero_ajax', 'qchero_ajax_object',$ajax_object);
			
			
			
	}
	if(isset($_GET['page']) and $_GET['page']=='New-Slider-Hero'){
		wp_enqueue_style( 'qcld-sliderhero_admin_css', QCLD_SLIDERHERO_CSS . "/admin.css");
	}
}
add_action('wp_enqueue_scripts', 'hero_load_essential_js');
function hero_load_essential_js(){
	//wp_enqueue_script( 'qcld_sliderhero_add_slide_popups', QCLD_SLIDERHERO_ASSET . '/jquery.easing.min.js', array('jquery') );
	//wp_enqueue_script( 'qcld_sliderhero_add_slide_popups', QCLD_SLIDERHERO_ASSET . '/jquery.fadeloader.js', array('jquery') );
}


//Slider Hero Duplicate
function qc_slider_hero_duplicate() {

	global $wpdb;


	if(isset($_GET['page']) && $_GET['page'] == 'Slider-Hero') {
		if(isset($_GET['task']) && $_GET['task'] == 'heroduplicateslider'){
			$id       = absint($_GET['id']);
			if ( isset( $_REQUEST['slider_hero_duplicate_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_REQUEST['slider_hero_duplicate_nonce'], 'slider_hero_duplicateslider_' . $id ) ) {
					die( __( 'Security check failed', 'reslide' ) );
				}
			}
			$table    = QCLD_TABLE_SLIDERS;
			$query    = $wpdb->prepare( "SELECT * FROM " . $table . " WHERE id=%d", $id );
			$r_slider = $wpdb->get_results( $query );
			$wpdb->insert(
				$table,
				array(
					'title'  => $r_slider[0]->title . ' Copy',
					'type'   => $r_slider[0]->type,
					'params' => $r_slider[0]->params,
					'time'   => $r_slider[0]->time,
					'slide'  => $r_slider[0]->slide,
					'style'  => $r_slider[0]->style,
					'custom' => $r_slider[0]->custom,
					'bg_image_url' => $r_slider[0]->bg_image_url,
					'bg_audio_url' => $r_slider[0]->bg_audio_url,
					'bg_gradient' => $r_slider[0]->bg_gradient
					
				)
			);

			$last_key      = $wpdb->insert_id;
			$table         = QCLD_TABLE_SLIDES;
			$query         = $wpdb->prepare( "SELECT * FROM " . $table . " WHERE sliderid=%d", $id );
			$r_sliders     = $wpdb->get_results( $query );
			$r_slider_list = '';
			foreach ( $r_sliders as $key => $r_slider ) {
				$new_r_slider = "('";
				$new_r_slider .= $r_slider->title . "','" . $last_key . "','" . $r_slider->published . "','" . $r_slider->slide . "','" .
				                 $r_slider->description . "','" . $r_slider->image_link . "','" . $r_slider->image_link_new_tab . "','" . $r_slider->thumbnail . "','" . $r_slider->custom . "','" .
				                 $r_slider->ordering . "','" . $r_slider->type . "', '".$r_slider->btn."', '".$r_slider->btn2."')";
				$r_slider_list .= $new_r_slider . ",";
			}
			$r_slider_list = substr( $r_slider_list, 0, strlen( $r_slider_list ) - 1 );
			$query         = "INSERT into " . $table . " (title,sliderid,published,slide,description,image_link,image_link_new_tab,thumbnail,custom,ordering,type,btn,btn2)
			VALUES " . $r_slider_list;
			$wpdb->query( $query );

			wp_redirect( 'admin.php?page=Slider-Hero' );
			exit();
		}
	}

}
//Code for change Effect
function qcld_slider_hero_change_effect(){
	global $wpdb;
	if(isset($_POST['page']) && $_POST['page'] == 'Slider-Hero') {
		if(isset($_POST['task']) && $_POST['task'] == 'hero_changeeffect'){
			$id       = absint($_POST['id']);
			$type = sanitize_text_field($_POST['effect']);

			$wpdb->update(
				QCLD_TABLE_SLIDERS,

				array(
					'type'       => $type
				),
				array( 'id' => $id ),
				array(
					'%s'
				),
				array( '%d')
			);
			
			if($wpdb->last_error !== '') :
				$wpdb->print_error();
			else:
				wp_redirect(admin_url('admin.php?page=Slider-Hero&task=editslider&type='.$type.'&id=' . $id));
				exit();
			endif;
		}
	}
}

function qcld_slider_hero_js()
{
	global $pagenow, $typenow;
	if (is_admin()):
		//script for daynight effect
		
		if(isset($_GET['type']) and $_GET['type']=='cube_animation'):
			wp_enqueue_script( 'qcld_hero_torus_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_torus_tweenmax_js', QCLD_SLIDERHERO_JS . "/orbitcontrols.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_torus_perlin_js', QCLD_SLIDERHERO_JS . "/cubes_animation.js", array('jquery'), false, false);
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='warp_speed'):
			wp_enqueue_script( 'qcld_hero_wrap_speed_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_wrap_speed_tweenmax_js', QCLD_SLIDERHERO_JS . "/qcmax.js", array('jquery'), false, false);
			
		endif;
		if(isset($_GET['type']) and $_GET['type']=='intro'):
			wp_enqueue_script( 'qcld_hero_wrap_speed_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_wrap_speed_tweenmax_js', QCLD_SLIDERHERO_JS . "/qcmax.js", array('jquery'), false, false);
			
		endif;
		if(isset($_GET['type']) and $_GET['type']=='daynight'):
			wp_enqueue_script( 'qcld_hero_daynight_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
		endif;
		if(isset($_GET['type']) and $_GET['type']=='floatrain'):
			wp_enqueue_script( 'qcld_hero_floatrain_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
		endif;
		if(isset($_GET['type']) and $_GET['type']=='tiny_galaxy'):
			wp_enqueue_script( 'qcld_hero_tiny_galaxy_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
		endif;
		if(isset($_GET['type']) and $_GET['type']=='ygekpg'):
			wp_enqueue_script( 'qcld_hero_ygekpg_three_js', QCLD_SLIDERHERO_JS . "/p5.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_ygekpg_js', QCLD_SLIDERHERO_JS . "/ygekpg.js", array('jquery'), false, true);
		endif;
		if(isset($_GET['type']) and $_GET['type']=='directional'):
			wp_enqueue_script( 'qcld_hero_directional_three_js', QCLD_SLIDERHERO_JS . "/p5.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_directional_js', QCLD_SLIDERHERO_JS . "/directional.js", array('jquery'), false, true);
			
		endif;
		if(isset($_GET['type']) and $_GET['type']=='rain'):
			wp_enqueue_script( 'qcld_hero_rain_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_rain_tween_js', QCLD_SLIDERHERO_JS . "/tween.js", array('jquery'), false, false);
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='waterdroplet'):
			wp_enqueue_script( 'qcld_hero_waterdroplet_pixi_js', QCLD_SLIDERHERO_JS . "/pixi.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_waterdroplet_stat_js', QCLD_SLIDERHERO_JS . "/stat.js", array('jquery'), false, false);
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='rising_cubes'):
			wp_enqueue_script( 'qcld_hero_rising_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_rising_OrbitControls_js', QCLD_SLIDERHERO_JS . "/OrbitControls.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_rising_SubdivisionModifier_js', QCLD_SLIDERHERO_JS . "/SubdivisionModifier.js", array('jquery'), false, false);
			
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='liquid_landscape'):
			wp_enqueue_script( 'qcld_liquid_landscape_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_liquid_landscape_OrbitControls_js', QCLD_SLIDERHERO_JS . "/OrbitControls.js", array('jquery'), false, false);
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='firework'):
			wp_enqueue_script( 'qcld_firework_stage_js', QCLD_SLIDERHERO_JS . "/stage.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_firework_math_js', QCLD_SLIDERHERO_JS . "/math.js", array('jquery'), false, false);
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='rays_particles'):
			wp_enqueue_script( 'qcld_rays_particles_vector_js', QCLD_SLIDERHERO_JS . "/vector2.js", array('jquery'), false, false);
			
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='blob'):
			wp_enqueue_script( 'qcld_blob_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			
		endif;
		if(isset($_GET['type']) and $_GET['type']=='racing_particles'):
			wp_enqueue_script( 'qcld_racing_particles_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			
		endif;
		
		if(isset($_GET['type']) and $_GET['type']=='bird'):
			wp_enqueue_script( 'qcld_racing_particles_three_js', QCLD_SLIDERHERO_JS . "/three.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_three_js', QCLD_SLIDERHERO_JS . "/three.min.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_projector_js', QCLD_SLIDERHERO_JS . "/Projector.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_canvasrenderer_js', QCLD_SLIDERHERO_JS . "/CanvasRenderer.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_stats_js', QCLD_SLIDERHERO_JS . "/stat.js", array('jquery'), false, false);
			wp_enqueue_script( 'qcld_hero_bird_js', QCLD_SLIDERHERO_JS . "/bird.js", array('jquery'), false, false);
			
		endif;
	
	
	
	endif;
   
}
add_action('wp_loaded','qcld_slider_hero_js');



//Add admin menu/sub-menu pages
function qcld_sliderhero_options_panels() {
	global $qcld_sliderhero_admin_menu_pages;
	add_menu_page( 'Slider Hero Pro', 'Slider Hero Pro', 'manage_options', 'Slider-Hero', 'qcld_sliderhero_sliders', 'dashicons-slides' );

	$qcld_sliderhero_admin_menu_pages['main_page']       = add_submenu_page( 'Slider-Hero', 'Manage Slider', 'Manage Slider', 'manage_options', 'Slider-Hero', 'qcld_sliderhero_sliders' );
	
	$qcld_sliderhero_admin_menu_pages['new_sliders'] = add_submenu_page( 'Slider-Hero', 'New Slider', 'New Slider', 'manage_options', 'New-Slider-Hero', 'qcld_sliderhero_sliders_type' );
	
	$qcld_sliderhero_admin_menu_pages['new_sliders'] = add_submenu_page( 'Slider-Hero', 'Import/Export', 'Import/Export', 'manage_options', 'import-export', 'qcld_sliderhero_sliders_import_export' );
	
	$qcld_sliderhero_admin_menu_pages['new_sliders'] = add_submenu_page( 'Slider-Hero', 'Help & License', 'Help & License', 'manage_options', 'qc-sliderhero-sessions-help-license', 'qcld_sliderhero_sessions_license_callback' );
	
	//add_submenu_page('Slider-Hero',)
}
require_once( 'qc-support-promo-page/class-qc-support-promo-page.php' );
//shortcode setup//
function qcld_qchero_resliders_shortcode( $atts, $content, $tag ) {

	$atts = shortcode_atts( array(
		'id' => '',
		'preloader'=>''
	), $atts );
	

	return qcld_qchero_load_front_end_slider( $atts);

}

/**
 * @param $id
 *
 * @return string
 */

function qcld_qchero_load_front_end_slider( $atts ) {
	require_once( "qc-view/qcheror_front_end_view.php" );
	require_once( "qc-fnc/qcheror_front_end_func.php" );
	return qcld_slide_show_published_sliders( $atts );
}



 // Handle adding new slider

function qcld_sliderhero_loaded_slider_callback() {
	if ( ! is_admin() ) {
		return;
	}
	if ( isset( $_GET['page'] ) && $_GET['page'] == "Slider-Hero" ) {
		if ( isset( $_GET['task'] ) ) {
			$task = sanitize_text_field($_GET['task']);
		} else {
			return;
		}
		if ( isset( $_GET["id"] ) ) {
			$id = intval( ( $_GET["id"] ) );
		} else {
			$id = 0;
		}
		require_once( "qc-fnc/qcld_sliderhero_slider_func.php" );
		
		switch ( $task ) {
			case "addslider":
				
				if ( isset( $_GET['type'] ) && $_GET['type']!='' ) {
					$type = sanitize_text_field($_GET['type']);
					qcld_sliderhero_add_slider( $type );
				}
				break;
			
		}
	} else {
		return;
	}
}

function qcld_sliderhero_sliders() {
	require_once( "qc-view/qcld_sliderhero_slider_view.php" );
	require_once( "qc-fnc/qcld_sliderhero_slider_func.php" );
	require_once( "qc-view/qcld_sliderhero_slide_edit_view.php" );
	require_once( "qc-fnc/qcld_sliderhero_slide_func.php" );
	

	if ( isset( $_GET["page"] ) ) {
		if ( isset( $_GET["task"] ) ) {
			$task = sanitize_text_field( $_GET["task"] );
			$task = esc_html( $_GET["task"] );
		} else {
			$task = '';
		}

		if ( isset( $_GET["id"] ) ) {
			$id = intval( ( $_GET["id"] ) );
		} else {
			$id = 0;
		}
		if ( isset( $_GET["slideid"] ) ) {
			$slideid = intval( ( $_GET["slideid"] ) );
		} else {
			$slideid = 0;
		}
		
		switch ( $task ) {
			case 'editslider':
					qcld_check_slider_config($id);
					qcld_sliderhero_edit_slider( $id );
				break;
			case 'removeslider':
				if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'qcld_sliderhero_removeslider_'.$id ) ) {
					qchero_remove_slider( $id );
				}else{
					wp_die( __('<h2>Security check failed</h2>', 'qchero') );
				}
				break;
			case 'editslide':
				if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'qchero_editslide_'.$id ) ) {
					
					qchero_edit_slide( $slideid, $id );
				}else{
					wp_die( __('<h2>Security check failed</h2>', 'qchero') );
				}
				break;
			case "slidertype":

					qcld_sliderhero_sliders_type();
				
				break;
			default:
				qcld_sliderhero_sliders_list_func();
				break;
		}
	}
}



// Plugin activation function
function qcld_sliderhero_slider_activate(){
	
	global $wpdb;
	$collate = '';

	if ( $wpdb->has_cap( 'collation' ) ) {
		if ( ! empty( $wpdb->charset ) ) {
			$collate .= "DEFAULT CHARACTER SET $wpdb->charset";
		}
		if ( ! empty( $wpdb->collate ) ) {
			$collate .= " COLLATE $wpdb->collate";
		}
	}
	
	$table             = QCLD_TABLE_SLIDERS;
	$sql_sliders_Table = "
CREATE TABLE IF NOT EXISTS `$table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `params` mediumtext NOT NULL,
  `time` datetime NOT NULL,
  `slide` longtext,
  `style` text NOT NULL,
  `custom` text NOT NULL,
  `bg_image_url` text NOT NULL,
  `bg_audio_url` text NOT NULL,
  `bg_gradient` text NOT NULL,
  PRIMARY KEY (`id`)
)  $collate AUTO_INCREMENT=1 ";
	$table             = QCLD_TABLE_SLIDES;
	$sql_slides_Table  = "
CREATE TABLE IF NOT EXISTS  `$table`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `sliderid` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `slide` longtext,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `custom` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `btn` text NOT NULL,
  `btn2` text NOT NULL,
  `t_font` text NOT NULL,
  `d_font` text NOT NULL,
  `tl_space` varchar(10) NOT NULL,
  `dl_space` varchar(10) NOT NULL,
  `stomp` text NOT NULL,
  `cover` text NOT NULL,
  `slide_link` text NOT NULL,
  PRIMARY KEY (`id`)
)   $collate AUTO_INCREMENT = 1";
	$table             = QCLD_TABLE_SLIDERS;

/**
* default values for slider and slides *
*/	
	$table                  = QCLD_TABLE_SLIDES;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql_sliders_Table );
	dbDelta( $sql_slides_Table );
	
	if ( ! $wpdb->get_var( "select count(*) from " . QCLD_TABLE_SLIDERS ) ) {
		$wpdb->insert(
			QCLD_TABLE_SLIDERS,
			array(
				'title'=>'Space Elevator',
				'type'=>'space_elevator',
				'params'=>'{"watereffect":{"color":""},"autoplay":1,"pauseonhover":1,"directionnav":1,"controlnav":1,"effect":{"interval":12000},"title":{"show":1,"align":"center","style":{"width":213,"height":61,"left":"","top":"29.33%"}},"button1":{"show":1,"position":"1","align":"center","style":{"width":213,"height":61,"left":"","top":"52.9967%"}},"titleffect":"bounceInLeft","deseffect":"bounceInRight","description":{"show":1,"align":"center","style":{"width":213,"height":61,"left":"","top":"41.0667%"}},"titlefontsize":50,"descfontsize":20,"background":"#121019","titlecolor":"#d6d6d6","descriptioncolor":"#e8e8e8","btneffect":"","blur":{"canvas_bg":"","particle_color":""},"wave":{"one_color":"","two_color":"","three_color":""},"metaballs":{},"matrix":{},"tiny_galaxy":{},"tagcanvas":{},"water_swimming":{},"warp_speed":{},"line":{},"circle":{},"waaave":{},"ballsgravity":{},"iconsahedron":{},"helix":{},"corruption":{},"chaos":{},"helix_multiple":{},"neno_hexagon":{},"cosmic_web":{},"directional":{},"distance":{},"valentine":{},"cloudysky":{},"particle_snow":{},"herotop":{"decoration":""},"herobottom":{"decoration":""},"rays_particles":{"particles":""},"hero404":{"title":""},"contentoffset":"","titlefontheight":"","descfontheight":"","titlebgcolor":"","canvasopacity":"","topdecorationcolor":"","bottomdecorationcolor":"","arrow":"arrow-circle","arrowcolor":"","arrowhovercolor":"","navigatorcolor":"","navigatorhovercolor":"","stopslide":0,"randomslide":0,"hidearrow":0,"hidenavigation":0,"titleouteffect":"","descouteffect":"","btnouteffect":"","slideimageeffect":"","audioautoplay":1,"audiocontrol":1,"audiorepeat":1,"controllerposition":"topleft","arrow_style":"default", "background":"#000"}',
				'time'=>'2016-05-02 10:58:58',
				'slide'=>'NULL',
				'style'=>'{"background":"blue;","border":"1px solid red;","color":"yellow","width":"800","height":"650","marginLeft":"0","marginRight":"0","marginTop":"0","marginBottom":"0","screenoption":"1","fullwidth":"3"}',
				'custom'=>'{}'
			),
			array('%s','%s','%s','%s','%s','%s','%s')
		);
		$slastid = $wpdb->insert_id;
		
		$wpdb->insert(
			QCLD_TABLE_SLIDES,
			array(
				'title'=>'The Most Elegant Slider Plugin',
				'sliderid'=>$slastid,
				'published'=>'1',
				'description'=>'<p>Slider Hero comes with all the standard slider features and tonnes more.</p>',
				'ordering'=>'1',
				'btn'=>'{"button_text":"Download Now","button_url":"#","button_target":"_blank","button_border":"square","button_style":"full_background","button_effect":"exborder","button_font_weight":"normal","button_font_size":"","button_letter_spacing":"","button_color":"#000000","button_hover_color":"","button_background_color":"#ffffff","hero_button_shortcode":"","hero_button_shortcode_value":"","button_background_hover_color":""}',
				'btn2'=>'{"button_text":"View Details","button_url":"#","button_target":"_blank","button_border":"square","button_style":"full_background","button_effect":"exborder","button_font_weight":"normal","button_font_size":"","button_letter_spacing":"","button_color":"#000000","button_hover_color":"","button_background_color":"#ffffff","hero_button_shortcode":"","hero_button_shortcode_value":"","button_background_hover_color":""}',
				't_font'=>'Roboto:900',
				
			),
			array('%s','%d','%d','%s','%s','%s','%s')
		);
		
		if ( ! $wpdb->get_var( "select count(*) from " . QCLD_TABLE_SLIDES ) ) {
			//$wpdb->query( $sql_slides_Table_init );
		}
	}

	
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'btn2' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `btn2` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 't_font' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `t_font` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'd_font' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `d_font` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'tl_space' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `tl_space` varchar(10) NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'dl_space' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `dl_space` varchar(10) NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'stomp' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `stomp` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'cover' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `cover` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'slide_link' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `slide_link` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'draft' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `draft` varchar(10) NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}
	
	if ( ! @qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDERS, 'bg_audio_url' ) ) {
		$table                     = QCLD_TABLE_SLIDERS;
		$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `bg_audio_url` TEXT NOT NULL;";
		@$wpdb->query( $sql_slides_Table_update_1 );
	}

	
	if ( ! qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'image_link' ) ) {
		$table                     = QCLD_TABLE_SLIDES;
		$sql_slides_Table_update_imglink = "ALTER TABLE `$table` ADD `image_link` TEXT NOT NULL AFTER `description`, ADD `image_link_new_tab` BOOLEAN NOT NULL AFTER `image_link` ";
		$wpdb->query( $sql_slides_Table_update_imglink );
	}
	
}

if(!function_exists('qcld_sliderhero_isset_table_column')) {
	function qcld_sliderhero_isset_table_column($table_name, $column_name)
	{
		global $wpdb;
		$columns = $wpdb->get_results("SHOW COLUMNS FROM  " . $table_name, ARRAY_A);
		foreach ($columns as $column) {
			if ($column['Field'] == $column_name) {
				return true;
			}
		}
		return false;
	}
}


add_action('init', 'qc_checkslider_dep_field');
function qc_checkslider_dep_field(){
	global $wpdb;
	if(!get_option('qc_sliderhero_ludate_ck_pro')){
		
		if ( ! qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'cover' ) ) {
			
			$table                     = QCLD_TABLE_SLIDES;
			$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `cover` TEXT NOT NULL;";
			@$wpdb->query( $sql_slides_Table_update_1 );
		}
		
		update_option('qc_sliderhero_ludate_ck_pro', 'done');
	}
	if(!get_option('qc_sliderhero_ludate_ck_pro2')){
		
		if ( ! qcld_sliderhero_isset_table_column( QCLD_TABLE_SLIDES, 'slide_link' ) ) {
			
			$table                     = QCLD_TABLE_SLIDES;
			$sql_slides_Table_update_1 = "ALTER TABLE `$table` ADD `slide_link` TEXT NOT NULL;";
			@$wpdb->query( $sql_slides_Table_update_1 );
		}
		
		update_option('qc_sliderhero_ludate_ck_pro2', 'done');
	}
}



function recursive_sanitize_text_field($array) {
	if(!empty($array) && is_array($array)){
		foreach ( $array as $key => $value ) {
			if ( @is_array( $value ) ) {
				$value = recursive_sanitize_text_field($value);
			}
			else {
				$value = esc_html( $value );
				
			}
		}
	}
    return $array;
}



function qcld_sliderhero_ajax_action_callback() {

	global $wpdb;

	if ( isset( $_POST['qchero_do'] ) ) {
		$qchero_do = sanitize_text_field( $_POST['qchero_do'] );
		$qchero_do = esc_html( $_POST['qchero_do'] );

		if ( $qchero_do == 'qchero_save_all' ) {
			
			if ( isset( $_POST['id'] ) ) {
				$id = wp_kses_stripslashes( $_POST['id'] );
				$id = trim( $id, '"' );
				$id = intval( $id );
				if ( $id <= 0 ) {
					die(__( 'Invalid ID', 'qchero' ));
				}
			} else {
				die(__( 'Invalid ID', 'qchero' ));
			}

			if( !isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'qchero_save_all_'.$id ) ){
				die(__( 'Security check failed', 'qchero' ));
			}

			$arrayForupdate           = array();
			$arrayForupdateFormatting = array();
			if ( isset( $_POST['custom'] ) ) {
				$custom = wp_kses_stripslashes( $_POST['custom'] );

				$arrayForupdate = array_merge( $arrayForupdate, array( 'custom' => $custom ) );
				array_push( $arrayForupdateFormatting, '%s' );
			}
			if ( isset( $_POST['style'] ) ) {
				$style = wp_kses_stripslashes( $_POST['style'] );

				$arrayForupdate = array_merge( $arrayForupdate, array( 'style' => $style ) );
				array_push( $arrayForupdateFormatting, '%s' );
			}
			if ( isset( $_POST['params'] ) ) {
				$params = wp_kses_stripslashes( $_POST['params'] );

				$arrayForupdate = array_merge( $arrayForupdate, array( 'params' => $params ) );
				array_push( $arrayForupdateFormatting, '%s' );
			}
			if ( isset( $_POST['name'] ) ) {
				$name = sanitize_text_field($_POST['name']);
				$name = wp_kses_stripslashes( $name );
				$name = trim( $name, '"' );
				$name = esc_html( $name );
			} else {
				$name = __("New Slider","Slider-Hero");
			}
			if(isset($_POST['bg_image_url'])){
				$bgurl = sanitize_text_field($_POST['bg_image_url']);
				$bgurl = wp_kses_stripslashes( $bgurl );
				$bgurl = trim( $bgurl, '"' );
				$bgurl = esc_html( $bgurl );
			}else{
				$bgurl = '';
			}
			if(isset($_POST['bg_audio_url'])){
				$bgaudio = sanitize_text_field($_POST['bg_audio_url']);
				$bgaudio = wp_kses_stripslashes( $bgaudio );
				$bgaudio = trim( $bgaudio, '"' );
				$bgaudio = esc_html( $bgaudio );
			}else{
				$bgaudio = '';
			}
			
			if(isset($_POST['bg_gradient'])){
				$bgradient = sanitize_text_field($_POST['bg_gradient']);
				$bgradient = wp_kses_stripslashes( $bgradient );
				
			}else{
				$bgradient = '';
			}
			
			
			
			$arrayForupdate = array_merge( $arrayForupdate, array( 
				'title' => $name,
				'bg_image_url'=>$bgurl,
				'bg_gradient'=>$bgradient,
				'bg_audio_url'=>$bgaudio
				
			) );
			
			array_push( $arrayForupdateFormatting, '%s' );
			$wpdb->update(
				QCLD_TABLE_SLIDERS,
				$arrayForupdate,
				array( 'id' => $id ),
				$arrayForupdateFormatting,
				array( '%d' )
			);

			wp_die();
		} elseif ( $qchero_do == 'qchero_save_images' ) {
			
			if ( isset( $_POST['id'] ) ) {
				$id = wp_kses_stripslashes( $_POST['id'] );
				$id = trim( $id, '"' );
				$id = intval( $id );
				if ( $id <= 0 ) {
					die(__('Invalid ID','qchero'));
				}
			} else {
				die(__('Invalid ID','qchero'));
			}

			if( !isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'qchero_save_images_'.$id ) ){
				die(__( 'Security check failed', 'qchero' ));
			}

			if ( isset( $_POST['images'] ) && ! empty( $_POST['images'] ) ) {
				$images = recursive_sanitize_text_field($_POST['images']);
			}
			if ( isset( $_POST['slides'] ) && ! empty( $_POST['slides'] ) && is_array( $_POST['slides'] ) ) {
				$slides = ($_POST['slides']);
			}

			if ( isset( $images ) && $images != "none" ) {
				$images = array_reverse( $images );
				foreach ( $images as $image ) {
					
					$title    = sanitize_text_field( $image['title'] );
					$url    = esc_html( $image['url'] );
					
					$ordering = intval( $image['ordering'] );
					$cover = (isset($image['cover'])?esc_url_raw($image['cover']):'');
					$wpdb->insert(
						QCLD_TABLE_SLIDES,
						array(
							'title'     => 'Default Title',
							'description' => 'Default Description',
							'thumbnail' => '',
							'sliderid'  => $id,
							'custom'    => '{}',
							'image_link'    => $url,
							'draft'    => '1',
							'ordering'  => $ordering,
							'cover'		=> $cover
						),
						array(
							'%s',
							'%s',
							'%s',
							'%d',
							'%s',
							'%s',
							'%s',
							'%d',
							'%s'

						)
					);
					
					
					
				};
			}

			if ( isset( $slides ) ) {
				foreach ( $slides as $slide ) {
					
					$image_link = esc_html( $slide['image_link'] );
					$image_link_new_tab = esc_html( @$slide['image_link_new_tab'] );
					$description = trim(preg_replace('/\s+/', ' ', $slide['description']));
					
					$btn = esc_html($slide['btn']);
					$btn2 = esc_html($slide['btn2']);
					$stomp = esc_html($slide['stomp']);
					$draft = esc_html($slide['draft']);
					
					$t_font = esc_html($slide['t_font']);
					$d_font = esc_html($slide['d_font']);
					$tl_space = esc_html($slide['tl_space']);
					$dl_space = esc_html($slide['dl_space']);
					$cover = (isset($slide['cover'])?esc_url_raw($slide['cover']):'');
					$slide_link = (isset($slide['slide_link'])?esc_url_raw($slide['slide_link']):'');
					
					$title = html_entity_decode($slide['title']);
					$title       = trim(preg_replace('/\s+/', ' ', $title));
					
					$ordering    = intval( $slide['ordering'] );
					$wpdb->update(
						QCLD_TABLE_SLIDES,

						array(
							'title'       => ($title),
							'description' => $description,
							'btn' => $btn,
							'btn2' => $btn2,
							'image_link'         => $image_link,
							'image_link_new_tab' => $image_link_new_tab,
							'thumbnail'   => $slide['url'],
							'ordering'    => $ordering,
							't_font'    => $t_font,
							'd_font'    => $d_font,
							'tl_space'    => $tl_space,
							'dl_space'    => $dl_space,
							'stomp'    => $stomp,
							'draft'    => $draft,
							'cover'    => $cover,
							'slide_link'=> $slide_link,

						),
						array( 'sliderid' => $id, 'id' => $slide['id'] ),
						array(
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%d',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s'

						),
						array( '%d', '%d' )
					);
				}
			}
			$myrows = $wpdb->get_results( "SELECT * FROM " . QCLD_TABLE_SLIDES . " WHERE sliderid = " . $id . " order by ordering desc" );
			$str    = array();
			foreach ( $myrows as $row ) {
				
				$st                        = '{"description":"' . wp_unslash( esc_js( $row->description ) ) . '","btn":"'.wp_unslash( esc_js( $row->btn ) ).'","btn2":"'.wp_unslash( esc_js( $row->btn2 ) ).'","stomp":"'.wp_unslash( esc_js( $row->stomp ) ).'","draft":"'.wp_unslash( esc_js( $row->draft ) ).'","t_font":"'.wp_unslash( esc_js( $row->t_font ) ).'","d_font":"'.wp_unslash( esc_js( $row->d_font ) ).'","tl_space":"'.$row->tl_space.'","dl_space":"'.$row->dl_space.'","id":"' . $row->id . '","title":"' . wp_unslash( esc_js( $row->title ) ) . '","image_link":"' . wp_unslash( esc_js( $row->image_link ) ). '","image_link_new_tab":"' . wp_unslash( esc_js( $row->image_link_new_tab ) ) . '","type":"' . $row->type . '","url":"' . $row->thumbnail . '","cover":"' . esc_url_raw($row->cover) . '","slide_link":"' . esc_url_raw($row->slide_link) . '","ordering":' . $row->ordering . ',"published":' . $row->published . '}';
				$str[ 'slide' . $row->id ] = $st;
			};
			
			echo json_encode( $str );

			wp_die();
			
			//end of save images//
		} elseif ( $qchero_do == 'qchero_save_image' ) {
			if ( isset( $_POST['id'] ) ) {
				$id = wp_kses_stripslashes( $_POST['id'] );
				$id = trim( $id, '"' );
				$id = intval( $id );
				if ( $id <= 0 ) {
					die(__("Invalid ID","qchero"));
				}
			} else {
				die(__("Invalid ID","qchero"));
			}

			if( !isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'qchero_save_image_'.$id ) ){
				die(__( 'Security check failed', 'qchero' ));
			}

			if ( isset( $_POST['slide'] ) ) {
				$slide = wp_kses_stripslashes( $_POST['slide'] );
				$slide = trim( $slide, '"' );
				$slide = intval( $slide );
				if ( $slide <= 0 ) {
					$slide = 1;
				}
			} else {
				$slide = 1;
			}
			if ( isset( $_POST['custom'] ) ) {
				$custom = wp_kses_stripslashes( $_POST['custom'] );
			} else {
				$custom = '{}';
			}
			if ( isset( $_POST['title'] ) ) {
				$title = sanitize_text_field( $_POST['title'] );
			} else {
				$title = "";
			}
			if ( isset( $_POST['description'] ) ) {
				$description = sanitize_text_field( $_POST['description'] );
			} else {
				$description = "";
			}
			if ( isset( $_POST['image_link'] ) ) {
				$image_link = sanitize_text_field( $_POST['image_link'] );
			} else {
				$image_link = "";
			}
			if ( isset( $_POST['image_link_new_tab'] ) ) {
				$image_link_new_tab = sanitize_text_field( $_POST['image_link_new_tab'] );
			} else {
				$image_link_new_tab = "";
			}
			$wpdb->update(
				QCLD_TABLE_SLIDES,

				array(
					'custom'      => $custom,
					'title'       => $title,
					'description' => $description,
					'image_link'         => $image_link,
					'image_link_new_tab' => $image_link_new_tab
				),
				array( 'sliderid' => $id, 'id' => $slide ),
				array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s'
				),
				array( '%d', '%d' )
			);
			wp_die();

		} elseif ( $qchero_do == 'qchero_remove_image' ) {
			if ( isset( $_POST['id'] ) ) {
				$id = wp_kses_stripslashes( $_POST['id'] );
				$id = trim( $id, '"' );
				$id = intval( $id );
				if ( $id <= 0 ) {
					die(__("Invalid ID","qchero"));
				}
			} else {
				die(__("Invalid ID","qchero"));
			}

			if( !isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'qchero_remove_image_'.$id ) ){
				die(__( 'Security check failed', 'qchero' ));
			}

			if ( isset( $_POST['slide'] ) ) {
				$slide = wp_kses_stripslashes( $_POST['slide'] );
				$slide = trim( $slide, '"' );
				$slide = intval( $slide );
				if ( $slide <= 0 ) {
					die(__("Invalid Slide","qchero"));
				}
			} else {
				die(__("Invalid Slide","qchero"));
			}
			
			//removing all flip images//
			$squery   = $wpdb->prepare( "SELECT * FROM " . QCLD_TABLE_SLIDES . " WHERE id = '%d' ORDER BY ordering DESC", $slide );
			$qcherodata = $wpdb->get_results( $squery );
			
			$getthumb = $qcherodata[0]->thumbnail;
			//qcld_remove_flip_image($getthumb);
			
			if( !$wpdb->delete( QCLD_TABLE_SLIDES, array( 'id' => $slide ), array( '%d' ) ) ){
				echo json_encode(array("error"=>"Error while deleting image"));
				die;
			}
			echo json_encode(array("success"=>1,'slide'=>$slide));
			die;

		} elseif ( $qchero_do == 'qchero_on_image' ) {
			if ( isset( $_POST['id'] ) ) {
				$id = intval( $_POST['id'] );
				if ( $id <= 0 ) {
					$id = 1;
				}
			} else {
				$id = 1;
			}

			if( !isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'qchero_on_image_'.$id ) ){
				die(__( 'Security check failed', 'qchero' ));
			}

			if ( isset( $_POST['slide'] ) ) {
				$slide = intval( $_POST['slide'] );
				if ( $slide <= 0 ) {
					$slide = 1;
				}
			} else {
				$slide = 1;
			}
			if ( isset( $_POST['published'] ) ) {
				$published = intval( $_POST['published'] );
			} else {
				$published = 0;
			}
			$wpdb->update(
				QCLD_TABLE_SLIDES,

				array(
					'published' => $published
				),
				array( 'id' => $slide ),
				array( '%d' )
			);
			echo $slide;
			wp_die();

		}
	}
}
add_action('admin_enqueue_scripts', 'qc_slider_hero_admin_css');


function qc_slider_hero_admin_css(){
	wp_enqueue_style( 'qcpnd-slider_hero-custom-css', QCLD_SLIDERHERO_CSS . '/admin_style.css');
}

function qc_find_thumb($url){
	$url = explode('#',$url);
	
	return $url[0];
	
}

add_action('init', 'hero_removing_filter');
function hero_removing_filter(){
	remove_filter( 'widget_text', 'do_shortcode');
}



// Modified By Mobashir
if( function_exists('register_block_type') ){
	function qcld_slider_hero_gutenberg_block() {
	    require_once plugin_dir_path( __FILE__ ).'/gutenberg/slider-hero-block/plugin.php';
	}
	add_action( 'init', 'qcld_slider_hero_gutenberg_block' );
}

function qcopd_order_index_catalog_menu_page_sliderhero( $menu_ord )
{

  global $submenu;

  if(isset($submenu['Slider-Hero'])){
	    $arr = array();

	  $arr[] = $submenu['Slider-Hero'][0];
	  $arr[] = $submenu['Slider-Hero'][1];
	  $arr[] = $submenu['Slider-Hero'][2];
	  $arr[] = $submenu['Slider-Hero'][4];
	  $arr[] = $submenu['Slider-Hero'][5];
	  $arr[] = $submenu['Slider-Hero'][3];

	  $submenu['Slider-Hero'] = $arr;
  }


  return $submenu;

}

// add the filter to wordpress
add_filter( 'custom_menu_order', 'qcopd_order_index_catalog_menu_page_sliderhero' );

add_action( 'activated_plugin', 'qc_sliderhero_activation_redirect' );
function qc_sliderhero_activation_redirect( $plugin ) {
	if( $plugin == plugin_basename( __FILE__ ) ) {
		exit( wp_redirect( admin_url( 'admin.php?page=qc-sliderhero-sessions-help-license') ) );
	}
}

// Admin Notice
//add_action('init', 'qc_hero_admin_notice');
function qc_hero_admin_notice(){
	
	if(isset($_GET['action']) && $_GET['action']=='torus_notice_dismiss'){
		update_option('torus_notice_dismiss', 1);
		wp_redirect(admin_url('index.php'));exit;
	}
	
	if(get_option('torus_notice_dismiss')!=1){
		add_action('admin_notices', 'qchero_admin_torus_notice');
	}
	
}

function qchero_admin_torus_notice(){
?>
	<div id="message" class="error">
		<p>
			Slider Hero - We have replaced the Torus Cubes Effect animation with a new one to comply with WordPress's licensing policy. Please review the new animation effect.
			<a class="button-primary" href="<?php echo esc_url(admin_url('index.php?action=torus_notice_dismiss')); ?>">Dismiss</a>
		</p>
	</div>
<?php
}

function hero_anim_text_flow($text){
	for($i = 0; $i<strlen($text); $i++){
		echo '<span>'.$text[$i].'</span>';
	}
}

function qcld_slider_project_dequeue_unnecessary_scripts() {

    wp_dequeue_script( 'avia-module-slideshow-video' );
    wp_deregister_script( 'avia-module-slideshow-video' );
}

add_action('template_redirect', 'qcpd_hero_check_for_shorcode');
function qcpd_hero_check_for_shorcode(){
	global $wp_query;
	$post = $wp_query->get_queried_object();
	if(  $post && strpos($post->post_content, 'qcld_hero' ) !== false  ){
		add_action( 'wp_print_scripts', 'qcld_slider_project_dequeue_unnecessary_scripts' );
	}
}

// Conflict issue fix for wp vr pro.
add_action( 'plugins_loaded', 'qcld_slider_conflict_with_wpvr_pro_fix' );
function  qcld_slider_conflict_with_wpvr_pro_fix() {
	global $wp_filter;
	if( class_exists( 'Wpvr_Pro' ) && is_admin() && $_GET['page'] == 'Slider-Hero' ){
		
		$admin_enqueue_scripts = isset( $wp_filter['admin_enqueue_scripts'] ) ? $wp_filter['admin_enqueue_scripts'] : array();
		if( ! empty( $admin_enqueue_scripts ) ) {
			if( isset( $wp_filter['admin_enqueue_scripts']->callbacks[10] ) ) {
				$callbacks = $wp_filter['admin_enqueue_scripts']->callbacks[10];
				foreach( $callbacks as $key=>$value ) {
					if( is_array( $value['function'] ) && isset( $value['function'][0] ) && $value['function'][0] instanceof Wpvr_Pro_Admin && isset( $value['function'][1] ) && $value['function'][1] == 'enqueue_scripts' ){
						unset( $callbacks[$key] );
					}
				}
				$wp_filter['admin_enqueue_scripts']->callbacks[10] = $callbacks;
			}
			
		}
		
	}
}
