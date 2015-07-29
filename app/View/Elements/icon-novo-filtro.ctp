<?php

$usuarioTemAcesso = (isset($usuarioTemAcesso)) ? $usuarioTemAcesso : true;
$nome=ucwords($nome);
	if($usuarioTemAcesso && $this->Permissions->check($nome.'s/add')) {
?>

<a href="<?php echo (isset($url)) ? $url : '#';?>" id="novo_<?php echo $nome;?>">
    <div class="botoes_form-save botao" title="Cadastrar novo <?php echo $nome;?>">
        <i class="fa fa-asterisk" style="display:block"></i>Novo
    </div>
</a>
<?php }