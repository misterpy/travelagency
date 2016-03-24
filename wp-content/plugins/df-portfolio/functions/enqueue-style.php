<?php
if ( ! defined('ABSPATH') ) { exit; }

if (!function_exists('portfolio_enqueue_style')) : 

	function portfolio_enqueue_style(){
		wp_register_style('df-portfolio', trailingslashit(PORTFOLIO_ASSETS) . 'css/_portfolio.css', NULL, NULL);
		wp_enqueue_style('df-portfolio');
	}

	add_action('wp_enqueue_scripts', 'portfolio_enqueue_style', 25);
endif;