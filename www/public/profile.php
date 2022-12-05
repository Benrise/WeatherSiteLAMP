<?php
require_once("resources/lang.php");
require_once("authentication/db_connect.php");
session_start();
unset($_SESSION['theme']);
$_SESSION['theme'] = redisGet(substr_replace(session_id(),"PHPREDIS_THEME:",0, 0));
if (isset($_SESSION['user'])) {
    if (isset($_POST['select-lang'])
        && isset($_POST['select-theme'])
        && isset($_POST['select-geo'])){
        changeTheme();
        changeLang();
    }
}
else{
    header('Location: http://localhost/login.php');
}

function changeTheme(): void
{
    $selectedTheme = $_POST['select-theme'];
    redisSet(substr_replace(session_id(),"PHPREDIS_THEME:",0, 0), $selectedTheme);
}

function changeLang(): void
{
    global $langInProfilePages;
    // получаем язык
    $selectedLang = substr($_POST['select-lang'], 0, 2);
    setcookie("customLanguage", $selectedLang);
    if (!(@$_COOKIE['autoLanguage'] == @$_COOKIE['customLanguage'])){
        setcookie("isCustomLanguage", "true");
    }

    // проверяем есть ли язык в списке поддерживаемых
    if (!in_array($selectedLang, array_keys($langInProfilePages))) {
        $selectedLang = 'ru';
    }
    // перенаправление на субдомен
    header('Location: ' . $langInProfilePages[$selectedLang]);

}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="/css/<?php echo @$_SESSION['theme'];?>">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body id="body" class = "body">
<!-- Профиль -->
<div class="wrapper">
    <div class="profile-wrapper">
        <form>
            <a class="back-button" href="http://localhost/index.php">На главную</a>
            <img src="<?= @$_SESSION['user']['avatar'] ?>" alt="">
            <h1 style="margin: 10px 0;"><?= @$_SESSION['user']['login'] ?></h1>
            <h2 style="margin: 10px 0;"><?= @$_SESSION['user']['full_name'] ?></h2>
            <a href="#"><?= @$_SESSION['user']['email'] ?></a>
            <a href="authentication/logout.php" class="logout" style="margin-left: 10px;">Выход</a>
        </form>
    </div>
    <div class="settings-wrapper">
        <h2>Интерфейс</h2>
        <br>
        <h3>Выбранный язык</h3>
        <form method="POST" class = "setting-form">
            <select name="select-lang">
                <option selected value="russian" >Русский</option>
                <option value="english" >English</option>
            </select>
            <br>
            <br>
            <h3>Выбранная тема</h3>
            <select name="select-theme" id = "select-theme" onChange="themeSetup()">
                <option <?php if ($_SESSION['theme'] == 'sky-theme.css'){
                    echo "selected ";
                }?>value="sky-theme.css">Чистое небо</option>
                <option <?php if($_SESSION['theme'] == 'dawn-theme.css') {
                    echo "selected ";
                }?>value="dawn-theme.css" >Восход</option>
            </select>
            <br>
            <br>
            <h3>Город для прогноза по умолчанию</h3>
            <select id="select-geo" name ="select-geo" onChange="geoSetup()";>
                <option selected value="0" >Автоматически</option>
                <option value="1">Ввести город</option>
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