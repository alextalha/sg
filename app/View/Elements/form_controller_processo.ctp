<?php

/* 
 * by furious
 */

?>
<form id="CopiarProcessoForm" style="margin-top: 20px; margin-left: 40px;">
    <div class="control-group">
        <label class="control-label" for="CopiarProcessoCopiar">

        </label>
        <div class="controls">

            <label class="" style="display: block;">
                
                <input id="CopiarProcessoCopiar1" class="" type="radio" value="1" name="copiar_processo"></input>
            </label>
            
            <select id="CopiarProcessoCopiarDe" style="display: inline-table; width: 350px; margin-left: 25px; margin-top: -35px;">
                    
                    <option value="">== Selecione ==</option>

<?php 

    if( isset($processos) && !empty($processos) ){
        
        foreach ( $processos as $i => $v ){ ?>
                
                <option value="<?php echo $i; ?>"> <?php echo $v; ?> </option>
        <?php }
    }

?>                
                
            </select>

            <label class="" style="display: block; margin-top: 20px;">
                <input id="CopiarProcessoCopiar0" class="" type="radio" checked="checked" value="0" name="copiar_processo"></input>
                <div style="display: inline-table; width: 300px; margin-left: 10px;"> Não Copiar </div>
            </label>

        </div>   
        
    </div>
    <div style="position: relative; top: 30px; left: -30px;" >
<?php     

    echo $this->element('acoes_do_formulario', array('create' => 'copiar_processo','id_cancela' => 'cancela_precesso') );
?>
    </div>
    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        
        checkValue( $("#CopiarProcessoForm input[type='radio']:checked") );

        $("input[name='copiar_processo']").change(function(){
            
            checkValue($(this));
        });
        
        function checkValue(element){
            
            if( element.val() === "1" ){
                
                $("#CopiarProcessoCopiarDe").prop('disabled', false);
            } else {
                $("#CopiarProcessoCopiarDe").prop('disabled', 'disabled');
            }
        }
        
        $("#cancela_precesso").on('click',function(e){
            
            var url = myBaseUrl + "processos/";
            jQuery( location ).attr( 'href', url );
        });
    });
</script>