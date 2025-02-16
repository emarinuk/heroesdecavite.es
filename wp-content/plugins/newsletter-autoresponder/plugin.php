<?php

/**
 * @property int $list ID of the associated list
 * @property int $keep_active Do not stop if the subscriber is removed from the associated list
 * @property int[] $emails IDs of the stored emails content
 * @property int $type The autoresponder type
 * @property int $status The autoresponder status
 * @property string $name The autoresponder name
 * @property string $language
 *
 * @property string $utm_campaign
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_term
 * @property string $utm_content
 */
class TNP_Autoresponder {

    const TYPE_CLASSIC = 0;
    const TYPE_COMPOSER = 1;
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
}

/**
 * The $step variable is the step to be processed at the send_at time. When the series is
 * completed, the $step is the last step processed (the index of the last email sent of the series).
 * $step starts from zero.
 *
 * @property int $id The identifier
 * @property int $user_id ID of the associated list
 * @property int $autoresponder_id IDs of the stored emails content
 * @property int $status The step status
 * @property int $send_at Timestamp when to send the step
 * @property int $step The step number to be sent on $send_at
 */
class TNP_Autoresponder_Step {

    const STATUS_RUNNING = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_NO_EMAIL = 2;
    const STATUS_NO_USER = 3;
    const STATUS_NOT_CONFIRMED = 4;
    const STATUS_NOT_IN_LIST = 5;
    const STATUS_STOPPED = 6;
}

class NewsletterAutoresponder extends NewsletterAddon {

    /**
     * @var NewsletterAutoresponder
     */
    static $instance;
    var $store;
    public $autoresponder_table;
    public $autoresponder_steps_table;

    function __construct($version) {
        global $wpdb;

        self::$instance = $this;

        parent::__construct('autoresponder', $version, __DIR__);
        $this->setup_options();

        $this->autoresponder_table = $wpdb->prefix . "newsletter_autoresponder";
        $this->autoresponder_steps_table = $wpdb->prefix . "newsletter_autoresponder_steps";

        add_action('newsletter_user_confirmed', [$this, 'hook_newsletter_user_confirmed']);
    }

    static function instance() {
        return self::$instance;
    }

    function upgrade($first_install = false) {
        parent::upgrade($first_install);

        global $wpdb, $charset_collate;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta("CREATE TABLE `" . $wpdb->prefix . "newsletter_autoresponder` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL DEFAULT '',
            `list` SMALLINT(5) NOT NULL DEFAULT 0,
            `rules` SMALLINT(5) NOT NULL DEFAULT 1,
            `keep_active` SMALLINT(5) NOT NULL DEFAULT 0,
            `language` VARCHAR(5) NOT NULL DEFAULT '',
            `emails` TEXT NOT NULL DEFAULT '',
            `new_lists` TEXT NOT NULL DEFAULT '',
            `status` SMALLINT(5) NOT NULL DEFAULT 0,
            `test` SMALLINT(5) NOT NULL DEFAULT 0,
            `type` SMALLINT(5) NOT NULL DEFAULT 0,
            `restart` SMALLINT(5) NOT NULL DEFAULT 0,
            `regenerate` SMALLINT(5) NOT NULL DEFAULT 0,
            `sender_email` VARCHAR(100) NOT NULL DEFAULT '',
            `sender_name` VARCHAR(100) NOT NULL DEFAULT '',
            `theme` LONGTEXT,
            `utm_campaign` VARCHAR(100) NOT NULL DEFAULT '',
            `utm_source` VARCHAR(100) NOT NULL DEFAULT '',
            `utm_medium` VARCHAR(100) NOT NULL DEFAULT '',
            `utm_term` VARCHAR(100) NOT NULL DEFAULT '',
            `utm_content` VARCHAR(100) NOT NULL DEFAULT '',
            `token` VARCHAR(50) NOT NULL DEFAULT '',
            `align` SMALLINT(5) NOT NULL DEFAULT 1,
            PRIMARY KEY (`id`)) $charset_collate;");

        dbDelta("CREATE TABLE `" . $wpdb->prefix . "newsletter_autoresponder_steps` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(10) unsigned NOT NULL DEFAULT 0,
            `autoresponder_id` int(10) unsigned NOT NULL DEFAULT 0,
            `step` int(10) unsigned NOT NULL DEFAULT 0,
            `send_at` int(10) unsigned NOT NULL DEFAULT 0,
            `status` smallint(10) unsigned NOT NULL DEFAULT 0,
            UNIQUE KEY `idx` (`user_id`,`autoresponder_id`),
            PRIMARY KEY (`id`)) $charset_collate;");

        $autoresponders = $this->get_autoresponders();
        foreach ($autoresponders as $autoresponder) {
            if (empty($autoresponder->token)) {
                $wpdb->update($wpdb->prefix . 'newsletter_autoresponder', ['token' => wp_generate_password(12, false, false)], ['id' => $autoresponder->id]);
            }
        }
    }

