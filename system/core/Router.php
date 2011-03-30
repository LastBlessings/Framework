<?php
/**

 * User: Arthur
 * Date: 27.03.11
 * Time: 21:16
 * Router class
 */

class Router
{

    public function __construct()
    {
        $this->uri = load_class('URI');
    }

    public function route()
    {
        $this->uri->parse_uri();

        if (!$this->uri->get_controller()) {
            $this->_set_default_controller();
            return;
        }

        $this->_set_routing();

    }

    private function _set_default_controller()
    {
        //TODO:
    }

    private function _set_routing()
    {
        /*if (!$this->_validate_request()) {
            $this->_set_default_controller();
            return;
        }*/

        $controller = $this->uri->get_controller() . 'Controller';
        $module = $this->uri->get_module() . 'Handler';

        require_once ROOT . DS . APPS . DS . 'Controllers' . DS . $this->uri->get_controller() . 'Controller.php';

        $controller = new $controller;
        call_user_func_array( array($controller, $module), $this->uri->get_params());//FUTURE: change the way calling functions
    }

    private function _validate_request() //TODO
    {
        if (!file_exists(ROOT . DS . APPS . DS . 'Controllers' . DS . $this->uri->get_controller() . 'Controller.php')) {
            return FALSE;
        } elseif (!class_exists(ucwords($this->uri->get_controller()). 'Controller')) {
            return FALSE;
        } elseif (!method_exists($this->uri->get_controller(), $this->uri->get_module() . 'Handler')) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
