<?php 
/*------------------------------------------------------------------------------------ */
/* Page Loader                                                                         */
/* ----------------------------------------------------------------------------------- */
if(!function_exists('df_loading_spinners')) {
    function df_loading_spinners($return = false) {
        $df_options = get_option('df_options' );
        $spinner_html            = '';
        $loading_animation       = $df_options['df_enable_loading_animation'];
        $loading_animation_style = $df_options['df_loading_animation_style'];

        if($loading_animation != '0'){
            switch ($loading_animation_style) {
                case "pulse":
                    $spinner_html = df_loading_spinner_pulse();
                break;
                case "ball_rotate":
                    $spinner_html = df_loading_ball_rotate();
                break;
                case "cube":
                    $spinner_html = df_loading_spinner_cube();
                break;
                case "rotating_cubes":
                    $spinner_html = df_loading_spinner_rotating_cubes();
                break;
                case "stripes":
                    $spinner_html = df_loading_spinner_stripes();
                break;
                case "ball_rotate_multiple":
                    $spinner_html = df_loading_ball_rotate_multiple();
                break;
                case "line_pulse_out":
                    $spinner_html = df_loading_line_pulse_out();
                break;
                case "line_pulse":
                    $spinner_html = df_loading_line_pulse();
                break;
            }
        }else{
            $spinner_html = df_loading_spinner_pulse();
        }

        if($return === true) {
            return $spinner_html;
        }

        echo $spinner_html;
    }
}
/*------------------------------------------------------------------------------------ */
/* Page Loader loading animation                                                       */
/* ----------------------------------------------------------------------------------- */
if(!function_exists('df_loading_spinner_pulse')) {
    function df_loading_spinner_pulse() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="pulse" style="background-color:'.$loading_animation_image.'"></div>';
        return $html;
    }
}

if(!function_exists('df_loading_ball_rotate')) {
    function df_loading_ball_rotate() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="ball-clip-rotate">';
        $html .= '  <div style="border-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('df_loading_spinner_cube')) {
    function df_loading_spinner_cube() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="cube" style="background-color:'.$loading_animation_image.'"></div>';
        return $html;
    }
}

if(!function_exists('df_loading_spinner_rotating_cubes')) {
    function df_loading_spinner_rotating_cubes() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="rotating_cubes">';
        $html .= '<div class="cube1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="cube2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('df_loading_spinner_stripes')) {
    function df_loading_spinner_stripes() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="stripes">';
        $html .= '<div class="rect1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect3" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect4" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect5" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('df_loading_ball_rotate_multiple')) {
    function df_loading_ball_rotate_multiple() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="ball-clip-rotate-multiple">';
        $html .= ' <div style="border-color:'.$loading_animation_image.'"></div>';
        $html .= ' <div style="border-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('df_loading_line_pulse_out')) {
    function df_loading_line_pulse_out() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="line-scale-pulse-out-rapid" >';
        $html .= '  <div style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '  <div style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '  <div style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '  <div style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '  <div style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('df_loading_line_pulse')) {
    function df_loading_line_pulse() {
        $df_options = get_option('df_options' );
        $loading_animation_image = $df_options['df_loading_animation_color'];

        $html = '';
        $html .= '<div class="ball-scale-ripple">';
        $html .= '  <div style="border-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        return $html;
    }
}