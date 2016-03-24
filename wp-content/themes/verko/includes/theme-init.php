<?php

if (!defined('ABSPATH')) {
 exit;
}

// Tier 0
if( !defined('INC_DIR') )  define('INC_DIR', trailingslashit(trailingslashit(THEME_DIR) . 'includes'));
if( !defined('INC_URI') )  define('INC_URI', trailingslashit(trailingslashit(THEME_URI) . 'includes'));
// Tier 1
define('ADMIN_DIR', trailingslashit(trailingslashit(INC_DIR) . 'admin'));
define('ADMIN_URI', trailingslashit(trailingslashit(INC_URI) . 'admin'));
define('ASSETS_DIR', trailingslashit(trailingslashit(INC_DIR) . 'assets'));
define('ASSETS_URI', trailingslashit(trailingslashit(INC_URI) . 'assets'));
define('CUSTOMIZER_DIR', trailingslashit(trailingslashit(INC_DIR) . 'customizer'));
// Tier 2
define('CUSTOMIZER_OPTION_SETT_DIR', trailingslashit(trailingslashit(CUSTOMIZER_DIR) . 'option-settings'));
define('CUSTOMIZER_OUTPUT_SETT_DIR', trailingslashit(trailingslashit(CUSTOMIZER_DIR) . 'output-settings'));
define('ENQUEUE_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'enqueue'));
define('CLASSES_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'classes'));
define('FUNCTIONS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'functions'));
define('EXTENSIONS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'extensions'));
define('EXTENSIONS_URI', trailingslashit(trailingslashit(ADMIN_URI) . 'extensions'));

/* ----------------------------------------------------------------------------------- */
/* Load the theme-specific files.													   */
/* ----------------------------------------------------------------------------------- */

require_once CUSTOMIZER_DIR . 'theme-customizer.php'; // Custom panel settings and custom settings theme customizer
require_once CUSTOMIZER_DIR . 'theme-customizer-options.php'; // Custom Settings and Controls theme customizer
require_once CUSTOMIZER_DIR . 'theme-customizer-output.php'; // Render css options
require_once ADMIN_DIR . 'theme-setup.php'; // General Setup
require_once ADMIN_DIR . 'theme-actions.php'; // Theme actions & user defined hooks
require_once ADMIN_DIR . 'theme-comments.php'; // Custom comments/pingback loop
require_once ADMIN_DIR . 'theme-enqueue.php'; // Load Stylesheet & JavaScript via wp_enqueue_script
require_once ADMIN_DIR . 'theme-extensions.php'; // Load all various of plugin integrations
require_once ADMIN_DIR . 'theme-sidebar.php'; // Initialize widgetized areas
require_once ADMIN_DIR . 'theme-widgets.php'; // Theme widgets

/* ----------------------------------------------------------------------------------- */
/* Load the part of modules files.                                                     */
/* ----------------------------------------------------------------------------------- */
require_once INC_DIR . 'modules/part-header.php' ;
require_once INC_DIR . 'modules/part-layout.php';
require_once INC_DIR . 'modules/part-footer.php' ;
