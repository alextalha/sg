<div id="cancelar" title="Cancelar Atividade">
<?php 
	echo $this->element('form',array('form'=>array(
		'titulo'    =>  "Cancelar Atividade",
		'create'    =>  'Atividade',
		'type'      =>  'horizontal',
		'action'    =>  'cancelar',
                'window'    =>  'modal',
		'inputs'    =>  array(
                    
			array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden','id'=>'cancelar_atividade_id')),
			array('titulo'=>'Motivo do cancelamento','chave'=>'motivo_cancelamento','options'=>array('type'=>'textarea','required'=>'required','control-group-opt' => array('display' => 'row', 'style' => 'width:100%'))),
		)
	))); 
?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        
        $("form#AtividadeCancelarForm").find("#submit_Atividade").on('click',function(e){
            e.preventDefault();
            var id   = $("#cancelar_atividade_id").val();
            
            if( $("#AtividadeMotivoCancelamento").val() === "" ){return false;}
            if( id === "" ){return false;}
            
            var node = $("table#atividades").treegrid('find', id);
            
            setRecursiveData( node );
            
            $(".ui-dialog-content").dialog("close");
        });
        
        function setRecursiveData( node ){
            
            node.data_cancelamento   = getDateNow();
            node.motivo_cancelamento = $("#AtividadeMotivoCancelamento").val();
            node.status              = 'Cancelada';

            $("table#atividades").treegrid('update', {id: node.id, row: node});
            //setDisable( node.id );
            
            if( !$.isEmptyObject( node.children ) ){

                $.each( node.children, function(i,v){
                    
                    setRecursiveData( v );
                });
            }
        }
        
        function getDateNow(){

            var hoje = new Date();
            var _dia = hoje.getDate();
            var dia  =  ( _dia.toString().length === 1 ) ? "0"+_dia : _dia;
            var _mes = (parseInt(hoje.getMonth())+1);
            var mes  = ( _mes.toString().length === 1 ) ? "0"+_mes : _mes;
            var ano  = hoje.getFullYear();
            var data = dia+"/"+mes+"/"+ano;

            return data;
        }
        
        function setDisable( id ){
            
            $("a[rel='"+ id +"']").addClass('disable');// > div.botao" ).css("color", "#ccc");
            $("a[rel='"+ id +"'] > div.botao").css( "color", "#ccc" );
            $("a[id='"+ id +"']").addClass('disable');
            $("a[id='"+ id +"'] > div.botao").css( "color", "#ccc" );
        }
    });
</script>