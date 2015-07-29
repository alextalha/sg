<div title="Cancelar Atividade">
<?php 
	echo $this->element('form',array('form'=>array(
		'titulo'    =>  "Cancelar Atividade",
		'create'    =>  'Atividade',
		'action'    =>  'cancelar',
                'window'    =>  'modal',
		'inputs'    =>  array(
                    
			array('titulo'=>'','chave'=>'id','options'=>array('value'=>$atividade_id,'type'=>'hidden','id'=>'cancelar_atividade_id')),
			array('titulo'=>'Motivo do cancelamento','chave'=>'motivo_cancelamento','options'=>array('type'=>'textarea','required'=>'required','control-group-opt' => array('display' => 'row', 'style' => 'width:100%'))),
		)
	))); 
?>
</div>
<script type="text/javascript">
    $(document).ready( function(){
        
        ativa_campos_jquery();
        
        $("#submit_Atividade").click(function(){
            
            $("#AtividadeCancelarForm").submit();
        });
    });
</script>