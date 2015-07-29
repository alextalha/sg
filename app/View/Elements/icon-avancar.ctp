<?php $mode = (isset($mode) ? $mode : ""); ?>
<a class="avancar <?php echo $mode; ?>" id="avancar<?php echo $id; ?>" rel="<?php echo $id; ?>" >
    <div class="botao" title="Avancar Demanda">
        
        <i class="fa fa-check" style="display:inline;<?php if ($mode === "disable") { ?>color:#ccc;<?php } ?>"></i>

    </div>
</a>
<script type="text/javascript">
    $(document).ready( function(){

        var mode = "<?php echo $mode; ?>";

        $("a#avancar<?php echo $id; ?>").on( "click", function(){

            if(mode === "disable"){

                return false;
            }
            if( $(this).attr('class') === 'avancar disable' ){
                
                return false;
            }
            
        });
    });
</script>