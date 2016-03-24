<?php

function advance_gmaps( $atts, $content = null) {

	$output = $output_img = $output_img_el = $parallax_class = $maps = $data_attr = '';

	extract( shortcode_atts( array(
		'height' 			=> '400',
		'latitude' 			=> '',
		'longitude' 		=> '',
		'address' 			=> '',
		'latitude_2' 		=> '',
		'longitude_2' 		=> '',
		'address_2' 		=> '',
		'zoom' 				=> '',
		'pan_control' 		=> '',
		'draggable' 		=> '',
		'zoom_control' 		=> '',
		'map_type_control' 	=> '',
		'scale_control' 	=> '',
		'img' 				=> '',
		'modify_coloring' 	=> '',
		'hue' 				=> '',
		'saturation' 		=> '',
		'lightness' 		=> '',
		'el_class' 			=> ''
	), $atts ) );

	if ( $longitude == '' && $latitude == '') { return null; }

	$img = explode( ',', $img );
	$i 	 = -1;
	$id  = mt_rand( 99, 9999 );

	foreach ( $img as $attach_id ) :
		$i++;
        $image_src   = wp_get_attachment_image_src( $attach_id, 'thumbnail' );
        $output_img .= $image_src[0];
    endforeach;

	if ( $zoom < 1 ) { $zoom = 1; }

	$data_attr .= $zoom != '' ? ' data-zoom="' . $zoom . '"' : '';
	$data_attr .= $output_img != '' ? ' data-pin-icon="' . $output_img . '"' : '';
	$data_attr .= $latitude != '' ? ' data-latitude="' . $latitude . '"' : '';
	$data_attr .= $longitude != '' ? ' data-longitude="' . $longitude . '"' : '';
	$data_attr .= $address != '' ? ' data-address="' . $address . '"' : '';
	$data_attr .= $latitude_2 != '' ? ' data-latitude2="' . $latitude_2 . '"' : '';
	$data_attr .= $longitude_2 != '' ? ' data-longitude2="' . $longitude_2 . '"' : '';
	$data_attr .= $address_2 != '' ? ' data-address2="' . $address_2 . '"' : '';
	$data_attr .= $pan_control != '' ? ' data-pan-control="' . $pan_control . '"' : '';
	$data_attr .= $zoom_control != '' ? ' data-zoom-control="' . $zoom_control . '"' : '';
	$data_attr .= $map_type_control != '' ? ' data-map-type-control="' . $map_type_control . '"' : '';
	$data_attr .= $scale_control != '' ? ' data-scale-control="' . $scale_control . '"' : '';
	$data_attr .= $draggable != '' ? ' data-draggable="' . $draggable . '"' : '';
	$data_attr .= $modify_coloring != '' ? ' data-modify-coloring="' . $modify_coloring . '"' : '';
	$data_attr .= $saturation != '' ? ' data-saturation="' . $saturation . '"' : '';
	$data_attr .= $lightness != '' ? ' data-lightness="' . $lightness . '"' : '';
	$data_attr .= $hue != '' ? ' data-hue="' . $hue . '"' : '';

	$maps .= '<div id="google-map-' . $id . '" class="advanced-gmaps ' . $el_class . '" style="height: ' . $height . 'px; width: 100%;" ' . $data_attr . '></div>';
	$maps .= '<script src="http' . ( is_ssl() ? 's' : '' ) . '://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>';

	return $maps;

}
add_shortcode( 'df_advanced_gmaps', 'advance_gmaps' );