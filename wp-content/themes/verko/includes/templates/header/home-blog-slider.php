<div class="df-slider-header">
	<?php
	$df_options  = get_option( 'df_options' );
	$slider_blog = $df_options['slider_sc'];
	echo do_shortcode( $slider_blog );
	?>
</div>
