<div id="copiar_de" title="Copiar De" style="display: none;">

    <?php
    echo $this->element('form_controller_processo', array('processos' => $processos));
    ?>

</div>
<?php
    
    $subform  = $this->element('treegrid', array('root_id' => $processo_id, 'form' => array(
        'titulo'     => __('Etapas'),
        'idField'    => 'id',
        'treeField'  => 'nome',
        //'add_button' => $this->element("icon-add",array('id'=>'adicionar_linha','title'=>'Adicionar Etapas')),
        'colunas'    => array(
            array('titulo' => '',                   'chave' => 'grupo_id',  'format' => '', 'width' => '1', 'hidden' => true),
            array('titulo' => '',                   'chave' => 'sla',       'format' => '', 'width' => '1', 'hidden' => true),
            array('titulo' => 'Nome',               'chave' => 'nome',      'format' => '', 'width' => '30'),
            array('titulo' => 'Descrição',          'chave' => 'descricao', 'format' => '', 'width' => '40'),
            array('titulo' => 'Grupo Responsável',  'chave' => 'grupo',     'format' => '', 'width' => '20'),
            array('titulo' => 'Duração',            'chave' => 'duracao',   'format' => '', 'width' => '5', 'class'=>'text-right'),
            array('titulo' => 'Ações',              'chave' => 'id',        'format' => 'format_acoes', 'width' => '7')
            
        )
    )));

