<?php
/*
*
*/


// don't load directly
if (!defined('ABSPATH')) die('-1');

if ( ! function_exists( 'df_vc_update_existing_shortcodes' ) ) {

	function df_vc_update_existing_shortcodes() {

      /* ======================================================================= */
      /* Vc_row                                                                  */
      /* ======================================================================= */
      vc_add_param( 'vc_row', array(
          'type'        => 'textfield',
          'heading'     => __( 'Row ID / Anchor', 'dahztheme' ),
          'param_name'  => 'el_id',
          'description' => __( 'Enter row ID (Note: make sure it is unique and valid according to w3c specification).', 'dahztheme' )
      ) );

      // parallax fixed background
      vc_add_param( 'vc_row', array(
          'type'        => 'checkbox',
          'heading'     => __( 'Enable Fixed Background', 'woothemes' ),
          'param_name'  => 'enable_fixed',
          'value'       => array( __( 'Yes', 'dahztheme' ) => 'yes' )
      ) );

      /**  [vc_row_inner]  **/
      vc_add_param( 'vc_row_inner', array(
          'type'        => 'textfield',
          'heading'     => __( 'Row ID / Anchor', 'dahztheme' ),
          'param_name'  => 'el_id',
          'description' => __( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: link (Must not have spaces)', 'woothemes' )
      ) );

      /* ======================================================================= */
      /* Vc_separator                                                            */
      /* ======================================================================= */
      vc_add_param( 'vc_separator', array(
        'type'        => 'dropdown',
        'heading'     => __( 'Element Width', 'dahztheme' ),
        'param_name'  => 'el_width',
        'value'       => array(
                            __( '100%', 'dahztheme' ) => '100',
                            __( '90%', 'dahztheme' ) => '90',
                            __( '80%', 'dahztheme' ) => '80',
                            __( '70%', 'dahztheme' ) => '70',
                            __( '60%', 'dahztheme' ) => '60',
                            __( '50%', 'dahztheme' ) => '50',
                            __( '40%', 'dahztheme' ) => '40',
                            __( '30%', 'dahztheme' ) => '30',
                            __( '20%', 'dahztheme' ) => '20',
                            __( '10%', 'dahztheme' ) => '10'
                         ),
        'description' => __( 'Separator element width in percents.', 'dahztheme' )
      ));
      /* ======================================================================= */
      /* Vc_button                                                               */
      /* ======================================================================= */
      $colors_arr = array(
        __( 'Grey', 'js_composer' ) => 'wpb_button',
        __( 'Blue', 'js_composer' ) => 'btn-primary',
        __( 'Turquoise', 'js_composer' ) => 'btn-info',
        __( 'Green', 'js_composer' ) => 'btn-success',
        __( 'Orange', 'js_composer' ) => 'btn-warning',
        __( 'Red', 'js_composer' ) => 'btn-danger',
        __( 'Black', 'js_composer' ) => "btn-inverse",
        __( 'Inherit', 'js_composer' ) => 'inherit',
      );
      vc_add_param( 'vc_button', array(
          'type' => 'dropdown',
          'heading' => __( 'Color', 'js_composer' ),
          'param_name' => 'color',
          'value' => $colors_arr,
          'description' => __( 'Button color.', 'js_composer' ),
          'param_holder_class' => 'vc_colored-dropdown'
      ));
      /* ======================================================================= */
      /* Vc_button  3                                                            */
      /* ======================================================================= */
      $colors_arr_btn_3 = array(
         __( 'Inherit', 'js_composer' ) => 'inherit',
         __( 'Classic Grey', 'js_composer' ) => 'default',
         __( 'Classic Blue', 'js_composer' ) => 'primary',
         __( 'Classic Turquoise', 'js_composer' ) => 'info',
         __( 'Classic Green', 'js_composer' ) => 'success',
         __( 'Classic Orange', 'js_composer' ) => 'warning',
         __( 'Classic Red', 'js_composer' ) => 'danger',
         __( 'Classic Black', 'js_composer' ) => "inverse"

      )+ getVcShared( 'colors-dashed' );
      vc_add_param( 'vc_btn', array(
          'type' => 'dropdown',
          'heading' => __( 'Color', 'js_composer' ),
          'param_name' => 'color',
          'value' => $colors_arr_btn_3,
          'description' => __( 'Button color.', 'js_composer' ),
          'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
          'std' => 'grey',
          'dependency' => array(
            'element' => 'style',
            'value_not_equal_to' => array( 'custom' )
          ),
      ));
      /* ======================================================================= */
      /* contact-form-7                                                          */
      /* ======================================================================= */
      if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
            vc_add_param( 'contact-form-7', array(
                'type'            => 'dropdown',
                'heading'         => __( 'Contact Form Style', 'dahztheme' ),
                'param_name'      => 'html_class',
                'admin_label'     => true,
                'value'           => array(
                                        __( 'No', 'dahztheme' ) => '',
                                        __( 'Transparent', 'dahztheme' ) => 'form7_transparent',
                                        __( 'Underline', 'dahztheme' ) => 'form7_underline',

                                     ),
                'description' => __( 'Select type of style', 'dahztheme' )
            ));
      }

      /* ======================================================================= */
      /* masterslider                                                            */
      /* ======================================================================= */
      if ( is_plugin_active( 'masterslider/masterslider.php' ) ) :
          vc_remove_param( 'masterslider_pb', 'id' );

          if ( !function_exists( 'custom_ms_list' ) ) :
              function custom_ms_list() {
                  global $mspdb;

                  $id_as_key = isset( $id_as_key ) ? $id_as_key : null;

                  if ( $sliders_data = $mspdb->get_sliders_list( $limit = 0, $offset  = 0, $orderby = 'ID', $sort = 'DESC' ) ) {
                      // stores sliders 'ID' and 'title'
                      $sliders_name_list = array( 'None Selected' => '' );

                      foreach ( $sliders_data as $slider_data ) {
                          if( $id_as_key )
                              $sliders_name_list[ $slider_data['ID'] ]    = $slider_data['title'];
                          else
                              $sliders_name_list[ $slider_data['title'] ] = $slider_data['ID'];
                      }

                      return $sliders_name_list;
                  }

                  return array();
              }
          endif;

          vc_add_param( 'masterslider_pb', array(
              'type'        => 'dropdown',
              'heading'     => __( 'Master Slider', 'dahztheme' ),
              'param_name'  => 'id',
              'weight'      => 1,
              'value'       => custom_ms_list(),
              'description' => __( 'Select slider from list', 'dahztheme' )
          ) );

      endif;
	}

  }
add_action( 'admin_init', 'df_vc_update_existing_shortcodes' );