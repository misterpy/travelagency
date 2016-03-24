<?php

function df_countdown_sc( $atts ) {
	$count_style = $datetime = $timezone = $countdown_opts = $tick_col = $tick_size = $tick_style = $tick_sep_col = $tick_sep_size = '';
	$tick_sep_style = $extra_class = '';
	$string_days = $string_weeks = $string_months = $string_years = $string_hours = $string_minutes = $string_seconds = '';
	$string_days2 = $string_weeks2 = $string_months2 = $string_years2 = $string_hours2 = $string_minutes2 = $string_seconds2 = '';
	$data_attr = $count_frmt = $labels = '';

	extract( shortcode_atts( array(
		'datetime'			=> '',
		'timezone'			=> '',
		'countdown_opts'	=> 'is-df_countdown',
		'tick_col'			=> '', // timer font color
		'tick_size'			=> '', // timer font sizze
		'tick_style'		=> '', // timer font style: bold, italic, normal, bold-italic
		'tick_sep_col'		=> '', // datetime font color
		'tick_sep_size'		=> '', // datetime font size
		'tick_sep_style'	=> '', // datetime font style: bold, italic, normal, bold-italic
		'timer_bg_color'	=> '', // background color
		'extra_class'		=> '',
		'string_days' 		=> 'Day',
		'string_days2' 		=> 'Days',
		'string_weeks' 		=> 'Week',
		'string_weeks2' 	=> 'Weeks',
		'string_months' 	=> 'Month',
		'string_months2' 	=> 'Months',
		'string_years' 		=> 'Year',
		'string_years2' 	=> 'Years',
		'string_hours' 		=> 'Hour',
		'string_hours2' 	=> 'Hours',
		'string_minutes' 	=> 'Minute',
		'string_minutes2' 	=> 'Minutes',
		'string_seconds' 	=> 'Second',
		'string_seconds2' 	=> 'Seconds'
	), $atts ) );

	$labels 		= $string_years2 .','.$string_months2.','.$string_weeks2.','.$string_days2.','.$string_hours2.','.$string_minutes2.','.$string_seconds2;
	$labels2 		= $string_years .','.$string_months.','.$string_weeks.','.$string_days.','.$string_hours.','.$string_minutes.','.$string_seconds;
	$countdown_opt 	= explode(",",$countdown_opts);

	if(is_array($countdown_opt)){
		foreach($countdown_opt as $opt){
			if($opt == "syear") { $count_frmt .= 'Y'; }
			if($opt == "smonth") { $count_frmt .= 'O'; }
			if($opt == "sweek") { $count_frmt .= 'W'; }
			if($opt == "sday") { $count_frmt .= 'D'; }
			if($opt == "shr") { $count_frmt .= 'H'; }
			if($opt == "smin") { $count_frmt .= 'M'; }
			if($opt == "ssec") { $count_frmt .= 'S'; }
		}
	}

	if($count_frmt==''){ $count_frmt = 'DHMS'; }

	$data_attr .= 'data-tick-style="'.$tick_style.'"';
	$data_attr .= 'data-tick-p-style="'.$tick_sep_style.'"';
	$data_attr .= 'data-bg-color="'.$timer_bg_color.'"';

	$output = '<div class="df_countdown '.$extra_class.'">';
	if($datetime!=''){
		$output .='<div class="df_countdown-div df_countdown-dateAndTime '.$timezone.'" data-labels="'.$labels.'" data-labels2="'.$labels2.'"  data-terminal-date="'.$datetime.'" data-countformat="'.$count_frmt.'" data-time-zone="'.get_option('gmt_offset').'" data-time-now="'.str_replace('-', '/', current_time('mysql')).'" data-tick-size="'.$tick_size.'" data-tick-col="'.$tick_col.'" data-tick-p-size="'.$tick_sep_size.'" data-tick-p-col="'.$tick_sep_col.'" '.$data_attr.'>'.$datetime.'</div>';
	}
	$output .='</div>';

	return $output;

}
add_shortcode( 'df_countdown', 'df_countdown_sc' );