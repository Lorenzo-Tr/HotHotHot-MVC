<?php
// Const to get the app path
define("APP_PATH", dirname(__DIR__));

// Load Config
require_once APP_PATH.'/kernel/autoload.php';

Autoloader::setFileExt('.php');
Autoloader::setPath(APP_PATH);
spl_autoload_register('Autoloader::loader');

// To upgrade (make a config file on the kernel to parse yml file in config)
require_once APP_PATH.'/config/config.php';


$route = new Routing();