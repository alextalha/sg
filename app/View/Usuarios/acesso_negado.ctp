<?php 
$x = $this->Session->flash();
if(!isset($x) || $x=="") {
    $x = __('Access Denied');
}
echo $x; 

//header ("Location: ".$this->Html->url(Router::url("/", true)));
?>