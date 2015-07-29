<div title="Editar Atividade" >
<?php
$inputs = array(
    
    array('titulo' => '',                   'chave' => 'id',                    'options' => array('type' => 'hidden')),
    array('titulo' => '',                   'chave' => 'parent_id',             'options' => array('type' => 'hidden')),
    array('titulo' => 'Demanda',            'chave' => 'demanda_id',            'options' => array('type' => 'hidden')),
    array('titulo' => 'Nome da atividade',  'chave' => 'nome',                  'options' => array('required' => 'required', 'disabled' => true, 'control-group-opt' => array('display' => 'row','style'=>'width:90%'))),
    array('titulo' => 'Duração',            'chave' => 'duracao',               'options' => array('type' => 'number', 'required' => true, 'disabled' => true,'control-group-opt' => array('display' => 'row','style'=>'width:10%') )),
    array('titulo' => 'Início Previsto',    'chave' => 'data_prevista_inicio',  'options' => array('type' => 'text',  'disabled' => true, 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),
    array('titulo' => 'Término Previsto',   'chave' => 'data_prevista_termino', 'options' => array('type' => 'text', 'disabled' => true, 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),
    array('titulo' => 'Início Real',        'chave' => 'data_real_inicio',      'options' => array('type' => 'text', 'class' => 'datepick','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),
    array('titulo' => 'Término Real',       'chave' => 'data_real_termino',     'options' => array('type' => 'text', 'disabled' => true, 'class' => '','control-group-opt' => array('display' => 'row','style'=>'width:25%'))),        
    array('titulo' => 'Observações',        'chave' => 'obs_diario',            'options' => array('type' => 'textarea','control-group-opt' => array('display' => 'coll','style'=>'width:100%'))),

);
echo $this->element('form', array('form' => array(
        'titulo' => __($type_atividade . ' %s', __('Atividade')),
        'create' => 'Atividade',
        'action' => 'editAtividade',
        'window' => 'modal',
        'inputs' => $inputs
)));
?>
</div>    
<script type="text/javascript">
$(document).ready(function(){
    
    ativa_campos_jquery();
    
    $("#submit_Atividade").on('click',function(){
        
        $("#AtividadeEditAtividadeForm").submit();
    });
});
</script>