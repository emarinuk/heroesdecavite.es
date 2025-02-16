<?php 

$get_search = isset( $_GET["search_event"] ) ? $_GET["search_event"] : '';

/* Search Event */
if( $get_search == 'search-event' ){

	$events = apply_filters( 'OVAEV_search_event', $_REQUEST );

} else {

	$events = apply_filters( 'OVAEV_event', 10 );
}

$get_search_cat          = isset( $_GET["ovaev_type"] ) ? $_GET["ovaev_type"] : '';
$ovaev_start_date_search = isset( $_GET["ovaev_start_date_search"] ) ? $_GET["ovaev_start_date_search"] : '';
$ovaev_end_date_search   = isset( $_GET["ovaev_end_date_search"] ) ? $_GET["ovaev_end_date_search"] : '';

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
			<input class="ovaev_submit" type="submit" value="Find Event" />
		</form>
	</div>

	<div class="archive_event type1">

		<?php if($events->have_posts() ) : while ( $events->have_posts() ) : $events->the_post(); ?>
			<?php

			$id = get_the_id();

			$thumb_bgr = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' ); 

			$ovaev_venue = get_post_meta( $id, 'ovaev_venue', true );

			$event_type  = get_the_terms( $id, 'event_type') ? get_the_terms( $id, 'event_type') : '' ;

			$value_event_type = '';
			if ( $event_type != '' ) {
				foreach ( $event_type as $value ) {
					$value_event_type .= '<span class="event_type">' .$value->name. '</span>' ;
					$value_event_type .= ', ';
				}
			}
			

			$ovaev_start_date = get_post_meta( $id, 'ovaev_start_date', true );
			$ovaev_end_date   = get_post_meta( $id, 'ovaev_end_date', true );

			$date_start    = $ovaev_start_date != '' ? date_i18n(get_option('date_format'), $ovaev_start_date) : '';
			$time_start    = $ovaev_start_date != '' ? date_i18n(get_option('time_format'), $ovaev_start_date) : '';
			$date_end      = $ovaev_end_date != '' ? date_i18n(get_option('date_format'), $ovaev_end_date) : '';
			$time_end      = $ovaev_end_date != '' ? date_i18n(get_option('time_format'), $ovaev_end_date) : '';
			
			$date_event    = $ovaev_start_date != '' ? date_i18n('d', $ovaev_start_date ) : '';
			$month_event_M = $ovaev_start_date != '' ? date_i18n('M', $ovaev_start_date ) : '';
			$month_event_F = $ovaev_start_date != '' ? date_i18n('F', $ovaev_start_date ) : '';
			$week_day      = $ovaev_start_date != '' ? date_i18n('l', $ovaev_start_date ) : '';
			$year_event    = $ovaev_start_date != '' ? date_i18n('Y', $ovaev_start_date ) : '';


			$ovaev_book        = get_post_meta( $id, 'ovaev_book', true );
			$ovaev_book_link   = get_post_meta( $id, 'ovaev_book_link', true );
			$ovaev_target_book = get_post_meta( $id, 'ovaev_target_book', true );
			
			?>


			<div class="content">
				<div class="date-event">
					<span class="date-month"><?php  echo esc_html($date_event);?><span class="month"><?php  echo esc_html($month_event_F);?></span></span>
					<span class="weekday second_font"><?php  echo esc_html($week_day);?></span>					
				</div>
				<div class="desc">
					<div class="event-thumbnail">						
						<?php the_post_thumbnail( 'post-thumbnail', '' ); ?>
					</div>
					<div class="event_post">
						<div class="post_cat">
							<?php echo  substr($value_event_type, 0, -2) ; ?>
						</div>
                        <?php if($ovaev_venue == 'nada'){ ?>
						<h2 class="second_font event_title"><a href="#"><?php echo get_the_title(); ?></a></h2>
                        <?php } else { ?>
                            <h2 class="second_font event_title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                        <?php } ?>
						<div class="time-event">
							<?php if( $date_start === $date_end && $date_end != '' && $date_start != '' ){ ?>
								
								<span><?php echo esc_html($time_start); ?> -</span>
								<span>
									<?php echo esc_html($time_end); ?> 
									<?php if( $ovaev_venue ){ ?>/ <?php } ?>
								</span>
								
								<span class="number"><?php echo esc_attr( $ovaev_venue ); ?></span>

							<?php } elseif( $date_start != $date_end && $date_end && $date_start != '' ){ ?>

								<span><?php echo esc_html($date_start);?> -</span>
								
								<span>
									<?php echo esc_html($date_end);?> 
									<?php if( $ovaev_venue ){ ?>/ <?php } ?>
								</span>

								<span class="number"><?php echo esc_attr( $ovaev_venue ); ?></span>

							<?php } ?>
						</div>
						<div class="button_event">
							<a class="view_detail" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'ovaev' );?></a>
							<?php							
							if ('extra_link' == $ovaev_book) { ?>
								<a class="book" href="<?php echo esc_html( $ovaev_book_link ); ?>" target="<?php echo esc_html( $ovaev_target_book ); ?>"><?php esc_html_e('Book Online','ovaev');?></a>
							<?php } 
							else { ?>
								<span class="book btn-free"><?php esc_html_e('Free','ovaev');?></span>
							<?php } ?>
						</div>
					</div>
				</div>
				
			</div>


		<?php endwhile; 
		else: ?>
			<div class="search_not_found">
				<?php esc_html_e( 'Not Found Events', 'ovaev' ); ?>
			</div>
		<?php endif; wp_reset_postdata(); ?>

		<?php ovaev_pagination_plugin($events); ?>
		
	</div>

</div>
