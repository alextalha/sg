<?php

App::uses('AppController', 'Controller');

class AvisosController extends AppController {

    public function index(){
        
        $this->Aviso->recursive = 0;
        $this->set('avisos', $this->paginate());
    }

    private function add_edit_post(&$data, $mensagens){
        
        if ($this->Aviso->save($data)) {
            $this->alert($mensagens['success'], 'success');
        } else
            $this->alert($mensagens['error'], 'error');
        $this->redirect(array('action' => 'index'));
    }

    public function add(){
        
        if ($this->request->is('post')) {
            $this->Aviso->create();
            $this->add_edit_post($this->request->data, array(
                'success' => "O aviso foi salvo com sucesso.",
                'error' => "O aviso não pode ser salvo."
            ));
        }
        $this->set('type', "add");
    }

    public function edit($id = null) {
        $this->Aviso->id = $id;
        if (!$this->Aviso->exists()) {
            throw new NotFoundException(__('Invalid %s', __('aviso')));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->add_edit_post($this->request->data, array(
                'success' => "O aviso foi atualizado com sucesso.",
                'error' => "O aviso não pode ser atualizado."
            ));
        }
        $this->request->data = $this->Aviso->read(null, $id);
        $this->set('type', "edit");
        $this->render("add");
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Aviso->id = $id;
        if (!$this->Aviso->exists()) {
            throw new NotFoundException(__('Invalid %s', __('aviso')));
        }
        if ($this->Aviso->delete()) {
            $this->alert(
                    __('The %s deleted', __('aviso')), 'alert', array(
                'plugin' => 'TwitterBootstrap',
                'class' => 'alert-success'
                    )
            );
            $this->redirect(array('action' => 'index'));
        }
        $this->alert(
                __('The %s was not deleted', __('aviso')), 'alert', array(
            'plugin' => 'TwitterBootstrap',
            'class' => 'alert-error'
                )
        );
        $this->redirect(array('action' => 'index'));
    }

}
