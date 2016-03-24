<?php
if (!defined('ABSPATH')) die('-1');

function df_modal_box( $atts, $content = null ) {
	$style = $modal_class = $modal_data_class = $html = $border_style = $header_style = $modal_title = $modal_contain = $content_style = '';

	extract( shortcode_atts( array(
		'icon_type'				=> 'none',
		'icon'					=> '',
		'icon_img' 				=> '',
		'modal_on' 				=> 'df_button',
		// button normal with icon trigger
		'btn_size' 				=> 'sm',
		'btn_bg_color' 			=> '',
		'btn_txt_color' 		=> '',
		'btn_text' 				=> '',
		// image button trigger
		'btn_img' 				=> '',
		// text button trigger
		'read_text' 			=> '',
		'txt_color' 			=> '',
		// onload trigger
		'onload_delay'			=> '',
		'modal_on_align' 		=> 'center',
		// modal box
		'modal_size' 			=> 'small',
		'modal_style'			=> 'overlay-fade',
		'content_bg_color' 		=> '',
		'content_text_color' 	=> '',
		'header_bg_color' 		=> '',
		'header_text_color' 	=> '',
		'modal_title' 			=> '',
		'modal_contain' 		=> 'df-html',
		'el_class' 				=> ''
	), $atts ) );

	ob_start();

	$logo = '<i class="fa ' . $icon . '"></i>' ;
	$uniq = uniqid();

	// Create style for content background color
	if ( $content_bg_color !== '') 	 { $content_style .= 'background:' . $content_bg_color . ';'; }
	// Create style for content text color
	if ( $content_text_color !== '') { $content_style .= 'color:' . $content_text_color . ';'; }
	// Create style for header background color
	if ( $header_bg_color !== '') 	 { $header_style = 'background:' . $header_bg_color . ';'; }
	// Create style for header text color
	if ( $header_text_color !== '')  { $header_text_color = 'color:' . $header_text_color . ';'; }

	// modal style class
	$modal_class 	  = 'overlay-show';
	$modal_data_class = 'data-overlay-class="' . $modal_style . '"';

	// icon style
	if ( $icon_type == 'custom' ) :
		$ico_img  = wp_get_attachment_image_src( $icon_img, 'large' );
		$box_icon = '<div class="modal-icon"><img src="' . $ico_img[0] . '" class="df-modal-inside-img"></div>';
	elseif ( $icon_type == 'fa_icon' ) :
		$box_icon = '<div class="modal-icon" style="' . $header_text_color . '">' . $logo . '</div>';
	endif;

	// trigger
	switch ( $modal_on ) :
		case 'button':
			if ( $btn_bg_color !== '' ) {
				$style .= 'background:'.$btn_bg_color.';';
				$style .= 'border-color:'.$btn_bg_color.';';
			}

			if( $btn_txt_color !== '' ) { $style .= 'color:'.$btn_txt_color.';'; }

			$html .= '<button style="'.$style.'" data-class-id="content-'.$uniq.'" class="df-modal-box-sc btn btn-primary btn-'.$btn_size.' '.$modal_class.' df-align-'.$modal_on_align.'" '.$modal_data_class.'>'.$btn_text.'</button>';
			break;
		case 'image':
			$btn_img = wp_get_attachment_image_src( $btn_img, 'large' );
			if ( $btn_img !== '' ) {
				$html .= '<img src="'.$btn_img[0].'" data-class-id="content-'.$uniq.'" class="df-modal-box-sc  df-modal-img '.$modal_class.' df-align-'.$modal_on_align.'" '.$modal_data_class.'/>';
			}
			break;
		case 'onload':
			$html .= '<div data-class-id="content-'.$uniq.'" class="df-modal-box-sc  df-onload '.$modal_class.' " '.$modal_data_class.' data-onload-delay="'.$onload_delay.'"></div>';
			break;
		case 'text':
			if ( $txt_color !== '' ) {
				$style .= 'color:'.$txt_color.';'; $style .= 'cursor:pointer;';
			}
			$html .= '<span style="'.$style.'" data-class-id="content-'.$uniq.'" class="df-modal-box-sc '.$modal_class.' df-align-'.$modal_on_align.'" '.$modal_data_class.'>'.$read_text.'</span>';
			break;
		default:
			if ( $btn_bg_color !== '' ) {
				$style .= 'background:'.$btn_bg_color.';';
				$style .= 'border-color:'.$btn_bg_color.';';
			}

			if( $btn_txt_color !== '' ){ $style .= 'color:'.$btn_txt_color.';'; }

			$html .= '<button style="'.$style.'" data-class-id="content-'.$uniq.'" class="df-modal-box-sc btn btn-primary btn-'.$btn_size.' '.$modal_class.' df-align-'.$modal_on_align.'" '.$modal_data_class.'>'.$btn_text.'</button>';
			break;
	endswitch;

	// modal box
	$html .= '<div class="df-overlay content-'.$uniq.' '.$el_class.'" data-class="content-'.$uniq.'" id="button-click-overlay" style="display:none;">';
	$html .= '<div class="df_modal df-fade df-'.$modal_size.'">';
	$html .= '<div class="df_modal-content">';
	if($modal_title !== ''){
		$html .= '<div class="df_modal-header" style="'.$header_style.'">';
		$html .= $box_icon.'<h3 class="df_modal-title" style="'.$header_text_color.'">'.$modal_title.'</h3>';
		$html .= '</div>';
	}
	$html .= '<div class="df_modal-body '.$modal_contain.'" style="'.$content_style.'">';
	$html .= wpb_js_remove_wpautop( $content, true );
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '<div class="df-overlay-close">Close</div>';
	$html .= '</div>';
	$html .= ob_get_clean();
	return $html;
}
add_shortcode( 'df_modal', 'df_modal_box' );