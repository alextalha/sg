<?php

echo $this->element('icon-novo-tab',array('nome'=>$nome));

?>
<div id="modal_novo_<?php echo $nome; ?>" title="<?php echo ucfirst(str_replace("_", " de ", $nome)); ?>"></div>

<div id="modal_excluir" title="Confirmação"> Tem certeza que deseja excluir? 
    <div id="loading"><?php echo $this->Html->image('loading.gif');?></div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        
        entity = "<?php echo $nome; ?>";
        
        function abre_modal_<?php echo $nome; ?>(data) {
            $("#modal_novo_<?php echo $nome; ?>").dialog({title: $(data).find("legend").text()});
            $("#modal_novo_<?php echo $nome; ?>").html(data).find(".chosen-select").chosen();
            $("#modal_novo_<?php echo $nome; ?>").find(".chosen-container").removeAttr('style').find('.default').removeAttr('style');
            ativa_campos_jquery();
            $("#modal_novo_<?php echo $nome; ?>").dialog("open");
        }

        $("#modal_novo_<?php echo $nome; ?>").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            height: 'auto',
            open: function(event, ui){

                var win   = $(this);
                var title = ( $("#modal_novo_<?php echo $nome; ?>").children("div").attr("title") ===  undefined ) ? "" : $("#modal_novo_<?php echo $nome; ?>").children("div").attr("title");
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => '' )); ?>");
                $("button.ui-button").remove();
                
                if( title === "" ){}else{
                    $("div#titulo-controller").text( title );
                }
                
                $(this).prev().find("span#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });                
            }            
        });

        $("#novo_<?php echo $nome; ?>").click( function (e) {
            e.preventDefault();
            $.ajax({url: myBaseUrl + '<?php echo $nome;?>s/add', type: 'get'}).done( abre_modal_<?php echo $nome;?> );
        });

        $(document).on("click", ".editar_<?php echo $nome; ?>s", function (e) {
            e.preventDefault();
            $.ajax({url: myBaseUrl + '<?php echo $nome;?>s/edit/' + $(this).prop('id'), type: 'get'}).done(abre_modal_<?php echo $nome;?>);
        });

        var excluir_id;

        var modal_excluir = $("#modal_excluir").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            height: 'auto',
            buttons: {
                'Sim': function() {
                    $("#loading").show();
                    if (excluir_id) $.post(myBaseUrl + "<?php echo $nome;?>s/delete/" + excluir_id).done(function() {
                        location.reload();
                    });
                    excluir_id = null;
                },
                'Não': function() {
                    $(this).dialog("close");
                }
          }                
        });

        $(document).on("click", ".excluir_<?php echo $nome; ?>s", function (e) {
        
            e.preventDefault();
            excluir_id = $(this).prop('id');
            modal_excluir.dialog("open");
            $("#loading").hide();
        });
    });
</script>