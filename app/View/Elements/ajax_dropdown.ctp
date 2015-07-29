<?php
echo "<option>==Selecione==</option>";
if (isset($options)) 
	foreach($options as $key => $val) { 
		echo "<option value='".$key."'>".$val."</option>";
	}