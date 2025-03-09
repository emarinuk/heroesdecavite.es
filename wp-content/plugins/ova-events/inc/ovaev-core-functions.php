<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if( !function_exists( 'ovaev_locate_template' ) ){
	function ovaev_locate_template( $template_name, $template_path = '', $default_path = '' ) {
		
		// Set variable to search in ovaev-templates folder of theme.
		if ( ! $template_path ) :
			$template_path = 'ovaev-templates/';
		endif;

		// Set default plugin templates path.
		if ( ! $default_path ) :
			$default_path = OVAEV_PLUGIN_PATH . 'templates/'; // Path to the template folder
		endif;

		// Search template file in theme folder.
		$template = locate_template( array(
			$template_path . $template_name
			// $template_name
		) );

		// Get plugins template file.
		if ( ! $template ) :
			$template = $default_path . $template_name;
		endif;

		return apply_filters( 'ovaev_locate_template', $template, $template_name, $template_path, $default_path );
	}

}


function ovaev_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;
	$template_file = ovaev_locate_template( $template_name, $tempate_path, $default_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	
	include $template_file;
}



function ovaev_pagination_plugin($ovaem_query = null) {

	/** Stop execution if there's only 1 page */
	if($ovaem_query != null){
		if( $ovaem_query->max_num_pages <= 1 )
			return;	
	}else if( $wp_query->max_num_pages <= 1 )
	return;



	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;


	

	if($ovaem_query!=null){
		$max   = intval( $ovaem_query->max_num_pages );
	}else{
		$max   = intval( $wp_query->max_num_pages );	
	}
	

	/** Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}


	echo wp_kses( __( '<div class="blog_pagination"><ul class="pagination">','ovaev' ), true ) . "\n";
	
	/** Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="prev page-numbers">%s</li>' . "\n", get_previous_posts_link('<i class="arrow_carrot-left"></i>') );
	
	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		
		if ( ! in_array( 2, $links ) )
			echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'ovaev' ) , true);
	}
	
	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	
	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'ovaev' ) , true) . "\n";
		
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	
	/** Next Post Link */
	$max_page = $ovaem_query->max_num_pages;
	if ( get_next_posts_link( null, $max_page ) )
		printf( '<li class="next page-numbers">%s</li>' . "\n", get_next_posts_link( '<i class="arrow_carrot-right"></i>', $max_page ) );
	
	echo wp_kses( __( '</ul></div>', 'ovaev' ), true ) . "\n";

}

/** in_array() and multidimensional array **/

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
    	foreach ($item as $value) {
    		if (  $value['date'] === $needle ) {
	            return true;
	            break;
	        }
    	}
        
    }

    return false;
}