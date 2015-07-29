<?php
App::uses('Niveis', 'Model');

/**
 * Nivei Test Case
 *
 */
class NiveiTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nivei',
		'app.funcao',
		'app.menu',
		'app.funcao_nivei'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nivei = ClassRegistry::init('Niveis');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nivei);

		parent::tearDown();
	}

}
