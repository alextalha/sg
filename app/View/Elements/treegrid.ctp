<?php

echo $this->Html->script( array( 
    'jquery/jquery-easyui-1.4/jquery.easyui.min',
    'jquery/jquery-easyui-1.4/jquery.treegrid-dragndrop'
    )
);
echo $this->Html->css('easyui');

$treegrid_id    = strtolower( $form['titulo'] );
$treegrid_nome  = trim( $treegrid_id,'s' );
//$button         = $this->element("icon-add",array('id'=>'adicionar_linha'));
$button         = $this->element('icon-botoes', array('onclick' => '', "icon" => "fa fa-plus","class" => '', "id" => "adicionar_linha", "text" => "Adicionar", "title" => "Adicionar Linha"));

if(isset($form['add_button'])){
    
    if( !empty( $form['add_button'] ) && $form['add_button'] !== false ){
        
        $button = $form['add_button'];
        
    } else {
        
        $button = '';
    }
}

echo "<div class='modal_novo'>".$button."</div>";
echo "<h3>".$form['titulo']."</h3>";

//========> regras para informar quais datagrids irão permitir drag in rows. <=========

$onload  = "";

if( $treegrid_id == 'etapas' ){

    $onload  = ',onLoadSuccess: function(row,data){if (!$.isEmptyObject(data)) $("#no_element").css("display","none");$(this).treegrid("enableDnd", row?row.id:null);}';
    
} else {
    
    $onload  = ',onLoadSuccess: function(row,data){if (!$.isEmptyObject(data)) $("#no_element").css("display","none");}';
}
//========> regras para informar quais datagrids irão permitir drag in rows. <=========
?>
<div id='modal_adicionar_linha'></div>
<table class="table easyui-treegrid" id="<?php echo $treegrid_id; ?>" data-options='
        rownumbers: true,
        nowrap: false,
        iconCls: "icon-edit",
        animate: true,
        collapsible: true,
        fitColumns: true,
        idField: "<?php echo $form['idField']; ?>",
        treeField: "<?php echo $form['treeField']; ?>",
        loadMsg: "Carregando..."
        <?php echo $onload; ?>
       '> 
    <thead>
        <tr>
            <?php
            foreach ($form['colunas'] as $coluna) {

                $coluna["width"]  = (!isset($coluna["width"]) || empty($coluna["width"]) ) ? "auto" : $coluna["width"] . "%";
                $coluna["hidden"] = (!isset($coluna["hidden"]) || empty($coluna["hidden"]) ) ? "" : "hidden='".$coluna["hidden"]."'";

                echo '<th field="' . $coluna["chave"] . '"'. $coluna["hidden"] .' formatter="' . $coluna["format"] . '" width="' . $coluna["width"] . '" >' . $coluna["titulo"] . '</th>';
            }
            ?>
        </tr>
    </thead>
</table>
<div id="no_element" >Não há <?php echo $treegrid_id; ?>.</div>
<div id="dialog-confirm" title="Excluir <?php echo $treegrid_nome;?>?" style="display: none;">
    <p><span class="icon-icon icon-warning" style="float:left; margin:0 7px 20px 0;"></span>Você tem certeza que deseja excluir esta <?php echo $treegrid_nome;?> e todas suas sub<?php echo $treegrid_nome;?>s?</p>
</div>

<?php
if( isset( $legendas ) && $legendas ){
    
    echo $this->element('legendas');
}
?>

