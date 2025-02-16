<?php
defined('ABSPATH') || exit;

/* @var $this NewsletterImport */
/* @var $controls NewsletterControls */

//$this->hook_newsletter_import_run();

if ($controls->is_action('stop')) {
    $this->mp_stop();
    $controls->js_redirect('admin.php?page=newsletter_import_mailpoet');
}

if ($controls->is_action('refresh')) {
    // just a reload
}
?>
<script>
    function importRun() {
        //debugger;
        jQuery.get(ajaxurl + '?action=newsletter_import_mailpoet', function (data) {
            if (!data.completed) {
                setTimeout(importRun, 100);
                jQuery('#tnp-import-statistics').html(data.html);
            } else {
                location.href = '?page=newsletter_import_mailpoet';
            }
        });
    }
    importRun();
</script>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_ADMIN_HEADER; ?>

    <div id="tnp-heading">
        <?php $controls->title_help('/addons/extended-features/advanced-import/') ?>
        <h2>MailPoet import</h2>
        <?php include __DIR__ . '/nav.php' ?>
    </div>


    <div id="tnp-body">

        <?php $controls->show() ?>

        <h3>MailPoet import is running, keep this page open</h3>

        <div id="tnp-import-statistics">
            Importing... (updated every 10 seconds)
        </div>

        <form method="post" action="#">
            <?php $controls->init(); ?>

            <p>
                <?php $controls->button_confirm('stop', 'Stop'); ?>
                <?php $controls->button('refresh', 'Refresh'); ?>
            </p>

        </form>
    </div>

</div>
