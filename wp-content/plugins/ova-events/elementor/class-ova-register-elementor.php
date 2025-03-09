<?php

namespace ova_ovaev_elementor;

use ova_ovaev_elementor\widgets\ova_events_cat;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Ova_Event_Register_Elementor {

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

     	// Register Ovatheme Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'add_ovatheme_category' ) );
	    
		
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );
		

	}
	
	public function add_ovatheme_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovatheme',
	        [
	            'title' => __( 'Ovatheme', 'ovaev' ),
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
		
		require OVAEV_PLUGIN_PATH . 'elementor/widgets/ovaev-program_event.php';
		
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {

		\Elementor\Plugin::instance()->widgets_manager->register( new ova_events_cat() );

	}
	    
	

}

new Ova_Event_Register_Elementor();





