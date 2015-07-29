<?php

$creator_or_admin = (isset($creator_or_admin))?$creator_or_admin:true;

$grupo_id  = (isset($grupo_id) ? $grupo_id : '');
$subform[] = $this->element('treegrid', array('legendas' => true, 'root_id' => $demanda_id, 'form' => array(
        'titulo' => __('Atividades'),
        'idField' => 'id',
        'treeField' => 'nome',
        'add_button' => false,
        'otherkey' => '',
        'colunas' => array(
            
            array('titulo' => '',                       'chave' => 'emitir',                'format' => '', 'width' => '0','hidden' => true),
            array('titulo' => '',                       'chave' => 'acesso',                'format' => '', 'width' => '0','hidden' => true),
            array('titulo' => 'Nome',                   'chave' => 'nome',                  'format' => '', 'width' => '28'),
            array('titulo' => 'Responsável',            'chave' => 'usuario_nome',          'format' => '', 'width' => '14'),
            array('titulo' => 'SLA',                    'chave' => 'duracao',               'format' => '', 'width' => '3'),
            array('titulo' => 'Conclusão',              'chave' => 'percentual_conclusao',  'format' => '', 'width' => '7'),
            array('titulo' => 'Início Previsto',        'chave' => 'data_prevista_inicio',  'format' => '', 'width' => '8'),
            array('titulo' => 'Término Previsto',       'chave' => 'data_prevista_termino', 'format' => '', 'width' => '8'),
            array('titulo' => 'Início Real',            'chave' => 'data_real_inicio',      'format' => '', 'width' => '8'),
            array('titulo' => 'Término Real',           'chave' => 'data_real_termino',     'format' => '', 'width' => '8'),
            array('titulo' => 'Status',                 'chave' => 'status',                'format' => '', 'width' => '8'),
            array('titulo' => 'Ações',                  'chave' => 'id',                    'format' => 'format_acoes', 'width' => '12'),
            array('titulo' => '',                       'chave' => 'cor',                   'format' => '', 'width' => '0','hidden' => true),
            array('titulo' => '',                       'chave' => 'dados_acoes',           'format' => '', 'width' => '0','hidden' => true),
        )
)));

