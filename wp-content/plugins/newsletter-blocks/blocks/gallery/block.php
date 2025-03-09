<?php

/*
 * Name: Gallery
 * Section: content
 * Description: Extract an embed all the media from a post gallery
 *
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'layout' => 2,
    'url' => home_url(),
    'responsive' => 1,
    'columns' => 3,
    'crop' => '',
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
    'block_background' => ''
);

for ($i = 1; $i <= 12; $i++) {
    $defaults['image_' . $i . '_alt'] = 'Image';
    $defaults['url_' . $i] = '';
}

$options = array_merge($defaults, $options);

$grid_padding = 10;
$columns = (int) $options['columns'];
// Thank you Outlook!
$image_width = ($composer['content_width'] - 2 * $grid_padding * $columns) / $columns;

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
    case '4':
        $size = [300, 400, true];
        break;
    default:
        $size = [300, 0, false];
}

$items = [];
for ($i = 1; $i <= 12; $i++) {
    if (empty($options['image_' . $i]['id'])) {
        continue;
    }

    $media = tnp_resize($options['image_' . $i]['id'], $size);
    if (!$media) {
        continue;
    }
    $media->set_width($image_width);
    $media->alt = $options['image_' . $i . '_alt'];
    $media->link = !empty($options['url_' . $i]) ? $options['url_' . $i] : $options['url'];

    $items[] = TNP_Composer::image($media);
}

if ($items) {

    echo TNP_Composer::grid($items, ['columns' => $columns, 'width' => $composer['content_width'], 'responsive' => !empty($options['responsive']),
        'padding' => $grid_padding]);
} else {
    echo '<p>Add some images to your gallery</p>';
}
