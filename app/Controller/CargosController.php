<?php

App::uses('AppController', 'Controller');

/**
 * Cargos Controller
 *
 * @property Cargo $Cargo
 * @property PaginatorComponent $Paginator
 */
class CargosController extends AppController {

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
        $path = "Cargos/" . $action . ($id != "" ? "/" . $id : "");
        if (!$this->checkAccess($path)) {
            // if (!$this->UserAuth->isAdmin() && !$this->Pivot->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $pivot_id, $action)) {
            $this->alert("Sorry, You don't have permission to view that page.", 'error');
            $this->redirect('index');
        }
    }

    public function index() {
        
       $this->checaSeUsuarioLogadoTemAcesso('index');
       
  
        $this->Cargo->recursive = 0;
        $this->set('cargos', $this->Paginator->paginate());

        $parametros = (isset($this->Session->read('filters_grid')['cargos'])) ? $this->Session->read('filters_grid')['cargos'] : "";
        $rs = $this->getParamsUrl($parametros);

        $opt = array(
            'conditions' => (!$rs ) ? array('Cargo.id > ' => 0) : $rs,
            'limit' => $this->getParametros()->getParametro('paginator')
        );

        $this->paginate = $opt;

        $fields = json_encode($parametros);

        $this->Cargo->recursive = 0;
        $cargos = $this->paginate('Cargo');

        $this->set('cargos', $cargos);
        $this->set('fields', $fields);

    }

    private function add_edit($id = null) {

        
         $this->checaSeUsuarioLogadoTemAcesso('add_edit',$id);
         
        if (isset($id) and ! empty($id)) {
                $type = "edit";
            if (!$this->Cargo->exists($id)) {
                $this->alert(__('Cargo Inválido'));
                return $this->redirect(array('action' => 'index'));
                 
            }
         
            if ($this->request->is(array('post', 'put'))) {
               
        
                if ($this->Cargo->save($this->request->data)) {
                    
                    
                    $this->alert(__('O cargo foi atualizado.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->alert(__('O cargo não pode ser salvo. Por favor , Tente novamente .'));
                }
            } else {
                $options = array('conditions' => array('Cargo.' . $this->Cargo->primaryKey => $id));
                $this->request->data = $this->Cargo->find('first', $options);
            }
        } else {
                 $type = "add";
            if ($this->request->is('post')) {
                
                $this->Cargo->create();
                if ($this->Cargo->save($this->request->data)) {
                    $this->alert(__('O cargo foi salvo.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->alert(__('O cargo não pode ser salvo. Porfavor, Tente novamente.'));
                }
            }
        }

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
        
        $this->Cargo->id = $id;
        if (!$this->Cargo->exists()) {
            throw new NotFoundException(__('Cargo Inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Cargo->delete()) {
            $this->alert(__('O cargo foi deletado.'));
        } else {
            $this->alert(__('O cargo não pode ser deletado. Porfavor, Tente novamente .'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
