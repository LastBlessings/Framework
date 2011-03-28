<?php
/**
 * User: Arthur
 * Date: 27.03.11
 * Time: 19:19
 * Common functions
 */

function setReporting()
{
    if (DEVELOPMENT_ENVIRONMENT == TRUE) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . FRAMEWORK . 'tmp' . DS . 'logs' . DS . 'error.log');
    }
}

function __autoload($class)
{
    if (file_exists(ROOT . DS . FRAMEWORK . DS . CORE . DS . $class . '.php')) {
        require_once (ROOT . DS . FRAMEWORK . DS . CORE . DS . $class . '.php');
    } else {
        return FALSE;
    }
}

function &load_class($class, $directory = 'core')
{
    static $classes = array();

    if (isset($classes[$class])) {
        return $classes[$class];
    }

    __autoload($class);

    $classes[$class] = new $class();

    return $classes[$class];
}