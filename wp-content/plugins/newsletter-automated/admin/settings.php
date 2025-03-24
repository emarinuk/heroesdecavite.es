<?php
/* @var $this NewsletterAutomated */
/* @var $controls NewsletterControls */

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();

$logger = $this->get_admin_logger();

if (!$controls->is_action()) {
    $controls->data = $this->options;
} else {

    if ($controls->is_action('save')) {
        $this->save_options($controls->data);
        $controls->add_message_saved();
    }
}

$administrators = get_users(['role' => 'administrator']);
$user_options = [];
foreach ($administrators as $administrator) {
    $user_options[$administrator->ID] = $administrator->display_name;
}
?>


<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_ADMIN_HEADER; ?>

    <div id="tnp-heading">

        <h2>Automated Newsletters</h2>
        <?php include __DIR__ . '/nav-index.php'; ?>
        <?php $controls->show(); ?>

    </div>

    <div id="tnp-body" class="tnp-automated-edit">

        <form method="post" action="">
            <?php $controls->init(); ?>
            <table class="form-table">
                <tr>
                    <th>Run as administrator</th>
                    <td>
                        <?php $controls->select('user_id', $user_options, 'None'); ?>
                        <p class="description">
                            User used when generating the newsletter to avoid blocks by membership plugins.
                            <a href="https://www.thenewsletterplugin.com/documentation/addons/extended-features/automated-extension/" target=""_blank">Read more</a>.
                        </p>
                    </td>
                </tr>

            </table>

            <p>
                <?php $controls->button_save(); ?>
            </p>

        </form>

    </div>

</div>
