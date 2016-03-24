<?php

if ( ! defined('ABSPATH') ) { exit; }

/**
 * Dahz Testimonial Taxonomy Class
 *
 * Re-usable class for registering Testimonial taxonomies.
 *
 * @package 	WordPress
 * @subpackage 	Dahz Testimonial
 * @category 	Plugin
 * @author 		Dahz
 * @since 		1.0.0
 */

	class Portfolio_Taxonomy {
		
		/**
		 * The arguments to use when registering the taxonomy.
		 * @access  private
		 * @since   1.0.0
		 * @var     string
		 */
		private $args;

		public function __construct( $args = array() ){
			$this->post_type = 'Portfolio';
			$this->args = wp_parse_args( $args, $this->_get_default_args() );
		}

		public function _default_labels() {

	        // "Portfolio Galleries" Custom Taxonomy
	        return array(
	            'name'                  => sprintf( _x('%s Galleries', 'taxonomy general name', 'dahztheme'), $this->post_type),
	            'singular_name'         => sprintf( _x('%s Gallery', 'taxonomy singular name', 'dahztheme'), $this->post_type),
	            'search_items'          => sprintf( __('Search %s Galleries', 'dahztheme'), $this->post_type),
	            'all_items'             => sprintf( __('All %s Galleries', 'dahztheme'), $this->post_type),
	            'parent_item'           => sprintf( __('Parent %s Gallery', 'dahztheme'), $this->post_type),
	            'parent_item_colon'     => sprintf( __('Parent %s Gallery:', 'dahztheme'), $this->post_type),
	            'edit_item'             => sprintf( __('Edit %s Gallery', 'dahztheme'), $this->post_type),
	            'update_item'           => sprintf( __('Update %s Gallery', 'dahztheme'), $this->post_type),
	            'add_new_item'          => sprintf( __('Add New %s Gallery', 'dahztheme'), $this->post_type),
	            'new_item_name'         => sprintf( __('New %s Gallery Name', 'dahztheme'), $this->post_type),
	            'menu_name'             => sprintf( __('%s Galleries', 'dahztheme'), $this->post_type)
	        );

		}

		public function _get_default_args(){
	        return array(
	            'hierarchical'          => true,
	            'labels'                => $this->_default_labels(),
	            'show_ui'               => true,
	            'query_var'             => true,
	            'rewrite'               => array('slug' => 'portfolio-gallery')
	        );
		}

		public function register() {
			$args = apply_filters( 'portfolio_register_taxonomy', $this->args );
			register_taxonomy('portfolio-gallery', array('portfolio'), $args);
		}
	}

	global $PortfolioTaxonomy;

	$PortfolioTaxonomy = new Portfolio_Taxonomy();