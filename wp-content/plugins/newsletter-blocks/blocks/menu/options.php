<?php
/* @var $fields NewsletterFields */

$max = 5;
?>

<p>
    Empty the button label to hide it.
</p>

<div class="tnp-accordion">

    <h3>Settings</h3>
    <div>

        <?php
        $fields->font('text_font', 'Font', [
            'family_default' => true,
            'size_default' => true,
            'weight_default' => true
        ])
        ?>
    </div>

    <h3>Entries</h3>
    <div>
        <?php $fields->separator() ?>

        <?php for ($i = 1; $i <= $max; $i++) { ?>
            <div class="tnp-field-row">
                <div class="tnp-field-col-2">
                    <?php $fields->text('label_' . $i, 'Label ' . $i); ?>
                </div>
                <div class="tnp-field-col-2">
                    <?php $fields->text('url_' . $i, 'URL ' . $i); ?>
                </div>
            </div>
            <?php $fields->separator() ?>

        <?php } ?>

    </div>


    <h3>Commons</h3>
    <div>

        <?php $fields->block_commons() ?>
    </div>
</div>