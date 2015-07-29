<?php

echo $this->element('tabela-cabecalho-superior-com-paginacao', array('tabela' => array(
    
        'titulo' => __('Minhas atividades'),
        'barra_filtro' => $this->element('filtro_drop_box', array(
            'disable_controls' => 'novo',
            'nome' => 'atividade',
            'filtros' => array(

                array('name' => 'Atividade.id',                     'type' => 'num',            'text' => 'ID'),
                array('name' => 'Demanda.nome',                     'type' => 'text',           'text' => 'Demanda'),
                array('name' => 'Demanda.usuario_id',               'type' => 'select',         'text' => 'Demandante',  'ref' => 'Usuario'),
                array('name' => 'Atividade.nome',                   'type' => 'text',           'text' => 'Atividade'),
                array('name' => 'Atividade.usuario_id',             'type' => 'select',         'text' => 'Responsável', 'ref' => 'Usuario'),
                array('name' => 'Atividade.data_prevista_inicio',   'type' => 'date-interval',  'text' => 'Início'),
                array('name' => 'Atividade.data_prevista_termino',  'type' => 'date-interval',  'text' => 'Término'),
                array('name' => 'StatusAtividade.id',               'type' => 'select',         'text' => 'Status', 'ref' => 'StatusAtividade'),
                array('name' => 'Etapa.duracao',                    'type' => 'text',           'text' => 'Duração'),
                array('name' => 'Atividade.percentual_conclusao',   'type' => 'text',           'text' => 'Conclusão'),

                /* Expecializada*/
                array('name' => 'Demanda.grupo_id',                 'type' => 'select',         'text' => 'Grupo', 'ref' => 'Grupo'),
                array('name' => 'Atividade.descricao',              'type' => 'text',           'text' => 'Observações'),
                array('name' => 'ParentAtividade.nome',             'type' => 'text',           'text' => 'Subatividade de')
                
            ),
            'fields' => $fields
            )
        ),
        'colunas' => array(
           
            array('titulo' => '',                   'chave' => 'Etapa.milestone',                   'format' => '',                                          'width' => '0'),
            array('titulo' => '',                   'chave' => 'StatusAtividade.cor',               'format' => '',                                          'width' => '0'),
            array('titulo' => 'Demanda',            'chave' => 'Demanda.nome',                      'format' => ''                                          ,'width' => '20'),
            array('titulo' => 'Demandante',         'chave' => 'DemandaUsuario.first_name',         'format' => ''                                          ,'width' => '15'),
            array('titulo' => 'Atividade',          'chave' => 'Atividade.nome',                    'format' => ''                                          ,'width' => '20'),
            array('titulo' => 'Responsável',        'chave' => 'AtividadeUsuario.first_name',       'format' => ''                                          ,'width' => '15'),
            array('titulo' => 'Início',             'chave' => 'Atividade.data_prevista_inicio',    'format' => ''                                          ,'width' => '5'),
            array('titulo' => 'Término',            'chave' => 'Atividade.data_prevista_termino',   'format' => ''                                          ,'width' => '5'),
            array('titulo' => 'Status',             'chave' => 'StatusAtividade.nome',              'format' => ''                                          ,'width' => '5'),            
            array('titulo' => 'Duração',            'chave' => 'Etapa.duracao',                     'format' => ''                                          ,'width' => '5'),
            array('titulo' => 'Conclusão',          'chave' => 'Atividade.percentual_conclusao',    'format' => '$this->format_percentual_conclusao(%%%)'   ,'width' => '6'),//
            array('titulo' => 'Ações',              'chave' => 'Atividade.id',                      'format' => '$this->element("button_action_factory",    array("id"=>%%%,"icon"=>"fa fa-edit",       "class"=>"editar","title"=>"Editar atividade",    "controller"=>"atividades","action"=>"editAtividade","disabled"=>""))','width' => '5', 'permissions'=>'Atividades/editAtividade'),
            array('titulo' => ' ',                  'chave' => 'Atividade.id',                      'format' => '$this->element("button_action_factory",    array("id"=>%%%,"icon"=>"fa fa-paperclip",  "class"=>"anexar","title"=>"Anexar arquivo",      "controller"=>"arquivos","action"=>"add","disabled"=>""))', 'permissions'=>'Arquivos/add'),
            array('titulo' => ' ',                  'chave' => 'Atividade.id',                      'format' => '$this->element("button_action_factory",    array("id"=>%%%,"icon"=>"fa fa-hand-o-up",  "class"=>"assumir","title"=>"Assumir atividade",  "controller"=>"atividades","action"=>"assumir_edit","confirm"=>"Deseja mesmo assumir esta atividade?","disabled"=>""))', 'permissions'=>'Atividades/assumir_edit'),
            array('titulo' => ' ',                  'chave' => 'Atividade.id',                      'format' => '$this->element("button_action_factory",    array("id"=>%%%,"icon"=>"fa fa-user",       "class"=>"delegar","title"=>"Delegar atividade",  "controller"=>"atividades","action"=>"delegaAtividade","disabled"=>""))', 'permissions'=>'Atividades/delegaAtividade'),
            array('titulo' => ' ',                  'chave' => 'Atividade.id',                      'format' => '$this->element("button_action_factory",    array("id"=>%%%,"icon"=>"fa fa-check",      "class"=>"avancar","title"=>"Avançar atividade",  "controller"=>"atividades","action"=>"avancarAtividade","disabled"=>""))', 'permissions'=>'Atividades/avancarAtividade'),
            array('titulo' => ' ',                  'chave' => 'Atividade.id',                      'format' => '$this->element("button_action_factory",    array("id"=>%%%,"icon"=>"fa fa-ban",        "class"=>"cancelar","title"=>"Cancelar atividade","controller"=>"atividades","action"=>"cancelar","disabled"=>""))', 'permissions'=>'Atividades/cancelar')

        ),
        'linhas' => $minhasAtividades
)));
echo $this->element('legendas');
?>
<div class="modal-dialog">
    
</div>

<script type="text/javascript">
$(document).ready(function(){
    
    $( ".modal-dialog" ).dialog({
        
        autoOpen: false,
        resizable: false,
        draggable: true,
        modal: true,
        width: 800,
        open: function( event, ui ){

            $(this).data( "uiDialog" )._title = function(title) {
                title.html( this.options.title );
            };
            
            $("button.ui-button").remove();
            $("button.ui-dialog-titlebar-close").remove();
            
        }
    });
    
    $("table#table").find( 'a' ).click(function(e){

        var titulo = $(this).find('.botao').attr('title');

        if( $(this).hasClass('assumir') ){}else{

            $('div.modal-dialog').empty();

            $('div.modal-dialog').load( $(this).attr("href") );

            $('div.modal-dialog').dialog('open');

            var html = "<?php echo $this->element('barra_cabecalho', array('title' => '')); ?>";
            
            var elem = $(".ui-dialog-title")[2];
            
            elem.innerHTML = html;
            
            var elemento = $(elem).find( "div#titulo-controller" );

            elemento.text( titulo );

            $("span#close_superior_window").click(function(){
                
                $(".ui-dialog-content").dialog("close");
            });

            return false;
        }
    });    
});
</script>