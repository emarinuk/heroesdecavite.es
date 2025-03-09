<?php

class NewsletterElementor extends NewsletterAddon {

    /**
     * @var NewsletterElementor
     */
    static $instance;

    function __construct($version) {
        self::$instance = $this;
        parent::__construct('elementor', $version, __DIR__);

        add_action('elementor_pro/init', function () {
            require_once __DIR__ . '/action.php';
            $action = new NewsletterElementorAction();
            \ElementorPro\Plugin::instance()->modules_manager->get_modules('forms')->add_form_action($action->get_name(), $action);
        });
    }

    function init() {
        parent::init();
        if (is_admin()) {
            if (Newsletter::instance()->is_allowed()) {
                add_filter('newsletter_menu_subscription', [$this, 'hook_newsletter_menu_subscription']);
            }
        }
    }

    function weekly_check() {
        parent::weekly_check();
        $license_key = Newsletter::instance()->get_license_key();
        $response = wp_remote_post('https://www.thenewsletterplugin.com/wp-content/addon-check.php?k=' . rawurlencode($license_key)
                . '&a=' . rawurlencode($this->name) . '&d=' . rawurlencode(home_url()) . '&v=' . rawurlencode($this->version)
                . '&ml=' . (Newsletter::instance()->is_multilanguage() ? '1' : '0'));
    }

    function hook_newsletter_menu_subscription($entries) {
        $entries[] = ['label' => 'Elementor', 'url' => '?page=newsletter_nlelementr_index'];
        return $entries;
    }

    function admin_menu() {
        add_submenu_page('newsletter_main_index', 'Elementor Addon', '<span class="tnp-side-menu">Elementor</span>', 'manage_options', 'newsletter_nlelementr_index',
                function () {
                    require __DIR__ . '/index.php';
                });
    }
}
