<?php

defined('ABSPATH') || exit;

class NewsletterGeo extends NewsletterAddon {

    static $instance;

    function __construct($version) {
        self::$instance = $this;
        parent::__construct('geo', $version, __DIR__);
    }

    function init() {
        parent::init();
        if (is_admin()) {
            add_action('newsletter_emails_edit_target', array($this, 'hook_newsletter_emails_edit_target'), 10, 2);
            add_action('newsletter_emails_email_query', array($this, 'hook_newsletter_emails_email_query'), 10, 2);

            if (wp_next_scheduled('newsletter_geo_run') === false) {
                wp_schedule_event(time() + 3600, 'hourly', 'newsletter_geo_run');
            }
        }
        add_action('newsletter_geo_run', [$this, 'run'], 100);
    }

    function upgrade($first_install = false) {
        parent::upgrade($first_install);
        wp_unschedule_hook('newsletter_geo_run');
        wp_schedule_event(time() + 3600, 'hourly', 'newsletter_geo_run');
    }

    function weekly_check() {
        parent::weekly_check();
        $license_key = Newsletter::instance()->get_license_key();
        $response = wp_remote_post('https://www.thenewsletterplugin.com/wp-content/addon-check.php?k=' . rawurlencode($license_key)
                . '&a=' . rawurlencode($this->name) . '&d=' . rawurlencode(home_url()) . '&v=' . rawurlencode($this->version)
                . '&ml=' . (Newsletter::instance()->is_multilanguage() ? '1' : '0'));
    }

    function deactivate() {
        parent::deactivate();
        wp_unschedule_hook('newsletter_geo_run');
    }

    function hook_newsletter_emails_edit_target($email, $controls) {
        global $wpdb;
        include __DIR__ . '/admin/email-options.php';
    }

    function settings_menu($entries) {
        $entries[] = ['label' => '<i class="fas fa-globe"></i> Geo', 'url' => '?page=newsletter_geo_index'];
        return $entries;
    }

    function admin_menu() {
        add_submenu_page('admin.php', 'Geo', '<span class="tnp-side-menu">Geo</span>', 'manage_options', 'newsletter_geo_index', [$this, 'menu_page_index']);
    }

    function menu_page_index() {
        $this->setup_options();
        require __DIR__ . '/admin/index.php';
    }

    function hook_newsletter_emails_email_query($query, $email) {
        global $wpdb;
        if (!empty($email->options['countries'])) {
            $countries = array();
            foreach ($email->options['countries'] as $country) {
                $countries[] = "'" . esc_sql($country) . "'";
            }

            $countries = implode(',', $countries);

            $query .= " and country in (" . $countries . ")";
        }
        if (!empty($email->options['regions'])) {
            $regions = array();
            foreach ($email->options['regions'] as $region) {
                $regions[] = "'" . esc_sql($region) . "'";
            }

            $regions = implode(',', $regions);

            $query .= " and region in (" . $regions . ")";
        }
        if (!empty($email->options['cities'])) {
            $cities = array();
            foreach ($email->options['cities'] as $city) {
                $cities[] = "'" . esc_sql($city) . "'";
            }

            $cities = implode(',', $cities);

            $query .= " and city in (" . $cities . ")";
        }
        return $query;
    }

    var $country_result = '';

    /**
     *
     * @global wpdb $wpdb
     * @param type $test
     * @return type
     */
    function run($test = false) {
        require_once __DIR__ . '/classes/job.php';
        $job = new NewsletterGeoJob($this);
        return $job->run($test);
    }

    function get_last_run() {
        return get_option('newsletter_' . $this->name . '_last_run', 0);
    }

    function save_last_run($time) {
        update_option('newsletter_' . $this->name . '_last_run', $time);
    }
}
