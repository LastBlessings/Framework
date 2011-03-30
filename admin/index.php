define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('FRAMEWORK', 'system');
define('APPS', 'admin/application');
define('CORE', 'core');

require_once ROOT . DS . FRAMEWORK . DS . CORE . DS . 'Bootstrap.php' ;