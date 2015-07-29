<?php
echo $this->Html->css('pivot'); 
echo $this->element('barra_cabecalho',array('title' => "Pivot: ".$pivot_info['Pivot']['nome']));
?>
<div id="showMenu" class="haba"><div id="key" class="fa fa-arrows-h"></div></div>
<?php
echo "<div id='menu'>";
echo $this->Form->create('',array('action'=>'ajax_process'));
echo $this->Form->hidden('properties');

?>

<table class="table">
    
    <tr><td colspan="2">Arraste os campos entre as áreas abaixo:</td></tr>

    <tr><td rowspan="3"><i class="icon-icon icon-filter"></i> FILTROS<ul id="ul_Campos" class="sortable"></ul></td>

        <td><i class="icon-icon icon-align-justify"></i> LINHAS<ul id="ul_Linhas" class="sortable"></ul></td>

    </tr>
    <tr>
        <td><i class="icon-icon icon-align-justify icon-rotate-90"></i> COLUNAS<ul id="ul_Colunas" class="sortable"></ul></td>
    </tr>
    <tr>
        <td><i class="icon-icon icon-sigma"></i>  VALORES<ul id="ul_Valores" class="sortable"></ul></td>
    </tr>
    <tr>
        <td colspan="2">
        <?php  
                echo $this->Form->hidden('campos',array('value'=>$pivot_info['Pivot']['campos'],'class'=>'uls'));
                echo $this->Form->hidden('linhas',array('value'=>$pivot_info['Pivot']['linhas'],'class'=>'uls'));
                echo $this->Form->hidden('colunas',array('value'=>$pivot_info['Pivot']['colunas'],'class'=>'uls'));
                echo $this->Form->hidden('valores',array('value'=>$pivot_info['Pivot']['valores'],'class'=>'uls'));
                echo "<div class='botao' style='margin: 10px;' title='Atualizar'>".$this->Form->submit('Atualizar',array('id'=>'processar','icon'=>'fa fa-refresh'))."</div>";
                echo $this->Form->end(); 
        ?>
            <div id="export">

                <a href="<?php echo $this->Html->url(array('action'=>'export',$pivot_info['Pivot']['id'],'excel')); ?>" title="Excel" >
                    <div class="botao" style="margin-right: 5px;">
                        <i class="fa fa-file-excel-o" style="font-size: 14px; margin-bottom: 5px;"></i> Excel
                    </div>
                </a>
               <!-- </a><a href="<?//php echo $this->Html->url(array('action'=>'export',$pivot_info['Pivot']['id'],'word')); ?>" title="Word" >
                    <div class="botao" style="margin-right: 5px;">
                        <i class="fa fa-file-word-o" style="font-size: 14px; margin-bottom: 5px;"></i> Word
                    </div>  -->
                </a><a href="<?php echo $this->Html->url(array('action'=>'export',$pivot_info['Pivot']['id'],'pdf')); ?>" title="PDF" style="margin-right: 5px;">
                    <div class="botao" style="margin-right: 5px;">
                        <i class="fa fa-file-pdf-o" style="font-size: 14px; margin-bottom: 5px;"></i> PDF
                    </div>
                </a>
             
              
            </div>            

        </td>
    </tr>

</table>

<?php echo '</div><div id="resultado"></div>'; 

$form_properties = $this->element('form',array('form'=>array(
    'titulo'=>'',
    'create'=> 'Pivot',
    'window'=> 'modal',
    'inputs'=>array(
        array('titulo'=>' ','chave'=>'campo','options'=>array('type'=>'hidden')),
        array('titulo'=>'Tipo','chave'=>'tipo','options'=>array('control-group-opt' => array('display' => 'row','style'=>'width:40%'),'options'=>array('Sum'=>'Soma','Count'=>'Contagem','PercentageSum'=>'Soma Percentual','PercentageCount'=>'Contagem Percentual','Average'=>'Média','Min'=>"Mínimo",'Max'=>"Máximo"))),
        array('titulo'=>'Casas Decimais','chave'=>'casas_decimais','options'=>array('type'=>'number','value'=>'2','control-group-opt' => array('display' => 'row','style'=>'width:20%'))),
        array('titulo'=>'Separador Decimal','chave'=>'separador_decimal','options'=>array('value'=>',','size'=>'5','maxlength'=>'1','control-group-opt' => array('display' => 'row','style'=>'width:20%'))),
        array('titulo'=>'Separador Milhar','chave'=>'separador_milhar','options'=>array('size'=>'5','maxlength'=>'1','control-group-opt' => array('display' => 'row','style'=>'width:20%')))
    ),
)));

