/* 
 * by furious
 */
$(document).ready(function(){

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


              //if ((new Date( data_ini )).getTime() >= (new Date( $("#DemandaDataOrigem").val() )).getTime()) {} else {
              //
              //   alert("A Demanda atual não pode iniciar antes de sua origem!");
              //   $("#DemandaDemandaOrigemId").val("");
              //   $("#DemandaDemandaOrigemText").val("");
              //   $("#DemandaDataOrigem").val("");
              // }        
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
});