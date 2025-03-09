<?php

class NewsletterAutoresponderAdmin extends NewsletterAddonAdmin {

    /**
     * @var NewsletterAutoresponder
     */
    static $instance;
    var $store;
    public $autoresponder_table;
    public $autoresponder_steps_table;

    function __construct($name, $version, $dir) {
        global $wpdb;

        self::$instance = $this;

        parent::__construct('autoresponder', $version, __DIR__);
        $this->setup_options();

        $this->autoresponder_table = $wpdb->prefix . "newsletter_autoresponder";
        $this->autoresponder_steps_table = $wpdb->prefix . "newsletter_autoresponder_steps";
    }

    static function instance() {
        return self::$instance;
    }





























    function get_store() {
        return NewsletterAutoresponder::instance()->get_store();
    }

    function apply_template($body, $autoresponder) {
        return NewsletterAutoresponder::instance()->apply_template($body, $autoresponder);
    }

    function get_theme($id) {
        return NewsletterAutoresponder::instance()->get_theme($id);
    }

    function get_themes() {
        return NewsletterAutoresponder::instance()->get_themes();
    }
}
