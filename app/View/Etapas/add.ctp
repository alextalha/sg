<?php if (!isset($type_etapa)) $type_etapa = 'Add';

$options       = ( $type_etapa === 'Add' ) ? array('empty' => '==Selecione==', 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%')) : array( 'disabled' => true,'empty' => '==Selecione==', 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%'));
$options_grupo = ( $type_etapa === 'Add' ) ?  : array('empty' => '==Selecione==', 'required' => 'required', 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%'));
        
$inputs = array(
    
    array('titulo' => '', 'chave' => 'id', 'options' => array('type' => 'hidden')),
    array('titulo' => 'Processo', 'chave' => 'processo_id', 'options' => array('type' => 'hidden')),
    array('titulo' => 'Copiar de', 'chave' => 'parents', 'options' => $options ),
    array('titulo' => 'Grupo Responsável','chave' => 'grupo_id', 'options' => array( 'options' => $grupo, 'empty' => '==Selecione==', 'required' => 'required', 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%')) ),
    array('titulo' => 'Nome', 'chave' => 'nome', 'options' => array('required' => 'required', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%'))),
    array('titulo' => 'Duração', 'chave' => 'duracao', 'options' => array('required' => 'required', 'control-group-opt' => array('display' => 'row', 'style' => 'width:10%'))),
    array('titulo' => 'Milestone?', 'chave' => 'milestone', 'options' => array('type' => 'checkbox','class' => 'checkbox_filter', 'control-group-opt' => array('display' => 'row', 'style' => 'width:15%;float:right;'))),    
    array('titulo' => 'Dias úteis?', 'chave' => 'considerar_apenas_dias_uteis', 'options' => array('type' => 'checkbox','class' => 'checkbox_filter', 'control-group-opt' => array('display' => 'row', 'style' => 'width:15%;float:right;'))),
    array('titulo' => 'Descrição', 'chave' => 'descricao', 'options' => array('type' => 'textarea', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:100%'))),
    array('titulo' => '', 'chave' => 'children', 'options' => array('type' => 'hidden'))
);
?>
<div id="etapas" title="<?php if( $type_etapa == 'Add' ){echo "Adicionar";}else{echo "Editar";}?> Etapas" style="display: none;"></div>
<?php echo $this->element('form',array('form'=>array(
	'titulo'=> __($type_etapa.' %s', __('Etapa')),
	'create'=> 'Etapa',
	'action'=>'',
	'id'=>'EtapaForm',
        'window'=> 'modal',
	'inputs'=>$inputs
))); 
?>
<script type="text/javascript">
    $(function (){
        
        var type = '<?php echo $type_etapa; ?>';
        
        setChecked();
        
        if ($("#EtapaDuracao").val() < 1)
            $("#EtapaDuracao").val(1);
        $("#EtapaDuracao").on("change", function(){
            if ($(this).val() < 1)
                $(this).val(1);
        });

        if ($("#EtapaChildren").val() && $("#EtapaChildren").val() !== '""') {
            $("#EtapaDuracao").val("");
            $("#EtapaDuracao").prop('disabled', true);
            $("#EtapaConsiderarApenasDiasUteis").prop('checked', false);
            $("#EtapaConsiderarApenasDiasUteis").prop('disabled', true);
        }

        $("#EtapaParents").on("change", function (){
            $.ajax({type: "POST", async: false, dataType: 'json', url: myBaseUrl + "etapas/ajax_template/" + $(this).val()}).done(function (etapa) {

                $("#EtapaDuracao").val(etapa.duracao);
                $("#EtapaNome").val(etapa.nome);
                $("#EtapaDescricao").val(etapa.descricao);
                $("#EtapaConsiderarApenasDiasUteis").prop( 'checked', etapa.considerar_apenas_dias_uteis );
                $("#EtapaMilestone").prop('checked', etapa.milestone);
                $("#EtapaGrupoId option[value='"+ etapa.grupo_id +"']").prop("selected", "selected");
            });
        });
        
        $("#submit_Etapa").click(function(){
            
            if( $("#EtapaNome").val() === "" ){return false;}

            var form = $("#modal_adicionar_linha > form");
            updateRow( form );
            
        });     
        
        function setChecked(){
            
            if( type === 'Add' ){
                
                $("#EtapaForm").trigger("reset");
                $("#EtapaConsiderarApenasDiasUteis").attr( 'checked', false );
                $("#EtapaMilestone").attr( 'checked', false );
                
            } else {

                if( $("#EtapaConsiderarApenasDiasUteis").val() === 'true' ){

                    $("#EtapaConsiderarApenasDiasUteis").attr( 'checked', true );
                }else{
                    $("#EtapaConsiderarApenasDiasUteis").attr( 'checked', false );
                }

                if( $("#EtapaMilestone").val() === 'true' ){

                    $("#EtapaMilestone").attr( 'checked', true );
                }else{
                    $("#EtapaMilestone").attr( 'checked', false );
                }       
            }
        }

        function updateRow( form ){
            
            $.ajax({

                url: myBaseUrl + "etapas/return_json_request_data/",
                type: "post",
                data: form.serialize(),
                dataType: "json",
                global: false,
                async: false,
                success: function (data){
                    
                    if( !data.id ){return false;}
                    
                    var node = $("table#etapas").treegrid( 'find', data.id );

                    if( $.isEmptyObject( data ) ){}else{
                        
                        if( node === null ){

                            $("table#etapas").treegrid('append', {data: [data]});
                            
                        } else {
                        
                            $("table#etapas").treegrid('updateRow',{
                                index: data.id,
                                row: data
                            });
                        }
                        
                        $(".ui-dialog-content").dialog("close");
                    }
                }
            });
        }
    });
</script>