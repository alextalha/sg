<?php
App::uses('AppModel', 'Model');

class Relatorio extends AppModel {

	public $displayField = 'nome';

	public $belongsTo = array('Grupo');

	public function getRelatoriosDeUsuario($usuario_id) {
		$conteudos_id = $this->Grupo->Permission->getConteudosIdDeUsuario("Relatorios","view",$usuario_id);
		if ($conteudos_id == 'all') return $this->find('list',array('fields'=>array('id','nome','Grupo.alias_name'),'contain'=>array("Grupo")));
		return $this->find('list',array('fields'=>array('id','nome','Grupo.alias_name'),'contain'=>array("Grupo"),
			'conditions'=>array('Relatorio.id'=>$conteudos_id)
		));
	}

	public function usuarioTemAcesso($usuario_id,$relatorio_id,$action) {
		$grupos_id = $this->Grupo->getGrupoIdsDeUsuario($usuario_id);
		return $this->Grupo->Permission->find('count',array('conditions'=>array(
			'controller'=>"Relatorios",
			'action'=>$action,
			'conteudo_id'=>array($relatorio_id,null),
			'grupo_id'=>$grupos_id,
			'allowed'=>1
		)));
	}
}
