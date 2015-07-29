<?php

/* 
 * by furious
 */

echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
    
    'titulo'        =>__("Parametros"),
    'barra_filtro'  => $this->element('filtro_drop_box',array(
    'nome'          => 'parametro',
    'novo'     => $this->Html->url(array("controller" => "parametros", "action" => "add")),
    'filtros'       => array(
        
        
        array('text'=>'ID',                 'name'=>'Parametro.id',                 'type'=>'num'),
        array('text'=>'Nome',               'name'=>'Parametro.param_name',         'type'=>'text'),
        array('text'=>'Valor',              'name'=>'Parametro.param_value',        'type'=>'text'),
        array('text'=>'Descrição',          'name'=>'Parametro.param_descricao',    'type'=>'text'),
        array('text'=>'Usuário',            'name'=>'Usuario.nome',                 'type'=>'text'),
        array('text'=>'Criado em',          'name'=>'Parametro.created',            'type'=>'date-interval'),
        array('text'=>'Modificado em',      'name'=>'Parametro.modified',           'type'=>'date-interval'),

    ),
    'fields' => $fields
    )
            
    ),
    'colunas'=>array(
        
        
        array('titulo'=>'ID',                 'chave'=>'Parametro.id',              'format'=>'','width'=>'3'),
        array('titulo'=>'Nome',               'chave'=>'Parametro.param_name',      'format'=>'','width'=>'12'),
        array('titulo'=>'Valor',              'chave'=>'Parametro.param_value',     'format'=>'','width'=>'6'),
        array('titulo'=>'Descrição',          'chave'=>'Parametro.param_descricao', 'format'=>'','width'=>'25'),
        array('titulo'=>'Usuário',            'chave'=>'Usuario.nome',              'format'=>'','width'=>'25'),
        array('titulo'=>'Criado em',          'chave'=>'Parametro.created',         'format'=>'date("d/m/Y H:i",strtotime("%%%"))','width'=>'10'),
        array('titulo'=>'Modificado em',      'chave'=>'Parametro.modified',        'format'=>'date("d/m/Y H:i",strtotime("%%%"))','width'=>'10'),
        array('titulo'=>'Ações',              'chave'=>'Parametro.id',              'format'=>'$this->element("icon-view",array("controller" => "parametros", "id" => "%%%"))','width'=>'5'),
        array('titulo'=>' ',                  'chave'=>'Parametro.id',              'format'=>'$this->element("icon-delete",array("controller" => "parametros", "id" => "%%%"))','width'=>'5')

    ),
    'linhas'=>$parametros
        
))); 
?>

<script type="text/javascript">
$(function() {
	// FACTORIZAR ESSE CARA
        $('.editar_parametros').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "parametros/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>