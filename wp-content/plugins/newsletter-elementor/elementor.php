<?php

/*
  Plugin Name: Newsletter - Elementor Pro Addon
  Plugin URI: https://www.thenewsletterplugin.com/documentation/elementor-extension
  Description: Enables the linking between Elementor forms and the Newsletter subscription
  Version: 1.1.7
  Author: The Newsletter Team
  Author URI: https://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
  Requires at least: 6.1
  Requires PHP: 7.0
  Elementor tested up to: 3.27.0
  Elementor Pro tested up to: 3.27.0
 */

add_action('newsletter_loaded', function ($version) {
    if (version_compare($version, '8.5.0') < 0) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Newsletter plugin upgrade required by <strong>Newsletter - Elementor Pro Addon</strong>.</p></div>';
        });
    } else if (!defined('ELEMENTOR_PRO_VERSION') || !defined('ELEMENTOR_VERSION')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Elementor Pro required by <strong>Newsletter - Elementor Pro Addon</strong>.</p></div>';
        });
    } else {
        require_once __DIR__ . '/plugin.php';
        new NewsletterElementor('1.1.7');
    }
});
