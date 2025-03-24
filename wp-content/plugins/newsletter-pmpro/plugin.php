<?php

class NewsletterPmpro extends NewsletterAddon {

    /**
     * @var NewsletterPmpro
     */
    static $instance;

    function __construct($version) {
        self::$instance = $this;
        parent::__construct('pmpro', $version, __DIR__);
    }

    function init() {
        parent::init();
        add_action('pmpro_after_all_membership_level_changes', [$this, 'levels_changed'], 10, 1);
        add_action('pmpro_checkout_after_tos_fields', [$this, 'show_optin']);
        add_action('pmpro_paypalexpress_session_vars', [$this, 'save_optin_in_session']);
        add_action('pmpro_after_checkout', [$this, 'create_subscriber'], 15);

        add_action('newsletter_pmpro_import', [$this, 'hook_newsletter_pmpro_import']);

        add_action('set_user_role', [$this, 'hook_set_user_role']);
        add_action('profile_update', [$this, 'hook_profile_update'], 10, 3);

        if (is_admin()) {
            add_filter('newsletter_lists_notes', [$this, 'hook_newsletter_lists_notes'], 10, 2);
        }
    }

    function weekly_check() {
        parent::weekly_check();
        $license_key = Newsletter::instance()->get_license_key();
        $response = wp_remote_post('https://www.thenewsletterplugin.com/wp-content/addon-check.php?k=' . urlencode($license_key)
                . '&a=' . urlencode($this->name) . '&d=' . urlencode(home_url()) . '&v=' . urlencode($this->version)
                . '&ml=' . (Newsletter::instance()->is_multilanguage() ? '1' : '0'));
    }

    function admin_menu() {
        add_submenu_page('newsletter_main_index', 'PM Pro Addon', '<span class="tnp-side-menu">PM Pro Addon</span>', 'manage_options', 'newsletter_pmpro_index',
                function () {
                    require __DIR__ . '/admin/index.php';
                });
    }

    function hook_newsletter_lists_notes($notes, $list_id) {
        $this->setup_options();
        foreach (array_keys($this->options) as $key) {
            if (substr($key, 0, 5) === 'level') {
                if (is_array($this->options[$key]) && in_array($list_id, $this->options[$key])) {
                    $notes[] = 'Used by Newsletter - Paid Membership Pro Addon';
                    break;
                }
            }
        }
        return $notes;
    }

    function get_levels() {
        if (function_exists('pmpro_getAllLevels')) {
            return pmpro_getAllLevels();
        } else {
            return [];
        }
    }

    function align($wp_user_id) {
        $this->setup_options();
        $logger = $this->get_logger();

        $wp_user = get_user_by('id', $wp_user_id);
        if (!$wp_user) {
            $logger->debug('User ' . $wp_user_id . ' not found');
            return;
        }

        $newsletter = Newsletter::instance();

        $subscriber = $newsletter->get_user_by_wp_user_id($wp_user_id);
        if (!$subscriber) {
            $logger->debug('Subscriber not found');
            return;
        }

        // Build only a "delta" dataset
        $subscriber = ['id' => $subscriber->id];

        $levels = pmpro_getMembershipLevelsForUser($wp_user_id);

        // With no levels, use the "undefined" configuration
        if (empty($levels)) {
            $logger->debug('Undefined level');
            switch ($this->options['undefined_mode'] ?? '0') {
                // Reset all lists and the addon the ones to be activated
                case '1':
                    for ($i = 1; $i <= NEWSLETTER_LIST_MAX; $i++) {
                        $subscriber['list_' . $i] = 0;
                    }
                    break;

                // Deactivate only the specified lists (default and for compatibility)
                default:
                    if (!empty($this->options['undefined_lists_off'])) {
                        foreach ($this->options['undefined_lists_off'] as $list_id) {
                            $subscriber['list_' . $list_id] = 0;
                        }
                    }
            }

            if (!empty($this->options['undefined_lists_on'])) {
                foreach ($this->options['undefined_lists_on'] as $list_id) {
                    $subscriber['list_' . $list_id] = 1;
                }
            }
        } else {
            // Typically we have only 1 role per user, but they give back an array... it could be
            // a source of problems due to overlapping and overwriting per-level configurations.
            // Hope for the best (read: no support tickets).
            foreach ($levels as $level) {
                switch ($this->options['level_' . $level->id . '_mode'] ?? '0') {
                    // Reset all lists and the addon the ones to be activated
                    case '1':
                        for ($i = 1; $i <= NEWSLETTER_LIST_MAX; $i++) {
                            $subscriber['list_' . $i] = 0;
                        }
                        break;

                    // Deactivate only the specified lists (default and for compatibility)
                    default:
                        if (!empty($this->options['level_' . $level->id . '_lists_off'])) {
                            foreach ($this->options['level_' . $level->id . '_lists_off'] as $list_id) {
                                $subscriber['list_' . $list_id] = 0;
                            }
                        }
                }

                // Lists to be activated have priority!
                if (!empty($this->options['level_' . $level->id . '_lists_on'])) {
                    foreach ($this->options['level_' . $level->id . '_lists_on'] as $list_id) {
                        $subscriber['list_' . $list_id] = 1;
                    }
                }
            }
        }

        if ($wp_user->first_name) {
            $subscriber['name'] = $newsletter->sanitize_name($wp_user->first_name);
        }

        if ($wp_user->last_name) {
            $subscriber['surname'] = $newsletter->sanitize_name($wp_user->last_name);
        }

        $logger->debug($subscriber);

        Newsletter::instance()->save_user($subscriber);
    }

