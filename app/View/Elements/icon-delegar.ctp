<?php $mode = (isset($mode) ? $mode : ""); ?>
<a class="delegar <?php echo $mode; ?>" id="delegar<?php echo $id; ?>" rel="<?php echo $id; ?>">
    <div class="botao" title="Delegar Responsabilidade">

        <i class="fa fa-user" style="display:inline;<?php if ($mode === "disable") { ?>color:#ccc;<?php } ?>"></i>

    </div>
</a>
<script type="text/javascript">
    $(document).ready(function () {

        var mode = "<?php echo $mode; ?>";

        $("a#delegar<?php echo $id; ?>").on("click", function () {

            if (mode === "disable") {

                return false;
            }
        });
    });
</script>