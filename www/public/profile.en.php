<?php
session_start();

if (isset($_SESSION['user'])) {

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
            <img src="<?= $_SESSION['user']['avatar'] ?>" alt="">
            <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
            <a href="#"><?= $_SESSION['user']['email'] ?></a>
            <a href="authentication/logout.php" class="logout" style="margin-left: 10px;">Exit</a>
        </form>
    </div>
    <div class="settings-wrapper">
        <h2>Settings</h2>
        <br>
        <h3>Language</h3>
        <br>
        <form method="post" class = "setting-form">
            <select name="select-lang">
                <option selected value="selected">Russian</option>
                <option value="english">English</option>
            </select>
            <input type="submit"  class = "submit" value="Submit"></p>
        </form>
        <h3>Theme</h3>
        <br>
        <form method="post" class = "setting-form">
            <select name="select-theme" id = "select-theme" onChange="themeSetup()">
                <option value="1">Clear Sky</option>
                <option value="2">Dawn</option>
            </select>
            <input type="submit" class = "submit" value="Submit"></p>
        </form>
        <h3>Default forecast city</h3>
            <br>
            <form method="post" class = "setting-form">
                <select id="select-geo" onChange="geoSetup()";>
                    <option value="1" >Auto select</option>
                    <option value="2">Enter city name</option>
                </select>
                <p>Enter the default city for which the weather will be set on the main page</p>
                <input type="text" placeholder="Введите город" value="Moscow" class = "text-input" id = "text-input" size="40">
                <input type="submit" class = "submit" value="Submit" id = "submit-geo"></p>
            </form>
    </div>
</div>

</body>
<script src="/js/profile-settings.js"></script>
</html>