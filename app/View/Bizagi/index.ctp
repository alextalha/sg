<?php echo $this->element('barra_cabecalho',array('title' => "Bizagi")); ?>
<style>
    #box_cinza_left {
        background-color: #D8D8D8;
        height: 700px;
        position: absolute;
        width: 327px;
    }

</style>
<div class='container-fluid'>
<!--
    <div id="box_cinza_left">
    </div>
-->
    <iframe src="<?= $this->Html->url("/bpm/bizagi/index.php") ?>" width="100%" height="700px" frameBorder="0"> </iframe>
</div>