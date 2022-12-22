<?php
//var_dump($_GET['uri']);

use App\Services\Router;
use App\Services\App;

//подключаем autoload.php
require_once __DIR__ . '/composer/vendor/autoload.php';
require_once __DIR__ . '/composer/router/routes.php';
App::start();
Router::enable();