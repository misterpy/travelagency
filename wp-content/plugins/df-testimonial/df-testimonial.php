<?php
/*
	Plugin Name: Dahz DF Testimonials
	Plugin URL:  http://dahztheme.com/
	Description: Simple way to manage and display testimonials, reviews or quotes on your site. Customizable elements with list and slider display.
	Version: 	 1.0.0
	Author: 	 Dahz
	Author URI:  http://dahztheme.com/
*/

if ( ! defined( 'ABSPATH' ) ) {	exit; } // Exit if accessed directly


if ( ! class_exists( 'df_Testimonial' ) ) :
	final class df_Testimonial {
		private $dir;
		private $assets_dir;
		private $assets_url;
		private $token;
		private $post_type;
		private $file;

		public $singular_name;
		public $plural_name;
		public $taxonomy_category;
		public $template_url;
		public $admin;
		public $frontend;

		/**
		 * @var string
		 */
		public $version = '1.0.0';

		private static $instance = null;

		public function __construct( $file ) {
			$this->dir 			= dirname( $file );
			$this->file 		= $file;
			$this->assets_dir 	= trailingslashit( $this->dir ) . 'assets';
			$this->assets_url 	= esc_url( trailingslashit( plugins_url( '/assets/', $file ) ) );
			$this->token 		= 'testimonials';
			$this->post_type 	= 'testimonial';

			// Variables
			$this->template_url	= apply_filters( 'testimonial_template_url', 'testimonial/' );

			$this->load_plugin_textdomain();
			add_action( 'init', array( $this, 'load_localization' ), 0 );

			// Define constants
			$this->define_constants();

			// Include required files
			$this->includes();

			// Run this on activation.
			register_activation_hook( $this->file, array( $this, 'activation' ) );

			// Run this on deactivation.
			register_deactivation_hook( $this->file, array( $this, 'deactivation' ) );

			add_action( 'init', array( $this, 'post_type_names' ) );
			add_action( 'init', array( $this, 'register_rewrite_tags' ) );
			add_action( 'init', array( $this, 'register_post_type' ) );
			add_action( 'init', array( $this, 'register_taxonomy' ) );

			if ( is_admin() ) {
				require_once( 'classes/class-testimonial-admin.php' );
		 		$this->admin 	= new Testimonial_Admin( $file );
			}
		}

		/**
		 * @since 1.0.0
		 * @return Dahz Testimonial - Main Instance
		 */
		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Register custom rewrite tags.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function register_rewrite_tags () {
			add_rewrite_tag( '%testimonial_category%','([^&]+)' );
		} // End register_rewrite_tags()

		/**
		 * Define Plugins Constants
		 */
		private function define_constants() {
			define( 'TESTIMONIAL_PLUGIN_FILE', __FILE__ );
			define( 'TESTIMONIAL_VERSION', $this->version );
			define( 'TESTIMONIAL_ASSETS', plugin_dir_url( __FILE__ ) . 'assets' );

		}

		/**
		 * UI names in the admin
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function post_type_names () {
			$this->singular_name 	= apply_filters( 'testimonial_post_type_singular_name', _x( 'Testimonial', 'post type singular name', 'dahztheme' ) );
			$this->plural_name 		= apply_filters( 'testimonial_post_type_plural_name', _x( 'Testimonials', 'post type general name', 'dahztheme' ) );
		}

		/**
		 * Register the post type.
		 *
		 * @access public
		 * @return void
		 */
		public function register_post_type () {
			$labels = array(
				'name' 					=> $this->plural_name,
				'singular_name' 		=> $this->singular_name,
				'add_new' 				=> _x( 'Add New', $this->post_type, 'dahztheme' ),
				'add_new_item' 			=> sprintf( __( 'Add New %s', 'dahztheme' ), $this->singular_name ),
				'edit_item' 			=> sprintf( __( 'Edit %s', 'dahztheme' ), $this->singular_name ),
				'new_item' 				=> sprintf( __( 'New %s', 'dahztheme' ), $this->singular_name ),
				'all_items' 			=> sprintf( _x( 'All %s', $this->post_type, 'dahztheme' ), $this->plural_name ),
				'view_item' 			=> sprintf( __( 'View %s', 'dahztheme' ), $this->singular_name ),
				'search_items' 			=> sprintf( __( 'Search %a', 'dahztheme' ), $this->plural_name ),
				'not_found' 			=> sprintf( __( 'No %s Found', 'dahztheme' ), $this->plural_name ),
				'not_found_in_trash' 	=> sprintf( __( 'No %s Found In Trash', 'dahztheme' ), $this->plural_name ),
				'parent_item_colon' 	=> '',
				'menu_name' 			=> $this->plural_name

			);

			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search'	=> true,
				'show_ui' 				=> true,
				'show_in_menu' 			=> true,
				'query_var' 			=> true,
				'rewrite' 				=> array(
												'slug' 		 => trailingslashit ( 'testimonial' ) . '%testimonial_category%',
												'with_front' => false
										   ),
				'capability_type' 		=> 'post',
				'has_archive'			=> false,
				'hierarchical' 			=> false,
				'supports' 				=> array(
												'title',
												'editor',
												'thumbnail'
										   ),
				'menu_icon' 			=> 'dashicons-admin-comments'
			);

			$args = apply_filters( 'testimonial_register_post_type', $args );

			register_post_type( $this->post_type, (array) $args );
		} // End register_post_type()

		/**
		 * Register the "testimonial-category" taxonomy.
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function register_taxonomy () {
			$this->taxonomy_category = new Testimonial_Taxonomy(); // Leave arguments empty, to use the default arguments.
			$this->taxonomy_category->register();
		} // End register_taxonomy()

		/**
		 * Load the plugin's localization file.
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function load_localization () {
			load_plugin_textdomain( 'dahztheme', false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
		} // End load_localization()

		/**
		 * Load the plugin textdomain from the main WordPress "languages" folder.
		 * @since  1.0.0
		 * @return  void
		 */
		public function load_plugin_textdomain () {
		    $domain = 'dahztheme';
		    // The "plugin_locale" filter is also used in load_plugin_textdomain()
		    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		    load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		    load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( $this->file ) ) . '/lang/' );
		} // End load_plugin_textdomain()


		/** Helper functions ******************************************************/

		/**
		 * Run on activation.
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function activation () {
			$this->register_post_type();
			flush_rewrite_rules();
		} // End activation()

		/**
		 * Run on deactivation.
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function deactivation () {
			flush_rewrite_rules();
		} // End deactivation()

		/**
		 * Get the plugin url.
		 *
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( $this->file ) );
		}

		/**
		 * Include required files.
		 * @since 1.0.0
		 */
		private function includes() {
		 	require_once( 'classes/class-testimonial-taxonomy.php' );
			require_once( 'classes/class-testimonial-shortcode.php' );
			require_once( 'functions/enqueue-style.php' );
			require_once( 'functions/enqueue-script.php' );
		}
	}
endif;

global $testimonial;

$testimonial = new df_Testimonial( __FILE__ );