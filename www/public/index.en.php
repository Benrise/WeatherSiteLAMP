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

    if ($selectedLang != "en"){
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
    <title>Forecast</title>

    <!--Загрузка шрифтов-->

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
    <link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=559dfe93-fc2a-44ff-830e-8ed8ca51c764&lang=en_RU" type="text/javascript"></script>
    <script src= "./js/moment-with-locales.js"></script>
    <script src="./js/moment-timezone-with-data.js"></script>
    <script src="./js/map.en.js"></script>
    <script src="./js/current.en.js"></script>
    <script src="./js/script.en.js"></script>
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
                        <h1 class="site-title" ><a href="index.html">Forecast</a></h1>
                        <small class="site-description"><a href="https://yandex.ru">Supported by Yandex</a></small>
                    </div>


            </div>

            <div class="menu-searchbar">
                <div class="menu" style = "width: auto">
                    <a href="cities.en.php"  class = "cities">In cities </a>
                    <a href="sixteen.en.php" class="sixteen-forecast">For 16 days</a>
                    <a href="history.en.php" class="history">For last 7 days</a>
                    <a href="weatherMap.en.php" class="map-forecast">Geomap</a>
                </div>
                <form id="search-bar" method="post" >
                    <input type ="search"  name = "search" id = "search" required placeholder="Enter city">
                    <input type="button" onclick="return Weather(), changeLocation(), Update()" value="Search" id = "submit">
                    <a  style="color:white; "  href="profile.en.php">Profile</a>
                </form>
            </div>

        </div>
    </header>
    <div class="content-container">
        <main id = "main">
            <section id = "tab">
                <div class="weather" id = "weather">
                    <div id = "need">Location not found</div>
                    <h2><span class="city" ></span></h2>
                    <div class="desctription-feature-temp">
                        <p><span class="temp"></span>°C</p>
                        <div><span class = "desctription"></span></div>
                        <div><div class="feature" id = "feature"></div></div>
                    </div>
                    <p>Feels like: <span class="feels"></span>°C</p>
                    <p>Humidity: <span class="humidity"></span>%</p>
                    <p>Wind: <span class="wind"></span> m/s</p>
                </div>
            </section>
            <div id="map">

            </div>
        </main>
        <section id = "schedule">


            <div class="schedule-header">
                Сurrent datetime
            </div>
            <div class="schedule-date"></div>
            <div class="schedule-table">
                <div class="sun-info">
                    <div class="sunrise-sunset">
                        <div class="sunrise">
                            <div class="voshod">Dawn</div>
                            <!--<img src = "./img/sunrise.png" alt = "" class = "sunrise-logo"></div>-->
                            <div class="sunrise-time"><span class = "sunrise-time-info"></span></div>
                        </div>
                        <div class="sunset">
                            <div class="zakat">Sunset</div>
                            <!--<img src = "./img/sunset.png" alt = "" class = "sunset-logo"></div>-->
                            <div class="sunset-time"><span class = "sunset-time-info"></span></div>
                        </div>
                    </div>
                    <div class="about-sun">
                        <div class="day-length">Daylight hours: <span class = "day-length-info"></span></div>
                        <div class="uf-index">UV-index: <span class = "uf-index-info"></span></div>
                        <div class="pressure">Pressure: <span class = "pressure-info"></span></div>
                    </div>
                </div>
                <div class="night-morning-day-evening">
                    <div class="night" img src = "./img/night.png" alt = "">
                            <img src = "./img/night.png" alt = "" class = "schedule-logo">
                            <div class="n-info">
                                <span id = "night-temp">night <span class="night-temp"></span></span>
                                <span id = "night-feel">Feels like <span class="night-feel"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span class="morning-temp"></span></span>
                                <span id = "morning-feel">Feels like <span class="morning-feel"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span class="day-temp"></span></span>
                                <span id = "day-feel">Feels like <span class="day-feel"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span class="evening-temp"></span></span>
                                <span id = "evening-feel">Feels like <span class="evening-feel"></span></span>
                            </div>
                    </div>
                </div>
                <div class="daily-container"> <!-- наше окно, в котором будут двигаться элементы-->
                    <div class = "daily-track"> <!-- полоска элементов, которая будет перемещаться-->
                      
                        <div class = "element" id = "element0">
                            <div class="elem-time" id = "elem-time0">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp0" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature0">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc0">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop0">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis0">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element1">
                            <div class="elem-time" id = "elem-time1">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp1" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature1">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc1">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop1">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis1">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element2">
                            <div class="elem-time" id = "elem-time2">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp2" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature2">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc2">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop2">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis2">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element3">
                            <div class="elem-time" id = "elem-time3">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp3" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature3">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc3">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop3">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis3">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element4">
                            <div class="elem-time" id = "elem-time4">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp4" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature4">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc4">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop4">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis4">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element5">
                            <div class="elem-time" id = "elem-time5">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp5" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature5">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc5">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop5">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis5">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element6">
                            <div class="elem-time" id = "elem-time6">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp6" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature6">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc6">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop6">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis6">
                                Visibility
                            </div>
                        </div>
                        <div class="element"   id = "element7">
                            <div class="elem-time" id = "elem-time7">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp7" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature7">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc7">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop7">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis7">
                                Visibility
                            </div>

                        </div>
                        <div class="element"   id = "element8">
                            <div class="elem-time" id = "elem-time8">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp8" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature8">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc8">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop8">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis8">
                                Visibility
                            </div>

                        </div>
                        <div class="element"  id = "element9">
                            <div class="elem-time" id = "elem-time9">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp9" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature9">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc9">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop9">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis9">
                                Visibility
                            </div>

                        </div>
                        <div class="element"  id = "element10">
                            <div class="elem-time" id = "elem-time10">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp10" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature10">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc10">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop10">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis10">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element11">
                            <div class="elem-time" id = "elem-time11">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp11" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature11">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc11">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop11">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis11">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element12">
                            <div class="elem-time" id = "elem-time12">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp12" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature12">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc12">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop12">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis12">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element13">
                            <div class="elem-time" id = "elem-time13">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp13" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature13">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc13">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop13">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis13">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element14">
                            <div class="elem-time" id = "elem-time14">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp14" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature14">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc14">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop14">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis14">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element15">
                            <div class="elem-time" id = "elem-time15">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp15" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature15">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc15">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop15">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis15">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element16">
                            <div class="elem-time" id = "elem-time16">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp16" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature16">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc16">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop16">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis16">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element17">
                            <div class="elem-time" id = "elem-time17">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp17" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature17">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc17">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop17">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis17">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element18">
                            <div class="elem-time" id = "elem-time18">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp18" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature18">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc18">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop18">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis18">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element19">
                            <div class="elem-time" id = "elem-time19">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp19" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature19">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc19">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop19">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis19">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element20">
                            <div class="elem-time" id = "elem-time20">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp20" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature20">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc20">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop20">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis20">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element21">
                            <div class="elem-time" id = "elem-time21">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp21" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature21">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc21">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop21">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis21">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element22">
                            <div class="elem-time" id = "elem-time22">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp22" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature22">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc22">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop22">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis22">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element23">
                            <div class="elem-time" id = "elem-time23">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp23" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature23">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc23">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop23">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis23">
                                Visibility
                            </div>
                        </div>
                        <div class="element"  id = "element24">
                            <div class="elem-time" id = "elem-time24">
                                Time
                            </div>
                            <div class="elem-temp" id = "elem-temp24" >
                                +99 °C
                            </div>
                            <div class="elem-feature" id = "elem-feature24">
                                <img src = "./img/moon.png">
                            </div>
                            <div class="elem-desc" id = "elem-desc24">
                                Weather
                            </div>
                            <div class="elem-pop" id = "elem-pop24">
                                Probability of precipitation
                            </div>
                            <div class="elem-vis" id = "elem-vis24">
                                Visibility
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
            
        <h2>7-days forecast</h2>
        <section id="seven-days">

        <!-- first chart -->


        <div class="seven-days-table" id = "seven-days-table1">
            <div class="high-date" id = "high-date1">
                Date
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
                                Max tempurature: <span id ="seven-days-max1"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min1"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed: <span id ="sd-wind-spd1"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction: <span id ="sd-wind-dir1"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind: <span id ="sd-wind-gusts1"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum1"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop1"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis1"></span>
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
                                <span id = "night-temp">night <span id="night-temp1"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel1"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp1"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel1"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp1"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel1"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp1"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel1"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise1"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset1"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv1"></span>
                    </div>
                </div>
            </div>
        </div>


        <!-- second chart -->


        <div class="seven-days-table" id = "seven-days-table2">
            <div class="high-date" id = "high-date2">
                Date
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
                                Max tempurature: <span id ="seven-days-max2"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed <span id ="sd-wind-spd2"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction <span id ="sd-wind-dir2"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind <span id ="sd-wind-gusts2"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum2"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop2"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis2"></span>
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
                                <span id = "night-temp">night <span id="night-temp2"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel2"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp2"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel2"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp2"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel2"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp2"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel2"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise2"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset2"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv2"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- third chart -->

        <div class="seven-days-table" id = "seven-days-table3">
            <div class="high-date" id = "high-date3">
                Date
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
                                Max tempurature: <span id ="seven-days-max3"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min3"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed <span id ="sd-wind-spd3"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction <span id ="sd-wind-dir3"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind <span id ="sd-wind-gusts3"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum3"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop3"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis3"></span>
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
                                <span id = "night-temp">night <span id="night-temp3"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel3"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp3"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel3"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp3"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel3"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp3"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel3"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise3"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset3"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv3"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4th chart -->

        <div class="seven-days-table" id = "seven-days-table4">
            <div class="high-date" id = "high-date4">
                Date
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
                                Max tempurature: <span id ="seven-days-max4"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min4"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed <span id ="sd-wind-spd4"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction <span id ="sd-wind-dir4"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind <span id ="sd-wind-gusts4"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum4"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop4"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis4"></span>
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
                                <span id = "night-temp">night <span id="night-temp4"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel4"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp4"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel4"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp4"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel4"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp4"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel4"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise4"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset4"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv4"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5th chart -->

        <div class="seven-days-table" id = "seven-days-table5">
            <div class="high-date" id = "high-date5">
                Date
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
                                Max tempurature: <span id ="seven-days-max5"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min5"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed <span id ="sd-wind-spd5"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction <span id ="sd-wind-dir5"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind <span id ="sd-wind-gusts5"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum5"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop5"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis5"></span>
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
                                <span id = "night-temp">night <span id="night-temp5"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel5"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp5"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel5"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp5"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel5"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp5"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel5"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise5"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset5"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv5"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6th chart -->

        <div class="seven-days-table" id = "seven-days-table6">
            <div class="high-date" id = "high-date6">
                Date
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
                                Max tempurature: <span id ="seven-days-max6"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min6"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed <span id ="sd-wind-spd6"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction <span id ="sd-wind-dir6"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind <span id ="sd-wind-gusts6"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum6"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop6"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis6"></span>
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
                                <span id = "night-temp">night <span id="night-temp6"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel6"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp6"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel6"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp6"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel6"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp6"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel6"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise6"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset6"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv6"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7th chart -->
        
        <div class="seven-days-table" id = "seven-days-table7">
            <div class="high-date" id = "high-date7">
                Date
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
                                Max temperature: <span id ="seven-days-max7"></span>
                            </div>
                            <div class="seven-days-min">
                                Min temperature: <span id ="seven-days-min7"></span>
                            </div>
                        </div>
                    </div>
                    <div class="seven-days-wind-hum">
                        <div class="seven-days-wind">
                            <div class="sd-wind-spd">
                                Wind speed <span id ="sd-wind-spd7"></span>
                            </div>
                            <div class="sd-wind-dir">
                                Wind direction <span id ="sd-wind-dir7"></span>
                            </div>
                            <div class="sd-wind-gusts">
                                Gusts of wind <span id ="sd-wind-gusts7"></span>
                            </div>
                        </div>
                        <div class="seven-days-hum">
                            Humidity <span id ="seven-days-hum7"></span>
                        </div>
                    </div>
                    <div class="seven-days-pop-vis">
                        <div class="seven-days-pop">
                            Probability of precipitation <span id ="seven-days-pop7"></span>
                        </div>
                        <div class="seven-days-vis">
                            Visibility <span id ="seven-days-vis7"></span>
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
                                <span id = "night-temp">night <span id="night-temp7"></span></span>
                                <span id = "night-feel">Feels like <span id="night-feel7"></span></span>
                            </div>
                    </div>
                    <div class="morning">
                            <img src = "./img/morning.png" alt = "" class = "schedule-logo">
                            <div class="m-info">
                                <span id = "morning-temp">morning <span id="morning-temp7"></span></span>
                                <span id = "morning-feel">Feels like <span id="morning-feel7"></span></span>
                            </div>
                    </div>
                    <div class="day">
                            <img src = "./img/day.png" alt = "" class = "schedule-logo">
                            <div class="d-info">
                                <span id = "day-temp">daytime <span id="day-temp7"></span></span>
                                <span id = "day-feel">Feels like <span id="day-feel7"></span></span>
                            </div>
                    </div>
                    <div class="evening">
                            <img src = "./img/evening.png" alt = "" class = "schedule-logo">
                            <div class="e-info">
                                <span id = "evening-temp">evening <span id="evening-temp7"></span></span>
                                <span id = "evening-feel">Feels like <span id="evening-feel7"></span></span>
                            </div>
                    </div>
                </div>
                <div class="seven-days-sunrise-sunset-uv">
                    <div class="seven-days-sunrise">
                        Dawn <span id = "seven-days-sunrise7"></span>
                    </div>
                    <div class="seven-days-sunset">
                        Sunset <span id = "seven-days-sunset7"></span>
                    </div>
                    <div class="seven-days-uv">
                        UV-index <span id = "seven-days-uv7"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
    </footer>

</body>
</html>

