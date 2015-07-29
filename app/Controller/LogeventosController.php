<?php

/* 
 * by Furious
 */
App::uses('AppController', 'Controller');

class LogeventosController extends AppController{
    
    
    private function checaSeUsuarioLogadoTemAcesso($action, $id="") {
        $path = "Logeventos/".$action.($id!=""?"/".$id:"");
        if(!$this->checkAccess($path)){
        // if (!$this->UserAuth->isAdmin() && !$this->Pivot->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $pivot_id, $action)) {
            $this->alert("Sorry, You don't have permission to view that page.", 'error');
            $this->redirect('index');
        }
    }
    
   
    public function index( $type = null){
      
 
        $this->checaSeUsuarioLogadoTemAcesso('index');
        
        $parametros = (isset( $this->Session->read('filters_grid')['logeventos'] ))?$this->Session->read('filters_grid')['logeventos']:"";
        $rs  = $this->getParamsUrl( $parametros );

        $opt = array(
            
            'conditions' => ( !$rs ) ? array( 'Logevento.id > ' => 0 ) : $rs,
            'limit'      =>  $this->getParametros()->getParametro('paginator')
        );        
        
       $this->paginate = $opt;
        
        $fields = json_encode( $parametros );
        
        //$this->Parametro->recursive = 0;
        $logs = $this->Paginator->paginate( 'Logevento' );
        $this->set( 'logs', $logs );
        $this->set( 'fields', $fields );
        
    }
}