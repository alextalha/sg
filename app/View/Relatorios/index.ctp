<?php
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
	'titulo'=>__('Relatórios'),
    
        'barra_filtro' => $this->element('filtro_drop_box',array(
            'nome'       => 'relatorio',
            'barra_menu' => $this->element('modal_add_edit_filter',array('nome'=>'relatorio')),
            'filtros'    => array(
                
		array('text'=>'ID',         'name'=>'Relatorio.id',          'type'=>'num'),
		array('text'=>'Nome',       'name'=>'Relatorio.nome',        'type'=>'text'),
		array('text'=>'Descrição',  'name'=>'Relatorio.descricao',   'type'=>'text'),
		array('text'=>'Diretório',  'name'=>'Relatorio.tx_diretorio','type'=>'text'),
		                
                
                ),
            'fields'     => $fields
            )
        ),       
    
	'colunas'=>array(
		array('titulo'=>'ID','chave'=>'Relatorio.id','format'=>''),
		array('titulo'=>'Nome','chave'=>'Relatorio.nome','format'=>''),
		array('titulo'=>'Descrição','chave'=>'Relatorio.descricao','format'=>''),
		array('titulo'=>'Diretório','chave'=>'Relatorio.tx_diretorio','format'=>''),
		array('titulo'=>'Ações','chave'=>'Relatorio.id','format'=>'$this->element("icon-view",array("controller" => "relatorios", "id" => "%%%"))'),
		array('titulo'=>' ','chave'=>'Relatorio.id','format'=>'$this->element("icon-delete",array("id" => "%%%","controller"=>"relatorios"))')
	 
	),
	'linhas'=>$relatorios
)));