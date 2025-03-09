<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVAEV_metaboxes_render_event' ) ){

	class OVAEV_metaboxes_render_event{

		public static function render(){

			require_once( OVAEV_PLUGIN_PATH. '/admin/views/ovaev-metabox-event.php' );

		}

		public static function save($post_id, $post_data){
			
			if( empty($post_data) ) exit();

			// Checked Special
			if( array_key_exists('ovaev_special', $post_data) == false ){
				$post_data['ovaev_special'] = '';
			}else{
				$post_data['ovaev_special'] = 'checked';
			}

			// Check gallery exits
			if( !$post_data['ovaev_gallery_id'] ){
				$post_data['ovaev_gallery_id'] = '';
			}

			foreach ($post_data as $key => $value) {

				if($key == 'ovaev_start_date') $value = strtotime($value);
				if($key == 'ovaev_end_date') $value = strtotime($value);

				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}
?>