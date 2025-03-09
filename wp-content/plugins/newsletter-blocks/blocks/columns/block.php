<?php
/*
 * Name: Columns
 * Section: content
 * Description: Two or three columns
 *
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'responsive' => '1',
    'font_family' => '',
    'font_size' => '',
    'font_color' => '',
    'font_weight' => '',
    'crop' => '',
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'block_background' => ''
);

for ($i = 1; $i <= 4; $i++) {
    $defaults['image_' . $i] = '';
    $defaults['text_' . $i] = '';
    $defaults['url_' . $i] = '';
}

$options = array_merge($defaults, $options);

$block_style = $options['block_style'] ?? '';

switch ($block_style) {
    case 'inverted':

        $options['block_background'] = '#000';
        $options['block_background_wide'] = '1';
        $options['font_color'] = '#dddddd';
        $options['title_font_color'] = '#ffffff';

        break;

    case 'default':
        $options['block_background'] = '';
        $options['block_background_wide'] = '0';
        $options['font_color'] = '';
        $options['title_font_color'] = '';
        break;
}

// For Outlook
$count = 0;
for ($i = 1; $i <= 4; $i++) {
    if (empty($options['title_' . $i]) && empty($options['text_' . $i]) && empty($options['image_' . $i]['id'])) {
        continue;
    }
    $count++;
}

if (!$count) {
    echo 'No column set';
    return;
}

$grid_padding = 8;
$image_width = floor(($composer['content_width'] - $grid_padding * $count * 2) / $count);

$text_font = TNP_Composer::get_text_style($options, '', $composer, ['scale' => 0.9]);
$title_font = TNP_Composer::get_title_style($options, 'title', $composer, ['scale' => 0.8]);

$responsive = !empty($options['responsive']);
?>
<style>
    .text {
        <?php $text_font->echo_css() ?>
        text-decoration: none;
        margin-top: 15px;
        line-height: 1.3;
    }
    .title {
        <?php $title_font->echo_css() ?>
        text-decoration: none;
        margin-top: 15px;
        line-height: normal;
    }
    .link {
        text-decoration: none;
    }
</style>

<?php
$items = [];

for ($i = 1; $i <= 4; $i++) {
    if (empty($options['title_' . $i]) && $options['text_' . $i] && $options['image_' . $i]['id']) {
        continue;
    }

    $image = '';
    if (!empty($options['image_' . $i]['id'])) {
        switch ($options['crop']) {
            case '1':
                $size = [400, 300, true];
                break;
            case '2':
                $size = [320, 180, true];
                break;
            case '3':
                $size = [300, 300, true];
                break;
            default:
                $size = [300, 0, false];

        }
        $image = tnp_resize_2x($options['image_' . $i]['id'], $size);
        if ($image) {
            $image->set_width($image_width);
        }
    }

    ob_start();
    ?>

    <a href="<?php echo esc_attr($options['url_' . $i]); ?>" inline-class="link">

        <?php if (!empty($image)) { ?>
            <?php echo TNP_Composer::image($image) ?>
        <?php } ?>

        <?php if (!empty($options['title_' . $i])) { ?>
            <div inline-class="title"><?php echo $options['title_' . $i] ?></div>
        <?php } ?>

        <?php if (!empty($options['text_' . $i])) { ?>
            <div inline-class="text"><?php echo $options['text_' . $i] ?></div>
        <?php } ?>
    </a>

    <?php
    $items[] = ob_get_clean();
}

echo TNP_Composer::grid($items, ['columns' => $count, 'responsive' => $responsive, 'width' => $composer['content_width'], 'padding' => $grid_padding]);
