<div id="login" title="Ativar Login" style="display: none;">
<?php
/*
$userId = 80;
$password = "pedro#2010";
$salt = "4bdd7fa4183797cbb9037c4c993053f6";
$activate_key = md5(md5($password) . $salt);
$link = Router::url("activatePassword?ident=$userId&activate=$activate_key", true);
debug($link);
 * */

echo $this->Session->flash(); 

echo $this->element('form',array('form'=>array(
	'titulo'=> __('Reset Password'),
	'create'=> 'Usuario',
        'window'=> 'modal',
	'action'=>'activatePassword',
	'inputs'=>array(
		array('titulo'=>'','chave'=>'ident','options'=>array('type'=>'hidden','value'=>(isset($ident) ? $ident : ''))),
		array('titulo'=>'','chave'=>'activate','options'=>array('type'=>'hidden','value'=>(isset($activate) ? $activate : ''))),
		array('titulo'=>__('Password'),'chave'=>'password','options'=>array('required' => 'required',"type"=>"password")),
		array('titulo'=>__('Confirm Password'),'chave'=>'cpassword','options'=>array('required' => 'required',"type"=>"password"))
	)
))); 
?>
</div>

<script type="text/javascript">
// TODO: JOGAR ESSE SUBMIT DEFAULT PARA O REFACTORY
var _mainForm = "form#UsuarioActivatePasswordForm";
$(document).ready(function(){
    $("div.content-inputs").css({
        'padding-left':'25px', 
        '-webkit-box-sizing': 'border-box', 
        '-moz-box-sizing': 'border-box',    
        'box-sizing': 'border-box'   
    });

    $('div').removeClass("content-inputs");

    $("#login").dialog({
        autoOpen: true,
        resizable: false,
        draggable: true,
        modal: true,
        width: '300px',
        open: function(event, ui){

            var win = $(this);

            $(this).data( "uiDialog" )._title = function(title) {
                title.html( this.options.title );
            };
            $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array('title' => 'Ativação de acesso','no_help' => true)); ?>");
            $("button.ui-button").remove();

        }
    });

    $("#submit_Usuario").click(function(){
        $(_mainForm).submit();
    });
    
    $(".cancelar_botoes_form").click(function(){
        window.location.href = '<?php echo Router::url("/"); ?>';
    });

});
</script>