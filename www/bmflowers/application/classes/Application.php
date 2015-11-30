<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 31.10.2015
 * Time: 7:02
 */

include_once 'Exceptions.php';

class App{
    private static $controller; //текущий контроллер
    private static $action;     //текущий action метод контроллера

    private static $currentUser;
    /**
     * application initialization:
     * start sessions, connect with database, set error reporting
     * @return void
     */
    public static function init(){
        //error reporting modes
        if(APP_MODE == 'dev'){
            ini_set('display_errors', '1');
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }

        spl_autoload_register('App::loadClasses');

        session_start();

        DB::connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_CHARSET);

    }


    /**
     * to run controller
     * @return function $run() running current controller
     */
    public static function run(){
        $url = explode('?', $_SERVER['REQUEST_URI']);
        $url = $url[0];
        $url = str_replace(BASE_PATH, '', $url);

        $url = explode('/', $url);

        //определение контроллера для обработки запроса
        if (isset($url[0]) && !empty($url[0])) {
            self::$controller = explode('-', $url[0]);

            foreach (self::$controller as &$cont) {
                $cont = ucfirst($cont);
            }
            self::$controller = implode('', self::$controller);

        } else {
            self::$controller = 'Index';
        }

        $controller = self::$controller . 'Controller';
//        echo '<pre>'; var_dump($controller);
        //определение action-метода для обработки запроса
        if (isset($url[1])) {
            self::$action = explode('-', $url[1]);
            foreach (self::$action as &$part) {
                $part = ucfirst($part);
            }
            self::$action = implode('', self::$action);
        } else {
            self::$action = 'default';
        }
//        echo '<br>'; var_dump(self::$action); die();




        //запуск контроллера
        return $controller::run();
    }

    /**
     * function for classes's autoload
     * @param string $className
     * @throws FileNotFoundException if the classfile doesn't exist
     * @throws ClassNotFoundException if the class in file doesn't exist
     * @return void
     */
    public static function loadClasses($className){
//        $fileName = '/';
        //если класс - контроллер или модель - отправляемся искать файлик в соотв. папку
        //в противном случае ищем классы в папке classes
        if(($index = strripos($className, 'Controller'))){
            $fileName = '/Controllers/' . substr_replace($className, '', $index) . '.php';
        } elseif (($index = strripos($className, 'Model'))){
            $fileName = '/Models/' . substr_replace($className, '', $index) . '.php';
//        } elseif(($index = strripos($className, 'Exception'))){
//            $fileName = '/classes/Exceptions.php';
        } else {
            $fileName = '/classes/' . $className . '.php';
        }

        //если файла нет - генерим исключение, если есть - подключаем
        if(!file_exists(APP_DIR . $fileName)){
            throw new FileNotFoundException($fileName);
        } else {
            include_once APP_DIR . $fileName;
        }

        //если в файле нет класса - исключение
        if(!class_exists($className)){
            throw new ClassNotFoundException($className);
        }
    }

    /**
     *it makes links to controllers
     * @param string $controller controller's name
     * @param array $params GET parameters
     * @return string $link
     */
    public static function getLink($controller, $params = array()){
        if(preg_match('/[A-Z]/', $controller)){
            $result = array();
            preg_match_all('/[A-Z][^A-Z]*/', preg_replace('/(.+)Controller$/', '$1', $controller), $result);
            $controller = strtolower(implode('-', $result[0]));
        }

        if (isset($params['action'])) {
            $action = $params['action'];
            unset($params['action']);

            if (preg_match('/[A-Z]/', $action)) {
                $result = array();
                preg_match('/^[a-z]*/', $action, $match);
                preg_match_all('/[A-Z][^A-Z]*/', $action, $result);
                array_unshift($result[0], $match[0]);
                $action = strtolower(implode('-', $result[0]));
            }
        }

        $link = $controller;
        if (isset($action)) $link .= '/' . $action;
        if (!empty($params)) $link .= '?';

        foreach ($params as $key => $param) {
            $link .= '&' . urlencode($key) . '=' . urlencode($param);
        }

        return BASE_PATH . $link;
    }

    /**
     * it makes simple links to styles, scripts, images
     * @param string $path path to source
     * @return string $link
     */
    public static function siteUrl($path=''){
        return BASE_PATH . $path;
    }

    /**
     * to get current controller
     * @return mixed
     */
    public static function getController(){
        return self::$controller;
    }

    /**to get current action
     * @return mixed
     */
    public static function getAction()
    {
        return self::$action;
    }

    /**
     * to check on the type of request
     * @return bool
     */
    public static function isAjax()
    {
        return
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            (
                $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ||
                strpos($_SERVER['HTTP_X_REQUESTED_WITH'], 'ShockwaveFlash') !== false
            );
    }

    /**set/get current user
     * @param null $user
     * @return mixed
     * TODO: проверить, а нужна ли мне вообще эта механика работы с пользователями?
     */
    public static function currentUser($user = null)
    {
        if($user){
            if(is_object($user)){
                $_SESSION['current_user_id'] = $user->getId();
                self::$currentUser = $user;
            } else {
                $_SESSION['current_user_id'] = $user;
                self::$currentUser = new UserModel($user, 1);
            }
        }
        if(isset($_SESSION['current_user_id'])){
            $_SESSION['current_user_id'] = 0;
            return null;
        }
        if(!self::$currentUser && $_SESSION['current_user_id']){
            self::$currentUser = new UserModel($_SESSION['current_user_id']);
        }
        return self::$currentUser;
    }
}