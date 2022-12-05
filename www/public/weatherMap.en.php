<?php
require_once("authentication/db_connect.php");
session_start();

if (!isset($_SESSION['user'])) {
    setcookie("lastPage", "weatherMap");
    header('Location: http://localhost/login.en.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "./css/style.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/normalize.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/weatherMap.css">
    <link rel="stylesheet" href="/css/<?php echo $_SESSION['theme'] = redisGet(substr_replace(session_id(),"PHPREDIS_THEME:",0, 0));?>">
    <title>Погода</title>
    <!--Загрузка шрифтов-->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src= "./js/moment-with-locales.js"></script>
    <script src="./js/moment-timezone-with-data.js"></script>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=559dfe93-fc2a-44ff-830e-8ed8ca51c764&lang=ru_RU" type="text/javascript"></script>

    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>
    <script src="./js/scriptMap.js"></script>





    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicons/favicon-16x16.png">
    <link rel="mask-icon" href="./img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <header class="site-header">
        <div class="head-container">
            <div class="logo-title">
                <a href="index.html"><img src = "./img/logo.png" alt = "" class = "logo"></a>
                    <div class="logo-type">
                        <h1 class="site-title" ><a href="index.html">Прогноз погоды</a></h1>
                        <small class="site-description"><a href="https://yandex.ru">При поддержке Yandex</a></small>
                    </div>


            </div>
            <div class="menu-searchbar">
                <div class="menu">
                    <a href="cities.php" class = "cities">Погода городов мира</a>
                    <a href="sixteen.php" class="sixteen-forecast">Прогноз на 16 дней</a>
                    <a href="history.php" class="history">Прогноз прошлой недели</a>
                    <a href="" class="map-forecast" onclick="return false">Геокарта мира</a>
                </div>
                <form id="search-bar" onsubmit="return Search()" method="post">
                    <script src="./js/script.js"></script>
                    <input type ="search"  name = "search" id = "search" required placeholder="Введите город">
                    <input type="submit" value="Найти" id = "submit">
                    <a  style="color:white; "  href="profile.php">Профиль</a>
                </form>
            </div>
        </div>
    </header>
    <div class="content-container">
        <div class="up-container">
            <div class="left-tab">
                <div class="left-tab-up">
                    <div class="city-temp">
                       
                        <div class="city">
                            
                        </div>
                        <div class="temp">
                            
                        </div>
                    </div>
                    <div class="feature-right">
                        <span class="loader"></span>
                    </div>
                </div>
                <div class="desc-geo">
                    <div class="description">
                        Определите геолокацию
                    </div>
                    <button class="geo" onclick="return updateLocation()">
                        
                    </button>
                </div>
                <div class="go-to-index">
                    <form action="index.html">
                        <button class="to-index" href = "index.html" >
                            Подробный прогноз погоды
                        </button>
                    </form>
                </div>
                <div class="date-info">
                    <div class="clocks">
                        <div class="left-clock">
                            <div class="currClock">
                                <img src = "./img/clock.png">
                            </div>
                            <div class="currTime">
                                00:00:00
                            </div>
                            <div class="current-timeline">
                                МСК
                            </div>
                        </div>
                        <div class="right-clock">
                            <div class="gmtClock">
                                <img src = "./img/clock.png">
                            </div>
                            <div class="gmtTime">>
                                00:00:00
                            </div>
                            <div class="gmt-timeline">
                                GMT
                            </div>
                            <script src="./js/clockScript.js"></script>
                        </div>
                    </div>
                    <div class="day-of-week">
                        День недели
                    </div>
                    <div class="month">
                        Месяц
                    </div>
                </div>
            </div>
            <div id="windy">

            </div>
        </div>
        <div class="slider-bar">
            <button class ="btn-prev">Prev</button>
            <div class="bar">
                <div class="daily-container"> <!-- наше окно, в котором будут двигаться элементы-->
                    <div class = "daily-track"> <!-- полоска элементов, которая будет перемещаться-->
                      
                        <div class = "elementMap" id = "elementMap0">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap0">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp0" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time0">
                                Время
                            </div>
                        </div>

                        <div class = "elementMap" id = "elementMap1">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap1">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp1" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time1">
                                Время
                            </div>
                        </div>

                        <div class = "elementMap" id = "elementMap2">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap2">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp2" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time2">
                                Время
                            </div>
                        </div>

                        <div class = "elementMap" id = "elementMap3">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap3">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp3" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time3">
                                Время
                            </div>
                        </div>
                            
                        <div class = "elementMap" id = "elementMap4">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap4">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp4" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time4">
                                Время
                            </div>
                        </div>

                        <div class = "elementMap" id = "elementMap5">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap5">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp5" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time5">
                                Время
                            </div>
                        </div>


                        <div class = "elementMap" id = "elementMap6">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap6">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp6" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time6">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap7">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap7">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp7" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time7">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap8">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap8">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp8" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time8">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap9">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap9">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp9" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time9">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap10">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap10">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp10" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time10">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap11">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap11">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp11" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time11">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap12">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap12">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp12" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time12">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap13">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap13">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp13" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time13">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap14">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap14">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp14" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time14">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap15">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap15">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp15" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time15">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap16">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap16">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp16" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time16">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap17">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap17">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp17" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time17">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap18">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap18">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp18" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time18">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap19">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap19">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp19" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time19">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap20">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap20">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp20" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time20">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap21">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap21">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp21" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time21">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap22">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap22">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp22" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time22">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap23">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap23">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp23" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time23">
                                Время
                            </div>
                        </div>
                        <div class = "elementMap" id = "elementMap24">
                            <div class="filter">
                                <div class="elem-featureMap" id = "elem-featureMap24">
                                    <img src = "./img/moon.png">
                                </div>
                                <div class="elem-temp" id = "elem-temp24" >
                                    +99 °C
                                </div>
                            </div>
                            <div class="elem-time" id = "elem-time24">
                                Время
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <button class ="btn-next">Next</button>
        </div>
    </div>
    <script src="./js/slideMap.js"></script>
    <script src = "js/WeatherMap.js"></script>
    <script src="./js/scriptMap.js"></script>
</body>
</html>