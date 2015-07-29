<div id="avisos" title="Configurar Avisos" style="display: none;"></div>
<?php

    $subtable = $this->element('tabela-cabecalho-superior', array('tabela' => array(
        'titulo'        => "Avisos da Etapa: " . $etapa_nome,
        //'barra_menu'    => '',
        'id'            => 'tabela_avisos',
        'colunas'       => array(
            array('titulo' => 'Aviso', 'chave' => 'Aviso.nome', 'format' => ''),
            array('titulo' => 'Destinatários', 'chave' => 'AvisoEtapa.destinatarios_aviso', 'format' => ''),
            array('titulo' => 'Ações', 'chave' => 'Aviso.id', 'format' => ''),
            array('titulo' => ' ', 'chave' => 'AvisoEtapa.id', 'format' => '')
        ),
        'linhas' => $avisos
    )));
    
    echo $this->element('form', array('form' => array(
            'titulo' => "Configurar Avisos",
            'create' => 'AvisoEtapa',
            'window' => 'modal',
            'action' => 'add',
            'subform' => $subtable,
            'inputs' => array(
                array('titulo' => '', 'chave' => 'etapa_id', 'options' => array('type' => 'hidden', 'id' => 'etapa_id')),
                array('titulo' => 'Adicionar:', 'chave' => 'aviso_id', 'options' => array('empty' => '==Selecione==', 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%'), 'options' => $aviso_id)),
                array('titulo' => 'Destinatários', 'chave' => 'destinatarios_aviso', 'options' => array('empty' => '==Selecione==', 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%'), 'options' => array(
                            'usuario' => "Apenas usuários responsáveis",
                            'grupo' => "Todos do grupo responsável",
                            'todos_envolvidos' => "Todos os envolvidos"
                ))),
            )
    )));
?>
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#etapa_id").val( "<?php echo $etapa_id; ?>" );
        
        $("#submit_AvisoEtapa").on("click", function () {
            
            configFeed();
        });
        
        $("#AvisoEtapaAddForm").on("submit", function(e){
            e.preventDefault();
            $.ajax({async: true, dataType: "html", data: $(this).serialize(), type: "post", url: myBaseUrl + 'avisos_etapas/add'}).done(function (data) {
                $("#avisos_configurados").html(data);
                $("#avisos_configurados .icon-delete").removeAttr('onclick');
            });
        });        
        
        function configFeed(){
            
            if ($("#etapa_id").val() === "") {alert("ID da etapa não encontrado!");return false;}
            //if ($("#AvisoEtapaAvisoId").val() === "") {alert("O campo Adicionar encontra-se vazio!");return false;}
            //if ($("#AvisoEtapaDestinatariosAviso").val() === "") {alert("O campo Destinatários encontra-se vazio!");return false;}
            
            var etapa_id = $("#etapa_id").val();
            
            $.ajax({

                url: myBaseUrl + "avisos_etapas/add/",
                type: "post",
                data: $("#AvisoEtapaAddForm").serialize(),
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {
                    
                    if( $.isEmptyObject( data ) || data === "" ){
                        
                        clearTable();
                        return false;
                        
                    }else{
                        
                        loadFeeds( etapa_id );
                        $("form#AvisoEtapaAddForm").trigger('reset');
                    }
                }
            });
        }
        
        function loadFeeds( etapa_id ){
            
            if ( etapa_id === "" ){ alert("ID da etapa não encontrado!"); return false; }

            $.ajax({

                url: myBaseUrl + "avisos_etapas/getAvisos/",
                type: "post",
                data: {etapa_id:etapa_id},
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {

                    clearTable();
                    var titulo = $("form#AvisoEtapaAddForm").find("h3");
                    titulo     = titulo.contents().filter(function() {
                        return this.nodeType === 3;
                    });

                    titulo = titulo.text() +" "+'<b>'+ data[0].Etapa.nome +'</b>';
                    $("form#AvisoEtapaAddForm").find("h3").html( titulo );

                    $.each( data, function(i,v){
                        
                        var html = [
                            '<tr>',
                            '<td>' + v.Aviso.nome + '</td>',
                            '<td>' + v.AvisoEtapa.destinatarios_aviso + '</td>',
                            '<td nowrap="">---</td>',
                            '</tr>'
                        ].join('');
                        
                        $("table#tabela_avisos > tbody").append(html);
                        $("table#tabela_avisos > tbody").find('tr#no_Avisos').remove();
                    });
                }
            });
        }
        
        function clearTable(){
        
            var html = ['<tr>',
                        '<th>Aviso</th>',
                        '<th>Destinatários</th>',
                        '<th>Ações</th>',
                        '</tr>',
                        '<tr>', 
                        '</tr>',
                        '<tr id="no_Avisos">',
                        '<td colspan="5">Não há Avisos.</td>',
                        '</tr>'                        
                        ].join('');
                                    
            $("table#tabela_avisos > tbody").html( html );
            $("table#tabela_avisos > tbody").find('tr#no_Avisos').html('<td colspan="5">Não há Avisos.</td>');
        }            
    });
</script>    