<?php

class Constants{

    static function getViewPath(){
        return APP_PATH . "/resources/views/";
    }
}

if($_SERVER["SERVER_PORT"] === "443"){
    define('WEB_URL', $_SERVER["HTTP_REFERER"]);
}elseif ($_SERVER["SERVER_PORT"] === "80"){
    define('WEB_URL', "http://".$_SERVER["SERVER_NAME"]."/");
}