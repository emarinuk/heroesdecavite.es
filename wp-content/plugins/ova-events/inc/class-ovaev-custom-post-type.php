<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVAEV_custom_post_type' ) ) {

	class OVAEV_custom_post_type{

		public function __construct(){

			add_action( 'init', array( $this, 'OVAEV_register_post_type_event' ) );


			add_action( 'init', array( $this, 'OVAEV_custom_taxonomy_type' ) );

		}

		
		function OVAEV_register_post_type_event() {

			$labels = array(
				'name'                  => _x( 'Events', 'Post Type General Name', 'ovaev' ),
				'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'ovaev' ),
				'menu_name'             => __( 'Events', 'ovaev' ),
				'name_admin_bar'        => __( 'Post Type', 'ovaev' ),
				'archives'              => __( 'Item Archives', 'ovaev' ),
				'attributes'            => __( 'Item Attributes', 'ovaev' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ovaev' ),
				'all_items'             => __( 'All Events', 'ovaev' ),
				'add_new_item'          => __( 'Add New Event', 'ovaev' ),
				'add_new'               => __( 'Add New Event', 'ovaev' ),
				'new_item'              => __( 'New Item', 'ovaev' ),
				'edit_item'             => __( 'Edit Event', 'ovaev' ),
				'view_item'             => __( 'View Item', 'ovaev' ),
				'view_items'            => __( 'View Items', 'ovaev' ),
				'search_items'          => __( 'Search Item', 'ovaev' ),
				'not_found'             => __( 'Not found', 'ovaev' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ovaev' ),
			);
			$args = array(
				'description'         => __( 'Post Type Description', 'ovaev' ),
				'labels'              => $labels,
				'supports'            => array( 'author', 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => 'ovaev-menu',
				'menu_position'       => 5,
				'query_var'           => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => array( 'slug' => _x( 'event', 'URL slug', 'ovaev' ) ),
				'capability_type'     => 'post',
			);
			register_post_type( 'event', $args );
		}
		

		// Register Custom Taxonomy Type
		function OVAEV_custom_taxonomy_type() {

			$labels = array(
				'name'                       => _x( 'Type', 'Post Type General Name', 'ovaev' ),
				'singular_name'              => _x( 'Type', 'Post Type Singular Name', 'ovaev' ),
				'menu_name'                  => __( 'Type', 'ovaev' ),
				'all_items'                  => __( 'All Type', 'ovaev' ),
				'parent_item'                => __( 'Parent Item', 'ovaev' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ovaev' ),
				'new_item_name'              => __( 'New Item Name', 'ovaev' ),
				'add_new_item'               => __( 'Add New Type', 'ovaev' ),
				'add_new'                    => __( 'Add New Type', 'ovaev' ),
				'edit_item'                  => __( 'Edit Type', 'ovaev' ),
				'view_item'                  => __( 'View Item', 'ovaev' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'ovaev' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'ovaev' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'ovaev' ),
				'popular_items'              => __( 'Popular Items', 'ovaev' ),
				'search_items'               => __( 'Search Items', 'ovaev' ),
				'not_found'                  => __( 'Not Found', 'ovaev' ),
				'no_terms'                   => __( 'No items', 'ovaev' ),
				'items_list'                 => __( 'Items list', 'ovaev' ),
				'items_list_navigation'      => __( 'Items list navigation', 'ovaev' ),
			);
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'publicly_queryable' => true,
				'public'            => true,
				'show_ui'           => true,
				'show_in_menu'      => 'ovaev-menu',
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'rewrite'             => array( 'slug' => _x( 'event_type', 'URL slug', 'ovaev' ) ),
			);
			register_taxonomy( 'event_type', array( 'event' ), $args );
		}

	}
	new OVAEV_custom_post_type();
}



