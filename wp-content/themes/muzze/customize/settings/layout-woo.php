<?php
$cssCode = '';
$width_sidebar   = '';
$layout  = 'layout_1c';


$layout_sidebar = apply_filters( 'muzze_get_layout_woo', '' );
$layout = is_array( $layout_sidebar ) ? $layout_sidebar[0] : 'layout_1c';
$width_sidebar = is_array( $layout_sidebar ) ? $layout_sidebar[1] : '';



$width_site = apply_filters( 'muzze_width_site', '' );
$boxed_container_width = get_theme_mod( 'global_boxed_container_width', '1170' );
$global_boxed_offset = get_theme_mod( 'global_boxed_offset', '20' );


$woo_detail_layout = get_theme_mod( 'woo_detail_layout', 'layout_1c' );

if ($width_sidebar && 'layout_1c' != $layout){
    $cssCode .= <<<CSS
   

    #woo-sidebar{
        flex: 0 0 {$width_sidebar}px;
        max-width: {$width_sidebar}px;
        padding: 0;
    }
    
    #main-content-woo{
        flex: 0 0 calc(100% - {$width_sidebar}px);
        max-width: calc(100% - {$width_sidebar}px);
        padding-right: 60px;
        padding-left: 0;
    }


    @media(max-width: 1024px){
        #woo-sidebar, #main-content-woo{
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0;
        }
        
    }

CSS;
}

if( $layout == 'layout_2l' ){
    $cssCode .= <<<CSS

   
        .wrap_site{
            flex-direction: row-reverse;
        }
        #main-content-woo{
            padding-left: 60px;
            padding-right: 0;
        }
        
    
    @media(max-width: 1024px){
        #main-content-woo{
            padding-left: 30px;
            padding-right: 0;
        }
    }

CSS;
}

if( $width_site == 'boxed' ){
    $cssCode .= <<<CSS
.ova-wrapp{
    max-width: {$boxed_container_width}px;
    margin: 0 auto;
    background-color: #fff;
    padding: {$global_boxed_offset}px;
}
.wrap_site{
    padding: 0;
}

CSS;

}



// Detail
if( $woo_detail_layout != 'layout_1c' ){
    $cssCode .= <<<CSS

    #woo-sidebar{
        flex: 0 0 {$width_sidebar}px;
        max-width: {$width_sidebar}px;
        padding: 0;
    }

    #main-content-woo-single{
        flex: 0 0 calc(100% - {$width_sidebar}px);
        max-width: calc(100% - {$width_sidebar}px);
        padding-right: 60px;
        padding-left: 0;
    }

    @media(max-width: 1024px){
    .single #woo-sidebar, #main-content-woo-single{
            flex: 0 0 100%;
            max-width: 100%;
        }
        
    }

CSS;

}

if( $woo_detail_layout == 'layout_2l' ){
    $cssCode .= <<<CSS

   
    .single .wrap_site{
        flex-direction: row-reverse;
    }
    #main-content-woo-single{
        padding-left: 60px;
        padding-right: 0;
    }
        
   
    @media(max-width: 1024px){
        #main-content-woo-single{
            padding-left: 30px;
            padding-right: 0;
        }
    }

CSS;
}

return $cssCode;
