<?php
App::uses('Grupo', 'Model');

/**
 * Grupo Test Case
 *
 */
class GrupoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.grupo',
		'app.demanda',
		'app.user_group',
		'app.user_group_permission',
		'app.user',
		'app.login_token',
		'app.atividade',
		'app.atividades_usuario',
		'app.etapa',
		'app.arquivo',
		'app.categoria_arquivo',
		'app.arquivos_demanda',
		'app.arquivos_atividade',
		'app.demandas_usuario',
		'app.grupos_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Grupo = ClassRegistry::init('Grupo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Grupo);

		parent::tearDown();
	}

}