    function init() {

        parent::init();

        // Attach to the newsletter engine schduler since we need to keep the correct emailing rate
        add_action('newsletter', [$this, 'hook_newsletter'], 2);

        // Event triggered periodically (see admin.php) to start the alignment process.
        add_action('newsletter_autoresponder_align', [$this, 'hook_newsletter_autoresponder_align']);

        if (is_admin()) {
            if (Newsletter::instance()->is_allowed()) {
                add_filter('newsletter_menu_newsletters', array($this, 'hook_newsletter_menu_newsletters'));
                add_filter('newsletter_lists_notes', array($this, 'hook_newsletter_lists_notes'), 10, 2);

                add_action('newsletter_users_edit_autoresponders', [$this, 'hook_newsletter_users_edit_autoresponders'], 10, 2);
                add_action('newsletter_users_edit_autoresponders_init', [$this, 'hook_newsletter_users_edit_autoresponders_init'], 10, 2);
                add_filter('newsletter_support_data', [$this, 'hook_newsletter_support_data'], 10, 1);
            }

            wp_unschedule_hook('newsletter_autoresponder');

            if (wp_next_scheduled('newsletter_autoresponder_align') === false) {
                wp_schedule_event(time() + HOUR_IN_SECONDS, 'hourly', 'newsletter_autoresponder_align');
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

    function deactivate() {
        parent::deactivate();
        delete_transient('newsletter_autoresponder_run');
        wp_unschedule_hook('newsletter_autoresponder_align');
    }

    function add($user, $autoresponders) {
        $logger = $this->get_logger();
        $logger->debug('Processing user: ' . $user->id);
        if (is_scalar($autoresponders)) {
            $autoresponders = [$autoresponders];
        }

        foreach ($autoresponders as $id) {
            $logger->debug('Processing autoresponder: ' . $id);
        }
    }

    /**
     *
     * @global wpdb $wpdb
     * @param int $user_id
     * @param int $autoresponder_id
     * @return TNP_Autoresponder_Step
     */
    function get_step($user_id, $autoresponder_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM $this->autoresponder_steps_table WHERE user_id=%d AND autoresponder_id=%d limit 1",
                $user_id, $autoresponder_id
        );

        return $wpdb->get_row($query);
    }

    /**
     *
     * @param TNP_Autoresponder_Step $step
     * @return TNP_Autoresponder_Step
     */
    function save_step($step) {
        global $wpdb;
        $store = $this->get_store();
        $res = $store->save($wpdb->prefix . 'newsletter_autoresponder_steps', $step);
        if ($res === false) {
            $this->get_logger()->fatal($wpdb->last_error);
            update_option('newsletter_autoresponder_error', 'Database error: ' . $wpdb->last_error, false);
        }
        return $res;
    }

    function set_step_status($step_id, $status) {
        global $wpdb;
        $res = $wpdb->update($wpdb->prefix . 'newsletter_autoresponder_steps', array('status' => $status), array('id' => $step_id));
        if ($res === false) {
            $this->get_logger()->fatal($wpdb->last_error);
            update_option('newsletter_autoresponder_error', 'Database error: ' . $wpdb->last_error, false);
        }
        return $res;
    }

    function do_next_step($autoresponder_id, $user_id) {
        $logger = $this->get_logger();
        $autoresponder = $this->get_autoresponder($autoresponder_id);
        $user = Newsletter::instance()->get_user($user_id);

        $step = $this->get_step($user_id, $autoresponder_id);
        $logger->debug($step);
        if ($step->status != TNP_Autoresponder_Step::STATUS_RUNNING) {
            $logger->debug('Not running');
            return;
        }
        if ($user->status != TNP_User::STATUS_CONFIRMED) {
            $logger->error('Subscriber not confirmed, add block');
            $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_NOT_CONFIRMED);
            return;
        }

        if (!empty($list) && empty($autoresponder->keep_active)) {
            $field = 'list_' . $list;
            if ($user->$field != 1) {
                $logger->error('User no more in this list, add block');
                $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_NOT_IN_LIST);
                return;
            }
        }

        $result = $this->send($user, $autoresponder, $step);
    }

    /**
     * Step could be read from database, but for performance is provided since
     * it is already available on call.
     *
     * @param TNP_User $user
     * @param TNP_Autoresponder $autoresponder
     * @param TNP_Autoresponder_Step $step
     * @return TNP_Autoresponder_Step
     */
    function send($user, $autoresponder, $step) {
        $logger = $this->get_logger();
        $error = get_option('newsletter_autoresponder_error');
        if ($error) {
            $logger->fatal('Blocked by a previous fatal error');
            return;
        }
        $newsletter = Newsletter::instance();

        $logger->debug('Getting email ' . $autoresponder->emails[$step->step]);

        $email = $newsletter->get_email($autoresponder->emails[$step->step]);

        if (!$email) {
            $logger->debug('Missing email, considering the series ended');
            $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_COMPLETED);
            return;
        }

        $email->track = 1;

        if ($autoresponder->type == TNP_Autoresponder::TYPE_CLASSIC) {
            $email->message = $this->apply_template($email->message, $autoresponder);
        } else {
            if ($autoresponder->regenerate) {
// A possible bug set the email subject to an empty string
                $subject = $email->subject;
                NewsletterEmails::instance()->regenerate($email, ['type' => 'autoresponder']);
                $email->subject = $subject;
                $logger->debug('Email regenerated');
            }
        }

        if ($autoresponder->test) {
            $email->subject = '[Test Mode] ' . $email->subject;
        }

        // TODO: Set the sender name and email
        if ($autoresponder->sender_name) {
            $email->options['sender_name'] = $autoresponder->sender_name;
        }

        if ($autoresponder->sender_email) {
            $email->options['sender_email'] = $autoresponder->sender_email;
        }

        $result = Newsletter::instance()->send($email, [$user], $autoresponder->test);

        // Now the subscriber is moved to the next step
        $step->step++;

        // Are there more emails to send?
        if (!isset($autoresponder->emails[$step->step])) {
            $logger->debug('No other emails, set to completed.');
            $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_COMPLETED);

