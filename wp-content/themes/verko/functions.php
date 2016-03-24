<?php
$dir_path = get_template_directory();

// DahzFramework Core Admin Initialization
require_once ( trailingslashit( $dir_path ) . 'dahz/admin-init.php' );

// Theme Initialization
require_once ( trailingslashit( $dir_path ) . 'includes/theme-init.php' );


/*-----------------------------------------------------------------------------------
* The best and safest way to extend Verko with your own custom functions is to create a child theme.
* You can add functions here but they will be lost on upgrade. If you use a child theme, you are safe!
*-----------------------------------------------------------------------------------*/
