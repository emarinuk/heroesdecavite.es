<?php
/* @var $this NewsletterGeo */
/* @var $controls NewsletterControls */
/* @var $logger NewsletterLogger */

defined('ABSPATH') || exit;

global $wpdb;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$logger = $this->get_admin_logger();

if (isset($_GET['subpage'])) {
    include __DIR__ . '/summary.php';
    return;
}

if (!$controls->is_action()) {
    $controls->data = $this->options;
} else {

    $logger->info($controls->action);

    if ($controls->is_action('save')) {
        $this->save_options($controls->data);
        $controls->add_message_saved();
    }

    if ($controls->is_action('test')) {
        $result = $this->run(true);
        if (is_wp_error($result)) {
            $controls->errors .= $result->get_error_message();
        } else {
            $controls->messages .= 'Success (test IP resolved to ' . json_encode($result) . ')';
        }
    }

    if ($controls->is_action('run_now')) {
        $result = $this->run();
        if (is_wp_error($result)) {
            /* @var $result WP_Error */
            $controls->messages = 'Geo serviceunavailable: ' . esc_html($result->get_error_code()) . ' - ' . esc_html($result->get_error_message());
        } else {
            $controls->messages .= 'Processed ' . $result . ' subscribers.';
        }
    }

    if ($controls->is_action('reset')) {
        // Totally reset the geolocation data
        $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set geo=0, country='', city='', region=''");
        $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set geo=1 where ip=''");
        $controls->messages = 'Geolocation data fully reset.';
    }

    if ($controls->is_action('reset_unresolved')) {
        $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set geo=0, country='', city='', region='' where country='XX'");
        $controls->messages = 'Unresolved subscribers reset.';
    }
}
?>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_ADMIN_HEADER ?>

    <div id="tnp-heading">

        <h2>Geolocation</h2>

    </div>

    <div id="tnp-body">

        <?php $controls->show() ?>

        <form method="post" action="">
            <?php $controls->init(); ?>

            <p>
                <?php $controls->button_test() ?>
                <?php $controls->button('run_now', 'Run now') ?>
                <?php $controls->btn_link('?page=newsletter_geo_index&subpage=summary', 'Summary', ['secondary' => true]) ?>
            </p>
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-general">General</a></li>
                </ul>

                <div id="tabs-general">

                    <table class="widefat" style="width: auto">
                        <thead>
                            <tr>
                                <th>Subscribers</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Subscribers to be (re)processed</th>
                                <td><?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='C' and geo=0 and ip<>''"); ?></td>
                            </tr>
                            <tr>
                                <th>Subscribers with country</th>
                                <td><?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='C' and country<>'' and country<>'XX'"); ?></td>
                            </tr>
                            <tr>
                                <th>Subscribers with unresolved country</th>
                                <td><?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='C' and country='XX'"); ?></td>
                            </tr>
                            <tr>
                                <th>Subscribers without IP address</th>
                                <td><?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='C' and ip=''"); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="description">
                        Totals refer only to confirmed subscribers.<br>
                        Subscribers without an IP address could have been imported or added via API.<br>
                    </p>

                    <?php $controls->button_confirm_secondary('reset', 'Reset all data', 'Warning: all subscribers will be reprocessed!') ?>
                    <?php $controls->button_confirm_secondary('reset_unresolved', 'Reset unresolved', 'Proceed?') ?>


                    <table class="form-table">
                        <tr>
                            <th>Geolocation last run</th>
                            <td>
                                <?php echo $controls->print_date($this->get_last_run()); ?>
                                <p class="description">
                                    The country detection finds the countries from which the users subscribed (visible on user statistic panel).
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>Geolocation next run</th>
                            <td>
                                <?php echo $controls->print_date(wp_next_scheduled('newsletter_geo_run')); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </form>
    </div>

</div>