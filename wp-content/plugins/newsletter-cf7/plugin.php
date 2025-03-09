<?php

class NewsletterCF7 extends NewsletterFormManagerAddon {

    /**
     * @var NewsletterCF7
     */
    static $instance;
    var $current_form_id = null;
    // Local copy of processed posted data by CF7
    var $posted_data;

    function __construct($version) {
        $this->menu_title = 'Contact Form 7';
        self::$instance = $this;
        parent::__construct('cf7', $version, __DIR__);
    }

    function init() {
        parent::init();
        // To add the language field since on ajax posts seems to no be always available
        add_filter('wpcf7_form_hidden_fields', array($this, 'hook_wpcf7_form_hidden_fields'));
        add_filter('wpcf7_posted_data', array($this, 'hook_wpcf7_posted_data'));

        // Max priority to be axctive before the redirect plugin "Contact Form 7 - Success Page Redirects"
        add_action('wpcf7_before_send_mail', array($this, 'hook_wpcf7_before_send_mail'), 1);
    }

    function weekly_check() {
        parent::weekly_check();
        $license_key = Newsletter::instance()->get_license_key();
        $response = wp_remote_post('https://www.thenewsletterplugin.com/wp-content/addon-check.php?k=' . rawurlencode($license_key)
                . '&a=' . rawurlencode($this->name) . '&d=' . rawurlencode(home_url()) . '&v=' . rawurlencode($this->version)
                . '&ml=' . (Newsletter::instance()->is_multilanguage() ? '1' : '0'));
    }

    function hook_wpcf7_posted_data($posted_data) {
        $logger = $this->get_logger();
        if ($logger->is_debug) {
            $logger->debug($posted_data);
            $logger->debug(wp_unslash($_POST));
        }
        $this->posted_data = $posted_data;
        return $posted_data;
    }

    function hook_wpcf7_form_hidden_fields($fields) {
        $language = Newsletter::instance()->get_current_language();
        if ($language) {
            $fields['nlang'] = $language;
        }
        return $fields;
    }

    /**
     *
     * @param WPCF7_ContactForm $form
     */
    function hook_wpcf7_before_send_mail($form) {

        $logger = $this->get_logger();
        if ($logger->is_debug) {
            $logger->debug('Form submitted');
            //$logger->debug($form);
        }

        $this->current_form_id = $form->id();

        $form_options = $this->get_form_options($form->id());
        if (empty($form_options)) {
            $logger->debug('No configuration for form ' . $form->id());
            return;
        }

        if (!empty($form_options['newsletter']) && empty($this->posted_data[$form_options['newsletter']])) {
            Newsletter\Logs::add($this->name . '-' . $this->current_form_id, 'Submission without consent');
            $logger->debug('No consent');
            return;
        }

        $logger->debug('Intercepting form data');

        $subscription = $this->get_default_subscription($form_options);
        if (!empty($form_options['welcome_email'])) {
            if ($form_options['welcome_email'] == '1') {
                $subscription->welcome_email_id = (int) $form_options['welcome_email_id'];
            } else {
                $subscription->welcome_email_id = -1;
            }
        }

        $subscription->data->email = $this->posted_data[$form_options['email']];
        $subscription->data->referrer = 'cf7-' . $form->id();

        if (!empty($form_options['name'])) {
            $subscription->data->name = $this->posted_data[$form_options['name']] ?? '';
        }
        if (!empty($form_options['surname'])) {
            $subscription->data->surname = $this->posted_data[$form_options['surname']] ?? '';
        }

        // Gender
        if (!empty($form_options['gender'])) {
            $subscription->data->sex = $this->posted_data[$form_options['gender']][0];
        }

        $cfields = Newsletter::instance()->get_customfields();
        foreach ($cfields as $cfield) {
            $id = $cfield->id;
            if (empty($form_options['profile_' . $id])) {
                continue;
            }
            $form_field = $form_options['profile_' . $id];
            if (empty($this->posted_data[$form_field])) {
                continue;
            }

            // Checkboxes mapped on custom fields
            if (is_array($this->posted_data[$form_field])) {
                $subscription->data->profiles['' . $id] = $this->posted_data[$form_field][0];
            } else {
                $subscription->data->profiles['' . $id] = $this->posted_data[$form_field];
            }
        }

        // Accept only public lists from the form
        $public_lists = Newsletter::instance()->get_lists_public();
        foreach ($public_lists as $list) {
            if (!empty($this->posted_data['list_' . $list->id])) {
                $subscription->data->lists['' . $list->id] = 1;
            }
        }

        if (isset($this->posted_data['nlang'])) {
            $subscription->data->language = $this->posted_data['nlang'];
        }

        $subscription->data->add_lists($form_options['preferences']);

        $user = NewsletterSubscription::instance()->subscribe2($subscription);
        if (is_wp_error($user)) {
            Newsletter\Logs::add($this->name . '-' . $this->current_form_id, 'Subcription for ' . $subscription->data->email . ' failed: ' . $user->get_error_message());
        } else {
            Newsletter\Logs::add($this->name . '-' . $this->current_form_id, 'Subcription for ' . $subscription->data->email);
        }
    }

    public function get_forms() {
        $forms = get_posts(array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => 100));

        $list = [];
        foreach ($forms as $form) {
            $tnp_form = new TNP_FormManager_Form();
            $settings = $this->get_form_options($form->ID);
            $tnp_form->connected = !empty($settings['email']);
            $tnp_form->title = $form->post_title;
            $tnp_form->id = $form->ID;
            $list[] = $tnp_form;
        }
        return $list;
    }

    /**
     *
     * @param mixed $form_id
     * @return \TNP_FormManager_Form
     */
    public function get_form($form_id) {
        $tnp_form = new TNP_FormManager_Form();
        $form = WPCF7_ContactForm::get_instance($form_id);

        if (method_exists($form, 'scan_form_tags')) {
            $form_fields = $form->scan_form_tags();
        } else {
            $form_fields = $form->form_scan_shortcode();
        }

        foreach ($form_fields as $form_field) {
            $field_name = str_replace('[]', '', $form_field['name']);
            if (empty($field_name)) {
                continue;
            }
            $tnp_form->fields[$field_name] = $field_name;
        }

        $tnp_form->title = $form->title();
        $tnp_form->id = $form_id;

        return $tnp_form;
    }
}
