<div id="home" class="<?php echo ($this->session->read('UserAuth.Usuario.fundo_pagina_inicial')) ? $this->session->read('UserAuth.Usuario.fundo_pagina_inicial') : 'blue';?>">
<?php echo $this->Html->image("tim_logo.png"); ?>
	<div id="atalhos" class="droppable">
	 	MEUS ATALHOS
	 	<div></div>
	</div>
	<div id="cores">
            
                <div style="display: block;" class="cores white" id="white" title="Trocar cor e salvar preferência"></div>
                <div style="display: block">
                    <div class="cores grey" id="grey" title="Trocar cor e salvar preferência"></div>
                    <div class="cores blue" id="blue" title="Trocar cor e salvar preferência"></div>
                </div>
                
	</div>
</div>
<?php if (!$this->session->read('UserAuth')) 
	echo $this->element('../Usuarios/login');
else { ?>
<script type="text/javascript">
$(function() {

    $( ".draggable" ).draggable({appendTo: "body",helper: "clone"});
    $( ".droppable" ).droppable({tolerance: "intersect",activeClass: "dropobject-active",hoverClass: "dropobject-hover",
      drop: function(event, ui) {
      	var href = ui.draggable.find('a').prop('href');
      	var text = ui.draggable.text();
        var icons = "<?php echo $this->element('icon-factory',array('icon_name'=>'times','color_circle'=>'rgba(255,255,255,0.3)','color_icon'=>'#fff'));?>";
      	var novo_atalho = $("<a>").text(text).prop('href',href).addClass("dragged").appendTo($(".droppable div").first()).append(icons);
      	$.ajax({url:myBaseUrl+"atalhos/add",data:{nome:text,url:href},type:'post',dataType:'json'}).done(function(atalho_id) {
      		novo_atalho.prop('id',atalho_id);
      	});
    },
      out: function(event,ui) {
        ui.draggable.remove();
      }
    });

    $(".droppable").on('click',".dragged span",function(e) {
    	e.preventDefault();
    	$.post(myBaseUrl+"atalhos/delete/"+$(this).parent().prop('id'));
    	$(this).parent().remove();
    });

    $(".cores").on("click",function() {
    	var cor = $(this).prop('id');
    	$("#home").removeClass().addClass(cor);
    	$.post(myBaseUrl+"usuarios/escolher_fundo_pagina_inicial/"+cor);
    });

    var icons = "<?php echo $this->element('icon-factory',array('icon_name'=>'times','color_circle'=>'rgba(255,255,255,0.3)','color_icon'=>'#fff'));?>";

    $.post(myBaseUrl+"atalhos/show").done(function(data) {
		$(".droppable div").first().html(data);
		$(".droppable div").find('a').addClass("dragged").append(icons);
    });
});
</script>
<?php }