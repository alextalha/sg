<?php
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
    'titulo'=>__('Pivots'),
'barra_filtro' => $this->element('filtro_drop_box',array(
            'nome'       => 'pivot',
            'novo'     => $this->Html->url(array("controller" => "pivots", "action" => "add")),
            'filtros'    => array(

		array('text'=>'ID',              'name'=>'Pivot.id',          'type'=>'num'),
		array('text'=>'Nome',            'name'=>'Pivot.nome',        'type'=>'text'),
		array('text' => 'Descrição',     'name'=>'Pivot.descricao' ,  'type'=>'text','text'=>'Descrição' ),
		array('text' => 'Tipo de Base' , 'name'=>'Pivot.tipo_base',  'type'=>array('sqlite','sqlsrv','mysql','pgsql'),'text'=>'Tipo de Base')

             ),
    
            'fields' => $fields
        )
    ),
    'colunas'=>array(
        array('titulo'=>'ID','chave'=>'Pivot.id','format'=>'','width'=>'5', 'class' => 'campo_numerico'),
        array('titulo'=>'Nome','chave'=>'Pivot.nome','format'=>'','width'=>'49' , 'class'=> 'campo_texto'),
        array('titulo'=>'Descrição','chave'=>'Pivot.descricao','format'=>'','width'=>'22', 'class' => 'campo_texto'),
        array('titulo'=>'Tipo de Base','chave'=>'Pivot.tipo_base','format'=>'','width'=>'14' ,  'class' => 'campo_texto' ),
        array('titulo'=>'Ações','chave'=>'Pivot.id','format'=>'$this->element("icon", array("url"=>$this->Html->url(array("controller" => "pivots", "action" => "view", %%%)),"title"=>"Visualizar dados da Pivot","icon"=>"eye","text"=>"","fa"=>"fa"))','width'=>'8'),
        array('titulo'=>' ','chave'=>'Pivot.id','format'=>'$this->element("icon-view",array("controller" => "pivots", "id" => "%%%"))','width'=>'5'),
        array('titulo'=>' ','chave'=>'Pivot.id','format'=>'$this->element("icon-delete",array("id" => "%%%","controller"=>"pivots"))','width'=>'5')
    ),
    'linhas'=>$pivots
)));
?>


<script type="text/javascript">
$(function() {
	// FACTORIZAR ESSE CARA
        $('.editar_pivots').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "pivots/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>
