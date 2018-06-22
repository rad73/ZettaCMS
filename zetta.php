<?php

ob_start();
require_once 'autoloader.php';

/* Обрабатываем все ошибки включая фатальные */
register_shutdown_function(array(new Zetta_ErrorHandler(), 'error'));

try {
    /* Включаем конфигурационные файлы и стартуем */
    (new Zend_Application(ZETTA_MODE, array('config' => array_merge(
        glob(SYSTEM_PATH . '/Configs/_*.ini', GLOB_NOSORT),
        array(
            FILE_PATH . '/Configs/application.ini',
            SYSTEM_PATH . '/Configs/application.ini',
        )
    ))))
        ->bootstrap()
        ->run();
} catch (Exception $e) {
    $response = new Zend_Controller_Response_Http();
    $response->setException($e);

    Zend_Controller_Front::getInstance()
        ->setControllerDirectory(SYSTEM_PATH . '/Modules/Default/App/controllers', 'Default')
        ->addControllerDirectory(SYSTEM_PATH . '/Modules/Default/App/controllers', 'default')
        ->setDefaultControllerName('error')
        ->setDefaultAction('error')
        ->setParam('useDefaultControllerAlways', false)
        ->dispatch(null, $response);
}
