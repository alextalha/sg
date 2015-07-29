<?php
App::uses('Demanda', 'Model');

/**
 * Demanda Test Case
 *
 */
class DemandaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.demanda',
		'app.grupo',
		'app.usuario',
		'app.demandas_usuario',
		'app.atividade',
		'app.arquivo',
		'app.arquivos_demanda'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Demanda = ClassRegistry::init('Demanda');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Demanda);

		parent::tearDown();
	}

}
