<?php
/*
This example/starter plugin can be used to speed up Visual Composer plugins creation process.
More information can be found here: http://kb.wpbakery.com/index.php?title=Category:Visual_Composer

In this example all plugin related functions will have a "vc_extend" prefix, make sure to use unique prefix
in your plugin. Otherwise, you (or your users) may experience "Cannot redaclare function" error.
*/
/*
Override Template WPB VC - since version 4.0
*/
if(function_exists('vc_set_shortcodes_templates_dir')) {
	$temp_dir = plugin_dir_path( __FILE__ ) . '/vc-templates/';
	vc_set_shortcodes_templates_dir( $temp_dir );
}

add_action( 'wp_enqueue_scripts', 'vc_remove_style', 9999 );

function vc_remove_style() {
    wp_deregister_style( 'js_composer_front' );
}
/*
Display notice if Visual Composer is not installed or activated.
*/
if ( !defined('WPB_VC_VERSION') ) { add_action('admin_notices', 'df_vc_extend_notice'); return; }
function df_vc_extend_notice() {
  $plugin_data = get_plugin_data(__FILE__);
  $link_data = admin_url() . 'themes.php?page=install-required-plugins';
  echo '
  <div class="updated">
    <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="%s">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'dahztheme'), $plugin_data['Name'], $link_data ).'</p>
  </div>';
}

require_once dirname(__FILE__) . '/vc_mod-icon.php';
require_once dirname(__FILE__) . '/vc_mod-extend.php';
require_once dirname(__FILE__) . '/vc_mod-update.php';
require_once dirname(__FILE__) . '/vc_mod-remove.php';