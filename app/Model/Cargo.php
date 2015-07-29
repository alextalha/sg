<?php
App::uses('AppModel', 'Model');
/**
 * Cargo Model
 *
 * @property Usuario $Usuario
 */
class Cargo extends AppModel{

/**
 * Validation rules
 *
 * @var array
 */
    
      public $displayField = 'nome';
      
	public $validate = array(
		'nome' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Este campo não pode ser deixado vazio'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'cargo_id',
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

}
