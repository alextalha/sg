<?php 

$action  = $this->transformName( "_", $entity );
$submit  = $this->transformNameSubmit( "_", $entity );
$url     = ( isset( $url ) ? $url : '' );
$disable = ( isset( $disable ) )?$disable:'';

?>
<div id="modal_novo_<?php echo $entity; ?>" style="display: none;" title="<?php echo $action; ?>"></div>
<div id="modal_excluir" title="Confirmação" style="display: none;">Tem certeza que deseja excluir?
    <div id="loading"><?php echo $this->Html->image('loading.gif');?></div>
</div>

<div class="opcoes_filtro">
    
    <div style="width: 50%; position: relative; display: flex;">
    <?php
    if( $disable === 'limpar' ){}else{
        
        echo $this->element('icon-botoes', array('onclick' => "limpar_filtro('{$elemento}');", "icon" => "fa fa-eraser",
            "class" => "limpar_botoes_form", "text" => "Limpar", "title" => "Limpar o campo"));
    }
    ?>
    <div><div class="btn-separator"></div></div>

    <?php
    if( $disable === 'pesquisar' ){}else{

        echo $this->element('icon-botoes', array('onclick' => '', "icon" => "fa fa-search",
            "class" => " pesquisar pesquisar_botoes_form", "text" => "Pesquisar", "title" => "Pesquisar"));
    
        /* Elemento para exportar */
    
     //   echo $this->element('export-tabela');
        
        
    }
    ?>
     </div>
    <div style="width: 50%; position: relative; display: inline-block; float: right;">
    <?php
    if( $disable === 'novo' ){}else{
        
        echo $this->element('icon-botoes', array('onclick' => '', 'url'=> $url ,"icon" => "fa fa-asterisk",
            "class" => "novo-cadastro", "id" => "novo_" . $entity, "text" => "Novo", "title" => "Novo " . $action));
    }
    ?>
    </div>
</div>
<script type="text/javascript">
    
    var url = "<?php echo $url; ?>";
    
    function abre_modal_<?php echo $entity; ?>(data) {
        $("#modal_novo_<?php echo $entity; ?>").dialog({title: $(data).find("legend").text()});
        $("#modal_novo_<?php echo $entity; ?>").html(data).find(".chosen-select").chosen();
        $("#modal_novo_<?php echo $entity; ?>").find(".chosen-container").removeAttr('style').find('.default').removeAttr('style');
        ativa_campos_jquery();
        $("#modal_novo_<?php echo $entity; ?>").dialog("open");
    }

    $(function () {
        $("#modal_novo_<?php echo $entity; ?>").dialog({
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
                
                $(this).prev().find("span#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });                
            }
        });

        $("#novo_<?php echo $entity; ?>").on("click", function (e) {
        
            if( url === "" ){
                
                e.preventDefault();
                $.ajax({url: myBaseUrl + '<?php echo $entity;?>s/add', type: 'get'}).done(abre_modal_<?php echo $entity;?>);                
            }
        });

        $(document).on("click", ".editar_<?php echo $entity; ?>s", function (e) {
            
            e.preventDefault();
            $.ajax({url: myBaseUrl + '<?php echo $entity;?>s/edit/' + $(this).prop('id'), type: 'get'}).done(abre_modal_<?php echo $entity;?>);
        });
        
        $(document).on("click", ".excluir_<?php echo $entity; ?>s", function (e) {
            
            e.preventDefault();
            excluir_id = $(this).prop('id');
            modal_excluir.dialog("open");
            $("#loading").hide();
        });
        
        $(document).on("click", "#submit_<?php echo $submit; ?>", function(e){
            
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
                    if (excluir_id) $.post( myBaseUrl + "<?php echo $entity;?>s/delete/" + excluir_id ).done(function() {
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