if ($type === "Add"){
      
    $option = array('value' => (isset($sugestao_demanda)?$sugestao_demanda:''), 'required' => 'required', 'control-group-opt' => array('display' => 'row','style'=>'width:50%'));

    $subform[] = $this->element('tabela-cabecalho-superior', 
        array('tabela' => array(
            'titulo' => __('Arquivos'),
            'barra_menu' => $this->element('icon-botoes', array('onclick' => '', "icon" => "fa fa-asterisk","class" => "modal_novo", "id" => "novo_arquivo", "text" => "Novo", "title" => "Novo Arquivo")),
            'id' => 'tabela_arquivos',
            'colunas' => array(
                array('titulo' => 'Atividade'  , 'chave' => 'origem', 'format' => '', 'width' => '30'),
                array('titulo' => 'Nome'       , 'chave' => 'nome', 'format' => '', 'width' => '30'),
                array('titulo' => 'Categoria'  , 'chave' => 'CategoriaArquivo.nome', 'format' => '', 'width' => '10'),
                array('titulo' => 'Tipo'       , 'chave' => 'tx_contenttype', 'format' => '', 'width' => '10'),
                array('titulo' => 'Extensão'   , 'chave' => 'tx_extensao', 'format' => '', 'width' => '5', 'class'=>'text-center'),
                array('titulo' => 'Criação'    , 'chave' => 'created', 'format' => 'date("d/m/Y",strtotime("%%%"))', 'width' => '10', 'class'=>'text-center'),
                //array('titulo' => 'Descrição', 'chave' => 'descricao', 'format' => ''),
                //array('titulo' => 'Usuário Responsável', 'chave' => 'Usuario.first_name', 'format' => ''),
                array('titulo' => 'Ações'      , 'chave' => 'id', 'format' => '$this->element("icon-download",array( "id" => "%%%", "url" => "" ) )', 'width' => '5', 'class'=>'text-center'),
                array('titulo' => ' '          , 'chave' => 'id', 'format' => '$this->element("icon-delete", array( "id" => "%%%", "controller" => "arquivos" ))'),
                array('titulo' => ' '          , 'chave' => 'id', 'format' => '$this->Form->input("Arquivo.%%%",array("type"=>"hidden","value"=>"%%%"))'),
            ),
            'linhas' => ''
        )
    ));    
    
} else { // edit
    
    $option = array('required' => 'required', 'control-group-opt' => array('display' => 'row','style'=>'width:50%'));

    
    if (!empty($demanda['Atividade'])) {

        $atividade = array();
        foreach ($demanda['Atividade'] as $i => $v) {

            if (!empty($v['Arquivo'])) {

                $demanda['Arquivo'] = array_merge($demanda['Arquivo'], $demanda['Atividade'][$i]['Arquivo']);
            }
        }
    }

    if (!empty($demanda['Arquivo'])) {

        foreach ($demanda['Arquivo'] as $i => $v) {

            if (isset($v['ArquivoAtividade'])) {

                foreach ($demanda['Atividade'] as $k => $val) {

                    if (!empty($val['Arquivo'])) {

                        foreach ($val['Arquivo'] as $x => $y) {

                            if ($y['id'] === $v['id']) {

                                $demanda['Arquivo'][$i]['origem'] = $demanda['Atividade'][$k]['nome'];
                            }
                        }
                    }
                }
            } else {

                $demanda['Arquivo'][$i]['origem'] = "";
            }
        }
    }

    $subform[] = $this->element('tabela-cabecalho-superior', array('tabela' => array(
            'titulo' => __('Arquivos'),
            'barra_menu' => $this->element('icon-botoes', array('onclick' => '', "icon" => "fa fa-asterisk","class" => "modal_novo", "id" => "novo_arquivo", "text" => "Novo", "title" => "Novo Arquivo")),
            'id' => 'tabela_arquivos',
            'colunas' => array(
                array('titulo' => 'Atividade',              'chave' => 'Atividade.0.nome', 'format' => '', 'width' => '30'),
                array('titulo' => 'Nome',                   'chave' => 'nome', 'format' => '', 'width' => '30'),
                array('titulo' => 'Categoria',              'chave' => 'CategoriaArquivo.nome', 'format' => '', 'width' => '10'),
                array('titulo' => 'Tipo',                   'chave' => 'tx_contenttype', 'format' => '', 'width' => '10'),
                array('titulo' => 'Extensão',               'chave' => 'tx_extensao', 'format' => '', 'width' => '5'),
                array('titulo' => 'Data de Criação',        'chave' => 'created', 'format' => 'date("d/m/Y",strtotime("%%%"))', 'width' => '10'),
                array('titulo' => 'Ações',                  'chave' => 'id', 'format' => '$this->element("icon-download",array("id"=>"%%%","url"=>""))', 'width' => '5'),
                //array('titulo' => 'Descrição',              'chave' => 'descricao', 'format' => ''),
                //array('titulo' => 'Usuário Responsável',    'chave' => 'Usuario.first_name', 'format' => ''),
                array('titulo' => ' ',                      'chave' => 'id', 'format' => '$this->element("icon-delete",array("id" => "%%%","controller"=>"arquivos"))'),
                array('titulo' => '',                       'chave' => 'id', 'format' => '$this->Form->input("Arquivo.%%%",array("type"=>"hidden","value"=>"%%%"))'),
            ),
            'linhas' => $demanda['Arquivo']
    )));
}

if( $creator_or_admin ){
    
    $nome       = array('titulo' => 'Nome',         'chave' => 'nome', 'options' => $option );
    $usuarios   = array('titulo' => 'Envolvidos',   'chave' => 'UsuariosEnvolvidos', 'options' => array('class' => 'chosen-select', 'size'=>'2','control-group-opt' => array('display' => 'row','style'=>'width:50%')));
    $descricao  = array('titulo' => 'Observações',  'chave' => 'descricao', 'options' => array( 'type' => 'textarea', 'control-group-opt' => array('display' => 'coll','style'=>'width:100%')));
    $codigo     = array('titulo' => 'Cód Origem',   'chave' => 'demanda_origem_id', 'options' => array( 'type' => 'text', 'control-group-opt' => array('display' => 'row','style'=>'width:10%') ));
    
} else {

    $option['disabled'] = true;
    
    $nome       = array('titulo' => 'Nome',         'chave' => 'nome', 'options' => $option );//'disabled' => true,
    $usuarios   = array('titulo' => 'Envolvidos',   'chave' => 'UsuariosEnvolvidos', 'options' => array('disabled' => true,'class' => 'chosen-select', 'size'=>'2','control-group-opt' => array('display' => 'row','style'=>'width:50%')));
    $descricao  = array('titulo' => 'Observações',  'chave' => 'descricao', 'options' => array( 'disabled' => true,'type' => 'textarea', 'control-group-opt' => array('display' => 'coll','style'=>'width:100%')));    
    $codigo     = array('titulo' => 'Cód Origem',   'chave' => 'demanda_origem_id', 'options' => array( 'disabled' => true,'type' => 'text', 'control-group-opt' => array('display' => 'row','style'=>'width:10%') ));
}

