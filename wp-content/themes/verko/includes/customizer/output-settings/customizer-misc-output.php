<?php
if (!defined('ABSPATH')) { exit; }

/* ===============================================================================
 * TABLE OF CONTENTS - INCLUDES/ADMIN/CUSTOMIZER/CUSTOMIZER-MISC-OUTPUT.PHP
 *
 * - Customizer Misc Options CSS Output
 * 	   1. 404 page
 *    
  ================================================================================= */

// Customizer Misc Options CSS Output
// ============================================================================= 

// 404 Background
// bg color
$df_404_bg_color              = $df_options[ '404_color_bg' ];
$df_404_bg_opacity         	  = $df_options[ '404_color_opa' ];
$df_404_bg_rgba            	  = df_convert_rgba( $df_404_bg_color, $df_404_bg_opacity );
// bg image
$df_404_bg_image          	  = $df_options[ '404_image_bg' ];
$df_404_bg_att                = $df_options[ '404_background_attachment' ];
$df_404_bg_size               = $df_options[ '404_background_size' ];
$df_404_bg_repeat_options     = $df_options[ '404_background_pos' ] .' '. $df_options['404_image_bg_repeat'];

$df_content_bg_color 		  = $df_options[ 'content_area_bg_color' ];
$df_content_opa_color 		  = $df_options[ 'content_area_color_opa' ];
$df_content_bg_rgba     	  = ( $df_content_bg_color != '' ) ? df_convert_rgba( $df_content_bg_color, $df_content_opa_color ) : '';

// page loader
$page_loader 				  = $df_options['df_enable_page_loader'];
$page_loader_bg_color 		  = $df_options['df_page_loader_background'];

?>

/*==========================================================================================
  404 Page
==========================================================================================*/
<?php if( is_404() ) : ?>

	<?php if( $df_404_bg_image != '' ) : ?>
		body.error404 {
			background: url(<?php echo $df_404_bg_image; ?>) <?php echo $df_404_bg_repeat_options; ?>; 
			background-attachment: <?php echo $df_404_bg_att; ?>;
			background-size: <?php echo $df_404_bg_size; ?>;
		}
	<?php endif; ?>

	<?php if( $df_404_bg_color != '' ) : ?>
		body.error404 .site{
			height:100%;
			background-color: <?php echo $df_404_bg_rgba; ?>;
		}
		body.error404.df-boxed-layout-active .site {
			max-width: 100%;
		}
	<?php endif; ?>

	<?php if( $df_content_bg_color != '' ) : ?>
		.error-404 .content-404 {
			background: <?php echo $df_content_bg_rgba ?>;
		}
	<?php endif; ?>
	
<?php endif; ?>

/*==========================================================================================
  Page Loader
==========================================================================================*/
<?php if( $page_loader ) : ?>
	.ajax_loader {
		background-color: <?php echo $page_loader_bg_color; ?>;
	}
<?php endif; ?>
