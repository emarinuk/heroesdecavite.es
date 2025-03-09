<?php

/*
  Plugin Name: Newsletter - Paid Membership Pro Integration
  Plugin URI: https://www.thenewsletterplugin.com/documentation/
  Description: Integration with the plugin Paid Memberhip Pro. Create subscribers from members and map membership levels to lists.
  Version: 1.0.7
  Requires at least: 5.6
  Requires PHP: 7.0
  Author: The Newsletter Team
  Author URI: https://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

add_action('newsletter_loaded', function ($version) {
    if (version_compare($version, '8.5.0', '<')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Newsletter plugin upgrade required by <strong>Newsletter - Paid Membership Pro Integration Addon</strong>.</p></div>';
        });
    } elseif (!defined('PMPRO_VERSION')) {
        add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p>Paid Membership Pro plugin required by <strong>Newsletter - Paid Membership Pro Integration Addon</strong>.</p></div>';
        });
    } else {
        require_once __DIR__ . '/plugin.php';
        new NewsletterPmpro('1.0.7');
    }
});
