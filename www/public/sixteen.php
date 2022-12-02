<?php
session_start();

if (isset($_SESSION['user'])) {

}
else{
    setcookie("lastPagecl", "sixteen");
    header('Location: http://localhost/login.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "./css/style.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/normalize.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/sixteen.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/style.css">
    <title>Погода</title>
    <!--Загрузка шрифтов-->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>   
    <script src= "./js/moment-with-locales.js"></script>
    <script src="./js/moment-timezone-with-data.js"></script>
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
                <div class = "title" style = "text-decoration: none;">
                    <div class="logo-type">
                        <div class="site-title"><a href="index.html">Прогноз погоды</a></div>
                        <small class="site-description"><a href="https://yandex.ru">При поддержке Yandex</a></small>
                    </div>
                </div>

            </div>
            <div class="menu-searchbar">
                <div class="menu">
                    <a href="cities.php" class = "cities" >Погода городов мира</a>
                    <a href="sixteen.php" class="sixteen-forecast" onclick="return false">Прогноз на 16 дней</a>
                    <a href="history.php" class="history">Прогноз прошлой недели</a>
                    <a href="weatherMap.php" class="map-forecast">Геокарта мира</a>
                </div>
                <form id="search-bar" onsubmit="return WeatherSixTeen()" method="post">
                    <script src="./js/script"></script>
                    <input type ="search"  name = "search" id = "search" required placeholder="Введите город">
                    <input type="submit" value="Найти" id = "submit">
                    <a  style="color:white; "  href="profile.php">Профиль</a>
                </form>
            </div>
        </div>
    </header>
    <div class="content-container">
        <div class="head-info">
            <div class="head-title">
                Прогноз погоды на 16 дней
            </div>
            <div class="head-city">
                Москва
            </div>
            <script src = './js/sixteen.js'></script>
        </div>

        <!-- 1 card -->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm1">01 январь </span>
                <div class="card-tomorrow">
                    завтра
                </div>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp1">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info1">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img1">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info1">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info1"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info1"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info1"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos1"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info1"></span>
                        Ветер: <span class = "wind-info" id = "wind-info1"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir1"> </span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv1"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info1"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info1"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info1">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--2 card-->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm2">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp2">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info2">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img2">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info2">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info2"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info2"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info2"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos2"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info2"></span>
                        Ветер: <span class = "wind-info" id = "wind-info2"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir2"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv2"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info2"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info2"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info2">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--3 card-->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm3">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp3">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info3">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img3">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info3">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info3"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info3"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info3"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos3"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info3"></span>
                        Ветер: <span class = "wind-info" id = "wind-info3"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir3"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv3"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info3"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info3"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info3">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 card -->
        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm4">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp4">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info4">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img4">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info4">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info4"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info4"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info4"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos4"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info4"></span>
                        Ветер: <span class = "wind-info" id = "wind-info4"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir4"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv4"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info4"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info4"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info4">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 5 card -->
        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm5">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp5">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info5">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img5">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info5">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info5"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info5"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info5"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos5"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info5"></span>
                        Ветер: <span class = "wind-info" id = "wind-info5"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir5"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv5"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info5"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info5"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info5">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6 card -->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm6">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp6">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info6">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img6">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info6">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info6"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info6"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info6"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos6"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info6"></span>
                        Ветер: <span class = "wind-info" id = "wind-info6"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir6"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv6"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info6"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info6"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info6">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7 card -->
        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm7">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp7">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info7">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img7">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info7">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info7"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info7"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info7"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos7"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info7"></span>
                        Ветер: <span class = "wind-info" id = "wind-info7"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir7"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv7"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info7"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info7"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info7">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 8 card -->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm8">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp8">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info8">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img8">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info8">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info8"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info8"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info8"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos8"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info8"></span>
                        Ветер: <span class = "wind-info" id = "wind-info8"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir8"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv8"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info8"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info8"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info8">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--9 card-->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm9">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp9">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info9">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img9">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info9">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info9"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info9"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info9"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos9"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info9"></span>
                        Ветер: <span class = "wind-info" id = "wind-info9"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir9"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv9"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info9"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info9"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info9">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 10 card-->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm10">01 январь </span>
                , сегодня
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp10">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info10">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img10">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info10">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info10"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info10"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info10"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos10"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info10"></span>
                        Ветер: <span class = "wind-info" id = "wind-info10"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir10"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv10"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info10"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info10"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info10">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 11 card -->
        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm11">01 январь </span>
                , сегодня
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp11">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info11">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img11">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info11">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info11"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info11"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info11"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos11"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info11"></span>
                        Ветер: <span class = "wind-info" id = "wind-info11"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir11"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv11"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info11"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info11"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info11">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 12 card -->
        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm12">1 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp12">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info12">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img12">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info12">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info12"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info12"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info12"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos12"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info12"></span>
                        Ветер: <span class = "wind-info" id = "wind-info12"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir12"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv12"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info12"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info12"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info12">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 13 card -->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm13">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp13">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info13">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img13">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info13">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info13"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info13"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info13"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos13"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info13"></span>
                        Ветер: <span class = "wind-info" id = "wind-info13"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir13"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv13"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info13"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info13"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info13">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 14 card -->
        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm14">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp14">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info14">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img14">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info14">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info14"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info14"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info14"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos14"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info14"></span>
                        Ветер: <span class = "wind-info" id = "wind-info14"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir14"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv14"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info14"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info14"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info14">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 15 card -->

        <div class="card">
            <div class="card-date">
                <span class = "card-dd-mm" id = "card-dd-mm15">01 январь </span>
            </div>
            <div class="upper-container">
                <div class="upper-left">
                    <div class="weather-img-container">
                        <div class="upper-weather">
                            <div class="upper-temp" id = "upper-temp15">
                                9*
                            </div>
                            <div class="upper-weather-info" id = "upper-weather-info15">
                                Погода
                            </div>
                        </div>
                        <div class="upper-img" id = "upper-img15">
                            <img src = "img/snowflake.png">
                        </div>
                    </div>
                    <div class="upper-other">
                        <div class="upper-feels">
                            Ощущается как: <span class = "upper-feels-info" id = "upper-feels-info15">   </span>
                        </div>
                        <div class="upper-max">
                            Максимальная температура: <span class = "upper-max-info" id = "upper-max-info15"></span>
                        </div>
                        <div class="upper-min">
                            Минимальная температура: <span class = "upper-min-info" id = "upper-min-info15"></span>
                        </div>
                    </div>
                </div>
                <div class="upper-right">
                    <div class="pop-vis">
                        Вероятность осадков: <span class = "pop-info" id = "pop-info15"></span>
                        Видимость: <span class = "vis-info" id = "vis-infos15"></span>
                    </div>
                    <div class="wind-gusks">
                        Порывы до м/c: <span class = "gusks-info" id = "gusks-info15"></span>
                        Ветер: <span class = "wind-info" id = "wind-info15"></span> 
                        Направление ветра <span class = "wind-info-dir" id = "wind-info-dir15"></span>
                    </div>
                </div>
            </div>
            <div class="under-container">
                <div class="under-left">
                    <div class="sun-uv">
                        <div class="sun-img-text">
                            <div class="sun-img">
                                <img src = "img/sun-under.png">
                            </div>
                            <div class="uv-text">Уф индекс:</div><span class = "under-uv" id = "under-uv15"></span>
                        </div>
                    </div>
                    <div class="under-sunrise-sunset">
                        Восход: <span class = "under-sunrise-info" id = "under-sunrise-info15"></span>
                        Рассвет: <span class = "under-sunset-info" id = "under-sunset-info15"></span>
                    </div>
                </div>
                <div class="under-right">
                    <div class="alerts-container">
                        Гео предупреждения:
                        <div class="alerts-info" id = "alerts-info15">
                            Опасных метеорологических явлений не наблюдается.
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
  
    












    
</body>