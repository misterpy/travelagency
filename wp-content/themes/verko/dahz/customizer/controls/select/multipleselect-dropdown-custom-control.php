<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Customize for multiple select, extend the WP customizer
 *
 * @since 1.2.0
 */
  class DAHZ_Multipleselect_Dropdown_Control extends WP_Customize_Control {
    public $type = 'multiple-select';
      /**
       * Render the content on the theme customizer page
       */
    public function render_content() {
      ?>
        <label>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <select <?php $this->link(); ?> multiple="multiple" style="height: 156px;">
            <?php
              foreach ( $this->choices as $value => $label ) {
                $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
              }
            ?>
          </select>
        </label>
      <?php
    }
  }