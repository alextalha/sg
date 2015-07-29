<?php

$linhas = $this->line_number_paginator($this->Paginator->params());
 if(!$this->Session->check('exportar')){
echo $this->element('barra_cabecalho', array('title' => $tabela['titulo'])); 
echo $this->Session->flash();
 }
?>
    <?php 
    if(!$this->Session->check('exportar')){ ?>
        <div class="content-content">
          
            <div class="row">
        <br />

        <?php if (isset($tabela['barra_filtro'])) {
            echo $tabela['barra_filtro'];
        } else {
            echo $tabela['barra_menu'];
        }
        
        ?>
         <div id='expand-table'>
            <div class='text-center'>
                <img src="<?php echo $this->html->url('/', true);?>imagens/seta_table_filtro_cima.png" /> 
              
            </div>
        </div>
        
   <?php } ?>
    
       
        <table class="table tabela_ajuste" id="<?php echo (isset($tabela['id'])) ? $tabela['id'] : 'table'; ?>">
            <tr>
             <?php if(!($this->Session->check('exportar'))) {
                echo "<th></th>"; 
             }
                $i = 0;
              
                foreach ($tabela['colunas'] as $num_coluna => $coluna) {

                    $width = (isset($coluna['width'])) ? $coluna['width'] . '%' : 'auto';

                    $chaves = explode('.', $coluna['chave']);

                    if ($num_coluna && trim($coluna['titulo'])) {

                      // echo "</th>";
                    }
                    $nome_coluna = end($chaves);

                    if (isset($this->Paginator->options['url']['direction']) && !empty($this->Paginator->options['url']['direction'])) {
                        
                    } else {

                        $this->Paginator->options['url']['direction'] = 'asc';
                    }

                    $order = ( $this->Paginator->options['url']['direction'] == 'asc' ) ? "fa fa-sort-asc" : "fa fa-sort-desc";


                    if (trim($coluna['titulo'] )) {
                          
                            if($this->Session->check('exportar') && $coluna['titulo'] == 'Ações'){
                            }else{
                                echo "<th width='{$width}'>" . $this->Paginator->sort($nome_coluna, $coluna['titulo'], array('direction' => 'desc')) . " <div class='" . $order . "'style='float: right; position: relative; margin-top: 7px;'></div></th>";
                           
                        
                    }
                    $i++;
                }
                
                }
                ?>


            </tr>
            <tr>
                
            <?php if (isset($tabela['form'])) echo $tabela['form']; ?>
            </tr>

            <?php
            if (empty($tabela['linhas'])) {
                echo "<tr id='no_" . $tabela['titulo'] . "'><td colspan=" . count($tabela['colunas']) . ">Não há " . $tabela['titulo'] . ".</td></tr>";
            } else {
                $l = 0;
  foreach ($tabela['linhas'] as $linha){
  
                    $milestone       = ( isset( $linha['Etapa']['milestone'] ) && $linha['Etapa']['milestone'] ) ? "font-weight: bold;!important;" : "";
                    $demanda_color   = ( isset( $linha['StatusDemanda']['cor'] ) ) ? "background:".$linha['StatusDemanda']['cor']." !important;" : "";
                    $atividade_color = ( isset( $linha['StatusAtividade']['cor'] ) ) ? "background:".$linha['StatusAtividade']['cor']." !important;" : "";
                    $cor             = ( !empty( $demanda_color ) ) ? $demanda_color : $atividade_color;
                    
                    
                   if(($this->Session->check('exportar'))){
                       if(empty($cor)){ 
                           echo '<tr>';
                           
                        }else{
                            echo "<tr style='".$cor.$milestone."'><td>". $linhas[$l++];
                        }
                     }else{ //
                        echo "<tr style='".$cor.$milestone."'><td>". $linhas[$l++] . "</td>";
                    }
                  
                    if($this->Session->check('exportar') && $tabela['colunas'][$l]['titulo'] == 'Ações'){
                        $l = 0;
                      
                    }else{
                        
                         echo $this->element('tabela-linha', array('colunas' => $tabela['colunas'], 'linha' => $linha )); 
                    }
  
                }
                
            }
            
            ?>

        </table>

     
          <?php if(!$this->Session->check('exportar')){?>
        
        <div class="paginacao span12">
            <div class="paginacao-total"> <?php echo $this->Paginator->counter(array('format' => __('Total de registros: {:count}'))); ?></div>
                <div class="paginacao-central">
                <?php
                    //Primeiro 
                    if($this->Paginator->hasPrev()){ //se tem anterior 
                        echo "<div class='prev anterior-paginacao'>"; 
                        echo "<ul>";
                        echo $this->Paginator->first(
                            '<i class="fa fa-backward fa-lg" style="position:relative; top:-1px"></i>',
                            array('escape'=>false),null,array('class' => 'prev disabled prv', 'tag' => 'li', 'escape'=>false)
                            );
              
                        
                            //Anterior 
                        echo $this->Paginator->prev(
                        '<i class="fa fa-caret-left fa-2x" style="position:relative; top:3px"></i>',
                        array('tag' => 'li','escape'=>false),null, array('class' => 'prev disabled prv', 'tag' => 'li', 'escape'=>false)
                        );
              
                        echo "</ul>";
                        echo "</div>";
                       
                    }else{
                        // criamos uma div vazia para não quebrar o layout 
                          echo "<div class='prev anterior-paginacao'>"; 
                          echo "&nbsp;";
                          echo "</div>";
                    }
              
             
                    echo "<div class='center-paginate'>";
                    echo "<ul>";
                    echo $this->Paginator->numbers(array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp', 'currentClass' => 'textUnderline'));     
                    echo "</ul>";
                    echo "</div>";
           
              
                    if($this->Paginator->hasNext()){  // se tem próximo
                        echo "<div class='next proximo-paginacao'>";     
                        echo "<ul>";
              
              
                        echo $this->Paginator->next(
                            '<i class="fa fa-caret-right fa-2x" style="position:relative; top:3px"></i>',
                            array('escape'=>false),null,array('class' => 'next disabled nxt', 'tag' => 'li', 'escape'=>false)
                        );
                        echo $this->Paginator->last(
                            '<i class="fa fa-forward fa-lg" style="position:relative; top:-1px"></i>',
                            array('escape'=>false),null,array('class' => 'next disabled nxt', 'tag' => 'li', 'escape'=>false)
                        );    
              
                        echo "</ul>";
                        echo "</div>";
                    }else{
                       // criamos uma div vazia para não quebrar o layout 
                          echo "<div class='prev proximo-paginacao'>";
                          echo "&nbsp;";
                          echo "</div>"; 
                    }
              ?>
 
          </div>
  
             <div class="paginacao-paginas"> <?php echo $this->Paginator->counter(array('format' => __('Total de páginas: {:pages}'))); ?> </div>
                </div>
            </div>
    </div>      

    <?php } ?>
          


