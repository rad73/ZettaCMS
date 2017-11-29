<?php
// router.php
if (preg_match('/^\/(public\/|UserFiles\/)/', $_SERVER["REQUEST_URI"])) {
    return false;    // сервер возвращает файлы напрямую.
}
else if (preg_match('/^\/(zlib\/)/', $_SERVER["REQUEST_URI"])) {
    return require_once 'zetta_quick.php';
}
 else { 
    return require_once 'zetta.php';
}
