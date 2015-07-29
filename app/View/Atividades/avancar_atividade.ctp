<div title="Avançar Atividade">
    <?php

    echo $this->element('form', array('form' => array(
            'titulo' => "Avançar Atividade",
            'create' => 'Atividade',
            'type' => 'horizontal',
            'action' => 'avancarAtividade',
            'window' => 'modal',
            'inputs' => array(
                
                array('titulo' => '',                     'chave' => 'id',                    'options' => array('type' => 'hidden')),
                array('titulo' => '',                     'chave' => 'parent_id',             'options' => array('type' => 'hidden')),
                array('titulo' => 'Demanda',              'chave' => 'demanda_id',            'options' => array('type' => 'hidden')),
                array('titulo' => 'Percentual de Avanço', 'chave' => 'percentual_conclusao', 
                    'options' => array('control-group-opt' => array(
                        'display' => 'row', 
                        'style' => 'width:100%'
                    ),
                    'class'    => 'no_reorder',    
                    'required' => 'required',    
                    'options' => array(
                        
                        '100' => '100%',
                        '90'  => '90%',
                        '80'  => '80%',
                        '70'  => '70%',
                        '60'  => '60%',
                        '50'  => '50%',
                        '40'  => '40%',
                        '30'  => '30%',
                        '20'  => '20%',
                        '10'  => '10%',
                        ''    => '==Selecione=='
                        
                    ))
                )
            )
    )));
    ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
    ativa_campos_jquery();
    
    $("#submit_Atividade").on('click',function(){
        
        $("#AtividadeAvancarAtividadeForm").submit();
    });
});
</script>