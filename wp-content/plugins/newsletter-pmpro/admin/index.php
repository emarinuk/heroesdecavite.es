<?php
/* @var $this NewsletterPmpro */

defined('ABSPATH') || exit;

global $wpdb;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();

if (!$controls->is_action()) {
    $controls->data = $this->get_options();
} else {
    if ($controls->is_action('save')) {
        $this->save_options($controls->data);
        $controls->add_toast_saved();
    }

    if ($controls->is_action('import')) {
        if (wp_next_scheduled('newsletter_pmpro_import')) {
            $controls->errors = 'The import is already running';
        } else {
            wp_schedule_event(time(), 'newsletter', 'newsletter_pmpro_import');
            $controls->add_toast('Running');
        }
    }

    if ($controls->is_action('import-stop')) {
        wp_unschedule_hook('newsletter_pmpro_import');
        update_option('newsletter_pmpro_import_last', 0);
        $controls->add_toast('Stopped');
    }
}

$import_running = wp_next_scheduled('newsletter_pmpro_import');

if ($import_running) {
    $total = (int)$wpdb->get_var("select count(*) from {$wpdb->users}");
    $last_id = (int) get_option('newsletter_pmpro_import_last');
    $processed = (int)$wpdb->get_var($wpdb->prepare("select count(*) from {$wpdb->users} where id <= %d", $last_id));

    $controls->add_message('The alignment is running. Processed: ' . $processed . '/' . $total . '. Next run: ' . $controls->print_date($import_running, false, true));

}

$lists = $controls->get_list_options();
?>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER ?>

    <div id="tnp-heading">
        <?php //$controls->title_help('/addons/integrations/contact-form-7-extension/')?>
        <h2>Paid Mebership Pro Integration</h2>
    </div>

    <div id="tnp-body">
        <?php $controls->show() ?>
        <form action="" method="post">
            <?php $controls->init(); ?>

            <div id="tabs">

                <ul>
                    <li><a href="#tabs-general">General</a></li>
                    <li><a href="#tabs-roles">Lists</a></li>
                    <li><a href="#tabs-maintenance">Maintenance</a></li>
                    <!--<li class="tnp-tabs-advanced"><a href="#tabs-status">Advanced</a></li>-->
                </ul>

                <div id="tabs-general">

            <table class="form-table">
                <tr>
                    <th>Subscribe on signup</th>
                    <td>
                        <?php $controls->select('subscribe', [0 => 'No', 1 => 'Show a checkbox', 2 => 'Force subscription']); ?>
                    </td>
                </tr>
                <tr>
                    <th>Checkbox label</th>
                    <td>
                        <?php $controls->text('subscribe_label'); ?>
                    </td>
                </tr>

            </table>

                    </div>

                <div id="tabs-roles">


            <table class="form-table">

                <tbody>
                    <tr>
                        <th>
                            Undefined
                        </th>
                        <td>
                            Lists to activate<br>

                            <?php $controls->select2('undefined_lists_on', $lists, null, true, null, __('None', 'newsletter')); ?>
                            <br><br>
                            Lists to deactivate<br>
                            <?php $controls->select2('undefined__lists_off', $lists, null, true, null, __('None', 'newsletter')); ?>

                        </td>
                    </tr>
                    <?php foreach ($this->get_levels() as $level) { ?>
                        <tr>
                            <th style="vertical-align: top">
                                [<?php echo esc_html($level->id) ?>] <?php echo esc_html($level->name) ?>
                            </th>
                            <td>
                                Lists to activate<br>
                                <?php $controls->select2('level_' . $level->id . '_lists_on', $lists, null, true, null, __('None', 'newsletter')); ?>
                                <br><br>
                                Lists to deactivate<br>
                                <?php $controls->select2('level_' . $level->id . '_lists_off', $lists, null, true, null, __('None', 'newsletter')); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                                    </div>



            <div id="tabs-maintenance">
                <p>
                    The alignment process runs every 5 minutes and process as many users as possible on each run.
                </p>
                    <h3><?php esc_html_e('Maintenance', 'newsletter') ?></h3>
                    <table class="form-table">

                        <tr>
                            <th><?php esc_html_e('Align', 'newsletter') ?></th>
                            <td>
                                <?php if ($import_running) { ?>
                                    <?php $controls->button_confirm('import-stop', __('Stop', 'newsletter'), __('Proceed?', 'newsletter')); ?>
                                <?php } else { ?>
                                    <?php $controls->button_confirm('import', __('Align', 'newsletter'), __('Proceed?', 'newsletter')); ?>
                                <?php } ?>
                                <p class="description">
                                    Starts a process to create or update the subscribers with the WP users. It can take long time,
                                    be patience.
                                </p>
                            </td>
                        </tr>
                    </table>


                </div>
            </div>
            <p>
                <?php $controls->button_save() ?>
            </p>
        </form>
    </div>


</div>