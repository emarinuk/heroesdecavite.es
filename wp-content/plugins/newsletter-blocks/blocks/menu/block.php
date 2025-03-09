<?php
/*
 * Name: Menu
 * Section: content
 * Description: Call to action buttons
 */

$defaults = [
    'block_background' => '',
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
];

$options = array_merge($defaults, $options);

$max = 5;

$font = TNP_Composer::get_text_style($options, 'text', $composer);
?>
<style>
    .link {
        <?php $font->echo_css(); ?>
        line-height: normal;
        text-decoration: none;
    }
</style>

<table cellpadding="15" cellspacing="0" border="0" width="100%" role="presentation">
    <tr>
        <?php for ($i = 1; $i <= $max; $i++) { ?>
            <?php
            if (empty($options['label_' . $i])) {
                continue;
            }
            ?>
            <td align="center" valign="middle">
                <a inline-class="link" class="fs-90" href="<?php echo esc_attr($options['url_' . $i]); ?>"><?php echo esc_attr($options['label_' . $i]); ?></a>
            </td>
        <?php } ?>
    </tr>
</table>
