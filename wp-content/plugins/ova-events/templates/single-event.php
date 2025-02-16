<?php if ( !defined( 'ABSPATH' ) ) exit();

get_header( );

$post_ID = get_the_ID();

$event_map_address = get_post_meta( $post_ID, 'ovaev_map_address', true );
$event_map_lat     = get_post_meta( $post_ID, 'ovaev_map_lat', true );
$event_map_lng     = get_post_meta( $post_ID, 'ovaev_map_lng', true );
$event_map_zoom    = OVAEV_Settings::event_map_zoom();

$event_name        = get_post_meta( $post_ID, 'ovaev_organizer', true);
$event_phone       = get_post_meta( $post_ID, 'ovaev_phone', true);
$event_email       = get_post_meta( $post_ID, 'ovaev_email', true);
$event_website     = get_post_meta( $post_ID, 'ovaev_website', true);
$event_gallery     = get_post_meta( $post_ID, 'ovaev_gallery_id', true);

//Order Ticket

$event_date        = get_post_meta( $post_ID, 'ovaev_date', true);
$event_time        = get_post_meta( $post_ID, 'ovaev_time', true);
$event_venue       = get_post_meta( $post_ID, 'ovaev_venue', true);
$event_duaration   = get_post_meta( $post_ID, 'ovaev_duaration', true);
$ovaev_book        = get_post_meta( $post_ID, 'ovaev_book', true );
$ovaev_book_link   = get_post_meta( $post_ID, 'ovaev_book_link', true );
$ovaev_target_book = get_post_meta( $post_ID, 'ovaev_target_book', true );


$ovaev_start_date = get_post_meta( $post_ID, 'ovaev_start_date', true );
$ovaev_end_date   = get_post_meta( $post_ID, 'ovaev_end_date', true);

$date_start   = $ovaev_start_date != '' ? date_i18n(get_option('date_format'), $ovaev_start_date ) : '';
$time_start   = $ovaev_start_date != '' ? date_i18n(get_option('time_format'), $ovaev_start_date ) : '';
$day_week_st  = $ovaev_start_date != '' ? date_i18n( 'l', $ovaev_start_date ) : ''; 

$date_end     = $ovaev_end_date != '' ? date_i18n(get_option('date_format'), $ovaev_end_date ) : '';
$time_end     = $ovaev_end_date  != '' ? date_i18n(get_option('time_format'), $ovaev_end_date ) : '';
$day_week_end = $ovaev_end_date != '' ? date_i18n( 'l', $ovaev_end_date ) : '';

// DAte google Calendar

$date_start_cld = $ovaev_start_date != '' ? date_i18n( 'm/d/Y H:i', $ovaev_start_date ) : '';
$date_end_cld   = $ovaev_end_date != '' ? date_i18n( 'm/d/Y H:i', $ovaev_end_date ) : '';


?>

<div class="single_event">
	<div class="container">
		<div class="title_top">
