<?php
if ($type === 'add') {

    $options = array('type' => 'hidden', 'value' => $parent);
} else {
    $options = array('type' => 'hidden');
}

echo $this->element('form', array('form' => array(
        'titulo' => __($type . ' %s', __('Menu')),
        'create' => 'Menu',
        'window' => 'modal',
        'inputs' => array(
            
            array('titulo' => '', 'chave' => 'id', 'options' => array('type' => 'hidden')),
            array('titulo' => '', 'chave' => 'parent_id', 'options' => $options),
            array('titulo' => 'Nome', 'chave' => 'nome', 'options' => array('required' => 'required')),
            array('titulo' => 'Descrição', 'chave' => 'descricao', 'options' => array('type' => 'textarea')),
            array('titulo' => 'Ordem', 'chave' => 'ordem', 'options' => array('type' => 'text', 'size' => '5')),
            array('titulo' => 'URL', 'chave' => 'url', 'options' => array('type' => 'text', 'required' => true))
        )
)));
?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#MenuOpenForm").find("#submit_Menu").click(function(){
            
            if( $("#MenuNome").val() === "" ){return false;}
            if( $("#MenuUrl").val() === "" ){return false;}
            
            addMenu();
            
            $("#MenuOpenForm").submit(function(){return false;});
        });
        
        $("#MenuEditForm").find("#submit_Menu").click(function(){
            
            if( $("#MenuNome").val() === "" ){return false;}
            if( $("#MenuUrl").val() === "" ){return false;}
            
            editMenu();
            
            $("#MenuEditForm").submit(function(){return false;});
        });
        
        function addMenu(){
            
            $.ajax({

                url: myBaseUrl + "menus/add",
                type: "post",
                data: $("#MenuOpenForm").serialize(),
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {

                    $('table#menus').treegrid('loadData', data);
                    var url = myBaseUrl + "menus/";
                    jQuery( location ).attr( 'href', url );
                }
            });
        }
        
        function editMenu(){
            
            $.ajax({

                url: myBaseUrl + "menus/editMenu",
                type: "post",
                data: $("#MenuEditForm").serialize(),
                dataType: "json",
                global: false,
                async: false,
                success: function (data) {

                    $('table#menus').treegrid('loadData', data);
                    var url = myBaseUrl + "menus/";
                    jQuery( location ).attr( 'href', url );
                }
            });
        }        
    });
</script>