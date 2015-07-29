<?php
/**
 * PrazoFixture
 *
 */
class PrazoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'quantidade' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
		'granularidade' => array('type' => 'integer', 'null' => false, 'default' => null),
		'fg_apenas_horario_comercial' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'quantidade' => 1,
			'granularidade' => 1,
			'fg_apenas_horario_comercial' => 1
		),
	);

}