$form_filtro = $this->element('form',array('form'=>array(
    'titulo'=>'',
    'create'=> 'Pivot',
    'action'=>'filtro',
    'window'=> 'modal',
    'inputs'=>array(
        array('titulo'=>' ','chave'=>'filtro_campo','options'=>array('type'=>'hidden')),
    ),
)));

?>



<div id="loadingModal"><?php echo $this->Html->image('loading.gif');?></div>
<div id="modal_properties"></div>
<div id="modal_filtro"></div>

<script type="text/javascript">
var url_ajax;
var post_data;
var pivot_info = <?php echo json_encode($pivot_info); ?>;
var form_properties = <?php echo json_encode($form_properties); ?>;
var form_filtro = <?php echo json_encode($form_filtro); ?>;
var campo;
var lista_distinct_campo = {};
var elemento;
var properties = {};

$(function() {

    function criar_ul(nome,ul) {
        var tipo = ul === 'Valores' ? 'icon-cog properties' : 'icon-filter filtro';
        $("<li>").text(nome).addClass("ui-state-default").append("<i class='icon-icon icon-remove remover'></i>").append("<i class='icon-icon "+tipo+"'></i>").appendTo("#ul_"+ul);
    }

    function get_only_text(element) {
        return element.clone().children().remove().end().text();
    }
   
    function get_only_text_multiple(element,child) {
        
        var text = '';
        $(element).find(child).each(function() {
            text += ','+get_only_text($(this));
        });
       
        return text;
    }

    $("#loadingModal").hide();
    
    $("#showMenu").on("click",function() {
        
        if( $("#menu").is(":visible") ){
            
            $("#menu").toggle("slide", { direction: "right" }, 100);
            $(".haba").animate({'right':'1'},100);
            //$("#key").attr("class","icon-icon icon-angle-double-left");
            
        } else {
            
            $("#menu").toggle("slide", { direction: "right" }, 100);
            $(".haba").animate({'right':'+=589'},100);
            //$("#key").attr("class","icon-icon icon-angle-double-right");
        }
    });
    
    $("#processar").on("click",function(e) {
        e.preventDefault();
        $("#loadingModal").show();
        if( $("#menu").is(":visible") ){
            
            $("#menu").toggle("slide", { direction: "right" }, 100);
            $(".haba").animate({'right':'1'},100);
            //$("#key").attr("class","icon-icon icon-angle-double-left");
            
        } else {
            
            $("#menu").toggle("slide", { direction: "right" }, 100);
            $(".haba").animate({'right':'+=589'},100);
            //$("#key").attr("class","icon-icon icon-angle-double-right");
        }
        $("#pivot").hide();
       
        
        /*  variavel referente  link passando o id para requisição ajax*/
        url_ajax = myBaseUrl+'pivots/ajax_process/'+pivot_info['Pivot']['id'];
        
        
        /* Varre os campos marcados no filtro da pivot */
        post_data = "linhas="+get_only_text_multiple("#ul_Linhas",'li').replace(/\//g,'slash')+"&colunas="+get_only_text_multiple("#ul_Colunas",'li').replace(/\//g,'slash')+"&valores="+get_only_text_multiple("#ul_Valores",'li').replace(/\//g,'slash')+"&filtros="+get_only_text_multiple("#ul_Campos",'li').replace(/\//g,'slash')+"&properties="+JSON.stringify(properties).replace(/\//g,'slash');

        //post_data = 'linhas=&colunas=&valores=&filtros=nome&properties={}';

        $.ajax({
                method: "POST",
                url: url_ajax,
                data: post_data,
                dataType: 'html'
            })
            .complete(function( msg ) {
               // $("#resultado").html("ERRO: "+JSON.stringify(data)+JSON.stringify(status)+JSON.stringify(error));

             // $('#resultado').html('');

              $("#loadingModal").hide();
                
                
                $('#resultado').html(msg.responseText);
         
       
            });
         });
    
      //  $.post(url_ajax,post_data,function (data) {
            
       // $("#resultado").html(data.replace(/slash/g,'/'));
       // $("#loadingModal").hide();
        
      //  },'html').fail(function(data,status,error) {
      //      $("#resultado").html("ERRO: "+JSON.stringify(data)+JSON.stringify(status)+JSON.stringify(error));
      //      $("#loadingModal").hide();
      //  });
      //  return false;
    //});

    $('#export a').on('click',function(e) {
        e.preventDefault();
        var url = $(this).prop('href');
        url += "?"+"linhas="+get_only_text_multiple("#ul_Linhas",'li').replace(/\//g,'slash')+"&colunas="+get_only_text_multiple("#ul_Colunas",'li').replace(/\//g,'slash')+"&valores="+get_only_text_multiple("#ul_Valores",'li').replace(/\//g,'slash')+"&filtros="+get_only_text_multiple("#ul_Campos",'li').replace(/\//g,'slash')+"&properties="+JSON.stringify(properties).replace(/\//g,'slash');
        var w = window.open(url,'export');
        
    });

    $(".sortable").sortable({connectWith:".sortable",placeholder: "ui-state-highlight",forcePlaceholderSize:true,receive: function(event, ui) { 
        var origem = event.target;
        var destino = ui.sender;
        var li = ui.item;
        if ($(origem).prop('id') == 'ul_Valores') {
            if ($(destino).prop('id') != 'ul_Valores') $(li).find('.filtro').remove(); 
            $(li).find('.remover').after("<i class='icon-icon icon-cog properties'></i>");
        } else {
            if ($(destino).prop('id') == 'ul_Valores') {
                $(li).find('.properties').remove(); 
                $(li).find('.remover').after("<i class='icon-icon icon-filter filtro'></i>");
            }
        }
    }});

    $("#modal_properties").dialog({autoOpen:false,modal:true,width:'700px',height:'auto'});
    $("#modal_filtro").dialog({autoOpen:false,modal:true,width:'auto',height:'auto'});

    $(".sortable,#resultado").on("click",".filtro",function(e) {
        e.preventDefault();
        elemento = $(this).parent();
        campo = get_only_text(elemento);
        $("#modal_filtro").dialog({title:campo+": Filtro"}).html(form_filtro);
        if (lista_distinct_campo[campo]) {
            $("#PivotFiltroForm .form-actions").before(lista_distinct_campo[campo]);
            if (properties[campo].filtro) {
                $.each(properties[campo].filtro,function(key,value) {
                    $("input[value='"+value+"']").prop('checked',true);
                });
            }
        } else {
            $("#PivotFiltroForm .form-actions").before('<div class="control-group" id="aguarde"><?php echo $this->Html->image("loading.gif");?></div>');
            $.post(myBaseUrl+'pivots/lista_distinct_campo/',{pivot_info:pivot_info,campo:campo}).done(function(data) {
                $("#PivotFiltroForm .form-actions").before(data);
                $("#aguarde").remove();
                lista_distinct_campo[campo] = data;
            });
        }
        
        $("#modal_filtro").dialog("open");
    });

    $(".sortable").on("click",".properties",function(e) {
        e.preventDefault();
        elemento = $(this).parent();
        campo = get_only_text(elemento);

        $("#modal_properties").dialog({title:campo+": Configurações do campo de valor"}).html(form_properties);
        if (properties[campo]) {
            $("#PivotTipo").val(properties[campo].tipo);
            $("#PivotCasasDecimais").val(properties[campo].casas_decimais);
            $("#PivotSeparadorDecimal").val(properties[campo].separador_decimal);
            $("#PivotSeparadorMilhar").val(properties[campo].separador_milhar);
        }
        $("#modal_properties").dialog("open");
    });

    $(".sortable").on("click",".remover",function(e) {
        e.preventDefault();
        var li = $(this).parent();
        var nome = get_only_text(li);
        if (properties[nome]) properties[nome] = {};
        if ($(li).parent().prop('id') == 'ul_Valores') {
            $(li).find('.properties').remove(); 
            $(li).find('.remover').after("<i class='icon-icon icon-filter filtro'></i>");
        }
        $(li).find('i').removeClass('possui_conteudo').end().appendTo("#ul_Campos");
    });
    

    $("#modal_properties").on('submit','#PivotViewForm',function(e) {
        e.preventDefault();
        properties[campo] = {tipo:$("#PivotTipo").val(),casas_decimais:$("#PivotCasasDecimais").val(),separador_decimal:$("#PivotSeparadorDecimal").val(),separador_milhar:$("#PivotSeparadorMilhar").val()};
        elemento.find('.properties').addClass('possui_conteudo');
        elemento.effect("highlight",{color:"#dff0d8"},3000);
        $("#modal_properties").dialog("close");
    });
    

    $("#modal_filtro").on('submit','#PivotFiltroForm',function(e) {
        e.preventDefault();
        var filtros = [];
        properties[campo] = {};
        $(":checked").each(function() {
            if ($(this).prop('type') == 'checkbox') filtros.push($(this).val());
            else properties[campo].incluir = $(this).val();
        });
        properties[campo].filtro = filtros;
        elemento.find('.filtro').addClass('possui_conteudo');
        var ul = elemento.parent();
        if (ul.prop('id') == 'ul_Campos') {
            ul.prepend(elemento);
            ul.scrollTop(0);
        }
        elemento.effect("highlight",{color:"#dff0d8"},3000);
        $("#modal_filtro").dialog("close");
    });

    $(".uls").each(function() {
        var array = $(this).val().split(",");
        var ul = $(this).prop('id').replace('Pivot','');
        $.each(array,function(key,value) {
           if (value) criar_ul(value,ul);
        });
    });
});
</script>