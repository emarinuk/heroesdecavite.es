<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */
?>

<p>
    Empty all column texts to hide it.
</p>

<?php $fields->block_style('', ['default' => 'Default', 'inverted' => 'Inverted']); ?>

<div class="tnp-accordion">

    <h3>Settings</h3>
    <div>
        <div class="tnp-field-row">
            <div class="tnp-field-col-2">
                <?php $fields->select('responsive', 'Responsive', ['1' => 'Responsive', '0' => 'Not responsive']) ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->select('crop', 'Image crop', ['' => 'No', '1' => '4/3', '2' => '16/9', '3' => '1/1']) ?>
            </div>
        </div>

        <?php
        $fields->font('font', __('Text font', 'newsletter'), [
            'family_default' => true,
            'size_default' => true,
            'weight_default' => true
        ])
        ?>

        <?php
        $fields->font('title_font', __('Title font', 'newsletter'), [
            'family_default' => true,
            'size_default' => true,
            'weight_default' => true
        ])
        ?>
    </div>

    <?php for ($i = 1; $i <= 4; $i++) { ?>

        <h3>Column <?php echo $i; ?></h3>
        <div>
            <?php $fields->media('image_' . $i, 'Image') ?>
            <?php $fields->text('title_' . $i, 'Title') ?>
            <div class="tnp-field-row">
                <div class="tnp-field-col-2"><?php $fields->text('text_' . $i, 'Text') ?></div>
                <div class="tnp-field-col-2"><?php $fields->url('url_' . $i, 'Url') ?></div>
            </div>

        </div>

    <?php } ?>

    <h3>Commons</h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>
