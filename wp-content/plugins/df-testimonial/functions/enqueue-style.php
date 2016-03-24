<?php
if ( !defined('ABSPATH') ) { exit; }

if (!is_admin()) {
    add_action('wp_enqueue_scripts', 'df_testimonial_frontend_css', 25);
}

if (!function_exists('df_testimonial_frontend_css')) {
    
    function df_testimonial_frontend_css() {
        wp_register_style( 'df-testimonial', trailingslashit( TESTIMONIAL_ASSETS ) . 'css/testimonial.css', NULL, NULL );
        wp_enqueue_style( 'df-testimonial' );
    }

}