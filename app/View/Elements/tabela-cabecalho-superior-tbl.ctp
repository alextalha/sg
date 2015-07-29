<?php

//EXEMPLO DE ENTRADA
//$tabela = array(
//	'titulo'=>'Assinaturas',
//	'link'=>$this->Html->link(__('Adicionar assinatura'), array('controller' => 'assinaturas', 'action' => 'add', 0, $publicacao['Publicacao']['id'])),
//	'colunas'=>array(
//		array('titulo'=>'Cliente','chave'=>'Cliente.apelido','format'=>''),
//		array('titulo'=>'Início Assinatura','chave'=>'inicio_assinatura','format'=>'date("d/m/Y",strtotime("%%%"))'),
//		array('titulo'=>'Fim Assinatura','chave'=>'fim_assinatura','format'=>'date("d/m/Y",strtotime("%%%"))')
//	),
//	'linhas'=>$publicacao['Assinatura']
//);

?>
<div class="linha_subform">
    <span><?php echo $tabela['titulo']; ?></span>
    <?php echo $tabela['barra_menu']; ?>
</div>



<?php if (isset($tabela['link'])) echo $tabela['link']; ?>
<div id="modal-relat-edit" class="content-content">
    
    <table class="table" id="<?php echo (isset($tabela['id'])) ? $tabela['id'] : 'table';?>">
        <tr>
		<?php foreach ($tabela['colunas'] as $num_coluna => $coluna) {
                        $width = (isset($coluna['width']))?$coluna['width']:'auto';
			if ($num_coluna && trim($coluna['titulo'])) echo "</th>";
			if (trim($coluna['titulo'])) echo "<th width='".$width."'>";
			echo $coluna['titulo'];
		} ?>
        </tr>
        <tr>
		<?php if (isset($tabela['form'])) echo $tabela['form']; ?>
        </tr>
	<?php if (empty($tabela['linhas'])) echo "<tr id='no_".$tabela['titulo']."'><td colspan=".count($tabela['colunas']).">Não há ".$tabela['titulo'].".</td></tr>";
	else foreach ($tabela['linhas'] as $linha) {
		echo $this->element('tabela-linha',array('colunas'=>$tabela['colunas'],'linha'=>$linha));
	} ?>
    </table>
</div>
