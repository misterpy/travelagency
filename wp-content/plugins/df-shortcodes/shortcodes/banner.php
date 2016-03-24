<?php

function df_banner_sc( $atts, $content = null) {
    $output_img = $html = '';

	extract( shortcode_atts( array(
		'link'          => '',
		'border'        => '',
		'border_color'  => '',
		'back_image'    => '',
		'img'           => '',
		'height'        => '',
		'background'    => '',
		'el_class'      => ''
	), $atts ) );

	$img 	  = explode( ',', $img );
    $i 	 	  = -1;
	$link 	  = ( $link == '||' ) ? '' : $link;
	$link 	  = vc_build_link( $link );
	$a_href   = $link['url'];
	$a_title  = $link['title'];
	$a_target = $link['target'];

    foreach ( $img as $attach_id ) { $i++;
		$image_src    = wp_get_attachment_image_src( $attach_id, 'full' );
		$output_img  .= $image_src[0];
	}

	$return_img = get_template_directory_uri().'/includes/assets/images/presets/post-formats/big/image.jpg';
	if( $output_img != '') {
		$return_img = $output_img;
	}

	$border_color;
	if ( $border != 'yes' ) {
		$border_color = 'transparent';
	}

	$bg_type = 'style="background-image: url(' . esc_url( $return_img ) . ');"';
	if ( $back_image == '' ) {
		$bg_type = 'style="background-color:' . $background . ';"';
	}

	$html .= '<div class="banner-warpper ' . $el_class . '">';
	$html .= '<div class="banner-warpper-inner">';
	$html .= '<a href="' . $a_href . '" target="' . $a_target . '" title="' . $a_title . '">';
	$html .= '<div class="banner-background" ' . $bg_type . '></div>';
	$html .= '<div class="banner-inner">';
	$html .= '<div class="banner-content" style="border-color:' . $border_color . ';height:' . $height . 'px;">' . do_shortcode( $content ) . '</div>';
	$html .= '</div></a></div></div>';

	return $html;
}
add_shortcode('df_banner', 'df_banner_sc');