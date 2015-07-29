<div id="cancelar" title="Cancelar Demanda">
<?php 
	echo $this->element('form',array('form'=>array(
		'titulo'=> "Cancelar Demanda",
		'create'=> 'Demanda',
		'type'=>'horizontal',
		'action'=>'cancelar',
                'window'=> 'modal',
		'inputs'=>array(
			array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden','id'=>'cancelar_Demanda_id')),
			array('titulo'=>'Motivo do cancelamento','chave'=>'motivo_cancelamento','options'=>array('type'=>'textarea','required'=>'required','control-group-opt' => array('display' => 'row', 'style' => 'width:100%'))),
		)
	))); 
?>
</div>