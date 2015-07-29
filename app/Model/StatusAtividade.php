<?php
App::uses('AppModel', 'Model');
/**
 * StatusAtividade Model
 *
 * @property Atividade $Atividade
 */
class StatusAtividade extends AppModel {

    public $displayField = 'nome';
    
    public $hasMany = array(
        'Atividade' => array(
            'className' => 'Atividade',
            'foreignKey' => 'status_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Demanda' => array(
            'className' => 'Demanda',
            'foreignKey' => 'status_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )        
    );
    
    var $validate = array(
        
        'nome' => array(
            'rule' => 'notEmpty',
            'message' => 'Campo não pode ser vazio.'
        )
    );    

}