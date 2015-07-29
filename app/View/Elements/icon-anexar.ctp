<?php $mode = (isset($mode) ? $mode : ""); ?>
<a class="anexar <?php echo $mode; ?>" id="anexar<?php echo $id; ?>" rel="<?php echo $id; ?>" >
    <div class="botao" title="Anexar arquivo">
        
        <i class="fa fa-paperclip" style="display:inline;<?php if ($mode === "disable") { ?>color:#ccc;<?php } ?>"></i>

    </div>
</a>
<script type="text/javascript">
    $(document).ready( function(){

        var mode = "<?php echo $mode; ?>";

        $("a#anexar<?php echo $id; ?>").on( "click", function(){

            if(mode === "disable"){

                return false;
            }
            if( $(this).attr('class') === 'anexar disable' ){

                return false;
            }              
        });
    });
</script>