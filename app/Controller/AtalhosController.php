<?php
App::uses('AppController', 'Controller');

class AtalhosController extends AppController {

	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$atalho = array(
				'nome'=>$this->request->data['nome'],
				'url'=>$this->request->data['url'],
				'usuario_id'=>$this->UserAuth->getUsuarioId()
			);
			$this->Atalho->save($atalho);
			return json_encode($this->Atalho->id);
		}
		return json_encode(0);
	}

	public function delete($id = null) {
		$this->autoRender = false;
		$this->Atalho->id = $id;
		if ($this->request->is('post') && $this->Atalho->exists()) 
			$this->Atalho->delete();
	}

	public function show() {
        
		$this->autoRender = false;
		$this->Atalho->recursive = -1;
		$atalhos = $this->Atalho->findAllByUsuarioId($this->UserAuth->getUsuarioId());
		$ret = '';
		foreach ($atalhos as $atalho) {
			$ret .= '<a href="'.$atalho['Atalho']['url'].'" id="'.$atalho['Atalho']['id'].'">'.$atalho['Atalho']['nome'].'</a>';
		}
		return $ret;
	}
}
