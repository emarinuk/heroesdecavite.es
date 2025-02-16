<?php

/*
  Plugin Name: Newsletter - Contact Form 7
  Plugin URI: https://www.thenewsletterplugin.com/documentation/addons/integrations/contact-form-7-extension/
  Description: Collect subscribers using Contact 7 Forms
  Version: 4.4.4
  Requires PHP: 7.0
  Requires at least: 5.6
  Author: The Newsletter Team
  Author URI: https://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

add_action('newsletter_loaded', function ($version) {
    if (version_compare($version, '8.5.3') < 0) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Newsletter plugin upgrade required by CF7 Addon.</p></div>';
        });
    } if (!defined('WPCF7_VERSION') || WPCF7_VERSION < '5.0.0') {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Contact Form 7 version 5+ required for Newsletter integration.</p></div>';
        });
    }else {
        require_once __DIR__ . '/plugin.php';
        new NewsletterCF7('4.4.4');
    }
});
