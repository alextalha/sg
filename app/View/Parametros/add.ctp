<?php

/*
 * by furious
 */

echo $this->element('form', array('form' => array(
    
    'titulo' => __($type . ' %s', __('Parametro')),
    'create' => 'Parametro',
    'action' => $type,
    //'window'=> 'modal',
    'inputs' => array(
        
        array('titulo' => '',           'chave' => 'id', 'options' => array('type' => 'hidden')),
        array('titulo' => 'Nome',       'chave' => 'param_name',      'options' => array('required' => 'required')),
        array('titulo' => 'Valor',      'chave' => 'param_value',     'options' => array('required' => 'required')),
        array('titulo' => 'Descrição',  'chave' => 'param_descricao', 'options' => array('required' => 'required'))
    )
)));
?>

<script type="text/javascript">
var _mainForm = "form#Parametro<?php echo ucwords($type); ?>Form";
$(document).ready(function(){

    $("#submit_Parametro").click(function(){
        $(_mainForm).submit();
    });
    
    $('#ParametroSelectall').change(function(event) {
        if( this.checked ) {
            $('.optvals').each(function() {
                this.checked = true;
            });
        }else{
            $('.optvals').each(function() {
                this.checked = false;
            });        
        }
    });
    
});
</script>