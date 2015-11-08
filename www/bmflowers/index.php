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


// Запуск обработки запроса и вывод результата
//echo App::run();
