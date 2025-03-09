<?php
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVAEV_admin_menu' ) ){

	class OVAEV_admin_menu{

		public function __construct(){
			$this->init();
		}

		public function init(){
			add_action( 'admin_menu', array( $this, 'OVAEV_register_menu' ) );
		}

		public function OVAEV_register_menu(){

			// Get Options
			
			add_menu_page( 
				__( 'Event', 'ovaev' ), 
				__( 'Event', 'ovaev' ), 
				'edit_posts',
				'ovaev-menu', 
				null,
				'dashicons-calendar', 
				4
			);

			add_submenu_page( 
				'ovaev-menu', 
				__( 'Type', 'ovaev' ), 
				__( 'Type', 'ovaev' ), 
				'administrator',
				'edit-tags.php?taxonomy=event_type'.'&post_type=event'
			);

			add_submenu_page( 
				'ovaev-menu', 
				__( 'Settings', 'ovaev' ),
				__( 'Settings', 'ovaev' ),
				'administrator',
				'ovaev_general_settings',
				array( 'OVAEV_Admin_Settings', 'create_admin_setting_page' )
			);

		}

	}
	new OVAEV_admin_menu();

}