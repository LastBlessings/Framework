<?php

	if(version_compare(PHP_VERSION, '5', 'lt'))
	{
		exit('PHP +5 required.');
	}

@set_time_limit(0);
@set_magic_quotes_runtime(0);

# !$_COOKIE
$_REQUEST = array_merge($_GET, $_POST);

	if((count($_REQUEST) > 100) || (PHP_SAPI == 'cli') || (strlen(@$_SERVER['HTTP_USER_AGENT']) > 255) || !trim(@$_SERVER['HTTP_USER_AGENT']))
	{
		exit;
	}

	# Windows (CGI + Apache VirtualHost)
	if(!isset($_SERVER['DOCUMENT_ROOT']) && isset($_SERVER['SCRIPT_FILENAME']))
	{
		$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, (0 - strlen($_SERVER['PHP_SELF']))));
	}

	# Windows (CGI + Apache VirtualHost)
	if(!isset($_SERVER['DOCUMENT_ROOT']) && isset($_SERVER['PATH_TRANSLATED']))
	{
		$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, (0 - strlen($_SERVER['PHP_SELF']))));
	}

define('DS', ((DIRECTORY_SEPARATOR == '/') ? '/' : '\\\\'));
define('ROOT_PATH', htmlspecialchars($_SERVER['DOCUMENT_ROOT'], ENT_QUOTES) . MODEL_DS);
define('ROOT', dirname(__FILE__));
define('FRAMEWORKS_PATH', 'framework');
define('APPLICATIONS_PATH', 'applications');

require_once (ROOT . DS . FRAMEWORKS_PATH . DS . 'Bootstrap.php');