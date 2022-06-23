<?php
	
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__FILE__).'/..');
define('ROOT_WEB', ROOT.'/public_html');

require_once (ROOT.'/components/Autoload.php');

$router = new Router();
$router->run();