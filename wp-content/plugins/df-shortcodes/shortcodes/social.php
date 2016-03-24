<?php

function df_social_icon($atts ) {
	extract(shortcode_atts(array(
	    'twitter'      		=> '',
	    'facebook'     		=> '',
	    'google'       		=> '',
	    'pinterest'    		=> '',
	    'email'        		=> '',
	    'youtube'    		=> '',
	    'vimeo'    			=> '',
	    'instagram'			=> '',
	    'dribbble'			=> '',
	    'linkedin'			=> '',
	    'tumblr'			=> '',
	    'reddit'			=> '',
	    'stumbleupon'		=> '',
	    'share'        		=> 'no',
	    'share_text'   		=> '',
	    'icon_color'		=> '',
	    'big_icon' 			=> 'no',
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

	if ($twitter != '') {
		$output .= '<li><a class="twitter" style="color:'.$icon_color.'" href="'.$twitter.'" target="_blank"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a></li>';
	}

	if ($facebook != '') {
		$output .= '<li><a class="facebook" style="color:'.$icon_color.'" href="'.$facebook.'" target="_blank"><i class="fa-facebook fa"></i><i class="fa-facebook fa"></i></a></li>';
	}

	if ($google != '') {
		$output .= '<li><a class="google" style="color:'.$icon_color.'" href="'.$google.'" target="_blank"><i class="fa-google-plus fa"></i><i class="fa-google-plus fa"></i></a></li>';
	}

	if ($pinterest != '') {
		$output .= '<li><a class="pinterest" style="color:'.$icon_color.'" href="'.$pinterest.'" target="_blank"><i class="fa fa-pinterest "></i><i class="fa fa-pinterest "></i></a></li>';
	}

	if ($email != '') {
		$output .= '<li><a class="mail-to" style="color:'.$icon_color.'" href="mailto:'.$email.'?subject='.get_the_permalink(get_the_ID()).'" target="_top"><i class="fa-envelope-o fa"></i><i class="fa-envelope-o fa"></i></a></li>';
	}

	if ($youtube != '') {
		$output .= '<li><a class="youtube" style="color:'.$icon_color.'" href="'.$youtube.'" target="_blank"><i class="fa fa-youtube"></i><i class="fa fa-youtube"></i></a></li>';
	}

	if ($vimeo != '') {
		$output .= '<li><a class="vimeo" style="color:'.$icon_color.'" href="'.$vimeo.'" target="_blank"><i class="fa-vimeo-square fa"></i><i class="fa-vimeo-square fa"></i></a></li>';
	}

	if ($instagram != '') {
		$output .= '<li><a class="instagram" style="color:'.$icon_color.'" href="'.$instagram.'" target="_blank"><i class="fa-instagram fa"></i><i class="fa-instagram fa"></i></a></li>';
	}

	if ($dribbble != '') {
		$output .= '<li><a class="dribbble" style="color:'.$icon_color.'" href="'.$dribbble.'" target="_blank"><i class="fa fa-dribbble "></i><i class="fa fa-dribbble "></i></a></li>';
	}

	if ($linkedin != '') {
		$output .= '<li><a class="linkedin" style="color:'.$icon_color.'" href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i></a></li>';
	}

	if ($tumblr != '') {
		$output .= '<li><a class="tumblr" style="color:'.$icon_color.'" href="'.$tumblr.'" target="_blank"><i class="fa-tumblr fa"></i><i class="fa-tumblr fa"></i></a></li>';
	}

	if ($reddit != '') {
		$output .= '<li><a class="reddit" style="color:'.$icon_color.'" href="'.$reddit.'" target="_blank"><i class="fa-reddit fa"></i><i class="fa-reddit fa"></i></a></li>';
	}

	if ($stumbleupon != '') {
		$output .= '<li><a class="stumbleupon" style="color:'.$icon_color.'" href="'.$stumbleupon.'" target="_blank"><i class="fa fa-stumbleupon "></i><i class="fa fa-stumbleupon "></i></a></li>';
	}

	$output .= '</ul><div class="clear"></div>';

	return $output;
}
add_shortcode('social_icon', 'df_social_icon');