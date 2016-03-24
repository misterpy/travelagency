<?php
if ( !defined('ABSPATH') ) { exit; }


if (!is_admin()) { 
	add_action( 'wp_enqueue_scripts', 'df_testimonial_javascript' );
}

if ( !function_exists( 'df_testimonial_javascript' ) ) {

    function df_testimonial_javascript() {
        wp_enqueue_script( 'df-testimonial', trailingslashit( TESTIMONIAL_ASSETS ) . 'js/testimonial.min.js', array('jquery'), NULL);
    }

}// End dahztheme_add_javascript()