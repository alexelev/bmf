<?php

/**
 * Created by PhpStorm.
 * User: A
 * Date: 13.11.2015
 * Time: 16:51
 */

/**
 * Class TemplatePage
 * Template output based php script (for HTML pages, XML and others.)
 */
class TemplatePage extends Template
{
    // Шаблоны страниц имеют вложенную структуру
    // В этом массиве хранятся переменные которые будут доступны сразу во всех шаблонах этого класса
    /**Page templates has nested structure
     * This array contains variable that will be available soon in all the templates in this class
     * @var array
     */
    protected static $globals = array();

    // Файл шаблона
    /**
     * @var template file
     */
    protected $file;

    /**
     * TemplatePage constructor.
     * @param string $file name of template file
     */
    public function __construct($file) {
        $this->file = $file;
    }

    /*
     * Переопределен чтобы была возможность одинаковым образом получать
     * как переменные текущего шаблона так и глобальные переменные всех шаблонов
     * в виде свойств объекта шаблона
     */
    /**It overrides to be able to receive the same way as the current template variables and global variables
     * of all the templates in the form template object properties
     * @param string $name
     * @return null
     */
    public function __get($name) {
        $result = parent::__get($name);

        if ($result) {
            return $result;
        }

        if (!$result && isset(self::$globals[$name])) {
            return self::$globals[$name];
        }

        return null;
    }

    // Привязка одной глобальной переменной или массива
    /**Binding a global variable or array
     * @param string or array $name variables
     * @param null $value
     */
    public function assignGlobals($name, $value = null) {
        if (is_array($name)) {
            foreach ($name as $var => $val) {
                self::$globals[$var] = $val;
            }
        } else {
            self::$globals[$name] = $value;
        }
    }

    /*
     * Рендеринг файла шаблона. В файле шаблона используются переменные шаблона
     * (в том числе глобальные)
     */
    /**Render the template file. The template file used template variables (including global)
     * @return string
     */
    public function display() {
        ob_start();

        // Подключение переводов для шаблона
//        App::setTranslation('templates/' . $this->file);

        include TPL_DIR . '/' . $this->file . '.php';

        return ob_get_clean();
    }

    // рендеринг дочернего шаблона включаемого в текущий
    /**rendering child template included in the current
     * @param string $file filename
     * @param array $params
     * @return string
     */
    public function displayTemplate($file, $params = array()) {
        $template = new TemplatePage($file);

        $template->assign($params);

        $result = $template->display();

//        App::setTranslation('templates/' . $this->file);

        return $result;
    }
}