<script type='text/javascript'>
    var treegrid_id = "<?php echo strtolower($form['titulo']);?>";
    var elemento_id = "<?php echo ucfirst(trim(strtolower($form['titulo']),'s'));?>";
    var width       = ( treegrid_id === "etapas" )? 1200 : 'auto';
    
    $(document).ready(function(){
        
       $("table#" + treegrid_id).treegrid({width:'99%'});
    });    
 
    function adicionar(nova_linha){
       
        var node = $("table#" + treegrid_id).treegrid('getSelected');
        if (node) {
            if ($("#" + elemento_id + "Id").val()) {
                $("table#" + treegrid_id).treegrid('update', {id: node.id, row: nova_linha});
                if (node.propagar) {
                    var data = $("table#" + treegrid_id).treegrid('getData');
                    $.each(data, function (index, row) {
                        if (row.ordem > node.ordem) {
                            row.data_real_inicio = row.data_prevista_termino = '';
                            $("table#" + treegrid_id).treegrid('update', {id: row.id, row: row});
                        }
                    });
                }
            }
            else
                $("table#" + treegrid_id).treegrid('append', {data: [nova_linha]});
                //$("table#" + treegrid_id).treegrid('append', {parent: node.id, data: [nova_linha]});
        }
        else {
            $("#no-elements").remove();
            $("table#" + treegrid_id).treegrid('append', {data: [nova_linha]});
        }
      
        alterado = true;
        $("#modal_adicionar_linha").dialog("close");
    }

    function submeter(e) {
        e.preventDefault();
        $.ajax({url: $(this).prop("action"), type: 'post', dataType: 'json', data: $(this).serialize()}).done(adicionar)
                .error(function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                });
    }

    function abre_modal(data) {
        $("#modal_adicionar_linha").dialog({title: $(data).find("legend").text()});
        $("#modal_adicionar_linha").html(data).find(".chosen-select").chosen();
        $("#modal_adicionar_linha").find(".chosen-container").removeAttr('style').find('.default').removeAttr('style');
        ativa_campos_jquery();
        $("#modal_adicionar_linha").dialog("open");
    }

    $(function(){
        
        $("table#" + treegrid_id).datagrid({width: '99%'});
        
        $("#modal_adicionar_linha").dialog({
            
            autoOpen: false, 
            resizable: false, 
            draggable: true, 
            modal: true, 
            width: width,
            
            open: function(event, ui){

                var win   = $(this);
                var title = ( $("#modal_adicionar_linha").children("div").attr("title") ===  undefined ) ? "" : $("#modal_adicionar_linha").children("div").attr("title");
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array( 'title' => '' )); ?>");
                $("button.ui-button").remove();
                
                if( title === "" ){}else{

                    $(this).prev("div").find("#titulo-controller").text( title );
                }
                
                $(this).prev().find("span#close_superior_window").on('click',function(){
                    
                    win.dialog("close");
                });
            }
        });
        
        $("#modal_adicionar_linha").on("submit", "#" + elemento_id + "Form", submeter);

        $("#adicionar_linha").on("click", function (e) {
            e.preventDefault();
            $.ajax({url: myBaseUrl + treegrid_id + '/add/<?php echo $root_id; ?>', type: 'get'}).done(abre_modal);
        });   

        $("#dialog-confirm").dialog({
            autoOpen: false,
            resizable: false,
            height: 240,
            modal: true,
            buttons: {
                Excluir: function () {
                    var node = $("table#" + treegrid_id).treegrid('getSelected');
                    $("table#" + treegrid_id).treegrid('remove', node.id);
                    excluir_elemento(node.id);
                    alterado = true;
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
        
        $(".datagrid").on("click", "a[class^='avancar']", function(e){
            e.preventDefault();
            
            if( $(this).attr('class').indexOf('disable') >= 0 ){
                return  false;
            }
            
            var node = $("table#" + treegrid_id).treegrid('find', $(this).attr("rel"));
            $("table#" + treegrid_id).treegrid('select', $(this).attr("rel"));
            if (node)
                $.ajax({url: myBaseUrl + treegrid_id + '/avancar', data: node, type: 'post'}).done(abre_modal);
        });
        
        $(".datagrid").on("click", "a[class='avisos']", function(e){
            e.preventDefault();
            
            if( $(this).attr('class').indexOf('disable') >= 0 ){
                return  false;
            }
            
            var node = $(this).prop('id');
            if (node)
                $.ajax({url: myBaseUrl + 'avisos_etapas/view', data:{ etapa_id: node }, type:'post'}).done(abre_modal);
        });          

        $(".datagrid").on("click", "a[class^='editar']", function(e){
            e.preventDefault();

            if( $(this).attr('class').indexOf('disable') >= 0 ){
                return  false;
            }
            
            var node = $("table#" + treegrid_id).treegrid('find', $(this).prop('id'));
            $("table#" + treegrid_id).treegrid('select', $(this).prop('id'));
            if (node)
                $.ajax({url: myBaseUrl + treegrid_id + '/edit', data: node, type: 'post'}).done(abre_modal);
        });

        $(".datagrid").on("click", "a[class^='delegar']", function (e){
            e.preventDefault();
            
            if( $(this).attr('class').indexOf('disable') >= 0 ){
                return  false;
            }            
            
            var node = $("table#" + treegrid_id).treegrid('find', $(this).attr("rel"));
            $("table#" + treegrid_id).treegrid('select', $(this).attr("rel"));
            if (node)
                $.ajax({url: myBaseUrl + treegrid_id + '/delegar', data: node, type: 'post'}).done(abre_modal);
        });
        
        $(".datagrid").on("click", "a[class^='anexar']", function (e){
            e.preventDefault();
            
            if( $(this).attr('class').indexOf('disable') >= 0 ){
                return  false;
            }            
            
            var node = $("table#" + treegrid_id).treegrid('find', $(this).attr("rel"));
            
            $("#ArquivoAtividadeId").val( node.id );
            $("#ArquivoAtividadeId").prop('disabled', 'disabled');
            $("#arquivo").dialog("open");
            
        });        
        
        $(".datagrid").on("click", "a[class^='cancelar']", function(e){
            e.preventDefault();
            
            if( $(this).attr('class').indexOf('disable') >= 0 ){
                return  false;
            }
            
            var node = $("table#" + treegrid_id).treegrid('find', $(this).attr("rel"));

            $("table#" + treegrid_id).treegrid('select', $(this).attr("rel"));
            if (node)
                $.ajax({url: myBaseUrl + treegrid_id + '/cancelar_ajax', data: node, type: 'post'}).done(abre_modal);
        });
        
    });
</script>
