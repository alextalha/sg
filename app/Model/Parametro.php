<?php
App::uses('AppModel', 'Model');
/**
 * Parametro Model
 *
 * @property Usuario $Usuario
 */
class Parametro extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
        public $displayField = 'nome';
        
        /**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
	public $validate = array(
		'param_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				 'message' => 'Este campo não pode ser deixado em branco'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'usuario_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                ),    
                'param_value' => array(
                        'rule' => 'notEmpty',
                        'message' => 'Este campo não pode ser deixado em branco'
                ),
                'param_descricao' => array(
                        'rule' => 'notEmpty',
                        'message' => 'Este campo não pode ser deixado em branco'
                )            
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed


        
          public function getParametro($param_nome) {

        $result = $this->find('all', array(
            'fields' => array('param_value'),
            'conditions' => array('param_name' => $param_nome)
                )
        );
        
        if (count($result) > 0) {

            return $result[0]['Parametro']['param_value'];
        } else {
            return null;
        }
    }

}
