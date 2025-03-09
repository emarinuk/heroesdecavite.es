(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {

      /* Upcomming Event Slide */

      elementorFrontend.hooks.addAction('frontend/element_ready/ova_events_cat.default', function(){

         if( $('.event-slide-owl').length > 0 ){  
            $('.event-slide-owl').each(function(){

               var event_sl = $(this).data('options');
               var rtl            = false;

               if( $('body').hasClass('rtl') ){
                  rtl = true;
               }

               $(this).owlCarousel({
                  margin: event_sl.margin,
                  smartSpeed: event_sl.smartSpeed,
                  loop: event_sl.loop, 				        
                  autoplay: event_sl.autoplay,
                  autoplayTimeout: event_sl.autoplayTimeout,
                  autoplayHoverPause: event_sl.autoplayHoverPause,
                  dots: event_sl.dots,  
                  nav: event_sl.nav,
                  slideBy: event_sl.slideBy,
                  navText:[event_sl.prev,event_sl.next],
                  rtl: rtl,
                  lazyLoad: true,						
                  responsive:{
                     0:{
                        items: event_sl.items_mobile
                     },
                     768:{
                        items: event_sl.items_ipad
                     },
                     1170:{
                        items: event_sl.total_columns_slide,
                     }
                  }
               });				 	
            });				
         }


      });

   });
})(jQuery);
