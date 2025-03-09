<?php

namespace ova_framework;

use ova_framework\widgets\ova_menu;
use ova_framework\widgets\ova_logo;
use ova_framework\widgets\ova_heading;
use ova_framework\widgets\henbergar_menu;
use ova_framework\widgets\ova_search;
use ova_framework\widgets\ova_header;
use ova_framework\widgets\ova_slideshow;

use ova_framework\widgets\ova_heading_page;

use ova_framework\widgets\ova_blog;
use ova_framework\widgets\ova_history;
use ova_framework\widgets\ova_icon_muzze;
use ova_framework\widgets\ova_menu_page;
use ova_framework\widgets\ova_muzze_according;
use ova_framework\widgets\ova_info_image;
use ova_framework\widgets\ova_info;
use ova_framework\widgets\ova_social;
use ova_framework\widgets\admission_price;
use ova_framework\widgets\ova_price_table;
use ova_framework\widgets\ova_info_icon;
use ova_framework\widgets\ova_testimonial;
use ova_framework\widgets\ova_circle_text;
use ova_framework\widgets\ova_instagram;
use ova_framework\widgets\ova_time_countdown;
use ova_framework\widgets\ova_muzze_according_image;
use ova_framework\widgets\ova_artist;
use ova_framework\widgets\ova_location;
use ova_framework\widgets\ova_image_muzze;
use ova_framework\widgets\ova_open_time;
use ova_framework\widgets\ova_open_contact;
use ova_framework\widgets\ova_slider;
use ova_framework\widgets\ova_exhibitions_creactive;
use ova_framework\widgets\ova_exhibitions_slide;
use ova_framework\widgets\ova_event_parallax;
use ova_framework\widgets\ova_exhibition_parallax;
use ova_framework\widgets\ova_collection_parallax;
use ova_framework\widgets\ova_icon_landing_page;



use ova_framework\widgets\ova_home_fullscreen;
use ova_framework\widgets\ova_muzze_shop;




if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Ova_Register_Elementor {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'add_hf_category' ) );

	     // Register Ovatheme Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'add_ovatheme_category' ) );
	    
		
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );
		

	}

	
	public  function add_hf_category(  ) {
	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => __( 'Header Footer', 'ova-framework' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}

	
	public function add_ovatheme_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovatheme',
	        [
	            'title' => __( 'Ovatheme', 'ova-framework' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}


	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-menu.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-logo.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-heading.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-henbergar_menu.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-header_search.php';

		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-header.php';
		
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_slideshow.php';

		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova-heading-page.php';

		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_blog.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_history.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_icon_muzze.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_menu_page.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_muzze_according.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_info_image.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_info.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_social.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/admission_price.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_price_table.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_info_icon.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_testimonial.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_circle_text.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_instagram.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_time_countdown.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_muzze_according_image.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_artist.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_location.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_image_muzze.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_open_time.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_open_contact.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_slider.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_exhibitions_creactive.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_exhibitions_slide.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_event_parallax.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_exhibitions_parallax.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_collection_parallax.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_icon_landing_page.php';


		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_home_fullscreen.php';
		require OVA_PLUGIN_PATH . 'ova-elementor/widgets/ova_muzze_shop.php';
		
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {

		\Elementor\Plugin::instance()->widgets_manager->register( new ova_menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_heading() );
		\Elementor\Plugin::instance()->widgets_manager->register( new henbergar_menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_search() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_header() );

		\Elementor\Plugin::instance()->widgets_manager->register( new ova_slideshow() );
		

		\Elementor\Plugin::instance()->widgets_manager->register( new ova_heading_page() );

		\Elementor\Plugin::instance()->widgets_manager->register( new ova_blog() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_history() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_icon_muzze() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_menu_page() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_muzze_according() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_info_image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_info() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_social() );
		\Elementor\Plugin::instance()->widgets_manager->register( new admission_price() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_price_table() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_info_icon() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_circle_text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_instagram() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_time_countdown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_muzze_according_image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_artist() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_location() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_image_muzze() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_open_time() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_open_contact() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_exhibitions_creactive() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_exhibitions_slide() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_event_parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_exhibition_parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_collection_parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_icon_landing_page() );


		\Elementor\Plugin::instance()->widgets_manager->register( new ova_home_fullscreen() );
		\Elementor\Plugin::instance()->widgets_manager->register( new ova_muzze_shop() );
	}
	    
	

}

new Ova_Register_Elementor();





