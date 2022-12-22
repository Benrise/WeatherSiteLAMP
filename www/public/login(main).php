<?php
session_start();
if (isset($_SESSION['user'])) {

    header('Location: ../profile.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="/css/<?php echo @$_COOKIE['theme'];?>">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<!-- Форма авторизации -->
<div class="login-wrapper">
    <form action="authentication/signing.php" method="post">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="/register.php">зарегистрируйтесь</a>!
            <br>
            <br>
            <a class="back-button" href="http://localhost/index.php">Вернуться на главную</a>
        </p>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);

        ?>
    </form>
</div>
</body>
</html>

