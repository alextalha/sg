<?php

App::uses('AppController', 'Controller');

class GruposController extends AppController {

    private function checaSeUsuarioLogadoTemAcesso($action,$id="") {
        $path = "Grupos/".$action.($id!=""?"/".$id:"");
        if(!$this->checkAccess($path)){
            $this->alert("Sorry, You don't have permission to view that page.", 'error');
            $this->redirect('index');
            return false;
        }
        return true;
    }
    
    /**
     * Load index screen listing all groups stored on database
     *
     * @access public
     * @param none
     * @return void
     */
    public function index() {
        
        $this->checaSeUsuarioLogadoTemAcesso("index");
        
        $parametros = (isset( $this->Session->read('filters_grid')['grupos'] ))?$this->Session->read('filters_grid')['grupos']:"";
        $rs  = $this->getParamsUrl( $parametros );
        
        $conditions = '';
        if (!$this->UserAuth->isAdmin()) {
            $gruposDoUsuarioLogado = $this->Grupo->getGrupoIdsDeUsuario($this->UserAuth->getUsuarioId());
            $conditions['Grupo.id'] = $gruposDoUsuarioLogado;
        }

        $opt = array(
            
            'conditions' => array( (empty( $conditions )?'':$conditions),(!$rs)?'':$rs ),
            'limit'      => $this->getParametros()->getParametro('paginator')
        );        

        $this->paginate = $opt;
        
        $fields = json_encode( $parametros );
        
        $this->Grupo->recursive = 0;
        $cargos = $this->paginate( 'Grupo' );

        $this->set( 'grupos', $cargos );
        $this->set( 'fields', $fields );        
    }

    /**
     * Used persiste group data to database and load group data to screen
     *
     * @access public
     * @param integer $id id of group
     * @return void
     */
    private function add_edit($id=null) {
        
        $type = "add";
        if(!is_null($id)){
            $type = "edit";
        }
        
        $this->checaSeUsuarioLogadoTemAcesso($type);
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if ( $this->Grupo->validates() ) {        
                
                if(is_null($id)){           // Add
                    $this->Grupo->create();    
                }else{                      // Edit
                    $this->Grupo->id = $id;
                    if (!$this->Grupo->exists()) {
                        throw new NotFoundException(__('Invalid %s', __('Grupo')));
                    }
                }

                // Save to database
                if ( $this->Grupo->save( $this->request->data ) ) {

                    $this->Grupo->Permission->addPermissoesGrupo( $this->request->data, $this->Grupo->id );

                    $this->alert('Grupo saved', 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                     $this->alert('Grupo NOT saved', 'error');
                }
                
            }   
            
        }else{ // Read database data
            $this->request->data = $this->Grupo->findById($id);
        }
        // load add/edit screen
        // - Load permissions - INI
        $permissoes = array();
        $this->ControllerList = $this->Components->load('ControllerList');
        $controllers=$this->ControllerList->get();
        $method = ($id) ? "getPermissoesGrupo" : "getAllPermissoes";
        $permissoes = $this->Grupo->Permission->$method($controllers, $id);
        $this->set('permissoes', $permissoes);
        // - Load permissions - END
        $this->set(compact('usuarios'));
        $this->Grupo->contain(array("Usuario" => array("Cargo" => array("fields" => "nome"))));
        //$this->request->data = $this->Grupo->findById($id);
        $this->set('type', $type);
        $this->render("add");
    }

    /**
     * Used to add a group to database or load group screen to add
     *
     * @access public
     * @param none
     * @return void
     */
    public function add() {
        $this->add_edit();
    }

    /**
     * Used to edit a group data on database or load group screen to edit
     *
     * @access public
     * @param integer $id group id of group
     * @return void
     */
    public function edit($id = null) {
        //debug(" 1 - $id -");
        $this->add_edit($id);
    }
    
    /**
     * Used to delete a group that was not in use
     *
     * @access public
     * @param integer $id group id of group
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Grupo->id = $id;
        if (!$this->Grupo->exists()) {
            throw new NotFoundException(__('Invalid %s', __('Grupo')));
        }
        
        $this->checaSeUsuarioLogadoTemAcesso("delete");
        
        if ($this->Grupo->delete()) {
            $this->alert('Grupo removed', 'success');
        } else {
            $this->alert('Grupo NOT removed', 'error');
        }
        $this->redirect(array('action' => 'index'));
    }
}
