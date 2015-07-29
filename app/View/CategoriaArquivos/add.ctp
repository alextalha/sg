
<?php



echo $this->element('form',array('form'=>array(
    'titulo'=> __($type.' %s', __('categoria de arquivo')),
    'create'=> 'CategoriaArquivo',
    //'window'=> 'modal',
    'action'=>$type,
    'inputs'=>array(
        array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden')),
	array('titulo'=>'Nome','chave'=>'nome','options'=>array('required'=>'required','control-group-opt' => array('display' => 'row','style'=>'width:99%'))),
    )
)));

?>


<script type="text/javascript">
var _mainForm = "form#CategoriaArquivo<?php echo ucwords($type); ?>Form";
$(document).ready(function(){

    $("#submit_CategoriaArquivo").click(function(){
        $(_mainForm).submit();
    });
    
    $('#CategoriaArquivoSelectall').change(function(event) {
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