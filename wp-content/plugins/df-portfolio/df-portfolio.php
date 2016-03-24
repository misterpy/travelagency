<?php
/*
	Plugin Name: Dahz DF Portfolios
	Plugin URL:  http://dahztheme.com/
	Description: Super easy responsive WordPress Portfolio plugin allows you to create and adding a page containing the information about your past projects.
	Version: 	 1.0.0
	Author: 	 Dahz
	Author URI:  http://dahztheme.com/
*/
if ( ! defined('ABSPATH') ) { exit; }

if ( ! class_exists('DF_Portfolio') ) :

	class DF_Portfolio {

		private $dir;

		private $file;

		public $plural_name;

		public $singular_name;

		public $taxonomy_category;

		private static $instance = null;

		/**
		* @var string
		*/
		public $version = '1.0.0';

		public function __construct( $file ) {
			$this->dir 			= dirname($file);
			$this->file 		= $file;
			$this->post_type 	= 'Portfolio';

			$this->includes();

			// Define constants
			$this->define_constants();

			// Run this on activation.
			register_activation_hook( $this->file, array( $this, 'activation' ) );

			// Run this on deactivation.
			register_deactivation_hook( $this->file, array( $this, 'deactivation' ) );

			add_action('init', array($this, 'post_type_name'), 0);
			add_action('init', array($this, 'register_post_type'), 1);
			add_action('init', array($this, 'register_taxonomy'), 2);
		}

		public function getInstance() {
			if (!self::$instance) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		* Define Plugins Constants
		*/
		private function define_constants() {
			define( 'PORTFOLIO_PLUGIN_FILE', plugin_dir_path( __FILE__ ));
			define( 'PORTFOLIO_VERSION', $this->version );
			define( 'PORTFOLIO_ASSETS', plugin_dir_url( __FILE__ ) . 'assets' );
		}

		/**
		* Post type name in admin page
		* @access public
		* @return void
		*
		*/
		public function post_type_name() {
			$this->singular_name 	= apply_filters('portfolio_post_type_singular_name', _x('Portfolio Item', 'post type singular name', 'dahztheme'));
			$this->plural_name 		= apply_filters('portfolio_post_type_plural_name', _x('Portfolios', 'post type general name', 'dahztheme'));
		}

		/**
		* Register the post type.
		*
		* @access public
		* @return void
		*/
		public function register_post_type() {

			// "Portfolio Item" Custom Post Type
	        $labels = array(
	            'name'                  => $this->plural_name,
	            'singular_name'         => $this->singular_name,
	            'add_new'               => __('Add New', 'dahztheme'),
	            'add_new_item'          => sprintf( __('Add New %s Item', 'dahztheme'), $this->post_type ),
	            'edit_item'             => sprintf( __('Edit %s Item', 'dahztheme'), $this->post_type ),
	            'new_item'              => sprintf( __('New %s Item', 'dahztheme'), $this->post_type ),
	            'view_item'             => sprintf( __('View %s Item', 'dahztheme'), $this->post_type ),
	            'search_items'          => sprintf( __('Search %s Items', 'dahztheme'), $this->post_type ),
	            'not_found'             => sprintf( __('No %s Items Found', 'dahztheme'), $this->post_type ),
	            'not_found_in_trash'    => sprintf( __('No %s Items Found In Trash', 'dahztheme'), $this->post_type ),
	            'parent_item_colon'     => ''
	        );

	        $args = array(
	            'labels'                => $labels,
	            'public'                => true,
	            'publicly_queryable'    => true,
	            'show_ui'               => true,
	            'query_var'             => true,
	            'rewrite'               => array('slug' => 'portfolio-galleries'),
	            'capability_type'       => 'post',
	            'hierarchical'          => false,
	            'menu_icon'             => 'dashicons-portfolio',
	            'menu_position'         => 21,
	            'has_archive'           => false,
	            'taxonomies'            => array('portfolio-gallery'),
	            'supports'              => array('title', 'editor', 'thumbnail', 'comments', 'revisions')
	        );

	        register_post_type('portfolio', $args);

		}

		public function register_taxonomy() {
			$this->taxonomy_category = new Portfolio_Taxonomy();
			$this->taxonomy_category->register();
		}

		/**
		*
		* @access public
		* @since 1.0.0
		* @return void
		*
		*/
		public function activation() {
			$this->register_post_type();
			flush_rewrite_rules();
		}


		/**
		*
		* @access public
		* @since 1.0.0
		* @return void
		*
		*/
		public function deactivation() {
			flush_rewrite_rules();
		} 

		/**
		* Get the plugin path.
		*
		* @return string
		*/
		public function pluginPath() {
			return untrailingslashit(plugin_dir_path($this->file));
		}

		public function includes() {
			require_once( 'classes/class-portfolio-taxonomy.php' );
			require_once( 'functions/portfolio.php' );
			require_once( 'functions/enqueue-style.php' );
		}

	}

endif;

global $portfolio;
$portfolio = new DF_Portfolio( __FILE__ );