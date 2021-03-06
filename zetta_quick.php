<?php

/**
 * Выстрый запуск CMS без плагинов, только Front_Contreoller
 */
ob_start();
require_once 'autoloader.php';

/* Обрабатываем все ошибки включая фатальные */
register_shutdown_function(array(new Zetta_ErrorHandler(), 'error'));

try {
    /* Включаем конфигурационные файлы и стартуем */
    (new Zend_Application(ZETTA_MODE, array('config' => array(
        SYSTEM_PATH . '/Configs/_autoloader.ini',
        SYSTEM_PATH . '/Configs/_log.ini',
        SYSTEM_PATH . '/Configs/_router.ini',
        SYSTEM_PATH . '/Configs/_view.ini',
        SYSTEM_PATH . '/Configs/_di.ini',
        SYSTEM_PATH . '/Configs/_frontcontroller.ini',
        SYSTEM_PATH . '/Configs/application_quick.ini',
    ))))
        ->bootstrap()
        ->run();
} catch (Exception $e) {
}
