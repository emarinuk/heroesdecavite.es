<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVAEV_Settings {
	


	public static function google_key_map(){
		$ops = get_option('ovaev_options');
		return isset( $ops['google_key_map'] ) ? $ops['google_key_map'] : '';
	}

	public static function event_map_zoom(){
		$ops = get_option('ovaev_options');
		return isset( $ops['event_map_zoom'] ) ? $ops['event_map_zoom'] : '';
	}

	public static function ovaev_event_post_type_rewrite_slug(){
		$ops = get_option('ovaev_options');
		return isset( $ops['ovaev_event_post_type_rewrite_slug'] ) ? $ops['ovaev_event_post_type_rewrite_slug'] : '';
	}

	public static function ovaev_show_past(){
		$ops = get_option('ovaev_options');
		return isset( $ops['ovaev_show_past'] ) ? $ops['ovaev_show_past'] : 'yes';
	}

	public static function archive_event_orderby(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_orderby'] ) ? $ops['archive_event_orderby'] : 'title';
	}

	public static function archive_event_order(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_order'] ) ? $ops['archive_event_order'] : 'ASC';
	}

	public static function archive_event_heading(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_heading'] ) ? $ops['archive_event_heading'] : '';
	}

	public static function archive_event_desc(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_desc'] ) ? $ops['archive_event_desc'] : '';
	}

	public static function archive_event_type(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_type'] ) ? $ops['archive_event_type'] : 'type1';
	}

	

	public static function archive_format_date_lang(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_format_date_lang'] ) ? $ops['archive_format_date_lang'] : 'en';
	}


	public static function archive_event_header(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_header'] ) ? $ops['archive_event_header'] : 'default';
	}

	public static function archive_event_footer(){
		$ops = get_option('ovaev_options');
		return isset( $ops['archive_event_footer'] ) ? $ops['archive_event_footer'] : 'default';
	}


	public static function single_event_header(){
		$ops = get_option('ovaev_options');
		return isset( $ops['single_event_header'] ) ? $ops['single_event_header'] : 'default';
	}

	public static function single_event_footer(){
		$ops = get_option('ovaev_options');
		return isset( $ops['single_event_footer'] ) ? $ops['single_event_footer'] : 'default';
	}

	

}

new OVAEV_Settings();