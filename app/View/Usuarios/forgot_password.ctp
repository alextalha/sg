<?php
echo $this->element('form',array('form'=>array(
	'titulo'=> __('Forgot Password'),
	'create'=> 'Usuario',
	'action'=>'forgotPassword',
	'inputs'=>array(
		array('titulo'=>__('Enter Email / Username'),'chave'=>'username','options'=>array('required' => 'required'))
	)
))); 
