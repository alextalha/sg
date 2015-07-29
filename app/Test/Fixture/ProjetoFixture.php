<?php
/**
 * DemandaFixture
 *
 */
class DemandaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'grupo_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'data_inicio' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'data_conclusao' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'data_cancelamento' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'motivo_cancelamento' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao_conclusao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fg_template' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_PROJ_USUA' => array('column' => 'usuario_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'grupo_id' => 1,
			'usuario_id' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'descricao' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-06-30 20:13:24',
			'modified' => '2014-06-30 20:13:24',
			'data_inicio' => '2014-06-30 20:13:24',
			'data_conclusao' => '2014-06-30 20:13:24',
			'data_cancelamento' => '2014-06-30 20:13:24',
			'motivo_cancelamento' => 'Lorem ipsum dolor sit amet',
			'descricao_conclusao' => 'Lorem ipsum dolor sit amet',
			'fg_template' => 1
		),
	);

}
