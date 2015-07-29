<?php

/* 
 * by furious
 */

App::uses('AppController', 'Controller');

class GenericFiltersController extends AppController{

    public function mountFilter(){
        
        $this->autoRender = false;
        
        if ($this->request->is('ajax')){
         
            $dados = json_decode( $this->request->data['info'], true );
                    
            $this->Session->write( 'filters_grid.'.$this->request->data['action'], $dados );
            
            echo json_encode( $this->Session->read('filters_grid') );
        }
    }
    
    public function getElements(){
        
        $this->autoRender = false;
        $view = new View($this, false);
        
        if ($this->request->is('ajax')) {
            
            $options = json_decode($this->request->data['options'], true);     
            $nome    = $this->request->data['nome'];

            echo json_encode($view->element( $nome, $options ));
        }
    }
}