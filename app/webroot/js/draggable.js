/* 
 * by furious
 */
$(document).ready(function () {
    
    c = {};
    
    largura_sortable = parseInt( $(".areaConect").width() );
    
    $(".list tr td").draggable({
        helper: 'clone',
        start: function (event, ui) {
            c.tr = this;
            c.helper = ui.helper;
        }
    });

    $("#sortable").droppable({
        accept: '.list tr td',
        activeClass: 'highlight',
        over: function (event, ui) {
        },
        drop: function (event, ui) {

            var elemento = $(ui.draggable).children('input');
            if ($(elemento).is(':checked')) {} else {
                
                $(elemento).prop('checked', true);
                drag(elemento);
            }
        }
    });

    /* Verificação no click  */
    $("input.checkbox_filter").on('click', function (e) {
        drag($(this));
    });
    
    /* Verificação no onload  */
    /*
    $("tbody.list > tr > td > input").each(function(){
        
        if( $(this).prop( "checked" ) ){
            drag($(this));
        }
    });
    */
});

function getSizeSortable( element, largura_inicial ){
    
    var largura = parseInt( element.width() );

    if( largura > parseInt( largura_inicial ) ){
        
        $(".filtro_option_box").hide();
    } else {
        $(".filtro_option_box").show();
    }
}

function getElement( id ){

    var url = myBaseUrl + 'GenericFilters/getElements';
    var array = JSON.stringify({icon_name: 'times', color_circle: '#828282',id: 'del_'+id});

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

function drag(elemento) {

    var nome = elemento.attr('name');
    
    var id     = elemento.parent('td').attr('id');
    var rl     = elemento.parent('td').attr('rel');
    var entity = elemento.parent('td').attr('name');

    var html;
    var combo;
    var comboopt = "";
    var tipo     = rl;

    if (!elemento.is(':checked')) {

        var index = "_" + id;
        $("div#sortable.areaConect div.filter").each( function(){

            if ($(this).attr("id") === index) {

                $(this).remove();
            }
        });

    } else {
        
        if (rl.indexOf('*;*') !== -1){

            var combo = rl.split('*;*');
            tipo = 'combo';
            $.each(combo, function (i, v) {

                comboopt += v;
            });
        }

        var element = getElement(id);

        switch ( tipo ) {

            case "date-interval":

                html = [
                    '<div class="filtro_option_date">',
                    '<span>',
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<div class="box_date">',
                    '<div class="date-filter">',
                    '<label for="0' + id + '">De</label>',
                    '<input rel="date-interval" class="datepick" type="text" id="0' + id + '" style="width:140px;" />',
                    '</div>',
                    '<div class="date-filter">',
                    '<label for="1' + id + '">Até</label>',
                    '<input rel="date-interval" class="datepick" type="text" id="1' + id + '" style="width:140px;"/>',
                    '</div>',
                    '</div>',
                    '</div>'

                ].join("");

                break;

            case "num-interval":

                html = [
                    '<div class="filtro_option_num">',
                    '<span>',
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<div class="box_date">',
                    '<div class="num-filter">',
                    '<label for="0' + id + '">De</label>',
                    '<input rel="num-interval" class="" type="text" id="0' + id + '" />',
                    '</div>',
                    '<div class="num-filter">',
                    '<label for="1' + id + '">Até</label>',
                    '<input rel="num-interval" class="" type="text" id="1' + id + '" />',
                    '</div>',
                    '</div>',
                    '</div>'

                ].join("");

                break;

            case "num":

                html = [
                    '<div class="comum">',
                    '<span>',
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<label for="' + id + '"></label>',
                    '<input rel="num" type="text" id="' + id + '" >',
                    '</div>'

                ].join("");

                break;

            case "combo":

                html = [
                    '<div class="comum_select">',
                    '<span>',
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<label for="' + id + '"></label>',
                    '<select rel="'+ rl +'" id="' + id + '" name="'+id+'[]" multiple="multiple" size=4>',
                    '<option value=""> --- </option>',
                    comboopt,
                    '</select>',
                    '</div>'

                ].join("");

                break;

            case "select":

                var url = myBaseUrl + 'AppCombos/makeCombo';

                var option = $.ajax({
                    url: url,
                    type: "POST",
                    data: { entity: entity },
                    dataType: "json",
                    global: false,
                    async: false,
                    success: function (data) {
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
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<label for="' + id + '"></label>',
                    '<select rel="select" id="' + id + '" name="'+ id +'[]" entity="'+ entity +'" multiple="multiple" size=4>',
                    '<option value=""> --- </option>',
                    opt,
                    '</select>',
                    '</div>'

                ].join("");

                break;

            case "boolean":

                html = [
                    '<div class="comum">',
                    '<span>',
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<label for="' + id + '"></label>',
                    '<select rel="boolean" id="' + id + '" >',
                    '<option value=""> --- </option>',
                    '<option value="1">Sim</option>',
                    '<option value="0">Não</option>',
                    '</select>',
                    '</div>'

                ].join("");

                break;

            default:

                html = [
                    '<div class="comum">',
                    '<span>',
                    '<div class="filter_comum">' + nome,
                    element,
                    '</div>',
                    '</span>',
                    '<label for="' + id + '"></label>',
                    '<input rel="text" type="text" id="' + id + '">',
                    '</div>'

                ].join("");

                break;
        }

        //ui.draggable.hide();

        var $li = $('<div id="_' + id + '" class="filter">').html(html);

        $li.appendTo("#sortable");
        
        $('.filter > div > span > div > span').click(function(){
            
           // var larg = largura_sortable + 300;
            var id = $(this).attr('id').substring(4);
            $(this).parent().parent().parent().parent().remove();
            $("td.filter_box[id='" + id + "'] > input ").attr('checked', false);
            //getSizeSortable( $(".areaConect"), larg );
        });
        
        //getSizeSortable( $(".areaConect"), largura_sortable );

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
            changeYear: true,
            buttonImage: myBaseUrl + "/imagens/icon_calendar.png",
            showOn: "both",
            onSelect: function () {
                elemento.change();
            }
        });
    }
}
