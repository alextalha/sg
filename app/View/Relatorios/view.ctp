<?php
echo $this->element('tabela-cabecalho-superior', array('tabela' => array(
        'titulo' => "Relatórios: " . $relatorio['Relatorio']['nome'],
        'type' => "rel",
        'colunas' => array(
            array('titulo' => 'Nome do arquivo', 'chave' => 'nome', 'format' => ''),
            array('titulo' => 'Descrição do arquivo', 'chave' => 'descricao', 'format' => ''),
            array('titulo' => 'Tamanho (MBytes)', 'chave' => 'tamanho', 'format' => ''),
            array('titulo' => 'Últ. Modificação', 'chave' => 'modificacao', 'format' => ''),
            array('titulo' => 'Ação', 'chave' => 'nome', 'format' => '$this->element("icon-download",array("id"=>"%%%"))')
        ),
        'linhas' => $arquivos
)));
?>
<script type='text/javascript'>
    $(function () {
        $(".download").on("click", function () {
            var _pagina = myBaseUrl + 'relatorios/download/<?php echo str_ireplace("/", "slash", $relatorio["Relatorio"]["tx_diretorio"]); ?>' + $(this).prop("id");
            var w = window.open(_pagina, 'report');
        });
    });
</script>