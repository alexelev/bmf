<?php

/**
 * Created by PhpStorm.
 * User: A
 * Date: 13.11.2015
 * Time: 16:52
 */

/**
 * Class Template is basic for templates
 */
class Template
{
    protected $vars = array();

    /**
     * automatically obtain template variable as object properties
     * @param string $name parameter's name
     * @return null or data of parameter, if exest
     */
    public function __get($name)
    {
        if(isset($this->vars[$name])){
            return $this->vars[$name];
        }
        return null;
    }

    /**receive data about the existence of the parameters
     * @param string $name parameter's name
     * @return bool
     */
    public function __isset($name){
        return !empty($this->vars[$name]);
    }

    /**Bind a single variable to the template, or an array of variables
     * @param string or array $name parameters
     * @param null $value value of the parameter, null by default
     */
    public function assign($name, $value = null)
    {
        if (is_array($name)){
            foreach ($name as $key => $item) {
                $this->vars[$key] = $item;
            }
        } else {
            $this->vars[$name] = $value;
        }
    }

    /**
     * Rendering template (Each class template is rendered in its)
     */
    public function display(){}
}