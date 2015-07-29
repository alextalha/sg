<div style="float:right">
	<?php echo $this->Form->input("controller",array('type'=>'select','div'=>false,'options'=>$allControllers,'selected'=>$c,'label'=>false,"onchange"=>"window.location='".SITE_URL."permissoes_grupo/?c='+(this).value"))?>
</div>
<div style="clear:both"></div>
<?php
if ($controllers) {
	echo $this->Form->create("",array("action"=>"update_group"));
	echo $this->Form->input("grupo_id",array("type"=>"hidden","value"=>$c));
	echo $this->element("tabela-cabecalho-superior",array('tabela'=>array(
		'titulo'=>'Permissões: '.$allControllers[$c],
		'colunas'=>array(
			array('titulo'=>__("Controller"),'chave'=>'controller','format'=>''),
			array('titulo'=>__("Action"),'chave'=>'action','format'=>''),
			array('titulo'=>__("Conteúdo"),'chave'=>'conteudo_id','format'=>''),
			array('titulo'=>__("Descrição"),'chave'=>'descricao','format'=>''),
			array('titulo'=>__("Permitido"),'chave'=>'allowed','format'=>'$this->Form->input($elemento_conteudo["controller"].".".$elemento_conteudo["action"].".".$elemento_conteudo["conteudo_id"].".".$elemento_conteudo["id"],array("type"=>"checkbox","checked"=>"%%%"))'),
		),
		'linhas'=>$controllers
	)));
	echo $this->Form->submit('Gravar');
	echo $this->Form->end();
} else echo __("Selecione um Grupo de Acesso.");
?>