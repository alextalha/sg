<?php
/**
 * EtapaFixture
 *
 */
class EtapaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'atividade_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'descricao' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 2000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'data_inicio' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'data_prevista_termino' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'nr_perc_avanco' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '8,4'),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'FK_ETAP_TARE' => array('column' => 'atividade_id', 'unique' => 0)
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
			'atividade_id' => 1,
			'descricao' => 'Lorem ipsum dolor sit amet',
			'data_inicio' => '2014-06-30 20:16:41',
			'data_prevista_termino' => '2014-06-30 20:16:41',
			'created' => '2014-06-30 20:16:41',
			'modified' => '2014-06-30 20:16:41',
			'nr_perc_avanco' => 1,
			'usuario_id' => 1
		),
	);

}
