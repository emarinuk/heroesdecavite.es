<?php

/*
  Plugin Name: Newsletter - Leads Addon
  Plugin URI: https://www.thenewsletterplugin.com/documentation/addons/extended-features/leads-extension/
  Description: Adds a leads generation system to the Newsletter plugin. Automatic updates available setting the license key on Newsletter configuration panel.
  Version: 1.5.3
  Requires at least: 5.6
  Requires PHP: 7.0
  Author: The Newsletter Team
  Author URI: https://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

add_action('newsletter_loaded', function ($version) {
    if (version_compare($version, '8.6.0') < 0) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Newsletter plugin upgrade required by <strong>Newsletter - Leads Addon</strong>.</p></div>';
        });
    } else {
        require_once __DIR__ . '/plugin.php';
        new NewsletterLeads('1.5.3');
    }
});
