/* 
 * by furious
 */
(function(){
    
    jQuery.fn.alerta = function ( msg ) {
        
        alert( msg );
    };
    
    jQuery.fn.format_status = function (value, row) {
        
        if (row.data_cancelamento)
            return 'Cancelado';
        if (row.data_conclusao)
            return 'Concluído';
        if (row.data_usuario_assumiu)
            return 'Em Andamento';
        if ((new Date(row.data_prevista_termino)).getTime() < Date.now())
            return 'Atrasado';
        if ((new Date(row.data_inicio)).getTime() > Date.now())
            return 'Previsto';
        return '';
    };
/*
    function format_acoes(value, row) {
        var finalizado = (row.data_cancelamento || row.data_conclusao);
        var usuario_logado = <?php echo $this->UserAuth->getUsuarioId();?>;
        var acao_assumir = <?php echo json_encode($this->element("icon-assumir", array("controller"=>"atividades","id"=>"%%%"))); ?>;

        var acoes = <?php echo json_encode($this->element("icon-delegar",array("id" => "%%%")).$this->element("icon-concluir",array("id" => "%%%", "title" => 'Avançar atividades')).$this->element("icon-cancelar",array("id" => "%%%")).$this->element("icon-view",array("id" => "%%%","controller"=>"atividades")));?>;
        var res = '';
        if (!finalizado) {
            if (row.usuario_id != usuario_logado)
                res += acao_assumir.replace(/%25%25%25/g, value);
            res += acoes.replace(/%%%/g, value);
        }
        return res;
    }
*/
    jQuery.fn.format_percentual_conclusao = function (value) {
        
        if (value) {
            
            var s = '<div style="width:100%;border:1px solid #ccc;background:#fff;">' +
                    '<div style="width:' + value + '%;background:#ccc;color:#000">' + value + '%' + '</div>'
            '</div>';
            return s;
        } else {
            return '';
        }
    };
    
}(jQuery));