<?php
App::uses('GruposController', 'Controller');

/**
 * GruposController Test Case
 *
 */
class GruposControllerTest extends ControllerTestCase {

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
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}