<!--			<a href="--><?php //echo esc_url(get_post_type_archive_link( 'event' )); ?><!--" class="back_event">--><?php //esc_html_e( 'Back to all Events', 'ovaev' );?><!--</a>-->
<!--			<h1 class="second_font">--><?php //the_title(); ?><!--</h1>-->
<!--			<div class="value_mid">-->
<!--				--><?php
//					if( $date_start == $date_end && $date_start != '' && $date_end != '' ){
//						echo '<span class="event-date">'.$day_week_st.',&nbsp;'.$date_start.'</span>';
//					} elseif( $date_start != $date_end && $date_start != '' && $date_end != ''){
//						echo '<span class="event-date">'.$date_start.',&nbsp;'.$time_start.'</span>'.'&nbsp;&#45;&nbsp;'.'<span class="event-date">'.$date_end.',&nbsp;'.$time_end.'</span>';
//					}
//				?>
<!--			</div>-->
		</div>
		<div class="event_content">
			<div class="row">
				<div class="col-md-8">	
					<div class="event_intro">
						<div class="image"><?php the_post_thumbnail(); ?></div>
						<div class="content">
							<?php if( have_posts() ) : while( have_posts() ) : the_post();
								the_content();
					 		?>
					 		<?php endwhile; endif; wp_reset_postdata(); ?>
						</div>
						<div class="tab-Location">
							<ul class="nav nav-tabs" role="tablist">
								
								<?php if( $event_map_lat && $event_map_lng ){ ?>	
								 	 <li class="nav-item">
								    	<a class="nav-link active" href="#location" role="tab" data-toggle="tab"><?php esc_html_e('Location','ovaev')?></a>
								  	</li>
							  	<?php } ?>
								
								<?php if( $event_name != '' ||  $event_phone != '' || $event_email != '' || $event_website != '' ){ ?>
								  	<li class="nav-item">
								    	<a class="nav-link" href="#contact" role="tab" data-toggle="tab"><?php esc_html_e('Contact Details','ovaev')?></a>
								 	</li>
							 	<?php } ?>
								
								<?php if( $event_gallery != '' ){  ?>
								  	<li class="nav-item">
								    	<a class="nav-link" href="#gallery" role="tab" data-toggle="tab"><?php esc_html_e('Gallery','ovaev')?></a>
								  	</li>
							  	<?php } ?>

							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								
								<?php if( $event_map_lat && $event_map_lng ){ ?>		
							  		<div role="tabpanel" class="tab-pane in active" id="location" style="height: 500px;" data-address="<?php echo esc_attr($event_map_address);?>" data-lat="<?php echo esc_attr($event_map_lat);?>" data-lng="<?php echo esc_attr($event_map_lng);?>" data-zoom="<?php echo esc_attr($event_map_zoom); ?>">
							  			
							  		</div>
						  		<?php } ?>
								
								<?php if( $event_name != '' ||  $event_phone != '' || $event_email != '' || $event_website != '' ){ ?>
							  		<div role="tabpanel" class="tab-pane fade" id="contact">
							  			<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="contact">
													<ul class="info-contact">
														<?php if( $event_name != '' ) : ?>
		 												<li>
															<span><?php esc_html_e('Organizer Name:','ovaev'); ?></span>
															<span class="info"><?php echo esc_html($event_name); ?></span>
														</li>
														<?php endif; ?>
														<?php if( $event_phone != '') : ?>
														<li>
															<span><?php esc_html_e('Phone:','ovaev'); ?></span>
															<span class="info"><?php echo esc_html($event_phone); ?></span>
														</li>
														<?php endif; ?>
													</ul>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="contact">
													<ul class="info-contact">
														<?php if( $event_email != '') : ?>
														<li>
															<span><?php esc_html_e('Email:','ovaev'); ?></span>
															<span class="info"><?php echo esc_html($event_email); ?></span>
														</li>
														<?php endif; ?>
														<?php if( $event_website != '') : ?>
														<li>
															<span><?php esc_html_e('Website:','ovaev'); ?></span>
															<span class="info"><?php echo esc_html($event_website); ?></span>
														</li>
														<?php endif; ?>
													</ul>
												</div>
											</div>
							  			</div>
							  		</div>
						  		<?php } ?>
								
								<?php if( $event_gallery != '' ) :  ?>
						 		 	<div role="tabpanel" class="tab-pane fade" id="gallery">
						 		 		<div class="row">
						 		 			<?php
						 		 			
						 		 			foreach ( $event_gallery as $items ) { ?>
						 		 				<div class="col-lg-6 col-md-6 col-sm-6 col-6">
													<div class="gallery-items">
														<?php
															$img_url = wp_get_attachment_image_url( $items, 'large' );
														?>
														<a href="<?php echo esc_url($img_url);?>" data-gal="prettyPhoto[gal]"><img src="<?php echo esc_url($img_url);?>" /></a> 
													</div>
												</div>
						 		 			<?php } ?>									
						 		 		</div>
						 		 	</div>
					 		 	<?php endif; ?>

							</div>
						</div>
						<?php if( $date_start != '' && $date_end != '' ) : ?>
						<div class="calendar-sync">
							<span class="sync">
								<a href="http://addtocalendar.com/atc/google?utz=420&amp;uln=en-US&amp;vjs=1.5&amp;e[0][date_start]=<?php echo esc_html($date_start_cld);?>&amp;e[0][date_end]=<?php echo esc_html($date_end_cld);?>&amp;e[0][timezone]=<?php echo get_option('timezone_string'); ?>&amp;e[0][title]=<?php echo get_the_title();?>&amp;e[0][description]=<?php echo get_the_excerpt();?>&amp;e[0][location]=<?php echo esc_html($event_map_address);?>&amp;e[0][organizer]=<?php echo esc_html($event_name);?>&amp;e[0][organizer_email]=<?php echo esc_html($event_email);?>" target="_blank" rel="nofollow"><?php esc_html_e( '+ Google Calendar', 'ovaev' );?></a>
								<a href="http://addtocalendar.com/atc/ical?utz=420&amp;uln=en-US&amp;vjs=1.5&amp;e[0][date_start]=<?php echo esc_html($date_start_cld);?>&amp;e[0][date_end]=<?php echo esc_html($date_end_cld);?>&amp;e[0][timezone]=<?php echo get_option('timezone_string'); ?>&amp;e[0][title]=<?php echo get_the_title();?>&amp;e[0][description]=<?php echo get_the_excerpt();?>&amp;e[0][location]=<?php echo esc_html($event_map_address);?>&amp;e[0][organizer]=<?php echo esc_html($event_name);?>&amp;e[0][organizer_email]=<?php echo esc_html($event_email);?>" target="_blank" rel="nofollow"><?php esc_html_e( '+ Ical Export', 'ovaev' );?></a>
							</span>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="wrapper_order">
						<div class="order_ticket">
							<?php 
							if ('extra_link' == $ovaev_book) { ?>
								<button type="" class="button_order"><a href="<?php echo esc_html( $ovaev_book_link ); ?>" target="<?php echo esc_html( $ovaev_target_book ); ?>"><?php esc_html_e('Book Online','ovaev');?></a></button>
							<?php } 
							else { ?>
								<button type="" class="button_order"><?php esc_html_e('Free','ovaev');?></button>
							<?php } ?>
							
							<ul class="info_order">
								<li><span class="label"><?php esc_html_e('Type:','ovaev');?></span>
									<?php 
									$taxonomy = 'event_type';
									$terms = get_the_terms( get_the_ID(),$taxonomy );
									if ( $terms && ! is_wp_error($terms) ) :
									    $tslugs_arr = array();
									    foreach ($terms as $term) {
									        $tslugs_arr[] = $term->name;
									    }
									    $terms_slug_str = join( ",", $tslugs_arr); ?>
									    <span><?php echo esc_html($terms_slug_str);?></span>
									<?php endif; ?>									
								</li>
								<li>
									<span class="label"><?php esc_html_e('Time:','ovaev');?></span>
									<?php if( $date_start === $date_end && $date_start != '' && $date_end != '' ){ ?>
										<span><?php echo esc_html($date_start) .'&nbsp;'.'&#45;'.'&nbsp;'. esc_html($time_start) .'&nbsp;'.'&#45;'.'&nbsp;'. esc_html($time_end);?></span>
									<?php } elseif( $date_start != $date_end && $date_start != '' && $date_end != '' ){ ?>
										<span><?php echo esc_html($date_start) .'&nbsp;'.'&#45;'.'&nbsp;'. esc_html($time_start);?></span>
										<span><?php echo esc_html($date_end) .'&nbsp;'.'&#45;'.'&nbsp;'. esc_html($time_end);?></span>
									<?php }
									?>

								</li>
								<?php if( $event_venue != '' ) : ?>
								<li><span class="label"><?php esc_html_e( 'Venue:', 'ovaev' );?></span><span><?php echo esc_html($event_venue);?></span></li>
								<?php endif; ?>
								<?php if( $event_duaration != '' ) : ?>
								<li><span class="label"><?php esc_html_e( 'Duration:', 'ovaev');?></span><span><?php echo esc_html($event_duaration); ?></span></li>
								<?php endif; ?>
							</ul>
							<?php if( has_filter( 'ova_share_social' ) ){ ?>
						        <div class="share_social">
						        	<i class="fa fa-share-alt"></i>
						        	<span class="ova_label"><?php esc_html_e('Share', 'ovaev'); ?></span>
						        	<?php echo apply_filters('ova_share_social', get_the_permalink(), get_the_title() ); ?>
						        </div>
					        <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<?php
	
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	?>
</div>


<div class="next-prev-nav">
	<div class="container">
		<div class="row">

			<div class="nav-prev text-left">
			    <?php previous_post_link( '<div class="nav-previous-post">%link</div>','<i class="ti-angle-left"></i><span class="label-event">' . esc_html__( 'Prev Event', 'ovaev' ) . '</span> <span class="second_font">%title</span>' ); ?>
			</div>
			<div class="nav-next text-right">
			    <?php next_post_link( '<div class="nav-next-post">%link</div>', '<span class="label-event">'. esc_html__( 'Next Event', 'ovaev' ) . '</span> <span class="second_font">%title</span><i class="ti-angle-right"></i>' ); ?>
			</div>

		</div>
	</div>
</div>



<?php get_footer( );
