<?php

/**
 * Определяем глобальные константы
 *
 */
defined('DS')			|| define('DS', DIRECTORY_SEPARATOR);
defined('ZETTA_MODE')	|| define('ZETTA_MODE', (getenv('ZETTA_MODE') ? getenv('ZETTA_MODE') : 'production'));

defined('SYSTEM_PATH')	|| define('SYSTEM_PATH', realpath(dirname(__FILE__) . '/../zetta'));
defined('LIBRARY_PATH')	|| define('LIBRARY_PATH', SYSTEM_PATH . '/Library');
defined('ZETTA_FRAMEWORK_PATH')	|| define('ZETTA_FRAMEWORK_PATH', realpath(SYSTEM_PATH . '/Zetta'));
defined('FILE_PATH')	|| define('FILE_PATH', realpath(dirname(__FILE__)));
defined('TEMP_PATH')	|| define('TEMP_PATH', FILE_PATH . '/Temp');
defined('MODULES_PATH')	|| define('MODULES_PATH', SYSTEM_PATH . '/Modules');
defined('HEAP_PATH')	|| define('HEAP_PATH', FILE_PATH . '/Heap');
defined('USER_FILES_PATH')	|| define('USER_FILES_PATH', FILE_PATH . '/UserFiles');
if (!defined('HTTP_HOST') && array_key_exists('HTTP_HOST', $_SERVER)) {
	define('HTTP_HOST', 'http://' . $_SERVER['HTTP_HOST']);
}

set_include_path(SYSTEM_PATH . PATH_SEPARATOR . LIBRARY_PATH . PATH_SEPARATOR . get_include_path());