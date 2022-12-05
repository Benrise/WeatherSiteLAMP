<?php
require_once("authentication/db_connect.php");
session_start();
if (isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="/css/<?php echo $_SESSION['theme'] = redisGet(substr_replace(session_id(),"PHPREDIS_THEME:",0, 0));?>">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<!-- Форма регистрации -->

<form action="authentication/signup.php" method="post" enctype="multipart/form-data">
    <label>ФИО</label>
    <input type="text" name="full_name" placeholder="Введите свое полное имя">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Введите свой логин">
    <label>Почта</label>
    <input type="email" name="email" placeholder="Введите адрес своей почты">
    <label>Изображение профиля</label>
    <input type="file" name="avatar">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
    <button type="submit">Войти</button>
    <p>
        У вас уже есть аккаунт? - <a href="/">авторизируйтесь</a>!
    </p>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>

</body>
</html>