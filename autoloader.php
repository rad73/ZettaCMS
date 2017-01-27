<?php

/**
 * Определяем глобальные константы
 *
 */
defined('DS')			|| define('DS', DIRECTORY_SEPARATOR);
defined('ZETTA_MODE')	|| define('ZETTA_MODE', (getenv('ZETTA_MODE') ? getenv('ZETTA_MODE') : 'production'));

defined('SYSTEM_PATH')	|| define('SYSTEM_PATH', realpath(dirname(__FILE__) . '/../zetta'));
defined('ZETTA_FRAMEWORK_PATH')	|| define('ZETTA_FRAMEWORK_PATH', realpath(SYSTEM_PATH . DS . 'Zetta'));
defined('FILE_PATH')	|| define('FILE_PATH', realpath(dirname(__FILE__)));
defined('TEMP_PATH')	|| define('TEMP_PATH', realpath(FILE_PATH . DS . 'Temp'));
defined('MODULES_PATH')	|| define('MODULES_PATH', realpath(SYSTEM_PATH . DS . 'Modules'));
defined('HEAP_PATH')	|| define('HEAP_PATH', realpath(FILE_PATH . DS . 'Heap'));
defined('USER_FILES_PATH')	|| define('USER_FILES_PATH', realpath(FILE_PATH . DS . 'UserFiles'));
defined('LIBRARY_PATH')	|| define('LIBRARY_PATH', realpath(SYSTEM_PATH . DS . 'Library'));
defined('USER_LIBRARY_PATH')	|| define('USER_LIBRARY_PATH', realpath(FILE_PATH . DS . 'Library'));

if (!defined('HTTP_HOST')) {	// вычисляем HTTP_HOST

	if (array_key_exists('SERVER_NAME', $_SERVER)) {
		define('HTTP_HOST', 'http://' . $_SERVER['SERVER_NAME']);
	}
	else {
		$arrayInput = getopt(false, array('host:'));
		if (is_array($arrayInput) && array_key_exists('host', $arrayInput)) {
			define('HTTP_HOST', 'http://' . $arrayInput['host']);
		}
	}

}

set_include_path(
		SYSTEM_PATH . PATH_SEPARATOR
		. LIBRARY_PATH . PATH_SEPARATOR
		. USER_LIBRARY_PATH . PATH_SEPARATOR
		. HEAP_PATH . PATH_SEPARATOR
		. MODULES_PATH . PATH_SEPARATOR
);

require_once '.vendor/autoload.php';
