<?php
require_once("language/lang.php");

session_start();

if (isset($_SESSION['user'])) {
    global $langInProfilePages;
    if (isset($_POST['select-lang'])) {
        // получаем язык
        $selectedLang = substr($_POST['select-lang'], 0, 2);
        // проверяем есть ли язык в списке поддерживаемых
        if (!in_array($selectedLang, array_keys($langInProfilePages))) {
            $selectedLang = 'ru';
        }

        // перенаправление на субдомен
        header('Location: ' . $langInProfilePages[$selectedLang]);
    }
}
else{
    header('Location: http://localhost/login.php');
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body id="body">
<!-- Профиль -->
<div class="wrapper">
    <div class="profile-wrapper">
        <a class="back-button" href="http://localhost/index.html">На главную</a>
        <form>
            <img src="<?= $_SESSION['user']['avatar'] ?>" alt="">
            <h1 style="margin: 10px 0;"><?= $_SESSION['user']['login'] ?></h1>
            <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
            <a href="#"><?= $_SESSION['user']['email'] ?></a>
            <a href="authentication/logout.php" class="logout" style="margin-left: 10px;">Выход</a>
        </form>
    </div>
    <div class="settings-wrapper">
        <h2>Интерфейс</h2>
        <br>
        <h3>Выбранный язык</h3>
        <form method="POST" class = "setting-form">
            <select name="select-lang">
                <option selected value="selected" name="russian">Русский</option>
                <option value="english" name="english">Английский</option>
            </select>
            <br>
            <br>
            <h3>Выбранная тема</h3>
            <select name="select-theme" id = "select-theme" onChange="themeSetup()">
                <option value="1">Чистое небо</option>
                <option value="2">Восход</option>
            </select>
            <br>
            <br>
            <h3>Город для прогноза по умолчанию</h3>
            <select id="select-geo" onChange="geoSetup()";>
                <option value="1" >Автоматически</option>
                <option value="2">Ввести город</option>
            </select>
            <p>Введите город по умолчанию, для которого будет устанавливаться погода на главной странице</p>
            <input type="text" placeholder="Введите город" value="Москва" class = "text-input" id = "text-input" size="40">
            <input type="submit" value="Применить" id = "submit"></p>
        </form>
    </div>
</div>


</body>
<script src="/js/profile-settings.js"></script>
</html>