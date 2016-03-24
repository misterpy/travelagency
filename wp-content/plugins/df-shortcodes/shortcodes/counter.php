<?php
if (!class_exists('Ultimate_VC_Addons')) {
	function df_counter_sc( $atts ) {
		$class = $counter_title = $counter_value = $font_size_title = $font_size_counter = $counter_font = $title_font = $speed = $el_class = $counter_sep = $counter_decimal = $counter_color_txt = '';

		extract( shortcode_atts( array(
			'counter_title' 			=> '',
			'counter_text_front' 		=> '',
			'counter_text_back' 		=> '',
			'counter_value' 			=> '',
			'counter_sep' 				=> '',
			'counter_decimal' 			=> '',
			'counter_color_txt'			=> '', // counter font color text
			'font_size_counter' 		=> '', // counter font size text
			'counter_title_color_txt'	=> '', // counter font title color text
			'font_size_title' 			=> '', // counter font title size text
			'speed'						=> '', // counter speed count
			'el_class'					=> '',
			'font_weight_counter' 		=> ''
		), $atts ) );
		$counter_color = $counter_title_color = "";
		// style counter text font color
		if ($font_weight_counter != '') {
			$font_weight_counter = 'font-weight:'.$font_weight_counter.';';
		}
		if($counter_color_txt !== ''){
			$counter_color = 'color:'.$counter_color_txt.';';
		}

		// style counter title font color
		if($counter_title_color_txt !== ''){
			$counter_title_color = 'color:'.$counter_title_color_txt.';';
		}

		// style font size
		$counter_font 	= 'font-size:'.$font_size_counter.'px;';
		$title_font 	= 'font-size:'.$font_size_title.'px;';

		// el class
		if ($el_class != '') { $class .= ' ' . $el_class; }

		// counter HTML
		$output = '<div class="stats-block ' . $class . '">';
		$id 	= 'counter_'.rand();

		if( $counter_sep == "" ){
			$counter_sep = 'none';
		}
		if( $counter_decimal == "" ){
			$counter_decimal = 'none';
		}

		$output .= '<div class="stats-desc">';
		$output .= '<span style="'.$counter_font.' '.$counter_color.' '.$font_weight_counter.'">'.$counter_text_front.'</span>';
		$output .= '<div id="'.$id.'" data-id="'.$id.'" class="stats-number" style="'.$counter_font.' '.$counter_color.' '.$font_weight_counter.'" data-speed="'.$speed.'" data-counter-value="'.$counter_value.'" data-separator="'.$counter_sep.'" data-decimal="'.$counter_decimal.'">0</div>';
		$output .= '<span style="'.$counter_font.' '.$counter_color.' '.$font_weight_counter.'">'.$counter_text_back.'</span>';
		$output .= '<div class="stats-text" style="'.$title_font.' '.$counter_title_color.'">'.$counter_title.'</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode('df_stat_counter', 'df_counter_sc');
}