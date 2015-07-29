    <div class="opcoes_formulario">

    <div class="salvar_dados">
        <i class="fa fa-floppy-o" style="font-size: 14px; margin-bottom: 6px;"></i>
        <?php $options = array('label' => 'Salvar', 'class' => 'botao', 'div' => true);
            echo $this->Form->end($options);  ?>
    
    </div>

    <div><div class="btn-separator"></div></div>

    <div class="limpar_botoes_form">
    	<i class="fa fa-eraser" style="font-size: 14px; margin-bottom: 6px;"></i>
        <?php echo $this->Form->button('Limpar ', array('type'=>'reset', 'class' => 'botao', 'div' => true)); ?>
    </div>
    
    
    <div><div class="btn-separator"></div></div>

    <div class="cancelar_botoes_form">
       	<i class="fa fa-ban" style="font-size: 14px; margin-bottom: 6px;"></i> 
        <?php echo $this->Html->link(
		    'Cancelar',
		    array(
		    	'controller' => $this->params['controller'],
		    	'action' => 'index',
                        'class' => 'botao'
		    ),
		    "Tem certeza que deseja cancelar ?"
		);
        ?>
    </div>        

</div>