<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 31.10.2015
 * Time: 6:59
 */

//основной путь в url после домена
define('BASE_PATH', '/');

//режим работы сайта(разработка/продакшн)
define('APP_MODE', 'dev');
//define('APP_MODE', 'prod');

//корневая папка
define('ROOT_DIR', __DIR__);

//папка с классами, контроллерами, моделями
define('APP_DIR', ROOT_DIR . '/application');

//папка с шаблоном
define('TPL_DIR', ROOT_DIR . '/templates');

////папка с переводами
//define('LANG_DIR', ROOT_DIR . '/langs');
//
////язык по умолчанию
//define('DEF_LANG', 1);

//для работы с БД
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'florushka');
define('DB_CHARSET', 'UTF8');