<?php
/*
 * by furious
 */
$id_cancela = ( isset( $id_cancela ) && !empty( $id_cancela ) ) ? $id_cancela : '';
$id_limpa   = ( isset( $id_limpa ) && !empty( $id_limpa ) ) ? $id_limpa : '';
?>
<div class="opcoes_formulario">

    <?php
    echo $this->element('icon-botoes', array('onclick' => "", "id" => "submit_" . $create, "icon" => "fa fa-floppy-o",
        "class" => "salvar_dados", "text" => "Salvar", "title" => "Salvar dados"));
    ?>


    <div><div class="btn-separator"></div></div>

    <?php
    echo $this->element('icon-botoes', array('onclick' => "", "id" => $id_limpa, "icon" => "fa fa-eraser",
        "class" => "limpar_botoes_form", "text" => "Limpar", "title" => "Limpar o campo"));
    ?>

    <div><div class="btn-separator"></div></div>

    <?php
    echo $this->element('icon-botoes', array('onclick' => "", "id" => $id_cancela, "icon" => "fa fa-ban",
        "class" => "cancelar_botoes_form", "text" => "Cancelar", "title" => "Cancelar"));
    ?>        

</div>
