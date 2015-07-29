<?php
/**
 * MenuFixture
 *
 */
class MenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fg_online' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 1),
		'nr_ordem' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'id_funcaoref' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'fg_todosusuarios' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1),
		'fg_local' => array('type' => 'float', 'null' => true, 'default' => '0', 'length' => 1),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'UK_MODULO_NOME' => array('column' => 'nome', 'unique' => 0),
			'FK_MODU_MODUPAI' => array('column' => 'parent_id', 'unique' => 0)
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
			'nome' => 'Lorem ipsum dolor sit amet',
			'parent_id' => 1,
			'descricao' => 'Lorem ipsum dolor sit amet',
			'url' => 'Lorem ipsum dolor sit amet',
			'fg_online' => 1,
			'nr_ordem' => 1,
			'created' => '2014-06-30 20:18:14',
			'modified' => '2014-06-30 20:18:14',
			'id_funcaoref' => 1,
			'fg_todosusuarios' => 1,
			'fg_local' => 1
		),
	);

}
