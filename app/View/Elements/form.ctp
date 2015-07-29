
<?php if(!$this->Session->check('exportar')){ 


$form_options = array();

$form_options['onsubmit'] = 'loading()';

$form_options['class'] = 'form-horizontal';

if (isset($form['action'])){ $form_options['action'] = $form['action']; }
if (isset($form['id'])){ $form_options['id'] = $form['id']; }
if (isset($form['type'])){ $form_options['type'] = $form['type']; }

if( isset( $form['window'] ) && $form['window'] == 'modal' ){ $window = "modal"; }else{
    $window = "";
    echo $this->element('barra_cabecalho',array('title' => $form['titulo']));
}

//echo $this->request->params['controller'];

if($this->request->params['controller'] == 'pages'){
    echo $this->Session->flash();
}

echo $this->Form->create($form['create'], $form_options);
$div = ($this->request->is('ajax')) ? "content-edit" : "content-inputs";
?>
<div class="content-content">

    <!-- Estilos diferentes para add e edit -->
    <div class="<?php echo $div; ?>">
        <?php
        $i = 0;
        
        foreach ($form['inputs'] as $input) {
          echo ($this->Form->input($input['chave'],$input['options'], $input['titulo']));
            $i++;
        } 
        ?>
    </div>
    <?php
    if (isset($form['subform'])) {

        if (!is_array($form['subform'])) {
            $subforms[] = $form['subform'];
        } else {
            $subforms = $form['subform'];
        }
        foreach ($subforms as $i => $subform) {

            echo "<div class='subform'>" . $subform . "</div>";
        }
    }

    if (isset($form['subtable']) && !empty($form['subtable'])) {

        if (!is_array($form['subtable'])){
            
            $subtable[] = $form['subtable'];
        } else {
            
            $subtable = $form['subtable'];
        }
        foreach ($subtable as $i => $sub) {

            echo "<div class='subtable'>" . $sub . "</div>";
        }
    }

    $permissionWithoutSession = array('Usuarios/login', 'Usuarios/logout', 'Usuarios/requestPassword', 'Usuarios/register', 'Usuarios/userVerification', 'Usuarios/forgotPassword', 'Usuarios/activatePassword', 'Usuarios/emailVerification');
    $pathToCheck = ucwords( $form['create'] ) . 's/' . $form['action'];
    
    if (in_array($pathToCheck, $permissionWithoutSession) || $this->Permissions->check($pathToCheck)) {
        
        
        $submit_text    = (isset($form['submit_text']))         ? $form['submit_text']          : '';
        $submit_options = (isset($form['submit_options']))      ? $form['submit_options']       : array('id' => 'submit_' . $form['create'], 'icon' => 'save', 'title' => 'Save');

        if( !empty( $submit_text ) ){
            $xbutton ='';
            $xbutton.='<div class="form-actions">';
            if(is_array($submit_text)){
                foreach($submit_text as $k=>$v){
                    $xopt = isset($submit_options[$k])?$submit_options[$k]:null;
                    if(is_array($xopt)){
                        $xopt = (!empty($xopt)?$xopt:array());    
                    }else{
                        $xopt = $submit_options;
                    }
                    
                    $xbutton.= $this->Form->submit($submit_text[$k], $xopt);
                }
            }else{
                $xbutton.=$this->Form->submit($submit_text, $submit_options);
            }
            $xbutton.='</div>';
            //echo '<div class="form-actions">' . $this->Form->submit($submit_text, $submit_options) . '</div>';
            echo $xbutton;
            
        } else {
            
            echo $this->element('acoes_do_formulario', array('create' => $form['create']) );
        }
    }
    ?>
</div>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">

    $(document).ready(function(){
        
        var window  = "<?php echo $window; ?>";
        var model   = "<?php echo $form['create']; ?>";
        var control = model.toLowerCase()+'s';
        
        $("div.salvar_dados > a > div[id^='submit_']").bind("dblclick", function(e){
            
            e.preventDefault();
            return false;
        });
        
        $("div.salvar_dados > a > div[id^='submit_']").click( function(){
            
            if( window === "modal" && $(this).attr("id") !== "submit_Demanda" && $(this).attr("id") !== "submit_Processo" ){
                
                validate( model );
            }
        });
        
        $(".limpar_botoes_form").on('click',function(){
            
            //console.log( model );
            
            if( model === 'Processo' || model === 'Demanda' || model === 'Arquivo' ){}else{
            
                var s = confirm( "Deseja mesmo limpar todos os dados da tela?" );
                if( !s ){ return false; }

                data_cadastro = $('.datepick ').val();
                $("form").trigger("reset");
                $('select:enabled').val('').trigger('chosen:updated');
                $('.datepick').val(data_cadastro);
            }
        });

        $(".cancelar_botoes_form").on('click',function(e){
            e.preventDefault();
            
            var form_destino = $(this.parentNode.parentNode.parentNode);
            
            if( window === "modal" || form_destino.attr("id") === "ArquivoSaveForm" ){
                
                $(".ui-dialog-content").dialog("close");
                
            } else {
                
                var url = myBaseUrl + control + "/";
                jQuery( location ).attr( 'href', url );
            }
        });
        
        function validate( model ){
            
            if( model === "" ){ return false; }
            
            var form  = $("form[id^='"+model+"']").serialize();
            
            $.ajax({
                
                url: myBaseUrl + "onvalites/getValidate/",
                type: "post",
                data: form,
                async: false,
                dataType: "json",
                success: function (data){
                    
                    if( data === '0' ){}else{

                        $("form").submit( function(){ return false; } );

                        $('body').find('div.load-circle').remove();
                        $(this).find("div[id^='submit_']").show();
                        
                        if( $.isEmptyObject( data ) ){}else{
                            
                            $.each( data, function(i, v ){
                                
                                if( model === "Arquivo" ){
                                    if( i === "nome" ){ i = "file"; }
                                }
                                
                                var campo = document.getElementsByName("data["+model+"]["+i+"]");

                                var span = '<span class="help-inline error-message">Este campo não pode ser deixado em branco</span>';
                                
                                $(campo[0].parentNode).find('span').remove();
                                
                                $(campo[0].parentNode).append( span ); 
                                $(campo[0].parentNode.parentNode).addClass( "error" );
                                
                            });
                        }
                    }
                }
            });
        }
    });
</script>

<?php }