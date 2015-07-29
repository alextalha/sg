<?php $mode = (isset($mode) ? " " . $mode : ""); ?>
<a class="avisos<?php echo $mode; ?>" id="<?php echo $id; ?>" rel="avisos<?php echo $id; ?>">
    <div class="botao" title="Emitir Avisos">
        <i class="fa fa-envelope" style="display:inline;<?php if (trim($mode) === "disable") { ?>color:#ccc;<?php } ?>"></i>
    </div>
</a>
<script type="text/javascript">
    $(document).ready( function(){

        var mode = "<?php echo trim($mode); ?>";

        $("a[rel='avisos<?php echo $id; ?>']").on("click", function(){

            if(mode === "disable"){

                return false;
            }
        });
    });
</script>