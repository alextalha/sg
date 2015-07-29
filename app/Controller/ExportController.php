<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class ExportController extends AppController {
    
    
    
    
    public function beforeRender() {
        
        parent::beforeRender();
        
        $this->layout = false;
        
    }
    
        public $uses = array(
            'Pivot',
            'CategoriaArquivo',
            'Grupo',
            'Relatorio',
            'Cargo',
            'Logevento',
            'Demanda',
            'Processo'
            
            );


   public function getDados($model){
  
       $model = ucfirst($model);
       
       $data = $this->$model->find('all');
 
       $this->set('data',$data);
       
       $this->set('model',$model);

       
   
   }
   
   
   
   
   public function download() {
    $this->viewClass = 'Media';
    // Render app/webroot/files/example.docx
    $params = array(
        'id'        => 'example.docx',
        'name'      => 'example',
        'extension' => 'docx',
        'mimeType'  => array(
            'docx' => 'application/vnd.openxmlformats-officedocument' .
                '.wordprocessingml.document'
        ),
        'path'      => 'files' . DS
    );
    $this->set($params);
    
    
   }
   
}