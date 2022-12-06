<?php
require_once("resources/lang.php");
session_start();
if (isset($_SESSION['user'])) {
    if (isset($_POST['select-lang'])
        && isset($_POST['select-theme'])
        && isset($_POST['select-geo'])){
        setTheme();
        setLang();
        setDefaultGeo();
    }
}
else{
    header('Location: http://localhost/login.en.php');
}

function setTheme(): void
{
    $selectedTheme = $_POST['select-theme'];
    setcookie("theme", $selectedTheme);

}

function setDefaultGeo(){
    if (intval($_POST['select-geo'])){
        $isCustomCity = "true";
        $selectedCity = $_POST['input-default-geo'];
        setcookie("isCustomCity", $isCustomCity);
        setcookie("customCity", $selectedCity);


    }
    else {
        setcookie("customCity", "");
        setcookie("isCustomCity", "false");
    }

}

function setLang(): void
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/<?php echo @$_COOKIE['theme'];?>">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body id="body" class = body">
<!-- Profile -->
<div class="wrapper">
    <div class="profile-wrapper">
        <form>
            <a class="back-button" href="http://localhost/index.en.php">Home</a>
            <img src="<?= @$_SESSION['user']['avatar'] ?>" alt="">
            <h1 style="margin: 10px 0;"><?= @$_SESSION['user']['login'] ?></h1>
            <h2 style="margin: 10px 0;"><?= @$_SESSION['user']['full_name'] ?></h2>
            <a href="#"><?= @$_SESSION['user']['email'] ?></a>
            <a href="authentication/logout.en.php" class="logout" style="margin-left: 10px;">Exit</a>
        </form>
    </div>
    <div class="settings-wrapper">
        <h2>Settings</h2>
        <br>
        <h3>Language</h3>
        <form method="POST" class = "setting-form">
            <select name="select-lang">
                <option value ="russian" >Русский</option>
                <option selected value="english" >English</option>
            </select>
            <br>
            <br>
            <h3>Selected theme</h3>
            <select name="select-theme" id = "select-theme" onChange="themeSetup()">
                <option <?php if (@$_COOKIE['theme'] == 'sky-theme.css'){
                    echo "selected ";
                }?>value="sky-theme.css">Clear Sky</option>
                <option <?php if(@$_COOKIE['theme'] == 'dawn-theme.css') {
                    echo "selected ";
                }?>value="dawn-theme.css" >Dawn</option>
            </select>
            <br>
            <br>
            <h3>Forecast city</h3>
            <select id="select-geo" name ="select-geo" onChange="geoSetup()";>
                <option <?php if(@$_COOKIE['customCity'] == 'auto') {
                    echo "selected ";
                }?>selected value="0" >Auto</option>
                <option <?php if(@$_COOKIE['customCity'] !== 'auto') {
                    echo "selected ";
                }?>value="1">Custom</option>
            </select>
            <p>Default forecast city</p>
            <input type="text" placeholder="Сity" value="<?php echo @$_COOKIE['customCity']?>"  name = "input-default-geo" class = "text-input" id = "text-input" size="40">
            <input type="submit" value="Submit" id = "submit"></p>
        </form>
    </div>
</div>

</body>
<script src="/js/profile-settings.js"></script>
</html>