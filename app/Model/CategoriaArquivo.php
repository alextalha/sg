<?php
App::uses('AppModel', 'Model');
/**
 * CategoriaArquivo Model
 *
 * @property Arquivo $Arquivo
 */
class CategoriaArquivo extends AppModel {

    public $displayField = 'nome';
    
    public $hasMany = array(
        'Arquivo' => array(
            'className' => 'Arquivo',
            'foreignKey' => 'categoria_arquivo_id',
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
