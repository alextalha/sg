<?php $controllers = $this->requestAction(array('plugin' => null,'controller'=>'menus','action'=>'controller_list_menu'));
	foreach ($controllers as $controller) 
		if($this->Permissions->check($controller.'/index'))
			echo "<li class='draggable'>".$this->Html->Link(__($controller),array('controller'=>strtolower($controller),'action'=>'index'))."</li>"; 
?>