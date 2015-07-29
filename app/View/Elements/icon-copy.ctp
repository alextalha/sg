<a class="copiar_<?php echo $controller; ?>" id="<?php echo $id; ?>">
    
    <div class="botao" title="Cadastrar nova demanda deste processo!">    
        <i class="fa fa-copy"></i>
        
        <!--ver/editar-->
    </div>
</a>
<script>
/*
$(document).ready(function(){
    
    $("a#<?php// echo $id; ?>").on("click",function(){
        
        var url = myBaseUrl + "demandas/add";
        
        $.redirectPost( url, {processo: '<?php //echo $id; ?>'});
    });
    
    $.extend({
        redirectPost: function(location, args){
            
            var form = '';
            $.each( args, function( key, value ){
                
                form += '<input type="hidden" name="'+key+'" value="'+value+'">';
            });
            $('<form id="envia_processo_para_demanda" action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
        }
    });    
    
});
*/
</script>