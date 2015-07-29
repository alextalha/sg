<?php $mode = (isset($mode) ? $mode : ""); ?>
<a class="assumir <?php echo $mode; ?>" id="assumir<?php echo $id; ?>" rel="<?php echo $id; ?>" >
    <div class="botao" title="Assumir Demanda">
        
        <i class="fa fa-hand-o-up" style="<?php if($mode==="disable"){?>color:#ccc;<?php }?>"></i>

    </div>
</a>

<script>

$(document).ready(function(){

    var mode = "<?php echo $mode; ?>";

    $("#assumir<?php echo $id; ?>").click(function(e){
        e.preventDefault();

        var linha_id  = $(this).attr("rel");

        if(mode === "disable"){

            return false;
        }
        if( $(this).attr('class') === 'assumir disable' || $(this).attr('class') === 'assumir  disable' ){
                
            return false;
        }
        
        var resp = confirm( "Deseja mesmo ser owner desta atividade?" );
        if( !resp ){return false;}
        
        $.ajax({
            
            url: myBaseUrl + "atividades/assumir/",
            type: "post",
            data: { id: linha_id },
            dataType: "json",
            async: false,
            success: function ( data ) {
                
                if( data ){
                    
                    var atividade = $("table#atividades").treegrid( 'find', data.id );
                    setRecursiveData( atividade, data );
                }
            }
        });
        
        function setRecursiveData( node, data ){
            
            $( "table#atividades" ).treegrid('updateRow',{
                index: node.id,
                row: {
                    usuario_id:  data.usuario_id,
                    usuario_nome:data.usuario_nome
                    //emitir:data.emitir
                }
            });
            
            if( !$.isEmptyObject( node.children ) ){

                $.each( node.children, function(i,v){
                    
                    setRecursiveData( v, data );
                });
            }
        }        
    });
    
});

</script>
