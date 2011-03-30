<?php
/**
 * User: Arthur
 * Date: 30.03.11
 * Time: 16:38
 * Controller Class
 */

class Controller
{

    protected $view;

    function __construct()
    {
        $this->view =& load_class('View');
        $this->view->set_default_path(TEMPLATE_PATH);
    }
}