<?php

//if( !get_sliderhero_invalid_license_notice_dismiss_transient() ){
	add_action('admin_notices', 'qcld_sliderhero_invalid_license_notice');
	function qcld_sliderhero_invalid_license_notice(){
		if( (get_sliderhero_licensing_buy_from() != '') && (get_sliderhero_invalid_license()) ){
			if( (get_sliderhero_licensing_buy_from() == 'quantumcloud') && (get_sliderhero_licensing_key() == '') ){

			}elseif( (get_sliderhero_licensing_buy_from() == 'codecanyon') && (get_sliderhero_envato_key() == '') ){

			}else{
				$class="notice notice-error is-dismissible qc-notice-error";
				$message = "You have Entered an Invalid License Key for Slider Hero Pro";

				printf( '<div data-dismiss-type="qc-invalid-license" class="%1$s"><a href="'.esc_url('https://www.quantumcloud.com/products/').'" target="_blank"><img src="'.esc_url(QCLD_SLIDERHERO_PLUGIN_URL.'plugin-upgrader/images/qc-logo.jpg').'" /></a><p>%2$s</p></div>', esc_attr( $class ), $message ); 
			}
		}
	}
//}

if( !get_sliderhero_enter_license_notice_dismiss_transient() ){
	add_action('admin_notices', 'qcld_sliderhero_license_enter_notice');
	function qcld_sliderhero_license_enter_notice(){

		if( (get_sliderhero_licensing_buy_from() != '') && (get_sliderhero_invalid_license() != 1) ){

		}else{
			$class="notice notice-error is-dismissible qc-notice-error";
			

			$message = "Hi! Please enter the license key to receive automatic updates and premium support. <a href=".sliderhero_get_licensing_url().">Please activate your copy of Slider Hero Pro.</a>";

			printf( '<div data-dismiss-type="qc-enter-license" class="%1$s"><a href="'.esc_url('https://www.quantumcloud.com/products/').'" target="_blank"><img src="'.esc_url(QCLD_SLIDERHERO_PLUGIN_URL.'plugin-upgrader/images/qc-logo.jpg').'" /></a><p>%2$s</p></div>', esc_attr( $class ), $message ); 
		}
	}
}

//start new-update-for-codecanyon
function sliderhero_licensing_notice_dismiss_func(){
	check_ajax_referer('sliderhero_licensing_admin_nonce', 'nonce');

	if( sanitize_text_field($_GET['dismiss_notice']) == 'qc-enter-license' ){
		if( !get_sliderhero_enter_license_notice_dismiss_transient() ){
			set_sliderhero_enter_license_notice_dismiss_transient();
		}
	}

	if( sanitize_text_field($_GET['dismiss_notice']) == 'qc-invalid-license' ){
		if( !get_sliderhero_invalid_license_notice_dismiss_transient() ){
			set_sliderhero_invalid_license_notice_dismiss_transient();
		}
	}

}
add_action('wp_ajax_sliderhero_licensing_notice_dismiss', 'sliderhero_licensing_notice_dismiss_func');
//end new-update-for-codecanyon