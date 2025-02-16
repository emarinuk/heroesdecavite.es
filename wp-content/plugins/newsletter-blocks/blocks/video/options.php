<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $fields NewsletterFields */
?>

<p>
    Supported: Vimeo, YouTube, DailyMotion, TED and many other. The video cover size is force by the video
    provider. The video cover will be linked to the video page.
</p>

<div class="tnp-accordion">

    <h3>Settings</h3>
    <div>
        <?php $fields->url('url', 'Video URL') ?>
    </div>
    
    <h3>Commons</h3>
    <div>
        <?php $fields->block_commons() ?>
    </div>
</div>


