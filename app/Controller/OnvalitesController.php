<?php

/* 
 * by furious
 */

App::uses('AppController', 'Controller');

class OnvalitesController extends AppController {

    public function getValidate(){
        
        $this->autoRender = false;
        if( empty( $this->request->data ) || count( $this->request->data ) === 0 ){return false;}
                
        $model = "";
        $cont  = 0;
        foreach ( $this->request->data as $i => $v ){
            
            if( $cont === 0 ){ $model = $i; }
            $cont++;
        }        
        if( empty( $model ) ){ return false; }
        
        $this->loadModel( $model );
        $this->$model->set( $this->request->data[ $model ] );

        
        if ($this->$model->validates()) {
            
            echo json_encode('0');
            
        } else {
            
            $errors = $this->$model->validationErrors;
            echo json_encode( $errors );
        }
    }
}
