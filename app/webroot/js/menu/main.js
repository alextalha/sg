/* 
 * by furious
 */
$(document).ready(function(){

    carregaTree();

    function carregaTree() {

        var url = myBaseUrl + 'menus/ajax_treegrid/';

        var result = $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                console.log(data);
                return data;
            }
        }).responseJSON;

        if (result) {

            $('#menus').datagrid('loadData', result);

        } else {

            return false;
        }
    }    
});