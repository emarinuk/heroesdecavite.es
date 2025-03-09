<?php if ( !defined( 'ABSPATH' ) ) exit();

get_header( );


$get_search = isset( $_GET["search_event"] ) ? $_GET["search_event"] : '';

/* Search Event */
if( $get_search == 'search-event' ){

	$events = apply_filters( 'OVAEV_search_event', $_REQUEST );
	$events1 =  apply_filters( 'OVAEV_search_event', $_REQUEST );
	
} else {

	$events = apply_filters( 'OVAEV_event', 10 );
	$events1 = apply_filters( 'OVAEV_event', 10 );
}

$get_search_cat = isset( $_GET["ovaev_type"] ) ? $_GET["ovaev_type"] : '';
$ovaev_start_date_search = isset( $_GET["ovaev_start_date_search"] ) ? $_GET["ovaev_start_date_search"] : '';
$ovaev_end_date_search = isset( $_GET["ovaev_end_date_search"] ) ? $_GET["ovaev_end_date_search"] : '';

if( is_tax( 'event_type' ) ||  get_query_var( 'event_type' ) != '' ){
	$get_search_cat = get_query_var( 'event_type' );
}

$lang = OVAEV_Settings::archive_format_date_lang();
$date = 'Y/m/d';
$time = 'H:i';
?>

