<?php
App::uses('AppModel', 'Model');

class Historico extends AppModel {

	public $displayField = 'nome';

	public $belongsTo = array('Usuario');

	private function getNomeConteudo($controller,$conteudo_id) {
		$model_name = ucwords(trim($controller,'s'));
		$Model = ClassRegistry::init($model_name);
		$Model->id = $conteudo_id;
		return $Model->field($Model->displayField);
	}

	public function afterFind($results, $primary=false) {

	    App::uses('Historico', 'Model');
		$Historico = new Historico();

	    foreach ($results as $key => $val) {
	    	
	        if (isset($val['Historico']['id'])) {
	            $results[$key]['Historico']['nome'] = $Historico->getNomeConteudo($val['Historico']['controller'],$val['Historico']['conteudo_id']);
	        } else if (isset($results['id'])) {
	        	$results['nome'] = $Historico->getNomeConteudo($results['controller'],$results['conteudo_id']);
	        }
	    }
	    return $results;
	}

	private function comparaDadosERetornaDiferencas($model,$dados_anterior,$dados_novo,$usuario_id) {
		$diferencas = array();
		foreach ($dados_anterior as $campo => $dado_anterior) {
			if ($dados_novo[$campo] != $dado_anterior) 
				$diferencas[] = array(
					'tabela'=>$this->$model->table,
					'campo'=>$campo,
					'valor_anterior' => $dado_anterior,
					'valor_novo' => $dados_novo[$campo],
					'usuario_id'=>$usuario_id
				);
		}
		return $diferencas;
	}

	public function add($model,$dados_anterior,$dados_novo,$usuario_id) {
		$diferencas = $this->comparaDadosERetornaDiferencas($model,$dados_anterior,$dados_novo,$usuario_id);
		$this->Historico->saveMany($diferencas);
	}
}
