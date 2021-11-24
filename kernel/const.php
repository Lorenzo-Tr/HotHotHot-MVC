<?php

define('VIEWS_PATH', APP_PATH . '/resources/views/');
define('MODELS_PATH', APP_PATH . '/app/models/');
define('HELPERS_PATH', APP_PATH . '/app/helpers/');
define('CONTROLLERS_PATH', APP_PATH . '/app/controllers/');
define('KERNEL_PATH', APP_PATH . '/kernel/');

if($_SERVER["SERVER_PORT"] === "443")
  define('WEB_URL', $_SERVER["HTTP_REFERER"]);
if($_SERVER["SERVER_PORT"] === "80")
  define('WEB_URL', "http://".$_SERVER["SERVER_NAME"]."/");