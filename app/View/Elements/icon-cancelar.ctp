<?php $mode = (isset($mode) ? $mode : ""); ?>
<a class="cancelar <?php echo $mode; ?>" id="cancelar<?php echo $id; ?>" rel="<?php echo $id; ?>">
    <div class="botao" title="Cancelar Demanda!">

        <i class="fa fa-ban" style="display:inline;<?php if ($mode === "disable") { ?>color:#ccc;<?php } ?>"></i>

    </div>
</a>
<script type="text/javascript">
    $(document).ready(function () {

        var mode = "<?php echo $mode; ?>";

        $("a#cancelar<?php echo $id; ?>").on("click", function () {

            if (mode === "disable") {

                return false;
            }
            if( $(this).attr('class') === 'cancelar disable' ){
                
                return false;
            }            
        });
    });
</script>