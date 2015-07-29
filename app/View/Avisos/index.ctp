<?php
echo $this->element('modal_add_edit',array('nome'=>'aviso')); 
 
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
	'titulo'=>__('Avisos'),
	'colunas'=>array(
		array('titulo'=>'ID','chave'=>'Aviso.id','format'=>''),
		array('titulo'=>'Nome','chave'=>'Aviso.nome','format'=>''),
		array('titulo'=>'Mensagem','chave'=>'Aviso.mensagem','format'=>''),
		array('titulo'=>'Dados da mensagem','chave'=>'Aviso.dados','format'=>''),
		array('titulo'=>'Ação disparadora','chave'=>'Aviso.action','format'=>''),
		array('titulo'=>'Ações','chave'=>'Aviso.id','format'=>'$this->element("icon-view",array("id" => "%%%","controller"=>"avisos"))'),
		array('titulo'=>' ','chave'=>'Aviso.id','format'=>'$this->element("icon-delete",array("id" => "%%%","controller"=>"avisos"))')
	 
	),
	'linhas'=>$avisos
))); 