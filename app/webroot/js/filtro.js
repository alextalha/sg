$(function(){
    
    
    // Fltro na horizontal , escondendo a lista de opções
    $('.toogle-image').on('click',function(){
       
       if ($(".filtro_option_box").css('display') === 'none') {
           $(".filtro_option_box,.expand-vertical-table").show();
           $( this ).parent().removeClass('span12').addClass('span9');
           $( this ).parent().siblings().removeClass('span0').addClass('span3');
            
        }else{   
             $(".filtro_option_box,.expand-vertical-table").hide();
             $( this ).parent().removeClass('span9').addClass('span12');
             $( this ).parent().siblings().removeClass('span3').addClass('span0');
        }
         
            });

    // Filtro na vertical , expandindo a lista 
    
     $('.expand-vertical-table').on('click',function(){
        if(($('.list').css('height')) === '129px'){
             $('.list').css('height','100%');
         
        }else{
             $('.list').css('height','129px');
                var offset = $(".container-fluid").offset();
                window.scrollTo(0, 0);
       
        }

    });
    
    $('#expand-table').on('click',function(){
       
        //imagem clicada;
        
       var imagem = $(this).find('img').attr('src');
        
        
        var res = imagem.split(/^[^:]+:/,3);
  
       
        if ($("#filtro").is(':visible')) {
            $('#filtro').hide();
            $('#expand-table > .text-center').html("<span style='cursor:pointer'><img src='"+myBaseUrl +"imagens/seta_table_filtro_baixo.png' /></span>");
                
        }else{
            $('#expand-table > .text-center').html("<span style='cursor:pointer'><img src='"+myBaseUrl +"/imagens/seta_table_filtro_cima.png' /></span>");
            $('#filtro').show();     
        }
    });

});
    // expandir as opções do filtro
    