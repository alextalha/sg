<?php

echo $this->element('tabela-cabecalho-superior-com-paginacao', array('tabela' => array(
        'titulo' => __('Cargos'),
        'barra_filtro' => $this->element('filtro_drop_box', array(
            'nome' => 'cargo',
            'novo'     => $this->Html->url(array("controller" => "cargos", "action" => "add")),
            'filtros' => array(
                array('name' => 'Cargo.id', 'type' => 'num', 'text' => 'ID'),
                array('name' => 'Cargo.nome', 'type' => 'text', 'text' => 'Nome'),
                array('name' => 'Cargo.created', 'type' => 'date-interval', 'text' => 'Criado em'),
                array('name' => 'Cargo.modified', 'type' => 'date-interval', 'text' => 'Modificado em')
            ),
            'fields' => $fields
                )
        ),
        'colunas' => array(
            array('titulo' => 'ID', 'chave' => 'Cargo.id', 'format' => '', 'width' => '6'),
            array('titulo' => 'Nome', 'chave' => 'Cargo.nome', 'format' => '', 'width' => '60'),
            array('titulo' => 'Criado em', 'chave' => 'Cargo.created', 'format' => 'date("d/m/Y H:i",strtotime("%%%"))', 'width' => '13'),
            array('titulo' => 'Modificado em', 'chave' => 'Cargo.modified', 'format' => 'date("d/m/Y H:i",strtotime("%%%"))', 'width' => '13'),
            array('titulo' => 'Ações', 'chave' => 'Cargo.id', 'format' => '$this->element("icon-view",array("id" => "%%%","controller"=>"cargos"))', 'width' => '6'),
            array('titulo' => ' ', 'chave' => 'Cargo.id', 'format' => '$this->element("icon-delete",array("id" => "%%%","controller"=>"cargos"))','width' => '5')
        ),
        'linhas' => $cargos
)));
?>

<script type="text/javascript">
$(function() {
	// FACTORIZAR ESSE CARA
        $('.editar_cargos').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "cargos/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>