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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body id="body">

<!-- Профиль -->
<div class="wrapper">
    <div class="profile-wrapper">
        <form>
            <a class="back-button" href="http://localhost/index.en.html">Home</a>
            <img src="<?= $_SESSION['user']['avatar'] ?>" alt="">
            <h1 style="margin: 10px 0;"><?= $_SESSION['user']['login'] ?></h1>
            <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
            <a href="#"><?= $_SESSION['user']['email'] ?></a>
            <a href="authentication/logout.php" class="logout" style="margin-left: 10px;">Exit</a>
        </form>
    </div>
    <div class="settings-wrapper">
        <h2>Settings</h2>
        <br>
        <h3>Language</h3>
        <form method="POST" class = "setting-form">
            <select name="select-lang">
                <option selected value="selected" name="russian">Русский</option>
                <option value="english" name="english">English</option>
            </select>
            <br>
            <br>
            <h3>Selected theme</h3>
            <select name="select-theme" id = "select-theme" onChange="themeSetup()">
                <option value="1">Clear Sky</option>
                <option value="2">Dawn</option>
            </select>
            <br>
            <br>
            <h3>Forecast city</h3>
            <select id="select-geo" onChange="geoSetup()";>
                <option value="1" >Auto</option>
                <option value="2">Enter city</option>
            </select>
            <p>Default forecast city</p>
            <input type="text" placeholder="Введите город" value="City from PHP" class = "text-input" id = "text-input" size="40">
            <input type="submit" value="Submit" id = "submit"></p>
        </form>
    </div>
</div>

</body>
<script src="/js/profile-settings.js"></script>
</html>