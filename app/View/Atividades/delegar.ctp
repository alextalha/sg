<?php $mode = (isset($mode) ? $mode : ''); ?>
<div id="delegar" title="Delegar Atividade" class="<?php echo $mode; ?>">
    <?php
    echo $this->element('form', array('form' => array(
            'titulo' => "Delegar Atividade",
            'create' => 'Atividade',
            'type' => 'horizontal',
            'action' => '',
            'window' => 'modal',
            'inputs' => array(
                array('titulo' => '', 'chave' => 'id', 'options' => array('type' => 'hidden', 'id' => 'delegar_atividade_id')),
                array('titulo' => 'Novo Responsável', 'chave' => 'usuarios', 'options' => array('required' => 'required','control-group-opt' => array('display' => 'coll','style'=>'width:100%')))
            )
    )));
    ?>
</div>
<script>
$(document).ready(function(){
    
    var mode = "<?php echo $mode; ?>";
    
    $("#submit_Atividade").on("click",function(){
        
        if( mode === 'disable' ){
            return false; 
        }

        var id   = $("#delegar_atividade_id").val();
        var user = $("#AtividadeUsuarios").val();
        
        if( id === "" ){ return false; }
        if( user === "" ){ return false; }
        
        $.ajax({
            
            url: myBaseUrl + "atividades/delegar_usuario/",
            type: "post",
            data: { id:id, user:user },
            dataType: "json",
            success: function (data) {

                if( data ){
                    
                    var atividade = $("table#atividades").treegrid( 'find', data.id );
                    
                    $( "table#atividades" ).treegrid('updateRow',{
                        index: data.id,
                        row: {
                                usuario_id: data.usuario_id,
                                usuario_nome: data.usuario_nome
                                //emitir:data.emitir
                            }
                    });
                
                    if( !$.isEmptyObject( atividade.children ) ){

                        $.each( atividade.children, function( i,v ){

                            $( "table#atividades" ).treegrid('updateRow',{
                                index: v.id,
                                row: {
                                        usuario_id: data.usuario_id,
                                        usuario_nome: data.usuario_nome
                                        //emitir:data.emitir
                                    }
                            });
                        });
                    }
                    $(".ui-dialog-content").dialog("close");
                }
            }
        });
    });
});
</script>