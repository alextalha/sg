<?php
$mode = (isset($mode) ? $mode : "");
$usuarioTemAcesso = (isset($usuarioTemAcesso)) ? $usuarioTemAcesso : true;
//$controller=ucwords($controller);
if ($usuarioTemAcesso && $this->Permissions->check(ucwords($controller) . '/view')) {
    $url = (isset($url) && $mode !== "disable") ? $this->Html->url(array('controller' => $controller, 'action' => 'delete', $id)) : '#';
    ?>
    <a href="<?php echo $url; ?>" class="excluir_<?php echo $controller; ?> <?php echo $mode; ?>" id="<?php echo $id; ?>" rel="excluir<?php echo $id; ?>">
        <div class="botao" title="Excluir">
            <i class="fa fa-remove" style="<?php if ($mode === "disable") { ?>color:#ccc;<?php } ?>"></i>
        </div>
    </a>
    <script type="text/javascript">
        
        $(document).ready(function () {

            //var mode  = "<?php// echo $mode; ?>";
            
            $("a[rel='excluir<?php echo $id; ?>']").on("click", function (){

                if ($(this).attr('class') === "excluir_processos_disable disable") {

                    return false;
                }
                
            });
        });
        
    </script>
<?php
}