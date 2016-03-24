<?php
/*
	Plugin Name: Dahz DF Shortcodes
	Plugin URL:  http://dahztheme.com/
	Description: Extensible shortcodes functionality for newtheme and plugins ( strongly required ).
	Version: 	 1.3.1
	Author: 	 Dahz
	Author URI:  http://dahztheme.com/
*/

// Define Constants
// =============================================================================

define( 'DF_SHORTCODES_URL',  plugins_url( '', __FILE__ ) );
define( 'DF_SHORTCODES_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'df_Shortcodes' ) ) :

	class df_Shortcodes {

		function df_Shortcodes() {
			add_action( 'wp_enqueue_scripts', array( &$this, 'df_shortcodes_enqueue_styles' ));
			add_action( 'wp_enqueue_scripts', array( &$this, 'df_shortcodes_enqueue_scripts' ));
			// add_action( 'admin_footer', array( &$this, 'df_shortcodes_enqueue_admin_scripts'));

			add_action( 'init', array( &$this, 'df_shortcodes_init' ) );
			add_action( 'init', array( &$this, 'df_shortcodes_init_button' ) );
	    }

	   	/*=============================
		  Front-end Scripts & Styles
		  ============================= */
		function df_shortcodes_enqueue_styles() {
			if( ! is_admin() ) :
				wp_register_style( 'df-shortcodes-style', DF_SHORTCODES_URL . '/assets/css/shortcodes.min.css', NULL, NULL);
				wp_enqueue_style( 'df-shortcodes-style' );
				wp_register_style( 'df_lineaicons', DF_SHORTCODES_URL . '/assets/css/linea-fi.min.css', NULL, NULL );
				wp_enqueue_style( 'df_lineaicons' );
				wp_register_style( 'df-vc-style', DF_SHORTCODES_URL . '/assets/css/vc_style.css', NULL, NULL);
				wp_enqueue_style( 'df-vc-style' );
			endif;
		}

		function df_shortcodes_enqueue_scripts() {
			if( ! is_admin() ) :
				wp_register_script( 'df-jquery-shortcodes', DF_SHORTCODES_URL . '/assets/js/jquery.shortcodes.js', array( 'jquery' ), NULL, true);
				wp_enqueue_script( 'df-jquery-shortcodes' );

				wp_register_script( 'df-shortcodes-main', DF_SHORTCODES_URL . '/assets/js/shortcodes.min.js', array( 'jquery' ), NULL, true);
				wp_enqueue_script( 'df-shortcodes-main' );
			endif;
		}

		/*=============================
		  Back-end Scripts & Styles
		  ============================= */
		function df_shortcodes_enqueue_admin_scripts() {
			if( is_admin() ) :
				// wp_register_style( 'df-shortcodes-icon-style', DF_SHORTCODES_URL . '/css/vc_extend_admin.css' );
				// wp_enqueue_style( 'df-shortcodes-icon-style' );
			endif;
		}

		function df_shortcodes_init() {
			foreach ( glob( DF_SHORTCODES_PATH . '/shortcodes/*.php' ) as $sc_outputs ) {
	            require_once $sc_outputs;
	        }
			require_once DF_SHORTCODES_PATH . '/vc-mod/vc_mod-setup.php' ;
		}

		/*=============================
		  Add Admin Shortcode Button
		  ============================= */


		function df_shortcodes_init_button() {
			global $pagenow;

			if ( (current_user_can('edit_posts') &&  current_user_can('edit_pages') ) && get_user_option( 'rich_editing' ) == 'true' && ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) ) {
				add_filter( 'mce_external_plugins', array( &$this, 'df_shortcodes_plugin' ) );
				add_filter( 'mce_buttons', 			array( &$this, 'df_shortcodes_register_button' ) );
				wp_enqueue_style( 'df-shortcodes-admin-style', DF_SHORTCODES_URL . '/assets/css/admin/shortcodes-admin-style.css' );
			}
		}

		function df_shortcodes_plugin( $plugin_array ) {
			$plugin_array['DahzThemeShortcodes'] = DF_SHORTCODES_URL .'/assets/js/admin/tiny-mce.js';

			return $plugin_array;
		}

		function df_shortcodes_register_button( $buttons ) {
			array_push( $buttons, 'DahzThemeShortcodes' );

			return $buttons;
		}
	}

endif;

$df_shortcodes = new df_Shortcodes(); // Start an instance of the plugin class