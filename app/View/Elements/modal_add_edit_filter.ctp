<?php

    echo $this->element('icon-novo-filtro',array('nome'=>$nome));
    $action = $this->transformName( "_", $nome );
    
?>
<div id="modal_novo_<?php echo $nome; ?>" title="<?php echo ucfirst(str_replace("_", " de ", $nome)); ?>"></div>

<div id="modal_excluir" title="Confirmação" style="display: none;">Tem certeza que deseja excluir o <?php echo $nome;?>?
	<div id="loading"><?php echo $this->Html->image('loading.gif');?></div>
</div>

<script type="text/javascript">
    function abre_modal_<?php echo $nome; ?>(data) {
        $("#modal_novo_<?php echo $nome; ?>").dialog({title: $(data).find("legend").text()});
        $("#modal_novo_<?php echo $nome; ?>").html(data).find(".chosen-select").chosen();
        $("#modal_novo_<?php echo $nome; ?>").find(".chosen-container").removeAttr('style').find('.default').removeAttr('style');
        ativa_campos_jquery();
        $("#modal_novo_<?php echo $nome; ?>").dialog("open");
    }

    $(function () {
        $("#modal_novo_<?php echo $nome; ?>").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            height: 'auto',
            open: function(event, ui){

                var win = $(this);
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => $action )); ?>");
                $("button.ui-button").remove();
                
                $(this).prev().find("a#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });                
            }            
            
        });

        $("#novo_<?php echo $nome; ?>").on("click", function (e) {
        
            e.preventDefault();
            $.ajax({url: myBaseUrl + '<?php echo $nome;?>s/add', type: 'get'}).done(abre_modal_<?php echo $nome;?>);
        });

        $(document).on("click", ".editar_<?php echo $nome; ?>s", function (e) {
            
            e.preventDefault();
            $.ajax({url: myBaseUrl + '<?php echo $nome;?>s/edit/' + $(this).prop('id'), type: 'get'}).done(abre_modal_<?php echo $nome;?>);
        });

        $(document).on("click", ".excluir_<?php echo $nome; ?>s", function (e) {
            
            e.preventDefault();
            excluir_id = $(this).attr("id");
            e.preventDefault();
            modal_excluir.dialog("open");
            $("#loading").hide();            
        });
        
        $(document).on("click", "#submit_<?php echo $action; ?>", function(e){
            
            e.preventDefault();
            $("form").submit();
        });
        
        var excluir_id;
        var modal_excluir = $("#modal_excluir").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width:'auto',
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
    });
</script>