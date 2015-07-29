<?php

$key  = ( isset( $id ) ) ? "id='".$id."'" : '';

if ($ativo){
?>
<!--i class="icon-icon icon-check" title="Ativo"></i-->

<a <?php echo $key; ?> href="<?php echo $this->Html->url(array('controller'=>$controller,'action'=>'desativar',$id)); ?>" class="activate">

    <div class="botao" title="Status: ATIVO (clique para DESATIVAR)">

        <i class="fa fa-check" ></i>
            <!--<i class="icon-icon icon-toggle-off"></i> -->
    </div>
</a>
<?php

} else {
    
?>
<!--i class="icon-icon icon-check" title="Inativo" style="color:#ccc"></i-->
<a <?php echo $key; ?> href="<?php echo $this->Html->url(array('controller'=>$controller,'action'=>'ativar',$id)); ?>" class="activate">
    
    <div class="botao" title="Status: INATIVO (clique para ATIVAR)">
        
        <!--<i class="icon-icon icon-toggle-on"></i>-->
        <i class="fa fa-check" style="color:#ccc"></i>
        
    </div>
</a>
<?php
}