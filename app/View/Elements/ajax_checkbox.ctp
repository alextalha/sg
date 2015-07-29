<?php
if (count($options)) {
	echo $this->Form->input('incluir',array('type'=>'radio','options'=>array(0=>'Inclui',1=>'Exclui'),'label'=>false,'value'=>0));
	array_unshift($options,"(Selecionar tudo)");
	echo $this->Form->input($campo,array('multiple'=>'checkbox','options'=>$options));
	?>
	<script type="text/javascript">
	$(function() {
		$("#Filtro0").on("change",function() {
			$("input[type='checkbox']").not(this).prop('checked',this.checked);
		});

		$("input[type='checkbox']").on("change",function() {
			if (!$(this).prop('checked') && $("#Filtro0").prop('checked'))
				$("#Filtro0").prop('checked',false);
		});
	});
	</script>
<?php } else echo "Não há opções disponíveis para este filtro."; ?>