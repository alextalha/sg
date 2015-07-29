<?php

$usuarioTemAcesso = (isset($usuarioTemAcesso)) ? $usuarioTemAcesso : true;
$nome=ucwords($nome);
	if($usuarioTemAcesso && $this->Permissions->check($nome.'s/'.$action)) {
?>
<a href="#" id="novo_<?php echo $nome;?>"><div class="botao">
       <!-- <i class="fa fa-save"></i> -->
        Salvar
    </div>
</a>
<?php }