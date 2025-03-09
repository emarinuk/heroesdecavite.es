(function($){
    "use strict";

        if (typeof(OVA_MegaMenu) == "undefined")  var OVA_MegaMenu = {}; 

        OVA_MegaMenu.init = function(){
                this.FrontEnd.init();

        }
        
        /* Metabox */
        OVA_MegaMenu.FrontEnd = {

            init: function(){
                this.megamenu();

                
            },

            megamenu: function(){

                $('ul.ova-mega-menu').each(function() {

                    $(this).css('width', '500px');
                    $(this).css({ "right":"0", "left":"0" });

                    

                });

            }
            
            

        }

        

    $(document).ready(function(){
        OVA_MegaMenu.init();
        
    });
    $(window).resize(function(){
        OVA_MegaMenu.FrontEnd.megamenu();
        
    });

})(jQuery);




