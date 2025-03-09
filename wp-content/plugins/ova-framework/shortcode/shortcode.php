<?php
add_shortcode('muzze_info', 'muzze_info');
function muzze_info($atts, $content = null) {

      $atts = extract( shortcode_atts(
	    array(
	    	'hour_label' => '',
	    	'hour_info' => '',
	    	'loc_label' => '',
	    	'loc_info' => '',
	    	'button_icon' => '',
	    	'button_label' => '',
	    	'button_link' => '',
	    	'button_target' => '_self',
	      	'class'   => '',
	    ), $atts) );

   $html = '<li class="muzze_info_sc  '.$class.'">';

   	$html .= '<div class="content hour">';
	   	$html .= $hour_label ? '<div class="lable second_font">'.$hour_label.'</div>' : '';
	   	$html .= $hour_info ? '<div class="info">'.$hour_info.'</div>' : '';
   	$html .= '</div>';

   	$html .= '<div class="content loc">';
	   	$html .= $loc_label ? '<div class="lable second_font">'.$loc_label.'</div>' : '';
	   	$html .= $loc_info ? '<div class="info">'.$loc_info.'</div>' : '';
   	$html .= '</div>';

   	$html .= '<div class="info_btn">';
   		$html .= $button_icon ? '<i class="'.$button_icon.'"></i>' : '';
   		$html .= $button_label ? '<a href="'.$button_link.'" target="'.$button_target.'">'.$button_label.'</a>' : '';
   	$html .= '</div>';

   $html .= '</li>';

	return $html;

}

/*******************************************
		Short code create slide recent post
********************************************/

if ( ! function_exists('ova_recent_post')) {
	function ova_recent_post ( $args ) {
		wp_enqueue_style( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', OVA_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		$html = "";
		$total = isset($args['total']) ? $args['total'] : 4;
		$order = isset($args['order']) ? $args['order'] : "DESC";

		$args=[
			'post_type' => 'post',
			'posts_per_page' => $total,
			'order' => $order,
		];
		$blog = new \WP_Query($args);
		
			
				$html .= "<div class='ova-recent-post-slide'>";
				$html .= "<div class='list-recent-post single-slide owl-carousel'>";
			if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();
				$thumbnail_url = wp_get_attachment_image_url(get_post_thumbnail_id() , 'full' );
				$html .= "<div class='item-recent-post'>";
				$html .= "<a class='image' href='".get_the_permalink()."' style='background-image: url(".$thumbnail_url.")'></a>";
				$html .= "<div class='content'><div class='meta'><span>".get_the_time( get_option( 'date_format' ))."</span></div><h2 class = 'second_font title'><a href='".get_the_permalink()."'>".get_the_title()."</a></h2></div>";
				$html .= "</div>";
			endwhile; endif; wp_reset_postdata();
				$html .= "</div>";
				$html .= "</div>";
		
		return $html;
	}
}
add_shortcode( 'ova_recent_post', 'ova_recent_post' );




