<?php
//echo $this->Session->flash(); 
$type = 'changePassword';
echo $this->element('form',array('form'=>array(
	'titulo'=> __('Change Password'),
	'create'=> 'Usuario',
        //'window'=> 'modal',
	'action'=>$type,
	'inputs'=>array(
		array('titulo'=>__('Old Password'),'chave'=>'oldpassword','options'=>array('required' => 'required',"type"=>"password")),
		array('titulo'=>__('New Password'),'chave'=>'password','options'=>array('required' => 'required',"type"=>"password")),
		array('titulo'=>__('Confirm Password'),'chave'=>'cpassword','options'=>array('required' => 'required',"type"=>"password"))
	)
))); 
?>
<script type="text/javascript">
// TODO: JOGAR ESSE SUBMIT DEFAULT PARA O REFACTORY
var _mainForm = "form#Usuario<?php echo ucwords($type); ?>Form";
$(document).ready(function(){
    
    $("#submit_Usuario").click(function(){
        $(_mainForm).submit();
    });

});
</script>