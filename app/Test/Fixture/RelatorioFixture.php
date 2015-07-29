<?php
/**
 * RelatorioFixture
 *
 */
class RelatorioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 254, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tx_diretorio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tx_regra_nome' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fg_carga_dias' => array('type' => 'string', 'null' => false, 'default' => '1', 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'UK_RELATORIO_NOME' => array('column' => 'nome', 'unique' => 0)
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
			'descricao' => 'Lorem ipsum dolor sit amet',
			'tx_diretorio' => 'Lorem ipsum dolor sit amet',
			'tx_regra_nome' => 'Lorem ipsum dolor sit amet',
			'fg_carga_dias' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-06-30 20:18:45',
			'modified' => '2014-06-30 20:18:45'
		),
	);

}
