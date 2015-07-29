<?php 
echo $this->element('form',array('form'=>array(
	'titulo'=> __($type.' %s', __('Aviso')),
	'create'=> 'Aviso',
	'action'=>$type,
	'inputs'=>array(
		array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden')),
		array('titulo'=>'Nome','chave'=>'nome','options'=>array('required' => 'required')),
		array('titulo'=>'Mensagem','chave'=>'mensagem','options'=>array('required' => 'required','type'=>'textarea')),
		array('titulo'=>'Dados da mensagem','chave'=>'dados','options'=>array('required' => 'required')),
		array('titulo'=>'Ação disparadora','chave'=>'action','options'=>array('required' => 'required'))
	)
))); 