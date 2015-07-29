<?php

App::uses('AppController', 'Controller');

class EtapasController extends AppController {

    private function checaSeUsuarioLogadoTemAcesso($etapa_id) {
        if (!$this->Etapa->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $etapa_id)) {
            $this->alert('Você não tem acesso a esta etapa', 'error');
            $this->redirect(array('controller' => 'processos', 'action' => 'index'));
        }
    }

    public function view($id = null) {
        $this->Etapa->id = $id;
        if (!$this->Etapa->exists()) {
            throw new NotFoundException(__('Invalid %s', __('etapa')));
        }
        $this->checaSeUsuarioLogadoTemAcesso($id);
        $this->Etapa->contain(array("Processo", "ParentEtapa", 'Aviso', 'ChildEtapa' => array('Grupo')));
        $etapa = $this->Etapa->read(null, $id);
        $this->set('etapa', $etapa);
    }
    
    public function ajax_template($etapa_id) {
        $this->autoRender = false;
        $this->Etapa->recursive = -1;
        $etapa = $this->Etapa->findById($etapa_id);
        return json_encode($etapa['Etapa']);
    }

    private function findEtapaComProcesso(){
        
        $processos    = $this->Etapa->Processo->getActiveProcesses();
        $etapasParent = array();
        
        foreach ( $processos as $i => $v ){

            $etapasProcesso = $this->Etapa->find('list',array(
                
                'conditions' => array('Etapa.processo_id' => $i)
            ));
            
            foreach ( $etapasProcesso as $j => $k ){
                
                $etapasParent[$j] = $k . " (" . $v . ")";
            }
        }

        return $etapasParent;
    }

    private function add_edit_display(){
        
        $parents    = $this->findEtapaComProcesso();
        $processos  = $this->Etapa->Processo->find('list');
        $avisos     = $this->Etapa->Aviso->find('list');
        $grupo      = $this->Etapa->Grupo->find('list');
        $this->set(compact('parents', 'processos', 'granularidades', 'avisos', 'grupo'));
    }
    
    public function return_json_request_data(){
        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if( $this->request->data['Etapa']['grupo_id'] ){
                
                $grupo = $this->Etapa->Grupo->find('all',array(
                    'fields'     => 'nome',
                    'conditions' => array( 'Grupo.id' => $this->request->data['Etapa']['grupo_id'] ),
                    'recursive'  => -1
                    )
                );
                $this->request->data['Etapa']['grupo'] = $grupo[0]['Grupo']['nome'];
            }
            
            if (!$this->request->data['Etapa']['id'])
                $this->request->data['Etapa']['id'] = rand(5000, 9999);
            if (isset($this->request->data['Etapa']['children']))
                $this->request->data['Etapa']['children'] = json_decode($this->request->data['Etapa']['children']);
            if (isset($this->request->data['Etapa']['state']))
                $this->request->data['Etapa']['state'] = json_decode($this->request->data['Etapa']['state']);
            if (isset($this->request->data['Etapa']['_parentId']))
                $this->request->data['Etapa']['_parentId'] = json_decode($this->request->data['Etapa']['_parentId']);
            return json_encode($this->request->data['Etapa']);
        }
    }

    public function add($processo_id = null){
        
        $this->request->data['Etapa']['processo_id'] = $processo_id;
        $this->set('type_etapa', 'Add');
        $this->add_edit_display();
    }

    public function edit(){
        
        $this->request->data['Etapa'] = $this->request->data;

        if (isset($this->request->data['Etapa']['children'])){
            
            $this->request->data['Etapa']['children'] = json_encode($this->request->data['Etapa']['children']);        
        }

        $this->set('type_etapa', 'Edit');
        $this->add_edit_display();
        $this->render("add");
    }

    public function inactivate($id = null) {
        $this->Etapa->id = $id;
        if (!$this->Etapa->exists()) {
            throw new NotFoundException(__('Invalid %s', __('etapa')));
        }
        $this->checaSeUsuarioLogadoTemAcesso($id);
        if ($this->Etapa->saveField('ativo', 0)){
            
//---------------Chamada do metodo de adição de log-------------------

            $this->getLogevent()->createLog(
                    
                    $this->UserAuth->getUsuarioId(), 
                    'Etapa', 
                    'inactivate', 
                    'Etapa inativada com ID: ' . $id
                    
            );

//---------------Chamada do metodo de adição de log-------------------                 
            
            $this->alert("A etapa foi desativada.", 'success');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function activate($id = null) {
        $this->Etapa->id = $id;
        if (!$this->Etapa->exists()) {
            throw new NotFoundException(__('Invalid %s', __('etapa')));
        }
        $this->checaSeUsuarioLogadoTemAcesso($id);
        if ($this->Etapa->saveField('ativo', 1)){
            
            $this->getLogevent()->createLog(
                    
                    $this->UserAuth->getUsuarioId(), 
                    'Etapa', 
                    'activate', 
                    'Etapa ativada com ID: ' . $id
                    
            );            
            
            $this->alert("A etapa foi ativada.", 'success');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function delete($id = null) {
        
        $this->autoRender = false;
        if (!$this->request->is('post')) {
            
            throw new MethodNotAllowedException();
        }
        $etapas = $this->Etapa->findById( $id );
        
        if( count($etapas) > 0 ){
            
            $this->loadModel('Demanda');
            $demanda = $this->Demanda->findByProcessoId( $etapas['Etapa']['processo_id'] );
            
            if( count( $demanda ) > 0 ){
                
                echo json_encode( '0' );
                
            } else {
                
                $this->Etapa->id = $id;
                
                if ( !$this->Etapa->exists() ){
                    
                    throw new NotFoundException(__('Invalid %s', __('etapa')));
                }
               
                
                if ( $this->Etapa->delete() ) {

                    $this->getLogevent()->createLog(

                            $this->UserAuth->getUsuarioId(), 
                            'Etapa', 
                            'delete', 
                            'Etapa deletada com ID: ' . $id

                    );            
                }
                
                $etapa = $this->ajax_treegrid( $etapas['Etapa']['processo_id'] );
                echo $etapa;
            }
        }
    }

    public function subEtapas(&$etapas, $processo_id, $copia = false) {
        if ($etapas)
            foreach ($etapas as $key => $etapa) {

                $etapas[$key]['Etapa']['sla']     = $etapa['Etapa']['duracao'];
                $etapas[$key]['Etapa']['grupo']   = $etapa['Grupo']['nome'];
                
                if ($etapa['Etapa']['processo_id'] != $processo_id)
                    unset($etapas[$key]);
                else {
                    if ($copia)
                        $etapas[$key]['Etapa']['id'] = rand(5000, 9999);
                    if (count($etapas[$key]['children']) > 0) {
                        $this->subEtapas($etapas[$key]['children'], $processo_id, $copia);
                        $etapas[$key]['Etapa']['children'] = $etapas[$key]['children'];
                    } else
                        unset($etapas[$key]['children']);
                    $etapas[$key] = $etapas[$key]['Etapa'];
                }
            }
    }

    public function ajax_treegrid($processo_id, $copia = false) {
        
        $copia = filter_var( $copia, FILTER_VALIDATE_BOOLEAN );
        $this->autoRender = false;
        $etapas = $this->Etapa->find('threaded', array('conditions' => array('Etapa.processo_id' => $processo_id), 'order' => array('Etapa.ordem' => 'ASC')));
        $this->subEtapas($etapas, $processo_id, $copia);
        return json_encode(array_values($etapas));
    }
}
