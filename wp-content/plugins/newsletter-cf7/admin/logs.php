<?php
/* @var $this NewsletterForminator */
/* @var $controls NewsletterControls */
/* @var $form TNP_FormManager_Form */

?>

<div class="wrap" id="tnp-wrap">
    <?php include NEWSLETTER_ADMIN_HEADER; ?>
    <div id="tnp-heading">
        <h2><?php echo esc_html($form->title) ?></h2>
        <?php include __DIR__ . '/nav.php'; ?>
    </div>

    <div id="tnp-body">

        <form method="post" action="">
            <?php $controls->init(); ?>

            <?php $controls->logs($this->name . '-' . $form->id); ?>

        </form>

    </div>
    <?php include NEWSLETTER_ADMIN_FOOTER; ?>
</div>
