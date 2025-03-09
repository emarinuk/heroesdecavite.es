(function($){
   "use strict";
   $(document).ready(function(){

      /***** Map *****/
      function initialize() {
         var lat = parseFloat( $("#location").data('lat') );
         var lng = parseFloat( $("#location").data('lng') );
         var address = $("#location").data('address');
         var zoom = parseInt( $("#location").data('zoom') );

         var infoWindow = new google.maps.InfoWindow();

         var loc = {lat: lat, lng: lng};

         var map = new google.maps.Map(document.getElementById('location'), {
            zoom: zoom,
            center: loc,
            scrollwheel: false
         });

         var marker = new google.maps.Marker({
            position: loc,
            map: map
         });    

         google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
               infoWindow.setContent(address);
               infoWindow.open(map, marker);
            }
         })(marker));

      }

      
      if( typeof google !== 'undefined' && $(".single-event #location").length > 0 ){ 
         google.maps.event.addDomListener(window, "load", initialize);
      }
      


      /***** Gallery PrettyPhoto *****/
      if( $(".gallery-items a[data-rel^='prettyPhoto']").length > 0 ){
         $(".gallery-items a[data-rel^='prettyPhoto']").prettyPhoto();
      }


      /***** Date Time Picker *****/
      $(".ovaev_start_date_search, .ovaev_end_date_search").each(function(){
         if($().datetimepicker) {
            var date = $(this).data('date');
            var lang = $(this).data('lang');
            $(this).datetimepicker({
               format: date,
               timepicker:false
            });
            $.datetimepicker.setLocale(lang);
         }
      });

   });

})(jQuery);