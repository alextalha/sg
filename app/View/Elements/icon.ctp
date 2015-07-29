<?php 
    $id  = ( isset( $id ) ) ? "id='".$id."'" : ''; 
    //$url = ( $icon == 'disabled' ) ? '#' : $url;
?>
<a <?php echo $id; ?> class="<?php echo $icon;?>" href="<?php echo $url;?>">
	<div class="<?php echo (isset($sembotao) ? '' : 'botao');?>" title="<?php echo $title;?>">

            <?php if(isset($fa)){ ?>
              <i class="fa fa-<?php echo $icon;?>"></i>
		<?php echo $text; 
                
            }else{
            ?>
              
            <i class="icon-<?php echo $icon;?>"></i>
		<?php echo $text; ?>
            
            <?php } ?>
	</div>
</a>
