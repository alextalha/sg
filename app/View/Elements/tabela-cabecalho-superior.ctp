<?php 
$type = ( isset( $tabela['type'] ) && !empty( $tabela['type'] ) ? $tabela['type'] : '' ); 

if( empty( $type ) ){ 
    if ( isset( $tabela['barra_menu'] ) && !empty( $tabela['barra_menu'] ) ) echo $tabela['barra_menu'];
    echo "<h3>".$tabela['titulo'] ."</h3>";
} else { 
    echo $this->element('barra_cabecalho',array('title' => $tabela['titulo'])); 
    echo $this->Session->flash();
    
} 

if (isset($tabela['link'])) echo $tabela['link'];
?>
<div id="modal-relat-edit" class="content-content">
    
    <table class="table" id="<?php echo (isset($tabela['id'])) ? $tabela['id'] : 'table';?>" ><!-- style="margin-top: -10px;"> -->
        <tr>
		<?php foreach ($tabela['colunas'] as $num_coluna => $coluna) {
			if ($num_coluna && trim($coluna['titulo'])) echo "</th>";
			if (trim($coluna['titulo'])) echo "<th".(isset($coluna['titulo'])?" style='width: ".$coluna['width']."%'":"").">";
			echo $coluna['titulo'];
		} ?>
        </tr>
<?php   
        if (isset($tabela['form'])) echo "<tr><td colspan=".count($tabela['colunas']).">".$tabela['form']."</td></tr>"; 

        if (empty($tabela['linhas'])){ 
            echo "<tr id='no_".$tabela['titulo']."'><td colspan=".count($tabela['colunas']).">Não há ".$tabela['titulo'].".</td></tr>";
        }else{
            //debug($tabela['colunas']);
            foreach ($tabela['linhas'] as $linha) {
		echo $this->element('tabela-linha',array('colunas'=>$tabela['colunas'],'linha'=>$linha));
            }
	} ?>

    </table>
</div>
