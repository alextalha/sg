<?php

/*
 * by furious
 */

class BreadcrumbSistemaController extends AppController {

    public $components = array('RequestHandler');
    
    public function delete() {

        $this->autoRender = false;
        if ( $this->request->is('post') || $this->request->is('put') ){

            if( $this->Session->delete('crumb.'.$this->request->data['action']) ){
                
                $this->Session->delete('filters_grid.'.$this->request->data['action']);
                
                echo json_encode( 'true' );
            } else {
                echo json_encode( 'false' );
            }
        }
    }

    public function close(){
        
        $this->autoRender = false;
        
        if ( $this->request->is('post') || $this->request->is('put') ){
            
            $link = $this->Session->read('crumb');

            if( count($link) > 0 ){
                
                $dados  = end( $link );
                $key    = key( $link );
                
                $dados = ( isset( $dados ) && !empty( $dados ) ) ? implode("/", $dados) : '';
                
                echo json_encode( '/'.Configure::read("NOME_PROJETO").'/' . $key . "/" .$dados );
                        
            } else {
                
                echo json_encode( '/'.Configure::read("NOME_PROJETO").'/' );
            }
        }
    }
}
          
    
