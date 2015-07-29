<div id="login" title="Login" style="display: none;">
    
<?php
echo $this->element('form',array('form'=>array(
	'titulo'=> __('Sign In'),
	'create'=> 'Usuario',
	'action'=> 'login',
        'window'=> 'modal',
	'inputs'=>array(
		array('titulo'=>__('Email / Username'),'chave'=>'username','options'=>array('type'=>'text','required'=>'required','control-group-opt' => array('display' => 'coll','style'=>'width:85%'))),
		array('titulo'=>__('Password'),'chave'=>'password','options'=>array('required' => 'required',"type"=>"password",'control-group-opt' => array('display' => 'coll','style'=>'width:85%'))),
		array('titulo'=>__('Remember me'),'chave'=>'remember','options'=>array("icon"=> "","type"=>"checkbox", "class"=>"checkbox_filter", 'control-group-opt' => array('display' => 'coll','style'=>'width:85%'))),
	),
    	'submit_text'=>array(__('Enter'),
                             __('Forgot Password')),
	'submit_options'=>array(array('id'=>'submit_Login','icon'=>'fa fa-sign-in','title'=>__('Enter system'))
                              , array('id'=>'submit_SolicSenha','type'=>'button','icon'=>'fa fa-unlock','title'=>__('Request Password'))),
)));
 
?>
</div>
<div id="senha" title="Senha" style="display: none;">
    
<?php
echo $this->element('form',array('form'=>array(
	'titulo'=> __('Request Password'),
	'create'=> 'Usuario',
	'action'=> 'forgotPassword',
        'window'=> 'modal',
	'inputs'=>array(
		array('titulo'=>__('Enter Email / Username'),'chave'=>'username','options'=>array('type'=>'text','required'=>'required','control-group-opt' => array('display' => 'coll','style'=>'width:85%'))),
	),
        'submit_text'=>array(__('Send'),
                             __('Login')),
	'submit_options'=>array(array('id'=>'submit_Senha','icon'=>'fa fa-thumbs-o-up','title'=>__('Send mail request'))
                              , array('id'=>'btn_voltarLogin','type'=>'button','icon'=>'fa fa-sign-in','title'=>__('Back to login'))),
)));
?>
</div>
<script type="text/javascript">
    $(function () {
        
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
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array('title' => 'Login','no_help' => true)); ?>");
                $("button.ui-button").remove();
                
            }
        });

        $("#senha").dialog({
            autoOpen: false,
            resizable: false,
            draggable: true,
            modal: true,
            width: '300px',
            open: function(event, ui){
                
                var win = $(this);
                
                $(this).data( "uiDialog" )._title = function(title) {
                    title.html( this.options.title );
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho',array('title' => 'Solicitar reset de senha','no_help' => true)); ?>");
                $("button.ui-button").remove();
    
            }            
        });

/*
        $("#login .unlock-alt").on("click", function (e) {
            e.preventDefault();
            $.ajax({url: myBaseUrl + 'senha', type: 'get'}).done(function (data) {
                $("#login").dialog("close");
                //$("#senha").dialog({title: $(data).find("legend").text()});
                $("#senha").html(data).dialog("open");
            });
        });
  */      
        $('#submit_SolicSenha').on("click", function (e) {
            $("#login").dialog("close");
            $("#senha").dialog("open");
        });
        
        $('#btn_voltarLogin').on("click", function (e) {
            $("#senha").dialog("close");
            $("#login").dialog("open");
        });
        
    });
    
</script>

