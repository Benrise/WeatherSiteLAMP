<?php
session_start();
use App\Services\Page;

if (isset($_SESSION['user'])) {

    header('Location: ../profile.php');
}
?>

<!doctype html>
<html lang="en">

<?php Page::part('auth_head'); ?>

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
            У вас нет аккаунта? - <a href="/register">зарегистрируйтесь</a>!
            <br>
            <br>
            <a class="back-button" href="/">Вернуться на главную</a>
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

