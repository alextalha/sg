<?php 

if(isset($urls)){
    
    foreach($urls as $i => $url){
        
        $action_array = explode("/", $this->here);
        $href =  ( is_array( $url ) ) ? $i ."/". implode("/", $url) : $i;
        
        if( $i == $action_array[2] ){

?>
    <li id="<?php echo $i;?>" class='ativo'>
        <a href="<?php echo "/" .Configure::read("NOME_PROJETO")."/" . $href; ?>"><?php echo $this->transformName( "_", $i ); ?> </a>
        <?php echo $this->element('icon-factory', array('icon_name'=>'times','class'=>'delCrumb','color_circle'=>'#1C1C1C','bottom'=>'2','title'=>'Fechar janela')); ?>
<?php   }else{
?>     
    <li id="<?php echo $i;?>" >
        <a href="<?php echo "/" . Configure::read("NOME_PROJETO") . "/" . $href; ?>"><?php echo $this->transformName( "_", $i ); ?> </a>
        <?php echo $this->element('icon-factory', array('icon_name'=>'times','class'=>'delCrumb','color_circle'=>'#1C1C1C','bottom'=>'2','title'=>'Fechar janela')); ?>
<?php   } 
?>
    </li>
<?php 
     
     }    
}