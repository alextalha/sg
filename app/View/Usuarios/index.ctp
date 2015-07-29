<?php
echo $this->element('tabela-cabecalho-superior-com-paginacao',array('tabela'=>array(
	'titulo'=>__('Usuários'),
        'barra_filtro' => $this->element('filtro_drop_box',array(
            'nome'     => 'usuario',
            'novo'     => $this->Html->url(array("controller" => "usuarios", "action" => "add")),
            'filtros'  => array(
                   array('text'=>'ID',      'name' => 'Usuario.id',         'type'=>'num'),
                    array('text'=>'Nome',   'name' => 'Usuario.nome',       'type'=>'text'),
                    array('text'=>'Login',  'name' => 'Usuario.username',   'type'=>'text'),
                    array('text'=>'E-mail', 'name' => 'Usuario.email',      'type'=>'text'),
                    array('text'=>'Cargo',  'name' => 'Usuario.cargo_id',   'type'=>'select', 'ref' => 'Cargo'),
                    array('text'=>'Grupo',  'name' => 'Grupo.id',           'type'=>'select', 'ref' => 'Grupo'),
                    array('text'=>'Ativo',  'name' => 'Usuario.active',     'type'=>'boolean'),
                ),
            'fields'     => $fields
            )
        ),    
	'colunas'=>array(
		array('titulo'=>'ID','chave'=>'Usuario.id','format'=>'','width'=>'3', 'class'=>'text-right'),
		array('titulo'=>'Nome','chave'=>'Usuario.nome','format'=>'','width'=>'25'),
		array('titulo'=>'Login','chave'=>'Usuario.username','format'=>'','width'=>'10'),
		array('titulo'=>'E-mail','chave'=>'Usuario.email','format'=>'','width'=>'20'),
		array('titulo'=>'Cargo','chave'=>'Cargo.nome','format'=>'','width'=>'10'),
		array('titulo'=>'Grupo','chave'=>'Grupo.0.nome','format'=>'','width'=>'25'),
		array('titulo'=>'Ativo','chave'=>'Usuario.active','format'=>'$this->element("icon-ativar",array("controller"=>"usuarios","ativo" => "%%%","id"=>$elemento_conteudo["Usuario"]["id"]))','width'=>'5', 'class'=>'text-center'),
                array('titulo' => 'Ações', 'chave' => 'Usuario.id', 'format' => '$this->element("icon-view",array("id" => "%%%","controller"=>"usuarios"))', 'width' => '3'),
                array('titulo'=>'','chave'=>'Usuario.id','format'=>'$this->element("icon-senha",array("id" => "%%%"))','width'=>'0'),
                array('titulo'=>' ','chave'=>'Usuario.id','format'=>'$this->element("icon-delete",array("controller"=>"usuarios","id" => "%%%"))','width'=>'0'),
	),
	'linhas'=>$users
))); 
?>
<script type="text/javascript">
$(function() {
	$(".alterar_senha").on("click",function(e) {
		e.preventDefault();
                $.ajax({

                    url: myBaseUrl + "usuarios/changeUsuarioPassword",
                    type: "put",
                    data: { user:$(this).prop('id') }
                    
                }).done(abre_modal_usuario);
	});
        
        // FACTORIZAR ESSE CARA
        $('.editar_usuarios').on('click', function () {
            var id = $(this).prop('id');
            var data = myBaseUrl + "usuarios/edit/" + id;
            jQuery(location).attr('href', data);
            return false;
        });
});
</script>