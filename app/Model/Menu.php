<?php
App::uses('AppModel', 'Model');

class Menu extends AppModel {

	public $displayField = 'nome';

	public $belongsTo = array('ParentMenu' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id'
		)
	);

	public $hasMany = array('ChildMenu' => array(
			'className' => 'Menu',
			'foreignKey' => 'parent_id',
			'dependent' => false
		)
	);

        var $validate = array(
            'nome' => array(
                'rule' => 'notEmpty',
                'message' => 'Este campo não pode ser deixado em branco'
            ),
            'url' => array(
                'rule' => 'notEmpty',
                'message' => 'Este campo não pode ser deixado em branco'
            )            
        );        
}
