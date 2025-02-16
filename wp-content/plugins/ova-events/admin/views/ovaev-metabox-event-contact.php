<?php

if( !defined( 'ABSPATH' ) ) exit();

global $post;

$ovaev_organizer = get_post_meta( $post->ID, 'ovaev_organizer', true );

$ovaev_phone     = get_post_meta( $post->ID, 'ovaev_phone', true );

$ovaev_email     = get_post_meta( $post->ID, 'ovaev_email', true );

$ovaev_website   = get_post_meta( $post->ID, 'ovaev_website', true );

// echo "<pre>";
// var_dump($post->post_name); die;
// var_dump($date); die;


?>
<div class="ovaev_metabox">

	<br>
	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Organizer Name:', 'oavev' ); ?></strong></label>
		<input type="text" id="ovaev_organizer" value="<?php echo esc_attr($ovaev_organizer); ?>" placeholder="Insert Organizer Name"  name="ovaev_organizer" autocomplete="off"/>
	</div>
	<br>

	
	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Phone:', 'oavev' ); ?></strong></label>
		<input type="text" id="ovaev_phone" value="<?php echo esc_attr($ovaev_phone); ?>" placeholder="Insert Phone"  name="ovaev_phone" autocomplete="off"/>
	</div>
	<br>
	
	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Email:', 'oavev' ); ?></strong></label>
		<input type="text" id="ovaev_email" value="<?php echo esc_attr($ovaev_email); ?>" placeholder="Insert Email"  name="ovaev_email" autocomplete="off"/>
	</div>
	<br>

	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Website:', 'oavev' ); ?></strong></label>
		<input type="text" id="ovaev_website" value="<?php echo esc_attr($ovaev_website); ?>" placeholder="Insert Website"  name="ovaev_website" autocomplete="off"/>
	</div>
	<br>


</div>

<?php wp_nonce_field( 'ovaev_nonce', 'ovaev_nonce' ); ?>