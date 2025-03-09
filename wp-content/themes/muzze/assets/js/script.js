(function($){
	"use strict";
	$(document).ready(function(){

		/* Scroll to top */
		muzze_scrollUp();
		function muzze_scrollUp(options) {
		           
		    var defaults = {
		        scrollName: 'scrollUp', 
		        topDistance: 600, 
		        topSpeed: 800, 
		        animation: 'fade', 
		        animationInSpeed: 200, 
		        animationOutSpeed: 200, 
		        scrollText: '<i class="fas fa-angle-up"></i>', 
		        scrollImg: false, 
		        activeOverlay: false 
		    };

		    var o = $.extend({}, defaults, options),
		            scrollId = '#' + o.scrollName;


		    $('<a/>', {
		        id: o.scrollName,
		        href: '#top',
		        title: o.scrollText
		    }).appendTo('body');


		    if (!o.scrollImg) {

		        $(scrollId).html(o.scrollText);
		    }


		    $(scrollId).css({'display': 'none', 'position': 'fixed', 'z-index': '2147483647'});


		    if (o.activeOverlay) {
		        $("body").append("<div id='" + o.scrollName + "-active'></div>");
		        $(scrollId + "-active").css({'position': 'absolute', 'top': o.topDistance + 'px', 'width': '100%', 'border-top': '1px dotted ' + o.activeOverlay, 'z-index': '2147483647'});
		    }


		    $(window).scroll(function () {
		        switch (o.animation) {
		            case "fade":
		                $(($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed));
		                break;
		            case "slide":
		                $(($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed));
		                break;
		            default:
		                $(($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0));
		        }
		    });

		    
		    $(scrollId).on( "click", function (event) {
		        $('html, body').animate({scrollTop: 0}, o.topSpeed);
		        event.preventDefault();
		    });

		}

		/* Fix empty menu in test_uni_data */
		if( $( '.widget_nav_menu ul li' ).length > 0 ){
			$( '.widget_nav_menu ul li a:empty' ).parent().css('display','none');
		}

		/* Select 2 */
		$('select').select2({
			width: '100%'
		});


		

		/* Popup Image - PrettyPhoto */
		if($().prettyPhoto) {
			if( $("a[data-gal^='prettyPhoto']").length > 0 ){
			 	$("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal', theme: 'facebook',slideshow:5000, autoplay_slideshow:true});
		    }
		}


	    /* Caousel Thumbnail Woo */
	    if( $('.woo-thumbnails').length > 0 ){
	        $('.woo-thumbnails .owl-carousel').each(function(){

	        	var rtl = false;
			 	if( $('body').hasClass('rtl') ){
			 		rtl = true;
			 	}

	            $(this).owlCarousel({
	                autoplay: true,
	                autoplayHoverPause: true,
	                loop: false,
	                margin: 20,
	                dots: false,
	                nav: true,
	                vertical: true,
	                rtl: rtl,
	                responsive: {
	                    0:    {items: 2},
	                    479:  {items: 2},
	                    768:  {items: 3},
	                    1024: {items: 3}
	                }
	            });
	        });
	    }

	    $( '.ovatheme_header_default li.menu-item button.dropdown-toggle').off('click').on( 'click', function() {
		    $(this).parent().toggleClass('active_sub');
		});
   		
   		//
		$( ".accor-muzze-content .wp-title " ).off('click').on( 'click', function() {

			var icon_accor  = $(this).children('.icon-accor');
			var i = icon_accor.children('i');
			var id = i.attr('id');
			var data_key = $(this).attr('data-option');

			$(".wp-ova-according-" +  data_key + " .accor-muzze-content .wp-title").not(this).children('.icon-accor').children('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
			$(this).children('.icon-accor').children('i').toggleClass("fa-angle-up fa-angle-down");
			$( ".wp-ova-according-" +  data_key + " .accor-muzze-content .wp-title" ).not(this).parent().removeClass('show').addClass('hide').children( ".content" ).slideUp();
			$('.wp-ova-according-' +  data_key + ' #slide-'+id).slideToggle("slow");
			$('.wp-ova-according-' +  data_key + ' #slide-'+id).parent().toggleClass("show hide");
		});

		$( ".accor-muzze-content-image .wp-title " ).off('click').on( 'click', function() {

			var icon_accor  = $(this).children('.icon-accor');
			var i = icon_accor.children('i');
			var id = i.attr('id');
			var data_key = $(this).attr('data-option');

			$(".wp-ova-according-" +  data_key + " .accor-muzze-content-image .wp-title").not(this).children('.icon-accor').children('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
			$(this).children('.icon-accor').children('i').toggleClass("fa-angle-up fa-angle-down");
			$( ".wp-ova-according-" +  data_key + " .accor-muzze-content-image .wp-title" ).not(this).parent().removeClass('show').addClass('hide').children( ".content" ).slideUp();
			$('.wp-ova-according-' +  data_key + ' #slide-'+id).slideToggle("slow");
			$('.wp-ova-according-' +  data_key + ' #slide-'+id).parent().toggleClass("show hide");
		});

		if($().imagesLoaded) {
			var $grid = $('.ova-grid').imagesLoaded( function() {
				$grid.masonry({
					itemSelector: '.post-wrap', 
				}); 
			});
		}

		if($().imagesLoaded) {
			var $grid_sidebar = $('.ova-grid_sidebar').imagesLoaded( function() {
				$grid_sidebar.masonry({
					itemSelector: '.post-wrap', 
				}); 
			});
		}

		$(".single-slide").each(function(){
			var owlsl = $(this) ;
			var owlsl_df = {
				margin: 0, 
				responsive: false, 
				smartSpeed:500,
				autoplay:true,
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

		$('#ova-copy-link').off('click').on( 'click', function(){
			var $url = $("<input>");
			$("body").append($url);
			$url.val($('#ova-copy-link').attr('data-url')).select();
			document.execCommand("copy");
			$url.remove();
			alert('copied!');
		});

		$(window).on('scroll', function() {
		    $('.schedule').each(function() {
		        if($(window).scrollTop() >= ($(this).offset().top - 100) ) {
		            var id = $(this).attr('id');
		            $('.schedule a').removeClass('active');
		            $('.schedule  a[href=#'+ id +']').addClass('active');
		        }
		    });
		});

	});
})(jQuery);


