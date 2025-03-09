<?php 
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVAEV_Assets' ) ){
	class OVAEV_Assets{

		public function __construct(){

			add_action( 'wp_enqueue_scripts', array( $this, 'ovaev_enqueue_style' ) );

			/* Add JS for Elementor */
			add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ova_enqueue_scripts_elementor_event' ) );

		}

		public function ovaev_enqueue_style(){

			// Frontend 
			if ( is_singular( 'event' ) ){
				wp_enqueue_script( 'google','https://maps.googleapis.com/maps/api/js?key='.OVAEV_Settings::google_key_map().'&libraries=places', false, true );
			}

			wp_enqueue_style( 'event-frontend', OVAEV_PLUGIN_URI.'assets/css/frontend/event.css', array(), null );

			wp_enqueue_script( 'event-frontend-js', OVAEV_PLUGIN_URI.'assets/js/frontend/event.js', array('jquery'), false, true );

			// Carousel
			if ( is_singular( 'event' ) ){ 
				wp_enqueue_style( 'owl-carousel', OVAEV_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
				wp_enqueue_script( 'owl-carousel', OVAEV_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
			}

			/*** Jquery Datetimepicker ***/
			if ( is_post_type_archive( 'event' ) || is_tax( 'event_type' ) ){
				wp_enqueue_style( 'datetimepicker-style', OVAEV_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.css' );
				wp_enqueue_script( 'datetimepicker-script', OVAEV_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.js', array('jquery'), false, true );
			}

			/*** Pretty Photo ***/
			if( is_singular( 'event' ) ){
				wp_enqueue_style('prettyphoto', OVAEV_PLUGIN_URI.'assets/libs/prettyphoto/css/prettyPhoto.css');
				if (is_ssl()) {
					wp_enqueue_script('prettyphoto', OVAEV_PLUGIN_URI.'assets/libs/prettyphoto/jquery.prettyPhoto_https.js', array('jquery'),null,true);  
				}
				else{
					wp_enqueue_script('prettyphoto', OVAEV_PLUGIN_URI.'assets/libs/prettyphoto/jquery.prettyPhoto.js', array('jquery'),null,true);
				}
			}
		}

		/* Add JS for elementor */
		public function ova_enqueue_scripts_elementor_event(){
			wp_enqueue_script( 'script-elementor-event', OVAEV_PLUGIN_URI. 'assets/js/script-elementor.js', [ 'jquery' ], false, true );
		}
	}
	new OVAEV_Assets();
}