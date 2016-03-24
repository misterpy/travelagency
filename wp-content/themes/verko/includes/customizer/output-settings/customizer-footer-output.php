<?php 
if (!defined('ABSPATH')) { exit; }

/* ===============================================================================
 * TABLE OF CONTENTS - INCLUDES/ADMIN/CUSTOMIZER/CUSTOMIZER-FOOTER-OUTPUT.PHP
 *
 * - Customizer Footer Options CSS Output
 * 	   1. Primary Footer
 * 	   2. Copyright Footer
 *    
  ================================================================================= */

// 1. Primary Footer Variables
// bg image
$df_pf_bg_image				= $df_options[ 'primary_footer_image_bg' ];
$df_pf_bg_repeat			= $df_options[ 'primary_footer_background_pos' ] .' '. $df_options[ 'primary_footer_image_bg_repeat' ];
$df_pf_bg_size				= $df_options[ 'primary_footer_background_size' ];
$df_pf_bg_attch				= $df_options[ 'primary_footer_background_attachment' ];
// bg color
$df_pf_bg_color    			= $df_options[ 'primary_footer_bg_color' ];
$df_pf_bg_opacity  			= $df_options[ 'primary_footer_color_opa' ];
$df_pf_bg_rgba     			= df_convert_rgba( $df_pf_bg_color, $df_pf_bg_opacity );
// widget color
$df_pf_widget_title_color	= $df_options[ 'pf_widget_title_color' ];
$df_pf_widget_content_color	= $df_options[ 'pf_widget_content_color' ];

// 2. Copyright Footer Variables
// bg image
$df_cf_bg_image				= $df_options[ 'copyright_footer_image_bg' ];
$df_cf_bg_repeat			= $df_options[ 'copyright_footer_background_pos' ] .' '. $df_options[ 'copyright_footer_image_bg_repeat' ];
$df_cf_bg_size				= $df_options[ 'copyright_footer_background_size' ];
$df_cf_bg_attch				= $df_options[ 'copyright_footer_background_attachment' ];
// bg color
$df_cf_bg_color    			= $df_options[ 'copyright_footer_bg_color' ];
$df_cf_bg_opacity  			= $df_options[ 'copyright_footer_color_opa' ];
$df_cf_bg_rgba     			= df_convert_rgba( $df_cf_bg_color, $df_cf_bg_opacity );
// text color
$df_cf_text_color			= $df_options[ 'cf_text_color' ];
$df_cf_link_color			= $df_options[ 'cf_link_color' ];
$df_cf_link_color_hover		= df_convert_rgba( $df_options[ 'cf_link_color' ], 80);
?>

/*==========================================================================================
  Primary Footer
==========================================================================================*/
<?php if( $df_pf_bg_color != '' ) : ?>
	.footer-primary-widgets {
		background-color: <?php echo $df_pf_bg_rgba; ?>;
	}
<?php endif; ?>

<?php if( $df_pf_bg_image != '' ) : ?>
	.footer-widgets-wrapper {
		background: url(<?php echo $df_pf_bg_image; ?>) <?php echo $df_pf_bg_repeat; ?>;
		background-attachment: <?php echo $df_pf_bg_attch; ?>;
		background-size: <?php echo $df_pf_bg_size; ?>;
	}
	@media only screen and (max-width: 1024px) {
		.footer-widgets-wrapper {
			background-attachment: scroll;
		}
	}
<?php endif; ?>

<?php if( $df_pf_widget_title_color != '' ) : ?>
	.footer-primary-widgets .widget h3, .footer-primary-widgets .widget caption {
		color: <?php echo $df_pf_widget_title_color ?>;
	}
<?php endif; ?>

<?php if( $df_pf_widget_content_color != '' ) : ?>
	.footer-primary-widgets, .footer-primary-widgets .widget h4 {
		color: <?php echo $df_pf_widget_content_color ?>;
	}
<?php endif; ?>

/*==========================================================================================
  Copyright Footer
==========================================================================================*/
<?php if( $df_cf_bg_color != '' ) : ?>
	.df-footer {
		background-color: <?php echo $df_cf_bg_rgba; ?>;
	}
<?php endif; ?>

<?php if( $df_cf_bg_image != '' ) : ?>
	.df-wrapper-footer {
		background: url(<?php echo $df_cf_bg_image; ?>) <?php echo $df_cf_bg_repeat; ?>;
		background-attachment: <?php echo $df_cf_bg_attch; ?>;
		background-size: <?php echo $df_cf_bg_size; ?>;
	}
	@media only screen and (max-width: 768px) {
		.df-wrapper-footer {
			background-attachment: scroll;
		}
	}
<?php endif; ?>

<?php if( $df_cf_text_color != '' ) : ?>
	.df-footer p {
		color: <?php echo $df_cf_text_color; ?>;
	}
<?php endif; ?>

<?php if( $df_cf_link_color != '' ) : ?>
	.df-footer a {
		color: <?php echo $df_cf_link_color; ?>;
	}
	.df-footer a:hover {
		color: <?php echo $df_cf_link_color_hover; ?>;
	}
<?php endif; ?>