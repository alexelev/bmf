<?php
/**
 * Подключение конфига,
 * в котором константы путей к папкам
 * и подключения к базе данных
 */
//phpinfo();
//die();
include_once 'config.php';

// Подключение файла с классом App
include_once APP_DIR . '/classes/Application.php';

// Инициализация (подготовка к обработке запроса)
App::init();

//тест базы данных
//$ret = DB::query('SELECT * from `user`');
//foreach ($ret as $item) {
//    echo 'id: ' . $item['id'] . ' | login: ' . $item['login'] . ' | password: ' . $item['pass'] . PHP_EOL;
//}
//var_dump($ret);
//$login = DB::getRow('SELECT * from `user` WHERE `id` = ?', array(1));
//print_r($login);


print_r(DB::exStoredProc('CALL getPlants(?,?,?)', array(array('hoya', DataType::STR), array(1, DataType::INT), array(3, DataType::INT))));
//DB::exStoredProc();
// Запуск обработки запроса и вывод результата
//echo App::run();
