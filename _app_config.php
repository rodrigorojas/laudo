<?php
/**
 * @package LAUDO
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Digitador
	'GET:digitadores' => array('route' => 'Digitador.ListView'),
	'GET:digitador/(:any)' => array('route' => 'Digitador.SingleView', 'params' => array('cdDigitador' => 1)),
	'GET:api/digitadores' => array('route' => 'Digitador.Query'),
	'POST:api/digitador' => array('route' => 'Digitador.Create'),
	'GET:api/digitador/(:any)' => array('route' => 'Digitador.Read', 'params' => array('cdDigitador' => 2)),
	'PUT:api/digitador/(:any)' => array('route' => 'Digitador.Update', 'params' => array('cdDigitador' => 2)),
	'DELETE:api/digitador/(:any)' => array('route' => 'Digitador.Delete', 'params' => array('cdDigitador' => 2)),
		
	// Exame
	'GET:exames' => array('route' => 'Exame.ListView'),
	'GET:exame/(:num)' => array('route' => 'Exame.SingleView', 'params' => array('cdExame' => 1)),
	'GET:api/exames' => array('route' => 'Exame.Query'),
	'POST:api/exame' => array('route' => 'Exame.Create'),
	'GET:api/exame/(:num)' => array('route' => 'Exame.Read', 'params' => array('cdExame' => 2)),
	'PUT:api/exame/(:num)' => array('route' => 'Exame.Update', 'params' => array('cdExame' => 2)),
	'DELETE:api/exame/(:num)' => array('route' => 'Exame.Delete', 'params' => array('cdExame' => 2)),
		
	// Laudo
	'GET:laudos' => array('route' => 'Laudo.ListView'),
	'GET:laudo/(:num)' => array('route' => 'Laudo.SingleView', 'params' => array('cdLaudo' => 1)),
	'GET:api/laudos' => array('route' => 'Laudo.Query'),
	'POST:api/laudo' => array('route' => 'Laudo.Create'),
	'GET:api/laudo/(:num)' => array('route' => 'Laudo.Read', 'params' => array('cdLaudo' => 2)),
	'PUT:api/laudo/(:num)' => array('route' => 'Laudo.Update', 'params' => array('cdLaudo' => 2)),
	'DELETE:api/laudo/(:num)' => array('route' => 'Laudo.Delete', 'params' => array('cdLaudo' => 2)),
		
	// Medico
	'GET:medicos' => array('route' => 'Medico.ListView'),
	'GET:medico/(:num)' => array('route' => 'Medico.SingleView', 'params' => array('cdMedico' => 1)),
	'GET:api/medicos' => array('route' => 'Medico.Query'),
	'POST:api/medico' => array('route' => 'Medico.Create'),
	'GET:api/medico/(:num)' => array('route' => 'Medico.Read', 'params' => array('cdMedico' => 2)),
	'PUT:api/medico/(:num)' => array('route' => 'Medico.Update', 'params' => array('cdMedico' => 2)),
	'DELETE:api/medico/(:num)' => array('route' => 'Medico.Delete', 'params' => array('cdMedico' => 2)),
		
	// Modalidade
	'GET:modalidades' => array('route' => 'Modalidade.ListView'),
	'GET:modalidade/(:num)' => array('route' => 'Modalidade.SingleView', 'params' => array('cdModalidade' => 1)),
	'GET:api/modalidades' => array('route' => 'Modalidade.Query'),
	'POST:api/modalidade' => array('route' => 'Modalidade.Create'),
	'GET:api/modalidade/(:num)' => array('route' => 'Modalidade.Read', 'params' => array('cdModalidade' => 2)),
	'PUT:api/modalidade/(:num)' => array('route' => 'Modalidade.Update', 'params' => array('cdModalidade' => 2)),
	'DELETE:api/modalidade/(:num)' => array('route' => 'Modalidade.Delete', 'params' => array('cdModalidade' => 2)),
		
	// Paciente
	'GET:pacientes' => array('route' => 'Paciente.ListView'),
	'GET:paciente/(:num)' => array('route' => 'Paciente.SingleView', 'params' => array('cdPaciente' => 1)),
	'GET:api/pacientes' => array('route' => 'Paciente.Query'),
	'POST:api/paciente' => array('route' => 'Paciente.Create'),
	'GET:api/paciente/(:num)' => array('route' => 'Paciente.Read', 'params' => array('cdPaciente' => 2)),
	'PUT:api/paciente/(:num)' => array('route' => 'Paciente.Update', 'params' => array('cdPaciente' => 2)),
	'DELETE:api/paciente/(:num)' => array('route' => 'Paciente.Delete', 'params' => array('cdPaciente' => 2)),
		
	// Procedimento
	'GET:procedimentos' => array('route' => 'Procedimento.ListView'),
	'GET:procedimento/(:num)' => array('route' => 'Procedimento.SingleView', 'params' => array('cdProcedimento' => 1)),
	'GET:api/procedimentos' => array('route' => 'Procedimento.Query'),
	'POST:api/procedimento' => array('route' => 'Procedimento.Create'),
	'GET:api/procedimento/(:num)' => array('route' => 'Procedimento.Read', 'params' => array('cdProcedimento' => 2)),
	'PUT:api/procedimento/(:num)' => array('route' => 'Procedimento.Update', 'params' => array('cdProcedimento' => 2)),
	'DELETE:api/procedimento/(:num)' => array('route' => 'Procedimento.Delete', 'params' => array('cdProcedimento' => 2)),
		
	// Role
	'GET:roles' => array('route' => 'Role.ListView'),
	'GET:role/(:num)' => array('route' => 'Role.SingleView', 'params' => array('id' => 1)),
	'GET:api/roles' => array('route' => 'Role.Query'),
	'POST:api/role' => array('route' => 'Role.Create'),
	'GET:api/role/(:num)' => array('route' => 'Role.Read', 'params' => array('id' => 2)),
	'PUT:api/role/(:num)' => array('route' => 'Role.Update', 'params' => array('id' => 2)),
	'DELETE:api/role/(:num)' => array('route' => 'Role.Delete', 'params' => array('id' => 2)),
		
	// SituacaoExame
	'GET:situacaoexames' => array('route' => 'SituacaoExame.ListView'),
	'GET:situacaoexame/(:num)' => array('route' => 'SituacaoExame.SingleView', 'params' => array('cdSituacaoExame' => 1)),
	'GET:api/situacaoexames' => array('route' => 'SituacaoExame.Query'),
	'POST:api/situacaoexame' => array('route' => 'SituacaoExame.Create'),
	'GET:api/situacaoexame/(:num)' => array('route' => 'SituacaoExame.Read', 'params' => array('cdSituacaoExame' => 2)),
	'PUT:api/situacaoexame/(:num)' => array('route' => 'SituacaoExame.Update', 'params' => array('cdSituacaoExame' => 2)),
	'DELETE:api/situacaoexame/(:num)' => array('route' => 'SituacaoExame.Delete', 'params' => array('cdSituacaoExame' => 2)),
		
	// SituacaoLaudo
	'GET:situacaolaudos' => array('route' => 'SituacaoLaudo.ListView'),
	'GET:situacaolaudo/(:num)' => array('route' => 'SituacaoLaudo.SingleView', 'params' => array('cdSituacaoLaudo' => 1)),
	'GET:api/situacaolaudos' => array('route' => 'SituacaoLaudo.Query'),
	'POST:api/situacaolaudo' => array('route' => 'SituacaoLaudo.Create'),
	'GET:api/situacaolaudo/(:num)' => array('route' => 'SituacaoLaudo.Read', 'params' => array('cdSituacaoLaudo' => 2)),
	'PUT:api/situacaolaudo/(:num)' => array('route' => 'SituacaoLaudo.Update', 'params' => array('cdSituacaoLaudo' => 2)),
	'DELETE:api/situacaolaudo/(:num)' => array('route' => 'SituacaoLaudo.Delete', 'params' => array('cdSituacaoLaudo' => 2)),
		
	// User
	'GET:users' => array('route' => 'User.ListView'),
	'GET:user/(:num)' => array('route' => 'User.SingleView', 'params' => array('id' => 1)),
	'GET:api/users' => array('route' => 'User.Query'),
	'POST:api/user' => array('route' => 'User.Create'),
	'GET:api/user/(:num)' => array('route' => 'User.Read', 'params' => array('id' => 2)),
	'PUT:api/user/(:num)' => array('route' => 'User.Update', 'params' => array('id' => 2)),
	'DELETE:api/user/(:num)' => array('route' => 'User.Delete', 'params' => array('id' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_laudo_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_medico_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_medico_solicitante_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_modalidade_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_paciente_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_procedimento_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Exame","fk_situacao_exame",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Laudo","fk_digitador_laudo",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Laudo","fk_situacao_laudo",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("User","u_role",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>