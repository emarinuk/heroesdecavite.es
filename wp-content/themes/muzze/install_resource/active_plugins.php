<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme omytheme for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 */
require_once (MUZZE_URL.'/inc/vendor/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'muzze_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function muzze_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'                     => esc_html__('Elementor','muzze'),
            'slug'                     => 'elementor',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Contact Form 7','muzze'),
            'slug'                     => 'contact-form-7',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Widget importer exporter','muzze'),
            'slug'                     => 'widget-importer-exporter',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Metabox','muzze'),
            'slug'                     => 'cmb2',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Woocommerce','muzze'),
            'slug'                     => 'woocommerce',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Mailchimp','muzze'),
            'slug'                     => 'mailchimp-for-wp',
            'required'                 => true,
        ),
        
        array(
            'name'                     => esc_html__('One click demo import','muzze'),
            'slug'                     => 'one-click-demo-import',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Donations','muzze'),
            'slug'                     => 'give',
            'required'                 => true,
        ),
        
        array(
            'name'                     => esc_html__('Cubeportfolio','muzze'),
            'slug'                     => 'cubeportfolio',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/cubeportfolio.zip',
        ),
        array(
            'name'                     => esc_html__('OvaTheme Framework','muzze'),
            'slug'                     => 'ova-framework',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/ova-framework.zip',
            'version'                   => '1.3.2'
        ),
        array(
            'name'                     => esc_html__('OvaTheme Collections','muzze'),
            'slug'                     => 'ova-collections',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/ova-collections.zip',
            'version'                   => '1.3.9'
        ),
        array(
            'name'                     => esc_html__('OvaTheme Events','muzze'),
            'slug'                     => 'ova-events',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/ova-events.zip',
            'version'                   => '1.2.2' 
        ),
        array(
            'name'                     => esc_html__('OvaTheme Exhibition','muzze'),
            'slug'                     => 'ova-exhibition',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/ova-exhibition.zip',
            'version'                   => '1.1.9'  
        ),
        array(
            'name'                     => esc_html__('OvaTheme MegaMenu','muzze'),
            'slug'                     => 'ova-megamenu',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/ova-megamenu.zip',
            'version'                   => '1.0.3'
        ),
         array(
            'name'                     => esc_html__('OvaTheme Manage Ticket','muzze'),
            'slug'                     => 'ova-manage-ticket',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install_resource/plugins/ova-manage-ticket.zip',
            'version'                   => '1.0.7'
        ),
        

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'muzze',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        
    );

    tgmpa( $plugins, $config );
}

// Before import demo data
add_action( 'ocdi/before_content_import', 'muzze_before_content_import' );
function muzze_before_content_import() { 
    // update option elementor cpt support
    $post_types = array('post','page','ova_framework_hf_el');
    update_option( 'elementor_cpt_support', $post_types );
}


add_action( 'ocdi/after_import', 'muzze_after_import_setup' );
function muzze_after_import_setup() {
    // Assign menus to their locations.
    $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $primary->term_id,
        )
    );
    

    // Assign front page and posts page (blog page).
    $front_page_id = muzze_get_page_by_title( 'Home' );
    $blog_page_id  = muzze_get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Config Elementor
    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    update_option( 'elementor_css_print_method', 'internal' );
    update_option( 'elementor_load_fa4_shim', 'yes' );

    // Update customize
    muzze_replace_url_in_customize();

    // Setup header & footer
    muzze_setup_header_footer_plugins();

    // After import replace URLs
    muzze_replace_url_after_import();

    // Replace image URLs
    $upload_dir = wp_get_upload_dir();
    $base_url   = $upload_dir['baseurl'];
    muzze_replace_url_after_import( $base_url, 'https://ovatheme.nyc3.cdn.digitaloceanspaces.com/muzze' );
}

// Import files
function muzze_import_files() {
    return array(
        array(
            'import_file_name'             => 'Demo Import',
            'categories'                   => array( 'Category 1', 'Category 2' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'install_resource/demo_import/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'install_resource/demo_import/widgets.wie',
            'local_import_customizer_file'   => trailingslashit( get_template_directory() ) . 'install_resource/demo_import/customize.dat'
            
        )
    );
}
add_filter( 'ocdi/import_files', 'muzze_import_files' );

// Get page by title
if ( ! function_exists( 'muzze_get_page_by_title' ) ) {
    function muzze_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
        global $wpdb;

        if ( is_array( $post_type ) ) {
            $post_type           = esc_sql( $post_type );
            $post_type_in_string = "'" . implode( "','", $post_type ) . "'";
            $sql                 = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type IN ($post_type_in_string)
            ",
                $page_title
            );
        } else {
            $sql = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type = %s
            ",
                $page_title,
                $post_type
            );
        }

        $page = $wpdb->get_var( $sql );

        if ( $page ) {
            return get_post( $page, $output );
        }

        return null;
    }
}

