<?php 
if(isset($sembotao)){
    $valor = '';
}elseif(isset($circle)){
    $valor = 'botao_circle';
}else{
    $valor = 'botao';
}
?>


<div class="<?php echo $class; ?>">
 <a href="<?php $url = (isset($url) && !empty($url) ? $url : '#'); echo $url ?>" onclick="<?php echo $onclick ?>" >     
        <div id="<?php $id=(isset($id)?$id:''); echo $id;?>" class="<?php echo $valor ;?>" title="<?php echo $title;?>">
            
               <?php echo isset($circle)? '<span class="fa-stack fa-lg" style="display: block">': ''; ?>
               <?php echo isset($circle)? '<i class="fa fa-circle fa-stack-2x" style="#c0c0c0"></i>': ''; ?>
            
              <i class="<?php echo $icon;?>" style="font-size: 14px; margin-bottom: 6px;"></i>
              
               <?php echo isset($circle)? '</span>': ''; ?>
              
		<?php echo isset($circle)?  "<span style='text-align: center; margin: 0px auto; position: relative; left: 1px; top: 1px; color: white;'>" .$text ." </span>" : $text ; ?>
                
	</div>
    </a>
</div>

