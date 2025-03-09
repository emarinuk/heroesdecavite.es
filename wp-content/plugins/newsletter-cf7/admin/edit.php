<?php
/* @var $this NewsletterCF7 */
/* @var $controls NewsletterControls */
/* @var $form TNP_FormManager_Form */

defined('ABSPATH') || exit;

if (!$controls->is_action()) {
    $controls->data = $this->get_form_options($form->id);
} else {
    if ($controls->is_action('save')) {
        $this->save_form_options($form->id, $controls->data);
        $controls->add_toast_saved();
    }
}
?>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER; ?>

    <div id="tnp-heading">
        <h2><?php echo esc_html($form->title); ?></h2>
        <?php include __DIR__ . '/nav.php' ?>
    </div>

    <div id="tnp-body">

        <?php $controls->show() ?>

        <form action="" method="post">
            <?php $controls->init(); ?>
            <?php $controls->hidden('welcome_email_id'); ?>
            <?php $controls->hidden('welcome_email'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th><?php esc_html_e('Opt-in', 'newsletter') ?></th>
                    <td>
                        <?php $controls->select('status', array('' => 'Default', 'double' => 'Double opt-in', 'single' => 'Single opt-in')); ?>
                        <p class="description">
                            Double opt-in asks for subscription confirmation with an activation email.
                        </p>
                    </td>
                </tr>
                <tr valign="top">
                    <th><?php esc_html_e('Email', 'newsletter'); ?></th>
                    <td>
                        <?php $controls->select('email', $form->fields, 'Integration disabled'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th><?php esc_html_e('Consent checkbox', 'newsletter'); ?></th>
                    <td>
                        <?php $controls->select('newsletter', $form->fields, 'Not present'); ?>
                        <p class="description">
                            Add a checkbox type field in the form to be used as subscription indicator for
                            example <code>[checkbox newsletter "Subscribe to my newsletter"]</code>.
                            If you leave "Not present" EVERY contact will be subscribed.
                        </p>
                    </td>
                </tr>
                <tr valign="top">
                    <th><?php esc_html_e('First name', 'newsletter'); ?></th>
                    <td>
                        <?php $controls->select('name', $form->fields, __('None', 'newsletter')); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th><?php esc_html_e('Last name', 'newsletter') ?></th>
                    <td>
                        <?php $controls->select('surname', $form->fields, __('None', 'newsletter')); ?>
                    </td>
                </tr>

                <tr valign="top">
                    <th><?php esc_html_e('Gender', 'newsletter') ?></th>
                    <td>
                        <?php $controls->select('gender', $form->fields, 'Not present'); ?>
                        <p>Warning: the valued collected by CF7 must be "f" or "m". For example [select gender "Female|f" "Male|m"]</p>
                    </td>
                </tr>

            </table>


            <h3><?php esc_html_e('Custom fields', 'newsletter') ?></h3>
            <p>
                <a href="?page=newsletter_subscription_customfields" target="_blank"><?php esc_html_e('Configure', 'newsletter') ?></a>
            </p>

            <table class="form-table">
                <?php foreach (Newsletter::instance()->get_customfields() as $profile) { ?>
                    <tr valign="top">
                        <th>
                            <?php echo esc_html($profile->name) ?>
                        </th>
                        <td>
                            <?php $controls->select('profile_' . $profile->id, $form->fields, __('None', 'newsletter')) ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>


            <h3>Automatically assigned lists</h3>
            <table class="form-table">
                <tr>
                    <th style="vertical-align: top">
                        Add subscribers to these lists<br>
                        <small><a href="?page=newsletter_subscription_lists" target="_blank">Manage the lists</a></small>
                    </th>
                    <td><?php $controls->lists('preferences') ?></td>
                </tr>
            </table>

            <h3>Autoresponders</h3>
            <table class="form-table">
                <tr>
                    <th style="vertical-align: top">
                        Add subscribers to these autoresponders<br>

                    </th>
                    <td>
                        <?php if (class_exists('NewsletterAutoresponder')) { ?>
                            <?php
                            $autoresponders = NewsletterAutoresponder::$instance->get_autoresponders();
                            ?>
                            <?php
                            foreach ($autoresponders as $autoresponder) {
                                $controls->checkbox_group('autoresponders', $autoresponder->id, $autoresponder->name);
                                echo '<br>';
                            }
                            ?>
                        <p class="description">
                            If an autoresponder has in/out rules, they could be applied by the Autoresponder addon. It's recommended to
                            activate only autoresponders without rules.
                        </p>

                        <?php } else { ?>
                            The Autoresponder addon is required.
                        <?php } ?>
                    </td>
                </tr>
            </table>

            <p>
                <?php $controls->button_save(); ?>
            </p>

        </form>
    </div>

    <?php include NEWSLETTER_ADMIN_FOOTER; ?>

</div>