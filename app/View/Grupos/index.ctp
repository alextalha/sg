<?php 
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
	'titulo'=>__("Grupos"),
        'barra_filtro' => $this->element('filtro_drop_box',array(
            'nome'       => 'grupo',
            'novo'     => $this->Html->url(array("controller" => "grupos", "action" => "add")),
            'filtros'    => array(

                    array('text'=>'ID',           'name'=>'Grupo.id',        'type'=>'num'),
                    array('text'=>'Nome',         'name'=>'Grupo.nome',      'type'=>'text'),
                    array('text'=>'Alias',        'name'=>'Grupo.alias_name','type'=>'text'),
                    array('text'=>'Criado em',    'name'=>'Grupo.created',   'type'=>'date-interval'),
                    array('text'=>'Modificado em','name'=>'Grupo.modified',  'type'=>'date-interval'),

                ),
            'fields'     => $fields
            )
        ),
	'colunas'=>array(
		array('titulo'=>'ID','chave'=>'Grupo.id','format'=>'','width'=>'3', 'class'=>'text-right'),
		array('titulo'=>'Nome','chave'=>'Grupo.nome','format'=>'','width'=>'51'),
		array('titulo'=>'Alias','chave'=>'Grupo.alias_name','format'=>'','width'=>'16'),
		array('titulo'=>'Criado em','chave'=>'Grupo.created','format'=>'date("d/m/Y H:i",strtotime("%%%"))','width'=>'11', 'class'=>'text-center'),
		array('titulo'=>'Modificado em','chave'=>'Grupo.modified','format'=>'date("d/m/Y H:i",strtotime("%%%"))','width'=>'11', 'class'=>'text-center'),
		array('titulo'=>'Ações','chave'=>'Grupo.id','format'=>'$this->element("icon-view",array("controller" => "grupos", "id" => "%%%"))','width'=>'7'),
		array('titulo'=>' ','chave'=>'Grupo.id','format'=>'$this->element("icon-delete",array("controller" => "grupos", "id" => "%%%"))','width'=>'0')
	),
	'linhas'=>$grupos
))); 
?>
<script type="text/javascript">
$(function() {
	// FACTORIZAR ESSE CARA
        $('.editar_grupos').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "grupos/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>