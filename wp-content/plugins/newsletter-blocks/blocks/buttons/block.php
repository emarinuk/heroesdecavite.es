<?php

/*
 * Name: Buttons
 * Section: content
 * Description: Call to action buttons
 */


$defaults = [
    'block_background' => '',
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
    'button_width' => '180',
    'block_style' => '',
];

for ($i = 1; $i <= 3; $i++) {
    $defaults["button${i}_label"] = "Button $i";
    $defaults["button${i}_url"] = home_url();

    $defaults["button${i}_background"] = "";

    $defaults["button${i}_font_family"] = "";
    $defaults["button${i}_font_size"] = "";
    $defaults["button${i}_font_weight"] = "";
    $defaults["button${i}_font_color"] = "";
    $defaults["list${i}"] = "";
    $defaults["unlist${i}"] = "";
}

$options = array_merge($defaults, $options);

$block_style = $options['block_style'] ?? '';

switch ($block_style) {
    case 'wire':
        for ($i = 1; $i <= 3; $i++) {
            $options['button' . $i . '_background'] = $composer['block_background'];
            $options['button' . $i . '_border_color'] = $composer['button_background_color'];
            $options['button' . $i . '_font_color'] = '#000000';
        }
        break;

    case 'default':
        for ($i = 1; $i <= 3; $i++) {
            $options['button' . $i . '_background'] = '';
            $options['button' . $i . '_border_color'] = '';
            $options['button' . $i . '_font_color'] = '';
        }
        break;
}

$button_options = $options; // Because we need to change the URL

$items = [];

for ($i = 1; $i <= 3; $i++) {

    if (empty($button_options["button${i}_label"])) {
        continue;
    }

    $button_options["button${i}_width"] = $options['button_width'];

    if (method_exists('NewsletterReports', 'build_lists_change_url')) {
        $lists = [];
        if (!empty($button_options['list' . $i])) {
            $lists[$button_options['list' . $i]] = 1;
        }
        if (!empty($button_options['unlist' . $i])) {
            $lists[$button_options['unlist' . $i]] = 0;
        }
        if ($lists) {
            $button_options["button${i}_url"] = NewsletterReports::build_lists_change_url($button_options["button${i}_url"], $lists);
        }
    }

     $items[] = TNP_Composer::button($button_options, 'button' . $i, $composer);
}

echo TNP_Composer::grid($items, ['width' => $composer['content_width'], 'columns' => count($items)]);

