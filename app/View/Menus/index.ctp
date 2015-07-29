<?php
$subform = $this->element('treegrid',array('root_id'=>'','form'=>array(
	'titulo'=>__('Menus'),
	'idField'=>'id',
	'treeField'=>'nome',
        'add_button' => $this->element("icon-add",array('id'=>'adicionar_linha_menu','title'=>'Adicionar Menu')),
	'colunas'=>array(
            
		array('titulo'=>'Nome',     'chave'=>'nome',        'format'=>'','width' => '35'),
		array('titulo'=>'Descrição','chave'=>'descricao',   'format'=>'','width' => '33'),
		array('titulo'=>'URL',      'chave'=>'url',         'format'=>'','width' => '26'),
		array('titulo'=>'Ações',    'chave'=>'id',          'format'=>'format_acoes','width' => '6')
	)
)));
echo $this->element('form',array('form'=>array(
	'titulo'=> 'Menus',
	'create'=> 'Menu',
	'action'=>'reordena',
	'subform'=>$subform,
	'inputs'=>array(
		array('titulo'=>'','chave'=>'json','options'=>array('type'=>'hidden'))
	)
))); 
?>
<script type="text/javascript">

    function format_acoes(value) {
        
        var acoes = <?php echo json_encode($this->element("icon-view", array("id" => "%%%", "controller" => "menus")) . $this->element("icon-delete", array("id" => "%%%", "controller" => "menus"))); ?>;
        return acoes.replace(/%%%/g, value);
    }

    function abre_modal(data) {
        
        $("#modal_adicionar_linha").dialog({title: "Cadastrar menu"});
        $("#modal_adicionar_linha").html(data).dialog("open");
        ativa_campos_jquery();
    }

    function excluir_elemento( menu_id ) {

        $.ajax({url: myBaseUrl + 'menus/delete/' + menu_id, type: 'post'});
        var url = myBaseUrl + "menus/";
        jQuery( location ).attr( 'href', url );
    } 
    
    $(document).ready(function(){
        
        $("#MenuReordenaForm").find(".opcoes_formulario").hide();
        getMenus();
        function getMenus(){

            $.ajax({

                url: myBaseUrl + "menus/ajax_treegrid",
                type: "post",
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {

                    $('table#menus').treegrid('loadData', data);
                }
            });
        }
        
        $(".excluir_menus").click(function(){
            
            excluir_elemento( $(this).attr("id") );
        });
        
        $("#adicionar_linha_menu").on("click", function (e) {
            e.preventDefault();
            
            var parent = $("table#menus").treegrid('getSelected');
            $.ajax({url: myBaseUrl + 'menus/open', data: {parent:JSON.stringify(parent)}, type: 'post'}).done(abre_modal);
        });   
        
        $("#modal_adicionar_linha").dialog({
            
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: 'auto',
            height: 'auto',
            open: function (event, ui) {

                var win = $(this);
                
                $(this).data("uiDialog")._title = function (title) {
                    title.html(this.options.title);
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho', array('title' => 'Cadastrar menu')); ?>");
                $("button.ui-button").remove();

                $(this).prev().find("span#close_superior_window").on('click', function(){

                    win.dialog("close");
                });
            }
        });
    });

</script> 