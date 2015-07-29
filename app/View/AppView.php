<?php

class AppView extends View {

    function display_children($children) {
        $ret = '';
        if (isset($children))
            foreach ($children as $child) {
                $ret .= "<li ";
                if ($child['children']) {
                    $ret .= 'class="dropdown-submenu oi">';
                    $ret .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $child['Menu']['nome'] . '</a>';
                    $ret .= "<ul class='dropdown-menu'>" . $this->display_children($child['children']) . "</ul>";
                } else {
                    $ret .= 'class="draggable">' . $this->Html->Link(__($child['Menu']['nome']), $child['Menu']['url'], array('title' => $child['Menu']['descricao']));
                }
                $ret .= "</li>";
            }
        return $ret;
    }

    function getConteudoEmChaves(&$elemento_chaves, &$elemento_conteudo, $num_coluna, $btn_disable=null, $considerar_format = true, $chave = 'chave') {
   
        if (isset($elemento_chaves['conteudo'])){ return $elemento_chaves['conteudo']; }
        if( isset( $elemento_chaves['chave'] ) && $elemento_chaves['chave'] == "StatusDemanda.cor" ){ return false;}
        if( isset( $elemento_chaves['chave'] ) && $elemento_chaves['chave'] == "StatusAtividade.cor" ){ return false;}
        if( isset( $elemento_chaves['chave'] ) && $elemento_chaves['chave'] == "Etapa.milestone" ){ return false;}

        if ($elemento_chaves[$chave]){
            
            $chaves   = explode('.', $elemento_chaves[$chave]);
            $conteudo = $elemento_conteudo;
            
            /* Verificar o Milestone */
            
            foreach( $chaves as $chave ){

                if ( isset( $conteudo[$chave] ) ){ $conteudo = $conteudo[$chave]; } else {
                    unset( $conteudo );
                    break;
                }
            }
        }
        
        //debug( $elemento_chaves );
        
        if ( isset( $conteudo ) && !is_array( $conteudo ) ){

            if ($considerar_format && isset($conteudo) && $elemento_chaves['format'] != ''){
                
                if( !is_null( $btn_disable ) ){
                    
                    $elemento_chaves['format'] = str_replace( '"disabled"=>""', '"disabled"=>"'.$btn_disable.'"', $elemento_chaves['format'] );
                }
                return eval('return ' . str_replace( '%%%', $conteudo, $elemento_chaves['format'] ) . ';');
            }
            
        } else {
            if ($considerar_format && isset($conteudo) && $elemento_chaves['format'] != ''){ return eval('return ' . $elemento_chaves['format'] . ';'); }
        }
        if (isset($conteudo) && $conteudo) { return $conteudo; }
        
        
        if($chaves[0] == "Milestone"){
            
             return $considerar_format = "N/A";
        }else{
            return ($considerar_format) ? "---" : '';
        }
    }

    function getConteudoEmChavesSemFormat(&$elemento_chaves, &$elemento_conteudo){
        
        return $this->getConteudoEmChaves($elemento_chaves, $elemento_conteudo, false, 'chave_form_add_linha');
    }

    function array_to_text($array, $campos_desejados){
        
        $ret = "";
        if (is_array($array) && count($array)){
            
            foreach ($array as $campo => $element){
                
                if (is_array($element)){
                    
                    $ret .= $this->array_to_text($element, $campos_desejados);
                    
                } else {
                    
                    if ( isset( $element ) && is_string( $element ) && in_array( $campo, $campos_desejados ) ){
                        $ret .= (string) ($element . " "); 
                    }
                }
            }
            $ret .= ",";
        }
        return str_replace(",,", ",", $ret);
    }

    function format_percentual_conclusao($value){
        if (isset($value)) {
            return '<div style="width:' . $value . '%;background:#ccc;color:#000">' . $value . '%' . '</div>';
        }
        return '';
    }
    
    public function transformNameSubmit( $needle, $name ){
        
        $action = "";
        $name   = rtrim( $name, 's' );
        
        if( strstr( $name, $needle ) ){

            $action = explode( $needle, $name );

            if( is_array( $action ) ){

                $action = ucfirst( $action[0] ).ucfirst( $action[1] );
            }
        } else {

            $action = ucfirst( $name );
        }
        
        return $action;
    }    
    
    public function transformName( $needle, $name ){
        
        $action = "";
        
        if( strstr( $name, $needle ) ){

            $action = explode( $needle, $name );

            if( is_array( $action ) ){

                $action = ucfirst( $action[0] )." de ".ucfirst( $action[1] );
            }
        } else {

            $action = ucfirst( $name );
        }
        
        return $action;
    }
            
    function subtabela($array) {
        
        $titulos = $campos = '<tr>';
        foreach ($array as $titulo => $campo) {
            $titulos .= '<th>' . $titulo . '</th>';
            if (is_array($campo)) {
                $campos .= '<td>';
                foreach ($campo as $num_linha => $valor)
                    $campos .= $valor;
                $campos .= '</td>';
            } else
                $campos .= '<td>' . $campo . '</td>';
        }
        return '<table class="subtabela">' . $titulos . '</tr>' . $campos . '</tr></table>';
    }

     public function line_number_paginator($var_paginator_info) {

        $linhas = $var_paginator_info['limit'] * $var_paginator_info['page'];
        $linhas = $linhas - $var_paginator_info['limit'] + 1;
        $linha_tot = $linhas + $var_paginator_info['limit'] - 1;


        for ($i = $linhas; $i <= $linha_tot; $i++) {

            $count_line['lines'][] = $i;
        }
        /* @var $count_line type */
        return @$count_line['lines'];
    }
    
 
}