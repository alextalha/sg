<?php
/**
 * AtividadeFixture
 *
 */
class AtividadeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'demanda_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'data_cancelamento' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'motivo_cancelamento' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'data_conclusao' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'percentual_conclusao' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '8,4'),
		'nr_prioridade' => array('type' => 'integer', 'null' => false, 'default' => '99999'),
		'data_inicio' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'data_prevista_termino' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'fg_milestone' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'descricao_conclusao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_TARE_USUA' => array('column' => 'usuario_id', 'unique' => 0),
			'FK_TARE_PROJ' => array('column' => 'demanda_id', 'unique' => 0),
			'FK_TARE_TARE_PAI' => array('column' => 'parent_id', 'unique' => 0)
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
			'demanda_id' => 1,
			'usuario_id' => 1,
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'descricao' => 'Lorem ipsum dolor sit amet',
			'data_cancelamento' => '2014-06-30 20:33:20',
			'motivo_cancelamento' => 'Lorem ipsum dolor sit amet',
			'data_conclusao' => '2014-06-30 20:33:20',
			'percentual_conclusao' => 1,
			'nr_prioridade' => 1,
			'data_inicio' => '2014-06-30 20:33:20',
			'data_prevista_termino' => '2014-06-30 20:33:20',
			'fg_milestone' => 1,
			'created' => '2014-06-30 20:33:20',
			'modified' => '2014-06-30 20:33:20',
			'descricao_conclusao' => 'Lorem ipsum dolor sit amet'
		),
	);

}
