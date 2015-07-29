<?php 
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
	'titulo'=>__('Arquivos'),
	'colunas'=>array(
		array('titulo'=>'ID','chave'=>'Arquivo.id','format'=>''),
		array('titulo'=>'Nome','chave'=>'Arquivo.nome','format'=>''),
		array('titulo'=>'Descrição','chave'=>'Arquivo.descricao','format'=>''),
		array('titulo'=>'Criado em','chave'=>'Arquivo.created','format'=>'date("d/m/Y H:i",strtotime("%%%"))'),
		array('titulo'=>'Modificado em','chave'=>'Arquivo.modified','format'=>'date("d/m/Y H:i",strtotime("%%%"))'),
   		array('titulo'=>'Extensao','chave'=>'Arquivo.tx_extensao','format'=>''),
		array('titulo'=>'Ações','chave'=>'Demanda.0.id','format'=>'$this->element("icon-view",array("id" => "%%%","controller"=>"demandas"))')
	 
	),
	'linhas'=>$arquivos

)));