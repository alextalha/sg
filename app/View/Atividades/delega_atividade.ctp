<div title="Delegar Atividade" >
    <?php
    echo $this->element('form', array('form' => array(
            'titulo' => "Delegar Atividade",
            'create' => 'Atividade',
            'type' => 'horizontal',
            'action' => 'delegaAtividade',
            'window' => 'modal',
            'inputs' => array(
                array('titulo' => '', 'chave' => 'id', 'options' => array('type' => 'hidden', 'id' => 'delegar_atividade_id')),
                array('titulo' => 'Novo Responsável', 'chave' => 'usuario_id', 'options' => array('required' => 'required','control-group-opt' => array('display' => 'coll','style'=>'width:100%')))
            )
    )));
    ?>
</div>
<script type="text/javascript">

$(document).ready(function(){
    
    ativa_campos_jquery();
    
    $("#submit_Atividade").on('click',function(){

        $('#AtividadeDelegaAtividadeForm').submit();
    });
});
</script>