$usuario = (isset($usuario)) ? array('titulo' => 'Demandante','chave' => 'demandante','options'=>array('value'=>$usuario,'type' => 'text', 'disabled' => true,'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%'))) : array('titulo' => 'Demandante','chave' => 'demandante','options'=>array('type' => 'text', 'disabled' => true,'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%')));

echo $this->element('form', array('form' => array(
        'titulo' => __($type . ' %s', __('Demanda')),
        'create' => 'Demanda',
        'action' => ( $type === "Add" ) ? 'add' : 'edit',
        'id' => "DemandaForm",
        'subform' => $subform,
        'inputs' => array(
            
            array('titulo' => '',                       'chave' => 'id', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'atividades_json', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'atividades_ordem', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'propaga_datas', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'files', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'data_origem', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'data_cancelamento', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'data_conclusao', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'data_real_inicio', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'data_real_termino', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'data_prevista_inicio', 'options' => array('type' => 'hidden')),            
            array('titulo' => '',                       'chave' => 'status_atividade_id', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'atividade_usuario_id', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'usuario_id', 'options' => array('type' => 'hidden')),
            array('titulo' => '',                       'chave' => 'duracao', 'options' => array('type' => 'hidden')),
            array('titulo' => 'Cadastro',               'chave' => 'data_inicio', 'options' => array( 'type' => 'text', 'required' => true, 'class' => ( $type === "Add" ) ? 'datepick' : '', 'disabled' => ( $type === "Add" ) ? false : true, 'control-group-opt' => array('display' => 'row','style'=>'width:12%;') )),
            array('titulo' => 'Encerramento Previsto',  'chave' => 'data_prevista_termino', 'options' => array('type' => 'text', 'disabled' => true, 'control-group-opt' => array('display' => 'row','style'=>'width:12%;') )),
            array('titulo' => 'Encerramento Real',      'chave' => 'data_conclusao', 'options' => array('type' => 'text', 'disabled' => true, 'control-group-opt' => array('display' => 'row','style'=>'width:12%;') )),
            array('titulo' => 'Processo',               'chave' => 'processo_id', 'options'=>array('empty'=>'==Selecione==', 'required' => 'required', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%'))),
            $codigo,
            array('titulo' => 'Demanda Origem',         'chave' => 'demanda_origem_text', 'options' => array( 'disabled' => true, 'type' => 'text', 'control-group-opt' => array('display' => 'row','style'=>'width:40%') )),
            $usuario,
            //array('titulo' => 'Demandante',             'chave' => 'demandante',  'options'=>array('type' => 'text', 'disabled' => true,'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%'))),            
            $nome,
            array('titulo' => 'Grupo Responsável',      'chave' => 'grupo_id', 'options' => array('disabled' => true, 'empty'=>'==Selecione==', 'required' => 'required', 'control-group-opt' => array('display' => 'coll','style'=>'width:50%'))),
            $usuarios,
            $descricao,
            
        )
)));

?>
<div id="arquivo" title="Cadastrar Arquivo" style="display: none;">
<?php 

echo $this->element('form',array('form'=>array(
	'titulo'=> __($type.' %s', __('Arquivos')),
	'create'=> 'Arquivo',
	'type'=>'file',
	'action'=>'save',
        'window'=> 'modal',
	'inputs'=>array(
            
            array('titulo' => '',           'chave' => 'Arquivo.id',                    'options' => array('type' => 'hidden')),
            array('titulo' => '',           'chave' => 'Arquivo.versao',                'options' => array('type' => 'hidden')),
            array('titulo' => '',           'chave' => 'Demanda.id',                    'options' => array('type' => 'hidden', 'value' => '')),
            array('titulo' => '',           'chave' => 'Arquivo.usuario_id',            'options' => array('type' => 'hidden', 'value' => $this->UserAuth->getUsuarioId())),
            array('titulo' => '',           'chave' => 'Arquivo.nome',                  'options' => array('type' => 'hidden', 'value' => '')),
            array('titulo' => 'Arquivo',    'chave' => 'Arquivo.file',                  'options' => array('required' => 'required', 'type' => 'file','control-group-opt' => array('display' => 'row', 'style' => 'width:99%;'))),
            array('titulo'=>  'Atividades', 'chave' => 'Arquivo.atividade_id',          'options' => array('empty'=> '==Selecione==', 'options'=>'', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%') )),
            array('titulo' => 'Categoria',  'chave' => 'Arquivo.categoria_arquivo_id',  'options' => array('required' => 'required', 'empty' => '==Selecione==', 'options' => $categorias, 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%'))),
            array('titulo' => 'Descrição',  'chave' => 'Arquivo.descricao',             'options' => array('type' => 'textarea', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:100%'))),
            
	)
)));
//echo $this->Html->script('demanda/main');
echo $this->Html->script('arquivo/main');
?>
</div>
<div class="modal-dialog"></div>
<?php
/*
 * FELIPE - 10/06/2015 
 */ 
 // Colocando nomes amigaveis pras permissoes
$p = array('editar'  => $this->Permissions->check("Atividades/edit")
         , 'anexar'  => $this->Permissions->check("Arquivos/add")
         , 'assumir' => $this->Permissions->check("Atividades/assumir")
         , 'delegar' => $this->Permissions->check("Atividades/delegar")
         , 'cancelar'=> $this->Permissions->check("Atividades/cancelar")
         , 'avancar' => $this->Permissions->check("Atividades/avancar")
         , 'admin'   => ($this->UserAuth->isAdmin()?"true":"false"));
$msgSemAcesso = "Desculpe, você não tem permissão para acessar este conteúdo.";
$msgEncerrado = "Ação indisponível pois o item está encerrado.";
?>
<script type="text/javascript">
    
    /*
     * FELIPE - 10/06/2015 
     * - IMPORTACAO DO MAIN DEMANDAS PRA K (Q JA ERA PRA ESTAR ASSIM
     * - ALTERAÇÃO DA VALIDAÇÃO DE PERMISSIONAMENTO DE ATIVIDADES
     */ 
    $(document).ready(function(){
        // FELIPE - 10/06/2015 - BLOCO INI
        var r = getAction();
        setOnLoad();

        $( "#DemandaProcessoId" ).change(function(){

            if( $(this).val() === "" ){

                var html = '<option value="">===Selecione===</option>';
                $("#DemandaGrupoId").html( html );

                clearGrid();
                return false;
            }

            getSugestaoDemanda( $(this).val() );

            var grupo = getGrupo( $(this).val() );

            if( $.isEmptyObject( grupo ) || grupo === "" || grupo === undefined ){}else{

                var html = '<option value="'+grupo.id+'">'+grupo.nome+'</option>';
                $("#DemandaGrupoId").html( html );                    
            }

            var atividade = changeProcesso( $( this ).val(), $( "#DemandaDataInicio" ).val(), "processo" );

            if( atividade ){

                $( 'table#atividades' ).treegrid( 'loadData', atividade );
                var html = '<option value="">===Selecione===</option>';
                $("#ArquivoAtividadeId").html( loopObject( atividade, html ) );

            } else {

                $("#ArquivoAtividadeId").html('<option value="">===Selecione===</option>');
                clearGrid();
                return false; 
            }
        });

        $( "#DemandaDataInicio" ).change(function(){

            if( $("#DemandaDataOrigem").val() === "" ){}else{

                var data_ini = $("#DemandaDataInicio").val().split("/").reverse().join("-");

                if ((new Date( data_ini )).getTime() >= (new Date( $("#DemandaDataOrigem").val() )).getTime()) {} else {

                    alert("A Demanda atual não pode iniciar antes de sua origem!");
                    $("#DemandaDemandaOrigemId").val("");
                    $("#DemandaDemandaOrigemText").val("");
                    $("#DemandaDataOrigem").val("");
                }        
            }

            if( $( "#DemandaProcessoId" ).val() === "" ){} else {

                var resp = confirm("Deseja propagar datas das atividades?");
                if ( !resp ) { return false; }

                var atividade = changeProcesso( $( "#DemandaProcessoId" ).val(), $( this ).val(), "processo" );

                if( atividade ){

                    $( 'table#atividades' ).treegrid( 'loadData', atividade );
                    var html = '<option value="">===Selecione===</option>';
                    $("#ArquivoAtividadeId").html( loopObject( atividade, html ) );            

                } else {

                    $("#ArquivoAtividadeId").html( '<option value="">===Selecione===</option>' );  
                    clearGrid();
                    return false;
                }
            }
        });
        
        if($("#DemandaDataConclusao").val()){
            //$("#submit_Demanda")[0].parentNode.parentNode.className = "botao disable";
            $("#submit_Demanda")[0].parentNode.parentNode.attr("disabled", true);
            $(".limpar_botoes_form")[0].parentNode.parentNode.attr("disabled", true);
        }
        
        $("#submit_Demanda").click(function(){
            if( $("#DemandaDataCancelamento").val() || $("#DemandaDataConclusao").val() ){

                alert("Não é possível modificar uma demanda cancelada ou concluída!");
                return false;
            }

            var options = $( 'table#atividades' ).treegrid('options');

            if( options.otherkey ){

                $("#DemandaAtividadesJson").val( JSON.stringify( options.otherkey.atividades ) );
            }

            $("#DemandaProcessoId").attr("disabled", false);
            $("#DemandaGrupoId").attr("disabled", false);
            $("form#DemandaForm").submit();

        });

        //Ajustar o limpar//
        $("#DemandaForm").find(".limpar_botoes_form").on('click', function(){

            var s = confirm( "Deseja mesmo limpar todos os dados da tela?" );

            if ( !s ){

                return false;
            }

            data_cadastro = $('.datepick ').val();
            //$("#DemandaGrupoId").attr("disabled", false);
            $("form").trigger("reset");
            $('.datepick').val(data_cadastro);
            clearGrid();
            allArquivos();
            //$( "#DemandaGrupoId" ).attr("disabled", true);
        });

        function allArquivos() {

            var noArquivo = $("table#tabela_arquivos > tbody").find('tr#no_Arquivos');

            if( noArquivo.length > 0 ){}else{

                $("table#tabela_arquivos > tbody > tr").each(function(){

                    var existTD = $(this).children('td');
                    if (existTD.length > 0) {

                        $(this).remove();
                    }
                });

                var html = ['<tr id="no_Arquivos">',
                    '<td colspan="11">Não há Arquivos.</td>',
                    '</tr>'
                ].join('');

                $("table#tabela_arquivos > tbody").append(html);
            }
        }

        function getGrupo( processo_id ){

            var result = $.ajax({
                url: myBaseUrl + "processos/getGrupo/",
                type: "post",
                data: {processo_id: processo_id},
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {
                    return data;
                }
            }).responseJSON;

            return result;
        }

        function loopObject( obj, result ){

            if( $.isEmptyObject( obj ) ){

                return false;

            } else {

                $.each( obj, function( i, v ){

                    result += "<option value='"+v.id+"'>"+v.nome+"</option>";
                    if( v.children ){

                        result = loopObject( v.children, result );

                    }
                });
                return result;
            }
        }

        function changeProcesso( id, data, entidade ){

            if( id === "" ){ return false; }

            var info;
            if( entidade === "processo" ){

                info = {processo_id:id, data_inicio:data};
            }else{
                info = {demanda_id:id, data_inicio:data};
            }

            var url = myBaseUrl + "demandas/getAtividadesDemanda/";

            var result = $.ajax({
                url: url,
                type: "post",
                data: info,
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {

                    return data;
                }
            }).responseJSON;

            if ( result ) {

                var key = ( result.length - 1 );
                $('#DemandaDataPrevistaTermino').val( result[key].data_prevista_termino );
                var others = { id: id, data: $("#DemandaDataInicio").val(), atividades: result };
                $('table#atividades').treegrid({ otherkey: others });

                return result;
            } else {
                return false;
            }
        }

        function getSugestaoDemanda( processo_id ){

            $.ajax({

                url: myBaseUrl + "processos/getSugestaoDemandaNome",
                type: "post",
                data: {processo_id:processo_id},
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {

                    $("#DemandaNome").val( data );
                }
            });
        }

        function setOnLoad(){

            var id = ( r.id ) ? r.id : $( "#DemandaProcessoId" ).val();

            if( $( "#DemandaDataInicio" ).val() === "" ){

                $( "#DemandaDataInicio" ).val( getDateNow() );
            }

            var atividade = changeProcesso( id, $( "#DemandaDataInicio" ).val(), "demanda" );

            if( atividade ){

                $( 'table#atividades' ).treegrid( 'loadData', atividade );
                var html = '<option value="">===Selecione===</option>';
                $("#ArquivoAtividadeId").html( loopObject( atividade, html ) );                

            } else {

                $("#ArquivoAtividadeId").html( '<option value="">===Selecione===</option>' );
                clearGrid();
                return false; 
            }
        }

        function clearGrid(){

            var node = $('table#atividades').treegrid('getData');

            if( node.length > 0 ){

                for( i = node.length; i > 0; i--){

                    $('table#atividades').treegrid( 'remove', node[0].id );
                }
            }
        }

        function getAction(){

            var url = window.location.pathname;
            var result;

            if( url ){

                var url_array    = url.split( "/" ).reverse();
                var options;

                url = url_array[0];

                if( $.isNumeric( url ) ){

                    options = {tipo:url_array[1],id:url_array[0]};
                } else {
                    options = {tipo:url_array[0],id:""};
                }
                result = options;
                if( result.tipo.toString() !== 'add' ){

                    $( "#DemandaProcessoId" ).attr("disabled", true);
                    $( "#DemandaGrupoId" ).attr("disabled", true);
                }        
            }
            return result;
        }

        function getDateNow(){

            var hoje = new Date();
            var _dia = hoje.getDate();
            var dia  =  ( _dia.toString().length === 1 ) ? "0"+_dia : _dia;
            var _mes = (parseInt(hoje.getMonth())+1);
            var mes  = ( _mes.toString().length === 1 ) ? "0"+_mes : _mes;
            var ano  = hoje.getFullYear();
            var data = dia+"/"+mes+"/"+ano;

            return data;
        }
        // FELIPE - 10/06/2015 - BLOCO FIM
        
        onLoading( '<?php echo $type; ?>' );
        
        $("#DemandaDemandaOrigemId").blur(function(){
            verifica_origem( $(this).val() );
        });
        
        $("#arquivo").dialog({

            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: '900',
            open: function (event, ui){

                var win = $(this);
                
                $(this).data("uiDialog")._title = function (title) {
                    title.html(this.options.title);
                };
                
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => 'Adicionar Arquivo' )); ?>");
                $("button.ui-button").remove();

                $(this).prev().find("span#close_superior_window").on('click', function () {

                    win.dialog("close");
                });
            }
        });

        $("#novo_arquivo").on("click", function(e){

            e.preventDefault();
            
            $("#ArquivoSaveForm").trigger('reset');
            
            $("#ArquivoAtividadeId").prop('disabled', false);
            $("#arquivo").dialog("open");
            
        });
       
        function fn_ehCriador(){
            return ($("#DemandaUsuarioId").val()=='<?php echo $this->UserAuth->getUsuarioId();?>');
        }
        
        function fn_ehResponsavel(_ref){
            var _cur = ('<?php echo $this->session->read('UserAuth.Usuario.nome'); ?>').replace(/ /g,'').toLowerCase();
            var _act = _ref.parentNode.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML.replace(/ /g,'').toLowerCase();
            return (_cur==_act);
        }
        
        function fn_semResponsavel(_ref){
            return (_ref.parentNode.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML.replace(/ /g,'').toLowerCase()=="");
        }
        
        function fn_encerrado(_ref){
            console.log( _ref );
            
            var id   = $(_ref).attr('rel');
            var node = $("table#atividades").treegrid( 'find', id );
            
            console.log( node );
            
            return (_ref.parentNode.parentNode.parentNode.childNodes[9].childNodes[0].innerHTML != "");
        }
        
        $(".editar_atividades").on("click", function(){
<?php       if($p['editar']){ ?>
               if((!(fn_ehCriador() || fn_ehResponsavel(this) || <?php echo $p['admin']; ?>)) || fn_encerrado(this)){
                   // bloquear o botao salvar do modal de atividade ao inves do return false
                   //return false;
               }
<?php       }else{
               echo "alert('".$msgSemAcesso."');";
            }   ?>
        });
        
        $(".anexar").on("click", function(){
<?php       if($p['anexar']){ ?>
               if(!(fn_ehCriador() || fn_ehResponsavel(this) || <?php echo $p['admin']; ?>)){
                   alert('<?php echo $msgSemAcesso;?>');
                   return false;
               }
               if(fn_encerrado(this)){
                   alert('<?php echo $msgEncerrado;?>');
                   return false;
               }
<?php       }else{
               echo "alert('".$msgSemAcesso."');";
            }   ?>
        });
        
        $(".assumir").on("click", function(){
<?php       if($p['assumir']){ ?>
               if(!(fn_ehCriador() || fn_ehResponsavel(this) || fn_semResponsavel(this) || <?php echo $p['admin']; ?>)){
                   alert('<?php echo $msgSemAcesso;?>');
                   this.className = 'assumir disable';
                   return false;
               }
               if(fn_encerrado(this)){
                   alert('<?php echo $msgEncerrado;?>');
                   return false;
               }
<?php       }else{
               echo "alert('".$msgSemAcesso."');";
            }  ?>
        });
        
        $(".delegar").on("click", function(){
<?php       if($p['delegar']){ ?>
               if(!(fn_ehCriador() || <?php echo $p['admin']; ?>)){
                   alert('<?php echo $msgSemAcesso;?>');
                   return false;
               }
               if(fn_encerrado(this)){
                   alert('<?php echo $msgEncerrado;?>');
                   return false;
               }
<?php       }else{
               echo "alert('".$msgSemAcesso."');";
            }  ?>
        });
        
        $(".avancar").on("click", function(){
<?php       if($p['avancar']){ ?>
               if(!(fn_ehResponsavel(this) || <?php echo $p['admin']; ?>)){
                   alert('<?php echo $msgSemAcesso;?>');
                   return false;
               }
               if(fn_encerrado(this)){
                   alert('<?php echo $msgEncerrado;?>');
                   return false;
               }
<?php       }else{
               echo "alert('".$msgSemAcesso."');";
            }  ?>
        });
        
        $(".cancelar").on("click", function(){
<?php       if($p['cancelar']){ ?>
               if(!(fn_ehCriador() || fn_ehResponsavel(this) || <?php echo $p['admin']; ?>)){
                   alert('<?php echo $msgSemAcesso;?>');
                   return false;
               }
               if(fn_encerrado(this)){
                   alert('<?php echo $msgEncerrado;?>');
                   return false;
               }
<?php       }else{
               echo "alert('".$msgSemAcesso."');";
            }  ?>
        });
        
        /*
         * FELIPE GRAÇA - 11/06/2015
         * Temos de ter essa funcao aqui dentro pois por escopo, eu so poderei alterar a table, apos a carga do jQuery 
         * (pois ela é carregada por jQuery), então não adianta manipular o objeto por fora (estranho)
         */ 
        var data = $("table#atividades").treegrid('getData');
        setStatusColor( data );
        function setStatusColor( obj_treegrid ){
            
            $.each(obj_treegrid, function (index, row) {

                if( row.cor && row.cor !== null ){
                    
                    $("tr[node-id='"+row.id+"']").css('background-color',row.cor.toString());
                }
                if( row.children ){
                    
                    setStatusColor( row.children );
                }
            });
        }
        
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
    
    function format_acoes( value, row ){
    
        var editar          = [<?php echo json_encode( $this->element( "icon-view", array( "id" => "%%%", "controller" => "atividades" ) ) ); ?>,<?php echo json_encode( $this->element( "icon-view", array( "id" => "%%%", "controller" => "atividades", "mode" => "disable" ) ) ); ?>];
        var anexar          = [<?php echo json_encode( $this->element( "icon-anexar", array( "id" => "%%%" ) ) ); ?>,<?php echo json_encode( $this->element( "icon-anexar", array( "id" => "%%%", "mode" => "disable" ) ) ); ?>];
        var assumir         = [<?php echo json_encode( $this->element( "icon-assumir", array( "controller" => "atividades", "id" => "%%%" ) ) ); ?>,<?php echo json_encode( $this->element( "icon-assumir", array( "controller" => "atividades", "id" => "%%%", "mode" => "disable" ) ) ); ?>];
        var delegar         = [<?php echo json_encode( $this->element( "icon-delegar", array( "id" => "%%%" ) ) ); ?>,<?php echo json_encode( $this->element( "icon-delegar", array( "id" => "%%%", "mode" => "disable" ) ) ); ?>];
        var avancar         = [<?php echo json_encode( $this->element( "icon-avancar", array( "id" => "%%%" ) ) ); ?>,<?php echo json_encode( $this->element( "icon-avancar", array( "id" => "%%%", "mode" => "disable" ) ) ); ?>];
        var cancelar        = [<?php echo json_encode( $this->element( "icon-cancelar", array( "id" => "%%%" ) ) ); ?>,<?php echo json_encode( $this->element( "icon-cancelar", array( "id" => "%%%", "mode" => "disable" ) ) ); ?>];

        // TODO: IMPLEMENTAR POR FACTORY DEPOIS
        
        // Permissions
        var _cur              = '<?php echo $this->session->read('UserAuth.Usuario.id'); ?>';
        var _grupoIdUsuario   = [0<?php foreach($this->session->read('UserAuth.Grupo') as $k=>$v){ echo ",".$v["id"]; } ?>];
        var _grupoIdAtividade = (row.grupo_id==null ? $("#DemandaGrupoId")[0].value : row.grupo_id);
        
        var _ehAdmin          = <?php echo $p['admin']; ?>;
        
        var _ehCriador        = ($("#DemandaUsuarioId")[0].value==_cur);
        var _ehResponsavel    = (row.usuario_id==_cur);
        var _ehDoGrupo        = (_grupoIdUsuario.indexOf(_grupoIdAtividade*1)>-1); // MUDAR ISSO PARA O GRUPO DA ETAPA
        var _semResponsavel   = (row.usuario_id=='' || row.usuario_id==null);
        var _encerrado        = (row.data_real_termino=="" || row.data_real_termino == null?false:true);
        
        var _canEditar  = <?php echo ($p['editar']  ?"true":"false"); ?> ;
        var _canAnexar  = <?php echo ($p['anexar']  ?"true":"false"); ?>;
        var _canAssumir = <?php echo ($p['assumir'] ?"true":"false"); ?>;
        var _canDelegar = <?php echo ($p['delegar'] ?"true":"false"); ?>;
        var _canCancelar= <?php echo ($p['cancelar']?"true":"false"); ?>;
        var _canAvancar = <?php echo ($p['avancar'] ?"true":"false"); ?>;
        
        var res             = "";
        //res += editar[( row.acesso.editar)?0:1];
        res += editar[ _canEditar || _ehAdmin ?0:0];
        res += anexar[( _canAnexar && _ehDoGrupo && !_encerrado ) || _ehAdmin ?0:1];
        res += assumir[( _canAssumir && _ehDoGrupo && _semResponsavel && !_encerrado ) || _ehAdmin ?0:1];
        res += delegar[( _canDelegar && _ehDoGrupo && !_encerrado ) || _ehAdmin ?0:1];
        res += avancar[( _ehResponsavel && _canAvancar && !_encerrado ) || _ehAdmin ?0:1];
        res += cancelar[( ( _ehCriador || _ehResponsavel ) && _canCancelar && !_encerrado ) || _ehAdmin ?0:1];
        return res.replace(/%%%/g, value);
    }

    function setValCombo( combo_id, combo_val ){
        
        var index = $("select[name='" + combo_id + "'] option[value='" + combo_val + "']").index();
        $("select[name='" + combo_id + "'] option:eq(" + index + ")").attr('selected', 'selected');        
    }
    
    function verifica_origem( origem ){
        
        if( origem === "" ){return false;}
        
        var result = $.ajax({
            
            url: myBaseUrl + "demandas/checkOrign/",
            type: "post",
            data: {origem:origem},
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                return data;
            }

        }).responseJSON;
        
        if( $.isEmptyObject( result ) ){
            
            alert( "Esta demanda não existe!" );
            $("#DemandaDemandaOrigemId").val("");
            $("#DemandaDemandaOrigemText").val("");
            $("#DemandaDataOrigem").val("");
            
        } else {
            
            var data_ini = $("#DemandaDataInicio").val().split("/").reverse().join("-");
            
            if((new Date(data_ini)).getTime() >= (new Date(result.data_inicio)).getTime()){
                
                $("#DemandaDemandaOrigemText").val( result.nome );
                $("#DemandaDataOrigem").val( result.data_inicio );
                $("#DemandaDemandaOrigemId").val( result.id );
                
            } else {
                
                alert( "A Demanda atual não pode iniciar antes de sua origem!" );
                $("#DemandaDemandaOrigemId").val("");
                $("#DemandaDemandaOrigemText").val("");
                $("#DemandaDataOrigem").val("");
            }
        }
    }

    function onLoading( type ){
        
        if( type === 'Add' ){
            
            var processo = "<?php echo $demanda_id; ?>";
            var grupo    = "<?php echo $grupo_id; ?>";
            
            if( !processo || processo === "" ){return false;}
            
            setValCombo( "data[Demanda][processo_id]", processo );
            setValCombo( "data[Demanda][grupo_id]", grupo );
            
            if( $("#DemandaProcessoId").val() === "" ){}else{
                $("#DemandaProcessoId").prop('disabled', 'disabled');
            }
            if( $("#DemandaGrupoId").val() === "" ){}else{
                $("#DemandaGrupoId").prop('disabled', 'disabled');
            }            
        }
    }

    
    

</script>