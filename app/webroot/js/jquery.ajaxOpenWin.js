/* 
 * by Furious
 */
(function(){
    jQuery.fn.ajaxOpenWin = function( options ){
        
        this.each(function(){
            
            var settings = {
                
                url:"",
                type:"POST"
            };
            
            if( options ){
                
                $.extend( settings, options );
            }
            
            $this = jQuery(this);
            
            $this.bind('click',function(){
                
                jQuery( location ).attr( 'href', url_base + settings.url );
            });
        });
    }
})(jQuery)