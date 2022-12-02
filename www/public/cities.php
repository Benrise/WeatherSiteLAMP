<?php
session_start();
if (isset($_SESSION['user'])) {

}
else{
    setcookie("lastPage", "cities");
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
    <link rel = "stylesheet" type = "text/css" href = "./css/cities.css">
    <title>Погода</title>
    <!--Загрузка шрифтов-->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src= "./js/moment-with-locales.js"></script>
    <script src="./js/moment-timezone-with-data.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/citiesScript.js"></script>
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
                    <a href="" class = "cities" onclick = "return false" >Погода городов мира</a>
                    <a href="sixteen.php" class="sixteen-forecast">Прогноз на 16 дней</a>
                    <a href="history.php" class="history">Прогноз прошлой недели</a>
                    <a href="weatherMap.php" class="map-forecast">Геокарта мира</a>
                </div>
                <form id="search-bar" action = "index.html" onsubmit="return Weather(), changeLocation(), Update()" method="post">
                    <script src="./js/script.js"></script>
                    <input type ="search"  name = "search" id = "search" required placeholder="Введите город">
                    <input type="submit" value="Найти" id = "submit">
                    <a  style="color:white; "  href="profile.php">Профиль</a>
                </form>
            </div>
        </div>
    </header>
    <div class="content-container">
        <div class="main-container">

            <div class="russia-container" id = "russia-tab">
                <h1>Погода в городах России</h1>
                <div class="russia-img">
                    <div class="tab">
                        <div class="weather-img">
                            <div class="c-weather">
                                <div class="city" id = "rus-city">
                                    Москва
                                </div>
                                <div class="temp" id = "rus-temp">
                                    3*
                                </div>
                                <div class="desc" id = "rus-desc">
                                    Погода
                                </div>
                            </div>
                            <div class="c-img" id = "rus-feature">
                                <img src = "img/snowflake.png">
                            </div>
                        </div>
                        <div class="c-under">
                            <div class="feel">
                                Ощущается как: <span id = "rus-feel"></span>
                            </div>
                            <div class="hum">
                                Влажность: <span id = "rus-hum"></span>
                            </div>
                            <div class="wind">
                                Ветер: <span id = "rus-wind"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="russia-city" id = "Moscow">
                    <a href ="cities.html#russia-tab" onclick=" WeatherCity('Москва')" class = "button" >Москва</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Санкт-Петербург')">Санкт-Петербург</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button"  onclick=" WeatherCity('Новосибирск')">Новосибирск</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button"  onclick=" WeatherCity('Екатеринбург')">Екатеринбург</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button"  onclick=" WeatherCity('Казань')">Казань</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Нижний Новгород')">Нижний Новгород</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Челябинск')">Челябинск</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Самара')">Самара</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Омск')">Омск</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Ростов-на-Дону')">Ростов-на-Дону</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Уфа')">Уфа</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Красноярск')">Красноярск</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Воронеж')">Воронеж</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Пермь')">Пермь</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Волгоград')">Волгоград</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Краснодар')">Краснодар</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Саратов')">Саратов</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Тюмень')">Тюмень</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Тольятти')">Тольятти</a>
                </div>
                <div class="russia-city">
                    <a href ="cities.html#russia-tab" class = "button" onclick=" WeatherCity('Ижевск')">Ижевск</a>
                </div>
            </div>
            <div class="usa-container" id = "usa-tab">
                <h1>Погода в штатах Америки</h1>
                <div class="usa-img">
                    <div class="tab">
                        <div class="weather-img">
                            <div class="c-weather">
                                <div class="city" id = "usa-city">
                                    Калифорния
                                </div>
                                <div class="temp" id = "usa-temp">
                                    3*
                                </div>
                                <div class="desc" id = "usa-desc">
                                    Погода
                                </div>
                            </div>
                            <div class="c-img" id = "usa-feature">
                                <img src = "img/snowflake.png">
                            </div>
                        </div>
                        <div class="c-under">
                            <div class="feel">
                                Ощущается как: <span id = "usa-feel"></span>
                            </div>
                            <div class="hum">
                                Влажность: <span id = "usa-hum"></span>
                            </div>
                            <div class="wind">
                                Ветер: <span id = "usa-wind"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Калифорния')">Калифорния</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Техас')">Техас</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Нью-Йорк')">Нью-Йорк</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Флорида')">Флорида</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Иллинойс')">Иллинойс</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Пенсильвания')">Пенсильвания</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Огайо')">Огайо</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Мичиган')">Мичиган</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Джорджия')">Джорджия</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Северная Каролина')">Северная Каролина</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Нью-Джерси')">Нью-Джерси</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Вирджиния')">Вирджиния</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Вашингтон')">Вашингтон</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Массачусетс')">Массачусетс</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Индиана')">Индиана</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Аризона')">Аризона</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Теннесси')">Теннесси</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Муссури')">Муссури</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Мэриленд')">Мэриленд</a>
                </div>
                <div class="usa-city">
                    <a href ="cities.html#usa-tab" class = "button" onclick=" WeatherCityUSA('Висконсин')">Висконсин</a>
                </div>  

            </div>
            <div class="germany-container" id = "germany-tab">
                <h1>Погода в городах Германии</h1>
                <div class="germany-img">
                    <div class="tab">
                        <div class="weather-img">
                            <div class="c-weather">
                                <div class="city" id = "ger-city">
                                    Берлин
                                </div>
                                <div class="temp" id = "ger-temp">
                                    3*
                                </div>
                                <div class="desc" id = "ger-desc">
                                    Погода
                                </div>
                            </div>
                            <div class="c-img" id = "ger-feature">
                                <img src = "img/snowflake.png">
                            </div>
                        </div>
                        <div class="c-under">
                            <div class="feel">
                                Ощущается как: <span id = "ger-feel"></span>
                            </div>
                            <div class="hum">
                                Влажность: <span id = "ger-hum"></span>
                            </div>
                            <div class="wind">
                                Ветер: <span id = "ger-wind"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="germany-city">
                    <a href =" cities.html#germany-tab" class = "button" onclick="  WeatherCityGER('Берлин')">Берлин</a>
                </div>
                <div class="germany-city">
                    <a href =" cities.html#germany-tab" class = "button" onclick="  WeatherCityGER('Гамбург')">Гамбург</a>
                </div>
                <div class="germany-city">
                    <a href ="cities.html#germany-tab" class = "button" onclick="   WeatherCityGER('Мюнхен')">Мюнхен</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Кёльн')">
                    <a href =" cities.html#germany-tab"class = "button">Кёльн</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Франкфрут')">
                    <a href =" cities.html#germany-tab"class = "button">Франкфрут</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Штутгарт')">
                    <a href =" cities.html#germany-tab"class = "button">Штутгарт</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Дюссельдорф')">
                    <a href =" cities.html#germany-tab"class = "button">Дюссельдорф</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Дортмунд')">
                    <a href =" cities.html#germany-tab"class = "button">Дортмунд</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Эссен')">
                    <a href =" cities.html#germany-tab"class = "button">Эссен</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Лейпциг')">
                    <a href =" cities.html#germany-tab"class = "button">Лейпциг</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Бремен')">
                    <a href =" cities.html#germany-tab"class = "button">Бремен</a>
                </div>
                <div class="germany-city"class = "button" onclick="  WeatherCityGER('Дрезден')">
                    <a href =" cities.html#germany-tab"class = "button">Дрезден</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Ганновар')">
                    <a href =" cities.html#germany-tab"class = "button">Ганновар</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Нюрнберг')">
                    <a href =" cities.html#germany-tab"class = "button">Нюрнберг</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Дуйсберг')">
                    <a href =" cities.html#germany-tab"class = "button">Дуйсберг</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Бохум')">
                    <a href =" cities.html#germany-tab"class = "button">Бохум</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Вупперталь')">
                    <a href =" cities.html#germany-tab"class = "button">Вупперталь</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Билефельд')">
                    <a href =" cities.html#germany-tab"class = "button">Билефельд</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Бонн')">
                    <a href =" cities.html#germany-tab" class = "button">Бонн</a>
                </div>
                <div class="germany-city" class = "button" onclick="  WeatherCityGER('Мюнстер')">
                    <a href =" cities.html#germany-tab" class = "button">Мюнстер</a>
                </div>
            </div>
        </div>
    </div>
    


</body>