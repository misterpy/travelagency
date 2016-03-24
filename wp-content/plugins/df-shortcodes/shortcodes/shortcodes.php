<?php
/**
 * Table Of Content :
 *   1. Blockquote
 *   2. Columns
 *   3. Dropcap
 *   4. Font Awesome
 *   5. Hex To RGBA
 *   6. Highlight
 *   7. Icon List Item
 *   8. Row Columns
 *   9. Tool tip
 */

/*-----------------------------------------------------------------------------------*/
/* 1. Blockquote                                                                     */
/*-----------------------------------------------------------------------------------*/
function df_blockquote_sty ( $atts, $content = null ) {
    $defaults = array(
        'border_size' => '4px',
        'color'       => '#000',
        'ver'         => '1'
    );

    extract( shortcode_atts( $defaults, $atts ) );

    if ($ver == '2') {

        return '<blockquote class="blk2" style="border-left:' . $border_size . ' solid ' . $color . ';">' . do_shortcode($content) . '</blockquote> ';

    } else {

        return '<blockquote class="blk">' . do_shortcode($content) . '</blockquote> ';

    }
}
add_shortcode( 'df_blockquote', 'df_blockquote_sty' );

/*-----------------------------------------------------------------------------------*/
/* 2. Columns                                                                        */
/*-----------------------------------------------------------------------------------*/
function df_columns_sc( $atts, $content = null, $tag ) {
    $last = $type = '';

    extract( shortcode_atts(  array(
        'type'      => '', // type your column e.g boxed
        'bg_color'  => '#999',
        'color'     => '#fff',
        'class'     => '' // extra classes
    ), $atts ) );

    if ( $class != '' ) {
        $class = ' ' . $class;
    }


    // check the shortcode tag to add a "last" class
    if ( strpos( $tag, '_last' ) !== false ) {
        $tag = str_replace( '_last', ' last', $tag);
    }

    if ( $type == 'boxed' ) :
        $html = '<div class="' . $tag . $last . $class . '"><div class="boxed" style="background-color: ' . $bg_color . '; color: ' . $color . ';">' . do_shortcode( $content ) . '</div></div>';
    else :
        $html = '<div class="' . $tag . $last . $class . '">' . do_shortcode( $content ) . '</div>';
    endif;

    return apply_filters( 'df_columns_html', $html );
}

$columns = array(
    'twocol_one', // 1/2
    'twocol_one_last',
    'threecol_one', // 1/3
    'threecol_one_last',
    'fourcol_one', // 1/4
    'fourcol_one_last',
    'fivecol_one', // 1/5
    'fivecol_one_last'
);

foreach( $columns as $column ) {
    add_shortcode( $column, 'df_columns_sc' );
}

/*-----------------------------------------------------------------------------------*/
/* 3. Dropcap                                                                        */
/*-----------------------------------------------------------------------------------*/
function df_dropcap_sc ( $atts, $content = null ) {
    $defaults = array(
        'background_color'  => '',
        'color'             => '',
        'size'              => '700'
    );

    extract( shortcode_atts( $defaults, $atts ) );

    $html = '';

    if ( $background_color != '' ) {

        $html .= '<span class="dropcap" style="color:' . $color . '; background-color:' . $background_color . '; padding:10px 15px; font-weight:' . $size . ' ">' . do_shortcode($content) . '</span><!--/.dropcap-->';

    } elseif ( $background_color == '' ) {

        $html .= '<span class="dropcap" style="color:' . $color . '; font-weight:' . $size . '">' . do_shortcode($content) . '</span><!--/.dropcap-->';

    }

    return apply_filters( 'df_dropcap_html', $html );
}
add_shortcode( 'df_dropcap', 'df_dropcap_sc' );

