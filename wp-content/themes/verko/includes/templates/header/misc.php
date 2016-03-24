<?php
$_is_customizing    = is_customize_preview();
$df_options = get_option( 'df_options' );

$inline_header_search_css = $inline_offcanvas_css = $inline_wpml_icon_css = '';
$show_header_search       = ( $df_options['show_header_search'] == 1 );
$show_offcanvas 	      = ( $df_options['show_offcanvas'] == 1 );
// $show_wpml_icon 	      = ( $df_options[ 'show_wpml_icon' ] == 1 );

if( $_is_customizing ){
 $show_header_search = $show_offcanvas = true;
 // $show_wpml_icon = true;
 $inline_header_search_css = ( $df_options['show_header_search'] == 1 ) ? 'style=display:inline-block;' : 'style=display:none;';
 $inline_offcanvas_css     = ( $df_options['show_offcanvas'] == 1 ) ? 'style=display:inline-block;' : 'style=display:none;';
 // $inline_wpml_icon_css     = ( $df_options['show_wpml_icon'] == 1 ) ? 'style=display:inline-block;' : 'style=display:none;';
}

?>

<ul>

    <?php //if( $show_wpml_icon ):  ?>
<!--
    	<li class="wpml-languages" <?php //echo esc_attr( $inline_wpml_icon_css ); ?>><i class="md-public"></i></a>
    		<ul class="languages-list sub-nav">
    			<?php //echo language_selector_flags(); ?>
    		</ul>
    	</li> -->

    <?php //endif; ?>

	<?php if( $show_header_search ): ?>

		<li class='df-ajax-search' <?php echo esc_attr( $inline_header_search_css ); ?>><i class="md-search"></i></li>

	<?php endif; ?>

	<?php if( $show_offcanvas ): ?>

			<li class='df-menu-off-canvas' <?php echo esc_attr( $inline_offcanvas_css ); ?>><i class="md-menu"></i></li>
	<?php else: ?>
			<li class='df-menu-off-canvas df-mobile-off-canvas'><i class="md-menu"></i></li>
	<?php endif; ?>

</ul>
