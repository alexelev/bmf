<?php

/**
 * Created by PhpStorm.
 * User: A
 * Date: 09.11.2015
 * Time: 13:31
 */
abstract class Controller
{
    private static $templateVars = array();
    private static $templateGlobals = array();


    /**Set/get parameter to out
     *it update parameter if value is not null
     *else it return current value of parameter
     * @param string $name name of parameter
     * @param null $value value of parameter
     * @return null
     */
    protected static function templateVar($name, $value = null){
        if(isset($value)){
            self::$templateVars[$name] = $value;
        } elseif (isset(self::$templateVars[$name])){
            return self::$templateVars[$name];
        } else {
            return null;
        }
    }

    /***
     * unset parameter by it name
     * @param string $name name of the parameter
     */
    protected static function unsetVar($name)
    {
        unset(self::$templateVars[$name]);
    }

    /**Set/get global parameter to out
     *it update global parameter if value is not null
     *else it return current value of global parameter
     * @param string $name name of the global parameter
     * @param null $value value of the global parameter
     * @return null
     */
    protected static function templateGlobal($name, $value = null)
    {
        if(isset($value)){
            self::$templateGlobals[$name] = $value;
        } elseif(isset(self::$templateGlobals[$name])){
            return self::$templateGlobals[$name];
        } else {
            return null;
        }
    }

    /***
     * unset global parameter by it name
     * @param string $name name of the global parameter
     */
    protected static function unsetGlobal($name)
    {
        unset(self::$templateGlobals[$name]);
    }

    /**
     * preparing to execute a query
     */
    protected static function init(){}

    /**
     * set the action method by default
     */
    protected static function actionDefault(){

    }

    /**
     * redirect to the custom url
     * @param string $url url to redirect
     */
    protected static function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    /**
     *Running the processing request controller
     */
    public static function run()
    {
        static::init();
        $method = 'action' . App::getAction();
        if(method_exists(get_called_class(), $method)){
            return static::$method();
        } else {
            return static::actionDefault();
        }
    }

    /*
     * Выводит указанный шаблон страницы в виде строки
     * Используется класс TemplatePage
     * В шаблоне выполняется php код
     * перед выводом все переменные подготовленные на вывод передаются шаблону
     */
    /**output for a page template in a string
     * @param string $file filename
     * @return string file content
     */
    protected static function displayPage($file)
    {
        $template = new TemplatePage($file);
        $template->assignGlobals(self::$templateGlobals);
        $template->assign(self::$templateVars);
        $result = $template->display();
        return $result;
    }
}