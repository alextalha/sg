<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', Configure::read('Route.default'));
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect('/logout', array('controller' => 'usuarios', 'action' => 'logout'));
Router::connect('/senha', array('controller' => 'usuarios', 'action' => 'forgotPassword'));
//Router::connect('/usuarios/ativar_senha/*', array('controller' => 'usuarios', 'action' => 'activatePassword'));
//Router::connect('/usuarios/alterar_senha', array('controller' => 'usuarios', 'action' => 'changePassword'));
//Router::connect('/usuarios/alterar_senha_usuario/*', array('controller' => 'usuarios', 'action' => 'changeUsuarioPassword'));
Router::connect('/usuarios/add', array('controller' => 'usuarios', 'action' => 'add'));
Router::connect('/usuarios/edit/*', array('controller' => 'usuarios', 'action' => 'edit'));
Router::connect('/usuarios/delete/*', array('controller' => 'usuarios', 'action' => 'delete'));
Router::connect('/usuarios/view/*', array('controller' => 'usuarios', 'action' => 'view'));
Router::connect('/usuarios/verificar/*', array('controller' => 'usuarios', 'action' => 'userVerification'));
Router::connect('/usuarios/ativar/*', array('controller' => 'usuarios', 'action' => 'ativar'));
Router::connect('/usuarios/desativar/*', array('controller' => 'usuarios', 'action' => 'desativar'));
Router::connect('/usuarios', array('controller' => 'usuarios', 'action' => 'index'));
//Router::connect('/permissoes', array('controller' => 'user_group_permissions', 'action' => 'index'));
//Router::connect('/permissoes_grupo', array('controller' => 'user_group_permissions', 'action' => 'index_usergroup'));
//Router::connect('/permissoes/update', array('controller' => 'user_group_permissions', 'action' => 'update'));
//Router::connect('/permissoes/update_group', array('controller' => 'user_group_permissions', 'action' => 'update_group'));
Router::connect('/acesso_negado', array('controller' => 'usuarios', 'action' => 'acesso_negado'));
Router::connect('/perfil', array('controller' => 'usuarios', 'action' => 'myprofile'));
Router::connect('/email', array('controller' => 'usuarios', 'action' => 'emailVerification'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	
        //Router::parseExtensions('pdf');
        
        
/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';