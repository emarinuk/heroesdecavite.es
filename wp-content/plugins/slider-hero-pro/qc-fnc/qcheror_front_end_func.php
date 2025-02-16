<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param $id
 * @return string
 */

function qcld_slide_show_published_sliders($atts ) {
	global $wpdb;
	$id = $atts['id'];
	$query   = $wpdb->prepare( "SELECT * FROM " . QCLD_TABLE_SLIDERS . " WHERE id = '%d' ", $id );
	$qcheror = $wpdb->get_results( $query );
	
	$params = json_decode($qcheror[0]->params);
	$orderby = 'DESC';
	if(isset($params->reverse_slide) && $params->reverse_slide==1){
		$orderby = 'ASC';
	}

	$query   = $wpdb->prepare( "SELECT * FROM " . QCLD_TABLE_SLIDES . " WHERE sliderid = '%d' ORDER BY ordering $orderby", $id );
	$qcheros = $wpdb->get_results( $query );
	
	return qcld_slider_front_end( $id, $qcheror, $qcheros, $atts );
}

function hero_get_user_name(){
	$current_user = wp_get_current_user();
	
	if( ! $current_user ) {
		return '';
	}
	return trim( $current_user->user_nicename );
}

function hero_handle_variables( $text ) {

	$username = hero_get_user_name();

	//Check if no default username
	if (strpos($text, '{user}') !== false) {
		$text = str_replace( '{user}', $username, $text );
	}

	//Check if there is default username
	$default_name = '';
	if (strpos($text, '{user|') !== false) {
		$textpart = explode( '{user|', $text );
		$textpart = explode( '}', $textpart[1] );
		$default_name = trim( $textpart[0] );
	}

	if( $username == '' && $default_name != '' ){
		$text = str_replace( '{user|'.$default_name.'}', $default_name, $text );
	} elseif( $username != '' ) {
		$text = str_replace( '{user|'.$default_name.'}', $username, $text );
	}

	return $text;
}
