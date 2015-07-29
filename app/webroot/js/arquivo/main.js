/* 
 * by Furious
 */
$(document).ready(function () {

    var files = [];
    
    $("#submit_Demanda").click(function(){

        $("form#ArquivoSaveForm").submit(function(){return false;});
    });
    
    $("#ArquivoFile").change(function(){
        
        var file = $(this).val();
        $("#ArquivoNome").val( file );
    });
    
    $("#submit_Arquivo").click(function(){

        $("#ArquivoAtividadeId").prop('disabled', false);
        $("form#ArquivoSaveForm").attr("action","/sag/arquivos/setFile");
        
        $("form#ArquivoSaveForm").submit();

        $(".load-circle").hide();
    });
    
    $("form#ArquivoSaveForm").submit(function(){
  
            var form = $(this);
            var formdata = false;
                if (window.FormData){
                    formdata = new FormData(form[0]);
            }
                var formAction = form.attr('action');
           
            
            $.ajax({
            url: myBaseUrl + "arquivos/setFile",
            type: "POST",
            data: formdata ? formdata : form.serialize(),
            dataType: "json",
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            
            beforeSend: function( xhr ) {
     
                
             },
            
            success: function (data){

                if( data.Arquivo.nome === '' ){return false;}
                if( data.Arquivo.categoria_arquivo_id === '' ){return false;}

                if( data.Arquivo.atividade_nome === '' ){
                    
                    var node = $("table#atividades" ).treegrid( 'find', data.Arquivo.atividade_id );
                    
                    if( node === null ){}else{
                        
                        data.Arquivo.atividade_nome = node.nome;
                    }
                }
                
                if (data){

                    var dados  = ajuste(data.Arquivo);
                    var name_  = dados.file.name;
                    var name   = ( name_.indexOf(".") === -1 ) ? name_ : name_.split(".");
                    var ext    = ( $.isArray( name ) ) ? name[name.length - 1] : '';
                    var tr_id_ = Math.random() * 9999;
                    var tr_id  = Math.floor( tr_id_ ); 
                    
                    var html = [
                        '<tr id="'+tr_id+'">',
                        '<td>' + dados.atividade_nome + '</td>',
                        '<td>' + dados.nome + '</td>',
                        '<td>' + dados.categoria_nome + '</td>',
                        '<td>' + dados.file.type + '</td>',
                        '<td>' + ext + '</td>',
                        '<td>---</td>',
                        '<td nowrap="">',
                        '<a><div id="'+tr_id+'" class="botao" title="Excluir"><i class="fa fa-remove"></i></div></a>',
                        '</td>',
                        '</tr>'
                    ].join('');

                    $("table#tabela_arquivos > tbody").append(html);
                    $("table#tabela_arquivos > tbody").find('tr#no_Arquivos').remove();
                    
                    $( "table#tabela_arquivos > tbody" ).find( 'div#' + tr_id ).click( function(){
                        
                        $("table#tabela_arquivos > tbody").find( 'tr#' + tr_id ).remove();
                        var elements = $("table#tabela_arquivos > tbody").find('div');

                        if ( elements.length ) {} else {

                            var html = ['<tr id="no_Arquivos">',
                                '<td colspan="11">Não há Arquivos.</td>',
                                '</tr>'
                            ].join('');

                            $("table#tabela_arquivos > tbody").append(html);
                        }
                        return false;
                    });

                    files.push( data );

                    $("#DemandaFiles").val( JSON.stringify( files ) );
                    $("form#ArquivoSaveForm").trigger("reset");
                    $("#arquivo").dialog('close');
                }
            }
        });
        return false;
    });
    
    $(".excluir_arquivos").on( 'click', function(){
        
        if( $("#DemandaDataCancelamento").val() || $("#DemandaDataConclusao").val() ){
            
            alert("Não é possível modificar uma demanda cancelada ou concluída!");
            return false;
        }
        
        var s = confirm("Deseja mesmo deletar este arquivo?");
        
        if( !s ){return false;}
        
        deleteArquivos( $(this).attr("id") );
    });
    
    $("#ArquivoSaveForm").find(".limpar_botoes_form").on('click', function(){

        var s = confirm( "Deseja mesmo limpar todos os dados da tela?" );
        
        if ( !s ){
            
            return false;
        }

        $("form").trigger("reset");

    });    
    
    function deleteArquivos( id ){
        
        $.ajax({
            
            url: myBaseUrl + "arquivos/delete",
            type: "post",
            data: { id:id },
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {
                
                if( data === '1' ){
                    location.reload(); 
                }
            }
        });
    }
 
    function ajuste( obj ){
        
        if( !$.isEmptyObject( obj ) ){
            
            $.each( obj, function( i,v ){
                
                if( i !== "id" && i !== "demanda_id" && v === "" ){
                    obj[i]="---";
                }
            });
            
            return obj;
        } else {
            return false;
        }
    }
    
});
