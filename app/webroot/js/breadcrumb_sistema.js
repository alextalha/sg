$(function () {
    
    $("span.delCrumb").click(function(e) {

        e.preventDefault();
        close( $(this).parent() );
    });
    
    $("span#close_superior_window").on('click', function (e) {
        e.preventDefault();
        
        var url_atual = window.location.href;
        var direct    = url_atual.split("/").reverse();
        direct        = ( direct[0]==="" )?direct[1]:direct[0];
        var control   = $("ul#lista-bread-crumb li.ativo").attr("id");
        
        if( direct === control ){
            
            var element = $("ul#lista-bread-crumb li.ativo");
            close( element );
            
        } else {
            
            var url = myBaseUrl + control;
            jQuery(location).attr('href', url);            
        }

        return false;
    });
    
    function close( element ){
        
        var action = element.attr("id");
        var type   = (element.attr("class")) ? element.attr("class") : "";

        var url = myBaseUrl + "BreadCrumbSistema/delete/";
        var result = $.ajax({
            
            url: url,
            type: "post",
            data: { action:action },
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                return data;
            }

        }).responseJSON;
        
        if( result === "true" ){

            if( type === "" ){
                
                $( "#" + action ).fadeOut("slow");
            } else {
                
                removerTelaAtual( action );
                $( "#" + action ).fadeOut("slow");
            }
        }
    }
    
    function removerTelaAtual(action) {

        $.ajax({
            
            url: myBaseUrl + "BreadCrumbSistema/close/",
            type: "post",
            data: { action:action },
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                jQuery( location ).attr( 'href', data );
            }

        });
    }    
});