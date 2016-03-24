<?php
if (!defined('ABSPATH')) { exit; }

/* ===============================================================================
 * TABLE OF CONTENTS - INCLUDES/ADMIN/CUSTOMIZER/CUSTOMIZER-GENERAL-OUTPUT.PHP
 *
 * - Customizer General Options CSS Output
 *    1. Site Layout
 *    
  ================================================================================= */

// Customizer General Options CSS Output
// =============================================================================

$df_layout_site				= $df_options[ 'layout_site' ];
$df_site_max_width          = ( $df_options[ 'site_max_width' ] == '' ) ? '1200' : $df_options[ 'site_max_width' ];
?>

/*============================================================
  Site Layout
=============================================================*/
<?php $m_w = 100 - 2.5;  ?>
.df_container-fluid.fluid-max{
max-width:<?php echo round ( $df_site_max_width * ($m_w / 100) ) . 'px'; ?>;}

<?php if ($df_layout_site == 'boxed') : ?>
.df-boxed-layout-active .site,
.df-navibar.df_container-fluid.fluid-max,
.df-boxed-layout-active .df-topbar,
.df-boxed-layout-active .site-header{
max-width: <?php echo $df_site_max_width + 15 . 'px'; ?>;
}
.df-boxed-layout-active .df-topbar,
.df-boxed-layout-active .site-header{
	margin:0 auto;
}
<?php endif; ?>