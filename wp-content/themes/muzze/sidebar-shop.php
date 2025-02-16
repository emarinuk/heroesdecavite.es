<?php
$sidebar = apply_filters( 'muzze_theme_sidebar_woo', '' );
if ($sidebar == 'layout_1c' || $sidebar == ''){
    return;
}

$woo_detail_layout = get_theme_mod( 'woo_detail_layout', 'layout_1c' );
if ($woo_detail_layout == 'layout_1c' && is_single() ){
	return;
}
?>

<?php if(is_active_sidebar('woo-sidebar')){ ?>
        <aside id="woo-sidebar" class="sidebar woo-sidebar">
            <?php  dynamic_sidebar('woo-sidebar'); ?>
        </aside>
<?php } ?>