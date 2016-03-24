jQuery(document).ready(function($) {

	// ================================================================
	// Row Parallax
	// ================================================================
	// if(!dfGlobals.isMobile){
 //       	setTimeout(function(){
	// 	   jQuery('.row-parallax-bg').each(function(){
	// 	    var $_this = jQuery(this),
	// 	      speed_prl = $_this.data("prlx-speed");
	// 	    jQuery(this).parallax("50%", speed_prl);
	// 	    jQuery('.row-parallax-bg').addClass("parallax-bg-done");
	// 	  });
 //        }, 1000);
	//  }

	// jQuery(window).on("debouncedresize", function( event ) {

	//         jQuery(".vc_row.vc_row-fluid").each(function(){
	//         var $_this = $(this),
	//             $_this_min_height = $_this.attr("data-min-height");
	//         if($.isNumeric($_this_min_height)){
	//             $_this.css({
	//                 "minHeight": $_this_min_height + "px"
	//             });
	//         }else if(!$_this_min_height){
	//             $_this.css({
	//                 "minHeight": 0
	//             });
	//         }else if($_this_min_height.search( '%' ) > 0){
	//             $_this.css({
	//                 "minHeight": $(window).height() * (parseInt($_this_min_height)/100) + "px"
	//             });
	//         }else{
	//             $_this.css({
	//                 "minHeight": $_this_min_height
	//             });
	//         }
	//     });

	// }).trigger( "debouncedresize" );

	// ================================================================
	// tooltip
	// ================================================================
	if ($('.tltp').length >= 1) {
	    jQuery(".tltp[title]").tooltip();
	}

	// ================================================================
	// gmaps
	// ================================================================
	$('.advanced-gmaps').each(function() {

	    var $this 			  = $(this),
        	$id 			  = $this.attr('id'),
        	$zoom 			  = parseInt( $this.attr('data-zoom') ),
        	$latitude 		  = $this.attr('data-latitude'),
        	$longitude 		  = $this.attr('data-longitude'),
        	$address 		  = $this.attr('data-address'),
        	$latitude_2 	  = $this.attr('data-latitude2'),
        	$longitude_2 	  = $this.attr('data-longitude2'),
        	$address_2 		  = $this.attr('data-address2'),
        	$pin_icon 		  = $this.attr('data-pin-icon'),
        	$pan_control 	  = $this.attr('data-pan-control') === "true" ? true : false,
        	$map_type_control = $this.attr('data-map-type-control') === "true" ? true : false,
        	$scale_control 	  = $this.attr('data-scale-control') === "true" ? true : false,
        	$draggable 		  = $this.attr('data-draggable') === "true" ? true : false,
        	$zoom_control 	  = $this.attr('data-zoom-control') === "true" ? true : false,
        	$modify_coloring  = $this.attr('data-modify-coloring') === "true" ? true : false,
        	$saturation 	  = $this.attr('data-saturation'),
        	$hue 			  = $this.attr('data-hue'),
        	$lightness 		  = $this.attr('data-lightness'),
        	$styles;

	    if ( $modify_coloring == true ) {
	        var $styles = [{
	            stylers: [{
	                hue: $hue
	            }, {
	                saturation: $saturation
	            }, {
	                lightness: $lightness
	            }, {
	                featureType: "landscape.man_made",
	                stylers: [{
	                    visibility: "on"
	                }]
	            }]
	        }];
	    }

	    var map;

	    function initialize() {

	    	var bounds = new google.maps.LatLngBounds();

	     	var mapOptions = {
		        zoom: $zoom,
		        panControl: $pan_control,
		        zoomControl: $zoom_control,
		        mapTypeControl: $map_type_control,
		        scaleControl: $scale_control,
		        draggable: $draggable,
		        scrollwheel: false,
		        mapTypeId: google.maps.MapTypeId.ROADMAP,
		        styles: $styles
		    };

		    map = new google.maps.Map(document.getElementById($id), mapOptions);
		    map.setTilt(45);

			// Multiple Markers
            var markers = [];
            var infoWindowContent = [];

            if ( $latitude != '' && $longitude != '' ) {
                markers[0] = [$address, $latitude, $longitude];
                infoWindowContent[0] = [$address];
            }

            if ($latitude_2 != '' && $longitude_2 != '') {
                markers[1] = [$address_2, $latitude_2, $longitude_2];
                infoWindowContent[1] = [$address_2];
            }

            var infoWindow = new google.maps.InfoWindow(),
            marker, i;

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
	                position: position,
	                map: map,
	                title: markers[i][0],
	                icon: $pin_icon
            	});

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
	                return function() {
	                    if(infoWindowContent[i][0].length > 1) {
	                      	infoWindow.setContent('<div class="info_content"><p>'+infoWindowContent[i][0]+'</p></div>');
	                  	}
	                  	infoWindow.open(map, marker);
	              	}
	          	})(marker, i));

	            map.fitBounds(bounds);

	        }

            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom($zoom);
                google.maps.event.removeListener(boundsListener);
            });

            // console.log('google map should be initialised');
	    }
	    initialize();

	});

	// ================================================================
	// services
	// ================================================================
	if ( $('.animated-service').length ) {
		$('.animated-service').waypoint( function( direction ) {
		    $( this ).each( function() {
		        var animation = $( this ).attr('data-animation-service');
		        $( this ).addClass( animation );
		    });
		}, { offset:'85%' } );
	}

	// ================================================================
	// modal
	// ================================================================

	if ($('.df-modal-box-sc').length != '0') {
	(function() {
		var triggerBttn 	= document.getElementsByClassName( 'overlay-show' ),
		overlay 			= document.querySelector( 'div.df-overlay' ),
		closeBttn 			= overlay.querySelector( 'div.df-overlay-close' );
		transEndEventNames 	= {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ bsfmodernizr.prefixed( 'transition' ) ],
		support = { transitions : bsfmodernizr.csstransitions };
		function toggleOverlay(id) {
			var ovv = 'div.df-overlay.'+id;
			joverlay = document.querySelector( ovv );
			overlay = jQuery(ovv);
			/* firefox transition issue fix of overflow hidden */
			var modal_height = overlay.find('.df_modal').outerHeight(); //modal height
			var window_height = jQuery(window).outerHeight(); //window height
			if(window_height < modal_height) //if window height is less than modal height
				jQuery('html').css({'overflow':'hidden'}); //add overflow hidden to html
			if( overlay.hasClass('df-open') ) {
				overlay.removeClass('df-open');
				overlay.addClass('df-close');
				//classie.remove( overlay, 'df-open' );
				//classie.add( overlay, 'df-close' );
				var onEndTransitionFn = function( ev ) {
					if( support.transitions ) {
						if( ev.propertyName !== 'visibility' ) return;
						this.removeEventListener( transEndEventName, onEndTransitionFn );
					}
					overlay.removeClass('df-close');
					//classie.remove( overlay, 'df-close' );
				};
				if( support.transitions ) {
					joverlay.addEventListener( transEndEventName, onEndTransitionFn );
					overlay.removeClass('df-close');
					if(window_height < modal_height) //remove overflow hidden
						jQuery('html').css({'overflow':'auto'});
				}
				else {
					onEndTransitionFn();
				}
			}
			else if( ! overlay.hasClass('df-close') ) {
				overlay.addClass('df-open');
				//classie.add( overlay, 'df-open' );
			}
		}
		var corner_to = jQuery('.overlay-show-cornershape').find('path').attr('d');
		function overlay_cornershape_f(id){
			var ovv = 'div.overlay-cornershape.'+id;
			var joverlay_cornershape = document.querySelector( ovv );
			var overlay_cornershape = jQuery(ovv);
			var s = Snap( joverlay_cornershape.querySelector( 'svg' ) ),
				path = s.select( 'path' ),
				pathConfig = {
					from : 'm 0,0 1439.999975,0 0,805.99999 0,-805.99999 z ',
					to : ' m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z  '
				};
			//var overlay_cornershape = document.querySelector( 'div.overlay-cornershape' );
			if( overlay_cornershape.hasClass('df-open') ) {
				overlay_cornershape.removeClass('df-open');
				overlay_cornershape.addClass('df-close');
				//classie.remove( overlay_cornershape, 'df-open' );
				//classie.add( overlay_cornershape, 'df-close' );
				var onEndTransitionFn = function( ev ) {
					overlay_cornershape.removeClass('df-close');
					//classie.remove( overlay_cornershape, 'df-close' );
				};
				path.animate( { 'path' : pathConfig.from }, 400, mina.linear, onEndTransitionFn );
			}
			else if( ! overlay_cornershape.hasClass('df-close') ) {
				overlay_cornershape.addClass('df-open');
				//classie.add( overlay_cornershape, 'df-open' );
				path.animate( { 'path' : pathConfig.to }, 400, mina.linear );
			}
		}
		function overlay_genie_f(id) {
			var ovv = 'div.overlay-genie.'+id;
			var joverlay_genie = document.querySelector( ovv );
			var overlay_genie = jQuery(ovv);
			var gs = Snap( joverlay_genie.querySelector( 'svg' ) ),
				geniepath = gs.select( 'path' ),
				steps = joverlay_genie.getAttribute( 'data-steps' ).split(';'),
				stepsTotal = steps.length;
			if( overlay_genie.hasClass('df-open') ) {
				var pos = stepsTotal-1;
				overlay_genie.removeClass('df-open');
				overlay_genie.addClass('df-close');
				//classie.remove( joverlay_genie, 'df-open' );
				//classie.add( joverlay_genie, 'df-close' );
				var onEndTransitionFn = function( ev ) {
						overlay_genie.removeClass('df-close');
					},
					nextStep = function( pos ) {
						pos--;
						if( pos < 0 ) return;
						geniepath.animate( { 'path' : steps[pos] }, 60, mina.linear, function() {
							if( pos === 0 ) {
								onEndTransitionFn();
							}
							nextStep(pos);
						} );
					};
				nextStep(pos);
			}
			else if( !overlay_genie.hasClass('df-close') ) {
				var pos = 0;
				overlay_genie.addClass('df-open');
				//classie.add( joverlay_genie, 'df-open' );
				var nextStep = function( pos ) {
					pos++;
					if( pos > stepsTotal - 1 ) return;
					geniepath.animate( { 'path' : steps[pos] }, 60, mina.linear, function() { nextStep(pos); } );
				};
				nextStep(pos);
			}
		}
		function shuffle_overlay_box(array) {
			var currentIndex = array.length
			, temporaryValue
			, randomIndex
			;
			// While there remain elements to shuffle...
			while (0 !== currentIndex) {
				// Pick a remaining element...
				randomIndex = Math.floor(Math.random() * currentIndex);
				currentIndex -= 1;
				// And swap it with the current element.
				temporaryValue = array[currentIndex];
				array[currentIndex] = array[randomIndex];
				array[randomIndex] = temporaryValue;
			}
			return array;
		}
		function overlay_boxes_f(id) {
			var ovv = 'div.overlay-boxes.'+id;
			var joverlay_boxes = document.querySelector( ovv );
			var overlay_boxes = jQuery(ovv);
			var boxes_path = [].slice.call( joverlay_boxes.querySelectorAll( 'svg > path' ) ),
			pathsTotal = boxes_path.length;
			var cnt = 0;
			shuffle_overlay_box( boxes_path );
			if( overlay_boxes.hasClass('df-open') ) {
				overlay_boxes.removeClass('df-open');
				overlay_boxes.addClass('df-close');
				//classie.remove( joverlay_boxes, 'df-open' );
				//classie.add( joverlay_boxes, 'df-close' );
				boxes_path.forEach( function( p, i ) {
					setTimeout( function() {
						++cnt;
						p.style.display = 'none';
						if( cnt === pathsTotal ) {
							overlay_boxes.removeClass('df-close');
							//classie.remove( joverlay_boxes, 'df-close' );
						}
					}, i * 30 );
				});
			}
			else if( !overlay_boxes.hasClass('df-close') ) {
				overlay_boxes.addClass('df-open');
				//classie.add( joverlay_boxes, 'df-open' );
				boxes_path.forEach( function( p, i ) {
					setTimeout( function() {
						p.style.display = 'block';
					}, i * 30 );
				});
			}
		}
		jQuery(window).load(function(){
			var onload_modal_array = new Array();
			jQuery('.df-onload').each(function(index){
				onload_modal_array.push(jQuery(this));
				setTimeout(function() {
					onload_modal_array[index].trigger('click');
				}, parseInt(jQuery(this).data('onload-delay'))*1000);
			});
			jQuery('.df-vimeo iframe').each(function(index, element) {
				var player_id = jQuery(this).attr('id');
				var iframe = jQuery(this)[0],
					player = $f(iframe);
				player.addEvent('ready', function() {
					player.addEvent('pause');
					player.addEvent('finish');
				});
	        });
		});
		jQuery(document).ready(function(){
			jQuery('.df-overlay').each(function(){
				jQuery('body').append(jQuery(this).clone());
				jQuery(this).remove();
			});
			jQuery('.df-overlay').attr('style','');
			jQuery('.overlay-show').each(function(index, element) {
	            var class_id = jQuery(this).data('class-id');
				jQuery('.'+class_id).find('.df-vimeo iframe').attr('id','video_'+class_id);
				jQuery('.'+class_id).find('.df-youtube iframe').attr('id','video_'+class_id);
	        });
			var modal_count=0;
			jQuery('.overlay-show').click(function(event){
			event.stopPropagation();
				var class_id = jQuery(this).data('class-id');
				//jQuery('.'+class_id).find('.df-vimeo iframe').attr('id','video_'+class_id);
				jQuery('.'+class_id).find('.df-vimeo iframe').html(jQuery('.df-vimeo iframe').html());
				jQuery('.'+class_id).addClass(jQuery(this).data('overlay-class'));
				setTimeout(function() {
					jQuery('body, html').addClass('df_modal-body-open');
					toggleOverlay(class_id);
					if(jQuery('.'+class_id).hasClass('overlay-doorhorizontal')){
						setTimeout(function() {
							content_check(class_id);
						}, 500);
					}else{
						content_check(class_id);
					}
				}, 500);
			})
			jQuery('.overlay-show-cornershape').click(function(event){
				event.stopPropagation();
				var class_id = jQuery(this).data('class-id')
				//jQuery('.overlay-cornershape').removeClass('overlay-cornershape');
				jQuery('.'+class_id).addClass('overlay-cornershape');
				overlay_cornershape_f(class_id);
				jQuery('body, html').addClass('df_modal-body-open');
				content_check(class_id);
			})
			jQuery('div.overlay-cornershape div.df-overlay-close').click(function(event){
				event.stopPropagation();
				var class_id = jQuery(this).parents('div.overlay-cornershape').data('class');
				overlay_cornershape_f(class_id);
				jQuery('body, html').removeClass('df_modal-body-open');
			})
			jQuery('.overlay-show-boxes').click(function(event){
				event.stopPropagation();
				var class_id = jQuery(this).data('class-id')
				//jQuery('.overlay-boxes').removeClass('overlay-boxes');
				jQuery('.'+class_id).addClass('overlay-boxes');
				overlay_boxes_f(class_id);
				jQuery('body, html').addClass('df_modal-body-open');
				content_check(class_id);
			});
			jQuery('div.overlay-boxes div.df-overlay-close').click(function(event){
				event.stopPropagation();
				var class_id = jQuery(this).parents('div.overlay-boxes').data('class');
				overlay_boxes_f(class_id);
				jQuery('body, html').removeClass('df_modal-body-open');
			});
			jQuery('.overlay-show-genie').click(function(event){
				var class_id = jQuery(this).data('class-id')
				//jQuery('.overlay-genie').removeClass('overlay-genie');
				jQuery('.'+class_id).addClass('overlay-genie');
				overlay_genie_f(class_id);
				jQuery('body, html').addClass('df_modal-body-open');
				content_check(class_id);
			});
			jQuery('div.overlay-genie div.df-overlay-close').click(function(event){
				event.stopPropagation();
				var class_id = jQuery(this).parents('div.overlay-genie').data('class');
				overlay_genie_f(class_id);
				jQuery('body, html').removeClass('df_modal-body-open');
			})
			jQuery('.df-overlay .df-overlay-close').click(function(event){
				event.stopPropagation();
				var id = jQuery(this).parents('.df-overlay').data('class');
				toggleOverlay(id);
				jQuery('body, html').removeClass('df_modal-body-open');
				if(jQuery(this).parent().find(".df-vimeo").length){
					var player_id = jQuery(this).parent().find(".df-vimeo iframe").attr('id');
					var iframe = jQuery("#"+player_id)[0],
					player = $f(iframe);
					player.api('pause');
				} else {
					var player_id = jQuery(this).parent().find(".df-youtube iframe").attr('id');
					var src = jQuery("#"+player_id).attr("src");
					jQuery("#"+player_id).attr("src",src);
				}
			});
			jQuery('.df-overlay .df_modal').click(function(event){
				event.stopPropagation();
			})
			jQuery('.df-overlay').click(function(event){
				event.stopPropagation();
				jQuery(this).find('.df-overlay-close').trigger('click');
			})
		})
		function content_check(id){
			var ch = jQuery('.'+id).find('.df_modal-content').height();
			var wh = jQuery(window).height();
			if(ch>wh){
				jQuery('.'+id).addClass('df_modal-auto-top');
			}
			else{
				jQuery('.'+id).removeClass('df_modal-auto-top');
			}
		}
	})();
	} /*end if modal exsist*/

	// ================================================================
	// anchor
	// ================================================================
		if ($("#menu-primary-menu .anchor a").length > 0) {

			$( "<div class='anchor-bullet-container'></div>" ).insertBefore( "#wrapper" );

			$('#menu-primary-menu .anchor a').each(function() {
				var href = $.attr(this, 'href'),
					cleanUrl = href.replace(/#/g, ''),
					label_url = $(this).text();

				$( ".anchor-bullet-container" ).append( $( "<a href="+href+" class='anchor anchor-bullet "+cleanUrl+" '><span>"+label_url+"</span><i></i></a>" ) );

		    	$('.anchor-bullet').on('click' , function(e) {
		    		e.preventDefault();
		    		$('.anchor-bullet').removeClass('active');
		    		$(this).addClass('active');
		    	});

		    	if ( href.length != 0 ) {
			    	$(href).waypoint( function( direction ) {

					    var href_class = '.'+ cleanUrl;
			    		$('.anchor-bullet').removeClass('active');
						$('.anchor-bullet-container').find(href_class).addClass('active');


					}, { offset:'10%' } );
		    	};

		    });
		    $(window).on('scroll', function() {
			    var scrollTop = $(this).scrollTop();
			    if (scrollTop < 20) {
		    		$('.anchor-bullet').removeClass('active');
			    }
			});
		}

		$(".anchor, .anchor a, .main_menu a").on('click', function(e) {
			e.stopPropagation();
			e.preventDefault();

			var href = $.attr(this, 'href'),
		    	bodyClass = $('body'),
		    	height = 0;

		    if ( bodyClass.hasClass( 'df-navibar-center-active' ) ) {
	    		height = $('#wpadminbar').length ? -138 : -108;
		    } else {
			    height = $('#wpadminbar').length ? -90 : -60;
		    }

		    if (!dfGlobals.isMobile) {

				$(window).scrollTo(href,2000, {
					axis:'y',
					interrupt: true,
					offset:height
				});

			} else {

				scrollTo = $(href).offset().top;
			    $('html, body').animate({
			        scrollTop: Math.round(scrollTo)
			    }, 1500);

			};

		});
		/*end anchor*/

	// =========================================================================================
	// 10. blog slider
	// =========================================================================================
	if ($('.blog-sc-slider').length != '0') {
		$('.blog-sc-slider').each(function() {

			var class_slider = $(this).find('#blog-sc-slider').attr('class'),
				slider_length = $(this).find('#blog-sc-slider').attr('data-image-length');
				class_slider = '.'+class_slider;
		    if ($('body').hasClass('rtl')) {
		        var dir_rtl = true;
		    } else {
		        var dir_rtl = false;
		    }
			$(this).find('#blog-sc-slider').addClass('owl-carousel owl-theme');

			$(class_slider).owlCarousel({
		        margin: 30,
		        rtl:dir_rtl,
		        nav: false,
		        dots: true,
				responsive:{
				    0:{
				        items:1
				    },
				    600:{
				        items:2
				    },
				    1000:{
				        items:2
				    },
					1200:{
				        items:slider_length
				    }
				},
		        onTranslated: findHeightDragging,
		        navText: [
		            "<i class='df-arrow-grand-left'></i>",
		            "<i class='df-arrow-grand-right'></i>"
		        ]
		    });

			jQuery(window).load(function() {
				var max = -1;
				$(class_slider).find('.owl-item.active').each(function( i ) {
				    var h = $(this).height();
				    max = h > max ? h : max;
				});
				$(class_slider).find('.owl-stage-outer').css('height', max);
			});

			var max = -1;
			$(class_slider).find('.owl-item.active').each(function( i ) {
			    var h = $(this).height();
			    max = h > max ? h : max;
			});
			$(class_slider).find('.owl-stage-outer').css('height', max);

		    // If next or prev button is clicked get max height
		    $(class_slider).find(".owl-prev, .owl-next").click(function(e){
		        var max = -1;
		        $(class_slider).find('.owl-item.active').each(function( i ) {
		            var h = $(this).height();
		            max = h > max ? h : max;
		        });
		        $(class_slider).find('.owl-stage-outer').css('height', max);
		    });

		    // If grab get max height
		    function findHeightDragging(){
		        var max = -1;
		        $(class_slider).find('.owl-item.active').each(function( i ) {
		            var h = $(this).height();
		            max = h > max ? h : max;
		        });
		        $(class_slider).find('.owl-stage-outer').css('height', max);
		    }
		});
	};

	// =========================================================================================
	// All Carousel
	// =========================================================================================

	$('.df-slider-shortcode').each(function() {
	    var $id_df_slider = $(this).attr('id'),
	        $id_df_slider = '#'+ $id_df_slider,
	        item 		  = $(this).attr('data-df-items'),
	        pagination 	  = Boolean($(this).attr('data-df-pagination')),
	        auto_play 	  = Boolean($(this).attr('data-df-auto-play'));

			if ($('body').hasClass('rtl')) {
			    var dir_rtl = true;
			} else {
			    var dir_rtl = false;
			}

			$(this).addClass('owl-carousel owl-theme');

			$($id_df_slider).owlCarousel({
				rtl: dir_rtl,
			    paginationSpeed : 600,
				responsive: {
					    0:{
					        items:1
					    },
					    600:{
					        items:2
					    },
					    1000:{
					        items:2
					    },
						1200:{
					        items:item
					    }
				},
			    dots:  pagination,
			    autoplay : auto_play,
			    onTranslated: findHeightDragging,
			});


			var full_df_slider =  $('.full-width-content .df-slider-shortcode');
			if (full_df_slider.length <= 1) {
			    var windowWidth = jQuery(".df_container-fluid").width(),
			        df_slider_active = $('.full-width-content .df-slider-shortcode');

			    df_slider_active.parent().css('width', windowWidth);

			};

			jQuery(window).load(function() {
		        var max = -1;
		        $($id_df_slider).find('.owl-item.active').each(function( i ) {
		            var h = $(this).height();
		            max = h > max ? h : max;
		        });
		        $($id_df_slider).find('.owl-stage-outer').css('height', max);
			});

		    // If next or prev button is clicked get max height
		    $($id_df_slider).find(".owl-prev, .owl-next").click(function(e){
		        var max = -1;
		        $($id_df_slider).find('.owl-item.active').each(function( i ) {
		            var h = $(this).height();
		            max = h > max ? h : max;
		        });
		        $($id_df_slider).find('.owl-stage-outer').css('height', max);
		    });

		    // If grab get max height
		    function findHeightDragging(){
		        var max = -1;
		        $($id_df_slider).find('.owl-item.active').each(function( i ) {
		            var h = $(this).height();
		            max = h > max ? h : max;
		        });
		        $($id_df_slider).find('.owl-stage-outer').css('height', max);
		    }

	}); /*end each #df-slider-shortcode*/

});/*end document ready*/

jQuery(window).load(function() {

});