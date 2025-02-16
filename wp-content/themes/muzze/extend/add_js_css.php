<?php
add_action('wp_enqueue_scripts', 'muzze_theme_scripts_styles');
add_action('wp_enqueue_scripts', 'muzze_theme_script_default');


function muzze_theme_scripts_styles() {

    // enqueue the javascript that performs in-link comment reply fanciness
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' ); 
    }
    
    /* Add Javascript  */
    wp_enqueue_script( 'bootstrap', MUZZE_URI.'/assets/libs/bootstrap/js/bootstrap.bundle.min.js' , array( 'jquery' ), null, true );

    wp_enqueue_script( 'select2', MUZZE_URI.'/assets/libs/select2/select2.min.js' , array( 'jquery' ), null, true );
    
    // Load js when product detail
    if( is_singular( 'product' ) ){
        if( is_ssl() ){
          wp_enqueue_script('prettyphoto', MUZZE_URI.'/assets/libs/prettyphoto/jquery.prettyPhoto_https.js', array('jquery'),null,true);  
        }else{
          wp_enqueue_script('prettyphoto', MUZZE_URI.'/assets/libs/prettyphoto/jquery.prettyPhoto.js', array('jquery'),null,true);
        }
        wp_enqueue_style('prettyphoto', MUZZE_URI.'/assets/libs/prettyphoto/css/prettyPhoto.css', array(), null);
    }

    if( is_singular( 'product' ) )  {
        wp_enqueue_script('owl-carousel', MUZZE_URI.'/assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'),null,true);
        wp_enqueue_style('owl-carousel', MUZZE_URI.'/assets/libs/owl-carousel/assets/owl.carousel.min.css', array(), null);
    }


    // Load js when blog is Grid and Grid Sidebar
    $blog_template = apply_filters( 'muzze_blog_template', '' );
    if( $blog_template == 'grid_sidebar' || $blog_template == 'grid' ){
        wp_enqueue_script('imagesLoaded');
        wp_enqueue_script('masonry');    
    }
    

    wp_enqueue_script('muzze-script', MUZZE_URI.'/assets/js/script.js', array('jquery'),null,true);

    /* Add Css  */
    wp_enqueue_style('bootstrap', MUZZE_URI.'/assets/libs/bootstrap/css/bootstrap.min.css', array(), null);

    wp_enqueue_style( 'flaticon', MUZZE_URI.'/assets/libs/flaticon/font/flaticon.css', array(), null );

    wp_enqueue_style( 'themify-icon', MUZZE_URI.'/assets/libs/themify-icon/themify-icons.css', array(), null );


    wp_enqueue_style( 'select2', MUZZE_URI. '/assets/libs/select2/select2.min.css', array(), null );
    wp_enqueue_style('v4-shims', MUZZE_URI.'/assets/libs/fontawesome/css/v4-shims.min.css', array(), null);
    wp_enqueue_style('fontawesome', MUZZE_URI.'/assets/libs/fontawesome/css/all.min.css', array(), null);
    wp_enqueue_style('elegant_font', MUZZE_URI.'/assets/libs/elegant_font/el_style.css', array(), null);
    wp_enqueue_style('muzze-theme', MUZZE_URI.'/assets/css/theme.css', array(), null);

    

}

function muzze_theme_script_default(){

    if ( is_child_theme() ) {
      wp_enqueue_style( 'parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array(), null );
    }

    wp_enqueue_style( 'muzze-style', get_stylesheet_uri(), array(), null );
}


