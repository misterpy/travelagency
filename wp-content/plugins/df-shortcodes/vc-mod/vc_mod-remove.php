<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

// Removing Unwanted Shortcodes
// =============================================================================

if ( ! function_exists( 'df_vc_remove_default_shortcodes' ) ) {

    function df_vc_remove_default_shortcodes() {
      // vc_remove_element( 'vc_column_text' );
      // vc_remove_element( 'vc_separator' );
      // vc_remove_element( 'vc_text_separator' );
      // vc_remove_element( 'vc_message' );
      // vc_remove_element( 'vc_facebook' );
      // vc_remove_element( 'vc_tweetmeme' );
      // vc_remove_element( 'vc_googleplus' );
      // vc_remove_element( 'vc_pinterest' );
      // vc_remove_element( 'vc_toggle' );
      // vc_remove_element( 'vc_single_image' );
      // vc_remove_element( 'vc_gallery' );
      // vc_remove_element( 'vc_images_carousel' );
      // vc_remove_element( 'vc_tabs' );
      // vc_remove_element( 'vc_tour' );
      // vc_remove_element( 'vc_accordion' );
      // vc_remove_element( 'vc_posts_grid' );
      // vc_remove_element( 'vc_carousel' );
      // vc_remove_element( 'vc_posts_slider' );
      // vc_remove_element( 'vc_widget_sidebar' );
      // vc_remove_element( 'vc_button' );
      // vc_remove_element( 'vc_cta_button' );
      // vc_remove_element( 'vc_video' );
      vc_remove_element( 'vc_gmaps' );
      // vc_remove_element( 'vc_raw_html' );
      // vc_remove_element( 'vc_raw_js' );
      // vc_remove_element( 'vc_flickr' );
      // vc_remove_element( 'vc_progress_bar' );
      // vc_remove_element( 'vc_pie' );
      // vc_remove_element( 'contact-form-7' );
      // vc_remove_element( 'rev_slider_vc' );
      vc_remove_element( 'vc_pinterest' );
      // vc_remove_element( 'vc_googleplus' );
      // vc_remove_element( 'vc_tweetmeme' );
      // vc_remove_element( 'vc_facebook' );
      vc_remove_element( 'vc_wp_search' );
      vc_remove_element( 'vc_wp_meta' );
      vc_remove_element( 'vc_wp_recentcomments' );
      vc_remove_element( 'vc_wp_calendar' );
      vc_remove_element( 'vc_wp_pages' );
      vc_remove_element( 'vc_wp_tagcloud' );
      vc_remove_element( 'vc_wp_custommenu' );
      vc_remove_element( 'vc_wp_text' );
      vc_remove_element( 'vc_wp_posts' );
      vc_remove_element( 'vc_wp_links' );
      vc_remove_element( 'vc_wp_categories' );
      vc_remove_element( 'vc_wp_archives' );
      vc_remove_element( 'vc_wp_rss' );
    }
    add_action( 'admin_init', 'df_vc_remove_default_shortcodes' );
}

// Remove Teaser Metabox
// =============================================================================
if ( is_admin() ) {
	if ( ! function_exists( 'df_vc_remove_teaser_metabox' ) ) {

		function df_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );

			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser',  $post_type, 'side' );
			}
		}

		add_action( 'do_meta_boxes', 'df_vc_remove_teaser_metabox' );

	}
}