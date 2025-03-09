<?php
/* @var $this NewsletterCF7 */
/* @var $controls NewsletterControls */

defined('ABSPATH') || exit;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();

$list = $this->get_forms();
?>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER; ?>

    <div id="tnp-heading">
        <?php $controls->title_help('/addons/integrations/contact-form-7-extension/') ?>
        <h2><?php esc_html_e('Forms', 'newsletter') ?></h2>
    </div>

    <div id="tnp-body">
        <?php $controls->show() ?>
        <form action="" method="post">
            <?php $controls->init(); ?>

            <table class="widefat" style="width: auto">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th><?php esc_html_e('Title', 'newsletter'); ?></th>
                        <th><?php esc_html_e('Status', 'newsletter'); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($list as $item) { ?>
                        <tr>
                            <td>
                                <?php echo esc_html($item->id) ?>
                            </td>
                            <td>
                                <?php echo esc_html($item->title) ?>
                            </td>
                            <td>
                                <?php echo $item->connected ? '<i class="fas fa-link" title="Linked"></i>' : '<i class="fas fa-unlink" title="Not linked"></i>' ?>
                            </td>
                            <td>
                                <?php $controls->button_icon_configure('?page=newsletter_' . $this->name . '_edit&id=' . rawurlencode($item->id)) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </form>
    </div>
    <?php include NEWSLETTER_ADMIN_FOOTER; ?>

</div>