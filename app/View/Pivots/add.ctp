<?php 

echo $this->element('form',array('form'=>array(
	'titulo'=> __($type.' %s', __('Pivot')),
	'create'=> 'Pivot',
	'action'=>$type,
	'inputs'=>array(
		array('titulo'=>'','chave'=>'id','options'=>array('type'=>'hidden')),
		array('titulo'=>'Nome','chave'=>'nome','options'=>array('required'=>'required')),
		array('titulo'=>'Descrição','chave'=>'descricao','options'=>array('type'=>'textarea')),
		array('titulo'=>'Grupo','chave'=>'grupo_id','options'=>array('required'=>'required')),
		array('titulo'=>'Tipo de Base','chave'=>'tipo_base',
                    'options'=>array(
                        'type'=>'select','required'=>'required','options'=>array(
			'sqlsrv'=>'SQL Server','sqlite'=>'SQLite','mysql'=>'MySQL','pgsql' => "Postgres"
		))),
		array('titulo'=>'Servidor','chave'=>'servidor','options'=>array()),
		array('titulo'=>'Base ou Arquivo','chave'=>'base','options'=>array('required'=>'required')),
		array('titulo'=>'Usuário','chave'=>'usuario','options'=>array()),
		array('titulo'=>'Senha','chave'=>'senha','options'=>array()),
		array('titulo'=>'Tabela','chave'=>'tabela','options'=>array()),
		array('titulo'=>'Campos','chave'=>'campos','options'=>array()),
		array('titulo'=>'Colunas','chave'=>'colunas','options'=>array()),
		array('titulo'=>'Linhas','chave'=>'linhas','options'=>array()),
		array('titulo'=>'Valores','chave'=>'valores','options'=>array())
	),
	'subform'=>""
))); 

?>

<script type="text/javascript">
var _mainForm = "form#Pivot<?php echo ucwords($type); ?>Form";
$(document).ready(function(){

    $("#submit_Pivot").click(function(){
        $(_mainForm).submit();
    });
    
    $('#PivotSelectall').change(function(event) {
        if( this.checked ) {
            $('.optvals').each(function() {
                this.checked = true;
            });
        }else{
            $('.optvals').each(function() {
                this.checked = false;
            });        
        }
    });
    
});
</script>