echo $this->element('form', array('form' => array(
        'titulo' => __($type . ' %s', __('Processo')),
        'create' => 'Processo',
        'action' => ($processo_id) ? 'edit' : 'add',
        'inputs' => array(
            array('titulo' => '',                           'chave' => 'id',                'options' => array('type'       => 'hidden')),
            array('titulo' => '',                           'chave' => 'etapas_json',       'options' => array('type'       => 'hidden')),
            array('titulo' => '',                           'chave' => 'etapas_ordem',      'options' => array('type'       => 'hidden')),
            array('titulo' => 'Grupo Responsável',          'chave' => 'grupo_id',          'options' => array('required'   => 'required', 'control-group-opt' => array('display' => 'row', 'style' => 'width:30%'))),
            array('titulo' => 'Nome',                       'chave' => 'nome',              'options' => array('required'   => 'required', 'control-group-opt' => array('display' => 'row', 'style' => 'width:60%'))),
            array('titulo' => 'Duração',                    'chave' => 'duracao',           'options' => array('type'       => 'text', 'size' => '5', 'disabled' => true, 'control-group-opt' => array('display' => 'row', 'style' => 'width:10%'))),
            array('titulo' => 'Nome Sugestão para demanda', 'chave' => 'sugestao_demanda',  'options' => array('required'   => 'required', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:100%'))),
            array('titulo' => 'Descrição',                  'chave' => 'descricao',         'options' => array('type'       => 'textarea', 'required' => 'required', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:100%'))),
            array('titulo' => '',                           'chave' => 'versao',            'options' => array('type'       => 'hidden'))
        ),
        'subform'=> $subform
)));
?>
<script type="text/javascript">

    var vetor_proc = <?php echo json_encode($processos); ?>;

    var alterado    = false;
    var processoID  = ($("#ProcessoId").val() === "") ? $("#CopiarProcessoCopiarDe").val() : $("#ProcessoId").val();
    var copia       = ($("#ProcessoId").val() === "") ? "true" : "false";
    var autoopen    = ($("#ProcessoId").val() === "" && !$.isEmptyObject(vetor_proc)) ? true : false;
    var form_etapa  = $("#main-content").children("form").attr("id");
    var type        = '<?php echo $type; ?>';
    var child_proc  = '<?php echo $children; ?>';

    $(document).ready(function(){
        
        $("table#etapas").treegrid({
            collapsible: true,
            onDrop:function(t,s,p){

                if( p === "append" ){

                    $("a[rel='avisos" + t.id + "']").addClass("disable");
                    $("a[rel='avisos" + t.id + "'] > div > i").css('color','#cccccc');
                }
                
                 var data = $(this).treegrid("getData");getNode( data );
            },
            onDblClickRow:function( r ){

                var id = r._parentId;
                
                if( id === null || id === undefined ){}else{
                    
                    childClean( r );
                    
                    var node = $("table#etapas").treegrid('find', id);

                    if( $.isEmptyObject( node.children ) ){
                        
                        delete node.children;
                        
                        $("table#etapas").treegrid('update', {id: id, row: node});
                    
                        $("a[rel='avisos" + id + "']").removeClass("disable");
                        $("a[rel='avisos" + id + "'] > div > i").css('color','');
                    }
                } 
            }
        });        
        
        $( "#ProcessoAddForm,#ProcessoEditForm" ).submit(function(){

            var etapas = $("table#etapas").treegrid('getData');
            $("#ProcessoEtapasJson").val(JSON.stringify(etapas));
         
        });          
        
        $("#submit_Processo").on("click", function(){

            if( child_proc === "0" ){}else{
                    
                 alert( "Já existe um versionamento deste processo!" ); return false;
            }
            
            var etapas = $("table#etapas").treegrid('getData');

            if (!etapas || $.isEmptyObject(etapas)){

                alert("Não é possivel criar um processo sem etapas!");
                return false;

            } else {
                
                alterado = false;
            }
            $( "#ProcessoAddForm,#ProcessoEditForm" ).submit();
        });
    });
    
    function deleter(target){
        $("table#etapas").datagrid('deleteRow', target);
    }    
    
    function childClean( row ){
        
        if( $.isEmptyObject( row ) ){} else {
            
            var index = parseInt(row.id);
            deleter( index );

            $("table#etapas").treegrid("append", {data: [row]});
            var data = $("table#etapas").treegrid("getData");
            setSla( data );
            getNode( data );
        }
    }
    
    function setSla( data ){

        if( $.isEmptyObject( data ) ){} else {
            
            $.each(data,function(i,v){
                
                if( v.children && !$.isEmptyObject( v.children ) ){
                    
                    setSla( v.children );
                    
                }else{
                    
                    $("table#etapas").treegrid('updateRow',{ index:v.id ,row:{duracao:v.sla} });
                }
            });
        }
    }
    
    function getNode( obj ){
        
        if( $.isEmptyObject( obj ) ){}else{

            var some = 0;
            $.each( obj, function( i,v ){
                
                if( v.children ){
                    
                    getNode( v.children );
                }
                
                if( v._parentId !== undefined ){
                    
                    some += parseInt(v.duracao);
                    $("table#etapas").treegrid('updateRow',{ index:v._parentId ,row:{duracao:some} });
                }
            });
        }
    }    
    
    function format_dias_uteis(value) {

        if ((value) || value === "1") {

            return "Sim";
        } else {
            return "Não";
        }
    }

    function format_acoes(value, row) {

        var acoes = "";
        
        acoes = <?php echo json_encode( $this->element("icon-view", array("id" => "%%%", "controller" => "etapas")) . $this->element("icon-delete", array("id" => "%%%", "controller" => "etapas"))); ?>;

        return acoes.replace(/%%%/g, value);
    }

    $(function(){ 

        $("#copiar_de").dialog({
            autoOpen: autoopen,
            resizable: false,
            draggable: true,
            modal: true,
            width: '500',
            height: '250',
            open: function (event, ui) {

                var win = $(this);
                var title = ($("#modal_adicionar_linha").children("div").attr("title") === undefined) ? "" : $("#modal_adicionar_linha").children("div").attr("title");

                $(this).data("uiDialog")._title = function (title) {
                    title.html(this.options.title);
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho', array('title' => 'Copiar Processo?')); ?>");
                $("button.ui-button").remove();

                if (title === "") {
                } else {

                    $(this).prev("div").find("#titulo-controller").text(title);
                }

                $(this).prev().find("span#close_superior_window").on('click', function () {

                    win.dialog("close");
                });
            }
        });

        getChecked($("#CopiarProcessoForm input[type='radio']:checked").val());

        $("#CopiarProcessoForm input[type='radio']").on("change", function () {

            getChecked($(this).val());
        });
        
        $(".datagrid").on("click", ".excluir_etapas", function(e){
            e.preventDefault();
            
            var s = confirm( "Deseja mesmo excluir esta etapa?" );
            if( !s ){return false;}
            
            var etapa_id = $(this).prop("id");
            $.ajax({
                
                type: "POST",
                async: true, 
                dataType: 'json', 
                url: myBaseUrl + "etapas/delete/" + etapa_id,
                
                error:function( x ){
                    
                    $("table#etapas").treegrid('remove', etapa_id);
                }
                
            }).done(function (etapas) {

                if( etapas === '0' ){
                    
                    $("table#etapas").treegrid('remove', etapa_id);
                } else {
                    $("table#etapas").treegrid('remove', etapa_id);
                }
            });
        });

        $("#submit_copiar_processo").on("click", function(){
            
            $("#CopiarProcessoForm").submit(function(){ return false; });
            onLoad( $("#CopiarProcessoCopiarDe").val(), "true" );
            $("#copiar_de").dialog("close");
        });
        
        $(".limpar_botoes_form").on('click',function(){
            
            var s = confirm( "Deseja mesmo limpar todos os dados da tela?" );
            if( !s ){ return false; }
            data_cadastro = $('.datepick ').val();
            $("form").trigger("reset");
            $('select:enabled').val('').trigger('chosen:updated');
            $('.datepick').val(data_cadastro);
            cleanGrid();
        });
    });

    onLoad(processoID, copia);

    function onLoad(processoId, copia) {

        $("#ProcessoNome").focus();
                
        if (!processoId || processoId === "") {

            return false;
        }

        $.ajax({type: "POST", async: true, dataType: 'json', url: myBaseUrl + "etapas/ajax_treegrid/" + processoId + "/" + copia}).done(function (etapas) {

            $('table#etapas').treegrid('loadData', etapas);
        });        
    }

    function cleanGrid() {

        var node = $("table#etapas").treegrid('getData');

        if (node.length > 0) {

            for (i = node.length; i > 0; i--) {

                $('table#etapas').treegrid('remove', node[0].id);
            }
        }
    }

    function getChecked(val) {

        if (val === "0") {

            $("#CopiarProcessoCopiarDe_chosen").parent().parent().css('display', 'none');
            $("#CopiarProcessoCopiarDe option[value='']").prop("selected", "selected");
            cleanGrid();

        } else {
            $("#CopiarProcessoCopiarDe_chosen").parent().parent().css('display', 'block');
        }
    }  

</script>