    /**
     * Activated by PM Pro when there are users with new levels.
     *
     * @param array $old_levels The key is the WP user ID and the value is an array of membership levels
     */
    function levels_changed($old_levels) {
        $this->setup_options();
        $logger = $this->get_logger();

        // We're interested only on changed users (not their old levels)
        $wp_user_ids = array_keys($old_levels);

        // Loop through all users who have changed levels.
        foreach ($wp_user_ids as $wp_user_id) {
            $logger->debug('Level changed for ' . $wp_user_id);
            $this->align($wp_user_id);
        }
    }

    function hook_profile_update($user_id, $old_user_data = null, $userdata = null) {
        $this->setup_options();
        $logger = $this->get_logger();
        $logger->debug('Profile updated for ' . $user_id);
        return $this->align($user_id);
    }

    /**
     * https://developer.wordpress.org/reference/hooks/set_user_role/
     * @param int $wp_user_id
     */
    function hook_set_user_role($user_id) {
        $this->setup_options();
        $logger = $this->get_logger();
        $logger->debug('Role changed by WP for ' . $user_id);
        $this->align($user_id);
    }

    function show_optin() {
        $this->setup_options();

        if (empty($this->options['subscribe'])) {
            return;
        }
        $checked = false;
        $label = __('Subscribe me', 'newsletter-pmpro');
        if (!empty($this->options['subscribe_label'])) {
            $label = $this->options['subscribe_label'];
        }
        ?>
        <label>
            <input type="checkbox" class="input-checkbox" name="tnp-nl" <?php echo $checked ? 'checked' : '' ?>> <?php echo esc_html($label) ?>
        </label>
        <?php
    }

    function save_optin_in_session() {
        if (isset($_REQUEST['tnp-nl'])) {
            $_SESSION['tnp-nl'] = 1;
        }
    }

