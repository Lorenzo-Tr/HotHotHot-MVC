<?php

class Database
{

    public function __construct(){

        require_once APP_PATH . '/vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(APP_PATH);
        $dotenv->safeLoad();

        try {
            $dbh = new PDO('mysql:host='.$_ENV['DBHOST'].';dbname='.$_ENV['DBNAME'], $_ENV['DBUSER'], $_ENV['DBPWD']);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage() . '<br/>');
        }
    }

    public function closeDB($dbh)
    {
        $dbh = null;
    }

}