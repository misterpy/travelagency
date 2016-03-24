<?php

function df_table_sc( $atts, $content = null ) {
    extract( shortcode_atts( array(
    ), $atts ) );

    $out = '<div class="table-responsive"><table>'.do_shortcode($content).'</table></div>';

    return $out;
}
add_shortcode( 'df_table', 'df_table_sc' );

/*-----------------------------------------------------------------------------------*/
function df_table_tr_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(     
    ), $atts));

    $out = '<tr>' . do_shortcode($content) . '</tr>';

    return $out;
}
add_shortcode( 'df_table_tr', 'df_table_tr_sc' );

/*-----------------------------------------------------------------------------------*/
function df_table_td_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));

    $out = '<td> '. do_shortcode($content) . '</td>';
    
    return $out;
}
add_shortcode( 'df_table_td', 'df_table_td_sc' );