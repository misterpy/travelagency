<?php

function df_share($atts ) {
	extract(shortcode_atts(array(
	    'twitter'      		=> '',
	    'facebook'     		=> '',
	    'email'        		=> '',
	    'google'       		=> '',
	    'pinterest'    		=> '',
	    'share'        		=> '',
	    'share_text'   		=> '',
	    'big_icon' 			=> '',
	    'icon_color'		=> '',
	    'align' 			=> 'left',
	), $atts ) );

    $output = $icon_big_class ='';

	if ($big_icon == 'true') {
		$icon_big_class = 'big-social';
    }

	if ($share == 'true') {
		$output .= '<p class="df-share-text '. $align.'">' . $share_text .'</p>';
	}

	$output .= '<ul class="df-share-shortcode df-social-connect '. $icon_big_class.' '. $align.'">';

	if ($twitter == 'true') {
		$output .= '<li><a class="twitter" style="color:'.$icon_color.'" href="http://twitter.com/share?text='.get_the_title().'&url='.get_the_permalink(get_the_ID()).'" target="_blank"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a></li>';
	}

	if ($facebook == 'true') {
		$output .= '<li><a class="facebook" style="color:'.$icon_color.'" href="https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink(get_the_ID()).'" target="_blank"><i class="fa-facebook fa"></i><i class="fa-facebook fa"></i></a></li>';
	}

	if ($google == 'true') {
		$output .= '<li><a class="google-plus" style="color:'.$icon_color.'" href="https://plus.google.com/share?url='.get_the_permalink(get_the_ID()).'" target="_blank"><i class="fa-google-plus fa"></i><i class="fa-google-plus fa"></i></a></li>';
	}

	if ($pinterest == 'true') {
		$output .= '<li><a class="pinterest" style="color:'.$icon_color.'" href="https://pinterest.com/pin/create/button/?url='.get_the_permalink(get_the_ID()).'" target="_blank"><i class="fa fa-pinterest "></i><i class="fa fa-pinterest "></i></a></li>';
	}

	if ($email == 'true') {
		$output .= '<li><a class="mail-to" style="color:'.$icon_color.'" href="mailto:?subject='.get_the_permalink(get_the_ID()).'" target="_top"><i class="fa-envelope-o fa"></i><i class="fa-envelope-o fa"></i></a></li>';
	}

	$output .= '</ul><div class="clear"></div>';

	return $output;
}
add_shortcode('share_social', 'df_share');