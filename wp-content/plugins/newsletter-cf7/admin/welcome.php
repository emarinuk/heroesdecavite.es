<?php
/* @var $this NewsletterCF7 */
defined('ABSPATH') || exit;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();

$form = $this->get_form(sanitize_key($_GET['id'] ?? ''));
if (!$form) {
    die('Form not found');
}
$form_options = $this->get_form_options($form->id);

if (!$controls->is_action()) {

    $email = Newsletter::instance()->get_email($form_options['welcome_email_id']);
    if (!$email) {
        $email = [];
        $email['type'] = 'welcome';
        $email['editor'] = NewsletterEmails::EDITOR_COMPOSER;
        $email['message'] = '';
        $email['track'] = Newsletter::instance()->get_option('track');
        $email['subject'] = 'Welcome';
        $email['status'] = 'sent';
        $email = NewsletterEmails::instance()->save_email($email);
        $form_options['welcome_email_id'] = $email->id;
        $form_options['welcome_email'] = '';
        $this->save_form_options($form->id, $form_options);
    }
    $email = Newsletter::instance()->get_email($form_options['welcome_email_id']);
    TNP_Composer::prepare_controls($controls, $email);
    $controls->data['welcome_email'] = $form_options['welcome_email'];
} else {
    if ($controls->is_action('save')) {
        $form_options['welcome_email'] = $controls->data['welcome_email'];
        $this->save_form_options($form->id, $form_options);
        $email = Newsletter::instance()->get_email($form_options['welcome_email_id']);
        TNP_Composer::update_email($email, $controls);
        if (empty($email->subject)) {
            $email->subject = 'Welcome';
        }
        $email->track = Newsletter::instance()->get_option('track');
        $email->status = 'sent';
        $email = NewsletterEmails::instance()->save_email($email);
        $controls->add_toast_saved();
        TNP_Composer::prepare_controls($controls, $email);
    }
}
?>
<script>
    var tnp_preset_show = false;
    jQuery(function () {
        jQuery('#options-welcome_email').on('change', function () {
            if (this.value === '1') {
                jQuery('#tnp-builder').show();
            } else {
                jQuery('#tnp-builder').hide();
            }
        });
        if (document.getElementById('options-welcome_email').value === '1') {
            jQuery('#tnp-builder').show();
        } else {
            jQuery('#tnp-builder').hide();
        }
    });
</script>
<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER ?>
    <div id="tnp-heading">

        <h2><?php echo esc_html($form->title) ?></h2>
        <?php include __DIR__ . '/nav.php' ?>

    </div>

    <div id="tnp-body" class="tnp-automated-edit">


        <?php $controls->show(); ?>


        <div class="tnp-automated-edit">

            <form method="post" id="tnpc-form" action="" onsubmit="tnpc_save(this); return true;">
                <?php $controls->init(); ?>

                <p>
                    <?php $controls->button_save() ?>
                    <?php $controls->select('welcome_email', ['' => 'Use the default welcome email', '1' => 'Use this custom welcome email', '2' => 'Do not send']); ?>
                    <?php $controls->button_icon_statistics(NewsletterStatisticsAdmin::instance()->get_statistics_url($form_options['welcome_email_id']), ['secondary' => true]) ?>
                </p>
                <?php $controls->composer_fields_v2() ?>

            </form>
            <?php $controls->composer_load_v2(true, false, 'automated') ?>

        </div>

    </div>
</div>

