<div id="concluir" title="Concluir Demanda">
<?php 
	echo $this->element('form',array('form'=>array(
		'titulo'=> "Concluir Demanda",
		'create'=> 'Demanda',
		'type'=>'horizontal',
		'action'=>'concluir',
		'inputs'=>array(
			array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden','id'=>'concluir_Demanda_id')),
			array('titulo'=>'Descrição da conclusão','chave'=>'descricao_conclusao','options'=>array('type'=>'textarea')),
		)
	))); 
?>
</div>

<div id="cancelar" title="Cancelar Demanda">
<?php 
	echo $this->element('form',array('form'=>array(
		'titulo'=> "Cancelar Demanda",
		'create'=> 'Demanda',
		'type'=>'horizontal',
		'action'=>'cancelar',
		'inputs'=>array(
			array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden','id'=>'cancelar_Demanda_id')),
			array('titulo'=>'Motivo do cancelamento','chave'=>'motivo_cancelamento','options'=>array('type'=>'textarea','required'=>'required')),
		)
	))); 
?>
</div>

<div id="modal_excluir" title="Confirmação">Tem certeza que deseja excluir a demanda?</div>

<?php 

if ( is_array( $demandas_por_processo ) ){

    foreach ($demandas_por_processo as $processo => $demandas) {
            echo $this->element('tabela-cabecalho-superior',array('tabela'=>array(
                    'titulo'=>$processo,
                    'barra_menu'=>$this->element('icon-novo',array('nome'=>"demanda",'url'=>$this->Html->url(array("controller"=>"demandas","action"=>"add")))),
                    'colunas'=>array(
                            array('titulo'=>'ID','chave'=>'Demanda.id','format'=>''),
                            array('titulo'=>'Processo','chave'=>'Processo.nome','format'=>''),
                            array('titulo'=>'Nome da demanda','chave'=>'Demanda.nome','format'=>''),
                            array('titulo'=>'Descrição da demanda','chave'=>'Demanda.descricao','format'=>''),
                            array('titulo'=>'Data de início','chave'=>'Demanda.data_inicio','format'=>'date("d/m/Y",strtotime("%%%"))'),
                            array('titulo'=>'Data prevista de término','chave'=>'Demanda.data_prevista_termino','format'=>'date("d/m/Y",strtotime("%%%"))'),
                            array('titulo'=>'Duração (em dias)','chave'=>'Processo.duracao','format'=>''),
                            array('titulo'=>'Percentual de conclusão','chave'=>'Demanda.percentual_conclusao','format'=>'$this->format_percentual_conclusao(%%%)'),
                            array('titulo'=>'Fase','chave'=>'Demanda.atividades_andamento','format'=>''),
                            array('titulo'=>'Milestones','chave'=>'Milestone','format'=>'$this->subtabela($elemento_conteudo["Milestone"])'),
                            array('titulo'=>'Ações','chave'=>'Demanda.id','format'=>'$this->element("icon-view",array("id" => "%%%","controller"=>"demandas","url"=>true))'),
                            array('titulo'=>' ','chave'=>'Demanda.id','format'=>'$this->element("icon-delete",array("id" => "%%%","controller"=>"demandas"))'),
                            array('titulo'=>' ','chave'=>'Demanda.id','format'=>'$this->element("icon-concluir",array("id" => "%%%"))'),
                            array('titulo'=>' ','chave'=>'Demanda.id','format'=>'$this->element("icon-cancelar",array("id" => "%%%"))')
                    ),
                    'linhas'=>$demandas
            )));
    }
} else {
            echo $this->element('tabela-cabecalho-superior',array('tabela'=>array(
                    'titulo'=>__('Demandas'),
                    'barra_menu'=>$this->element('icon-novo',array('nome'=>"demanda",'url'=>$this->Html->url(array("controller"=>"demandas","action"=>"add")))),
                    'colunas'=>array(
                            array('titulo'=>'ID','chave'=>'Demanda.id','format'=>''),
                            array('titulo'=>'Processo','chave'=>'Processo.nome','format'=>''),
                            array('titulo'=>'Nome da demanda','chave'=>'Demanda.nome','format'=>''),
                            array('titulo'=>'Descrição da demanda','chave'=>'Demanda.descricao','format'=>''),
                            array('titulo'=>'Data de início','chave'=>'Demanda.data_inicio','format'=>'date("d/m/Y",strtotime("%%%"))'),
                            array('titulo'=>'Data prevista de término','chave'=>'Demanda.data_prevista_termino','format'=>'date("d/m/Y",strtotime("%%%"))'),
                            array('titulo'=>'Duração (em dias)','chave'=>'Processo.duracao','format'=>''),
                            array('titulo'=>'Percentual de conclusão','chave'=>'Demanda.percentual_conclusao','format'=>'$this->format_percentual_conclusao(%%%)'),
                            array('titulo'=>'Fase','chave'=>'Demanda.atividades_andamento','format'=>''),
                            array('titulo'=>'Milestones','chave'=>'Milestone','format'=>'$this->subtabela($elemento_conteudo["Milestone"])'),
                            array('titulo'=>'Ações','chave'=>'Demanda.id','format'=>'$this->element("icon-view",array("id" => "%%%","controller"=>"demandas","url"=>true))'),
                            array('titulo'=>' ','chave'=>'Demanda.id','format'=>'$this->element("icon-delete",array("id" => "%%%","controller"=>"demandas"))'),
                            array('titulo'=>' ','chave'=>'Demanda.id','format'=>'$this->element("icon-concluir",array("id" => "%%%"))'),
                            array('titulo'=>' ','chave'=>'Demanda.id','format'=>'$this->element("icon-cancelar",array("id" => "%%%"))')
                    ),
                    'linhas'=>''
            )));    
}


