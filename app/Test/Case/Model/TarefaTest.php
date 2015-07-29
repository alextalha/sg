<?php
App::uses('Atividade', 'Model');

/**
 * Atividade Test Case
 *
 */
class AtividadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.atividade',
		'app.demanda',
		'app.grupo',
		'app.usuario',
		'app.demandas_usuario',
		'app.arquivo',
		'app.categoria_arquivo',
		'app.arquivos_demanda',
		'app.arquivos_atividade',
		'app.atividades_usuario',
		'app.etapa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Atividade = ClassRegistry::init('Atividade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Atividade);

		parent::tearDown();
	}

}
