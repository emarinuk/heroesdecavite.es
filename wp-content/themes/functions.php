<?php

/**
 * Setup muzze Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */

function muzze_child_theme_setup() {

	load_child_theme_textdomain( 'muzze-child', get_stylesheet_directory() . '/languages' );

}

add_action( 'after_setup_theme', 'muzze_child_theme_setup' );


// Add Code is here.

// Add Parent Style

add_action( 'wp_enqueue_scripts', 'muzze_child_scripts', 100 );

function muzze_child_scripts() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri(). '/style.css' );

}

// Add this function to your theme's functions.php file
function mi_titulo_shortcode() {
    return get_the_title();
}
add_shortcode('mi_titulo', 'mi_titulo_shortcode');

function custom_login_logo() {
    echo '<style type="text/css">
    #login h1 a, .login h1 a {
        background-image: url(' . get_stylesheet_directory_uri() . '/uploads/2024/09/Adobe_Express_20240829_1446170_1.png);
        height: 320px;
        width: 320px;
        background-size: 320px 320px;
        background-repeat: no-repeat;
        padding-bottom: 30px;
    }
    </style>';
}
add_action('login_enqueue_scripts', 'custom_login_logo');

function custom_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

function custom_login_logo_url_title() {
    return 'A.C. Héroes de Cavite';
}
add_filter('login_headertext', 'custom_login_logo_url_title');