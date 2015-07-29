<?php
echo $this->element('form', array('form' => array(
        'titulo' => "Adicionar Usuário",
        'create' => 'Usuario',
        'action' => 'add',
        'window' => 'modal',
        'inputs' => array(
            array('titulo' => __('Grupos'), 'chave' => 'Grupo', 'options' => array('class' => 'chosen-select','control-group-opt' => array('display' => 'row','style'=>'width:50%'))),
            array('titulo' => __('Cargo'), 'chave' => 'cargo_id', 'options' => array('control-group-opt' => array('display' => 'row','style'=>'width:50%'))),
            array('titulo' => __('Username'), 'chave' => 'username', 'options' => array('required' => 'required','control-group-opt' => array('display' => 'coll','style'=>'width:50%'))),
            array('titulo' => __('First Name'), 'chave' => 'first_name', 'options' => array('required' => 'required','control-group-opt' => array('display' => 'row','style'=>'width:50%'))),
            array('titulo' => __('Last Name'), 'chave' => 'last_name', 'options' => array('type' => 'text','control-group-opt' => array('display' => 'coll','style'=>'width:50%'))),
            array('titulo' => __('Email'), 'chave' => 'email', 'options' => array('type' => 'text', 'required' => true,'control-group-opt' => array('display' => 'row','style'=>'width:50%'))),
            array('titulo' => __('New Password'), 'chave' => 'password', 'options' => array('required' => 'required', "type" => "password",'control-group-opt' => array('display' => 'coll','style'=>'width:50%'))),
            array('titulo' => __('Confirm Password'), 'chave' => 'cpassword', 'options' => array('required' => 'required', "type" => "password",'control-group-opt' => array('display' => 'row','style'=>'width:50%')))
        )
)));
?>
<script type="text/javascript">
$(document).ready(function(){
    
    $("#submit_Usuario").attr("id","submit_Usuario_Add");
    $("#submit_Usuario_Add").click(function(){
        
        $("#UsuarioAddForm").on('submit', function(e){
            
            e.preventDefault();
            return false;
        });
        
        changePass();
        
    });
    
    function changePass(){

        var data = $("#UsuarioAddForm").serializeArray();
        var result = $.ajax({
            
            url: myBaseUrl + "usuarios/save",
            type: "post",
            data: data,
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                return data;
            }

        }).responseJSON;

        if( result.status === false ){
            
            var erro = "";
            
            if( result.msg ){
                
                erro = makeMsg( result.msg );
            }
            alert( erro );
            
        }else{
            alert( "Dados gravados com sucesso!" );
            jQuery( location ).attr( 'href', result.link );
        }
    }
    
    function makeMsg( data ){
        
        if( $.isEmptyObject( data ) || !data ){}else{
            
            var r = "";
            $.each( data, function( i, v ){
                
                if( r === "" ){
                    r += "* " + v + "!";
                } else {
                    r += "\n* " + v + "!";
                }
            });
            return r;
        }
        return false;
    }
});
</script>