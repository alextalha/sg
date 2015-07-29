<?php
App::uses('Granularidade', 'Model');

/**
 * Granularidade Test Case
 *
 */
class GranularidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.granularidade',
		'app.prazo',
		'app.etapa',
		'app.processo',
		'app.grupo',
		'app.demanda',
		'app.user',
		'app.user_group',
		'app.user_group_permission',
		'app.nivel',
		'app.funcao',
		'app.menu',
		'app.niveis',
		'app.funcoes_nivei',
		'app.cargo',
		'app.login_token',
		'app.grupos_usuario',
		'app.atividade',
		'app.atividades_usuario',
		'app.arquivo',
		'app.categoria_arquivo',
		'app.arquivos_demanda',
		'app.arquivos_atividade',
		'app.demandas_usuario',
		'app.aviso',
		'app.avisos_etapa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Granularidade = ClassRegistry::init('Granularidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Granularidade);

		parent::tearDown();
	}

}
