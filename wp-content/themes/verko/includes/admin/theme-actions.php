<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * ===============================================================================
 * TABLE OF CONTENTS - INCLUDES/ADMIN/THEME-ACTIONS.PHP
 *
 * - tmp
 * - ctnt
 * ================================================================================= 
 */

/* ----------------------------------------------------------------------------------- */
/* Load all files in function folder.                                                  */
/* ----------------------------------------------------------------------------------- */
// tmp
require_once FUNCTIONS_DIR . 'templates/template-post.php';
require_once FUNCTIONS_DIR . 'templates/template-media.php';
require_once FUNCTIONS_DIR . 'templates/template-tags.php';
// ctnt
require_once FUNCTIONS_DIR . 'contents/content-classes.php';
require_once FUNCTIONS_DIR . 'contents/content-blog.php';
require_once FUNCTIONS_DIR . 'contents/content-formats.php';
require_once FUNCTIONS_DIR . 'contents/content-image.php';

require_once FUNCTIONS_DIR . 'utilities.php';
require_once FUNCTIONS_DIR . 'paginations.php';
require_once FUNCTIONS_DIR . 'custom-attribute.php';
require_once FUNCTIONS_DIR . 'page-loader-function.php';
require_once FUNCTIONS_DIR . 'df-like.class.php';

require_once FUNCTIONS_DIR . 'title-controller.php';
require_once FUNCTIONS_DIR . 'navbar-menu.php';