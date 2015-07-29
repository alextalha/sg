<div id="arquivo" title="Cadastrar Arquivo">
<?php 
echo $this->element('form',array('form'=>array(
	'titulo'=> __($type_arquivo.' %s', __('Arquivos')),
	'create'=> 'Arquivos',
	'type'=>'file',
	'action'=>'add',
        'window' => 'modal',
	'inputs' => array(
            
            array('titulo'=>  '',           'chave' => 'Arquivo.atividade_id',          'options' => array('type' => 'hidden')),
            array('titulo' => '',           'chave' => 'Arquivo.id',                    'options' => array('type' => 'hidden')),
            array('titulo' => '',           'chave' => 'Arquivo.versao',                'options' => array('type' => 'hidden')),
            array('titulo' => '',           'chave' => 'Arquivo.demanda_id',            'options' => array('type' => 'hidden', 'value' => $demanda_id)),
            array('titulo' => '',           'chave' => 'Arquivo.usuario_id',            'options' => array('type' => 'hidden', 'value' => $this->UserAuth->getUsuarioId())),
            array('titulo' => '',           'chave' => 'Arquivo.nome',                  'options' => array('type' => 'hidden', 'value' => '')),
            array('titulo' => 'Arquivo',    'chave' => 'Arquivo.file',                  'options' => array('required' => 'required', 'type' => 'file','control-group-opt' => array('display' => 'row', 'style' => 'width:99%;'))),
            array('titulo'=>  'Atividades', 'chave' => 'Arquivo.atividade_id',          'options' => array('disabled' => true,'empty'=> '==Selecione==', 'options'=>$atividades, 'control-group-opt' => array('display' => 'coll', 'style' => 'width:50%') )),
            array('titulo' => 'Categoria',  'chave' => 'Arquivo.categoria_arquivo_id',  'options' => array('required' => 'required', 'empty' => '==Selecione==', 'options' => $categorias, 'control-group-opt' => array('display' => 'row', 'style' => 'width:50%'))),
            array('titulo' => 'Descrição',  'chave' => 'Arquivo.descricao',             'options' => array('type' => 'textarea', 'control-group-opt' => array('display' => 'coll', 'style' => 'width:100%'))),
            
        )
)));
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
    $("#submit_Arquivos").click(function(){
        
        $("#ArquivosAddForm").submit();
    });
});
</script>