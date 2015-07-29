<?php
App::uses('Relatorio', 'Model');

/**
 * Relatorio Test Case
 *
 */
class RelatorioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.relatorio',
		'app.tabela',
		'app.relatorios_tabela'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Relatorio = ClassRegistry::init('Relatorio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Relatorio);

		parent::tearDown();
	}

}
