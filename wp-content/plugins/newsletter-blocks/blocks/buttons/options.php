<?php
/* @var $fields NewsletterFields */

$fields->controls->data['schema'] = '';
$max = 3;
?>

<p>
    Empty the button label to hide it.
</p>

<?php $fields->block_style('', ['default' => 'Default', 'wire' => 'Wired']); ?>

<div class="tnp-accordion">

    <h3>General</h3>
    <div>

        <?php $fields->size('button_width', __('Width', 'newsletter')) ?>

    </div>


    <?php for ($i = 1; $i <= $max; $i++) { ?>

        <h3>Button <?php echo $i; ?></h3>
        <div>

            <?php
            $fields->button("button$i", "Button $i",
                    [
                        'family_default' => true,
                        'size_default' => true,
                        'weight_default' => true
                    ])
            ?>

            <div class="tnp-field-row">
                <div class="tnp-field-col-2">
                    <?php $fields->lists_public('list' . $i, 'On click add to', ['empty_label' => 'None']) ?>
                </div>
                <div class="tnp-field-col-2">
                    <?php $fields->lists_public('unlist' . $i, 'On click remove from', ['empty_label' => 'None']) ?>
                </div>
                <div style="clear: both"></div>
            </div>

        </div>

    <?php } ?>

    <h3>Commons</h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>