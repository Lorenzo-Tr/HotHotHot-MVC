<?php

const VIEWS_PATH = APP_PATH . '/resources/views/';
const MODELS_PATH = APP_PATH . '/app/models/';
const HELPERS_PATH = APP_PATH . '/app/helpers/';
const CONTROLLERS_PATH = APP_PATH . '/app/controllers/';
const KERNEL_PATH = APP_PATH . '/kernel/';

if($_SERVER["SERVER_PORT"] === "443")
  define('WEB_URL', $_SERVER["HTTP_REFERER"]);
if($_SERVER["SERVER_PORT"] === "80")
  define('WEB_URL', "http://".$_SERVER["SERVER_NAME"]."/");