<?php

$mode = (isset($mode)?$mode:"");
$usuarioTemAcesso = (isset($usuarioTemAcesso)) ? $usuarioTemAcesso : true;

if($usuarioTemAcesso && $this->Permissions->check(ucwords($controller).'/view')) {
    
    $url = (isset($url)) ? $this->Html->url(array('controller'=>$controller,'action' => 'edit', $id)) : '#';
?>
<a href="<?php echo $url; ?>" class="editar_<?php echo $controller; ?> <?php echo $mode; ?>" id="<?php echo $id; ?>" rel="editar<?php echo $id; ?>">
    
    <div class="botao" title="Editar">    
        <i class="fa fa-edit" style="<?php if($mode==="disable"){?>color:#ccc;<?php }?>"></i>
    </div>
</a>
<script type="text/javascript">
$(document).ready(function(){
    
    var mode   = "<?php echo $mode; ?>";
    var classe = "editar_<?php echo $controller; ?>";
    
    $("a[rel='editar<?php echo $id; ?>']").on("click", function(){
        
        if( mode === "disable" ){
            return false;
        }

        if( $(this).attr('class') === classe + ' disable' || $(this).attr('class') === classe + '  disable' ){
                
            return false;
        }        
    });
});
</script>
<?php }