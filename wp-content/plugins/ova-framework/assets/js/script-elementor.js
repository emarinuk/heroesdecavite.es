(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
		/* Menu Shrink */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_menu.default', function(){

			$( '.ova_menu_clasic .ova_openNav' ).on( 'click', function(){
				$( this ).closest('.ova_wrap_nav').find( '.ova_nav' ).removeClass( 'hide' );
				$( this ).closest('.ova_wrap_nav').find( '.ova_nav' ).addClass( 'show' );
				$( '.ova_menu_clasic  .ova_closeCanvas' ).css( 'width', '100%' );

				
				$( 'body' ).css( 'background-color', 'rgba(0,0,0,0.4)' );
				
			});

			$( '.ova_menu_clasic  .ova_closeNav' ).on( 'click', function(){
				$( this ).closest('.ova_wrap_nav').find( '.ova_nav' ).removeClass( 'show' );
				$( this ).closest('.ova_wrap_nav').find( '.ova_nav' ).addClass( 'hide' );
				$( '.ova_closeCanvas' ).css( 'width', '0' );


				
				$( 'body' ).css( 'background-color', 'transparent' );
				
			});

			// Display in mobile
			$( '.ova_menu_clasic li.menu-item button.dropdown-toggle').off('click').on( 'click', function() {
				$(this).parent().toggleClass('active_sub');
			});

			
			if( $('.ovamenu_shrink').length > 0 && $( 'body' ).data('elementor-device-mode') == 'desktop' ){
			
				$( '<div class="mask_header_shrink" style="position: relative; height: 0;"></div>' ).insertAfter('.ovamenu_shrink.elementor-hidden-phone');
				
				var header = $('.ovamenu_shrink.elementor-hidden-phone');
				var header_shrink_height = header.height();
				

				$(window).scroll(function () {
						
						var scroll = $(this).scrollTop();

						if (scroll >= header_shrink_height+150 ) {
							header.addClass( 'active_fixed' );
							$('.mask_header_shrink').css('height',header_shrink_height);
				        } else {
				            header.removeClass('active_fixed');
				            $('.mask_header_shrink').css('height','0');
				        }
				});
			}

			if( $('.ovamenu_shrink_mobile').length > 0 && $( 'body' ).data('elementor-device-mode') != 'desktop' ){
				
				if( !$('.show_mask_header_mobile').hasClass( 'mask_header_shrink_mobile' ) ){
					$( '<div class="show_mask_header_mobile mask_header_shrink_mobile" style="position: relative; height: 0;"></div>' ).insertAfter('.ovamenu_shrink_mobile');
					
				}
				
				var header = $('.ovamenu_shrink_mobile');
				var header_shrink_height = header.outerHeight(true);
				var wd = header.outerWidth(true);

				$(window).scroll(function () {

					var scroll = $(this).scrollTop();

					if (scroll >= header_shrink_height+150 ) {
						header.addClass( 'active_fixed' );
						$('.mask_header_shrink_mobile').css('height',header_shrink_height);
					} else {
						header.removeClass('active_fixed');
						$('.mask_header_shrink_mobile').css('height','0');
					}
				});
			}


			

			

		});


		/*  ova_muzze_according */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_muzze_according.default', function(){
			// $( ".accor-muzze-content .icon-accor i" ).on( "click", function() {
			// 	$(".accor-muzze-content .icon-accor .fa-angle-up").not(this).removeClass('fa-angle-up').addClass('fa-angle-down');
			// 	$(this).toggleClass("fa-angle-up fa-angle-down");

			// });
		});


		/* Menu Henbergar */
		elementorFrontend.hooks.addAction('frontend/element_ready/henbergar_menu.default', function(){

			$( '.ova_menu_canvas .ova_openNav' ).on( 'click', function(){
				// $( this ).closest('.ova_wrap_nav').find( '.ova_nav_canvas' ).removeClass( 'hide' );
				$( this ).closest('.ova_wrap_nav').find( '.ova_nav_canvas' ).addClass( 'show' );
				$( '.ova_menu_canvas .ova_closeCanvas' ).css( 'width', '100%' );

				$( this ).closest('.ova_wrap_nav').find( '.ova_nav_canvas' ).addClass('active');


				$( 'body' ).css( 'background-color', 'rgba(0,0,0,0.2)' );
				
			});

			$( '.ova_menu_canvas .ova_closeNav' ).on( 'click', function(){
				$( this ).closest('.ova_wrap_nav').find( '.ova_nav_canvas' ).removeClass( 'show' );
				// $( this ).closest('.ova_wrap_nav').find( '.ova_nav_canvas' ).addClass( 'hide' );
				$( '.ova_menu_canvas .ova_closeCanvas' ).css( 'width', '0' );

				// $( this ).closest('.ova_wrap_nav').find( '.ova_nav_canvas' ).removeClass('active');


				
				$( 'body' ).css( 'background-color', 'transparent' );
				
			});

			// Display in mobile
			$( '.ova_menu_canvas li.menu-item button.dropdown-toggle').off('click').on( 'click', function() {
				$(this).parent().toggleClass('active_sub');
			});
			


		});

		/* Header Search */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_search.default', function(){
			$( '.wrap_search_muzze_popup .icon-search' ).on( 'click', function(){
				$( this ).closest( '.wrap_search_muzze_popup' ).addClass( 'show' );
			});

			$( '.btn_close' ).on( 'click', function(){
				$( this ).closest( '.wrap_search_muzze_popup' ).removeClass( 'show' );
				
			});
		});

		/* End Header Search */

		/* Slide Show */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_slideshow.default', function(){

			function fadeInReset(element) {
				$(element).find('*[data-animation]').each(function(){
					var animation = $(this).data( 'animation' );
					$(this).removeClass( 'animated' );
					$(this).removeClass( animation );
					$(this).css({ opacity: 0 });
				});
			}

			function fadeIn(element) {

				// Sub Title
				var $title = $(element).find( '.active .elementor-slide-subtitle' )
				var animation_title = $title.data( 'animation' );
				var duration_title  = parseInt( $title.data( 'animation_dur' ) );
				

				setTimeout(function(){
					$title.addClass(animation_title).addClass('animated').css({ opacity: 1 });
				}, duration_title);


            /* Title */
            var $sub_title = $(element).find( '.active .elementor-slide-title' );
            var animation_sub_title = $sub_title.data( 'animation' );
            var duration_sub_title  = parseInt( $sub_title.data( 'animation_dur' ) );


            setTimeout(function(){
               $sub_title.addClass(animation_sub_title).addClass('animated').css({ opacity: 1 });
            }, duration_sub_title);

            /* Description */
            var $desc = $(element).find( '.active .elementor-slide-description' );
            var animation_desc = $desc.data( 'animation' );
            var duration_desc  = parseInt( $desc.data( 'animation_dur' ) );


            setTimeout(function(){
               $desc.addClass(animation_desc).addClass('animated').css({ opacity: 1 });
            }, duration_desc);

            /* Button */
            var $button = $(element).find( '.active .elementor-slide-button' );
            var animation_button = $button.data( 'animation' );
            var duration_button  = parseInt( $button.data( 'animation_dur' ) );

            setTimeout(function(){
               $button.addClass(animation_button).addClass('animated').css({ opacity: 1 });
            }, duration_button);

            
         }

         $(document).ready(function(){
            $('.elementor-slides').each(function(){

               var owl = $(this);
               var data = owl.data("owl_carousel");

               owl.on('initialized.owl.carousel', function(event) {

                  fadeIn(event.target);
               });

               owl.owlCarousel(
                  data
                  );
               
               owl.on('translate.owl.carousel', function(event){
                  fadeInReset(event.target);
                  owl.trigger('stop.owl.autoplay');
                  owl.trigger('play.owl.autoplay');
               });

               owl.on('translated.owl.carousel', function(event) {
                  fadeIn(event.target);
                  owl.trigger('stop.owl.autoplay');
                  owl.trigger('play.owl.autoplay');
               });
            });    	
         });
         
      });
		/* End Slide Show */


		/* Slide Testimonial */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_testimonial.default', function(){
			$(".testimonial-slider-ver-1").each(function(){
				var owlsl = $(this) ;
				var owlsl_df = {
					margin: 0, 
					responsive: false, 
					smartSpeed:500,
					autoplay:false,
					autoplayTimeout: 6000,
					items:1,
					loop:true, 
					nav: true, 
					dots: true,
					center:false,
					autoWidth:false,
					thumbs:false, 
					autoplayHoverPause: true,
					slideBy: 1,
					prev:'<i class="arrow_carrot-left"></i>',
					next:'<i class="arrow_carrot-right"></i>',
				};
				var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};
				owlsl_ops = $.extend({}, owlsl_df, owlsl_ops);
				owlsl.owlCarousel({
					autoWidth: owlsl_ops.autoWidth,
					margin: owlsl_ops.margin,
					items: owlsl_ops.items,
					loop: owlsl_ops.loop,
					autoplay: owlsl_ops.autoplay,
					autoplayTimeout: owlsl_ops.autoplayTimeout,
					center: owlsl_ops.center,
					nav: owlsl_ops.nav,
					dots: owlsl_ops.dots,
					thumbs: owlsl_ops.thumbs,
					autoplayHoverPause: owlsl_ops.autoplayHoverPause,
					slideBy: owlsl_ops.slideBy,
					smartSpeed: owlsl_ops.smartSpeed,
					// animateIn: 'fadeIn', // add this
					// animateOut: 'fadeOut', // and this
					navText:[owlsl_ops.prev,owlsl_ops.next],
				});

			});
			//testimonial ver 1

			$(".testimonial-slider-ver-2").each(function(){
				var owlsl = $(this) ;
				var owlsl_df = {
					margin: 0, 
					responsive: false, 
					smartSpeed:500,
					autoplay:false,
					autoplayTimeout: 6000,
					items:1,
					loop:true, 
					nav: true, 
					dots: true,
					center:false,
					autoWidth:false,
					thumbs:false, 
					autoplayHoverPause: true,
					slideBy: 1,
					prev:'<i class="arrow_carrot-left"></i>',
					next:'<i class="arrow_carrot-right"></i>',
				};
				var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};
				owlsl_ops = $.extend({}, owlsl_df, owlsl_ops);
				owlsl.owlCarousel({
					autoWidth: owlsl_ops.autoWidth,
					margin: owlsl_ops.margin,
					items: owlsl_ops.items,
					loop: owlsl_ops.loop,
					autoplay: owlsl_ops.autoplay,
					autoplayTimeout: owlsl_ops.autoplayTimeout,
					center: owlsl_ops.center,
					nav: owlsl_ops.nav,
					dots: owlsl_ops.dots,
					thumbs: owlsl_ops.thumbs,
					autoplayHoverPause: owlsl_ops.autoplayHoverPause,
					slideBy: owlsl_ops.slideBy,
					smartSpeed: owlsl_ops.smartSpeed,
					navText:[owlsl_ops.prev,owlsl_ops.next],
					lazyLoad:true,
					responsive: {
						0: {
							items: 1,
						},
						768:  {
							items: 2,
						},

					}
				});

			});
			//testimonial ver 2


		});
		// end Slide testimonial


		/**** Slide Instagram ****/
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_instagram.default', function(){
			$('.instagram .slide').each(function(){
				var owl = $(this);
				var data = owl.data('instagram_slide');
				owl.owlCarousel(
					data
					);
			});
		}); 
		// end slide Instagram


		/* Time Coundown */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_time_countdown.default', function(){
			
			var date = $('.due_date').data('day').split(' ');
			var day = date[0].split('-');
			var time = date[1].split(':');
			var date_countdown = new Date( day[0], day[1]-1, day[2], time[0], time[1] );
			$('.due_date').countdown({until: date_countdown, format: 'DHMS'});
			
		});
        // end time countdown   


        /* Slide Testimonial */
        elementorFrontend.hooks.addAction('frontend/element_ready/ova_slider.default', function(){
        	$(".ova-slider-carousel").each(function(){
        		var owlsl = $(this) ;
        		var owlsl_df = {
        			margin: 0, 
        			responsive: false, 
        			smartSpeed:500,
        			autoplay:false,
        			autoplayTimeout: 6000,
        			items:1,
        			loop:true, 
        			nav: true, 
        			dots: true,
        			center:false,
        			autoWidth:false,
        			thumbs:false, 
        			autoplayHoverPause: true,
        			slideBy: 1,
        			prev:'<i class="arrow_carrot-left"></i>',
        			next:'<i class="arrow_carrot-right"></i>',
        		};
        		var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};
        		owlsl_ops = $.extend({}, owlsl_df, owlsl_ops);
        		owlsl.owlCarousel({
        			autoWidth: owlsl_ops.autoWidth,
        			margin: owlsl_ops.margin,
        			items: owlsl_ops.items,
        			loop: owlsl_ops.loop,
        			autoplay: owlsl_ops.autoplay,
        			autoplayTimeout: owlsl_ops.autoplayTimeout,
        			center: owlsl_ops.center,
        			nav: owlsl_ops.nav,
        			dots: owlsl_ops.dots,
        			thumbs: owlsl_ops.thumbs,
        			autoplayHoverPause: owlsl_ops.autoplayHoverPause,
        			slideBy: owlsl_ops.slideBy,
        			smartSpeed: owlsl_ops.smartSpeed,
        			navText:[owlsl_ops.prev,owlsl_ops.next],
        		});

        	});


        });
		// end Slider

		// Custom Post Type Slide

		elementorFrontend.hooks.addAction('frontend/element_ready/ova_home_fullscreen.default', function(){

         $(document).ready(function($) {
			if (typeof $.fn.fullpage.destroy == 'function') { 
			    $.fn.fullpage.destroy('all');
			}
            $('#fullpage').fullpage({
				//options here
               	scrollingSpeed: 1000,
               	navigation: true,
        	});
         });

      }); 


		/* exhibitions slide */
		elementorFrontend.hooks.addAction('frontend/element_ready/ova_exhibitions_slide.default', function(){

			function fadeInReset(element) {
				$(element).find('*[data-animation]').each(function(){
					var animation = $(this).data( 'animation' );
					$(this).removeClass( 'animated' );
					$(this).removeClass( animation );
					$(this).css({ opacity: 0 });
				});
			}

			function fadeIn(element) {

				// Sub Title
				var $date = $(element).find( '.active .elementor-slide-subtitle' );
				var animation_title = $date.data( 'animation' );
				var duration_title  = parseInt( $date.data( 'animation_dur' ) );

				setTimeout(function(){
					$date.addClass(animation_title).addClass('animated').css({ opacity: 1 });
				}, duration_title);

				// Sub Title 2
				var $title = $(element).find( '.active .elementor-slide-sub-title-2' )
				var animation_title = $title.data( 'animation' );
				var duration_title  = parseInt( $title.data( 'animation_dur' ) );
				

				setTimeout(function(){
					$title.addClass(animation_title).addClass('animated').css({ opacity: 1 });
				}, duration_title);


		      	// Title
		      	var $sub_title = $(element).find( '.active .elementor-slide-title' );
		      	var animation_sub_title = $sub_title.data( 'animation' );
		      	var duration_sub_title  = parseInt( $sub_title.data( 'animation_dur' ) );
		      	

		      	setTimeout(function(){
		      		$sub_title.addClass(animation_sub_title).addClass('animated').css({ opacity: 1 });
		      	}, duration_sub_title);
		      	
				// Description
				var $desc = $(element).find( '.active .elementor-slide-description' );
				var animation_desc = $desc.data( 'animation' );
				var duration_desc  = parseInt( $desc.data( 'animation_dur' ) );
				

				setTimeout(function(){
					$desc.addClass(animation_desc).addClass('animated').css({ opacity: 1 });
				}, duration_desc);

		      	// Button
		      	var $button = $(element).find( '.active .elementor-slide-button' );
		      	var animation_button = $button.data( 'animation' );
		      	var duration_button  = parseInt( $button.data( 'animation_dur' ) );

		      	setTimeout(function(){
		      		$button.addClass(animation_button).addClass('animated').css({ opacity: 1 });
		      	}, duration_button);

		      	
		      }

		      $(document).ready(function(){
		      	$('.elementor-slides').each(function(){

		      		var owl = $(this);
		      		var data = owl.data("owl_carousel");


		      		owl.on('initialized.owl.carousel', function(event) {
		      			
		      			fadeIn(event.target);
		      		});

		      		owl.owlCarousel(
                     data
                     );
		      		

		      		owl.on('translate.owl.carousel', function(event){
		      			fadeInReset(event.target);
		      			owl.trigger('stop.owl.autoplay');
		      			owl.trigger('play.owl.autoplay');
		      		});


		      		owl.on('translated.owl.carousel', function(event) {
		      			fadeIn(event.target);
		      			owl.trigger('stop.owl.autoplay');
		      			owl.trigger('play.owl.autoplay');
		      		});


		      	});

		      	
		      });



            var window_size = $(window).height();
            var height_slide = window_size - 137;
            height_slide = (height_slide > 780) ? height_slide : 780;
            $('.ova-exhibitions-slide').css('height',height_slide + 'px');

         });
        // end exhibitions slide

        /* exhibitions creactive */
        elementorFrontend.hooks.addAction('frontend/element_ready/ova_exhibitions_creactive.default', function(){

           hideObjects();
           checkObjectsVisibility();

           $(window).scroll( function() {
              hideObjects();
              checkObjectsVisibility();
           });
           
           function hideObjects() {
              $('.fadeInUp-scroll').css({
                 'opacity': 0,
                 'transform': 'translateY(150px)'
              });
           }

           function checkObjectsVisibility() {
              $('.fadeInUp-scroll').each( function(i) {
                 var objectTop = $(this).offset().top;
                 var windowBottom = $(window).scrollTop() + $(window).outerHeight();

                 if( windowBottom > objectTop + 100){
                    $(this).addClass('visible');
                 } else {
                    $(this).removeClass('visible');
                 }
              });
           }
        });
        // end exhibitions creactive




     });

})(jQuery);
