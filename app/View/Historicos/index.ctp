<?php
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
	'titulo'=>__('Histórico'),
	'colunas'=>array(
		array('titulo'=>'Conteúdo','chave'=>'Historico.conteudo_id','format'=>'$this->Html->Link($elemento_conteudo["Historico"]["nome"],array("controller"=>$elemento_conteudo["Historico"]["controller"],"action"=>"view",%%%))'),
		array('titulo'=>'Tipo de Conteúdo','chave'=>'Historico.tabela','format'=>'trim("%%%","s")'),
		array('titulo'=>'Campo','chave'=>'Historico.campo','format'=>''),
		array('titulo'=>'Valor anterior','chave'=>'Historico.valor_anterior','format'=>''),
		array('titulo'=>'Valor posterior','chave'=>'Historico.valor_novo','format'=>''),
		array('titulo'=>'Usuário','chave'=>'Usuario.first_name','format'=>''),
		array('titulo'=>'Data da alteração','chave'=>'Historico.created','format'=>'date("d/m/Y",strtotime("%%%"))'),
	),
	'linhas'=>$historicos
)));
?>