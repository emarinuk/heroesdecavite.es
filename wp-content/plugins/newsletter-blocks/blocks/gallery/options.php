<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */
?>
<style>
    .gallery-img {
        float: left;
        width: 210px;
        /* height: 220px; */
        overflow: hidden;
        margin: 5px;
        border: 1px solid #eee;
        padding: 5px;
        box-sizing: border-box;
        text-align: center;
    }
    .gallery-img input {
        font-size: .9em;
    }
    .tnpc-media-img {
        width: 180px;
        height: 100px;
        overflow: hidden;
    }
</style>


<div class="tnp-accordion">

    <h3>Settings</h3>
    <div>
        <div class="tnp-field-row">

            <div class="tnp-field-col-3">
                <?php $fields->select('columns', 'Columns', ['2' => '2', '3' => '3', '4' => '4']) ?>
            </div>
            <div class="tnp-field-col-3">
                <?php $fields->select('crop', 'Image crop', ['' => 'No', '1' => '4/3', '2' => '16/9', '3' => '1/1', '4' => '3/4']) ?>
            </div>
            <div class="tnp-field-col-3">
                <?php $fields->yesno('responsive', 'Responsive') ?>
            </div>
        </div>

        <?php $fields->url('url', 'Default URL') ?>
    </div>


    <h3>Images</h3>
    <div>
        <?php for ($i = 1; $i <= 12; $i++) { ?>
            <div class="gallery-img">
                <?php $fields->media('image_' . $i, '', ['alt' => true]) ?>
                <?php $fields->url('url_' . $i) ?>
            </div>
        <?php } ?>
    </div>


    <h3>Commons</h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>
