<?php $mode = (isset($mode) ? $mode : ''); ?>
<div id="avancar" title="Avançar Atividade" class="<?php echo $mode; ?>">
    <?php

    echo $this->element('form', array('form' => array(
            'titulo' => "Avançar Atividade",
            'create' => 'Atividade',
            'type' => 'horizontal',
            'action' => 'avancar',
            'window' => 'modal',
            'inputs' => array(
                
                array('titulo' => '', 'chave' => 'id', 'options' => array('type' => 'hidden', 'id' => 'concluir_atividade_id')),
                array('titulo' => 'Percentual de Avanço', 'chave' => 'percentual_conclusao', 
                    'options' => array('control-group-opt' => array(
                        'display' => 'row', 
                        'style' => 'width:100%'
                    ),
                    'class'    => 'no_reorder',    
                    'required' => 'required',    
                    'options' => array(
                        
                        '100' => '100%',
                        '90'  => '90%',
                        '80'  => '80%',
                        '70'  => '70%',
                        '60'  => '60%',
                        '50'  => '50%',
                        '40'  => '40%',
                        '30'  => '30%',
                        '20'  => '20%',
                        '10'  => '10%',
                        ''    => '==Selecione=='
                        
                    ))
                )
            )
    )));
    ?>
</div>
<script>
$(document).ready(function(){
    
    var mode        = "<?php echo $mode; ?>";
    
    checkIfParent( $("#concluir_atividade_id").val() );
    
    $("#submit_Atividade").on("click", function(){

        if( mode === 'disable' ){ return false; }
        
        $("#AtividadePercentualConclusao").prop("disabled",false);
        
        var id          = $("#concluir_atividade_id").val();
        var per         = $("#AtividadePercentualConclusao").val();
        
        if( id === "" ){ return false; }
        if( per === "" ){ return false; }
        
        var atividade = $("table#atividades").treegrid( 'find', id );
        
        per = parseInt( per );

        if( per > 99 ){

            var d1 = atividade.data_prevista_inicio.split("/").reverse().join("-");
            var d2 = atividade.data_real_inicio.split("/").reverse().join("-");
            
            if( atividade.acesso.concluir === 'false' ){

                alert( "Apenas o responsável pode concluir a atividade!" ); 
                return false; 
                
            } else if( atividade.data_prevista_inicio === "" ){
                
                alert( "As datas previstas não foram adicionadas!" );
                return false;
                
            } else if ((new Date(d1)).getTime() > Date.now()){
                 
                if( atividade.data_real_inicio === "" ){

                    alert( "Por favor preencha o campo Início Real!" );
                    return false;
                }
            } else if ((new Date(d2)).getTime() > Date.now()){

                alert( "A data de início real da atividade não pode ser após sua conclusão, redefina por favor!" );
                return false;    
            }
        }
        
        setRecursiveData( atividade,atividade.data_real_inicio );
        
        updateTree( id );
        $(".ui-dialog-content").dialog("close");
    });
    
    function updateTree( id ){
    
        var node = $('table#atividades').treegrid( 'find', id );
        if( node ){

            if( node._parentId === null || node._parentId === undefined ){}else{
                
                updateParent( node._parentId );
            }
        }
    }
    
    function updateParent( id ){
        
        if( !id || id === "" ){return false;}
        
        var perc = 0;
        var sla  = 0;       
        
        var node = $('table#atividades').treegrid( 'find', id );

        if( node.children ){
            
            sla = parseInt( node.duracao );

            $.each( node.children, function( i, v ){
                
                perc += (parseInt( v.percentual_conclusao.slice(0, -1) ) * parseInt( v.duracao ) / sla );
            });

            var total = perc.toFixed(2);
            
            $( "table#atividades" ).treegrid('updateRow',{
                
                index: id,
                row: {
                    percentual_conclusao: total + "%"
                }
            });
        }
    }
    
    function setRecursiveData( node, data_real_inicio ){

        $( "table#atividades" ).treegrid('updateRow',{

            index: node.id,
            row: {
                percentual_conclusao: "100%",
                data_real_inicio: data_real_inicio
            }
        });
            
        if( !$.isEmptyObject( node.children ) ){

            $.each( node.children, function(i,v){
                
                setRecursiveData( v, data_real_inicio );
            });
        }
    }
    
    function checkIfParent( id ){
        
        var node = $('table#atividades').treegrid( 'find', id );
        if( node.children ){
            $("#AtividadePercentualConclusao option[value='100']").prop("selected",true);
            $("#AtividadePercentualConclusao").prop("disabled",true);
        }
    }
    
});
</script>