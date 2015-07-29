<?php
//$usuarioTemAcesso = (isset($usuarioTemAcesso)) ? $usuarioTemAcesso : true;
//if ($usuarioTemAcesso && $this->Permissions->check( $nome  . 's/add')) {


if(!$this->Session->check('exportar')){   //
    
?>
<div id="filtro">
<div class="content-filtro">
    <div class="row-fluid">
        <span class="title-sortable">Filtros</span>
    </div>
    
    <div class="row-fluid">
        <div class="span9">
            <div id="sortable" class="areaConect"> </div>
              <div class="toogle-image"><img src="<?php echo $this->webroot; ?>imagens/setas.png" /></div>
              
        </div>
        
        <div class="span3">
           <div class='filtro_option_box' style="display: inline">
                <table class="table table-filtro">
                    <thead class="list_thead">
                        <tr>
                            <th> Colunas Disponíveis</th>
                        </tr>
                    </thead>
                <tbody class="list">
                        <?php 
                            if (is_array($filtros)){
                                $i = 0;
                                $x = 0;
                                foreach($filtros as $filtro){
                                    if (is_array($filtro['type'])){
                                        $string = "";
                                            foreach ($filtro['type'] as $i => $v) 
                                            {
                                                if ($x == 0){
                                                    $string .= "<option value='" . $i . "'>" . $v . "</option>";
                                                }else{
                                                    $string .= "*;*<option value='" . $i . "'>" . $v . "</option>";
                                                }
                                                    $x++;
                                            }
                                        $filtro['type'] = $string;
                                    }
                                            ?>
                                            <tr>
                                                <td name="<?php echo (isset($filtro['ref']) ? $filtro['ref'] : ''); ?>" id="<?php echo $filtro['name']; ?>" rel="<?php echo $filtro['type']; ?>" class="filter_box"><input type="checkbox" class="checkbox_filter" name="<?php echo $filtro['text']; ?>" <?php if(isset($filtro['checked']) && $filtro['checked'] ){echo "checked";}?> /><?php
                                                    echo $filtro['text'];
                                                    $i++; ?>
                                                </td>
                                            </tr>
                                            <?php
                                }//endforeach
                            }
                                ?>
                            </tbody>
                        </table>
           </div>
            
            <div class='clearfix'></div>
            
               <div class="expand-vertical-table" style="display: block; z-index:2">
                   <span style='cursor:pointer;'><img src="<?php echo $this->webroot; ?>imagens/setas_vertical.png" /></span>
                   
               </div>
                    </div>
                </div>
             </div>
    

    <div class="row-fluid">
    <?php
    /* elemento para colocar as opções de limpar e salvar na view */

    $novo = ( isset($novo) && !empty($novo) ) ? $novo : '';
    $disable_controls = ( isset($disable_controls) && !empty($disable_controls) ) ? $disable_controls : '';

    echo $this->element('limpar_salvar', array(
        "elemento" => "#sortable",
        "entity" => $nome,
        "url" => $novo,
        "disable" => $disable_controls
    ));
    

?> 
    </div>

</div>

<script type="text/javascript">
    $(function () {

        
        largura_sortable = parseInt( $(".areaConect").width() );

        componentSession( <?php echo $fields; ?> );

        function componentSession(json) {

            if (json === "") {
                return false;
            }

            $(".areaConect").empty();

            $.each(json, function (i, v) {

                approString(v);
            });
        }

        function getSizeSortable(element, largura_inicial) {

            var largura = parseInt(element.width());

            if (largura > parseInt(largura_inicial)) {

                $(".filtro_option_box").hide();
            } else {
                $(".filtro_option_box").show();
            }
        }

        function getElement(id) {

            var url = myBaseUrl + 'GenericFilters/getElements';
            var array = JSON.stringify({icon_name: 'times', color_circle: '#828282', class: 'del_' + id});

            var option = $.ajax({
                url: url,
                type: "POST",
                data: {nome: 'icon-factory', options: array},
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {
                    return data;
                }
            }).responseJSON;

            return option;
        }

        function nome_elemento(id) {

            var i = 0;
            var nome;
            $("tbody.list > tr >  td").each(function (index) {
                var alvo = '_' + $(this).attr('id');

                if ('_' + id === alvo) {
                    nome = $(this).text();
                }
            });
            return nome;
        }

        function approString(v) {

            var html;
            var combo;
            var comboopt = "";
            var tipo     = v.type;
            var entity   = v.entity;

            if (v.type.indexOf('*;*') !== -1) {

                var combo = v.type.split('*;*');
                
                tipo = 'combo';
                $.each(combo, function (i, v) {

                    comboopt += v;
                });
            }

            var elemento = getElement(v.id);

            switch ( tipo ) {

                case "date-interval":
                    
                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;

                    var value = v.val.split(" ");

                    html = [
                        '<div class="filtro_option_date">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<div class="box_date">',
                        '<div class="date-filter">',
                        '<label for="0' + v.id + '">De</label>',
                        '<input rel="date-interval" class="datepick" type="text" id="0' + v.id + '" value="' + value[0] + '" style="width:140px;"/>',
                        '</div>',
                        '<div class="date-filter">',
                        '<label for="1' + v.id + '">Até</label>',
                        '<input rel="date-interval" class="datepick" type="text" id="1' + v.id + '" value="' + value[1] + '" style="width:140px;"/>',
                        '</div>',
                        '</div>',
                        '</div>'

                    ].join("");

                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");

                    $(".filter_comum span").click(function () {

                        //var larg = largura_sortable + 300;
                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });

                    c = {};

                    $(".datepick").datepicker({
                        dateFormat: 'dd/mm/yy',
                        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                        inline: true,
                        nextText: 'Próximo',
                        prevText: 'Anterior',
                        buttonImage: "<?= $this->base; ?>/imagens/icon_calendar.png",
                        changeYear: true,
                        showOn: "both",
                        //altField: 'altField',
                        //altFormat: 'yy-mm-dd',
                        //dateFormat: 'yy-mm-dd', 
                        onSelect: function () {
                            $(this).change();
                        }
                    });

                    break;

                case "num-interval":

                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;

                    var value = v.val.split(" ");

                    html = [
                        '<div class="filtro_option_num">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<div class="box_date">',
                        '<div class="num-filter">',
                        '<label for="0' + v.id + '">De</label>',
                        '<input rel="num-interval" class="" type="text" id="0' + v.id + '" value="' + value[0] + '" />',
                        '</div>',
                        '<div class="num-filter">',
                        '<label for="1' + v.id + '">Até</label>',
                        '<input rel="num-interval" class="" type="text" id="1' + v.id + '" value="' + value[1] + '" />',
                        '</div>',
                        '</div>',
                        '</div>'

                    ].join("");


                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");

                    $(".filter_comum span").click(function () {

                        //var larg = largura_sortable + 300;
                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });

                    break;

                case "num":

                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;
                    
                    html = [
                        '<div class="comum">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<label for="' + v.id + '"></label>',
                        '<input rel="num" type="text" id="' + v.id + '" value="' + v.val + '">',
                        '</div>'

                    ].join("");

                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");

                    $(".filter_comum span").click(function () {

                        //var larg = largura_sortable + 300;
                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });

                    break;

                case "combo":

                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;
                    
                    html = [
                        '<div class="comum_select">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<label for="' + v.id + '"></label>',
                        '<select rel="'+ v.type +'" id="' + v.id + '" name="' + v.id + '[]" multiple="multiple" size=4>',
                        '<option value=""> --- </option>',
                        comboopt,
                        '</select>',
                        '</div>'

                    ].join("");


                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");

                    var index = $("select[name='" + v.id + "'] option[value='" + v.val + "']").index();
                    $("select[name='" + v.id + "'] option:eq(" + index + ")").attr('selected', 'selected');

                    $(".filter_comum span").click(function () {

                        //var larg = largura_sortable + 300;
                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });

                    break;

                case "select":
                    
                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;
                    
                    var url = myBaseUrl + 'AppCombos/makeCombo';
                    var option = $.ajax({
                        url: url,
                        type: "post",
                        data: {entity: entity},
                        dataType: "json",
                        global: false,
                        async: false,
                        success: function (data){
                            return data;
                        }
                    }).responseJSON;

                    if (option) {
                        
                        var opt = "";
                        $.each(option, function (i, v) {
                            
                            opt += "<option value='" + v.id + "'>" + v.value + "</option>";
                        });
                    }

                    html = [
                        '<div class="comum_select">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<label for="' + v.id + '"></label>',
                        '<select rel="select" id="' + v.id + '" name="' + v.id + '[]" entity="'+ entity +'" multiple="multiple" size=4>',
                        '<option value=""> --- </option>',
                        opt,
                        '</select>',
                        '</div>'

                    ].join("");

                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");
                    
                    if( $.type( v.val )==="array" ){
                        
                        var el = document.getElementById( v.id );
                        $.each( v.val, function(index, value){
                            for (var i = 0; i < el.length; i++) {

                                if ( el[i].value === value ) {
                                    el[i].selected = true;
                                }
                            }                        
                        });
                    } else {

                            document.getElementById( v.id ).value = v.val;                                                    
                    }
                    //var index = $("select[name='" + v.id + "'] option[value='" + v.val + "']").index();
                    //$("select[name='" + v.id + "'] option:eq(" + index + ")").attr('selected', 'selected');

                    $(".filter_comum span").click(function () {

                        //var larg = largura_sortable + 300;
                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });


                    break;

                case "boolean":

                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;
                    
                    html = [
                        '<div class="comum">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<label for="' + v.id + '"></label>',
                        '<select rel="boolean" id="' + v.id + '" name="' + v.id + '" >',
                        '<option value=""> --- </option>',
                        '<option value="1">Sim</option>',
                        '<option value="0">Não</option>',
                        '</select>',
                        '</div>'

                    ].join("");


                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");

                    var index = $("select[name='" + v.id + "'] option[value='" + v.val + "']").index();
                    $("select[name='" + v.id + "'] option:eq(" + index + ")").attr('selected', 'selected');

                    $(".filter_comum span").click(function () {

                        //var larg = largura_sortable + 300;
                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });

                    break;

                default:

                    var td = document.getElementById ( v.id ).childNodes[0];
                    td.checked = true;
                    
                    html = [
                        '<div class="comum">',
                        '<span>',
                        '<div class="filter_comum">' + nome_elemento(v.id),
                        elemento,
                        '</div>',
                        '</span>',
                        '<label for="' + v.id + '"></label>',
                        '<input rel="text" type="text" id="' + v.id + '" value="' + v.val + '">',
                        '</div>'

                    ].join("");

                    var $li = $('<div id="_' + v.id + '" class="filter">').html(html);
                    $li.appendTo(".areaConect");

                    $(".filter_comum span").click(function () {

                        $(this).parent().parent().parent().parent().remove();
                        $("td.filter_box[id='" + v.id + "'] > input ").attr('checked', false);
                        //getSizeSortable( $(".areaConect"), larg );

                    });
            }
            //getSizeSortable( $(".areaConect"), largura_sortable );
            return html;
        }
        
        function getSelectValues(select) {

            var result = [];
            var options = select && select.options;
            var opt;

            for (var i=0, iLen=options.length; i<iLen; i++) {
                opt = options[i];
                if (opt.selected) {
                    result.push(opt.value || opt.text);
                }
            }
            return result;
        }
        
        function Filter(id, type, val, entity,exportar) {

            this.id     = id;
            this.type   = type;
            this.val    = val;
            this.entity = entity;
            this.exportar = exportar;

        }

        $(".pesquisar").click(function(e){
            
           exportar = null;
           
            // verificar para exportar - se é PDF ou XLS
            var extensao =  $(this).find("a  > div[title]").text();
               extensao = extensao.trim();
          
            e.preventDefault();

            var json = new Array();
            var parm = "";
            var nome = '<?php echo $nome . 's'; ?>';

            $(".areaConect label").each(function(){

                var digit   = $(this).attr('for').slice(0, 1);
                var fieldid = $(this).attr('for');

                var element = document.getElementById(fieldid);
                var attr    = element.getAttribute("multiple");
                
                if( attr === 'multiple' ){
                    
                    var val = getSelectValues( element );
                    
                    if( val.length === 1 ){
                        
                        val = element.value;
                    }
                    
                } else {
                    
                    var val = element.value;
                }

                var id     = element.getAttribute("id");
                var type   = element.getAttribute("rel");
                var entity = element.getAttribute("entity");
                
                
             
                
                if(extensao == "Xls" || extensao == "Pdf"){
                     exportar = extensao;   
                }else{
                     exportar = null;
                }
                

                if (digit === "1") {} else {

                    if (digit === "0") {

                        id = fieldid.slice(1, fieldid.length);
                        var element = document.getElementById('1' + id);
                        val += " " + element.value;
                    }
                    json.push(new Filter(id, type, val, entity,exportar));
                    parm = JSON.stringify(json);
              
                    
                }
            });
            //return false;
            $.ajax({
                url: myBaseUrl + 'GenericFilters/mountFilter',
                type: "POST",
                data: {action: nome, info: parm},
                dataType: "json",
                global: false,
                async: false,
                beforeSend:function(data){
                  
                    
                },
                complete:function(data){
               
                },
                success: function (data) {
                    if(exportar == null){
                        jQuery(location).attr('href', myBaseUrl + nome);
                     }else{
                      
                         window.open(myBaseUrl + nome  + '?exportar=' + exportar);
                         
                        
                    }
                   
                }
            });

        });
    });
</script>


<?php 

}