<?php

if( !defined( 'ABSPATH' ) ) exit();

global $post;

$lang = OVAEV_Settings::archive_format_date_lang();
$date = 'Y/m/d';
$time = 'H:i';

$ovaev_start_date = get_post_meta( $post->ID, 'ovaev_start_date', true );
$ovaev_end_date   = get_post_meta( $post->ID, 'ovaev_end_date', true );

$date;
if( $ovaev_start_date && $ovaev_end_date ){
	$ovaev_start_date_time = date_i18n( $date .' '. $time, $ovaev_start_date );
	$ovaev_end_date_time   =  date_i18n( $date .' '. $time, $ovaev_end_date );	
}else{
	$ovaev_start_date_time = $ovaev_end_date_time = '';
}

$ovaev_venue       = get_post_meta( $post->ID, 'ovaev_venue', true );

$ovaev_duaration   = get_post_meta( $post->ID, 'ovaev_duaration', true );

$ovaev_book        = get_post_meta( $post->ID, 'ovaev_book', true );

$ovaev_book_link   = get_post_meta( $post->ID, 'ovaev_book_link', true );

$ovaev_target_book = get_post_meta( $post->ID, 'ovaev_target_book', true );

$checked           = get_post_meta( $post->ID, 'ovaev_special', true ) ? get_post_meta( $post->ID, 'ovaev_special', true ) : '' ;

$event_custom_sort = get_post_meta( $post->ID, 'event_custom_sort', true ) ? get_post_meta( $post->ID, 'event_custom_sort', true ) : '1' ;

?>
<div class="ovaev_metabox">

	<br>
	<div class="ovaev_row">
		<label class="label" "><strong><?php esc_html_e( 'Date', 'ovaev' ); ?>: </strong></label>
		<input type="text" id="ovaev_start_date" class="ovaev_start_date" data-lang="<?php echo esc_attr($lang);?>" data-date="<?php echo esc_attr($date .' '. $time);?>" value="<?php echo esc_attr($ovaev_start_date_time); ?>" placeholder="Start Time"  name="ovaev_start_date" autocomplete="off" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" id="ovaev_end_date" class="ovaev_end_date" data-lang="<?php echo esc_attr($lang);?>" data-date="<?php echo esc_attr($date .' '. $time);?>"  value="<?php echo esc_attr($ovaev_end_date_time); ?>" placeholder="End Time"  name="ovaev_end_date" autocomplete="off" />
	</div>
	<br>

	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Venue:', 'ovaev' ); ?></strong></label>
		<input type="text" id="ovaev_venue" value="<?php echo esc_attr($ovaev_venue); ?>" placeholder="New York"  name="ovaev_venue" autocomplete="off" />
	</div>
	<br>

	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Duration:', 'ovaev' ); ?></strong></label>
		<input type="text" id="ovaev_duaration" value="<?php echo esc_attr($ovaev_duaration); ?>" placeholder="60 Minutes"  name="ovaev_duaration" autocomplete="off" />
	</div>
	<br>

	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Book:', 'ovaev' ); ?></strong></label>
		<?php
		$free_selected = ( 'free' == $ovaev_book )? 'selected' : '';
		$extra_link_selected = ( 'extra_link' == $ovaev_book )? 'selected' : '';

		$target_self = ( '_self' == $ovaev_target_book )? 'selected' : '';
		$target_blank = ( '_blank' == $ovaev_target_book )? 'selected' : '';
		?>
		<select id="ovaev_book" name="ovaev_book">
			<option <?php echo $free_selected ?> value="free"><?php esc_html_e( 'Free', 'ovaev' ); ?></option>
			<option <?php echo $extra_link_selected ?> value="extra_link"><?php esc_html_e( 'Extra Link', 'ovaev' ); ?></option>
			<input type="text" id="ovaev_book_link" value="<?php echo esc_attr($ovaev_book_link); ?>" placeholder="Insert link"  name="ovaev_book_link" autocomplete="off" />
		</select>
		<select id="ovaev_target_book" name="ovaev_target_book">
			<option <?php echo $target_self ?> value="_self"><?php esc_html_e( 'Self', 'ovaev' ); ?></option>
			<option <?php echo $target_blank ?> value="_blank"><?php esc_html_e( 'Blank', 'ovaev' ); ?></option>
		</select>
	</div>
	<br>

	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Special Event:', 'ovaev' ); ?></strong></label>
		<input type="checkbox" value="<?php echo esc_attr($checked); ?>" name="ovaev_special" <?php echo esc_attr($checked); ?> />
	</div>
	<br>

	<div class="ovaev_row">
		<label class="label"><strong><?php esc_html_e( 'Custom Sort:', 'ovaev' ); ?></strong></label>
		<input type="number" value="<?php echo esc_attr($event_custom_sort); ?>" name="event_custom_sort" />
	</div>
	<br>

</div>

<?php wp_nonce_field( 'ovaev_nonce', 'ovaev_nonce' ); ?>