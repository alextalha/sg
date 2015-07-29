<?php
//App::uses('CategoriaArquivo', 'Model');

/**
 * CategoriaArquivo Test Case
 *
 */
class CategoriaArquivoTest extends PHPUnit_Extensions_Selenium2TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	//public $fixtures = array(
//		'app.categoria_arquivo',
//		'app.arquivo',
//		'app.usuario',
//		'app.cargo',
//		'app.login_token',
//		'app.atividade',
//		'app.demanda',
//		'app.processo',
//		'app.grupo',
//		'app.permission',
//		'app.pivot',
//		'app.grupos_usuario',
//		'app.etapa',
//		'app.aviso_etapa',
//		'app.aviso',
//		'app.demandas_usuario',
//		'app.arquivo_demanda',
//		'app.atividades_usuario'
//	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CategoriaArquivo = ClassRegistry::init('CategoriaArquivo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CategoriaArquivo);

		parent::tearDown();
	}

}
