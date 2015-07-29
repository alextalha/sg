<?php

    $disabled  = ( isset( $disabled ) ? $disabled : "false");
    $confirm   = (isset($confirm) ? $confirm : "");
    
    $url  = ( $disabled == 'true' )?'#':$this->Html->url(array('controller'=>$controller,'action' => $action, $id));
?>
<a href="<?php echo $url;?>" class="<?php echo $class; ?>" id="<?php echo $class.$id; ?>" rel="<?php echo $id; ?>" >
    <div class="botao" title="<?php echo $title;?>">
        
        <i class="<?php echo $icon; ?>" style="<?php if( $disabled == 'true' ){?>color:#ccc;<?php }?>"></i>

    </div>
</a>
<script type="text/javascript">
$(document).ready(function(){
    
    var disabled = '<?php echo $disabled;?>';
    
    $('a#<?php echo $class.$id; ?>').on('click',function(){

        if( disabled === "true" ){
            return false;
        }
        var c = '<?php echo $confirm; ?>';
        if( c === "" ){}else{
            
            var s = confirm( c );
            if( !s ){
                return false;
            }
        }        
    });
});
</script>