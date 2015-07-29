<?php

App::uses('AppController', 'Controller');

/**
 * Parametros Controller
 *
 * @property Parametro $Parametro
 * @property PaginatorComponent $Paginator
 */
class ParametrosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    
        private function checaSeUsuarioLogadoTemAcesso($action, $id = "") {
        $path = "Parametros/" . $action . ($id != "" ? "/" . $id : "");
            if (!$this->checkAccess($path)) {
                // if (!$this->UserAuth->isAdmin() && !$this->Pivot->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $pivot_id, $action)) {
                $this->alert("Sorry, You don't have permission to view that page.", 'error');
                $this->redirect('index');
        }
    }
    
    
    public function index() {
        
        $this->checaSeUsuarioLogadoTemAcesso('index');
        
        $parametros = (isset($this->Session->read('filters_grid')['parametros'])) ? $this->Session->read('filters_grid')['parametros'] : "";
        $rs = $this->getParamsUrl($parametros);

        $opt = array(
            'conditions' => (!$rs ) ? array('Parametro.id > ' => 0) : $rs,
            'limit' => $this->getParametros()->getParametro('paginator')
        );

        $this->paginate = $opt;

        $fields = json_encode($parametros);
        $parametros = $this->paginate('Parametro');

        $this->set('parametros', $parametros);
        $this->set('fields', $fields);
    }

    private function add_edit($id = null) {
        
           $this->checaSeUsuarioLogadoTemAcesso('add_edit',$id);
           
        // Set edit/add mode (edit if $id not null)
        $type = "add";
        if (isset($id) and ! empty($id)) {
            $type = "edit";
        }     
                
        // Validatas if a post/put (persist mode) or get (read mode)
        if ($this->request->is(array('post', 'put'))) { // Persist mode
            // Derivate type action            
            if ($type == "edit") {
                // Verify if Parametro often exists
                if (!$this->Parametro->exists($id)) {
                    $this->alert(__('Parâmetro Inválido'));
                    return $this->redirect(array('action' => 'index'));
                }
            }else{
                // Create new data
                $this->Parametro->create();
            }
            // Set current user id (master of parameter)
            $this->request->data["Parametro"]["usuario_id"] = $this->UserAuth->getUsuarioId();
            // Persists parameter to database
            if ($this->Parametro->save($this->request->data)) {
                $this->alert(__('O Parâmetro foi atualizado.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->alert(__('O Parâmetro não pode ser salvo . Por favor , Tente novamente.'));
            }
        }else{  // Read mode
            // Read parameter from database
            $options = array('conditions' => array('Parametro.' . $this->Parametro->primaryKey => $id));
            $this->request->data = $this->Parametro->find('first', $options);
        }
        // Render ctp
        $usuarios = $this->Parametro->Usuario->find('list');
        $this->set(compact('usuarios'));
        $this->set('type', $type);
        $this->render("add");
        
    }

    public function edit($id = null) {
        $this->add_edit($id);
    }

    public function add() {
        $this->add_edit();
    }

    public function delete($id = null) {
        
         $this->checaSeUsuarioLogadoTemAcesso('delete',$id);
        $this->Parametro->id = $id;
        if (!$this->Parametro->exists()) {
            throw new NotFoundException(__('Parâmetro inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Parametro->delete()) {
            $this->alert(__('O Parâmetro foi deletado.'));
        } else {
            $this->alert(__('O parâmetro não pode ser deletado. Porfavor, tente novamente.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
