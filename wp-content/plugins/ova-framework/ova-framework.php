<?php
/**
 Plugin Name: OvaTheme Framework
Plugin URI: https://themeforest.net/user/ovatheme/portfolio
Description: A plugin to create custom post type,  shortcode, elementor, customize
Version:  1.2.9
Author: Ovatheme
Author URI: https://themeforest.net/user/ovatheme
License:  GPL2
Text Domain: ova-framework
Domain Path: /languages/
*/


final class OvaFramework {

	private static $instance;
	/**
     * OvaFramework constructor.
     */
    public function __construct() {
        $this->setup_cons();
        $this->load_textdomain();
        $this->supports();
        $this->add_scripts();
        $this->includes();
        
    }


    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof OvaFramework)) {
            self::$instance = new OvaFramework();
        }

        return self::$instance;
    }

    public function setup_cons(){
    	if (!defined('OVA_FRAMEWORK_VERSION')) {
            define('OVA_FRAMEWORK_VERSION', '1.0');
        }
        if (!defined('OVA_PLUGIN_PATH')) {
        	define( 'OVA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );	
        }
        if (!defined('OVA_PLUGIN_URI')) {
        	define( 'OVA_PLUGIN_URI', plugin_dir_url( __FILE__ ) );	
        }
        if (!defined('OVA_PLUGIN_FILE')) {
            define('OVA_PLUGIN_FILE', __FILE__);
        }
    }

    public function load_textdomain(){
    	/* Load Text Domain */
		load_plugin_textdomain( 'ova-framework', false, basename( dirname( OVA_PLUGIN_FILE ) ) .'/languages' ); 
    }

    public function supports(){

        

        /* Make Elementors */
        if ( did_action( 'elementor/loaded' ) ) {
            include OVA_PLUGIN_PATH.'ova-elementor/class-ova-register-elementor.php';
        }

        /* Metabox Cm2 */
        if ( defined( 'CMB2_LOADED' ) ) {
            include OVA_PLUGIN_PATH.'metabox/class-metabox.php';
        }
        
        /* Custom Post Type */
        include OVA_PLUGIN_PATH.'custom-post-type/init.php';
        
    }

    private function add_scripts(){
        
        /* Admin JS */
        add_action( 'admin_enqueue_scripts', array( $this, 'ova_script_admin' ) );

        
        

        /* Add CSS Frontend */
        add_action( 'wp_enqueue_scripts', array( $this, 'ova_enqueue_style_elementor' ), 11 );

        /* Add JS for Elementor */
       add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ova_enqueue_scripts_elementor' ) );

    }

    // Add JS, CSS in Backend
    public function ova_script_admin(){
        wp_enqueue_script( 'script-admin', OVA_PLUGIN_URI.'assets/js/script-admin.js', array('jquery'),false,true );
    }

    

    // Add JS, CSS //
    // Add CSS
    public function ova_enqueue_style_elementor(){
        

        // Add Css
        if( did_action( 'elementor/loaded' ) && file_exists( ABSPATH.'/wp-content/plugins/elementor/assets/css/frontend.min.css' ) ){
            wp_enqueue_style( 'elementor-frontend', plugins_url('/elementor/assets/css/frontend.min.css'), array(), null );
        }
        
        wp_enqueue_style( 'style-elementor', OVA_PLUGIN_URI.'assets/css/style-elementor.css', array(), null );
        
        // Add JS      
       
    }

    // Add JS for elementor
    public function ova_enqueue_scripts_elementor(){
        wp_register_script( 'script-elementor', OVA_PLUGIN_URI. 'assets/js/script-elementor.js', [ 'jquery' ], false, true );
    }

    

    public function includes(){
        
        // All hooks use in Theme
        include OVA_PLUGIN_PATH.'inc/hooks.php';

        /* Customize Menu Struct */
        include OVA_PLUGIN_PATH.'inc/ova-walker-menu.php';

        /* Shortcode */
        include OVA_PLUGIN_PATH.'shortcode/shortcode.php';
        
    }


}

if (!function_exists('Ova')) {
    /**
     * @return OvaFramework
     */
    function Ova() {
        return OvaFramework::getInstance();
    }
}
Ova();




