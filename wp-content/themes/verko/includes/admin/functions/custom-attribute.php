<?php

/*
 * modify existing HTML attribute functions and filters.
 */
function df_custom_attr_menu( $attr ) {

	$attr['class'] = 'main-navigation hidden-tl hidden-sm';

	return $attr;
}
add_filter('dahz_attr_menu', 'df_custom_attr_menu');

function df_custom_attr_entry_title( $attr ) {
    $df_options 	= get_option('df_options' );
    $df_bg_mode_lay = get_post_meta( get_the_ID(), 'df_metabox_ftr_img_background', true );

    $df_blog_layout = is_archive() ? $df_options[ 'archive_layout' ] : $df_options[ 'blog_layout' ];
    $df_grid_type   = is_archive() ? $df_options[ 'arch_content_grid' ] : $df_options[ 'blog_content_grid' ];

    $output 		= array( 'entry-title', 'df-post-title' );

    if ( !is_single() && ( $df_blog_layout == 'list' || ( $df_blog_layout == 'grid' && $df_grid_type == 'masonry' ) ) ) {
    	if ( $df_bg_mode_lay != '1' && ( get_post_format() == 'aside' || get_post_format() == 'quote' || get_post_format() == 'status' ) ) {
			$output[] = 'hide';
    	}
	} else if ( is_single() ) {
		$output[] = 'hide';
	}

	$attr['class'] = esc_attr( implode( " ", $output ) );

	return $attr;
}
add_filter('dahz_attr_entry-title', 'df_custom_attr_entry_title');

function df_custom_attr_post( $attr ) {
	// set the output class
	$output   = is_page() ? array() : array( df_blog_grid_col(), df_image_as_bg(), df_big_post_grid() );

	$outputs  = array_merge( get_post_class(), $output );

	$attr['class'] = esc_attr( implode( " ", $outputs ) );

	return $attr;
}
add_filter( 'dahz_attr_post', 'df_custom_attr_post' );