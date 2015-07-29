<?php

/* 
 * by furious
 */

App::uses('AppController', 'Controller');

class AppCombosController extends AppController{
    
     public function makeCombo(){
        
        $this->autoRender = false;
          
        if ( $this->request->is('ajax') ){
            
            $this->layout = null;
            
            $entidade = $this->request->data['entity'];
            
            if( strripos( $entidade, '=>') ){
                
                $modelo      = explode( '=>', $entidade );
                
                $entidade    = $modelo[0];
                $query       = $modelo[1];
                
                $this->loadModel( $entidade );
                $data = $this->$entidade->query( $query );
                
                $object = array();

                if( count( $data ) > 0 ){

                    foreach ( $data as $i => $v ){

                        $object[] = array(

                            'id'    => $v[$entidade]['id'],
                            'value' => $v[$entidade]['nome']
                        );
                    }
                }                
                
            } else {
                
                $this->loadModel( $entidade );
                $data = $this->$entidade->find( 'list' );
                
                $object = array();

                if( count( $data ) > 0 ){

                    asort( $data );

                    foreach ( $data as $i => $v ){

                        $object[] = array(

                            'id'    => $i,
                            'value' => $v
                        );
                    }
                }                
            }
            echo json_encode( $object );
        }
    }
}