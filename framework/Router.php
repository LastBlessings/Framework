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
		  return;
    }

    public function route()
    {
        $this->uri->parse_uri();

        if (!$this->uri->get_controller()) {
            $this->_set_default_controller();
            return;
        }

        $this->_set_routing();
		  return;

    }

    private function _set_default_controller()
    {
        require_once ROOT . DS . APPLICATIONS_PATH . DS . 'Controllers' . DS . 'IndexController.php';

        $controller = new IndexController;
        if ($this->uri->get_params()) {
            call_user_func_array(array($controller, 'indexHandler'), $this->uri->get_params());
        } else {
            $controller->indexHandler();
        }
        //todo: From config file
    }

    private function _set_routing()
    {
        if (!$this->_validate_request()) {
            $this->_set_default_controller();
            return;
        }

        $controller = $this->uri->get_controller() . 'Controller';
        $module = $this->uri->get_module() . 'Handler';

        require_once ROOT . DS . APPLICATIONS_PATH . DS . 'Controllers' . DS . $this->uri->get_controller() . 'Controller.php';

        $controller = new $controller;
        if ($this->uri->get_params()) {
            call_user_func_array(array($controller, $module), $this->uri->get_params()); //FUTURE: change the way calling functions
        } else {
            $controller->$module();
        }
    }

    private function _validate_request() //TODO
    {
        if (!$this->uri->get_controller() OR !$this->uri->get_module()) {
            return FALSE;
        }

        if (!file_exists(ROOT . DS . APPLICATIONS_PATH . DS . 'Controllers' . DS . $this->uri->get_controller() . 'Controller.php')) {
            return FALSE;
        } elseif (!class_exists(ucwords($this->uri->get_controller()) . 'Controller')) {
            return FALSE;
        } elseif (!method_exists($this->uri->get_controller(), $this->uri->get_module() . 'Handler')) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
