<?php
	/**
	* Customizer manager init
	*
	* @param $wp_manager
	* @return void
	*
	*/
	function df_customizer_manage_init( $controls ){
	    $url = DF_CORE_URI . 'images/';

        // Additional Settings
        $layout_site = array(
            'wide' 		=> array( 'url' => $url . 'fullwidth.png' ),
            'boxed' 	=> array( 'url' => $url . 'boxed.png' )
        );

        $navbar_position = array(
  			'left'   	=> array( 'url' => $url . 'nav-left.png' ),
            'split'  	=> array( 'url' => $url . 'nav-split.png' ),
            'center' 	=> array( 'url' => $url . 'nav-center.png' )
        );

        $background_opacity = array(
            'min' 		=> '0',
            'max' 		=> '100',
            'step' 		=> '5'
        );

        $site_max_width = array(
            '1405' 		=> '1400',
            '1200' 		=> '1200',
            '995' 		=> '1000'
        );

        $list_button_style = array(
            'flat'    	=> _x('Flat', 'customizer options', 'dahztheme'),
            '3d'      	=> _x('3D', 'customizer options', 'dahztheme'),
            'outline' 	=> _x('Outline', 'customizer options', 'dahztheme')
        );

        $list_button_shape = array(
            'square'  	=> _x('Square', 'customizer options', 'dahztheme'),
            'round'   	=> _x('Round', 'customizer options', 'dahztheme'),
            'pill' 		=> _x('Pill', 'customizer options', 'dahztheme')
        );

				foreach ( glob( CUSTOMIZER_OPTION_SETT_DIR . '*.php' ) as $option_file ) {
						require_once $option_file;
				}

        return $controls;
	}

add_filter( 'df_customizer_controls' , 'df_customizer_manage_init' );
