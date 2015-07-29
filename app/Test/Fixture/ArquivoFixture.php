<?php
/**
 * ArquivoFixture
 *
 */
class ArquivoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'categoria_arquivo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'tx_contenttype' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tx_extensao' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tx_tag' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_ARQU_CAAR' => array('column' => 'categoria_arquivo_id', 'unique' => 0),
			'FK_ARQU_USUA' => array('column' => 'usuario_id', 'unique' => 0)
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
			'categoria_arquivo_id' => 1,
			'usuario_id' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'descricao' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-06-30 20:15:00',
			'modified' => '2014-06-30 20:15:00',
			'tx_contenttype' => 'Lorem ipsum dolor sit amet',
			'tx_extensao' => 'Lorem ipsum dolor sit amet',
			'tx_tag' => 'Lorem ipsum dolor sit amet'
		),
	);

}
