<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVAEV_get_data {
	public function __construct() {

		add_filter( 'OVAEV_event', array( $this, 'OVAEV_event' ), 10, 0 );
		add_filter( 'OVAEV_event_type', array( $this, 'OVAEV_event_type' ), 10, 1 );

		add_filter( 'OVAEV_search_event', array( $this, 'OVAEV_search_event' ), 10, 1 );

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ), 1, 1);

	}

	private function OVAEV_query_base( $paged = '',  $show_past = 'yes', $order = 'ASC', $orderby = 'title'  ){

		$args_base = $args_paged = $args_type = $args_orderby = $args_past = array();

		$args_base = array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'order'	=> $order
		);

		if( is_tax( 'event_type' ) ||  get_query_var( 'event_type' ) != '' ){
			$args_type = array( 
				'tax_query' => array(
					array(
						'taxonomy' => 'event_type',
						'field'    => 'slug',
						'terms'    => get_query_var( 'event_type' ),
					)
				)
			);
		}
		
		$args_paged = ( $paged != '' ) ? array( 'paged' => $paged ) : array();
		
		if( $show_past == 'no' ){
			$args_past = array(
				'meta_query' => array(
					array(
						'key' => 'ovaev_end_date',
						'value' => current_time( 'timestamp' ),
						'compare' => '>'
					)
				)
			);
		}

		switch ($orderby) {
			case 'title':
			$args_orderby =  array( 'orderby' => 'title' );
			break;

			case 'event_custom_sort':
			$args_orderby =  array( 'orderby' => 'meta_value_num', 'meta_key' => $orderby );
			break;

			case 'ovaev_start_date':
			$args_orderby =  array( 'orderby' => 'meta_value_num', 'meta_key' => $orderby );
			break;
			
			case 'ID':
			$args_orderby =  array( 'orderby' => 'ID');
			break;
			
			default:
			break;
		}
		return array_merge_recursive( $args_base, $args_paged, $args_type, $args_past, $args_orderby );
	}


	public function OVAEV_event(){

		$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$show_past = OVAEV_Settings::ovaev_show_past();
		$order     = OVAEV_Settings::archive_event_order();
		$orderby   = OVAEV_Settings::archive_event_orderby();

		$args_basic = $this->OVAEV_query_base( $paged, $show_past, $order, $orderby);
		// var_dump($args_basic); die;
		$event = new WP_Query( $args_basic );
		
		return $event;
	}


	/**
	 * Categories Event Type
	 */
	public function OVAEV_event_type($selected){

		$args = array(
			'show_option_all'   => '' ,
			'show_option_none'   => esc_html__( 'All Event Type', 'ovaev' ),
			'post_type'         => 'event',
			'post_status'       => 'publish',
			'posts_per_page'    => '-1',
			'option_none_value' => '',
			'orderby'           => 'ID',
			'order'             => 'ASC',
			'show_count'        => 0,
			'hide_empty'        => 0,
			'child_of'          => 0,
			'exclude'           => '',
			'include'           => '',
			'echo'              => 1,
			'selected'          => $selected,
			'hierarchical'      => 1,
			'name'              => 'ovaev_type',
			'id'                => '',
			'depth'             => 0,
			'tab_index'         => 0,
			'taxonomy'          => 'event_type',
			'hide_if_empty'     => false,
			'value_field'       => 'slug',

		);

		$event_type = new WP_Query( $args );

		// return $event_type;
		return wp_dropdown_categories($args);
	}


	/**
	 * Upload File
	 */
	function upload_mimes($mimes){
		$mimes['zip'] = 'application/zip';
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}


	/**
	 * Search Event
	 */
	public function OVAEV_search_event($params){


		$cat = isset( $params['ovaev_type'] ) ? esc_html( $params['ovaev_type'] ) : '' ;
		$ovaev_start_date_search = isset( $params['ovaev_start_date_search'] ) ? esc_html( $params['ovaev_start_date_search'] ) : '' ;
		$ovaev_end_date_search = isset( $params['ovaev_end_date_search'] ) ? esc_html( $params['ovaev_end_date_search'] ) : '' ;
		
		$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$show_past = OVAEV_Settings::ovaev_show_past();
		$order     = OVAEV_Settings::archive_event_order();
		$orderby   = OVAEV_Settings::archive_event_orderby();

		// Init query
		$args_basic = $args_tax = $args_date = array();

		// Query base
		$args_basic = $this->OVAEV_query_base( $paged, $show_past, $order, $orderby );

		// Query Taxonomy
		if($cat){
			$args_tax = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'event_type',
						'field'    => 'slug',
						'terms' => $cat
					)
				)
			);
		}


		// Query Date
		if( $ovaev_start_date_search && $ovaev_end_date_search ){

			$args_date = array(
				'meta_query' => array(

					array(
						'relation' => 'OR',
						array(
							'key' => 'ovaev_start_date',
							'value' => array( strtotime($ovaev_start_date_search)-1, strtotime($ovaev_end_date_search)+(24*60*60)+1 ),
							'type' => 'numeric',
							'compare' => 'BETWEEN'	
						),
						array(
							'relation' => 'AND',
							array(
								'key' => 'ovaev_start_date',
								'value' => strtotime($ovaev_start_date_search),
								'compare' => '<'
							),
							array(
								'key' => 'ovaev_end_date',
								'value' => strtotime($ovaev_start_date_search),
								'compare' => '>='
							)
						)
					)
				)
			);
		}
		else if ( $ovaev_start_date_search && !$ovaev_end_date_search ){

			$args_date = array(
				'meta_query' => array(

					array(
						'relation' => 'OR',
						array(
							'key' => 'ovaev_start_date',
							'value' => strtotime($ovaev_start_date_search),
							'compare' => '>='
						),
						array(
							'relation' => 'AND',
							array(
								'key' => 'ovaev_start_date',
								'value' => strtotime($ovaev_start_date_search),
								'compare' => '<'
							),
							array(
								'key' => 'ovaev_end_date',
								'value' => strtotime($ovaev_start_date_search),
								'compare' => '>='
							)
						)
					)
				)
			);
		}
		else if ( !$ovaev_start_date_search && $ovaev_end_date_search ){

			$args_date = array(
				'meta_query' => array(
					'key' => 'ovaev_end_date',
					'value' => strtotime($ovaev_end_date_search)+(24*60*60),
					'compare' => '<='
				)

			);
		}


		$args = array_merge_recursive( $args_basic, $args_tax, $args_date);

		$events = new WP_Query( $args );

		return $events;
	}


}
new OVAEV_get_data();