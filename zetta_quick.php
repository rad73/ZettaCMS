<?php

/**
 * Выстрый запуск CMS без плагинов, только Front_Contreoller
 */
ob_start();
require_once 'const.php';

/* Обрабатываем все ошибки включая фатальные */
require_once 'Zetta/ErrorHandler.php';
register_shutdown_function(array(new Zetta_ErrorHandler(), 'error'));

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

/* Включаем конфигурационные файлы */
$application = new Zend_Application(ZETTA_MODE, array('config' => array(
	SYSTEM_PATH . '/Configs/_autoloader.ini',
	SYSTEM_PATH . '/Configs/_log.ini',
	SYSTEM_PATH . '/Configs/_router.ini',
	SYSTEM_PATH . '/Configs/_frontcontroller.ini',
	SYSTEM_PATH . '/Configs/application_quick.ini',
)));

$application
	->bootstrap()
	->run();