    function create_subscriber($wp_user_id) {

        global $wpdb;
        //Could hook be called multiple times?!
        static $last_wp_user_id = 0;

        $this->setup_options();

        $logger = $this->get_logger();

        $logger->info('New user registration with id ' . $wp_user_id);
        $logger->debug($this->options);
        if (empty($this->options['subscribe'])) {
            $logger->debug('Subscription disabled');
            return;
        }

        if ($last_wp_user_id == $wp_user_id) {
            $logger->fatal('Called twice with the same user id!');
            return;
        }

        $last_wp_user_id = $wp_user_id;

        // If not forced and the user didn't choose the newsletter...
        if ($this->options['subscribe'] == 1) {
            if (empty($_REQUEST['tnp-nl']) && empty($_SESSION['tnp-nl'])) {
                $logger->info('Opt-in checkbox required but not set');
                $logger->debug($_REQUEST);
                return;
            }
        } else {
            // Subscription forced
            $logger->info('Subscription forced');
        }

        unset($_SESSION['tnp-nl']);

        $wp_user = $wpdb->get_row($wpdb->prepare("select * from $wpdb->users where id=%d limit 1", $wp_user_id));
        if (empty($wp_user)) {
            $logger->fatal('User not found?!');
            return;
        }

        // Yes, some registration procedures that allow empty email
        if (!NewsletterModule::is_email($wp_user->user_email)) {
            $logger->error('User without a valid email?!');
            return;
        }

        $subscription_module = NewsletterSubscription::instance();
        $subscription = $subscription_module->get_default_subscription();
        //$subscription->optin = $this->options['status'] == 'C' ? 'single' : 'double';
        //$subscription->send_emails = ( $this->options['status'] == 'S' && $this->options['confirmation'] == 1 ) || ( $this->options['status'] == 'C' && $this->options['welcome'] == 1 );
        $subscription->send_emails = false;
        $subscription->data->email = $wp_user->user_email;
        $subscription->data->name = get_user_meta($wp_user_id, 'first_name', true);
        $subscription->data->surname = get_user_meta($wp_user_id, 'last_name', true);
        $subscription->data->referrer = 'registration';

        $user = NewsletterSubscription::instance()->subscribe2($subscription);

        if ($user instanceof WP_Error) {
            $logger->fatal('Unable to create the subscription ');
            $logger->fatal($user);
            return;
        }

        $logger->debug('Subscriber created');

        // Now we associate it with wp
        Newsletter::instance()->set_user_wp_user_id($user->id, $wp_user_id);
    }

    /**
     *
     * @global wpdb $wpdb
     */
    function hook_newsletter_pmpro_import() {
        global $wpdb;

        $this->setup_options();

        $last_id = (int) get_option('newsletter_pmpro_import_last');
        $newsletter = Newsletter::instance();
        $logger = $this->get_logger();
        if (NEWSLETTER_DEBUG) {
            $max = 2;
        } else {
            $max = 50;
        }

        $logger->info('Import start');

        $time_limit = (int) (@ini_get('max_execution_time') * 0.80);
        if (!$time_limit) {
            $time_limit = 30;
        }

        $time_limit += time();

        while (true) {

            $query = $wpdb->prepare("select * from {$wpdb->users} where id > %d order by id asc limit %d",
                    $last_id, $max);
            $logger->debug($query);
            $wp_users = $wpdb->get_results($query);

            if (!$wp_users) {
                $logger->error($wpdb->last_error);
                break;
            }

            $logger->info('Process batch');

            foreach ($wp_users as $wp_user) {
                $email = sanitize_email($wp_user->user_email);
                if (!$email) {
                    $last_id = $wp_user->ID;
                    update_option('newsletter_pmpro_import_last', $last_id, false);
                    $logger->error('WP User ' . $wp_user->ID . ' with invalid email!');
                    continue;
                }
                $subscriber = $newsletter->get_user($email);
                if ($subscriber) {
                    // TODO: Disconnect other subscribers
                    $wpdb->update(NEWSLETTER_USERS_TABLE, ['wp_user_id' => 0], ['wp_user_id' => $wp_user->ID]);
                    $newsletter->set_user_wp_user_id($subscriber->id, $wp_user->ID);
                } else {
                    $subscriber = [];
                    $subscriber['status'] = TNP_User::STATUS_CONFIRMED;
                    $subscriber['email'] = $email;
                    $subscriber = $newsletter->save_user($subscriber);
                    $newsletter->set_user_wp_user_id($subscriber->id, $wp_user->ID);
                }

                // TODO: Assign lists by role
                $this->align($wp_user->ID);

                $last_id = $wp_user->ID;
                update_option('newsletter_pmpro_import_last', $last_id, false);
            }

            if (time() > $time_limit) {
                $logger->info('Time limit reached, will continue on next run');
                break;
            }

            if (count($wp_users) < $max) {
                $logger->info('Last batch processed');
                wp_unschedule_hook('newsletter_pmpro_import');
                update_option('newsletter_pmpro_import_last', 0, false);
                break;
            }

            if (NEWSLETTER_DEBUG)
                break;
        }
        $logger->info('Import end');
    }
}
