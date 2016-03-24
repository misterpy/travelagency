<?php

function df_services_sc($atts, $content = null) {
	wp_enqueue_script( 'waypoints' );

	$style = $output = $layout = $output_img = '';

	extract( shortcode_atts( array(
		'icon_type'				=> 'fontawesome',
		'icon_fontawesome' 		=> 'fa fa-adjust',
		'icon_openiconic' 		=> '',
		'icon_typicons' 		=> '',
		'icon_entypoicons' 		=> '',
		'icon_linecons' 		=> '',
		'icon_entypo' 			=> '',
		'icon_linea' 			=> '',
		'icon_color'			=> '#000000',
		'icon_style'			=> 'simple', // type of icon such as simple (no background), square, rounded, or design owner
		'icon_bg_color'			=> 'transparent', // background color of icon
		'icon_size'				=> '',
		'img' 					=> '', // icon using user image id
		'img_width' 			=> '', // image width
		'border_style'			=> '',
		'border_width'			=> '',
		'border_radius'			=> '',
		'border_color'			=> '',
		'icon_animation' 		=> '',
		'hover_effect'			=> '',
		'title'	  				=> '',
		'link' 					=> '',
		'position'    			=> 'icon_left',
		'el_class'	  			=> '',
		'title_color'			=> ''
	), $atts ) );

	ob_start();

	vc_icon_element_fonts_enqueue( $icon_type );
	$iconClass 	= isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
    $link 		= ( $link == '||' ) ? '' : $link;
  	$link 		= vc_build_link( $link );
  	$a_href 	= $link['url'];
  	$a_title 	= $link['title'];
  	$a_target 	= $link['target'] == '' ? '_self' : '_blank';

    $img = explode( ',', $img );
    $i 	 = -1;

	foreach ( $img as $attach_id ) : $i++;
		$image_src   = wp_get_attachment_image_src( $attach_id, 'full' );
		$output_img .= $image_src[0];
	endforeach;

	if ( $output_img == '') :
		$return_img = '<img src="' . get_template_directory_uri() . '/includes/assets/images/post-formats/big/image.jpg'.'" style="width:'.$img_width.'px;" alt="Service Image"/>';
	else :
		$return_img = '<img src="' . $output_img .'" style="width:' . $img_width . 'px;" alt="Service Image"/>';
	endif;

	if ( $position == 'left' ) :
		$layout = 'layout-left';
	elseif ( $position == 'icon_left' ) :
		$layout = 'layout-icon-left';
	elseif ( $position == 'top' ) :
		$layout = 'layout-top';
	elseif ( $position == 'right' ) :
		$layout = 'layout-right';
	elseif ( $position == 'icon_right' ) :
		$layout = 'layout-icon-right';
	endif;

	if ( $icon_style == 'simple' ) :
		$style = 'style="color: '.$icon_color.';"';
	elseif ( $icon_style == 'square' ) :
		$style = 'style="background-color: '.$icon_bg_color.'; color: '.$icon_color.';"';
	elseif ( $icon_style == 'rounded' ) :
		$style = 'style="background-color: '.$icon_bg_color.'; border-radius: 50%; color: '.$icon_color.';"';
	elseif ( $icon_style == 'own' ) :
		$style = 'style="background-color: '.$icon_bg_color.'; border-radius: '.$border_radius.'px; border: '.$border_width.'px '.$border_style.' '.$border_color.'; color: '.$icon_color.';"';
	endif;

	if ( $icon_animation != '' ) :
		$output .= '<div class="service-component animated-service" data-animation-service="'.$icon_animation.'">';
	else :
		$output .= '<div class="service-component">';
	endif;

	// condition position
	if ( $position == 'left' || $position == 'right' || $position == 'top' ) :
		$output	.= '<div class="service '.$layout.'">';

		// condition icon type : font icon or image icon
		if ( $icon_type == 'image_icon' ) :
			$output .= '<div class="service-icon vc_icon_element-icon ' . $hover_effect . '">'.$return_img.'</div>';
		else :
			$output .= '<div class="service-icon  ' . $hover_effect . ' ' . $icon_style . ' vc_icon_element-icon ' . $icon_size . ' ' . $iconClass . '" ' . $style . '></div>';
		endif;

	  	$output	.= '<div class="service-desc">';
	  	$output	.= '<div class="service-header"><h3 class="title"><a href="'.$a_href.'" style="color:'.$title_color.';" target="'.$a_target.'" title="'.$a_title.'">'.$title.'</a></h3></div>';
		$output	.= '<div class="service-content">' . do_shortcode( $content ) . '</div>';
		$output	.= '</div></div>';
	elseif ( $position == 'icon_left' ) :
		$output	.= '<div class="service '.$layout.'">';
		$output	.= '<div class="service-icon-header">';

		// condition icon type : font icon or image icon
		if ( $icon_type == 'image_icon' ) :
			$output .= '<div class="service-icon vc_icon_element-icon ' . $hover_effect . '">'.$return_img.'</div>';
		else :
			$output .= '<div class="service-icon  ' . $hover_effect . ' ' . $icon_style . ' vc_icon_element-icon ' . $icon_size . ' ' . $iconClass . '" ' . $style . '></div>';
		endif;

		$output .= '<div class="service-header"><h3 class="title"><a href="'.$a_href.'" style="color:'.$title_color.';" target="'.$a_target.'" title="'.$a_title.'">'.$title.'</a></h3></div></div>';
		$output .= '<div class="service-desc">';
		$output .= '<div class="service-content">' . do_shortcode( $content ) . '</div>';
		$output .= '</div></div>';
	elseif ( $position == 'icon_right' ) :
		$output	.= '<div class="service '.$layout.'">';
		$output	.= '<div class="service-icon-header">';
		$output .= '<div class="service-header"><h3 class="title"><a href="'.$a_href.'" style="color:'.$title_color.';" target="'.$a_target.'" title="'.$a_title.'">'.$title.'</a></h3></div>';

		// condition icon type : font icon or image icon
		if ( $icon_type == 'image_icon' ) :
			$output .= '<div class="service-icon vc_icon_element-icon ' . $hover_effect . '">'.$return_img.'</div></div>';
		else :
			$output .= '<div class="service-icon  ' . $hover_effect . ' ' . $icon_style . ' vc_icon_element-icon ' . $icon_size . ' ' . $iconClass . '" ' . $style . '></div></div>';
		endif;

		$output .= '<div class="service-desc">';
		$output .= '<div class="service-content">' . do_shortcode( $content ) . '</div>';
		$output .= '</div></div>';
	endif;

	$output	.= '</div>';
	$output	.= ob_get_clean();

	return $output;
}
add_shortcode( 'df_services', 'df_services_sc' );