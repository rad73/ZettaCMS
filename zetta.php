<?php

ob_start();
require_once 'const.php';

/* Обрабатываем все ошибки включая фатальные */
require_once 'Zetta/ErrorHandler.php';
register_shutdown_function(array(new Zetta_ErrorHandler(), 'error'));

require_once 'Zend/Loader/Autoloader.php';
require_once 'Zend/Application.php';
require_once 'Zend/Config/Ini.php';

/* Включаем конфигурационные файлы */
$application = new Zend_Application(ZETTA_MODE, array('config' => array_merge(
	glob(SYSTEM_PATH . '/Configs/_*.ini', GLOB_NOSORT),
	array(
		FILE_PATH . '/Configs/application.ini',
		SYSTEM_PATH . '/Configs/application.ini',
	)
)));

try {
	
	$application
		->bootstrap()
		->run();
		
}
catch (Exception $e) {

	$response = new Zend_Controller_Response_Http();
	$response->setException($e);

	Zend_Controller_Front::getInstance()
		->setControllerDirectory(SYSTEM_PATH . '/Modules/Default/App/controllers', 'Default')
		->addControllerDirectory(SYSTEM_PATH . '/Modules/Default/App/controllers', 'default')	// @todo this
		->setDefaultControllerName('error')
		->setDefaultAction('error')
		->setParam('useDefaultControllerAlways', false)
		->dispatch(null, $response);

}