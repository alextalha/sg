<?php

echo $this->element('tabela-cabecalho-superior-com-paginacao', array('tabela' => array(
        'titulo' => __('Categoria de Arquivos'),
        'barra_filtro' => $this->element('filtro_drop_box', array(
            'nome' => 'categoria_arquivo',
             'novo'     => $this->Html->url(array("controller" => "categoria_arquivos", "action" => "add")),
            'filtros' => array(
               // array('text' => 'ID', 'name' => 'CategoriaArquivo.id', 'type' => 'num'),
                array('text' => 'Nome', 'name' => 'CategoriaArquivo.nome', 'type' => 'text'),
                array('text' => 'Criado em', 'name' => 'CategoriaArquivo.created', 'type' => 'date-interval'),
                array('text' => 'Modificado em', 'name' => 'CategoriaArquivo.modified', 'type' => 'date-interval'),
            ),
            'fields' => $fields
        )),
        'colunas' => array(
            array('titulo' => 'ID', 'chave' => 'CategoriaArquivo.id', 'format' => '', 'width' => '4'),
            array('titulo' => 'Nome', 'chave' => 'CategoriaArquivo.nome', 'format' => '', 'width' => '56'),
            array('titulo' => 'Criado em', 'chave' => 'CategoriaArquivo.created', 'format' => 'date("d/m/Y H:i",strtotime("%%%"))', 'width' => '15'),
            array('titulo' => 'Modificado em', 'chave' => 'CategoriaArquivo.modified', 'format' => 'date("d/m/Y H:i",strtotime("%%%"))', 'width' => '15'),
            array('titulo' => 'Ações', 'chave' => 'CategoriaArquivo.id', 'format' => '$this->element("icon-view",array("controller" => "categoria_arquivos", "id" => "%%%"))', 'width' => '8'),
            array('titulo' => ' ', 'chave' => 'CategoriaArquivo.id', 'format' => '$this->element("icon-delete",array("id" => "%%%","controller"=>"categoria_arquivos"))', 'width' => '5')
        ),
        'linhas' => $categoriaArquivos
)));
?>
<script type="text/javascript">
$(function() {
	// FACTORIZAR ESSE CARA
        $('.editar_categoria_arquivos').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "categoria_arquivos/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>