<?php
echo $this->element('form',array('form'=>array(
	'titulo'=> __('Change Password for ').h($name),
	'create'=> 'Password',
        'window'=> 'modal',
	'action'=>'',
	'inputs'=>array(
		array('titulo'=>__('Password'),'chave'=>'password','options'=>array('required' => 'required',"type"=>"password", 'control-group-opt' => array('display' => 'row','style'=>'width:99%'))),
		array('titulo'=>__('Confirm Password'),'chave'=>'cpassword','options'=>array('required' => 'required',"type"=>"password",'control-group-opt' => array('display' => 'row','style'=>'width:99%')))
	)
))); 
?>

<script type="text/javascript">
$(document).ready(function(){
    
    $("#submit_Password").click(function(){
        
        $("#PasswordForm").on('submit', function(e){
            
            e.preventDefault();
            return false;
        });
        
        if($("#PasswordPassword").val() === ""){alert("O campo Senha encontra-se vazio!"); return false;}
        if($("#PasswordCpassword").val() === ""){alert("O campo Confirme a senha encontra-se vazio!"); return false;}
        
        changePass( '<?php echo $usuario_id; ?>' );
        
    });
    
    function changePass( id ){

        var result = $.ajax({
            
            url: myBaseUrl + "usuarios/changeUsuarioPassword",
            type: "post",
            data: { user:id, password:$("#PasswordPassword").val(), cpassword:$("#PasswordCpassword").val() },
            dataType: "json",
            global: false,
            async: false,
            success: function (data) {

                return data;
            }

        }).responseJSON;

        if( result.status === false ){
            
            alert( result.msg.password );
        }else{
            alert( "Senha alterada com sucesso!" );
            jQuery( location ).attr( 'href', result.link );
        }
        //$("div.response").text(  );
        console.log( result );
    }
});
</script>