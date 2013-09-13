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
	
	if (false == defined('HTTP_HOST')) {	
		
		// вероятнее всего произошел запуск из консоли
		// php zetta.php --host=asdf.by --url=/login
		
		$arrayInput = getopt(false, array('url:', 'host:'));
		if (array_key_exists('host', $arrayInput)) {
			define('HTTP_HOST', 'http://' . $arrayInput['host']);
			$_SERVER['HTTP_HOST'] = HTTP_HOST;
		}
		if (array_key_exists('url', $arrayInput)) {
			$_SERVER['REQUEST_URI'] = $arrayInput['url'];
		}
		
	}
	
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