<div class="container">
	

	<div class="heading_archive_event">
		<?php 
		$archive_event_heading   = OVAEV_Settings::archive_event_heading();
		$archive_event_desc      = OVAEV_Settings::archive_event_desc();
		if ($archive_event_heading != '') {
			?>
			<h1 class="heading_event second_font"><?php echo $archive_event_heading; ?></h1>
			<?php
		}
		if ($archive_event_desc != '') {
			?>
			<p class="desc_event second_font"><?php echo $archive_event_desc; ?></p>
			<?php
		}
		?>
	</div>

	<div class="search_archive_event">
		<form action="<?php echo esc_url(get_post_type_archive_link( 'event' )); ?>" method="GET" name="search_event" autocomplete="off">
			<div class="start_date">
				<input type="text" id="ovaev_start_date_search" class="ovaev_start_date_search" data-lang="<?php echo esc_attr($lang); ?>" data-date="<?php echo esc_attr($date); ?>" data-time="<?php echo esc_attr($time); ?>" placeholder="<?php echo esc_html_e( 'Start Time', 'ovaev' ); ?>" name="ovaev_start_date_search" value="<?php echo esc_attr( $ovaev_start_date_search ); ?>" required/>
			</div>
			<div class="end_date">
				<input type="text" id="ovaev_end_date_search" class="ovaev_end_date_search" data-lang="<?php echo esc_attr($lang); ?>" data-date="<?php echo esc_attr($date); ?>" placeholder="<?php echo esc_html_e( 'End Time', 'ovaev' ); ?>" name="ovaev_end_date_search" value="<?php echo esc_attr( $ovaev_end_date_search ); ?>" />
			</div>
			<div class="ovaev_cat_search"><?php $dropdown_args1 = apply_filters( 'OVAEV_event_type', $get_search_cat ); ?></div>
			<input type="hidden" name="post_type" value="event">
			<input type="hidden" name="search_event" value="search-event">
			<input class="ovaev_submit" type="submit" value="<?php esc_html_e('Find Event','ovaev');?>" />
		</form>
	</div>
	<div class="archive_event type3">
		<?php

		$events_array = array();
		$key = 0;
		
		$html = '';
		if($events->have_posts() ) : while ( $events->have_posts() ) : $events->the_post();
			$k = 0;
			$id1              = get_the_id();
			$ovaev_start_date = get_post_meta( $id1, 'ovaev_start_date', true);
			$date1            = $ovaev_start_date != '' ? date_i18n(get_option('date_format'), $ovaev_start_date) : '';
			

			if( !in_array_r($date1, $events_array) ){

				if($events1->have_posts() ) : while ( $events1->have_posts() ) : $events1->the_post();
					
					$id2               = get_the_id();
                    $ovaev_start_date2 = get_post_meta( $id2, 'ovaev_start_date', true);
					$ovaev_end_date2   = get_post_meta( $id2, 'ovaev_end_date', true );
					$date2             = $ovaev_start_date2 != '' ? date_i18n(get_option('date_format'), $ovaev_start_date2) : '';
					$date_event        = $ovaev_start_date2 != '' ? date_i18n('d', $ovaev_start_date2 ) : '';	
					$month_event_F     = $ovaev_start_date2 != '' ? date_i18n('F', $ovaev_start_date2 ) : '';
					$week_day          = $ovaev_start_date2 != '' ? date_i18n('l', $ovaev_start_date2 ) : '';
					$date_start        = $ovaev_start_date2 != '' ? date_i18n(get_option('date_format'), $ovaev_start_date2) : '';
					$time_start        = $ovaev_start_date2 != '' ? date_i18n(get_option('time_format'), $ovaev_start_date2) : '';
					$date_end          = $ovaev_end_date2 != '' ? date_i18n(get_option('date_format'), $ovaev_end_date2) : '';
					$time_end          = $ovaev_end_date2 != '' ? date_i18n(get_option('time_format'), $ovaev_end_date2) : '';
					$ovaev_venue       = get_post_meta( $id2, 'ovaev_venue', true );

					$ovaev_book        = get_post_meta( $id2, 'ovaev_book', true );
					$ovaev_book_link   = get_post_meta( $id2, 'ovaev_book_link', true );
					$ovaev_target_book = get_post_meta( $id2, 'ovaev_target_book', true );

					if( $date1 == $date2 && $date1!= '' && $date2!= ''){

						$events_array[$key][$k]['date']          = $date2;
						$events_array[$key][$k]['date_start']    = $date_start;
						$events_array[$key][$k]['date_end']      = $date_end;
						$events_array[$key][$k]['time_start']    = $time_start;
						$events_array[$key][$k]['time_end']      = $time_end;
						$events_array[$key][$k]['date_event']    = $date_event;
						$events_array[$key][$k]['month_event_F'] = $month_event_F;
						$events_array[$key][$k]['week_day']      = $week_day;

						$events_array[$key][$k]['ovaev_book']        = $ovaev_book;
						$events_array[$key][$k]['ovaev_book_link']   = $ovaev_book_link;
						$events_array[$key][$k]['ovaev_target_book'] = $ovaev_target_book;

						$events_array[$key][$k]['title']     = get_the_title();
						$events_array[$key][$k]['permalink'] = get_the_permalink();
						$events_array[$key][$k]['id']        = get_the_id();
						$events_array[$key][$k]['thumbnail'] = get_the_post_thumbnail();

						$events_array[$key][$k]['excerpt'] = get_the_excerpt();

						$events_array[$key][$k]['ovaev_venue'] = $ovaev_venue;

						$k++;
					}

				endwhile;endif; wp_reset_postdata();

				$key++;

			}

		endwhile;endif; wp_reset_postdata();

		if( !empty($events_array) ){
			foreach ($events_array as $key_event => $value) { ?>

				<div class="content">
					<div class="extra-event">
						<?php
						$j = 0; 
						foreach ($value as $key1 => $value1) {
							$class_extra = ( $j % 2 == 0 ) ? '' : 'extra';
							?>
							<div class="desc <?php echo esc_attr($class_extra);?>">
								<div class="event-thumbnail">						
									<?php echo $value1['thumbnail']; ?>
								</div>
								<div class="event_post">
									<div class="post_cat">
										<?php 
										$taxonomy = 'event_type';
										$terms = get_the_terms( $value1['id'],$taxonomy );
										if ( $terms && ! is_wp_error($terms) ) :
											$tslugs_arr = array();
											foreach ($terms as $term) {
												$tslugs_arr[] = $term->name;
											}
											$terms_slug_str = join( ",", $tslugs_arr); ?>
											<span class="event_type"><?php echo esc_html($terms_slug_str);?></span>
										<?php endif; ?>
									</div>
                                    <?php if($value1['duaration'] < 0){ ?>
                                        <h2 class="second_font event_title"><a href="<?php echo esc_html($value1['permalink']);?>"><?php echo esc_html($value1['title']); ?></a></h2>

                                    <?php
                                        echo 'XXX';
                                    } else { ?>
                                        <h2 class="second_font event_title"><a href="<?php echo esc_html($value1['permalink']);?>"><?php echo esc_html($value1['title']); ?></a></h2>
                                    <?php
                                        echo 'YYY';
                                    } ?>
									<div class="time-event">							
										<span class="evn-mobile"><?php echo esc_html__('Time: ', 'ovaev') .esc_html($value1['week_day']).',&nbsp;'.esc_html($value1['date_start']);?></span>							
										<?php if( $value1['date_start'] == $value1['date_end'] && $value1['date_start'] != '' && $value1['date_end'] != '' ){ ?>

											<span>
												<?php echo esc_html($value1['time_start']); ?> -
											</span>

											<span>
												<?php echo esc_html($value1['time_end']); ?> 
												<?php if( $value1['ovaev_venue'] ){ ?>/ <?php } ?>
											</span>

											<span class="number">
												<?php echo esc_attr( $value1['ovaev_venue'] ); ?>
											</span>

										<?php } elseif( $value1['date_start'] != $value1['date_end'] && $value1['date_start'] != '' && $value1['date_end'] != '' ){ ?>

											<span>
												<?php echo esc_html($value1['date_start']);?> -
											</span>
											<span>
												<?php echo esc_html($value1['date_end']);?> 
												<?php if( $value1['ovaev_venue'] ){ ?>/ <?php } ?>
											</span>

											<span class="number">
												<?php echo esc_attr( $value1['ovaev_venue'] ); ?>
											</span>
											
										<?php } ?>
									</div>
									<?php if ( function_exists('muzze_custom_text') ) { ?>
										<div class="excerpt"><?php echo $value1['excerpt']; ?></div>
									<?php } ?>
									<div class="button_event">
										<a class="view_detail" href="<?php echo esc_html($value1['permalink']);?>"><?php esc_html_e( 'Details', 'ovaev' );?></a>
										<?php					
										if ('extra_link' == $value1['ovaev_book']) { ?>
											<a class="book" href="<?php echo esc_url( $value1['ovaev_book_link'] ); ?>" target="<?php echo esc_attr($value1['ovaev_target_book']); ?>"><?php esc_html_e('Book Online','ovaev');?></a>
										<?php } 
										else { ?>
											<span class="book btn-free"><?php esc_html_e('Free','ovaev');?></span>
										<?php }
										?>
									</div>
								</div>
							</div>
							<?php $j++;} ?>
					</div>
				</div>
			<?php }
		} else{ ?>
			<div class="search_not_found">
				<?php esc_html_e( 'Not Found Events', 'ovaev' ); ?>
			</div>
		<?php } ?>
		<?php ovaev_pagination_plugin($events); ?>
	</div>
		
</div>
<?php get_footer();