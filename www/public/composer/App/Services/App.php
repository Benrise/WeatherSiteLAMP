<?php

namespace App\Services;

class App
{
    public static $connect;
    public static function start(){
        require_once("./composer/App/resources/lang.php");
        self::db();
    }

    public static function db(){
        $config = require_once("./composer/App/config/db.php");

        if($config['enable']){
            self::$connect = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
            if (!self::$connect) {
                die('Error connect to DataBase');
            }
        }
    }

}