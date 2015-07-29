<?php 

$this->layout = 'export';



/*
 * 
 * 
 * 
 * Array
(
    [0] => Array
        (
            [Cargos] => Array
                (
                    [id] => 1
                    [nome] => Analista de Sistemas
                    [created] => 2009-03-02 11:14:42
                    [modified] => 2009-03-02 11:14:42
                )

        )

    [1] => Array
        (
            [Cargos] => Array
                (
                    [id] => 2
                    [nome] => Analista Programador
                    [created] => 2009-03-02 11:14:42
                    [modified] => 2009-03-02 11:14:42
                )

        )
 */


        ?>
        
<table class="table table-striped table-bordered ">
    <tr>
        
        <?php foreach($data[0][$model] as $key => $value){
            echo "<th>". $key ."</th>";
        }
         ?>
        
    </tr>    
    <tr>    

         <?php

         for($i = 0 ; $i < count($data); $i++){
            echo "<tr>";
             foreach($data[$i][$model] as $key => $value){
                 echo "<td>" . $value ."</td>";
             }
         }
         echo "</tr>"
 ?>
  
    
    
</table>