            // Should the subscriber added to specific lists on completion?
            if (!empty($autoresponder->new_lists)) {
                $logger->debug('Setting new list on completion');
                $data = ['id' => $user->id];
                foreach ($autoresponder->new_lists as $list_id) {
                    $data['list_' . $list_id] = 1;
                }
                $newsletter->save_user($data);
            }
            return;
        }

        // Next email
        $next_email = $newsletter->get_email($autoresponder->emails[$step->step]);
        if (empty($next_email)) {
            // Should never happen, but you know...
            $logger->error('Email not found');
            $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_NO_EMAIL);
            return;
        }

        if (!isset($next_email->options['delay'])) {
            $logger->error('Missing delay set to 0 hours');
            $next_email->options['delay'] = 24;
        }

        $step->send_at = (int) (time() + $next_email->options['delay'] * 3600);
        $logger->debug('Next step updated:');
        $logger->debug($step);
        return $this->save_step($step);
    }

    function set_completed($user, $autoresponder, $step) {
        $logger = $this->get_logger();

        $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_COMPLETED);

        // Should the subscriber added to specific lists on completion?
        if (!empty($autoresponder->new_lists)) {
            $logger->debug('Setting new list on completion');
            $data = ['id' => $user->id];
            foreach ($autoresponder->new_lists as $list_id) {
                $data['list_' . $list_id] = 1;
            }
            Newsletter::instance()->save_user($data);
        }

        // Setting new autoresponder
        if (!empty($autoresponder->new_autoresponders)) {
            $logger->debug('Attaching new autoresponders');
            // ...
        }
    }

    function delete_step($user, $autoresponder) {
        global $wpdb;
        $logger = $this->get_logger();
        $logger->debug('Deleting status for user ' . $user->id . ' and autoresponder ' . $autoresponder->id);
        return $wpdb->query($wpdb->prepare("delete from {$wpdb->prefix}newsletter_autoresponder_steps where autoresponder_id=%d and user_id=%d limit 1", $autoresponder->id, $user->id));
    }

    /**
     * Creates a new step for the subscriber deleting the previous step if present.
     *
     * @global wpdb $wpdb
     * @param type $user
     * @param type $autoresponder
     * @return boolean
     */
    function create_step($user, $autoresponder) {
        global $wpdb;
        $logger = $this->get_logger();
        $logger->debug('Creating step for user ' . $user->id . ' and autoresponder ' . $autoresponder->id);

// Extract the first email
        if (empty($autoresponder->emails)) {
            $logger->debug('No emails in this autoresponder. Stop.');
            return false;
        }

        $newsletter = Newsletter::instance();

        $email = $newsletter->get_email($autoresponder->emails[0]);
        if (empty($email)) {
            $logger->error('First email in autoresponder ' . $autoresponder->id . ' not found! Stop.');
            return false;
        }

        $this->delete_step($user, $autoresponder);

        $step = [];
        $delay = (float) $email->options['delay'];
        $step['send_at'] = (int) (time() + $delay * 3600);
        $step['user_id'] = $user->id;
        $step['autoresponder_id'] = $autoresponder->id;
        $step['step'] = 0;
        $store = $this->get_store();
        $step = $store->save($wpdb->prefix . 'newsletter_autoresponder_steps', $step);

        return $step;
    }

    /**
     * Intercept the subscriber confirmation, attach it to series when the rules match, send the
     * first emails if the daly iz zero.
     *
     * @global wpdb $wpdb
     * @param TNP_User $user
     */
    function hook_newsletter_user_confirmed($user) {
        global $wpdb;

        @set_time_limit(0);
        @ignore_user_abort(true);

        $newsletter = Newsletter::instance();
        $store = $this->get_store();
        $logger = $this->get_logger();
        $logger->debug('Subscriber confirmed, checking if needs to be linked to an autoreponder...');
        $logger->debug($this->user_to_string($user));

        // Check if there are specific autoresponders to be activated
        $ids = wp_parse_list($newsletter->get_user_meta($user->id, 'autoresponders'));
        $newsletter->delete_user_meta($user->id, 'autoresponders');

        $logger->debug('Processing requested autoresponders');
        $logger->debug($ids);
        foreach ($ids as $id) {
            $autoresponder = $this->get_autoresponder($id);

            if (!$autoresponder) {
                $logger->debug('Autoresponder not found: ' . $id);
                continue;
            }

//            $language = $autoresponder->language;
//            if ($user->language !== $language) {
//                $logger->debug('Subscriber language not matching. Stop.');
//                continue;
//            }

            $logger->debug('Adding to autoresponder: ' . $id);
            $step = $this->get_step($user->id, $autoresponder->id);
            if ($step) {
                if ($step->status == TNP_Autoresponder_Step::STATUS_RUNNING) {
                    $logger->debug('Autoresponder already active on this subscriber');
                    continue;
                }

                if (empty($autoresponder->restart)) {
                    $logger->debug('Autoresponder not restartable');
                    continue;
                }
            }
            $step = $this->create_step($user, $autoresponder);
            if ($step->send_at > time()) {
                $logger->debug('First email has a delay, no need to send it right now');
                continue;
            }

            $logger->debug('Created step must be processed immediately');

            $this->send($user, $autoresponder, $step);
        }


        // Autoresponders by rules

        $logger->debug('Processing rules');
        $autoresponders = $this->get_autoresponders();

        foreach ($autoresponders as $autoresponder) {
            $logger->debug('Processing autoresponder ' . $autoresponder->id . '...');

            if (empty($autoresponder->status)) {
                $logger->debug('Autoresponder not enabled. Stop.');
                continue;
            }

            if (empty($autoresponder->rules)) {
                $logger->debug('Autoresponder rules not enabled. Stop.');
                continue;
            }

            $step = $this->get_step($user->id, $autoresponder->id);

            // If a step exists, decide if we can create a new one or not. Many different logics can be
            // implemented and no one will satisfy every customer.
            if ($step) {
                if ($step->status == TNP_Autoresponder_Step::STATUS_RUNNING) {
                    $logger->debug('Autoresponder already active on this subscriber');
                    continue;
                }

                if (empty($autoresponder->restart)) {
                    $logger->debug('Autoresponder not restartable');
                    continue;
                }
            }

            $list = (int) $autoresponder->list;

            $logger->debug('Required list number: ' . $list);

            // If the autorespoder has a list set, the subscriber must be in it
            if (!empty($list)) {
                $field = 'list_' . $list;
                if ($user->$field != 1) {
                    $logger->debug('Subscriber not in the required list. Stop.');
                    continue;
                }
            }

            if (Newsletter::instance()->is_multilanguage()) {
                $language = $autoresponder->language;
                $logger->debug('Required language: ' . $language);
                if ($language && $user->language !== $language) {
                    $logger->debug('Subscriber language not matching. Stop.');
                    continue;
                }
            }

            $step = $this->create_step($user, $autoresponder);

            if (!$step) {
                continue;
            }

            if ($step->send_at > time()) {
                $logger->debug('First email has a delay, no need to send it right now');
                continue;
            }

            $logger->debug('Created step must be processed immediately');

            $this->send($user, $autoresponder, $step);
        }
    }

    /**
     * Periodic (hourly) alignment of subscribers with ALL autoresponder. Activated as scheduled
     * job by the admin.
     */
    function hook_newsletter_autoresponder_align() {

        $logger = $this->get_logger();

        $logger->debug('Hourly alignment start');

        $autoresponders = $this->get_autoresponders();

        foreach ($autoresponders as $autoresponder) {
            $this->align($autoresponder);
        }

        $logger->debug('Hourly alignment end');
    }

    /**
     *
     * @global wpdb $wpdb
     * @param TNP_Autoresponder $autoresponder
     * @return
     */
    function align($autoresponder, $force = false) {
        global $wpdb;
        $logger = $this->get_logger();

        $logger->debug('Alignment start');

        if (empty($autoresponder->status)) {
            $logger->debug('Not enabled. Stop.');
            return new WP_Error('1', 'Series not enabled');
        }

        if (!$force && empty($autoresponder->align)) {
            $logger->debug('Auto align not enabled. Stop.');
            return;
        }

        if (empty($autoresponder->rules)) {
            $logger->debug('Autoresponder without rules, stop.');
            return new WP_Error('1', 'Series with no rules');
        }

        if (empty($autoresponder->emails)) {
            $logger->error('Autoresponder without emails, stop.');
            return;
        }

        $list = (int) $autoresponder->list;

//        if (empty($list)) {
//            $logger->debug('Autoresponder without list, stop.');
//            return;
//        }



        $query = "select count(*) from " . NEWSLETTER_USERS_TABLE . " u left join "
                . $wpdb->prefix . "newsletter_autoresponder_steps s on u.id=s.user_id and autoresponder_id=%d "
                . " where u.status='C' and s.user_id is null";

        $params = [$autoresponder->id];

        if (Newsletter::instance()->is_multilanguage()) {
            $logger->debug('Language: ' . $autoresponder->language);
            if ($autoresponder->language) {
                $query .= " and u.language=%s ";
                $params[] = $autoresponder->language;
            }
        }

        if ($list) {
            $query .= " and u.list_$list=1";
        }

        $query .= " limit 1";

        $logger->debug($query);

        $count = $wpdb->get_var($wpdb->prepare($query, $params));

        $logger->debug($count);

        if ($count === false) {
            $logger->error($wpdb->last_error);
            return new WP_Error('1', $wpdb->last_error);
        }

        if (!$count) {
            $logger->debug('No subscriber to align');
            return 0;
        }

        $logger->debug($count . ' subscribers to align');

        // Get the first email to compute the first delay
        $email = Newsletter::instance()->get_email($autoresponder->emails[0]);

        if (!$email) {
            $logger->error('First email ' . $autoresponder->emails[0] . ' not found during alignment');
            return;
        }
        $send_at = time() + $email->options['delay'] * 3600;

        $query = "insert ignore into " . $wpdb->prefix . "newsletter_autoresponder_steps (autoresponder_id, user_id, send_at) "
                . "(select " . $autoresponder->id . ", u.id, " . $send_at . " from " . $wpdb->prefix . "newsletter u left join "
                . $wpdb->prefix . "newsletter_autoresponder_steps s on u.id=s.user_id and autoresponder_id=%d "
                . "where s.user_id is null and u.status='C'";

        $params = [$autoresponder->id];

        if (Newsletter::instance()->is_multilanguage()) {
            if ($autoresponder->language) {
                $query .= " and u.language=%s ";
                $params[] = $autoresponder->language;
            }
        }

        if ($list) {
            $query .= " and u.list_$list=1";
        }

        $query .= ')';

        $logger->debug($query);

        $r = $wpdb->query($wpdb->prepare($query, $params));
        if ($r === false) {
            $logger->error($wpdb->last_error);
            $logger->error($query);
            return new WP_Error('1', $wpdb->last_error);
        }

        return $r;
    }

    function hook_newsletter($force = false, $autoresponder = null) {
        global $wpdb;

        set_time_limit(0);
        ignore_user_abort(true);

        $newsletter = Newsletter::instance();
        $logger = $this->get_logger();
        $store = $this->get_store();

        $logger->debug('Engine start');

        if (!$autoresponder) {
            $autoresponders = $this->get_autoresponders();
        } else {
            $logger->debug('Request the specific autoresponder ' . $autoresponder->id);
            $autoresponders = [$autoresponder];
        }

        foreach ($autoresponders as $autoresponder) {

            $logger->debug('Processing autoresponder ' . $autoresponder->id);

            if (empty($autoresponder->status)) {
                $logger->debug('Not enabled. Stop.');
                continue;
            }

            if ($autoresponder->test) {
                $logger->debug('Test mode active! Manually run only.');
                if (!$force)
                    continue;
            }

            if (empty($autoresponder->emails)) {
                $logger->debug('No emails configured. Stop.');
                continue;
            }

            $list = (int) $autoresponder->list;

            $emails = $autoresponder->emails;

            //$this->align($autoresponder);
// Extract all the pending steps
            if ($autoresponder->test) {
                $steps = $wpdb->get_results("select * from " . $wpdb->prefix . "newsletter_autoresponder_steps where status=0 and autoresponder_id=" . $autoresponder->id . " order by send_at asc");
            } else {
                $max_emails = $newsletter->get_emails_per_run();
                $logger->debug('Max allowed emails for this run by your capacity is ' . $max_emails);
                $steps = $wpdb->get_results("select * from " . $wpdb->prefix . "newsletter_autoresponder_steps where status=0 and autoresponder_id=" . $autoresponder->id . " and send_at<" . time() . " order by send_at asc limit " . $max_emails);
            }

            if (empty($steps)) {
                $logger->info('No planned steps found. Stop.');
                continue;
            }

            $logger->info(count($steps) . ' found to be processed');

            foreach ($steps as $step) {
                $logger->debug('Processing step ' . $step->id . ' of user ' . $step->user_id);

                $user = $newsletter->get_user($step->user_id);
                if (!$user) {
                    $logger->error('User not found, add block');
                    $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_NO_USER);
                    continue;
                }

                if ($user->status !== TNP_User::STATUS_CONFIRMED) {
                    $logger->error('Subscriber not confirmed, add block');
                    $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_NOT_CONFIRMED);
                    continue;
                }

                if (!empty($list) && empty($autoresponder->keep_active)) {
                    $field = 'list_' . $list;
                    if ($user->$field != 1) {
                        $logger->error('User no more in this list, add block');
                        $this->set_step_status($step->id, TNP_Autoresponder_Step::STATUS_NOT_IN_LIST);
                        continue;
                    }
                }

                $result = $this->send($user, $autoresponder, $step);

                if (!$autoresponder->test && $result === false) {
                    $logger->info('Email capacity exeeded');
                    $logger->info('Engine end');
                    return;
                }
            }
        }

        $logger->info('Engine end');
    }

    /**
     *
     * @param TNP_User $user
     */
    public function user_to_string($user) {
        $b = $user->id . ' - ' . $user->status . ' - ' . $user->email . "\n";
        $b .= 'Lists: ';
        for ($i = 1;
                $i <= NEWSLETTER_LIST_MAX;
                $i++) {
            $field = 'list_' . $i;
            if ($user->$field) {
                $b .= $i . ' ';
            }
        }
        return $b;
    }

    function check_transient($name, $time) {
//usleep(rand(0, 1000000));
        if (($value = get_transient($this->prefix . '_' . $name)) !== false) {
            return false;
        }
        set_transient($this->prefix . '_' . $name, time(), $time);
        return true;
    }

    function delete_transient($name = '') {
        delete_transient($this->prefix . '_' . $name);
    }

    /**
     *
     * @global wpdb $wpdb
     * @param int $id
     * @return TNP_Autoresponder
     */
    function get_autoresponder($id) {
        global $wpdb;
        $store = $this->get_store();
        $autoresponder = $store->get_single($wpdb->prefix . 'newsletter_autoresponder', $id);
        if ($autoresponder) {
            $this->deserialize_autoresponder($autoresponder);
        }
        return $autoresponder;
    }

    function delete_autoresponder($id) {
        global $wpdb;

        $logger = $this->get_logger();
        $logger->info('Deletion of autoresponder ' . $id);

        $autoresponder = $this->get_autoresponder($id);
        if (!$autoresponder) {
            $logger->error('Autoresponder not found');
            return false;
        }

        $logger->info($autoresponder);

        $res = $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}newsletter_autoresponder where id=%d limit 1", $id));
        if ($res) {
            $res = $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}newsletter_autoresponder_steps where autoresponder_id=%d", $id));
            Newsletter::instance()->delete_email($autoresponder->emails);
        }

        return $res;
    }

    /**
     *
     * @global wpdb $wpdb
     * @param array|stdClass|TNP_Autoresponder $autoresponder
     */
    function save_autoresponder($autoresponder) {
        global $wpdb;
        if (is_object($autoresponder)) {
            $autoresponder = (array) $autoresponder;
        }
        if (isset($autoresponder['emails']) && is_array($autoresponder['emails'])) {
            $autoresponder['emails'] = implode(',', $autoresponder['emails']);
        }
        if (isset($autoresponder['new_lists']) && is_array($autoresponder['new_lists'])) {
            $autoresponder['new_lists'] = implode(',', $autoresponder['new_lists']);
        }

        if (isset($autoresponder['theme']) && (is_array($autoresponder['theme']) || is_object($autoresponder['theme']))) {
            $autoresponder['theme'] = json_encode($autoresponder['theme']);
        }

        $store = $this->get_store();

        $autoresponder = $store->save($wpdb->prefix . "newsletter_autoresponder", $autoresponder);
        $autoresponder = $this->get_autoresponder($autoresponder->id);

        $newsletter = Newsletter::instance();
        if ($autoresponder->utm_source) {
            $step = 1;
            foreach ($autoresponder->emails as $email_id) {
                $email = $newsletter->get_email($email_id);
                if ($email) {
                    $email->options['utm_campaign'] = $autoresponder->utm_campaign;
                    $email->options['utm_source'] = str_replace('{step}', $step, $autoresponder->utm_source);
                    $email->options['utm_medium'] = $autoresponder->utm_medium;
                    $email->options['utm_term'] = $autoresponder->utm_term;
                    $email->options['utm_content'] = $autoresponder->utm_content;
                    $newsletter->save_email($email);
                }
                $step++;
            }
        }

        return $autoresponder;
    }

    /**
     *
     * @global wpdb $wpdb
     * @param int $id
     * @return mixed
     */
    function copy_autoresponder($id) {

        $origin_autoresponder = $this->get_autoresponder($id);
        $emails_id_to_duplicate = $origin_autoresponder->emails;
        $origin_autoresponder->status = 0;
        $origin_autoresponder->name .= ' (copy)';
        unset($origin_autoresponder->id);
        unset($origin_autoresponder->emails);

        $new_autoresponder = $this->save_autoresponder($origin_autoresponder);

        $duplicate_emails_id = [];
        foreach ($emails_id_to_duplicate as $email_id) {
//Duplicate email
            $original_email = Newsletter::instance()->get_email($email_id);

            $email = [];
            $email['subject'] = $original_email->subject;
            $email['message'] = $original_email->message;
            $email['message_text'] = $original_email->message_text;
            $email['type'] = 'autoresponder_' . $new_autoresponder->id;
            $email['editor'] = $original_email->editor;
            $email['options'] = $original_email->options;
            $email['track'] = 1;
            $email['status'] = 'sent'; // Imposto lo stato a 'sent' perchè altrimenti non sarebbe possibile la visualizzazione online della mail

            $new_email = NewsletterEmails::instance()->save_email($email);

//Save id to array
            $duplicate_emails_id[] = $new_email->id;
        }

        $new_autoresponder->emails = $duplicate_emails_id;

        return $this->save_autoresponder($new_autoresponder);
    }

    function get_autoresponder_key($id) {
        global $wpdb;
        $store = $this->get_store();
        $autoresponder = $store->get_single($wpdb->prefix . 'newsletter_autoresponder', $id);
        if (!$autoresponder) {
            return false;
        }
        return $autoresponder->id . '-' . $autoresponder->token;
    }

    function is_valid_key($key) {
        list($id, $token) = explode('-', $key, 2);
        if (empty($token) || empty($id)) {
            return false;
        }
        $autoresponder = $this->get_autoresponder($id);
        if (!$autoresponder) {
            return false;
        }
        if (empty($autoresponder->token)) {
            return false;
        }
        if ($autoresponder->token !== $token) {
            return false;
        }
        return true;
    }

    /**
     *
     * @param TNP_Autoresponder $autoresponder
     * @return TNP_Autoresponder (itself)
     */
    function deserialize_autoresponder($autoresponder) {
        $autoresponder->emails = wp_parse_id_list($autoresponder->emails);

        $autoresponder->new_lists = wp_parse_id_list($autoresponder->new_lists);

        if (empty($autoresponder->theme)) {
            $autoresponder->theme = [];
        } else {
            $autoresponder->theme = json_decode($autoresponder->theme, true);
        }

        if (empty($autoresponder->theme['theme'])) {
            $autoresponder->theme['theme'] = 'default';
        }

        $autoresponder->list = (int) $autoresponder->list;

        return $autoresponder;
    }

    /**
     *
     * @global wpdb $wpdb
     * @return TNP_Autoresponder[]
     */
    function get_autoresponders() {
        global $wpdb;
        $autoresponders = $wpdb->get_results("select * from " . $wpdb->prefix . "newsletter_autoresponder order by id");
        foreach ($autoresponders as $autoresponder) {
            $this->deserialize_autoresponder($autoresponder);
        }
        return $autoresponders;
    }

    /**
     *
     * @return NewsletterStore
     */
    function get_store() {
        if ($this->store) {
            return $this->store;
        }
        $this->store = new NewsletterStore('autoresponder');
        return $this->store;
    }

    function apply_template($body, $autoresponder) {
        ob_start();

        $theme_options = $autoresponder->theme;
        $theme = $this->get_theme($theme_options['theme']);
        if (empty($theme)) {
            $theme = $this->get_theme('default');
        }

        $theme_defaults_file = $theme['dir'] . '/theme-defaults.php';
        if (file_exists($theme_defaults_file)) {
            @include $theme_defaults_file;
            if (is_array($theme_defaults)) {
                $theme_options = array_merge($theme_defaults, $theme_options);
            }
        }

        include $theme['dir'] . '/theme.php';

        $theme = ob_get_clean();
        if (strpos($theme, '{message}') !== false) {
            $body = str_replace('{message}', $body, $theme);
        }
        return Newsletter::instance()->inline_css($body);
    }

    /**
     * Returns all the available themes. The list is a set of arrays with keys:
     *
     * dir - the path to the theme
     * name - the theme name
     *
     */
    function get_themes() {
        static $list = [];

// Caching
        if (!empty($list)) {
            return $list;
        }

        $logger = $this->get_logger();
        $dirs = [];
        $dirs[] = __DIR__ . '/themes/default';
        $dirs[] = __DIR__ . '/themes/html';

        $extra = apply_filters('newsletter_autoresponder_themes', []);

        $dirs = array_merge($dirs, $extra);

// [TODO] On windows it may not work
        foreach ($dirs as $dir) {
            $dir = wp_normalize_path($dir);
            if (!file_exists($dir . '/theme.php')) {
                continue;
            }

            $id = basename($dir);
            if (isset($list[$id])) {
                $logger->error('Theme in ' . $dir . ' folder already registered');
                continue;
            }

            $data = get_file_data($dir . '/theme.php', array('name' => 'Name', 'preview' => 'Preview'));

// Should never happen
            if (!$data) {

            }

            $data['id'] = $id;
            $data['dir'] = $dir;

            if (empty($data['name'])) {
                $data['name'] = $id;
            }

            if (!isset($data['preview']))
                $data['preview'] = true;
            else
                $data['preview'] = $data['preview'] !== 'false';

            $list[$id] = $data;
        }

        return $list;
    }

    function get_theme($id) {
        if (empty($id)) {
            $id = 'default';
        }
        $themes = $this->get_themes();
        if (isset($themes[$id])) {
            return $themes[$id];
        }
        return null;
    }

    function hook_newsletter_support_data($data) {
        $autoresponders = $this->get_autoresponders();
        $autoresponder_data = [];
        $autoresponder_data['version'] = $this->version;
        foreach ($autoresponders as $a) {
            $autoresponder_data['autoresponder-' . $a->id] = (array) $a;
        }

        $data['autoresponder'] = $autoresponder_data;
        return $data;
    }

    function format_delay($delay) {
        $days = floor($delay / 24);
        $hours = $delay % 24;
        if ($days)
            $b = $days . ' day(s), ' . $hours . ' hour(s)';
        else
            $b = $hours . ' hour(s)';

        return $b;
    }

    function hook_newsletter_menu_newsletters($entries) {
        $entries[] = [
            'label' => 'Autoresponder',
            'url' => '?page=newsletter_autoresponder_index'
        ];
        return $entries;
    }

    function hook_newsletter_lists_notes($notes, $list_id) {
        static $autoresponders = null;
        if (is_null($autoresponders)) {
            $autoresponders = $this->get_autoresponders();
        }
        foreach ($autoresponders as $autoresponder) {
            if ($autoresponder->list == $list_id) {
                $notes[] = 'Linked to email series "' . esc_html($autoresponder->name) . '"';
            }
        }
        return $notes;
    }

    public function get_status_label($status) {
        switch ($status) {
            case TNP_Autoresponder_Step::STATUS_COMPLETED: return 'Completed';
            case TNP_Autoresponder_Step::STATUS_NOT_CONFIRMED: return 'Stopped: unsubscribed';
            case TNP_Autoresponder_Step::STATUS_NOT_IN_LIST: return 'Stopped: not in list';
            case TNP_Autoresponder_Step::STATUS_NO_USER: return 'Stopped: missing subscriber';
            case TNP_Autoresponder_Step::STATUS_RUNNING: return 'Running';
            case TNP_Autoresponder_Step::STATUS_STOPPED: return 'Manually stopped';
        }
    }

    /**
     * Invoked only if the current user is allowed.
     */
    function admin_menu() {
        add_submenu_page('newsletter_main_index', 'Autoresponder', '<span class="tnp-side-menu">Autoresponder</span>', 'exist', 'newsletter_autoresponder_index', function () {
            require __DIR__ . '/admin/index.php';
        });

        add_submenu_page('admin.php', 'Autoresponder', 'Autoresponder', 'exist', 'newsletter_autoresponder_messages', function () {
            require __DIR__ . '/admin/messages.php';
        });

        add_submenu_page('admin.php', 'Autoresponder', 'Autoresponder', 'exist', 'newsletter_autoresponder_edit', function () {
            require __DIR__ . '/admin/edit.php';
        });

        add_submenu_page('admin.php', 'Autoresponder', 'Autoresponder', 'exist', 'newsletter_autoresponder_email', function () {
            require __DIR__ . '/admin/edit-email.php';
        });

        add_submenu_page('admin.php', 'Autoresponder', 'Autoresponder', 'exist', 'newsletter_autoresponder_composer', function () {
            require __DIR__ . '/admin/edit-email-composer.php';
        });

        add_submenu_page('admin.php', 'Theme', 'Theme', 'exist', 'newsletter_autoresponder_theme', function () {
            require __DIR__ . '/admin/theme.php';
        });
        add_submenu_page('admin.php', 'Statistics', 'Statistics', 'exist', 'newsletter_autoresponder_statistics', function () {
            require __DIR__ . '/admin/statistics.php';
        });
        add_submenu_page('admin.php', 'Subscribers', 'Subscribers', 'exist', 'newsletter_autoresponder_users', function () {
            require __DIR__ . '/admin/users.php';
        });
        add_submenu_page('admin.php', 'Maintenance', 'Maintenance', 'exist', 'newsletter_autoresponder_maintenance', function () {
            require __DIR__ . '/admin/maintenance.php';
        });

//        add_submenu_page('', 'Welcome series', 'Welcome series', 'exist', 'newsletter_autoresponder_subscription_index', function () {
//            require __DIR__ . '/admin/subscription/index.php';
//        });
    }

    function hook_newsletter_users_edit_autoresponders($user, $controls) {
        include __DIR__ . '/admin/users/index.php';
    }

    /**
     *
     * @param type $user
     * @param NewsletterControls $controls
     */
    function hook_newsletter_users_edit_autoresponders_init($user, $controls) {
        global $wpdb;
        if ($controls->is_action('restore')) {
            $autoresponder = $this->get_autoresponder($controls->button_data);
            if (!$autoresponder) {
                die('Wrong autoresponder ID');
            }
            if (!empty($autoresponder->list)) {
                $list = (int) $autoresponder->list;
                Newsletter::instance()->set_user_list($user, $list, 1);
            }
            $wpdb->query($wpdb->prepare("update {$wpdb->prefix}newsletter_autoresponder_steps set status=0 where user_id=%d and autoresponder_id=%d limit 1", $user->id, $autoresponder->id));
            $controls->add_toast_done();
        }

        if ($controls->is_action('restart')) {
            $autoresponder = $this->get_autoresponder($controls->button_data);
            if (!$autoresponder) {
                die('Wrong autoresponder ID');
            }
            if (!empty($autoresponder->list)) {
                $list = (int) $autoresponder->list;
                Newsletter::instance()->set_user_list($user, $list, 1);
            }

            $emails = $autoresponder->emails;
            $email = Newsletter::instance()->get_email($emails[0]);
            $send_at = time() + $email->options['delay'] * 3600;
            $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "newsletter_autoresponder_steps set status=0, step=0, send_at=%d where user_id=%d and autoresponder_id=%d limit 1", $send_at, $user->id, $autoresponder->id));
            $controls->add_toast_done();
        }

        if ($controls->is_action('continue')) {
            $autoresponder = $this->get_autoresponder($controls->button_data);
            if (!$autoresponder) {
                die('Wrong autoresponder ID');
            }
            $step = $this->get_step($user->id, $autoresponder->id);
            $step->step++;

            $emails = $autoresponder->emails;
            $email = Newsletter::instance()->get_email($emails[$step->step]);

            if (!$email) {
                $controls->errors = 'No new steps available';
            } else {
                $this->move_completed_subscriber_to_next_step($user->id, $autoresponder->id, $email);
            }
            $controls->add_toast_done();
        }

        if ($controls->is_action('stop')) {
            $this->set_step_status($controls->button_data, TNP_Autoresponder_Step::STATUS_STOPPED);
            $controls->add_toast_done();
        }

        if ($controls->is_action('attach')) {
            $autoresponder = $this->get_autoresponder($controls->button_data);
            if (!$autoresponder) {
                die('Wrong autoresponder ID');
            }
            NewsletterAutoresponder::instance()->create_step($user, $autoresponder);
        }
    }

    /**
     *
     * @param TNP_Autoresponder $autoresponder
     */
    public function get_user_count($autoresponder) {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare(
                                "select count(*) from {$wpdb->prefix}newsletter_autoresponder_steps where status=%d and autoresponder_id=%d",
                                TNP_Autoresponder_Step::STATUS_RUNNING, $autoresponder->id));
    }

    public function get_user_counts($autoresponder) {
        global $wpdb;
        $data = $wpdb->get_row($wpdb->prepare("SELECT COUNT(*) AS total,
            COUNT(case when STATUS = %d then 1 END) AS running,
            COUNT(case when STATUS = %d then 1 END) AS completed FROM {$wpdb->prefix}newsletter_autoresponder_steps WHERE autoresponder_id=%d",
                        TNP_Autoresponder_Step::STATUS_RUNNING, TNP_Autoresponder_Step::STATUS_COMPLETED, $autoresponder->id));

        $data->stopped = $data->total - $data->running - $data->completed;
        return $data;
    }

    public function get_late_user_count($autoresponder) {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare("select count(*) from {$wpdb->prefix}newsletter_autoresponder_steps where status=%d "
                                . "and send_at<%d and autoresponder_id=%d",
                                TNP_Autoresponder_Step::STATUS_RUNNING, time() - 900, $autoresponder->id));
    }

    function get_early_completed_count($autoresponder) {
        global $wpdb;

        $r = $wpdb->get_row($wpdb->prepare("select * from {$wpdb->prefix}newsletter_autoresponder_steps where autoresponder_id=%d and status=1 and step<%d limit 1",
                        $autoresponder->id, count($autoresponder->emails) - 1));

        return $r;
    }

    function get_subscribers_count_waiting_on_step($autoresponder_id, $step_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT count(*) FROM $this->autoresponder_steps_table WHERE autoresponder_id=%d AND step=%d AND status=%d",
                $autoresponder_id,
                $step_id,
                TNP_Autoresponder_Step::STATUS_RUNNING
        );

        return (int) $wpdb->get_var($query);
    }

    function get_late_subscribers_count_waiting_on_step($autoresponder_id, $step_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT count(*) FROM $this->autoresponder_steps_table WHERE autoresponder_id=%d AND step=%d AND status=%d AND send_at<%d",
                $autoresponder_id,
                $step_id,
                TNP_Autoresponder_Step::STATUS_RUNNING,
                time() - 600
        );

        return (int) $wpdb->get_var($query);
    }

    /**
     * Get list of users with TNP_Autoresponder_Step::STATUS_COMPLETED status inside steps
     *
     * @return array
     */
    public function get_completed_subscribers_by_steps($autoresponder) {

        $completed_subscriber_by_steps = [];
        foreach ($autoresponder->emails as $step => $email) {
            $completed_subscriber_by_steps[$step] = $this->get_completed_subscribers_id_by_step($autoresponder->id, $step);
        }

        return $completed_subscriber_by_steps;
    }

    private function get_completed_subscribers_id_by_step($autoresponder_id, $step_id) {
        global $wpdb;

        $query = $wpdb->prepare("SELECT user_id FROM $this->autoresponder_steps_table WHERE autoresponder_id=%d AND step=%d AND status=%d",
                $autoresponder_id,
                $step_id,
                TNP_Autoresponder_Step::STATUS_COMPLETED
        );

        $subscriber_id_list = array_map(function ($record) {
            return (int) $record->user_id;
        }, $wpdb->get_results($query));

        return $subscriber_id_list;
    }

    /**
     * Check if there are subscribers with TNP_Autoresponder_Step::STATUS_COMPLETED to move to new steps
     *
     * @return false
     */
    public function need_to_move_completed_subscribers($autoresponder) {
        $subscribers_to_move = $this->get_completed_subscribers_by_steps($autoresponder);
        $max_steps = count($autoresponder->emails) - 1;

        $need_to_move = false;
        foreach ($subscribers_to_move as $step => $subscribers_on_step) {
            if ($step < $max_steps && count($subscribers_on_step) > 0) {
                $need_to_move = true;
            }
        }

        return $need_to_move;
    }

    /**
     * Reschedule
     */
    public function move_subscribers_with_completed_status_to_new_step($autoresponder) {

        $subscribers_to_move = $this->get_completed_subscribers_by_steps($autoresponder);
        $max_steps = count($autoresponder->emails) - 1;

        foreach ($subscribers_to_move as $step => $subscribers_on_step) {

            if ($step < $max_steps && count($subscribers_on_step) > 0) {

                $next_step = $step + 1;
                if (!isset($autoresponder->emails[$next_step])) {
                    throw new Exception('Invalid email step');
                }

                $next_step_email = Newsletter::instance()->get_email($autoresponder->emails[$next_step]);

                foreach ($subscribers_on_step as $subscriber_id) {

                    $step_row = $this->get_step($subscriber_id, $autoresponder->id);

                    $step_row->send_at += $next_step_email->options['delay'] * 3600;
                    $step_row->status = TNP_Autoresponder_Step::STATUS_RUNNING;
                    $step_row->step++;

                    $this->save_step($step_row);
                }
            }
        }
    }

    function move_completed_subscriber_to_next_step($subscriber_id, $autoresponder_id, $next_step_email) {

        $step_row = $this->get_step($subscriber_id, $autoresponder_id);

        $step_row->send_at += $next_step_email->options['delay'] * 3600;
        $step_row->status = TNP_Autoresponder_Step::STATUS_RUNNING;
        $step_row->step++;

        $this->save_step($step_row);
    }

    function delete_orphan_steps() {
        global $wpdb;

        $wpdb->query("delete s from {$wpdb->prefix}newsletter_autoresponder_steps s left join {$wpdb->prefix}newsletter u on u.id=s.user_id where u.id is null");
    }
}
