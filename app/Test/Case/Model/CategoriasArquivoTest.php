<?php
App::uses('CategoriasArquivo', 'Model');

/**
 * CategoriasArquivo Test Case
 *
 */
class CategoriasArquivoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categorias_arquivo',
		'app.arquivo',
		'app.usuario',
		'app.categoria_arquivo',
		'app.demanda',
		'app.grupo',
		'app.demandas_usuario',
		'app.atividade',
		'app.usuario_responsavel',
		'app.etapa',
		'app.arquivos_atividade',
		'app.atividades_usuario',
		'app.arquivos_demanda'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CategoriasArquivo = ClassRegistry::init('CategoriasArquivo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CategoriasArquivo);

		parent::tearDown();
	}

}
