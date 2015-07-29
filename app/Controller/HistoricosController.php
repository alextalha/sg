<?php
App::uses('AppController', 'Controller');

class HistoricosController extends AppController {

	public function index() {
		$this->Historico->recursive = 0;
		$this->set('historicos', $this->paginate("Historico","1 ORDER BY Historico.created DESC"));
	}

}
