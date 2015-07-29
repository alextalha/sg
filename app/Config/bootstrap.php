<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

Configure::write('NOME_PROJETO','triadsag');

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

Inflector::rules('singular', array('irregular' => array('avisos_etapas' => 'aviso_etapa')));
Inflector::rules('singular', array('irregular' => array('avisosetapas' => 'avisoEtapa')));
Inflector::rules('plural', array('irregular' => array('avisoetapa' => 'avisosEtapas')));
Inflector::rules('plural', array('irregular' => array('aviso_etapa' => 'avisos_etapas')));

Inflector::rules('singular', array('irregular' => array('arquivos_atividades' => 'arquivo_atividade')));
Inflector::rules('singular', array('irregular' => array('arquivosatividades' => 'arquivoEtapa')));
Inflector::rules('plural', array('irregular' => array('arquivoatividade' => 'arquivosEtapas')));
Inflector::rules('plural', array('irregular' => array('arquivo_atividade' => 'arquivos_atividades')));

Inflector::rules('singular', array('irregular' => array('arquivos_demandas' => 'arquivo_demanda')));
Inflector::rules('singular', array('irregular' => array('arquivosdemandas' => 'arquivoEtapa')));
Inflector::rules('plural', array('irregular' => array('arquivodemanda' => 'arquivosEtapas')));
Inflector::rules('plural', array('irregular' => array('arquivo_demanda' => 'arquivos_demandas')));


/*
// include the Session Component to our application
App::uses('SessionComponent', 'Controller/Component');
 
// now create new SessionComponent instance
$Session = new SessionComponent(new ComponentCollection());
 
// check if the user logged in
if ($Session->read('UserAuth.User')) {
            Configure::write('Route.default', array('controller' => 'pages', 'action' => 'display','home'));
}
// nope, user not logged in
else {
    Configure::write('Route.default', array('controller' => 'usuarios', 'action' => 'login'));
}
*/
Configure::write('Route.default', array('controller' => 'pages', 'action' => 'display','home'));

function UsuariomgmtInIt(&$controller) {
	/*
		setting default time zone for your site
	*/
	date_default_timezone_set ("America/Sao_Paulo");


	App::import('Helper', 'Html');
	$html = new HtmlHelper(new View(null));

	/*
		setting site url
		do not edit it
		if you want to edit then for example
		define("SITE_URL", "http://example.com/");
	*/
	if(!defined("SITE_URL")) {
		define("SITE_URL", $html->url('/', true));
	}


	/*
		set true if new registrations are allowed
	*/
	if(!defined("SITE_REGISTRATION")) {
		define("SITE_REGISTRATION", false);
	}

	/*
		set true if you want send registration mail to user
	*/
	if(!defined("SEND_REGISTRATION_MAIL")) {
		define("SEND_REGISTRATION_MAIL", true);
	}

	/*
		set true if you want verify user's email id, site will send email confirmation link to user's email id
		sett false you do not want verify user's email id, in this case user becomes active after registration with out email verification
	*/
	if(!defined("EMAIL_VERIFICATION")) {
		define("EMAIL_VERIFICATION", false);
	}


	/*
		set email address for sending emails
	*/
	if(!defined("EMAIL_FROM_ADDRESS")) {
		define("EMAIL_FROM_ADDRESS", 'suporte.triad.bpo@gmail.com');
	}

	/*
		set site name for sending emails
	*/
	if(!defined("EMAIL_FROM_NAME")) {
		define("EMAIL_FROM_NAME", 'BPO TRIAD');
	}

	/*
		set login redirect url, it means when user gets logged in then site will redirect to this url.
	*/
	if(!defined("LOGIN_REDIRECT_URL")) {
		define("LOGIN_REDIRECT_URL", '/');
	}

	/*
		set logout redirect url, it means when user gets logged out then site will redirect to this url.
	*/
	if(!defined("LOGOUT_REDIRECT_URL")) {
		define("LOGOUT_REDIRECT_URL", '/');
	}

	/*
		set true if you want to enable permissions on your site
	*/
	if(!defined("PERMISSIONS")) {
		define("PERMISSIONS", true);
	}

	/*
		set true if you want to check permissions for admin also
	*/
	if(!defined("ADMIN_PERMISSIONS")) {
		define("ADMIN_PERMISSIONS", false);
	}

	/*
		set default group id here for registration
	*/
	if(!defined("DEFAULT_GROUP_ID")) {
		define("DEFAULT_GROUP_ID", 2);
	}

	/*
		set Admin group id here
	*/
	if(!defined("ADMIN_GROUP_ID")) {
		define("ADMIN_GROUP_ID", 1);
	}

	/*
		set Guest group id here
	*/
	if(!defined("GUEST_GROUP_ID")) {
		define("GUEST_GROUP_ID", null);
	}
	/*
		set true if you want captcha support on register form
	*/
	if(!defined("USE_RECAPTCHA")) {
		define("USE_RECAPTCHA", false);
	}
	/*
		set Admin group id here
	*/
	if(!defined("PRIVATE_KEY_FROM_RECAPTCHA")) {
		define("PRIVATE_KEY_FROM_RECAPTCHA", '');
	}
	/*
		set Admin group id here
	*/
	if(!defined("PUBLIC_KEY_FROM_RECAPTCHA")) {
		define("PUBLIC_KEY_FROM_RECAPTCHA", '');
	}
	/*
		set login cookie name
	*/
	if(!defined("LOGIN_COOKIE_NAME")) {
		define("LOGIN_COOKIE_NAME", 'UsuariomgmtCookie');
	}
	Cache::config('UsuarioMgmt', array(
		'engine' => 'File',
		'duration'=> '+3 months',
		'path' => CACHE,
		'prefix' => 'UsuarioMgmt_'
	));
}

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');

CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

Configure::write('Config.language', 'pt-br');

CakePlugin::load('DebugKit');
CakePlugin::load('TwitterBootstrap');


require APP . '/Vendor/autoload.php';