// Replace url in customize
if ( !function_exists( 'muzze_replace_url_in_customize' ) ) {
    function muzze_replace_url_in_customize() {
        $demo_url = apply_filters( 'muzze_demo_url', 'https://demo.ovatheme.com/muzze' );

        // Get theme mods
        $theme_mods = get_theme_mods();

        if ( !empty( $theme_mods ) ) {
            foreach ( $theme_mods as $key => $val ) {
                if ( is_string( $val ) && str_contains( $val, $demo_url ) ) {
                    $val = str_replace( $demo_url, get_site_url(), $val );

                    // Update theme mod
                    set_theme_mod( $key, $val );
                }
            }
        }
    }
}

// Replace url after import demo data
if ( ! function_exists('muzze_replace_url_after_import') ) {
    function muzze_replace_url_after_import( $site_url = '', $demo_url = '' ) {
        global $wpdb;

        // Site URL
        if ( !$site_url ) {
            $site_url = apply_filters( 'muzze_site_url', get_site_url() );
        }

        // Demo URL
        if ( !$demo_url ) {
            $demo_url = apply_filters( 'muzze_demo_url', 'https://demo.ovatheme.com/muzze' );
        }

        // Replace in option value
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->options} " .
                "SET `option_value` = REPLACE(`option_value`, %s, %s);",
                $demo_url,
                $site_url
            )
        );

        // Replace in posts
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->posts} " .
                "SET `post_content` = REPLACE(`post_content`, %s, %s), `guid` = REPLACE(`guid`, %s, %s);",
                $demo_url,
                $site_url,
                $demo_url,
                $site_url
            )
        );

        // Replace in meta value
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                "SET `meta_value` = REPLACE(`meta_value`, %s, %s) " .
                "WHERE `meta_key` <> '_elementor_data';",
                $demo_url,
                $site_url
            )
        );

        // Elementor Data
        $escaped_from       = str_replace( '/', '\\/', $demo_url );
        $escaped_to         = str_replace( '/', '\\/', $site_url );
        $meta_value_like    = '[%'; // meta_value LIKE '[%' are json formatted

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                'SET `meta_value` = REPLACE(`meta_value`, %s, %s) ' .
                "WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE %s;",
                $escaped_from,
                $escaped_to,
                $meta_value_like
            )
        );
    }
}

// Setup Header Footer for Ova plugins
if ( ! function_exists( 'muzze_setup_header_footer_plugins' ) ) {
    function muzze_setup_header_footer_plugins() {
        $header_3   = 'ova,header-3';
        $footer_1   = 'ova,footer-1';

        if ( class_exists( 'OVAEV' ) ) { // event
            $ovaev_options = get_option('ovaev_options');

            $ovaev_options['archive_event_header'] = $ovaev_options['single_event_header'] = $header_3;
            $ovaev_options['archive_event_footer'] = $ovaev_options['single_event_footer'] = $footer_1;

            update_option( 'ovaev_options', $ovaev_options );
        }

        if ( class_exists( 'OVAEX' ) ) { // exhibition
            $ovaex_options = get_option('ovaex_options');

            $ovaex_options['archive_exhibition_header'] = $ovaex_options['single_exhibition_header'] = $header_3;
            $ovaex_options['archive_exhibition_footer'] = $ovaex_options['single_exhibition_footer'] =  $footer_1;

            update_option( 'ovaex_options', $ovaex_options );
        }

        if ( class_exists( 'ovacollection' ) ) { // collection, artist
            $ovacoll_options = get_option('ovacoll_options');

            // collection
            $ovacoll_options['archive_collection_header'] = $ovacoll_options['single_collection_header'] = $header_3;
            $ovacoll_options['archive_collection_footer'] = $ovacoll_options['single_collection_footer'] = $footer_1;

            // artist
            $ovacoll_options['archive_artist_header'] = $ovacoll_options['single_artist_header'] = $header_3;
            $ovacoll_options['archive_artist_footer'] = $ovacoll_options['single_artist_footer'] = $footer_1;

            update_option( 'ovacoll_options', $ovacoll_options );
        }
    }
}