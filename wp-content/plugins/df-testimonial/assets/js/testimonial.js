jQuery(document).ready(function($) {
	if ( $( 'div' ).hasClass('slider-testimonial') ) {
		$('.slider-testimonial').each(function(){
			$('.slider-testimonial').owlCarousel({
				rtl: ( $('body').hasClass('rtl') ) ? true : false,
				margin: 30,
				items: 1,
				autoHeight: true,
			});
			$('.slider-testimonial').addClass('owl-carousel owl-theme');

			var height_slider = $(this).find('.active').height();

			$(this).find('.owl-height').css('height', height_slider)
		});
	}
});

jQuery(window).load(function() {
	if ( jQuery( 'div' ).hasClass('slider-testimonial') ) {
		jQuery('.slider-testimonial').each(function(){
			jQuery('.slider-testimonial').owlCarousel({
				rtl: ( jQuery('body').hasClass('rtl') ) ? true : false,
				margin: 30,
				items: 1,
				autoHeight: true,
			});
			jQuery('.slider-testimonial').addClass('owl-carousel owl-theme');

			var height_slider = jQuery(this).find('.active').height();

			jQuery(this).find('.owl-height').css('height', height_slider)
		});
	}
});