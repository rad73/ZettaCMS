<?php
putenv('ZETTA_MODE=development');

// router.php
if (preg_match('/^\/(public\/|UserFiles\/|Temp\/.*\.png)/', $_SERVER["REQUEST_URI"])) {
    return false;    // сервер возвращает файлы напрямую.
} elseif (preg_match('/^\/(zlib\/)/', $_SERVER["REQUEST_URI"])) {
    return require_once 'zetta_quick.php';
} else {
    return require_once 'zetta.php';
}
