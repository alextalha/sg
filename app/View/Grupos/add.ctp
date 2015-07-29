<?php

$subform   = array();
$subform[] = $this->element("tabela-cabecalho-superior", array('tabela'=>array(
		'titulo'=>'Permissões',
                'create'=> 'Permission',
		'colunas'=>array(
			array('titulo'=>__("Controller"),'chave'=>'controller','format'=>'','width'=>'20'),
			array('titulo'=>__("Action"),'chave'=>'action','format'=>'','width'=>'20'),
			array('titulo'=>__("Content"),'chave'=>'conteudo_id','format'=>'','width'=>'15'),
			array('titulo'=>__("Description"),'chave'=>'descricao','format'=>'','width'=>'40'),
			array('titulo'=>__("Allowed"),'chave'=>'allowed','format'=>'$this->Form->input($elemento_conteudo["controller"].".".$elemento_conteudo["action"].".".$elemento_conteudo["conteudo_id"].".".$elemento_conteudo["id"],array("type"=>"checkbox","class" => "optvals checkbox_filter","checked"=>"%%%"))','width'=>'5'),
		),
		'linhas'=>$permissoes
)));

if (isset($this->Form->data['Usuario'])) {
    
    $subform[] = $this->element('tabela-cabecalho-superior'
            , array('tabela'=>array(
                    'titulo'=>'Usuários',
                    'colunas' => array(
                        array('titulo' => __('Name'), 'chave' => 'nome', 'format' => '','width'=>'30'),
                        array('titulo' => __('Cargo'), 'chave' => 'Cargo.nome', 'format' => '','width'=>'25'),
                        array('titulo' => __('Username'), 'chave' => 'username', 'format' => '','width'=>'15'),
                        array('titulo' => __('EMail'), 'chave' => 'email', 'format' => '','width'=>'30')
                    ),
                    'linhas' => $this->Form->data['Usuario']
                )));
}


echo $this->element('form',array('form'=>array(
	'titulo'=> __($type.' %s', __('Grupo')),
	'create'=> 'Grupo',
        //'window'=> 'modal',
	'action'=>$type,
	'inputs'=>array(
		array('titulo'=>'','chave'=>'id','options'=>array('orientation' =>'row','type'=>'hidden')),
		array('titulo'=>__('Name'),'chave'=>'nome','options'=>array('type'=>'text','required' => 'required','control-group-opt' => array('display' => 'row','style'=>'width:50%'))),
		array('titulo'=>__('Alias'),'chave'=>'alias_name','options'=>array('type'=>'text','control-group-opt' => array('display' => 'row','style'=>'width:50%'))),
		//array('titulo'=>'','chave'=>'allowRegistration','options'=>array('type'=>'hidden','control-group-opt' => array('display' => 'coll','style'=>'width:100%'))),
                array('titulo'=>__('Select All'),'chave'=>'selectall','options'=>array('type'=>'checkbox',"class"=>"checkbox_filter", 'control-group-opt' => array('display' => 'coll','style'=>'width:100%')))
	),
	'subform' => $subform,
)));
?>
<script type="text/javascript">
var _mainForm = "form#Grupo<?php echo ucwords($type); ?>Form";
$(document).ready(function(){

    $("#submit_Grupo").click(function(){
        $(_mainForm).submit();
    });
    
    $('#GrupoSelectall').change(function(event) {
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