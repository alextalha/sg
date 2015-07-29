<?php

$responsavel = $this->UserAuth->getUsuario()['Usuario']['id'];
$cancelada   = $this->data['Atividade']['data_cancelamento'];
$concluida   = $this->data['Atividade']['data_real_termino'];

if (!isset($type_atividade)) {
    $type_atividade = 'Add';
}

$obs      = array('titulo' => 'Observações', 'chave' => 'obs_diario', 'options' => array( 'type' => 'textarea','control-group-opt' => array('display' => 'coll','style'=>'width:100%')));
$ini_real = array('titulo' => 'Início Real', 'chave' => 'data_real_inicio', 'options' => array( 'type' => 'text', 'class' => 'datepick','control-group-opt' => array('display' => 'row','style'=>'width:25%')));

if( (is_null($cancelada) || empty($cancelada)) && ( is_null($concluida) || empty($concluida) ) ){
    
    if (isset($this->data['Atividade']['children'])) {

        $obs      = array('titulo' => 'Observações', 'chave' => 'obs_diario', 'options' => array('type' => 'textarea', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:100%')));
        $ini_real = array('titulo' => 'Início Real', 'chave' => 'data_real_inicio', 'options' => array('disabled' => true, 'type' => 'text', 'class' => '', 'control-group-opt' => array('display' => 'row', 'style' => 'width:25%')));
    }
    if( $type_atividade == 'Edit' && !$this->UserAuth->isAdmin() ){

        if( $responsavel != $this->data['Atividade']['usuario_id'] ){

            $obs      = array('titulo' => 'Observações', 'chave' => 'obs_diario', 'options' => array('disabled' => true, 'type' => 'textarea','control-group-opt' => array('display' => 'coll','style'=>'width:100%')));
            $ini_real = array('titulo' => 'Início Real', 'chave' => 'data_real_inicio', 'options' => array('disabled' => true, 'type' => 'text', 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%')));

        }
    }
}else{
    
    $obs      = array('titulo' => 'Observações', 'chave' => 'obs_diario', 'options' => array('disabled' => true, 'type' => 'textarea','control-group-opt' => array('display' => 'coll','style'=>'width:100%')));
    $ini_real = array('titulo' => 'Início Real', 'chave' => 'data_real_inicio', 'options' => array('disabled' => true, 'type' => 'text', 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%')));
}

$inputs = array(
    
    array('titulo' => '',                   'chave' => 'id', 'options' => array('type' => 'hidden')),
    array('titulo' => '',                   'chave' => 'etapa_id', 'options' => array('type' => 'hidden')),
    array('titulo' => '',                   'chave' => 'usuario_nome', 'options' => array('type' => 'hidden')),
    array('titulo' => '',                   'chave' => 'justifique_data', 'options' => array('type' => 'hidden')),
    array('titulo' => '',                   'chave' => 'ordem', 'options' => array('type' => 'hidden')),
    array('titulo' => 'Demanda',            'chave' => 'demanda_id', 'options' => array('type' => 'hidden')),
    array('titulo' => 'Nome da atividade',  'chave' => 'nome', 'options' => array('required' => 'required', 'disabled' => true, 'control-group-opt' => array('display' => 'row','style'=>'width:90%'))),
    array('titulo' => 'Duração',            'chave' => 'duracao', 'options' => array('type' => 'number', 'required' => true, 'disabled' => true,'control-group-opt' => array('display' => 'row','style'=>'width:10%') )),
    array('titulo' => 'Início Previsto',    'chave' => 'data_prevista_inicio', 'options' => array('disabled' => true,'type' => 'text', 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),
    array('titulo' => 'Término Previsto',   'chave' => 'data_prevista_termino', 'options' => array('disabled' => true,'type' => 'text', 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),
    $ini_real,
    array('titulo' => 'Término Real',       'chave' => 'data_real_termino', 'options' => array('disabled' => true,'type' => 'text', 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),        
    $obs
);
?>
<div id="atividade" title="Editar Atividade">
<?php
echo $this->element('form', array('form' => array(
        'titulo' => __($type_atividade . ' %s', __('Atividade')),
        'create' => 'Atividade',
        'action' => 'return_json_request_data',
        'id'     => 'AtividadeForm',
        'window' => 'modal',
        'inputs' => $inputs
)));
//echo $this->Html->script('atividade/main');
?>
<script type='text/javascript'>
$(document).ready(function () {

    var r = getAction();
    
    //disableAndEnable( r.tipo.toString() );
    $( 'table#atividades' ).datagrid({
        dragSelection: false,
        onLoadSuccess:function(){
            $(this).datagrid('disableDnd');
	}     
    });
    
    var options = $( 'table#atividades' ).treegrid( 'options' );
    getTimePer();
    
    setDatePicker( $( ".datepick" ) );
    
    verifyActivity( options.otherkey.atividades, $( "#AtividadeId" ).val() );
    
    $( "#submit_Atividade" ).click(function(){
        
        if( $( "#AtividadeNome" ).val() === "" ){ return false; }
        
        var atividades = propagarProximasDatas();
        if( atividades ){

            $( 'table#atividades' ).treegrid( 'loadData', atividades );
        }
        $("form#AtividadeForm").submit();
        $("form#AtividadeForm").submit(function(){return false;});
        $(".load-circle").hide();
        $(".ui-dialog-content").dialog("close");
    });

    function propagarProximasDatas(){

        var datas      = $("#AtividadeDataPrevistaTermino").val();
        var atividades = $("table#atividades").treegrid('getData');
        var etapa_id   = $("#AtividadeId").val();

        var result = $.ajax({
            url: myBaseUrl + "demandas/getAtividadesDemanda/",
            type: "post",
            data: {obj_atividades: atividades, data_inicio: datas, atividade_id: etapa_id},
            dataType: "json",
            global: false,
            async: false,
            success: function(data){

                return data;
            }

        }).responseJSON;

        if (result){

            var key = (result.length - 1);
            $('#DemandaDataPrevistaTermino').val(result[key].data_prevista_termino);
            var others = {id: $("#DemandaId").val(), data: $("#DemandaDataInicio").val(), atividades: result};
            $('table#atividades').treegrid({otherkey: others});

            return result;
            
        } else {
            
            return false;
        }
    }

    $("#AtividadeDataPrevistaInicio").change(function(){

        $("#AtividadeDataPrevistaTermino").val( setSLA() );
        
        var inicio  = $(this).val();
        var termino = $("#AtividadeDataPrevistaTermino").val();
        
        if( termino === "" || inicio === "" ){}else{
            
            if( !validateDate( inicio, termino ) ){

                alert("Operação inválida: Início maior que termino!");
                $("#AtividadeDataPrevistaInicio").val("");
                
            }
            getTimePer();
        }
        
        var activity_id = $("#AtividadeId").val();
        var date_change = $(this).val();
        
        if( activity_id === "" ){ return false; }
        if( options.otherkey.data === "") {} else {
            
            var date_change = new Date(date_change);
            var date_demand = new Date(options.otherkey.data);

            if (date_change < date_demand) {

                alert("Operação inválida: A data sujerida é menor que a data inicial da DEMANDA!");
                $(this).val(options.otherkey.data);
            }
        }
    });
    
    $("#AtividadeDataPrevistaTermino").change(function(){
        
        var termino  = $(this).val();
        var inicio   = $("#AtividadeDataPrevistaInicio").val();
        
        if( termino === "" || inicio === "" ){}else{
            
            if( !validateDate( inicio, termino ) ){

                alert("Operação inválida: Início maior que termino!");
                $("#AtividadeDataPrevistaTermino").val("");
                
            }
            getTimePer();
        }

        if( checkSLAActivity() === false && $("#AtividadeDataPrevistaTermino").val() !== "" ){
            
            var justifiquer = prompt("Para propagar as próximas datas, justifique o atrazo!", "Justifique");
            
            if( justifiquer === null || justifiquer === "" || justifiquer === "Justifique" ){
                
                $("#AtividadeDataPrevistaTermino").val('');
                alert( "Por favor Justifique!" );
            }
            $("#AtividadeJustifiqueData").val( justifiquer );
        }
    });
    
    $("#AtividadeUsuarioId").on('change', function(){
        
        $("#AtividadeUsuarioNome").val( $("#AtividadeUsuarioId_chosen span").first().text() );

    });
    
    function setDatePicker( element ){
        
        var option = {
            
            dayNames:           ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin:        ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort:      ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames:         ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort:    ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText:           'Próximo',
            prevText:           'Anterior',
            changeYear:         true,
            buttonText:         "<i class='icon-icon icon-calendar'></i>",
            showOn:             "both",
            dateFormat:         'dd/mm/yy'
            
        };
        
        element.datepicker( option );
    }

    function verifyActivity(activity, activity_id){
        
        if( checkActivity( activity, activity_id ) ){
            
            $( "#AtividadeDataPrevistaInicio" ).parent().parent().css('display', 'none');
            $( "#AtividadeDataPrevistaTermino" ).parent().parent().css('display', 'none');
            //$( "#AtividadeDataRealInicio" ).parent().parent().css('display', 'none');
            $( "#AtividadeDataRealTermino" ).parent().parent().css('display', 'none');

        }
    }
    
    function setSLA(){
        
        var data = $( "#AtividadeDataPrevistaInicio" ).val();
        var sla  = getSLA(  options.otherkey.atividades, $("#AtividadeId").val()  );
        
        if( data === "" ){return false;}
        if( sla === "" || !sla ){return false;}
        
        var result = $.ajax({
            
            url: myBaseUrl + "processos/setSLAinDate/",
            type: "post",
            data: {date: data, sla: sla},
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                return data;
            }

        }).responseJSON;
        
        if (result) {

            return result;
        } else {
            return false;
        }
    }
    
    function getSLA( activity, activity_id ){
        
        if( activity === "" ){return false;}
        if( activity_id === "" ){return false;}

        $.each( activity, function( i, v ){

            if( v.children ){
                
                getSLA( v.children, activity_id );
                
            } else {
                
                if ( parseInt(v.id) === parseInt(activity_id) ) {

                    if( v.duracao ){

                        retur = v.duracao;
                    }
                }
            }
        });        
        return retur;
    }
    
    function checkActivity( activity, activity_id ){
        
        if( activity === "" ){return false;}
        if( activity_id === "" ){return false;}

        var result = false;
        
        $.each( activity, function (i, v) {

            if ( parseInt(v.id) === parseInt(activity_id) ) {
                
                if( v.children ){
                    result = true;
                }
            }
        });
        
        return result;
    }
    
    function checkSLAActivity(){
        
        var sla = parseInt( getSLA(options.otherkey.atividades, $("#AtividadeId").val()) );

        if( sla === "" || isNaN( sla ) ){
            
            return "";
        }else{
            
            var duracao = parseInt($("#AtividadeTermino").val());

            if( duracao <= sla ){
                return true;
            }else{
                return false;
            }            
        }
    }
    
    function validateDate( date_ini, date_end ){

        var d1 = date_ini.split("/").reverse().join("-");
        var d2 = date_end.split("/").reverse().join("-");

        date_ini = new Date( d1 );
        date_end = new Date( d2 );
        
        if( date_ini > date_end ){
            return false;
        }
        return true;
    }
    
    function getTimePer(){

        var DAY = 1000 * 60 * 60  * 24;

        var dataini = $("#AtividadeDataPrevistaInicio").val();
        var datafim = $("#AtividadeDataPrevistaTermino").val();

        var nova1 = dataini.toString().split('/');
        var Nova1 = nova1[1]+"/"+nova1[0]+"/"+nova1[2];

        var nova2 = datafim.toString().split('/');
        var Nova2 = nova2[1]+"/"+nova2[0]+"/"+nova2[2];

        var d1 = new Date(Nova1);
        var d2 = new Date(Nova2);

        var days_passed = Math.round((d2.getTime() - d1.getTime()) / DAY);

        $("#AtividadeTermino").val( days_passed );
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
        }
        return result;
    }
    
    function disableAndEnable( tipo ){
        
        $("#AtividadeDataTermino").prop("disabled", true);
        $("#AtividadeDataTermino").attr( "class", "" );
        
        if( tipo === "edit" ){
            
            $("#AtividadeDataPrevistaInicio").prop("disabled", true);
            $("#AtividadeDataPrevistaInicio").attr( "class", "disabled" );
            
        } else {
            $("#AtividadeDataPrevistaInicio").prop("disabled", false);
            $("#AtividadeDataPrevistaInicio").attr("class", "datepick");
        }
    }      
});          
</script>
</div>