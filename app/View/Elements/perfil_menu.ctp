<?php $menus = $this->requestAction(array('plugin' => null,'controller'=>'menus','action'=>'perfil'));
	foreach ($menus as $nome => $url)
		echo "<li>".$this->Html->Link($nome,$url,array("class"=>"perfil_links"))."</li>"; 
?>
<div id="perfil_modal" title="Perfil"></div>
<script type="text/javascript">
$(function() {
	$("#perfil_modal").dialog({
      autoOpen: false,
      resizable: false,
      draggable: true,
      modal: true,
      width:'50%'
    });
    $(".perfil_links").on("click",function(e) {
    	e.preventDefault();
    	$.ajax({url:$(this).prop('href')}).done(function(data) {
    		$("#perfil_modal").dialog({title:$(data).find("legend").text()});
			$("#perfil_modal").html(data).find(".chosen-select").chosen();
			$("#perfil_modal").find(".chosen-container").removeAttr('style').find('.default').removeAttr('style');
			ativa_campos_jquery();
    		$("#perfil_modal").dialog("open");
    	});
    });	
});
</script>

