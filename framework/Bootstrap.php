<?php
/**
 * User: Arthur
 * Date: 27.03.11
 * Time: 18:45
 * Bootstrap file
 */

/*
 * ------------------------
 * Load configuration file
 * ------------------------
 */
require_once (ROOT . DS . APPLICATIONS_PATH . DS . 'config' . DS . 'config.php'); //TODO: Class for this

/*
 * ----------------------
 * Load global functions
 * ----------------------
 */
require_once (ROOT . DS . FRAMEWORKS_PATH . DS . 'common.php');


/*
 * --------------------
 * Set error reporting
 * --------------------
 */
setReporting();

/*
 *------------------------------------------------------------
 * Load the Router class and redirect to the right Controller
 * -----------------------------------------------------------
 */
$ROUTER =& load_class('Router');
$ROUTER->route();