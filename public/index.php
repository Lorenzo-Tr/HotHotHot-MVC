<?php
// Const to get the app path
define('APP_PATH', dirname(dirname(__FILE__)));

// Load Config
require_once APP_PATH.'/config/config.php';
require_once APP_PATH.'/kernel/const.php';
require_once APP_PATH.'/kernel/autoload.php';
require_once APP_PATH.'/routes/routing.php';

$route = new AutoLoad();
$route = new Routing();



