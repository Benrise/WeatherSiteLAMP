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
