<?php
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// INCLUDES/ADMIN/CUSTOMIZER/THEME-CUSTOMIZER-OUTPUT.PHP
// -----------------------------------------------------------------------------
// Sets up custom output from the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Generated CSS Output
//   02. User CSS Output
// =============================================================================

// 01. Generated CSS
// =============================================================================

function df_customizer_options_output_css(){
    ob_start();
    echo "\n".'<style type="text/css">';
        $df_options = get_option( 'df_options' );
        require_once CUSTOMIZER_OUTPUT_SETT_DIR . 'customizer-general-output.php';
        require_once CUSTOMIZER_OUTPUT_SETT_DIR . 'customizer-header-output.php';
        require_once CUSTOMIZER_OUTPUT_SETT_DIR . 'customizer-content-output.php';
        require_once CUSTOMIZER_OUTPUT_SETT_DIR . 'customizer-button-output.php';
        require_once CUSTOMIZER_OUTPUT_SETT_DIR . 'customizer-footer-output.php';
        require_once CUSTOMIZER_OUTPUT_SETT_DIR . 'customizer-misc-output.php';
    echo '</style>'. "\n";
    $css = ob_get_contents(); ob_end_clean();

    //
    // 1. Remove comments.
    // 2. Remove whitespace.
    // 3. Remove starting whitespace.
    //

    $output = preg_replace( '#/\*.*?\*/#s', '', $css );            // 1
    $output = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $output ); // 2
    $output = preg_replace( '/\s\s+(.*)/', '$1', $output );        // 3

    echo $output;
}

// 02. Custom CSS
// =============================================================================

function df_customizer_custom_css_output() {
    $df_options = get_option( 'df_options' );
    if ( $df_options['custom_styles'] ) : ?>
        <!-- Custom CSS -->
        <style type="text/css"><?php echo wp_strip_all_tags( $df_options['custom_styles'] ); ?></style>
        <?php
    endif;
}

if (!is_admin()) {
	add_action( 'wp_head', 'df_customizer_options_output_css', 9998, 0 );
    add_action( 'wp_head', 'df_customizer_custom_css_output', 9999, 0 );
}
