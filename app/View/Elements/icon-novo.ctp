<?php

$usuarioTemAcesso = (isset($usuarioTemAcesso)) ? $usuarioTemAcesso : true;
$nome=ucwords($nome);
	if($usuarioTemAcesso && $this->Permissions->check($nome.'s/add')) {

            
            
            ?>


<div class="bar_new">
    <a style="position: relative; left:95%; width: 30px;" href="<?php echo (isset($url)) ? $url : '#';?>" id="novo_<?php echo $nome;?>">
        <div class="botao" title="Cadastrar novo <?php echo $nome;?>">
            <i class="fa fa-asterisk"></i>Novo
        </div>
    </a>
</div>
<?php }