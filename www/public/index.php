<?php
require_once("resources/lang.php");
session_start();
if (!isset($_COOKIE['theme'])) {
    setcookie('theme', '');
}

global $langIndexes;


// Включение автоопределения языка
if (!isset($_COOKIE['isCustomLanguage'])){

    $selectedLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    setcookie("autoLanguage", "$selectedLang");
    // проверяем есть ли язык в списке поддерживаемых
    if (!in_array($selectedLang, array_keys($langIndexes))) {
        $selectedLang = 'ru';
    }

    if ($selectedLang != "ru"){
        // перенаправление на субдомен
        header('Location: ' . $langIndexes[$selectedLang]);
    }
}



?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="/css/<?php echo @$_COOKIE['theme'];?>">
    <link rel = "stylesheet" type = "text/css" href = "./css/style.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/normalize.css">
    <title>Погода</title>
    <!--Загрузка шрифтов-->

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=559dfe93-fc2a-44ff-830e-8ed8ca51c764&lang=ru_RU" type="text/javascript"></script>
    <script src= "./js/moment-with-locales.js"></script>
    <script src="./js/moment-timezone-with-data.js"></script>
    <script src="./js/map.js"></script>
    <script src="./js/current.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/Chart.js"></script>
    
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
                    <a href="cities.php"  class = "cities">Погода городов мира </a>
                    <a href="sixteen.php" class="sixteen-forecast">Прогноз на 16 дней</a>
                    <a href="history.php" class="history">Прогноз прошлой недели</a>
                    <a href="weatherMap.php" class="map-forecast">Геокарта мира</a>
                </div>
                <form id="search-bar" method="post" >
                    <input type ="search"  name = "search" id = "search" required placeholder="Введите город">
                    <input type="button" onclick="return Weather(), changeLocation(), Update()" value="Найти" id = "submit">
                    <a  style="color:white; "  href="profile.php">Профиль</a>
                </form>
            </div>

        </div>
    </header>
    <div class="content-container">
        <main id = "main">
            <section id = "tab">
                <div class="weather" id = "weather">
                    <div id = "need">Местоположение не найдено</div>
                    <h2><span class="city" ></span></h2>
                    <div class="desctription-feature-temp">
                        <p><span class="temp"></span>°C</p>
                        <div><span class = "desctription"></span></div>
                        <div><div class="feature" id = "feature"></div></div>
                    </div>
                    <p>Ощущается как: <span class="feels"></span>°C</p>
                    <p>Влажность: <span class="humidity"></span>%</p>
                    <p>Ветер: <span class="wind"></span> м/с</p>
                </div>
            </section>
            <div id="map">

            </div>
        </main>
        <section id = "schedule">


            <div class="schedule-header">
                Текущая дата
            </div>
            <div class="schedule-date"></div>
            <div class="schedule-table">
                <div class="sun-info">
                    <div class="sunrise-sunset">
                        <div class="sunrise">
                            <div class="voshod">Восход</div>
                            <!--<img src = "./img/sunrise.png" alt = "" class = "sunrise-logo"></div>-->
                            <div class="sunrise-time"><span class = "sunrise-time-info"></span></div>
                        </div>
                        <div class="sunset">
                            <div class="zakat">Закат</div>
                            <!--<img src = "./img/sunset.png" alt = "" class = "sunset-logo"></div>-->
                            <div class="sunset-time"><span class = "sunset-time-info"></span></div>
                        </div>
                    </div>
                    <div class="about-sun">
                        <div class="day-length">Световой день: <span class = "day-length-info"></span></div>
                        <div class="uf-index">Уф-индекс: <span class = "uf-index-info"></span></div>
                        <div class="pressure">Давление: <span class = "pressure-info"></span></div>
                    </div>
                </div>
                <div class="night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span class="night-temp"></span></span>
                                <span id = "night-feel">Ощущается как <span class="night-feel"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span class="morning-temp"></span></span>
                                <span id = "morning-feel">Ощущается как <span class="morning-feel"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span class="day-temp"></span></span>
                                <span id = "day-feel">Ощущается как <span class="day-feel"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span class="evening-temp"></span></span>
                                <span id = "evening-feel">Ощущается как <span class="evening-feel"></span></span>
                            </div>
                    </div>
                </div>
                <div class="daily-container"> <!-- наше окно, в котором будут двигаться элементы-->
                    <div class = "daily-track"> <!-- полоска элементов, которая будет перемещаться-->
                      
                        <div class = "element" id = "element0">
                            <div class="elem-time" id = "elem-time0">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp0" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature0">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc0">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop0">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis0">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element1">
                            <div class="elem-time" id = "elem-time1">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp1" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature1">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc1">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop1">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis1">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element2">
                            <div class="elem-time" id = "elem-time2">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp2" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature2">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc2">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop2">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis2">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element3">
                            <div class="elem-time" id = "elem-time3">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp3" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature3">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc3">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop3">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis3">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element4">
                            <div class="elem-time" id = "elem-time4">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp4" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature4">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc4">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop4">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis4">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element5">
                            <div class="elem-time" id = "elem-time5">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp5" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature5">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc5">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop5">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis5">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element6">
                            <div class="elem-time" id = "elem-time6">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp6" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature6">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc6">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop6">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis6">
                                Видимость
                            </div>
                        </div>
                        <div class="element"   id = "element7">
                            <div class="elem-time" id = "elem-time7">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp7" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature7">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc7">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop7">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis7">
                                Видимость
                            </div>

                        </div>
                        <div class="element"   id = "element8">
                            <div class="elem-time" id = "elem-time8">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp8" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature8">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc8">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop8">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis8">
                                Видимость
                            </div>

                        </div>
                        <div class="element"  id = "element9">
                            <div class="elem-time" id = "elem-time9">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp9" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature9">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc9">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop9">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis9">
                                Видимость
                            </div>

                        </div>
                        <div class="element"  id = "element10">
                            <div class="elem-time" id = "elem-time10">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp10" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature10">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc10">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop10">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis10">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element11">
                            <div class="elem-time" id = "elem-time11">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp11" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature11">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc11">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop11">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis11">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element12">
                            <div class="elem-time" id = "elem-time12">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp12" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature12">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc12">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop12">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis12">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element13">
                            <div class="elem-time" id = "elem-time13">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp13" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature13">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc13">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop13">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis13">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element14">
                            <div class="elem-time" id = "elem-time14">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp14" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature14">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc14">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop14">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis14">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element15">
                            <div class="elem-time" id = "elem-time15">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp15" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature15">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc15">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop15">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis15">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element16">
                            <div class="elem-time" id = "elem-time16">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp16" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature16">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc16">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop16">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis16">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element17">
                            <div class="elem-time" id = "elem-time17">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp17" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature17">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc17">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop17">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis17">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element18">
                            <div class="elem-time" id = "elem-time18">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp18" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature18">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc18">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop18">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis18">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element19">
                            <div class="elem-time" id = "elem-time19">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp19" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature19">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc19">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop19">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis19">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element20">
                            <div class="elem-time" id = "elem-time20">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp20" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature20">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc20">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop20">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis20">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element21">
                            <div class="elem-time" id = "elem-time21">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp21" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature21">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc21">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop21">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis21">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element22">
                            <div class="elem-time" id = "elem-time22">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp22" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature22">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc22">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop22">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis22">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element23">
                            <div class="elem-time" id = "elem-time23">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp23" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature23">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc23">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop23">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis23">
                                Видимость
                            </div>
                        </div>
                        <div class="element"  id = "element24">
                            <div class="elem-time" id = "elem-time24">
                                Время
                            </div>
                            <div class="elem-temp" id = "elem-temp24" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature24">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc24">
                                Погода
                            </div>
                            <div class="elem-pop" id = "elem-pop24">
                                Вероятность осадков
                            </div>
                            <div class="elem-vis" id = "elem-vis24">
                                Видимость
                            </div>
                        </div>

                    </div>
                </div>
                <div class="slider-buttons">
                    <button class ="btn-next">Next</button>
                    <button class ="btn-prev">Prev</button>
                </div>
            </div> 
               <script src="./js/slide.js"></script>

            <div class="chart-after-schedule-table">
                <canvas id="Chart0">

                </canvas>
            </div>
            </section>
            
        <h2>Прогноз погоды на неделю</h2>
        <section id="seven-days">

        <!-- first chart -->


        <div class="seven-days-table" id = "seven-days-table1">
            <div class="high-date" id = "high-date1">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img1">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather1"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max1"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min1"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра: <span id ="sd-wind-spd1"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра: <span id ="sd-wind-dir1"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра: <span id ="sd-wind-gusts1"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum1"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop1"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis1"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart1" width="757" height="352">
                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">
                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp1"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel1"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp1"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel1"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp1"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel1"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp1"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel1"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise1"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset1"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv1"></span>
                    </div>
                </div>
            </div>
        </div>


        <!-- second chart -->


        <div class="seven-days-table" id = "seven-days-table2">
            <div class="high-date" id = "high-date2">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img2">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather2"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max2"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра <span id ="sd-wind-spd2"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра <span id ="sd-wind-dir2"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра <span id ="sd-wind-gusts2"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum2"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop2"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis2"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart2" width="757" height="352">
                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">

                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp2"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel2"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp2"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel2"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp2"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel2"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp2"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel2"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise2"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset2"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv2"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- third chart -->

        <div class="seven-days-table" id = "seven-days-table3">
            <div class="high-date" id = "high-date3">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img3">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather3"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max3"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min3"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра <span id ="sd-wind-spd3"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра <span id ="sd-wind-dir3"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра <span id ="sd-wind-gusts3"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum3"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop3"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis3"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart3" width="757" height="352">
                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">

                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp3"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel3"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp3"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel3"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp3"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel3"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp3"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel3"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise3"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset3"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv3"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4th chart -->

        <div class="seven-days-table" id = "seven-days-table4">
            <div class="high-date" id = "high-date4">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img4">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather4"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max4"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min4"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра <span id ="sd-wind-spd4"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра <span id ="sd-wind-dir4"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра <span id ="sd-wind-gusts4"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum4"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop4"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis4"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart4" width="757" height="352">
                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">

                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp4"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel4"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp4"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel4"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp4"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel4"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp4"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel4"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise4"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset4"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv4"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5th chart -->

        <div class="seven-days-table" id = "seven-days-table5">
            <div class="high-date" id = "high-date5">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img5">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather5"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max5"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min5"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра <span id ="sd-wind-spd5"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра <span id ="sd-wind-dir5"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра <span id ="sd-wind-gusts5"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum5"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop5"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis5"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart5" width="757" height="352">
                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">

                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp5"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel5"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp5"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel5"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp5"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel5"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp5"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel5"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise5"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset5"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv5"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6th chart -->

        <div class="seven-days-table" id = "seven-days-table6">
            <div class="high-date" id = "high-date6">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img6">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather6"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max6"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min6"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра <span id ="sd-wind-spd6"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра <span id ="sd-wind-dir6"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра <span id ="sd-wind-gusts6"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum6"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop6"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis6"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart6" width="757" height="352">
                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">

                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp6"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel6"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp6"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel6"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp6"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel6"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp6"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel6"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise6"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset6"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv6"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7th chart -->
        
        <div class="seven-days-table" id = "seven-days-table7">
            <div class="high-date" id = "high-date7">
                Дата
            </div>
            <div class="seven-days-high-left-right">
                <div class="seven-days-high-left">
                    <div class="seven-days-img-weather">
                        <div class="seven-days-img" id = "seven-days-img7">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="seven-days-weather-max-min">
                            <div class="seven-days-weather">
                                <span id ="seven-days-weather7"></span>
                            </div>
                            <div class="seven-days-max">
                                Максимальная температура: <span id ="seven-days-max7"></span>
                            </div>
                            <div class="seven-days-min">
                                Минимальная температура: <span id ="seven-days-min7"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Скорость ветра <span id ="sd-wind-spd7"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Направление ветра <span id ="sd-wind-dir7"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Порывы ветра <span id ="sd-wind-gusts7"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Влажность <span id ="seven-days-hum7"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Вероятность осадков <span id ="seven-days-pop7"></span>
                        </div>
                        <div class="seven-days-vis">
                            Видимость <span id ="seven-days-vis7"></span>
                        </div>
                    </div>
                </div>
                <div class="seven-days-high-right">
                    <canvas id="Chart7" width="757" height="352">

                    </canvas>
                </div>
            </div>
            <div class="seven-days-under">
                <div class="seven-days-night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">Ночью <span id="night-temp7"></span></span>
                                <span id = "night-feel">Ощущается как <span id="night-feel7"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">Утром <span id="morning-temp7"></span></span>
                                <span id = "morning-feel">Ощущается как <span id="morning-feel7"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">Днём <span id="day-temp7"></span></span>
                                <span id = "day-feel">Ощущается как <span id="day-feel7"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">Вечером <span id="evening-temp7"></span></span>
                                <span id = "evening-feel">Ощущается как <span id="evening-feel7"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Рассвет <span id = "seven-days-sunrise7"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Закат <span id = "seven-days-sunset7"></span>
                    </div>
                    <div class="seven-days-uv">
                        Уф индекс <span id = "seven-days-uv7"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
    </footer>

</body>
</html>

