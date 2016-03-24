<?php

/**
  * Owl Carousel
  *
  * @example
**/

function df_slider_sc($atts, $content = null){

    extract(shortcode_atts(array(
        'items' => '3', /*1,2,3...6*/
        'auto_play' => false, /*true / false*/
        'pagination' => false /*true / false*/
    ), $atts));

    ob_start();

wp_enqueue_style('owl-carousel');

    $id = 'df-slider-'.rand(0,200);


    $df_slider = '<div class="df-container-slider-sc">
                    <div id="'.$id.'"
                    class="owl-carousel df-slider-shortcode"
                    data-df-items="'.$items.'"
                    data-df-auto-play="'.$auto_play.'"
                    data-df-pagination="'.$pagination.'"
                >'. do_shortcode($content). '</div></div>';
    echo $df_slider;

    return ob_get_clean();
}
add_shortcode('df_slider', 'df_slider_sc');

/*-----------------------------------------------------------------------------------*/

function df_slider_item_sc( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));

    $out = '<div>' . do_shortcode($content) . '</div>';
    return $out;
}
add_shortcode( 'df_slider_item', 'df_slider_item_sc' );



