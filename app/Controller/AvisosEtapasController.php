<?php

App::uses('AppController', 'Controller');

class AvisosEtapasController extends AppController {

    public function view(){

        $aviso_id               = "";
        $avisos_configurados    = "";
        
        if( isset( $this->request->data['etapa_id'] ) && !empty( $this->request->data['etapa_id'] ) ){
            
            $this->loadModel( 'Etapa' );
            
            $aviso_id               = $this->AvisoEtapa->Aviso->find('list');
            $etapas                 = $this->Etapa->findById( $this->request->data['etapa_id'] );
            $avisos_configurados    = $this->AvisoEtapa->findAllByEtapaId( $this->request->data['etapa_id'] );
            
        }
        $etapa_nome = ( empty( $etapas ) || count( $etapas ) == 0 ) ? "" : $etapas['Etapa']['nome'];

        $this->set('etapa_nome', $etapa_nome);
        $this->set('etapa_id', $this->request->data['etapa_id']);
        $this->set('aviso_id', $aviso_id);
        $this->set('avisos',   $avisos_configurados);
        $this->render( "add" );
    }
    
    public function getAvisos(){
        
        $this->autoRender = false;
        
        $avisos_configurados    = "";
        if( isset( $this->request->data['etapa_id'] ) && !empty( $this->request->data['etapa_id'] ) ){
            $avisos_configurados    = $this->AvisoEtapa->findAllByEtapaId( $this->request->data['etapa_id'] );
        }
        echo json_encode($avisos_configurados);
    }

    public function add(){
        
        $this->autoRender = false;
        
        if ($this->request->is('post')){

            $avisos = $this->AvisoEtapa->find( 'all',

                    array(
                        'conditions' => array('aviso_id' => $this->request->data['AvisoEtapa']['aviso_id'],'etapa_id' => $this->request->data['AvisoEtapa']['etapa_id'] ),
                        'recursive'  => -1,
                    )
            );
            if (count($avisos) > 0) {

                $this->request->data['AvisoEtapa']['id'] = $avisos[0]['AvisoEtapa']['id'];
            }
            $this->AvisoEtapa->save($this->request->data);
            $avisos_configurados = $this->AvisoEtapa->findAllByEtapaId($this->request->data['AvisoEtapa']['etapa_id']);
            echo json_encode($avisos_configurados);
        }
    }

    public function delete($id = null){
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->AvisoEtapa->id = $id;
        $etapa_id = $this->AvisoEtapa->field('etapa_id');
        $this->AvisoEtapa->delete();
        $this->view($etapa_id);
    }
}
