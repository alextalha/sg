<?php 
if(!$this->Session->check('exportar')){  ?>


    <div id="cancelar" title="Cancelar Demanda" style="display: none;">

<?php
    
}
/*
 *  Mensagem de sucesso caso edite ou crie uma demanda 
 */
//=======Querys=========//
$processo = "select Processo.id, Processo.nome from processos as Processo where Processo.ativo = 1";
$etapas   = "select Etapa.id, Etapa.nome from etapas as Etapa inner join processos as Processo on Processo.id = Etapa.processo_id where Processo.ativo = 1";
//=======Querys=========//

	echo $this->element('form',array('form'=>array(
		'titulo'=> "Cancelar Demanda",
		'create'=> 'Demanda',
		'type'=>'horizontal',
		'action'=>'cancelar_demanda',
                'window'=> 'modal',
		'inputs'=>array(
			array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden','id'=>'cancelar_Demanda_id')),
			array('titulo'=>'Motivo do cancelamento','chave'=>'motivo_cancelamento','options'=>array('type'=>'textarea','required'=>'required','control-group-opt' => array('display' => 'row', 'style' => 'width:100%'))),
		)
	)));

echo $this->Session->check('exportar')? "":"</div>"; 

echo $this->element('tabela-cabecalho-superior-com-paginacao', array('tabela' => array(
        'titulo' => (isset($processo_id) && isset($demandas[0])) ? __("Demandas") . ": " . $demandas[0]["Processo"]["nome"] : __("Demandas"),
        'barra_filtro' => $this->element('filtro_drop_box', array(
            'nome' => 'demanda',
            'novo' => $this->Html->url(array("controller" => "demandas", "action" => "add")),
            'filtros' => array(
                
                array('text' => 'ID',           'name' => 'Demanda.id',                     'type' => 'num'),
                array('text' => 'ID Origem',    'name' => 'Demanda.demanda_origem_id',      'type' => 'num'),
                array('text' => 'Processo',     'name' => 'Processo.id',                    'type' => 'select', 'ref' => 'Processo=>'.$processo),
                array('text' => 'Demanda',      'name' => 'Demanda.nome',                   'type' => 'text'),
                array('text' => 'Demandante',   'name' => 'Demanda.usuario_id',             'type' => 'select', 'ref' => 'Usuario'),
                array('text' => 'Responsáveis', 'name' => 'Demanda.atividade_usuario_id',   'type' => 'select', 'ref' => 'Usuario'),
                array('text' => 'Início',       'name' => 'Demanda.data_inicio',            'type' => 'date-interval'),
                array('text' => 'Término',      'name' => 'Demanda.data_prevista_termino',  'type' => 'date-interval'),
                array('text' => 'Fase',         'name' => 'Demanda.fase_id',                'type' => 'select', 'ref' => 'Etapa=>'.$etapas),
                array('text' => 'Status',       'name' => 'StatusDemanda.id',               'type' => 'select', 'ref' => 'StatusAtividade'),
                array('text' => 'Duração',      'name' => 'Processo.duracao',               'type' => 'num'),
                array('text' => 'Conclusão',    'name' => 'Demanda.percentual_conclusao',   'type' => 'text'),

                /*Campos Especialidados*/
                array('name' => 'Demanda.grupo_id', 'type' => 'select',         'text' => 'Grupo', 'ref' => 'Grupo'),
                array('text' => 'Observações',  'name' => 'Demanda.descricao',              'type' => 'text'),
                
            ),
            'fields' => $fields
            )
        ),
        'colunas' => array(
            
            array('titulo' => '',               'chave' => 'StatusDemanda.cor',             'format' => '', 'width' => '0'),
            array('titulo' => 'ID',             'chave' => 'Demanda.id',                    'format' => '', 'width' => '5'),
            array('titulo' => 'ID Origem',      'chave' => 'Demanda.demanda_origem_id',     'format' => '', 'url' => $this->Html->url(array("controller" => "demandas", "action" => "edit")), 'width' => '5'),
            array('titulo' => 'Processo',       'chave' => 'Processo.nome',                 'format' => '', 'width' => '15'),
            array('titulo' => 'Demanda',        'chave' => 'Demanda.nome',                  'format' => '', 'width' => '15'),
            array('titulo' => 'Demandante',     'chave' => 'Usuario.first_name',            'format' => '', 'width' => '10'),
            array('titulo' => 'Responsável',    'chave' => 'ResponsavelDemanda.first_name', 'format' => '', 'width' => '10'),
            array('titulo' => 'Início',         'chave' => 'Demanda.data_inicio',           'format' => '', 'width' => '5'),
            array('titulo' => 'Término',        'chave' => 'Demanda.data_prevista_termino', 'format' => '', 'width' => '5'),
            array('titulo' => 'Fase',           'chave' => 'Demanda.fase',                  'format' => '', 'width' => '10'),
            array('titulo' => 'Status',         'chave' => 'StatusDemanda.nome',            'format' => '', 'width' => '5'),
            array('titulo' => 'Duração',        'chave' => 'Processo.duracao',              'format' => '', 'width' => '6'),
            array('titulo' => 'Conclusão',      'chave' => 'Demanda.percentual_conclusao',  'format' => '$this->format_percentual_conclusao(%%%)', 'width' => '5'),            
            array('titulo' => 'Ações',          'chave' => 'Demanda.id',                    'format' => '$this->element("button_action_factory", array("id"=>%%%,"icon"=>"fa fa-edit", "class"=>"editar","title"=>"Editar demandas","controller"=>"demandas","action"=>"edit","disabled"=>""))','width' => '5', 'permissions'=>'Demandas/edit'),
            array('titulo' => ' ',              'chave' => 'Demanda.id',                    'format' => '$this->element("button_action_factory",array("id"=>%%%,"icon"=>"fa fa-ban","class"=>"cancelar","title"=>"Cancelar demandas","controller"=>"demandas","action"=>"cancelar_demanda","disabled"=>""))', 'permissions'=>'Demandas/cancelar_demanda')
        ),
        'linhas' => $demandas
)));
echo $this->element('legendas');
?>
<script type="text/javascript">

    $(function(){

        var demandas = <?php echo json_encode($demandas); ?>;

        $("#novo_demanda").on("click", function () {

            if (getActionIndex() === "") {
            } else {

                var url = $(this).attr('href');
                $(this).attr('href', url + "/" + getActionIndex());
            }
        });

        $(".subtabela").parent().css('padding', 0).each(function () {
            var height_td = $(this).height();
            var height_subth = $(this).find('th').height();
            $(this).find('td').prop('height', height_td - height_subth);
        });
        
        $("#cancelar").dialog({

            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            open: function (event, ui){

                var win = $(this);
                var title = ($("#modal_adicionar_linha").children("div").attr("title") === undefined) ? "" : $("#modal_adicionar_linha").children("div").attr("title");

                $(this).data("uiDialog")._title = function (title) {
                    title.html(this.options.title);
                };
                
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => 'Cancelar Demanda' )); ?>");
                $("button.ui-button").remove();

                if (title === "") {} else {
                    $(this).prev("div").find("#titulo-controller").text(title);
                }

                $(this).prev().find("span#close_superior_window").on('click', function () {

                    win.dialog("close");
                });
            }
        });        

        $(".cancelar").on("click", function (e) {
        
            e.preventDefault();
            
            $("#DemandaCancelarDemandaForm").trigger("reset");

            if (checkDemanda(demandas, $(this).prop("rel"))) {

                $("#cancelar_Demanda_id").prop("value", $(this).prop("rel"));
                
                $.ajax({
                    
                    url: myBaseUrl + "demandas/cancelar",
                    type: "post",
                    data: {demanda_id: $(this).prop("rel")},
                    dataType: "json",
                    global: false,
                    async: false,
                    success: function ( data ) {
                        
                        $("#cancelar").dialog("open");
                    }
                }).responseJSON;

            } else {

                alert("Não é possivel cancelar uma demanda CANCELADA ou CONCLUIDA!");
            }
        });

        function checkDemanda( demanda, id ) {

            if (!demanda || $.isEmptyObject(demanda)) {
                return false;
            }
            var result = false;
            $.each(demanda, function (i, v) {

                if (parseInt(v.Demanda.id) === parseInt(id)) {

                    var data_cancel = v.Demanda.data_cancelamento;
                    var data_conclu = v.Demanda.data_conclusao;

                    if ((data_cancel === "" || data_cancel === null) && ( data_conclu === "" || data_conclu === null)) {

                        result = true;
                    }
                }
            });

            return result;
        }

        function getActionIndex() {

            var url = window.location.pathname;
            var result;

            if (url) {

                var url_array = url.split("/").reverse();

                var index = url_array[0];

                if ($.isNumeric(index)) {

                    result = index;
                } else {
                    result = "";
                }
            }
            return result;
        }
    });
</script>
