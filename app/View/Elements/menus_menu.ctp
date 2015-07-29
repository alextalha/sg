<?php 	$menus = $this->requestAction(array('controller'=>'menus','action'=>'menu')); echo ($this->display_children($menus)); ?>
<script>
    $(function(){
       $('.dropdown-menu:eq(0)').append('<li class="dropdown-submenu rodape-submenu"></li>'); 
        
    });
</script>

              
    

      
