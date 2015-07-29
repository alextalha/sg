<?php

/*
 * by Furious
 */

App::uses('AppModel', 'Model');

class Logevento extends AppModel {

    var $belongsTo = array('Usuario');

    public function createLog( $userid, $entity, $action, $incident, $entidade_id ){

        parent::create( array(
            
            'usuario_id'    => $userid,
            'tx_entidade'   => $entity,
            'tx_evento'     => $action,
            'tx_ocorrencia' => $incident,
            'entidade_id'   => $entidade_id
        ));
        
        parent::save();
    }
    
    public function makeStringEdit( $dados ){
        
        if( !is_array( $dados ) ){ return false; }

        $string = "";
        
        if( count( $dados ) > 0 ){
            
            foreach ( $dados as $i => $v ){
                
                $string .= "[".$i.": ".$v."] ";
            }
        }
        
        return $string;
    }      
}
