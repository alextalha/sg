<div id="cancelar" title="Cancelar Atividade" style="display: none;">
<?php 
	echo $this->element('form',array('form'=>array(
		'titulo'=> "Cancelar Atividade",
		'create'=> 'Atividade',
		'type'=>'horizontal',
		'action'=>'cancelar',
                'window'=> 'modal',
		'inputs'=>array(
			array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden','id'=>'cancelar_atividade_id')),
			array('titulo'=>'Motivo do cancelamento','chave'=>'motivo_cancelamento','options'=>array('type'=>'textarea','required'=>'required')),
		)
	))); 
?>
</div>
<script type="text/javascript">
    var tabela_id = '<?php echo $tabela_id; ?>';

    $(function () {

        $("#cancelar").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            open: function(event, ui){

                var win = $(this);
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => "Cancelar Atividade" )); ?>");
                $("button.ui-button").remove();
                
                $(this).prev().find("span#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });                
            }
        });

        $("#avancar").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            open: function(event, ui){

                var win = $(this);
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => "Avançar Atividade" )); ?>");
                $("button.ui-button").remove();
                
                $(this).prev().find("span#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });                
            }            
        });

        $("#delegar").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            open: function(event, ui){

                var win = $(this);
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => "Delegar Atividade" )); ?>");
                $("button.ui-button").remove();
                
                $(this).prev().find("span#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });                
            }            
        });

        $(tabela_id).on("click", ".cancelar", function (e) {
            e.preventDefault();
            $("#cancelar_atividade_id").prop("value", $(this).prop("id"));
            $("#cancelar").dialog("open");
        });
/*
        $(tabela_id).on("click", ".avancar", function (e) {
            e.preventDefault();
            $("#concluir_atividade_id").prop("value", $(this).prop("id"));
            $("#concluir").dialog("open");
        });

        $(tabela_id).on("click", ".delegar", function (e) {
            e.preventDefault();
            $("#delegar_atividade_id").prop("value", $(this).prop("id"));
            $("#delegar").dialog("open");
        });
*/
    });
</script>

