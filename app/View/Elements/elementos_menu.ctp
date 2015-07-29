<?php 

$elemento = (isset($elemento)) ? $elemento : "Relatorio";
$elementos = $this->requestAction(array('plugin' => null,'controller'=>'menus','action'=>'elementos_menu',$elemento));
	foreach ($elementos as $grupo => $e) {
		echo "<li class='dropdown-submenu'><a href='#' class='dropdown-toggle'	data-toggle='dropdown'>".$grupo."</a>";
               
		echo "<ul  class='dropdown-menu'>";
		foreach ($e as $id => $nome){			
			if ($this->Permissions->check(ucwords($elemento).'s/view') || $this->Permissions->check(ucwords($elemento).'s/view/'.$id)) 
					echo "<li class='draggable'>".$this->Html->Link($nome,array(
						'plugin' => null,'controller'=>strtolower($elemento).'s','action'=>'view',$id))."</li>"; 
		 }
                
                 echo "</ul></li>";
               
	}
    