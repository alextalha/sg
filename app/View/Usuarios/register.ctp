<?php
$subform = (USE_RECAPTCHA && PRIVATE_KEY_FROM_RECAPTCHA !="" && PUBLIC_KEY_FROM_RECAPTCHA !="") ? $this->UserAuth->showCaptcha(isset($this->validationErrors['Usuario']['captcha'][0]) ? $this->validationErrors['Usuario']['captcha'][0] : "") : "";
echo $this->element('form',array('form'=>array(
	'titulo'=> __('Sign Up'),
	'create'=> 'Usuario',
	'action'=>'register',
	'subform'=>$subform,
	'inputs'=>array(
		array('titulo'=>__('Grupos'),'chave'=>'Grupo','options'=>array('class' => 'chosen-select')),
		array('titulo'=>__('Cargo'),'chave'=>'cargo_id','options'=>array('empty'=>'==Selecione==')),
		array('titulo'=>__('Username'),'chave'=>'username','options'=>array('required' => 'required')),
		array('titulo'=>__('First Name'),'chave'=>'first_name','options'=>array('required' => 'required')),
		array('titulo'=>__('Last Name'),'chave'=>'last_name','options'=>array('type'=>'text')),
		array('titulo'=>__('Email'),'chave'=>'email','options'=>array('type'=>'text','required'=>true)),
		array('titulo'=>__('New Password'),'chave'=>'password','options'=>array('required' => 'required',"type"=>"password")),
		array('titulo'=>__('Confirm Password'),'chave'=>'cpassword','options'=>array('required' => 'required',"type"=>"password"))
	)
))); 
?>