/*
                    'barra_filtro' => $this->element('filtro_drop_box',array(
                        'nome'       => 'demanda',
                        'barra_menu'=>$this->element('icon-novo-filtro',array('nome'=>"demanda",'url'=>$this->Html->url(array("controller"=>"demandas","action"=>"add")))),
                        'filtros'    => array(

                            array('text'=>'ID',                     'name'=>'Processo.id',          'type'=>'num'),
                            array('text'=>'Grupo',                  'name'=>'Grupo.id',             'type'=>'select'),
                            array('text'=>'Nome do processo',       'name'=>'Processo.nome',        'type'=>'text'),
                            array('text'=>'Descrição do processo',  'name'=>'Processo.descricao',   'type'=>'text'),
                            array('text'=>'Duração (em dias)',      'name'=>'Processo.duracao',     'type'=>'num'),
                            array('text'=>'Versão',                 'name'=>'Processo.versao',      'type'=>'num'),
                            array('text'=>'Ativo',                  'name'=>'Processo.ativo',       'type'=>'boolean'),

                            array('text'=>'ID',                         'name'=>'Demanda.id',                   'type'=>'num'),
                            array('text'=>'Processo',                   'name'=>'Processo.nome',                'type'=>'select'),
                            array('text'=>'Nome da demanda',            'name'=>'Demanda.nome',                 'type'=>'text'),
                            array('text'=>'Descrição da demanda',       'name'=>'Demanda.descricao',            'type'=>'text'),
                            array('text'=>'Data de início',             'name'=>'Demanda.data_inicio',          'type'=>'date-interval'),
                            array('text'=>'Data prevista de término',   'name'=>'Demanda.data_prevista_termino','type'=>'date-interval'),
                            array('text'=>'Duração (em dias)',          'name'=>'Processo.duracao',             'type'=>'num'),
                            //array('text'=>'Percentual de conclusão',    'name'=>'Demanda.percentual_conclusao', 'format'=>'$this->format_percentual_conclusao(%%%)'),
                            array('text'=>'Fase',                       'name'=>'Demanda.atividades_andamento', 'type'=>'text'),
                            //array('text'=>'Milestones',                 'name'=>'Milestone',                    'format'=>'$this->subtabela($elemento_conteudo["Milestone"])'),
                            
                            ),
                        'fields'     => $fields
                        )
                    ),  
*/


?>
<script type="text/javascript">
    $(function () {

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
            width: 'auto'
        });

        $("#concluir").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto'
        });

        $(".cancelar").on("click", function (e) {
            e.preventDefault();
            $("#cancelar_Demanda_id").prop("value", $(this).prop("id"));
            $("#cancelar").dialog("open");
        });

        $(".concluir").on("click", function (e) {
            e.preventDefault();
            $("#concluir_Demanda_id").prop("value", $(this).prop("id"));
            $("#concluir").dialog("open");
        });

        var excluir_id;
        var modal_excluir = $("#modal_excluir").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            buttons: {
                'Sim': function () {
                    if (excluir_id)
                        $.post(myBaseUrl + "demandas/delete/" + excluir_id);
                    excluir_id = null;
                },
                'Não': function () {
                    $(this).dialog("close");
                }
            }

        });

        $(".excluir_demandas").on("click", function (e) {
            e.preventDefault();
            excluir_id = $(this).prop('id');
            modal_excluir.dialog("open");
        });
    });
</script>
