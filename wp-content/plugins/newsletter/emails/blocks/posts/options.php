<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */

$extensions_url = '?page=newsletter_main_extension';
if (class_exists('NewsletterExtensions')) {
    $extensions_url = '?page=newsletter_extensions_index';
}

// https://developer.wordpress.org/reference/classes/wp_user_query/
$authors = get_users(['has_published_posts' => ['post'], 'number' => 50, 'fields' => ['ID', 'display_name']]);
$authors_options = ['' => 'All'];
foreach ($authors as $author) {
    $authors_options[(string) $author->ID] = $author->display_name;
}
if (NEWSLETTER_DEBUG) {
    $authors_options['-1'] = 'Test no valid author';
}
?>
<p>
    Custom post types can be added using our <a href="<?php echo $extensions_url ?>" target="_blank">Advanced Composer Blocks Addon</a>.
</p>

<?php
$fields->select('layout', __('Layout', 'newsletter'),
        [
            'one' => __('One column', 'newsletter'),
            'one-2' => __('One column variant', 'newsletter'),
            'two' => __('Two columns', 'newsletter'),
            'big-image' => __('One column, big image', 'newsletter'),
            'full-post' => __('Full post', 'newsletter')
        ]);
?>

<?php
$fields->block_style('', [
    'default' => __('Default', 'newsletter'),
    'inverted' => __('Inverted', 'newsletter'),
    'boxed' => __('Boxed', 'newsletter'),
])
?>

<div class="tnp-accordion">

    <?php if ($context['type'] == 'automated') { ?>
        <h3>Automated</h3>
        <div>
            <p>
                While composing all posts are shown while on sending posts are extrated following the rules below.
                <a href="https://www.thenewsletterplugin.com/documentation/addons/extended-features/automated-extension/#regeneration" target="_blank">Read more</a>.
            </p>
            <?php $fields->select('automated_disabled', '', ['' => 'Use the last newsletter date and...', '1' => 'Do not consider the last newsletter']) ?>

            <div class="tnp-field-row">
                <div class="tnp-field-col-2">
                    <?php
                    $fields->select('automated_include', __('If there are new posts', 'newsletter'),
                            [
                                'new' => __('Include only new posts', 'newsletter'),
                                'max' => __('Include specified max posts', 'newsletter')
                            ],
                            ['description' => '', 'class' => 'tnp-small'])
                    ?>
                </div>
                <div class="tnp-field-col-2">
                    <?php
                    $fields->select('automated', __('If there are not new posts', 'newsletter'),
                            [
                                '' => 'Show the message below',
                                '1' => 'Do not send the newsletter',
                                '2' => 'Remove this block'
                            ],
                            ['description' => '', 'class' => 'tnp-small'])
                    ?>
                    <?php $fields->text('automated_no_contents', null, ['placeholder' => 'No new posts message']) ?>
                </div>
            </div>
            <div style="clear: both"></div>

            <?php $fields->text('main_title', __('Title', 'newsletter')) ?>
            <?php $fields->font('main_title_font', false, ['family_default' => true, 'size_default' => true, 'weight_default' => true]) ?>
            <?php $fields->align('main_title_align') ?>
        </div>
    <?php } ?>




    <h3>Elements</h3>
    <div>

        <div class="tnp-field-row">
            <label class="tnp-row-label"><?php _e('Post info', 'newsletter') ?></label>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('show_date', __('Date', 'newsletter')) ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('show_author', __('Author', 'newsletter')) ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('show_image', __('Image', 'newsletter')) ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('image_crop', __('Image crop', 'newsletter')) ?>
            </div>
            <div style="clear: both"></div>
        </div>

        <div class="tnp-field-row">
            <div class="tnp-field-col-4">
                <?php $fields->number('excerpt_length', __('Excerpt length', 'newsletter'), array('min' => 0)); ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->select('excerpt_length_type', 'Count', ['' => __('Words', 'newsletter'), 'chars' => __('Chars', 'newsletter')]); ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('show_read_more_button', __('Button', 'newsletter')); ?>
            </div>
            <div class="tnp-field-col-4">

            </div>
            <div style="clear: both"></div>
        </div>
    </div>


    <h3>Filters</h3>
    <div>
        <div class="tnp-field-row">
            <div class="tnp-field-col-4">
                <?php $fields->select_number('max', __('Max posts', 'newsletter'), 1, 40); ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->select_number('post_offset', __('Posts offset', 'newsletter'), 0, 20); ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('private', __('Private', 'newsletter')) ?>
            </div>
            <div class="tnp-field-col-4">
                <?php $fields->yesno('reverse', __('Reverse', 'newsletter')) ?>
            </div>
            <div style="clear: both"></div>
        </div>

        <div class="tnp-field-row">
            <div class="tnp-field-col-2">
                <?php
                $fields->select('author', __('Author', 'newsletter'), $authors_options)
                ?>
            </div>
            <div class="tnp-field-col-2">
                <?php $fields->language('language', 'Language'); ?>
            </div>
            <div style="clear: both"></div>
        </div>

    </div>



    <h3>Categories and tags</h3>
    <div>
        <?php $fields->categories(); ?>
        <?php $fields->text('tags', __('Tags', 'newsletter'), ['description' => __('Comma separated')]); ?>
    </div>

    <h3>Texts and buttons</h3>
    <div>

        <?php $fields->font('title_font', __('Title font', 'newsletter'), ['family_default' => true, 'size_default' => true, 'weight_default' => true]) ?>
        <?php $fields->font('font', __('Excerpt font', 'newsletter'), ['family_default' => true, 'size_default' => true, 'weight_default' => true]) ?>
        <?php
        $fields->button('button', __('Read more button', 'newsletter'), [
            'url' => false,
            'family_default' => true,
            'size_default' => true,
            'weight_default' => true
        ])
        ?>
    </div>



    <h3>Commons</h3>
    <div>
        <?php $fields->padding('text_padding', 'Text padding', ['description' => 'Supported only by some layouts', 'show_top' => false, 'show_bottom' => false]) ?>
        <?php $fields->block_commons() ?>
    </div>
</div>