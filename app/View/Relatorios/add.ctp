<?php

$subform = $this->element('tabela-cabecalho-superior',array('tabela'=>array(
 	'titulo'=>'Permissões',
 	'colunas'=>array(
 		array('titulo'=>'Grupo de Acesso','chave'=>'nome','format'=>''),
 		array('titulo'=>'Visualizar','chave'=>'id','format'=>'$this->BootstrapForm->input("Permission.%%%.view",array("type"=>"checkbox","label"=>false))'),
 		array('titulo'=>'Editar','chave'=>'id','format'=>'$this->BootstrapForm->input("Permission.%%%.edit",array("type"=>"checkbox","label"=>false))'),
 		array('titulo'=>'Excluir','chave'=>'id','format'=>'$this->BootstrapForm->input("Permission.%%%.delete",array("type"=>"checkbox","label"=>false))')
 	),
 	'linhas'=>$grupos
)));

echo $this->element('form',array('form'=>array(
	'titulo'=> __($type.' %s', __('Relatorio')),
	'create'=> 'Relatorio',
	'action'=>$type,
	'inputs'=>array(
		array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden')),
		array('titulo'=>'Nome','chave'=>'nome','options'=>array('required' => 'required',)),
		array('titulo'=>'Descrição','chave'=>'descricao','options'=>array('type'=>'textarea')),
		array('titulo'=>'Diretório','chave'=>'tx_diretorio','options'=>array('type'=>'text','required'=>true,'orientation'=>'row','style' => 'width:40%') )
	),
	'subform'=>$subform
))); 
