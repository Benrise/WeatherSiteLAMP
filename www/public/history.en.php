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
    <title>Погода</title>
    <link rel="stylesheet" href="/css/<?php echo $_SESSION['theme'] = redisGet(substr_replace(session_id(),"PHPREDIS_THEME:",0, 0));?>">
    <link rel = "stylesheet" type = "text/css" href = "./css/style.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/normalize.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/history.css">
    <title>Погода</title>
    <!--Загрузка шрифтов-->

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                    <div class="logo-type">
                        <h1 class="site-title" ><a href="index.html">Прогноз погоды</a></h1>
                        <small class="site-description"><a href="https://yandex.ru">При поддержке Yandex</a></small>
                    </div>
            </div>
            <div class="menu-searchbar">
                <div class="menu">
                    <a href="cities.php" class = "cities">Погода городов мира</a>
                    <a href="sixteen.php" class="sixteen-forecast">Прогноз на 16 дней</a>
                    <a href="" class="history" onclick = "return false"> Прогноз прошлой недели</a>
                    <a href="weatherMap.php" class="map-forecast">Геокарта мира</a>
                </div>
                <form id="search-bar" method="post">
                    <script src="./js/script.js"></script>
                    <input type ="search"  name = "search" id = "search" required placeholder="Введите город">
                    <input type="button" onclick="return Weather(), changeLocation(), Update()" value="Search" id = "submit">
                    <a  style="color:white; "  href="profile.en.php">Profile</a>
                </form>
            </div>
        </div>
    </header>
    <div class="content-container">
        <div class="main-container">
            <div class="upper-container">
                <div class="higher-part">
                    <div class="img">
                        <img src = "./img/reset.png">
                    </div>
                    <div class="search-form">
                        <div class="forms">
                            <div class="date-form">
                                Дата:
                                <input type="date" class = "date-selector" name = "Date" max = '' min = ''  id="dataToday" value='' >
                            </div>
                            <div class="city-form">
                                Город:
                                <input type ="search"  class = "history-search" required placeholder="Введите город">
                            </div>
                        </div>
                        <div class="search-button-container">             
                                <button class="search-button" type = "submit" onclick="return HistoryFunc(), Rotate()" >
                                    Показать
                                </button>
                        </div>
                    </div>
                </div>
                <div class="under-container">
                    <div class="left-container">
                        <div class="feature-container">
                            <img src = "./img/moon.png">
                        </div>
                        <div class="under-info-container">
                            <div class="city-info">
                                Москва
                            </div>
                            <div class="date-desc">
                                <div class="date-info">
                                    01.01
                                </div>
                                <div class="desc-info">
                                    было пасмурно
                                </div>
                            </div>
                            <div class="temp-info">
                                Температура
                            </div>
                            <div class="feel-info">
                                Ощущалось как
                            </div>
                            <div class="wind-info">
                                Ветер
                            </div>
                            <div class="hum-info">
                                Влажность
                            </div>
                        </div>

                    </div>
                    <div class="right-container">
                        <div class="info-table" id = "info-table0">
                            <div class="table-feature" id = "table-feature1">
                                
                            </div>
                            <div class="table-time" id = "table-time1">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp1">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind1">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press1">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table2">
                            <div class="table-feature" id = "table-feature2">
                                
                            </div>
                            <div class="table-time" id = "table-time2">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp2">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind2">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press2">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table3">
                            <div class="table-feature" id = "table-feature3">
                                
                            </div>
                            <div class="table-time" id = "table-time3">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp3">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind3">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press3">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table4">
                            <div class="table-feature" id = "table-feature4">
                                
                            </div>
                            <div class="table-time" id = "table-time4">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp4">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind4">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press4">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table5">
                            <div class="table-feature" id = "table-feature5">
                                
                            </div>
                            <div class="table-time" id = "table-time5">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp5">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind5">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press5">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table6">
                            <div class="table-feature" id = "table-feature6">
                                
                            </div>
                            <div class="table-time" id = "table-time6">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp6">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind6">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press6">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table7">
                            <div class="table-feature" id = "table-feature7">
                                
                            </div>
                            <div class="table-time" id = "table-time7">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp7">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind7">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press7">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table8">
                            <div class="table-feature" id = "table-feature8">
                                
                            </div>
                            <div class="table-time" id = "table-time8">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp8">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind8">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press8">
                                Давление
                            </div>
                        </div>

                        <div class="info-table" id = "info-table9">
                            <div class="table-feature" id = "table-feature9">
                                
                            </div>
                            <div class="table-time" id = "table-time9">
                                Время
                            </div>
                            <div class="table-temp" id = "table-temp9">
                                Темп
                            </div>
                            <div class="wind-container">
                                <div class="table-wind" id = "table-wind9">
                                    Ветер
                                </div>
                                <div class = wind-logo><img src = "./img/wind.png"></div>
                            </div>
                            <div class="table-press" id = "table-press9">
                                Давление
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src = "./js/history.js"></script>
    
    </script>
</body>
</html>