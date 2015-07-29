<?php
if ($this->Session->check('exportar')) {

  //montaremos um layout limpo para impressão tanto para xls quanto para pdf 
  echo  $this->element('export',array(
       'conteudo' => $this->fetch('content'),'extensao' => $this->Session->read('exportar') ));
 
}else{
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
       <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo $this->Html->meta('icon', $this->Html->url('/favicon.ico')); ?>
        <title>SAG - Sistema de Apoio a Gestão / TIM-TRIAD</title>
        <script type="text/javascript">
            <!--
            /* Constantes*/
             var myBaseUrl = '<?php echo Router::url("/", true); ?>';
             var PROJETO_NOME = '<?php echo  Configure::read("NOME_PROJETO"); ?>'; 
             -->
        </script>
        
        <?php  echo $this->element('js_e_css');  ?>    
</head>
<body>
 
        <div class="load-circle" style="display: none;">
            <div class="loader" style="position: fixed; top: 30%; left: 50%;"></div>
        </div>

      
        <div class="container-fluid">
          <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('menu_superior'); ?>
                </div>
            </div>
         
            
            <div class="row-fluid">
                <div class="span-12">
                    <div id='main-content' class='span12'>
                        <?php //echo $this->Session->flash();
                              echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>
       

    </body>
</html> <?php }  
