<?php

/*
 * by Furious
 */


echo $this->element('tabela-cabecalho-superior-com-paginacao', array('tabela' => array(
        'titulo' => __('Log de Eventos'),
        'barra_filtro' => $this->element('filtro_drop_box', array(
        'disable_controls' => 'novo',
        'nome' => 'logevento',
        'filtros' => array(
                array('name' => 'Logevento.id',             'type' => 'num',            'text' => 'ID'),
                array('name' => 'Usuario.nome',             'type' => 'text',           'text' => 'Usuário'),
                array('name' => 'Logevento.tx_entidade',    'type' => 'text',           'text' => 'Entidade'),
                array('name' => 'Logevento.tx_evento',      'type' => 'text',           'text' => 'Evento'),
                array('name' => 'Logevento.tx_ocorrencia',  'type' => 'text',           'text' => 'Ocorrência'),
                array('name' => 'Logevento.created',        'type' => 'date-interval',  'text' => 'Criado em')
            ),
            'fields' => $fields
            )
        ),
        'colunas' => array( 
            array('titulo' => 'ID',        'chave' => 'Logevento.id',            'format' => '', 'width' => '3'),
            array('titulo' => 'Usuário',   'chave' => 'Usuario.nome',            'format' => '', 'width' => '20'),
            array('titulo' => 'Entidade',  'chave' => 'Logevento.tx_entidade',   'format' => '', 'width' => '12'),
            array('titulo' => 'Evento',    'chave' => 'Logevento.tx_evento',     'format' => '', 'width' => '8'),
            array('titulo' => 'Ocorrência','chave' => 'Logevento.tx_ocorrencia', 'format' => '', 'url' => $this->Html->url(array("controller" => "%%%", "action" => "edit")), 'width' => '40'),
            array('titulo' => 'Criado em', 'chave' => 'Logevento.created',       'format' => 'date("d/m/Y H:i",strtotime("%%%"))', 'width' => '15')
        ),
        'linhas' => $logs
)));

?>

<script type="text/javascript">
$(function() {
	// FACTORIZAR ESSE CARA
        $('.editar_logeventos').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "logeventos/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>