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
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<!-- Профиль -->

<form>
    <img src="<?= $_SESSION['user']['avatar'] ?>" width="200" alt="">
    <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
    <a href="#"><?= $_SESSION['user']['email'] ?></a>
    <a href="authentication/logout.php" class="logout">Выход</a>
</form>

</body>
</html>