<?php

namespace App\Services;

class Router{

    //Список всех url сайта
    private static $list = [];

    //Откроет страницу, которую мы здесь укажем
    //Вызывая этот метод, мы пополняем этот список списком URL, который есть на сайте
    public static function page($uri, $page_name){
        self::$list[] = [
            "uri" => $uri,
            "page" => $page_name
        ];
    }
    //Активация роутера
    public static function enable(){
        $query = $_GET['uri'];

        //Перебираем все URL, которые мы зарегестрировали в методе page
        foreach (self::$list as $route){
            if ($route['uri'] === $query ) {
                if (@$route['post'] === true && $_SERVER['REQUEST_METHOD'] === 'POST'){
                    //Для POST запроса
                    $action = new $route["class"];
                    $method = $route["method"];
                    if ($route['form_data'] && $route['files']){
                        $action->$method($_POST, $_FILES);
                    }
                    else if($route['form_data'] && !$route['files']){
                        $action->$method($_POST);
                    }
                    else {
                        $action->$method();
                    }
                    die();
                }
                else{
                    require_once "composer/views/pages/".$route['page'] . ".php";
                    die();
                }
            }
        }

        self::not_found_page();
    }

    public static function post($uri, $class, $method, $form_data = false, $files=false ){
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true,
            "form_data" => $form_data,
            "files" => $files
        ];
    }



    private static function not_found_page(){
        require_once "composer/views/errors/404.php";
    }
}