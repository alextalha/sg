<?php

//App::uses('Cargo', 'Model');

/**
 * Cargo Test Case
 *
 */
class CargoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cargo',
		'app.usuario',
		'app.login_token',
		'app.atividade',
		'app.demanda',
		'app.processo',
		'app.grupo',
		'app.permission',
		'app.etapa',
		'app.aviso_etapa',
		'app.aviso',
		'app.grupos_usuario',
		'app.status_atividade',
		'app.demandas_usuario',
		'app.arquivo',
		'app.categoria_arquivo',
		'app.arquivo_demanda',
		'app.atividades_usuario',
		'app.parametro'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cargo = ClassRegistry::init('Cargo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cargo);

		parent::tearDown();
	}

}
