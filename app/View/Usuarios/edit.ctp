<?php

$form = array(
	//'titulo'=> $this->Form->data["Usuario"]["first_name"]." ".$this->Form->data["Usuario"]["last_name"],
        'titulo' => ($type == "myprofile" ? __("My profile") : __($type . ' %s', __('Usuario'))),
	'create'=> 'Usuario',
        // 'window'=> 'modal',
	//'action'=> '',
        'action' => ($type == "myprofile" ? "changePassword" : $type ),
	);

if($type=="myprofile"){
    $form['submit_text'] = __('Change Password');
    $form['submit_options'] = array('id'=>'submit_Usuario','type'=>'submit','icon'=>'fa fa-unlock','title'=>__('Change Password'));
}else{
    $form['inputs'][] = array('titulo' => '','chave'=>'id','options'=>array('type'=>'hidden'));
}

$form['inputs'][] = array('titulo' => __('First Name'), 'chave' => 'first_name', 'options' => array('required' => 'required','control-group-opt' => array('display' => 'coll','style'=>'width:50%')));
$form['inputs'][] = array('titulo' => __('Last Name'), 'chave' => 'last_name', 'options' => array('type' => 'text','control-group-opt' => array('display' => 'row','style'=>'width:50%')));
$form['inputs'][] = array('titulo' => __('Username'), 'chave' => 'username', 'options' => array('required' => 'required','control-group-opt' => array('display' => 'coll','style'=>'width:50%')));
$form['inputs'][] = array('titulo' => __('Email'), 'chave' => 'email', 'options' => array('type' => 'text', 'required' => true,'control-group-opt' => array('display' => 'row','style'=>'width:50%')));
$form['inputs'][] = array('titulo' => __('Grupos'), 'chave' => 'Grupo', 'options' => array('class' => 'chosen-select','control-group-opt' => array('display' => 'coll','style'=>'width:50%')));
$form['inputs'][] = array('titulo' => __('Cargo'), 'chave' => 'cargo_id', 'options' => array('control-group-opt' => array('display' => 'row','style'=>'width:50%')));


echo $this->element('form',array('form'=>$form));
?>
<script type="text/javascript">
// TODO: JOGAR ESSE SUBMIT DEFAULT PARA O REFACTORY
var _mainForm = "form#Usuario<?php echo ucwords($type); ?>Form";
$(document).ready(function(){
    
    $("#submit_Usuario").click(function(){
        <?php if($type=="myprofile"){ echo "$(_mainForm)[0].method = 'get';"; } ?>
        $(_mainForm).submit();
    });

});
</script>