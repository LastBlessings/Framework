<?php
/**
 * User: Arthur
 * Date: 30.03.11
 * Time: 17:18
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('FRAMEWORK', 'system');
define('APPS', 'admin/application');
define('CORE', 'core');

require_once ROOT . DS . FRAMEWORK . DS . CORE . DS . 'Bootstrap.php' ;