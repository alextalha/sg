<div id="modal_excluir" title="Confirmação" style="display: none;">Tem certeza que deseja excluir o processo?
	<div id="loading" style="display: none;"><?php echo $this->Html->image('loading.gif');?></div>
</div>
<?php

//=======Querys=========//
$processo = "select Processo.id, Processo.nome from processos as Processo where Processo.ativo = 1";
//=======Querys=========//

echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
            'titulo'=>__('Processos'),
            'barra_filtro' => $this->element('filtro_drop_box',array(
            'nome'       => 'processo',
            'novo'       => $this->Html->url(array("controller"=>"processos","action"=>"add")),
            'filtros'    => array(
                
		array('text'=>'ID',         'name'=>'Processo.id',          'type'=>'num'),
		array('text'=>'Grupo',      'name'=>'Processo.grupo_id',    'type'=>'select', 'ref' => 'Grupo'),
		array('text'=>'Nome',       'name'=>'Processo.id',          'type'=>'select', 'ref' => 'Processo=>'.$processo),
		array('text'=>'Descrição',  'name'=>'Processo.descricao',   'type'=>'text'),
		array('text'=>'Duração',    'name'=>'Processo.duracao',     'type'=>'num'),
		array('text'=>'Versão',     'name'=>'Processo.versao',      'type'=>'num'),
		array('text'=>'Ativo',      'name'=>'Processo.ativo',       'type'=>'boolean'),	                
                
                ),
            'fields'     => $fields
            )
        ),
	'colunas'=>array(
		array('titulo'=>'ID',           'chave'=>'Processo.id',         'format'=>'', 'width' => '3','class'=>'text-right'),
		array('titulo'=>'Grupo',        'chave'=>'Grupo.nome',          'format'=>'', 'width' => '20'),
		array('titulo'=>'Nome',         'chave'=>'Processo.nome',       'format'=>'','width' => '20'),
		array('titulo'=>'Descrição',    'chave'=>'Processo.descricao',  'format'=>'','width' => '40'),
		array('titulo'=>'Duração',      'chave'=>'Processo.duracao',    'format'=>'','width' => '5','class'=>'text-right'),
		array('titulo'=>'Versão',       'chave'=>'Processo.versao',     'format'=>'','width' => '5','class'=>'text-center'),
		array('titulo'=>'Ativo',        'chave'=>'Processo.ativo',      'format'=>'$this->element("icon-ativar",array("id"          => $elemento_conteudo["Processo"]["id"], "controller"=>"processos","ativo"=>"%%%"))' ,'width' => '5','class'=>'text-center'),
                array('titulo'=>'Ações',        'chave'=>'Processo.id',         'format'=>'$this->element("icon-view",  array("id"          => "%%%","controller"=>"processos","url"=>true))','width' => '5','class'=>'text-center'),
		array('titulo'=>' ',            'chave'=>'Processo.id',         'format'=>'$this->element("icon",       array("id"=>"%%%", "icon" => "copy","text"  => "","fa" => "fa", "title" => "Cadastrar nova demanda deste processo","url"=>$this->Html->url(array("controller"=>"demandas","action" =>"add",%%%))))','width' => '0'),
		array('titulo'=>' ',            'chave'=>'Processo.id',         'format'=>'$this->element("icon",       array("id"=>"%%%", "icon" => "tasks","text" => "","fa" => "fa", "title" => "Ver demandas em andamento deste processo","url"=>$this->Html->url(array("controller"=>"demandas","action" =>"index",%%%))))','width' => '0'),
		array('titulo'=>' ',            'chave'=>'Processo.id',         'format'=>'$this->element("icon-delete",array("controller"  => "processos","id" => "%%%"))','width' => '0'),
	),
	'linhas'=>$processos
))); 
?>
<script type="text/javascript">
    
$(document).ready(function(){
    
    viewControls( <?php echo json_encode( $processos, JSON_FORCE_OBJECT ); ?> );
    
    $(".excluir_processos_disable").on( "click", function( e ){
        
        e.preventDefault();
        alert( "Existem demandas deste processo, exclusão não permitida!" );
        return false;
    });

    $('.editar_processos').on('click', function(){

        var id = $(this).prop('id');
        var data = myBaseUrl + "processos/edit/"+id;
        jQuery( location ).attr( 'href', data );
        return false;

    });
    
    function viewControls( obj ){
        
        if( !obj || obj === "" ){return false;}
        $.each( obj, function( i, v ){
            
            if(  !$.isEmptyObject( v.Demanda ) ){
                
                $( "a#" + v.Processo.id + ".excluir_processos" ).removeClass( "excluir_processos" ).addClass( "excluir_processos_disable disable" );
                $( "a#" + v.Processo.id + ".excluir_processos_disable > div.botao" ).css("color", "#ccc");
                
            } else {
                
                $( "a#" + v.Processo.id + ".tasks" ).attr('href','#');
                $( "a#" + v.Processo.id + ".tasks > div.botao" ).css("color", "#ccc");
            }
            
            var result = checkChildrenProcess( v.Processo.id );
            
            if( result === 'true' ){
                
                $( "a#" + v.Processo.id + ".copy" ).attr('href','#');
                $( "a#" + v.Processo.id + ".copy > div.botao" ).css("color", "#ccc");
                
                $( "a#" + v.Processo.id + ".activate" ).attr('href','#');
                $( "a#" + v.Processo.id + ".activate > div.botao" ).css("color", "#ccc");
                
                $( "a#" + v.Processo.id + ".activate > div.botao" ).attr('title','Desabilitado');
            }
            
        });
    }
    
    function checkChildrenProcess( processo_id ){

        var result = $.ajax({
            
            url: myBaseUrl + "processos/checkchildren",
            type: "post",
            data: { processo_id:processo_id },
            dataType: "json",
            global: false,
            async: false,
            success: function (data){
                return data;
            }
        }).responseJSON;
        
        return result;
    }
});
</script>
