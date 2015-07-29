<?php
 
    $entity = "";
    $i = 0;
  

    foreach ($colunas as $num_coluna => $coluna) {

               
           if($coluna['titulo'] == 'Ações' && $this->Session->check('exportar')){ break;
               }
          
        $tem_permissao = null;
        $btn_disable   = null;
        
        if( isset( $coluna['permissions'] ) ){

            $tem_permissao = $this->Permissions->check( $coluna['permissions'] );
            $btn_disable   = ( $tem_permissao ) ? 'false' : 'true';
        }

        
       
        
        $link   = ( isset( $coluna['url'] ) )  ? $coluna['url'] : '';
        $entity = ( isset( $coluna['chave'] ) && $coluna['chave'] == 'Logevento.tx_entidade' ) ? $this->getConteudoEmChaves( $coluna, $linha, $num_coluna ) : $entity;
        

        if ($num_coluna && trim($coluna['titulo'])){
            
            echo "</td>";
        }
  
        
       if($coluna['titulo'] == 'Ações')  {
             echo "<td nowrap class='text-center' >";
        }else if( empty( $coluna['titulo'] ) ){
            
        } else if (trim($coluna['titulo'])) {
            echo "<td".(isset($coluna['class'])?" class='".$coluna['class']."' ":"").">";
        }

        $value = $this->getConteudoEmChaves( $coluna, $linha, $num_coluna, $btn_disable);
  

        if (isset($link) && !empty($link)) {

            if ( isset( $value ) && !empty( $value ) ){
                
                $check = '1';
                if( strpos($value, ";") ){
                    
                    $check_array = explode( ";", $value );
                    $check_      = explode( ":", end($check_array));
                    $check       = (isset($check_[1])?$check_[1]:'1');
                }
                    
                if( strpos($value, ":") ){
                    
                    $id = explode( ":", $value );
                    
                    if (strpos($link, "%%%")) {

                        $link = str_replace( "%%%", $id[0] , $link);
                    }
                    
                    if( strpos( $id[1], ";" ) ){
                        
                        $id = (isset(explode( ";", $id[1] )[0]) ? explode( ";", $id[1] )[0] : $id );

                    } else {
                        
                        $id = $value;
                    }
                    
                    if( $check === '0' ){
                        
                        ?><a href=""> <?php echo $value; ?> </a><?php
                    }else{
                        ?><a href="<?php echo $link . "/" . $id; ?>"> <?php echo $value; ?> </a><?php
                    }
                }else{
                    
                    ?><a href="<?php echo $link . "/" . $value; ?>"> <?php echo $value; ?> </a><?php
                }
            } else {
                
               

               echo $value;
            }
        } else {
          
            echo $value;
        }
    }
    echo "</td>";
    ?>
</tr>
<?php
/*
                    if( isset( $link ) && !empty( $link ) ){
                        if( isset( $this->getConteudoEmChaves($coluna,$linha,$num_coluna) ) && !empty( $this->getConteudoEmChaves($coluna,$linha,$num_coluna) ) ){
                            ?><a href="<?php echo $link . "/" . $this->getConteudoEmChaves($coluna,$linha,$num_coluna); ?>"> <?php echo $this->getConteudoEmChaves($coluna,$linha,$num_coluna); ?> </a><?php
                        } else {
                            
                            echo $this->getConteudoEmChaves($coluna,$linha,$num_coluna);
                        }
                    } else {
                        echo $this->getConteudoEmChaves($coluna,$linha,$num_coluna);
                    }
 */