/*-----------------------------------------------------------------------------------*/
/* 4. Font Awesome                                                                   */
/*-----------------------------------------------------------------------------------*/
function df_fontawesome_sc($atts) {
    extract(shortcode_atts(array(
        'type'      => '',
        'size'      => '',
        'rotate'    => '',
        'flip'      => '',
        'pull'      => '',
        'animated'  => ''
    ), $atts));

    $type       = ($type) ? 'fa-'.$type. '' : '';
    $size       = ($size) ? 'fa-'.$size. '' : '';
    $rotate     = ($rotate) ? 'fa-rotate-'.$rotate. '' : '';
    $flip       = ($flip) ? 'fa-flip-'.$flip. '' : '';
    $pull       = ($pull) ? 'pull-'.$pull. '' : '';
    $animated   = ($animated) ? 'fa-'.$animated.'' : '';

    $html       = '<i class="fa '.sanitize_html_class($type).' '.sanitize_html_class($size).' '.sanitize_html_class($rotate).' '.sanitize_html_class($flip).' '.sanitize_html_class($pull).' '.sanitize_html_class($animated).'"></i>';

    return apply_filters( 'df_fontawesome_html', $html );
}

add_shortcode('icon', 'df_fontawesome_sc');

/*-----------------------------------------------------------------------------------*/
/* 5. Hex To RGBA                                                                    */
/*-----------------------------------------------------------------------------------*/
if( ! class_exists( 'Ultimate_VC_Addons' ) ) :

    if( ! function_exists( 'ultimate_hex2rgb' ) ) :

        function ultimate_hex2rgb( $hex, $opacity = 1 ) {
            $hex = str_replace( '#' , '', $hex);

            if( strlen($hex) == 3 ) {
                $r = hexdec(substr($hex,0,1).substr($hex,0,1));
                $g = hexdec(substr($hex,1,1).substr($hex,1,1));
                $b = hexdec(substr($hex,2,1).substr($hex,2,1));
            } else {
                $r = hexdec(substr($hex,0,2));
                $g = hexdec(substr($hex,2,2));
                $b = hexdec(substr($hex,4,2));
            }

            $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

            return $rgba; // returns an array with the rgb values
        }

    endif;

endif;

/*-----------------------------------------------------------------------------------*/
/* 6. Highlight                                                                      */
/*-----------------------------------------------------------------------------------*/
function df_highlight_sty ( $atts, $content = null ) {
    $defaults = array(
        'background' => '',
        'color'      => ''
    );

    extract( shortcode_atts( $defaults, $atts ) );

    return '<span class="shortcode-highlight" style="background-color:' . $background . '; color:' . $color . ';">' .do_shortcode($content) . '</span><!--/.shortcode-highlight-->';

} // End df_shortcode_highlight()

add_shortcode( 'df_highlight', 'df_highlight_sty' );

/*-----------------------------------------------------------------------------------*/
/* 7. Icon List Item                                                                 */
/*-----------------------------------------------------------------------------------*/
function df_list_style_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'border'        => '',
        'border_style'  => '',
        'border_color'  => ''
    ), $atts));

    $out = '<ul class="style-list" style="border:' . $border . ' ' . $border_style . ' ' . $border_color . ';">'. do_shortcode($content) . '</ul>';

    return $out;
}
add_shortcode( 'df_list', 'df_list_style_sc' );

function df_item_list_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'icon'  => 'fa-check',
    ), $atts));

    $out = '<li><i class="fa '.$icon.'"></i>'. do_shortcode($content) . '</li>';

    return $out;
}
add_shortcode( 'df_list_item', 'df_item_list_sc' );

/*-----------------------------------------------------------------------------------*/
/* 8. Row                                                                            */
/*-----------------------------------------------------------------------------------*/
function df_row_sc_columns ( $atts, $content = null ) {
    $out = '<div class="df_row-fluid">' . do_shortcode($content) . '</div>';

    return $out;
}
add_shortcode( 'df_row', 'df_row_sc_columns' );

/*-----------------------------------------------------------------------------------*/
/* 9. Tool tip                                                                       */
/*-----------------------------------------------------------------------------------*/
function df_tooltip_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '',
        'tooltip'   => '',
        'target'    => '_self',
        'color'     => '',
        'bg_color'  => ''
    ), $atts));

    wp_enqueue_script( 'jquery-ui-tooltip' );

    echo '<style>
            .ui-tooltip{ color: ' . $color . '; background: ' . $bg_color . '; }
            .ui-tooltip:before{ border-bottom: 5px solid ' . $bg_color . '; }
          </style>';

    $out = '<a class="tltp" href="' . $link . '" target="' . $target . '" title="' . $tooltip . '" >' . do_shortcode($content) . '</a>';

    return $out;
}
add_shortcode( 'df_tooltip', 'df_tooltip_sc' );